<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\CustomerOrder;
use App\Models\Customer;
use App\Models\ProductionOrder;
use App\Models\LaminationProductionOrder;
use App\Models\ExtruderProductionOrder;
use App\Models\RewindingProductionOrder;
use App\Models\StitchingProductionOrder;
use App\Models\PackingProductionOrder;
use App\Models\ExtruderOrderHistory;
use App\Models\LaminationOrderHistory;
use App\Models\RewindingOrderHistory;
use App\Models\MaterialCategory;
use App\Models\MaterialSubCategory;
use App\Models\PackingOrderHistory;
use App\Models\StitchingOrderHistory;
use App\Models\MaterialIn;
use App\Models\MaterialOut;
use App\Models\Material;
use App\Models\Stock;
use App\Models\Transform;
use App\services\OtpService;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\loginNotification;


class ApiController extends Controller
{
    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }
    public function resendOtp(Request $request)
    {
        $request->validate([
            'mobile' => 'required|digits:10',
        ]);

        $user = User::where('contect', $request->mobile)->first();

        if (!$user) {
            return response()->json([
                'requestCode' => 404,
                'status' => 0,
                'message' => 'User with this mobile number does not exist.',
            ]);
        }

        if ($user->code_expires_at && $user->code_expires_at->gt(now())) {
            return response()->json([
                'requestCode' => 429,
                'status' => 0,
                'message' => 'OTP already sent. Please wait before requesting another OTP.',
            ]);
        }

        $code = rand(100000, 999999);

        $user->mobile_login_code  = $code;
        $user->code_expires_at = now()->addMinutes(5);
        $user->save();

        $this->otpService->sendOtp($request->mobile, $code);

        return response()->json([
            'requestCode' => 200,
            'status' => 1,
            'verification_code' => $code,
            'message' => 'New verification code sent to your mobile number.',
        ]);
    }

    public function loginWithMobile(Request $request)
    {
        $request->validate([
            'mobile' => 'required|digits:10',
            'device_token' => 'required|string',
        ]);

        $user = User::where('contect', $request->mobile)->first();

        if (!$user) {
            return response()->json([
                'requestCode' => 404,
                'status' => 0,
                'message' => 'User with this mobile number does not exist.',
            ]);
        }

        $code = rand(100000, 999999);
        $user->mobile_login_code = $code;
        $user->code_expires_at = now()->addMinutes(5);
        $user->save();

        $this->otpService->sendOtp($request->mobile, $code);

        return response()->json([
            'requestCode' => 200,
            'status' => 1,
            'verification_code' => $code,
            'message' => 'Verification code sent to mobile.',
        ]);
    }


    public function verifyMobileLogin(Request $request)
    {
        try {
            $request->validate([
                'mobile' => 'required|digits:10',
                'code' => 'required|digits:6',
                'device_token' => 'required|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'requestCode' => 422,
                'status' => 0,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        }

        $user = User::where('contect', $request->mobile)->first();
        // $loginTime = now()->toDateTimeString();
        // $deviceType = $request->header('Device-Type', 'Unknown');  // Optional: Device type header
        // $userIp = $request->ip();
        // $user->notify(new loginNotification($user, $loginTime, $deviceType, $userIp));

        if (!$user || $user->mobile_login_code !== $request->code || now()->greaterThan($user->code_expires_at)) {
            return response()->json([
                'requestCode' => 401,
                'status' => 0,
                'message' => 'Invalid or expired code.',
            ]);
        }

        $user->tokens()->where('name', $request->device_token)->delete();

        $token = $user->createToken($request->device_token)->plainTextToken;

        $user->mobile_login_code = null;
        $user->code_expires_at = null;
        $user->save();

        return response()->json([
            'requestCode' => 200,
            'status' => 1,
            'message' => 'Login successful',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'mobile' => $user->contect,
            ],
            'token' => $token,
        ]);
    }


    public function forgotPassword(Request $request)
    {
        $formData = $request->all();
    
        if (!isset($formData['email'])) {
            return response()->json(['error' => 'Email is required'], 404);
        }
    
        $user = User::where('email', $formData['email'])->first();
        if (empty($user)) {
            return response()->json(['error' => 'User not found'], 404);
        }
    
        $token = Str::random(60);
        // $user->password_reset_token = $token;
        // $user->save();
    
        return response()->json([
            'token' => $token,
            'status' => 1,
            'requestCode' => 200,
            'message' => 'Password reset token generated successfully',
        ]);
    }
    public function resetPassword(Request $request)
    {
        $formData = $request->all();

        if (!isset($formData['email']) || !isset($formData['password']) || !isset($formData['token'])) {
            return response()->json(['error' => 'Email, password, and token are required'], 404);
        }

        $user = User::where('email', $formData['email'])
                    // ->where('password_reset_token', $formData['token'])
                    ->first();
        
        if (empty($user)) {
            return response()->json(['error' => 'Invalid token or email'], 404);
        }

        $user->password = bcrypt($formData['password']);
        // $user->password_reset_token = null;
        $user->save();

        return response()->json([
            'status' => 1,
            'requestCode' => 200,
            'message' => 'Password reset successfully',
        ]);
    }



    //changes apis flow start
    // public function getLaminationOrdersByStatus(Request $request)
    // {
    //     $request->validate([
    //         'status' => 'required|string|in:pending,completed,cancelled',
    //     ]);
    
    //     $status = $request->input('status');

    //     $laminationOrders = LaminationProductionOrder::select(
    //         'lamination_production_orders.id as lamination_production_order_id',
    //         'customer_orders.id as customer_order_id',
    //         'customer_orders.customer_id',
    //         'customer_orders.order_id',
    //         'products.product_name',
    //         'lamination_production_orders.created_at as date',
    //         'production_order.lamination_type',
    //         'production_order.lamination_paper_name',
    //         'products.rolls_in_1_bdl',
    //         'products.gsm',
    //         'lamination_production_orders.id as production_order_id',
    //         'production_order.bundle_quantity as production_qty',
    //         'production_order.pending_bundle_qty',
    //         'product_orders.colour as color',
    //         'products.alias_sku',
    //         'products.length',
    //         'products.width',
    //         'products.number_of_bags_per_box as bags_per_bdl',
    //         'materials.material_name',
    //         'products.pipe_size',
    //         'products.gage',
    //         'product_orders.colour as color',
    //         'lamination_production_orders.machine',
    //         'lamination_production_orders.status',    
    //         'customer_orders.total_bundle as total_order_qty', 
    //     )
    //     ->leftJoin('products', 'lamination_production_orders.product_id', '=', 'products.id')
    //     ->leftJoin('production_order', 'lamination_production_orders.production_order_id', '=', 'production_order.id')
    //     ->leftJoin('product_orders', function($join) {
    //         $join->on('lamination_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
    //              ->on('lamination_production_orders.product_id', '=', 'product_orders.product_id');
    //     })
    //     ->leftJoin('customer_orders', 'lamination_production_orders.customer_order_id', '=', 'customer_orders.id')
    //     ->leftJoin('materials', 'products.packing_material_type', '=', 'materials.id')
    //     ->where('lamination_production_orders.status', $status)
    //     ->whereIn('products.category', ['1', '2'])
    //     ->get();


    //     if ($laminationOrders->isEmpty()) {
    //         return response()->json([
    //             'status' => 0,
    //             'requestCode' => 404,
    //             'message' => 'No lamination production orders found for the given status',
    //         ]);
    //     }
    
    //     return response()->json([
    //         'status' => 1,
    //         'requestCode' => 200,
    //         'message' => 'Lamination production orders retrieved successfully',
    //         'data' => $laminationOrders,
    //     ]);
    // }

    // public function getLaminationOrdersByStatus(Request $request)
    // {
    //     $request->validate([
    //         'status' => 'required|string|in:pending,completed,cancelled',
    //     ]);
    
    //     $status = $request->input('status');
    
    //     $laminationOrders = LaminationProductionOrder::select(
    //         'lamination_production_orders.id as lamination_production_order_id',
    //         'customer_orders.id as customer_order_id',
    //         'customer_orders.customer_id',
    //         //'customer_orders.order_id',
    //         DB::raw("CASE WHEN customer_orders.order_id IS NULL THEN 'self' ELSE customer_orders.order_id END as order_id"),
    //         DB::raw("CASE WHEN customer_orders.serial_number IS NULL THEN 'self' ELSE customer_orders.serial_number END as serial_number"),
    //         'products.product_name',
    //         'lamination_production_orders.created_at as date',
    //         'production_order.lamination_type',
    //         'lamination_material.material_name as lamination_material_name',
    //         'lamination_material.material_weight as lamination_material_weight',
    //         'lamination_film.material_name as film_name',
    //         'lamination_film.material_weight as film_weight',
    //         'lamination_film.material_width as film_width',
    //         'products.rolls_in_1_bdl',
    //         'products.gsm',
    //         'lamination_production_orders.id as production_order_id',
    //         'production_order.bundle_quantity as production_qty',
    //         'production_order.pending_bundle_qty',
    //         'product_orders.colour as color',
    //         'products.alias_sku',
    //         'products.length',
    //         'products.width',
    //         'products.number_of_bags_per_box as bags_per_bdl',
    //         'products.pipe_size',
    //         'products.gage',
    //         'lamination_production_orders.machine',
    //         'lamination_production_orders.status',
    //         'customer_orders.total_bundle as total_order_qty'
    //     )
    //     ->leftJoin('products', 'lamination_production_orders.product_id', '=', 'products.id')
    //     ->leftJoin('production_order', 'lamination_production_orders.production_order_id', '=', 'production_order.id')
    //     ->leftJoin('materials as lamination_material', 'production_order.lamination_paper_name', '=', 'lamination_material.id')
    //     ->leftJoin('materials as lamination_film', 'production_order.lamination_name', '=', 'lamination_film.id')
    //     ->leftJoin('product_orders', function($join) {
    //         $join->on('lamination_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
    //              ->on('lamination_production_orders.product_id', '=', 'product_orders.product_id');
    //     })
    //     ->leftJoin('customer_orders', 'lamination_production_orders.customer_order_id', '=', 'customer_orders.id')
    //     ->leftJoin('materials', 'products.packing_material_type', '=', 'materials.id')
    //     ->where('lamination_production_orders.status', $status)
    //     ->whereIn('products.category', ['1', '2'])
    //     ->get();
    
    //     if ($laminationOrders->isEmpty()) {
    //         return response()->json([
    //             'status' => 0,
    //             'requestCode' => 404,
    //             'message' => 'No lamination production orders found for the given status',
    //         ]);
    //     }
    
    //     // Add calculated fields
    //     $laminationOrders = $laminationOrders->map(function ($order) {
    //         $rolls_in_1_bdl = floatval($order->rolls_in_1_bdl ?? 0);
    //         $lamination_material_weight = floatval($order->lamination_material_weight ?? 0);
    //         $film_weight = floatval($order->film_weight ?? 0);
    //         $film_width = floatval($order->film_width ?? 0);
    //         $pending_bundle_qty = floatval($order->pending_bundle_qty ?? 0);
    //         $production_qty = floatval($order->production_qty ?? 0);
    //         $length = floatval($order->length ?? 0);
    //         $width = floatval($order->width ?? 0);
    //         $lamination_type = $order->lamination_type ?? '';
            

    
    //         // Calculate meter
    //         $fullMeter = $rolls_in_1_bdl * $production_qty * $length;
    //         $meter = $rolls_in_1_bdl * $production_qty * $length;
    //         if (in_array($lamination_type, ['Cutter', 'Strip'])) {
    //             $meter /= 2; // Divide by 2 for Cutter or Stripe
    //         }
    //         $order->meter = number_format($meter, 3);

    //         // Calculate paper_kg
    //         $step1= (1000 / $lamination_material_weight);
    //         $step2= $step1 * 39.37;
    //         $step3= $step2 / $width;
    //         $step4= floatval($fullMeter) / $step3;
            

    //         $order->paper_kg = $fullMeter > 0 && $width > 0 && $lamination_material_weight > 0 
    //             ? number_format($step4, 3) 
    //             : 0;
            
    //         // Calculate film_kg
    //         //Film KG = Total Required Meter / ((Film Weight*1000)/Film Width) 
    //         $step5 = ($film_weight * 1000);
    //         $step6 = $step5 / $film_width;
    //         $step7 = floatval($fullMeter) / $step6;
    //         $order->film_kg = $fullMeter > 0 && $film_weight > 0 && $width > 0 
    //             ? number_format($step7, 3) 
    //             : 0;
    
    //         return $order;
    //     });
    
    //     return response()->json([
    //         'status' => 1,
    //         'requestCode' => 200,
    //         'message' => 'Lamination production orders retrieved successfully',
    //         'data' => $laminationOrders,
    //     ]);
    // }
    public function getLaminationOrdersByStatus(Request $request)
{
    $request->validate([
        'status' => 'required|string|in:pending,completed,cancelled',
    ]);

    $status = $request->input('status');

    $laminationOrders = LaminationProductionOrder::select(
        'lamination_production_orders.id as lamination_production_order_id',
        'customer_orders.id as customer_order_id',
        'customer_orders.customer_id',
        DB::raw("CASE WHEN customer_orders.order_id IS NULL THEN 'self' ELSE customer_orders.order_id END as order_id"),
        DB::raw("CASE WHEN customer_orders.serial_number IS NULL THEN 'self' ELSE customer_orders.serial_number END as serial_number"),
        'products.product_name',
        'lamination_production_orders.created_at as date',
        'production_order.lamination_type',
        'lamination_material.material_name as lamination_material_name',
        'lamination_material.material_weight as lamination_material_weight',
        'lamination_film.material_name as film_name',
        'lamination_film.material_weight as film_weight',
        'lamination_film.material_width as film_width',
        'products.rolls_in_1_bdl',
        'products.gsm',
        'lamination_production_orders.id as production_order_id',
        'production_order.bundle_quantity as production_qty',
        'production_order.pending_bundle_qty',
        'product_orders.colour as color',
        'products.alias_sku',
        'products.length',
        'products.width',
        'products.number_of_bags_per_box as bags_per_bdl',
        'products.pipe_size',
        'products.gage',
        'lamination_production_orders.machine',
        'lamination_production_orders.status',
        'customer_orders.total_bundle as total_order_qty'
    )
    ->leftJoin('products', 'lamination_production_orders.product_id', '=', 'products.id')
    ->leftJoin('production_order', 'lamination_production_orders.production_order_id', '=', 'production_order.id')
    ->leftJoin('materials as lamination_material', 'production_order.lamination_paper_name', '=', 'lamination_material.id')
    ->leftJoin('materials as lamination_film', 'production_order.lamination_name', '=', 'lamination_film.id')
    ->leftJoin('product_orders', function ($join) {
        $join->on('lamination_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
            ->on('lamination_production_orders.product_id', '=', 'product_orders.product_id');
    })
    ->leftJoin('customer_orders', 'lamination_production_orders.customer_order_id', '=', 'customer_orders.id')
    ->leftJoin('materials', 'products.packing_material_type', '=', 'materials.id')
    ->where('lamination_production_orders.status', $status)
    ->whereIn('products.category', ['1', '2'])
    ->get();

    if ($laminationOrders->isEmpty()) {
        return response()->json([
            'status' => 0,
            'requestCode' => 404,
            'message' => 'No lamination production orders found for the given status',
        ]);
    }

    // Add calculated fields
    $laminationOrders = $laminationOrders->map(function ($order) {
        $rolls_in_1_bdl = floatval($order->rolls_in_1_bdl ?? 0);
        $lamination_material_weight = floatval($order->lamination_material_weight ?? 0);
        $film_weight = floatval($order->film_weight ?? 0);
        $film_width = floatval($order->film_width ?? 0);
        $pending_bundle_qty = floatval($order->pending_bundle_qty ?? 0);
        $production_qty = floatval($order->production_qty ?? 0);
        $length = floatval($order->length ?? 0);
        $width = floatval($order->width ?? 0);
        $lamination_type = $order->lamination_type ?? '';

        // Calculate meter
        $fullMeter = $rolls_in_1_bdl * $production_qty * $length;
        $meter = $fullMeter;
        if (in_array($lamination_type, ['Cutter', 'Strip'])) {
            $meter /= 2; // Divide by 2 for Cutter or Strip
        }
        $order->meter = number_format($meter, 3);

        // Calculate paper_kg
        if ($lamination_material_weight > 0 && $width > 0 && $fullMeter > 0) {
            $step1 = (1000 / $lamination_material_weight);
            $step2 = $step1 * 39.37;
            $step3 = $step2 / $width;
            $step4 = $fullMeter / $step3;

            $order->paper_kg = number_format($step4, 3);
        } else {
            $order->paper_kg = 0; // Set to 0 if any value is invalid
        }

        // Calculate film_kg
        if ($film_weight > 0 && $film_width > 0 && $fullMeter > 0) {
            $step5 = ($film_weight * 1000);
            $step6 = $step5 / $film_width;
            $step7 = $fullMeter / $step6;

            $order->film_kg = number_format($step7, 3);
        } else {
            $order->film_kg = 0; // Set to 0 if any value is invalid
        }

        return $order;
    });

    return response()->json([
        'status' => 1,
        'requestCode' => 200,
        'message' => 'Lamination production orders retrieved successfully',
        'data' => $laminationOrders,
    ]);
}

    


    public function getLaminationOrdersByUser(Request $request)
    {

        $request->validate([
            'customer_id' => 'required|integer|exists:customers,id',
        ]);

        $customerId = $request->input('customer_id');
        $status = $request->input('status');

        $laminationOrdersQuery = LaminationProductionOrder::select(
            'lamination_production_orders.id as lamination_production_order_id',
            'customer_orders.customer_id',
            'customer_orders.id as customer_order_id',
            'customer_orders.order_id',
            'products.product_name',
            'lamination_production_orders.created_at as date',
            'production_order.lamination_type',
            'products.gsm',
            'lamination_production_orders.id as production_order_id',
            'production_order.bundle_quantity as production_qty',
            'production_order.pending_bundle_qty',
            'product_orders.colour as color',
            'products.alias_sku',
            'products.length',
            'products.width',
            'products.number_of_bags_per_box as bags_per_bdl',
            'materials.material_name',
            'products.pipe_size',
            'products.gage',
            'lamination_production_orders.machine',
            'lamination_production_orders.status',    
            'customer_orders.total_bundle as total_order_qty', 
        )
        ->leftJoin('products', 'lamination_production_orders.product_id', '=', 'products.id')
        ->leftJoin('production_order', 'lamination_production_orders.production_order_id', '=', 'production_order.id')
        ->leftJoin('product_orders', function($join) {
            $join->on('lamination_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
                ->on('lamination_production_orders.product_id', '=', 'product_orders.product_id');
        })
        ->leftJoin('customer_orders', 'lamination_production_orders.customer_order_id', '=', 'customer_orders.id')
        ->leftJoin('materials', 'products.packing_material_type', '=', 'materials.id')
        ->where('customer_orders.customer_id', $customerId);

        if ($status) {
            $laminationOrdersQuery->where('lamination_production_orders.status', $status);
        }

        $laminationOrders = $laminationOrdersQuery->whereIn('products.category', ['1', '2'])
            ->get();

        if ($laminationOrders->isEmpty()) {
            return response()->json([
                'status' => 0,
                'requestCode' => 404,
                'message' => 'No lamination production orders found for the given customer',
            ]);
        }

        return response()->json([
            'status' => 1,
            'requestCode' => 200,
            'message' => 'Lamination production orders retrieved successfully',
            'data' => $laminationOrders,
        ]);
    }

    public function getExtruderOrdersByStatus(Request $request)
    {
        $request->validate([
            'status' => 'required|string|in:pending,completed,cancelled',
        ]);
    
        $status = $request->input('status');

        $extruderOrders = ExtruderProductionOrder::select(
            'extruder_production_orders.id as extruder_production_order_id',
            'customer_orders.customer_id',
            'customer_orders.id as customer_order_id',
            //'customer_orders.order_id',
            DB::raw("CASE WHEN customer_orders.order_id IS NULL THEN 'self' ELSE customer_orders.order_id END as order_id"),
            DB::raw("CASE WHEN customer_orders.serial_number IS NULL THEN 'self' ELSE customer_orders.serial_number END as serial_number"),
            'products.product_name',
            'extruder_production_orders.created_at as date',
            'products.gage',
            'product_orders.colour as color',
            // 'products.gsm',
            'production_order.id as production_order_id',
            'production_order.bundle_quantity as production_qty',
            'production_order.pending_bundle_qty',
            'extruder_production_orders.lamination_id',
            'products.alias_sku',
            'products.length',
            'products.width',
            'products.number_of_bags_per_box as bags_per_bdl',
            'materials.material_name',
            'products.pipe_size',
            'extruder_production_orders.machine',
            'extruder_production_orders.status',    
            'customer_orders.total_bundle as total_order_qty', 
            // 'customer_orders.status'
        )
        ->leftJoin('lamination_production_orders', 'extruder_production_orders.lamination_id', '=', 'lamination_production_orders.id')
        ->leftJoin('products', 'extruder_production_orders.product_id', '=', 'products.id')
        ->leftJoin('production_order', 'extruder_production_orders.production_order_id', '=', 'production_order.id')
        ->leftJoin('product_orders', function($join) {
            $join->on('extruder_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
                 ->on('extruder_production_orders.product_id', '=', 'product_orders.product_id');
        })
        ->leftJoin('customer_orders', 'extruder_production_orders.customer_order_id', '=', 'customer_orders.id')
        ->leftJoin('materials', 'products.packing_material_type', '=', 'materials.id')
        ->where('extruder_production_orders.status', $status)
        ->get();

        if ($extruderOrders->isEmpty()) {
            return response()->json([
                'status' => 0,
                'requestCode' => 404,
                'message' => 'No extruder production orders found for the given status',
            ]);
        }
    
        return response()->json([
            'status' => 1,
            'requestCode' => 200,
            'message' => 'extruder production orders retrieved successfully',
            'data' => $extruderOrders,
        ]);
    }
    
    public function getExtruderOrdersByUser(Request $request)
    {

        $request->validate([
            'customer_id' => 'required|integer|exists:customers,id',
        ]);

        $customerId = $request->input('customer_id');
        $status = $request->input('status');

        $extruderOrdersQuery = ExtruderProductionOrder::select(
            'extruder_production_orders.id as extruder_production_order_id',
            'customer_orders.customer_id',
            'customer_orders.id as customer_order_id',
            'customer_orders.order_id',
            'products.product_name',
            'extruder_production_orders.created_at as date',
            'products.gage',
            'product_orders.colour as color',
            // 'products.gsm',
            'production_order.id as production_order_id',
            'production_order.bundle_quantity as production_qty',
            'production_order.pending_bundle_qty',
            'extruder_production_orders.lamination_id',
            'products.alias_sku',
            'products.length',
            'products.width',
            'products.number_of_bags_per_box as bags_per_bdl',
            'materials.material_name',
            'products.pipe_size',
            'extruder_production_orders.machine',
            'extruder_production_orders.status',    
            'customer_orders.total_bundle as total_order_qty', 
            // 'customer_orders.status'
        )
        ->leftJoin('lamination_production_orders', 'extruder_production_orders.lamination_id', '=', 'lamination_production_orders.id')
        ->leftJoin('products', 'extruder_production_orders.product_id', '=', 'products.id')
        ->leftJoin('production_order', 'extruder_production_orders.production_order_id', '=', 'production_order.id')
        ->leftJoin('product_orders', function($join) {
            $join->on('extruder_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
                 ->on('extruder_production_orders.product_id', '=', 'product_orders.product_id');
        })
        ->leftJoin('customer_orders', 'extruder_production_orders.customer_order_id', '=', 'customer_orders.id')
        ->leftJoin('materials', 'products.packing_material_type', '=', 'materials.id')
        ->where('customer_orders.customer_id', $customerId);

        if ($status) {
            $extruderOrdersQuery->where('extruder_production_orders.status', $status);
        }

        $extruderOrders = $extruderOrdersQuery->get();

        if ($extruderOrders->isEmpty()) {
            return response()->json([
                'status' => 0,
                'requestCode' => 404,
                'message' => 'No extruder production orders found for the given customer',
            ]);
        }
    
        return response()->json([
            'status' => 1,
            'requestCode' => 200,
            'message' => 'extruder production orders retrieved successfully',
            'data' => $extruderOrders,
        ]);
    }
    
    // public function getRewindingOrdersByStatus(Request $request)
    // {
    //     $request->validate([
    //         'status' => 'required|string|in:pending,completed,cancelled',
    //     ]);
    
    //     $status = $request->input('status');

    //     $rewindingOrders = RewindingProductionOrder::select(
    //         'rewinding_production_orders.id as rewinding_production_order_id',
    //         'customer_orders.customer_id',
    //         'customer_orders.id as customer_order_id',
    //         'customer_orders.order_id',
    //         'products.product_name',
    //         'rewinding_production_orders.created_at as date',
    //         'products.gage',
    //         'product_orders.colour as color',
    //         'production_order.pending_bundle_qty',
    //         'production_order.rewinding_pipe',
    //         'production_order.rewinding_sticker',
    //         'production_order.id as production_order_id',
    //         'production_order.bundle_quantity as production_qty',
    //         'rewinding_production_orders.extruder_id',
    //         'products.alias_sku',
    //         'products.length',
    //         'products.width',
    //         'products.number_of_bags_per_box as bags_per_bdl',
    //         'materials.material_name',
    //         'products.pipe_size',
    //         'rewinding_production_orders.status',    
    //         'customer_orders.total_bundle as total_order_qty', 
    //         // 'customer_orders.status'
    //     )
    //     ->leftJoin('extruder_production_orders', 'rewinding_production_orders.extruder_id', '=', 'extruder_production_orders.id')
    //     ->leftJoin('products', 'rewinding_production_orders.product_id', '=', 'products.id')
    //     ->leftJoin('production_order', 'rewinding_production_orders.production_order_id', '=', 'production_order.id')
    //     ->leftJoin('product_orders', function($join) {
    //         $join->on('rewinding_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
    //              ->on('rewinding_production_orders.product_id', '=', 'product_orders.product_id');
    //     })
    //     ->leftJoin('customer_orders', 'rewinding_production_orders.customer_order_id', '=', 'customer_orders.id')
    //     ->leftJoin('materials', 'products.packing_material_type', '=', 'materials.id')
    //     ->where('rewinding_production_orders.status', $status)
    //     ->get();

    //     if ($rewindingOrders->isEmpty()) {
    //         return response()->json([
    //             'status' => 0,
    //             'requestCode' => 404,
    //             'message' => 'No rewinding production orders found for the given status',
    //         ]);
    //     }
    
    //     return response()->json([
    //         'status' => 1,
    //         'requestCode' => 200,
    //         'message' => 'rewinding production orders retrieved successfully',
    //         'data' => $rewindingOrders,
    //     ]);
    // }

    public function getRewindingOrdersByStatus(Request $request)
{
    $request->validate([
        'status' => 'required|string|in:pending,completed,cancelled',
    ]);

    $status = $request->input('status');

    $rewindingOrders = RewindingProductionOrder::select(
        'rewinding_production_orders.id as rewinding_production_order_id',
        'customer_orders.customer_id',
        'customer_orders.id as customer_order_id',
        //'customer_orders.order_id',
        DB::raw("CASE WHEN customer_orders.order_id IS NULL THEN 'self' ELSE customer_orders.order_id END as order_id"),
        DB::raw("CASE WHEN customer_orders.serial_number IS NULL THEN 'self' ELSE customer_orders.serial_number END as serial_number"),
        'products.product_name',
        'rewinding_production_orders.created_at as date',
        'products.gage',
        'products.master_packing',
        'product_orders.colour as color',
        'production_order.pending_bundle_qty',
        'production_order.rewinding_qty_in_rolls',
        'production_order.rewinding_pipe',
        'production_order.rewinding_sticker',
        'production_order.rewinding_bharti',
        'sticker_material.material_name as rewinding_sticker_name',
        'production_order.id as production_order_id',
        'production_order.bundle_quantity as production_qty',
        'rewinding_production_orders.extruder_id',
        'products.alias_sku',
        'products.length',
        'products.width',
        'products.number_of_bags_per_box as bags_per_bdl',
        'materials.material_name',
        'products.pipe_size',
        'rewinding_production_orders.status',
        'customer_orders.total_bundle as total_order_qty'
    )
        ->leftJoin('extruder_production_orders', 'rewinding_production_orders.extruder_id', '=', 'extruder_production_orders.id')
        ->leftJoin('products', 'rewinding_production_orders.product_id', '=', 'products.id')
        ->leftJoin('production_order', 'rewinding_production_orders.production_order_id', '=', 'production_order.id')
        ->leftJoin('product_orders', function ($join) {
            $join->on('rewinding_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
                 ->on('rewinding_production_orders.product_id', '=', 'product_orders.product_id');
        })
        ->leftJoin('customer_orders', 'rewinding_production_orders.customer_order_id', '=', 'customer_orders.id')
        ->leftJoin('materials', 'products.packing_material_type', '=', 'materials.id')
        ->leftJoin('materials as sticker_material', 'production_order.rewinding_sticker', '=', 'sticker_material.id') // Added join for rewinding sticker
        ->where('rewinding_production_orders.status', $status)
        ->get();

    if ($rewindingOrders->isEmpty()) {
        return response()->json([
            'status' => 0,
            'requestCode' => 404,
            'message' => 'No rewinding production orders found for the given status',
        ]);
    }

    return response()->json([
        'status' => 1,
        'requestCode' => 200,
        'message' => 'Rewinding production orders retrieved successfully',
        'data' => $rewindingOrders,
    ]);
}



    public function getRewindingOrdersByUser(Request $request)
    {

        $request->validate([
            'customer_id' => 'required|integer|exists:customers,id',
        ]);

        $customerId = $request->input('customer_id');
        $status = $request->input('status');

        $rewindingOrdersQuery = RewindingProductionOrder::select(
            'rewinding_production_orders.id as rewinding_production_order_id',
            'customer_orders.customer_id',
            'customer_orders.id as customer_order_id',
            'customer_orders.order_id',
            'products.product_name',
            'rewinding_production_orders.created_at as date',
            'products.gage',
            'products.master_packing',
            'product_orders.colour as color',
            'production_order.pending_bundle_qty',
            'production_order.rewinding_pipe',
            'production_order.rewinding_sticker',
            'production_order.rewinding_bharti',
            'production_order.id as production_order_id',
            'production_order.bundle_quantity as production_qty',
            'rewinding_production_orders.extruder_id',
            'products.alias_sku',
            'products.length',
            'products.width',
            'products.number_of_bags_per_box as bags_per_bdl',
            'materials.material_name',
            'products.pipe_size',
            'rewinding_production_orders.status',    
            'customer_orders.total_bundle as total_order_qty', 
            // 'customer_orders.status'
        )
        ->leftJoin('extruder_production_orders', 'rewinding_production_orders.extruder_id', '=', 'extruder_production_orders.id')
        ->leftJoin('products', 'rewinding_production_orders.product_id', '=', 'products.id')
        ->leftJoin('production_order', 'rewinding_production_orders.production_order_id', '=', 'production_order.id')
        ->leftJoin('product_orders', function($join) {
            $join->on('rewinding_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
                 ->on('rewinding_production_orders.product_id', '=', 'product_orders.product_id');
        })
        ->leftJoin('customer_orders', 'rewinding_production_orders.customer_order_id', '=', 'customer_orders.id')
        ->leftJoin('materials', 'products.packing_material_type', '=', 'materials.id')
        ->where('customer_orders.customer_id', $customerId);

        if ($status) {
            $rewindingOrdersQuery->where('rewinding_production_orders.status', $status);
        }

        $rewindingOrders = $rewindingOrdersQuery->get();

        if ($rewindingOrders->isEmpty()) {
            return response()->json([
                'status' => 0,
                'requestCode' => 404,
                'message' => 'No rewinding production orders found for the given customer',
            ]);
        }
    
        return response()->json([
            'status' => 1,
            'requestCode' => 200,
            'message' => 'rewinding production orders retrieved successfully',
            'data' => $rewindingOrders,
        ]);
    }

    public function getStitchingOrdersByStatus(Request $request)
    {
        $request->validate([
            'status' => 'required|string|in:pending,completed,cancelled',
        ]);
    
        $status = $request->input('status');

        $stitchingOrders = stitchingProductionOrder::select(
            'stitching_production_orders.id as stitching_production_order_id',
            'customer_orders.customer_id',
            'customer_orders.id as customer_order_id',
            //'customer_orders.order_id',
            DB::raw("CASE WHEN customer_orders.order_id IS NULL THEN 'self' ELSE customer_orders.order_id END as order_id"),
            DB::raw("CASE WHEN customer_orders.serial_number IS NULL THEN 'self' ELSE customer_orders.serial_number END as serial_number"),
            'products.product_name',
            'stitching_production_orders.created_at as date',
            'products.number_of_bags_per_box as bags_per_bdl',
            'product_orders.colour as color',
            'customer_orders.total_bundle as total_order_qty', 
            'products.gage',
            'production_order.pending_bundle_qty',
            'production_order.id as production_order_id',
            'production_order.bundle_quantity as production_qty',
            'stitching_production_orders.packing_id',
            'products.alias_sku',
            'products.length',
            'products.width',
            'materials.material_name',
            'products.pipe_size',
            'stitching_production_orders.status',    
            // 'customer_orders.status'
        )
        ->leftJoin('packing_production_orders', 'stitching_production_orders.packing_id', '=', 'packing_production_orders.id')
        ->leftJoin('products', 'stitching_production_orders.product_id', '=', 'products.id')
        ->leftJoin('production_order', 'stitching_production_orders.production_order_id', '=', 'production_order.id')
        ->leftJoin('product_orders', function($join) {
            $join->on('stitching_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
                 ->on('stitching_production_orders.product_id', '=', 'product_orders.product_id');
        })
        ->leftJoin('customer_orders', 'stitching_production_orders.customer_order_id', '=', 'customer_orders.id')
        ->leftJoin('materials', 'products.packing_material_type', '=', 'materials.id')
        ->where('stitching_production_orders.status', $status)
        ->get();

        if ($stitchingOrders->isEmpty()) {
            return response()->json([
                'status' => 0,
                'requestCode' => 404,
                'message' => 'No stitching production orders found for the given status',
            ]);
        }
    
        return response()->json([
            'status' => 1,
            'requestCode' => 200,
            'message' => 'Stitching production orders retrieved successfully',
            'data' => $stitchingOrders,
        ]);
    }

    public function getStitchingOrdersByUser(Request $request)
    {

        $request->validate([
            'customer_id' => 'required|integer|exists:customers,id',
        ]);

        $customerId = $request->input('customer_id');
        $status = $request->input('status');

        $stitchingOrdersQuery = stitchingProductionOrder::select(
            'stitching_production_orders.id as stitching_production_order_id',
            'customer_orders.customer_id',
            'customer_orders.id as customer_order_id',
            'customer_orders.order_id',
            'products.product_name',
            'stitching_production_orders.created_at as date',
            'products.number_of_bags_per_box as bags_per_bdl',
            'product_orders.colour as color',
            'customer_orders.total_bundle as total_order_qty', 
            'products.gage',
            'production_order.pending_bundle_qty',
            'production_order.id as production_order_id',
            'production_order.bundle_quantity as production_qty',
            'stitching_production_orders.packing_id',
            'products.alias_sku',
            'products.length',
            'products.width',
            'materials.material_name',
            'products.pipe_size',
            'stitching_production_orders.status',    
            // 'customer_orders.status'
        )
        ->leftJoin('rewinding_production_orders', 'stitching_production_orders.packing_id', '=', 'rewinding_production_orders.id')
        ->leftJoin('products', 'stitching_production_orders.product_id', '=', 'products.id')
        ->leftJoin('production_order', 'stitching_production_orders.production_order_id', '=', 'production_order.id')
        ->leftJoin('product_orders', function($join) {
            $join->on('stitching_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
                 ->on('stitching_production_orders.product_id', '=', 'product_orders.product_id');
        })
        ->leftJoin('customer_orders', 'stitching_production_orders.customer_order_id', '=', 'customer_orders.id')
        ->leftJoin('materials', 'products.packing_material_type', '=', 'materials.id')
        ->where('customer_orders.customer_id', $customerId);

        if ($status) {
            $stitchingOrdersQuery->where('stitching_production_orders.status', $status);
        }

        $stitchingOrders = $stitchingOrdersQuery->get();

        if ($stitchingOrders->isEmpty()) {
            return response()->json([
                'status' => 0,
                'requestCode' => 404,
                'message' => 'No stitching production orders found for the given customer',
            ]);
        }
    
        return response()->json([
            'status' => 1,
            'requestCode' => 200,
            'message' => 'Stitching production orders retrieved successfully',
            'data' => $stitchingOrders,
        ]);
    }

    public function getPackingOrdersByStatus(Request $request)
    {
        $request->validate([
            'status' => 'required|string|in:pending,completed,cancelled',
        ]);
    
        $status = $request->input('status');

        $packingOrders = PackingProductionOrder::select(
            'packing_production_orders.id as packing_production_order_id',
            'customer_orders.customer_id',
            'customer_orders.id as customer_order_id',
            //'customer_orders.order_id',
            DB::raw("CASE WHEN customer_orders.order_id IS NULL THEN 'self' ELSE customer_orders.order_id END as order_id"),
            DB::raw("CASE WHEN customer_orders.serial_number IS NULL THEN 'self' ELSE customer_orders.serial_number END as serial_number"),
            'products.product_name',
            'packing_production_orders.created_at as date',
            'product_orders.colour as color',
            'products.length',
            'products.width',
            'products.bdl_kg',
            'products.pipe_size',
            'products.rolls_in_1_bdl',
            'production_order.packing_name',
            'production_order.sticching_packing_type',
            'production_order.packing_sticker',
            'production_order.packing_carton',
            'production_order.packing_bharti',
            'customer_orders.total_bundle as total_order_qty', 
            'products.number_of_bags_per_box as bags_per_bdl',
            'products.gage',
            'production_order.pending_bundle_qty',
            'production_order.id as production_order_id',
            'production_order.bundle_quantity as production_qty',
            'packing_production_orders.rewinding_id',
            'products.alias_sku',
            'materials.material_name',
            'packing_production_orders.status',
            DB::raw('ROUND(products.bdl_kg * 0.97, 2) as MIN'),
            DB::raw('ROUND(products.bdl_kg / 1.03, 2) as MAX')    
            // 'customer_orders.status'
        )
        ->leftJoin('stitching_production_orders', 'packing_production_orders.rewinding_id', '=', 'stitching_production_orders.id')
        ->leftJoin('products', 'packing_production_orders.product_id', '=', 'products.id')
        ->leftJoin('production_order', 'packing_production_orders.production_order_id', '=', 'production_order.id')
        ->leftJoin('product_orders', function($join) {
            $join->on('packing_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
                 ->on('packing_production_orders.product_id', '=', 'product_orders.product_id');
        })
        ->leftJoin('customer_orders', 'packing_production_orders.customer_order_id', '=', 'customer_orders.id')
        ->leftJoin('materials', 'products.packing_material_type', '=', 'materials.id')
        ->where('packing_production_orders.status', $status)
        ->get();

        if ($packingOrders->isEmpty()) {
            return response()->json([
                'status' => 0,
                'requestCode' => 404,
                'message' => 'No packing production orders found for the given status',
            ]);
        }
    
        return response()->json([
            'status' => 1,
            'requestCode' => 200,
            'message' => 'Packing production orders retrieved successfully',
            'data' => $packingOrders,
        ]);
    }

    public function getPackingOrdersByUser(Request $request)
    {

        $request->validate([
            'customer_id' => 'required|integer|exists:customers,id',
        ]);

        $customerId = $request->input('customer_id');
        $status = $request->input('status');

        $packingOrdersQuery = PackingProductionOrder::select(
            'packing_production_orders.id as packing_production_order_id',
            'customer_orders.customer_id',
            'customer_orders.id as customer_order_id',
            'customer_orders.order_id',
            'products.product_name',
            'packing_production_orders.created_at as date',
            'product_orders.colour as color',
            'products.length',
            'products.width',
            'products.pipe_size',
            'production_order.packing_name',
            'customer_orders.total_bundle as total_order_qty', 
            'products.number_of_bags_per_box as bags_per_bdl',
            'products.gage',
            'production_order.pending_bundle_qty',
            'production_order.id as production_order_id',
            'production_order.bundle_quantity as production_qty',
            'packing_production_orders.rewinding_id',
            'products.alias_sku',
            'materials.material_name',
            'packing_production_orders.status',    
            // 'customer_orders.status'
        )
        ->leftJoin('rewinding_production_orders', 'packing_production_orders.rewinding_id', '=', 'rewinding_production_orders.id')
        ->leftJoin('products', 'packing_production_orders.product_id', '=', 'products.id')
        ->leftJoin('production_order', 'packing_production_orders.production_order_id', '=', 'production_order.id')
        ->leftJoin('product_orders', function($join) {
            $join->on('packing_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
                 ->on('packing_production_orders.product_id', '=', 'product_orders.product_id');
        })
        ->leftJoin('customer_orders', 'packing_production_orders.customer_order_id', '=', 'customer_orders.id')
        ->leftJoin('materials', 'products.packing_material_type', '=', 'materials.id')
        ->where('customer_orders.customer_id', $customerId);

        if ($status) {
            $packingOrdersQuery->where('packing_production_orders.status', $status);
        }

        $packingOrders = $packingOrdersQuery->get();

        if ($packingOrders->isEmpty()) {
            return response()->json([
                'status' => 0,
                'requestCode' => 404,
                'message' => 'No packing production orders found for the given customer',
            ]);
        }
    
        return response()->json([
            'status' => 1,
            'requestCode' => 200,
            'message' => 'Packing production orders retrieved successfully',
            'data' => $packingOrders,
        ]);
    }
   
    public function setRewindingProductionDetails(Request $request)
    {
        $formData = $request->all();
        $request->validate([
            'production_id' => 'required',
            'pipe' => 'required',
            'sticker' => 'required|string|max:255',
            'quantity_in_rolls' => 'required|integer|min:1',
            'colour' => 'required',
            'width' => 'required',
            'quantity_in_bundle' => 'required|integer|min:1',
            'length' => 'required',
        ]);

        $productionDetail = ProductionOrder::find($formData['production_id']);


        if (!$productionDetail) {
            return response()->json(['error' => 'Production detail not found'], 404);
        }

        $productionDetail->rewinding_pipe = $formData['pipe'];
        $productionDetail->rewinding_sticker = $formData['sticker'];
        $productionDetail->rewinding_qty_in_rolls = $formData['quantity_in_rolls'];
        $productionDetail->rewinding_colour = $formData['colour'];
        $productionDetail->rewinding_width = $formData['width'];
        $productionDetail->rewinding_qty_in_bundle = $formData['quantity_in_bundle'];
        $productionDetail->rewinding_length = $formData['length'];
        $productionDetail->save();

        return response()->json([
            'status' => 1,
            'requestCode' => 200,
            'message' => 'Production details updated successfully',
            'data' => $productionDetail
        ]);
    }

  

    public function getOrderHistoryById(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:customer_orders,id',
        ]);

        $order = CustomerOrder::with('productOrders', 'customer')
                    ->where('id', $request->order_id)
                    ->first();

        if (!$order) {
            return response()->json([
                'requestCode' => 404,
                'status' => 0,
                'message' => 'Order not found',
            ]);
        }

        return response()->json([
            'requestCode' => 200,
            'status' => 1,
            'data' => $order,
        ]);
    }

    public function getUserDetails(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'requestCode' => 404,
                'status' => 0,
                'message' => 'User not found',
            ]);
        }

        return response()->json([
            'requestCode' => 200,
            'status' => 1,
            'data' => [
                'name' => $user->name,
                'role' => $user->role, 
                'phone_number' => $user->phone_number,
                'email' => $user->email,
                'joining_date' => $user->created_at->format('d M Y'),
                'last_login' => $user->last_login ? $user->last_login->format('d M Y, H:i') : 'Never',
            ],
        ]);
    }

    public function getExtruderOrderHistoryById(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:customer_orders,id',
        ]);

        // $order = CustomerOrder::with('productOrders', 'customer')
        //             ->where('id', $request->order_id)
        //             ->first();

        $order = CustomerOrder::select(
            'customer_orders.id as order_id',  
            'customer_orders.created_at as date',
            'products.alias_sku', 
            'products.product_name', 
            'products.gage', 
            'prod_order_type.pending_bundle_qty',
            'colors.name as color',
            'prod_order_company.rewinding_pipe',
            'prod_order_company.rewinding_sticker',
        )
        ->leftjoin('product_orders', 'customer_orders.id', '=', 'product_orders.customer_orders_id')
        ->leftjoin('products', 'product_orders.product_id', '=', 'products.id')
        ->leftjoin('production_order as prod_order_type', 'product_orders.product_id', '=', 'prod_order_type.product_type') // alias prod_order_type
        ->leftjoin('production_order as prod_order_company', 'customer_orders.customer_id', '=', 'prod_order_company.company_name') // alias prod_order_company
        ->leftjoin('colors', 'product_orders.colour', '=', 'colors.id')
        ->where('customer_orders.id', $request->order_id)
            ->whereIn('products.category', ['2', '3', '4'])
            ->get();

        if (!$order) {
            return response()->json([
                'requestCode' => 404,
                'status' => 0,
                'message' => 'Order not found',
            ]);
        }

        return response()->json([
            'requestCode' => 200,
            'status' => 1,
            'data' => $order,
        ]);
    }

    public function signUp(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'group' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'mobile' => 'required|digits:10|unique:users,contect',
            'password' => 'required|string|min:6|confirmed',
            'gstin' => 'required|string|max:255',
            'payment_terms' => 'required|string|max:255',
            'pin' => 'required|string|max:255',
        ]);
    
        $user = User::create([
            'name' => $validated['first_name'],
            'email' => $validated['email'],
            'contect' => $validated['mobile'],
            'password' => bcrypt($validated['password']),
            //'customer_id' => $customer->id, 
            'role_type' => 'sales_manager',        
        ]);

        $customer = Customer::create([
            'user_id' => $user->id,
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'company_name' => $validated['company_name'],
            'contect' => $validated['mobile'],
            'group' => $validated['group'],
            'gstin' => $validated['gstin'],
            'payment_terms' => $validated['payment_terms'],
            'pin' => $validated['pin'],
            'status' => 'inactive', 
        ]);

    
        return response()->json([
            'requestCode' => 200,
            'status' => 1,
            'message' => 'Customer and user created successfully',
            'data' => [
                'customer' => [
                    'name' => $customer->name,
                    'email' => $customer->email,
                    'status' => $customer->status,
                ],
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'role_type' => $user->role_type,
                ],
            ],
        ]);
    }

    public function deleteAccount(Request $request)
    {

        $user = auth()->user();
        if (!$user) {
            return response()->json([
                'requestCode' => 404,
                'status' => 0,
                'message' => 'User not found',
            ]);
        }


        $customer = Customer::find($user->customer_id);

        if ($customer) {

            $customer->delete();
        }


        $user->delete();

        return response()->json([
            'requestCode' => 200,
            'status' => 1,
            'message' => 'Account deleted successfully',
        ]);
    }
    public function termsAndConditions()
    {
        return response()->json([
            'requestCode' => 200,
            'status' => 1,
            'message' => 'Terms and Conditions',
            'data' => [
                'url' => url('/terms-and-conditions'),
            ],
        ]);
    }

    public function privacyPolicy()
    {
        return response()->json([
            'requestCode' => 200,
            'status' => 1,
            'message' => 'Privacy Policy',
            'data' => [
                'url' => url('/privacy-policy'),
            ],
        ]);
    }

    public function forceUpdate(Request $request)
    {
        $validated = $request->validate([
            'apkVersion' => 'required|string',
            'deviceType' => 'required|string',
        ]);

        $latestVersion = '1.2.0';

        if ($validated['apkVersion'] !== $latestVersion) {
            return response()->json([
                'requestCode' => 200,
                'status' => 1,
                'message' => 'Update required',
                'data' => [
                    'latestVersion' => $latestVersion,
                ],
            ]);
        }

        return response()->json([
            'requestCode' => 200,
            'status' => 1,
            'message' => 'No update required',
        ]);
    }
    
    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->tokens()->delete();

        return response()->json(['status' => 1, 'message' => 'Logout successful']);
    }


public function setExtruderOrderCompleted(Request $request)
{
    $request->validate([
        'extruder_production_order_id' => 'required|integer|exists:extruder_production_orders,id',
        'machine' => 'nullable|string|max:191',
        // 'machine' => 'required|string|max:191',
        'date' => 'required|date',
        'shift' => 'nullable|string|max:191',
        'qty' => 'nullable|integer|min:1',
        'size' => 'nullable|string|max:191',
    ]);

    $productionOrderId = $request->input('extruder_production_order_id');
    $extruderOrder = ExtruderProductionOrder::find($productionOrderId);

    if (!$extruderOrder) {
        return response()->json([
            'status' => 0,
            'requestCode' => 404,
            'message' => 'Extruder production order not found',
        ]);
    }

    if ($extruderOrder->status === 'completed') {
        return response()->json([
            'status' => 0,
            'requestCode' => 400,
            'message' => 'Extruder production order is already marked as completed',
        ]);
    }

    $productionOrder = ProductionOrder::find($extruderOrder->production_order_id);

    if (!$productionOrder) {
        return response()->json([
            'status' => 0,
            'requestCode' => 404,
            'message' => 'Associated production order not found',
        ]);
    }

    $previousCompletedQuantity = ExtruderOrderHistory::where('extruder_production_order_id', $extruderOrder->id)
        ->sum('qty');
    $currentQty = $request->input('qty');
    $thisOrdersCompletedQuantity = $previousCompletedQuantity + $currentQty;

    $remainingQty = $productionOrder->bundle_quantity - $previousCompletedQuantity;

    if ($thisOrdersCompletedQuantity > $productionOrder->bundle_quantity) {
        return response()->json([
            'status' => 0,
            'requestCode' => 400,
            'message' => 'Quantity is greater than the required quantity',
            'required_qty' => $productionOrder->bundle_quantity,
            //'previousCompletedQuantity' => $previousCompletedQuantity,
            'remaining' => $remainingQty,
           // 'thisOrdersCompletedQuantity' => $thisOrdersCompletedQuantity
        ]);
    }

    ExtruderOrderHistory::create([
        'extruder_production_order_id' => $extruderOrder->id,
        'machine' => $request->input('machine'),
        'shift' => $request->input('shift'),
        'qty' => $currentQty,
        'size' => $request->input('size'),
        'this_orders_completed_quantity' => $thisOrdersCompletedQuantity,
        'remaining' => $remainingQty,
        'thisOrdersCompletedQuantity' => $thisOrdersCompletedQuantity
    ]);

    if ($thisOrdersCompletedQuantity < $productionOrder->bundle_quantity) {
        return response()->json([
            'status' => 1,
            'requestCode' => 200,
            'message' => 'Data saved to extruder order history due to insufficient bundle quantity',
            'required_qty' => $productionOrder->bundle_quantity,
            //'previousCompletedQuantity' => $previousCompletedQuantity,
            'remaining' => $remainingQty - $currentQty,
            //'thisOrdersCompletedQuantity' => $thisOrdersCompletedQuantity
        ]);
    }


    $extruderOrder->status = 'completed';
    $extruderOrder->machine = $request->input('machine');
    $extruderOrder->date = $request->input('date');
    $extruderOrder->shift = $request->input('shift');
    $extruderOrder->qty = $currentQty;
    $extruderOrder->size = $request->input('size');
    $extruderOrder->save();

    $RewindingProductionOrder = new RewindingProductionOrder([
        'extruder_id' => $extruderOrder->id,
        'production_order_id' => $extruderOrder->production_order_id,
        'customer_order_id' => $extruderOrder->customer_order_id,
        'customer_id' => $extruderOrder->customer_id,
        'product_id' => $extruderOrder->product_id,
        'contractor' => '',
        'date' => $request->input('date'),
        'rolls' => '',
        'remark' => '',
        'status' => 'pending'
    ]);

    $RewindingProductionOrder->save();

    return response()->json([
        'status' => 1,
        'requestCode' => 200,
        'message' => 'Extruder production order status updated to completed and saved to rewinding production order successfully',
        'data' => $extruderOrder,
    ]);
}  

    public function getOrderByExtruderOrderId(Request $request)
    {
        $request->validate([
            'extruder_production_order_id' => 'required|integer|exists:extruder_production_orders,id',
        ]);

        $productionOrderId = $request->input('extruder_production_order_id');
        $extruderOrder = ExtruderProductionOrder::find($productionOrderId);
    
        if (!$extruderOrder) {
            return response()->json([
                'status' => 0,
                'requestCode' => 404,
                'message' => 'Extruder production order not found',
            ]);
        }

        $productionOrder = ProductionOrder::find($extruderOrder->production_order_id);

        if (!$productionOrder) {
            return response()->json([
                'status' => 0,
                'requestCode' => 404,
                'message' => 'Associated production order not found',
            ]);
        }

        $previousCompletedQuantity = ExtruderOrderHistory::where('extruder_production_order_id', $extruderOrder->id)
        ->sum('qty');

        $remainingQty = $productionOrder->bundle_quantity - $previousCompletedQuantity;

        $getExtruderOrderByID = ExtruderOrderHistory::where('extruder_production_order_id', $request->input('extruder_production_order_id'))->get();

        return response()->json([
            'success' => true,
            'data' => $getExtruderOrderByID,
            'required_qty' => $productionOrder->bundle_quantity,
            'remaining' => $remainingQty,
        ], 200);
    }

    //     public function setLaminationOrderCompleted(Request $request)
    // {
    //     $request->validate([
    //         'lamination_production_order_id' => 'required|integer|exists:lamination_production_orders,id',
    //         'machine' => 'nullable|string|max:191',
    //         // 'machine' => 'required|string|max:191',
    //         'date' => 'required|date',
    //         'meter' => 'required|integer|min:1',
            
    //     ]);

    //     $productionOrderId = $request->input('lamination_production_order_id');
    //     $laminationOrder = LaminationProductionOrder::find($productionOrderId);

    //     if (!$laminationOrder) {
    //         return response()->json([
    //             'status' => 0,
    //             'requestCode' => 404,
    //             'message' => 'Lamination production order not found',
    //         ]);
    //     }

    //     if ($laminationOrder->status === 'completed') {
    //         return response()->json([
    //             'status' => 0,
    //             'requestCode' => 400,
    //             'message' => 'Lamination production order is already marked as completed',
    //         ]);
    //     }

    //     $productionOrder = ProductionOrder::find($laminationOrder->production_order_id);

    //     if (!$productionOrder) {
    //         return response()->json([
    //             'status' => 0,
    //             'requestCode' => 404,
    //             'message' => 'Associated production order not found',
    //         ]);
    //     }
    //     $bharti = $productionOrder->rewinding_bharti;
    //     $length = $productionOrder->rewinding_length;
    //     $bundles = $productionOrder->bundle_quantity;
    //     //formula for bundle to meter = bharti*length*bundles;
    //     //formula for meter to bundle = bharti*length*bundles;
    //     $required_meters = $bharti*$length*$bundles;

    //     $previousCompletedQuantity = LaminationOrderHistory::where('Lamination_production_order_id', $laminationOrder->id)
    //         ->sum('meter');
    //     $currentQty = $request->input('meter');
    //     $thisOrdersCompletedQuantity = $previousCompletedQuantity + $currentQty;

    //     if ($thisOrdersCompletedQuantity > $required_meters) {
    //         return response()->json([
    //             'status' => 0,
    //             'requestCode' => 400,
    //             'message' => 'Quantity is greater than the required quantity',
    //             'required_meters' => $required_meters,
    //             'thisOrdersCompletedQuantity' => $thisOrdersCompletedQuantity,
    //         ]);
    //     }

    //     LaminationOrderHistory::create([
    //         'lamination_production_order_id' => $laminationOrder->id,
    //         'machine' => $request->input('machine'),
    //         'date' => $request->input('date'),
    //         'meter' => $request->input('meter'),
    //         'this_orders_completed_quantity' => $thisOrdersCompletedQuantity,
    //         'user_id' => auth()->id()
    //     ]);

    //     if ($thisOrdersCompletedQuantity < $required_meters) {
    //         return response()->json([
    //             'status' => 1,
    //             'requestCode' => 200,
    //             'message' => 'Data saved to lamination order history due to insufficient bundle quantity',
    //             'required_meters' => $required_meters,
    //             'thisOrdersCompletedQuantity' => $thisOrdersCompletedQuantity,
    //         ]);
    //     }

    //     $laminationOrder->status = 'completed';
    //     $laminationOrder->machine = $request->input('machine');
    //     $laminationOrder->date = $request->input('date');
    //     $laminationOrder->meter = $request->input('meter');
    //     $laminationOrder->save();

    //     $RewindingProductionOrder = new RewindingProductionOrder([
    //         'extruder_id' => $laminationOrder->id,
    //         'production_order_id' => $laminationOrder->production_order_id,
    //         'customer_order_id' => $laminationOrder->customer_order_id,
    //         'customer_id' => $laminationOrder->customer_id,
    //         'product_id' => $laminationOrder->product_id,
    //         'contractor' => '',
    //         'date' => $request->input('date'),
    //         'rolls' => '',
    //         'remark' => '',
    //         'status' => 'pending'
    //     ]);

    //     $RewindingProductionOrder->save();

    //     return response()->json([
    //         'status' => 1,
    //         'requestCode' => 200,
    //         'message' => 'Lamination production order status updated to completed and saved to rewinding production order successfully',
    //         'data' => $laminationOrder,
    //     ]);
    // }
    public function setLaminationOrderCompleted(Request $request)
    {
        $request->validate([
            'lamination_production_order_id' => 'required|integer|exists:lamination_production_orders,id',
            'machine' => 'nullable|string|max:191',
            'date' => 'required|date',
            'meter' => 'required|integer|min:1',
        ]);
    
        $productionOrderId = $request->input('lamination_production_order_id');
        $laminationOrder = LaminationProductionOrder::find($productionOrderId);
    
        if (!$laminationOrder) {
            return response()->json([
                'status' => 0,
                'requestCode' => 404,
                'message' => 'Lamination production order not found',
            ]);
        }
    
        if ($laminationOrder->status === 'completed') {
            return response()->json([
                'status' => 0,
                'requestCode' => 400,
                'message' => 'Lamination production order is already marked as completed',
            ]);
        }
    
        $productionOrder = ProductionOrder::find($laminationOrder->production_order_id);
    
        if (!$productionOrder) {
            return response()->json([
                'status' => 0,
                'requestCode' => 404,
                'message' => 'Associated production order not found',
            ]);
        }
    
        $bharti = $productionOrder->rewinding_bharti;
        $length = $productionOrder->rewinding_length;
        $bundles = $productionOrder->bundle_quantity;
    
        // Formula for required meters: bharti * length * bundles
        $required_meters = $bharti * $length * $bundles;
    
        $previousCompletedQuantity = LaminationOrderHistory::where('lamination_production_order_id', $laminationOrder->id)
            ->sum('meter');
        $currentQty = $request->input('meter');
        $remainingQty = $required_meters - $previousCompletedQuantity;
    
        // Prevent any input that exceeds the remaining quantity
        if ($currentQty > $remainingQty) {
            return response()->json([
                'status' => 0,
                'requestCode' => 400,
                'message' => 'Quantity exceeds the remaining allowable quantity',
                'required_meters' => $required_meters,
                'thisOrdersCompletedQuantity' => $previousCompletedQuantity + $currentQty,
                'remaining_meters' => $remainingQty,
            ]);
        }
    
        $thisOrdersCompletedQuantity = $previousCompletedQuantity + $currentQty;
    
        // Save the new entry to the history table
        LaminationOrderHistory::create([
            'lamination_production_order_id' => $laminationOrder->id,
            'machine' => $request->input('machine'),
            'date' => $request->input('date'),
            'meter' => $currentQty,
            'this_orders_completed_quantity' => $thisOrdersCompletedQuantity,
            'user_id' => auth()->id(),
        ]);
    
        // Check if the order is fully completed
        if ($thisOrdersCompletedQuantity == $required_meters) {
            $laminationOrder->status = 'completed';
            $laminationOrder->machine = $request->input('machine');
            $laminationOrder->date = $request->input('date');
            $laminationOrder->meter = $thisOrdersCompletedQuantity;
            $laminationOrder->save();
    
            $RewindingProductionOrder = new RewindingProductionOrder([
                'extruder_id' => $laminationOrder->id,
                'production_order_id' => $laminationOrder->production_order_id,
                'customer_order_id' => $laminationOrder->customer_order_id,
                'customer_id' => $laminationOrder->customer_id,
                'product_id' => $laminationOrder->product_id,
                'contractor' => '',
                'date' => $request->input('date'),
                'rolls' => '',
                'remark' => '',
                'status' => 'pending',
            ]);
    
            $RewindingProductionOrder->save();
    
            return response()->json([
                'status' => 1,
                'requestCode' => 200,
                'message' => 'Lamination production order status updated to completed and saved to rewinding production order successfully',
                'data' => $laminationOrder,
            ]);
        }
    
        return response()->json([
            'status' => 1,
            'requestCode' => 200,
            'message' => 'Data saved to lamination order history due to insufficient bundle quantity',
            'required_meters' => $required_meters,
            'thisOrdersCompletedQuantity' => $thisOrdersCompletedQuantity,
            'remaining_meters' => $remainingQty - $currentQty,
        ]);
    }
    
    public function getOrderByLaminationOrderId(Request $request)
    {
        $request->validate([
            'lamination_production_order_id' => 'required|integer|exists:lamination_production_orders,id',
        ]);

        $productionOrderId = $request->input('lamination_production_order_id');
        $laminationOrder = LaminationProductionOrder::find($productionOrderId);
        if (!$laminationOrder) {
            return response()->json([
                'status' => 0,
                'requestCode' => 404,
                'message' => 'Lamination production order not found',
            ]);
        }
        $productionOrder = ProductionOrder::find($laminationOrder->production_order_id);
        if (!$productionOrder) {
            return response()->json([
                'status' => 0,
                'requestCode' => 404,
                'message' => 'Associated production order not found',
            ]);
        }

        $bharti = $productionOrder->rewinding_bharti;
        $length = $productionOrder->rewinding_length;
        $bundles = $productionOrder->bundle_quantity;
    
        // Formula for required meters: bharti * length * bundles
        $required_meters = $bharti * $length * $bundles;

            
        $previousCompletedQuantity = LaminationOrderHistory::where('lamination_production_order_id', $laminationOrder->id)
            ->sum('meter');
        $remainingQty = $required_meters - $previousCompletedQuantity;

        $getLaminationOrderByID = LaminationOrderHistory::where('lamination_production_order_id', $request->input('lamination_production_order_id'))->get();

        return response()->json([
            'success' => true,
            'data' => $getLaminationOrderByID,
            'required_meters' => $required_meters,
            'remainingQty' => $remainingQty,

        ], 200);
    }

    public function setRewindingOrderCompleted(Request $request)
    {
        $request->validate([
            'rewinding_production_order_id' => 'required|integer|exists:rewinding_production_orders,id',
            'contractor' => 'required|string|max:191',
            'date' => 'required|date',
            'rolls' => 'required|integer|min:1',
            'remark' => 'nullable|string',
        ]);

        $productionOrderId = $request->input('rewinding_production_order_id');
        $rewindingOrder = RewindingProductionOrder::find($productionOrderId);

        if (!$rewindingOrder) {
            return response()->json([
                'status' => 0,
                'requestCode' => 404,
                'message' => 'Rewinding production order not found',
            ]);
        }

        if ($rewindingOrder->status === 'completed') {
            return response()->json([
                'status' => 0,
                'requestCode' => 400,
                'message' => 'Rewinding production order is already marked as completed',
            ]);
        }

        $productionOrder = ProductionOrder::find($rewindingOrder->production_order_id);

        if (!$productionOrder) {
            return response()->json([
                'status' => 0,
                'requestCode' => 404,
                'message' => 'Associated production order not found',
            ]);
        }

        $previousCompletedQuantity = RewindingOrderHistory::where('Rewinding_production_order_id', $rewindingOrder->id)
            ->sum('rolls');
        $currentQty = $request->input('rolls');
        $thisOrdersCompletedQuantity = $previousCompletedQuantity + $currentQty;

        $remainingQty = $productionOrder->bundle_quantity - $previousCompletedQuantity;

        if ($thisOrdersCompletedQuantity > $productionOrder->bundle_quantity) {
            return response()->json([
                'status' => 0,
                'requestCode' => 400,
                'message' => 'Quantity is greater than the required quantity',
                'required_qty' => $productionOrder->bundle_quantity,
                'remaining' => $remainingQty,
            ]);
        }

        RewindingOrderHistory::create([
            'rewinding_production_order_id' => $rewindingOrder->id,
            'contractor' => $request->input('contractor'),
            'date' => $request->input('date'),
            'rolls' => $request->input('rolls'),
            'remark' => $request->input('remark'),
            'this_orders_completed_quantity' => $thisOrdersCompletedQuantity
        ]);

        if ($thisOrdersCompletedQuantity < $productionOrder->bundle_quantity) {
            return response()->json([
                'status' => 1,
                'requestCode' => 200,
                'message' => 'Data saved to rewinding order history due to insufficient bundle quantity',
                'required_qty' => $productionOrder->bundle_quantity,
                'remaining' => $remainingQty - $currentQty,
            ]);
        }

        $rewindingOrder->status = 'completed';
        $rewindingOrder->save();

        //        $StitchingProductionOrder = new StitchingProductionOrder([
        //     'rewinding_id' => $rewindingOrder->id ?? '',
        //     'production_order_id' => $rewindingOrder->production_order_id ?? '',
        //     'customer_order_id' => $rewindingOrder->customer_order_id ?? '',
        //     'customer_id' => $rewindingOrder->customer_id ?? '',
        //     'product_id' => $rewindingOrder->product_id ?? '',
        //     'labour_name' => '',
        //     'date' => '',
        //     'bundle_qty' => '',
        //     'qty_per_bdl' => '',
        //     'remark' => '',
        //     'status' => 'pending',
        // ]);

        // $StitchingProductionOrder->save();
        $PackingProductionOrder = new PackingProductionOrder([
            'rewinding_id' => $rewindingOrder->id ?? '',
            'production_order_id' => $rewindingOrder->production_order_id ?? '',
            'customer_order_id' => $rewindingOrder->customer_order_id ?? '',
            'customer_id' => $rewindingOrder->customer_id ?? '',
            'product_id' => $rewindingOrder->product_id ?? '',
            'labour_name' => '',
            'date' => '',
            'bags_per_box_qty' => '',
            'steping_required' => '',
            'status' => 'pending',
        ]);

        $PackingProductionOrder->save();

        return response()->json([
            'status' => 1,
            'requestCode' => 200,
            'message' => 'Rewinding production order status updated to completed and saved to packing production order successfully',
            'data' => $rewindingOrder,
        ]);
    }

    public function getOrderByRewindingOrderId(Request $request)
    {
        $request->validate([
            'rewinding_production_order_id' => 'required|integer|exists:rewinding_production_orders,id',
        ]);

        $productionOrderId = $request->input('rewinding_production_order_id');
        $rewindingOrder = RewindingProductionOrder::find($productionOrderId);

        if (!$rewindingOrder) {
            return response()->json([
                'status' => 0,
                'requestCode' => 404,
                'message' => 'Rewinding production order not found',
            ]);
        }

        $productionOrder = ProductionOrder::find($rewindingOrder->production_order_id);

        if (!$productionOrder) {
            return response()->json([
                'status' => 0,
                'requestCode' => 404,
                'message' => 'Associated production order not found',
            ]);
        }

        $previousCompletedQuantity = RewindingOrderHistory::where('Rewinding_production_order_id', $rewindingOrder->id)
            ->sum('rolls');

        $remainingQty = $productionOrder->bundle_quantity - $previousCompletedQuantity;

        $getRewindingOrderByID = RewindingOrderHistory::where('rewinding_production_order_id', $request->input('rewinding_production_order_id'))->get();

        return response()->json([
            'success' => true,
            'data' => $getRewindingOrderByID,
            'required_qty' => $productionOrder->bundle_quantity,
            'remaining' => $remainingQty,
        ], 200);
    }

    public function setPackingOrderCompleted(Request $request)
    {
        $request->validate([
            'packing_production_order_id' => 'required|integer|exists:packing_production_orders,id',
            'labour_name' => 'nullable|string|max:191',
            'date' => 'nullable|date',
            'bags_per_box_qty' => 'nullable|string|max:191',
            'steping_required' => 'nullable|string|max:191',
            'remark' => 'nullable|string|max:191',
        ]);

        $productionOrderId = $request->input('packing_production_order_id');
        $packingOrder = PackingProductionOrder::find($productionOrderId);

        if (!$packingOrder) {
            return response()->json([
                'status' => 0,
                'requestCode' => 404,
                'message' => 'Packing production order not found',
            ]);
        }

        if ($packingOrder->status === 'completed') {
            return response()->json([
                'status' => 0,
                'requestCode' => 400,
                'message' => 'Packing production order is already marked as completed',
            ]);
        }

        $productionOrder = ProductionOrder::find($packingOrder->production_order_id);

        if (!$productionOrder) {
            return response()->json([
                'status' => 0,
                'requestCode' => 404,
                'message' => 'Associated production order not found',
            ]);
        }

        $previousCompletedQuantity = PackingOrderHistory::where('Packing_production_order_id', $packingOrder->id)
            ->sum('bags_per_box_qty');
        $currentQty = $request->input('bags_per_box_qty');
        $thisOrdersCompletedQuantity = $previousCompletedQuantity + $currentQty;

        $remainingQty = $productionOrder->bundle_quantity - $previousCompletedQuantity;

        if ($thisOrdersCompletedQuantity > $productionOrder->bundle_quantity) {
            return response()->json([
                'status' => 0,
                'requestCode' => 400,
                'message' => 'Quantity is greater than the required quantity',
                'required_qty' => $productionOrder->bundle_quantity,
                'remaining' => $remainingQty,
            ]);
        }

        PackingOrderHistory::create([
            'packing_production_order_id' => $packingOrder->id,
            'labour_name' => $request->input('labour_name'),
            'date' => $request->input('date'),
            'bags_per_box_qty' => $request->input('bags_per_box_qty'),
            'remark' => $request->input('remark'),
            'steping_required' => $request->input('steping_required'),
            'this_orders_completed_quantity' => $thisOrdersCompletedQuantity
        ]);

        if ($thisOrdersCompletedQuantity < $productionOrder->bundle_quantity) {
            return response()->json([
                'status' => 1,
                'requestCode' => 200,
                'message' => 'Data saved to Packing order history due to insufficient bundle quantity',
                'required_qty' => $productionOrder->bundle_quantity,
                'remaining' => $remainingQty - $currentQty,
            ]);
        }

        $packingOrder->status = 'completed';
        $packingOrder->save();

        $StitchingProductionOrder = new StitchingProductionOrder([
            'packing_id' => $packingOrder->id ?? '',
            'production_order_id' => $packingOrder->production_order_id ?? '',
            'customer_order_id' => $packingOrder->customer_order_id ?? '',
            'customer_id' => $packingOrder->customer_id ?? '',
            'product_id' => $packingOrder->product_id ?? '',
            // 'labour_name' => '',
            // 'date' => '',
            // 'bundle_qty' => '',
            // 'qty_per_bdl' => '',
            // 'remark' => '',
             'status' => 'pending',
        ]);

        $StitchingProductionOrder->save();

        return response()->json([
            'status' => 1,
            'requestCode' => 200,
            'message' => 'Packing production order status updated to completed and saved to stitching production order successfully',
            'data' => $packingOrder,
        ]);
    }

    public function getOrderByPackingOrderId(Request $request)
    {
        $request->validate([
            'packing_production_order_id' => 'required|integer|exists:packing_production_orders,id',
        ]);

        $productionOrderId = $request->input('packing_production_order_id');
        $packingOrder = PackingProductionOrder::find($productionOrderId);

        if (!$packingOrder) {
            return response()->json([
                'status' => 0,
                'requestCode' => 404,
                'message' => 'Packing production order not found',
            ]);
        }

        $productionOrder = ProductionOrder::find($packingOrder->production_order_id);

        if (!$productionOrder) {
            return response()->json([
                'status' => 0,
                'requestCode' => 404,
                'message' => 'Associated production order not found',
            ]);
        }

        $previousCompletedQuantity = PackingOrderHistory::where('Packing_production_order_id', $packingOrder->id)
            ->sum('bags_per_box_qty');

        $remainingQty = $productionOrder->bundle_quantity - $previousCompletedQuantity;

        $getPackingOrderByID = PackingOrderHistory::where('packing_production_order_id', $request->input('packing_production_order_id'))->get();

        return response()->json([
            'success' => true,
            'data' => $getPackingOrderByID,
            'required_qty' => $productionOrder->bundle_quantity,
            'remaining' => $remainingQty,
        ], 200);
    }

    public function setStitchingOrderCompleted(Request $request)
    {
        try {
            $request->validate([
                'stitching_production_order_id' => 'required|integer|exists:stitching_production_orders,id',
                'labour_name' => 'required|string|max:191',
                'date' => 'required|date',
                'bdl_qty' => 'required|integer|min:1',
                'qty_per_bdl' => 'required|integer|min:1',
                'remark' => 'nullable|string',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 0,
                'requestCode' => 422,
                'message' => 'Validation error',
                'errors' => $e->errors(),
            ], 422);
        }

        $productionOrderId = $request->input('stitching_production_order_id');
        $stitchingOrder = StitchingProductionOrder::find($productionOrderId);

        if (!$stitchingOrder) {
            return response()->json([
                'status' => 0,
                'requestCode' => 404,
                'message' => 'Stitching production order not found',
            ]);
        }

        if ($stitchingOrder->status === 'completed') {
            return response()->json([
                'status' => 0,
                'requestCode' => 400,
                'message' => 'Stitching production order is already marked as completed',
            ]);
        }

        $productionOrder = ProductionOrder::find($stitchingOrder->production_order_id);

        if (!$productionOrder) {
            return response()->json([
                'status' => 0,
                'requestCode' => 404,
                'message' => 'Associated production order not found',
            ]);
        }

        $previousCompletedQuantity = StitchingOrderHistory::where('stitching_production_order_id', $stitchingOrder->id)
            ->sum('bdl_qty');
        $currentQty = $request->input('bdl_qty');
        $thisOrdersCompletedQuantity = $previousCompletedQuantity + $currentQty;
        $remainingQty = $productionOrder->bundle_quantity - $previousCompletedQuantity;

        if ($thisOrdersCompletedQuantity > $productionOrder->bundle_quantity) {
            return response()->json([
                'status' => 0,
                'requestCode' => 400,
                'message' => 'Quantity is greater than the required quantity',
                'required_qty' => $productionOrder->bundle_quantity,
                'remaining' => $remainingQty,
            ]);
        }

        StitchingOrderHistory::create([
            'stitching_production_order_id' => $stitchingOrder->id,
            'labour_name' => $request->input('labour_name'),
            'date' => $request->input('date'),
            'bdl_qty' => $request->input('bdl_qty'),
            'qty_per_bdl' => $request->input('qty_per_bdl'),
            'remark' => $request->input('remark'),
            'this_orders_completed_quantity' => $thisOrdersCompletedQuantity
        ]);

        if ($thisOrdersCompletedQuantity < $productionOrder->bundle_quantity) {
            return response()->json([
                'status' => 1,
                'requestCode' => 200,
                'message' => 'Data saved to stitching order history due to insufficient bundle quantity',
                'required_qty' => $productionOrder->bundle_quantity,
                'remaining' => $remainingQty - $currentQty,
            ]);
        }

        $stitchingOrder->status = 'completed';

        $stitchingOrder->save();

       $productionOrder = ProductionOrder::find($stitchingOrder->production_order_id);
    
        if ($productionOrder) {
            $productionOrder->status = 'completed';
            $productionOrder->save();
        }
    
        return response()->json([
            'status' => 1,
            'requestCode' => 200,
            'message' => 'Stitching production order and related production order status updated to completed successfully',
            'data' => [
                'stitchingOrder' => $stitchingOrder,
                'productionOrder' => $productionOrder,
            ],
        ]);
    }

    public function getOrderByStitchingOrderId(Request $request)
    {
        try {
            $request->validate([
                'stitching_production_order_id' => 'required|integer|exists:stitching_production_orders,id',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 0,
                'requestCode' => 422,
                'message' => 'Validation error',
                'errors' => $e->errors(),
            ], 422);
        }

        $productionOrderId = $request->input('stitching_production_order_id');
        $stitchingOrder = StitchingProductionOrder::find($productionOrderId);

        if (!$stitchingOrder) {
            return response()->json([
                'status' => 0,
                'requestCode' => 404,
                'message' => 'Stitching production order not found',
            ]);
        }


        $productionOrder = ProductionOrder::find($stitchingOrder->production_order_id);

        if (!$productionOrder) {
            return response()->json([
                'status' => 0,
                'requestCode' => 404,
                'message' => 'Associated production order not found',
            ]);
        }

        $previousCompletedQuantity = StitchingOrderHistory::where('stitching_production_order_id', $stitchingOrder->id)
            ->sum('bdl_qty');

        $remainingQty = $productionOrder->bundle_quantity - $previousCompletedQuantity;

        $getStitchingOrderByID = StitchingOrderHistory::where('stitching_production_order_id', $request->input('stitching_production_order_id'))->get();

        return response()->json([
            'success' => true,
            'data' => $getStitchingOrderByID,
            'required_qty' => $productionOrder->bundle_quantity,
            'remaining' => $remainingQty,
        ], 200);
    }

    public function getMaterialCategories()
    {
        $materialCategories = MaterialCategory::all();
    
        if ($materialCategories->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No material categories found.'], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $materialCategories
        ], 200);
    }
    
    public function getMaterialSubCategoriesByCategoryId(Request $request)
    {
        $validatedData = $request->validate([
            'parent_category_id' => 'required|numeric|exists:material_sub_category,parent_category_id',
        ]);
    
        $categoryId = $validatedData['parent_category_id'];
    
        $subCategories = MaterialSubCategory::where('parent_category_id', $categoryId)->get();

        if ($subCategories->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No subcategories found.'], 404);
        }
    
        return response()->json([
            'success' => true,
            'data' => $subCategories
        ], 200);
    }
    

    public function getMaterialByCategoryAndSubCategoryId(Request $request)
    {
        $validatedData = $request->validate([
            'parent_category_id' => 'required|numeric',
            'sub_category_id' => 'required|numeric',
        ]);
    
        $categoryId = $validatedData['parent_category_id'];
        $subCategoryId = $validatedData['sub_category_id'];
    
        $material = Material::where('category_id', $categoryId)
            ->where('sub_category', $subCategoryId)
            ->get();
    
        if ($material->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No material found.'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $material
        ], 200);
    }
    

    public function storeMaterialIn(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'date' => 'required|date',
            // 'machine' => 'required|string|max:191',
            'machine' => 'nullable|string|max:191',
            'material_category_type' => 'required|string|max:191',
            'material_sub_category' => 'required|string|max:191',
            'material_name' => 'required|string|max:191',
            'unit1' => 'required|string|max:100',
            'unit1_value' => 'required|numeric|min:0.01',
            'unit2' => 'nullable|string|max:100',
            'unit2_value' => 'nullable|numeric|min:0.01',
        ]);
    
        try {
            $stock = Stock::firstOrCreate(
                [
                    'material_name' => $validatedData['material_name'],
                    'category_id' => $validatedData['material_category_type'],
                    'sub_category' => $validatedData['material_sub_category'],
                    'unit1' => $validatedData['unit1'],
                ],
                ['unit1_value' => 0]
            );

            $materialIn = MaterialIn::create($validatedData);
    
            $stock->unit1_value += $validatedData['unit1_value'];
            $stock->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Material In data stored and stock updated successfully.',
                'data' => [
                    'material_in' => $materialIn,
                    'stock' => $stock
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while storing material data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    
    
    
    public function storeMaterialOut(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'date' => 'required|date',
            // 'machine' => 'required|string|max:191',
            'machine' => 'nullable|string|max:191',
            'material_category_type' => 'required|string|max:191',
            'material_sub_category' => 'required|string|max:191',
            'material_name' => 'required|string|max:191',
            'unit1' => 'required|string|max:100',
            'unit1_value' => 'required|numeric|min:0.01',
            'unit2' => 'nullable|string|max:100',
            'unit2_value' => 'nullable|numeric|min:0.01',
        ]);
    
        try {

            $stock = Stock::where([
                'material_name' => $validatedData['material_name'],
                'category_id' => $validatedData['material_category_type'],
                'sub_category' => $validatedData['material_sub_category'],
                'unit1' => $validatedData['unit1'],
            ])->first();
    
            if (!$stock || $stock->unit1_value < $validatedData['unit1_value']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Insufficient stock to fulfill the request.',
                ], 400);
            }
    
            $stock->update([
                'unit1_value' => \DB::raw('unit1_value - ' . $validatedData['unit1_value']),
            ]);
    
            $materialOut = MaterialOut::create($validatedData);
    
            return response()->json([
                'success' => true,
                'message' => 'Material Out data stored and stock updated successfully.',
                'data' => $materialOut,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing material out.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function categoriesWithStock()
    {
        $categories = MaterialCategory::whereHas('stocks', function ($query) {
            $query->where('quantity', '>', 0);
        })->select('id', 'name')->get();

        return response()->json([
            'success' => true,
            'message' => 'Categories with stock retrieved successfully.',
            'data' => $categories,
        ], 200);
    }

    public function subCategoriesWithStock(Request $request)
    {
        $validatedData = $request->validate([
            'parent_category_id' => 'required|integer|exists:material_category,id',
        ]);

        $subCategories = MaterialSubCategory::where('parent_category_id', $validatedData['parent_category_id'])
            ->whereHas('stocks', function ($query) {
                $query->where('quantity', '>', 0);
            })
            ->select('id', 'sub_cat_name')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Subcategories with stock retrieved successfully.',
            'data' => $subCategories,
        ]);
    }
    public function materialsWithStock(Request $request)
    {
        $validatedData = $request->validate([
            'parent_category_id' => 'required|integer|exists:material_category,id',
            'sub_category_id' => 'required|integer|exists:material_sub_category,id',
        ]);

        $materials = Material::where('category_id', $validatedData['parent_category_id'])
        ->where('sub_category', $validatedData['sub_category_id'])
            ->whereHas('stock', function ($query) {
                $query->where('quantity', '>', 0);
            })
            ->select('id', 'material_name')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Materials with stock retrieved successfully.',
            'data' => $materials,
        ]);
    }

    public function getTransport()
    {
        $transport = Transform::all();
    
        if ($transport->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No transport found.'], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $transport
        ], 200);
    }
    public function getMaterialIn()
    {
        $materialIn = MaterialIn::all();
    
        if ($materialIn->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No data found.'], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $materialIn
        ], 200);
    }
    public function getMaterialOut()
    {
        $materialOut = MaterialOut::all();
    
        if ($materialOut->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No data found.'], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $materialOut
        ], 200);
    }

    public function getUnitsByMaterialId(Request $request)
    {
        $validatedData = $request->validate([
            'material_id' => 'required|numeric',
        ]);
    
        $materialId = $validatedData['material_id'];
    
        $material = Material::find($materialId);

        if (!$material) {
            return response()->json(['success' => false, 'message' => 'No material found.'], 404);
        }

        return response()->json([
            'success' => true,
            'unit1Label' => $material->quantity,
            'unit2Label' => $material->unit,
        ], 200);
    }

    public function getLaminationOrdersSearchOrderByOrderId(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required',
        ]);

        $orderId = $validatedData['order_id'];

        $orders = CustomerOrder::where('order_id', $orderId)
            ->whereHas('laminationProductionOrders', function ($query) {

            })
            ->with('laminationProductionOrders')
            ->get();

            return response()->json([
                'success' => true,
                'orders' => $orders->isEmpty() ? [] : $orders,
            ], 200);
    }

    public function getExtruderOrdersSearchOrderByOrderId(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required',
        ]);

        $orderId = $validatedData['order_id'];

        $orders = CustomerOrder::where('order_id', $orderId)
            ->whereHas('extruderProductionOrders', function ($query) {

            })
            ->with('extruderProductionOrders')
            ->get();

            return response()->json([
                'success' => true,
                'orders' => $orders->isEmpty() ? [] : $orders,
            ], 200);
    }

    public function getRewindingOrdersSearchOrderByOrderId(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required',
        ]);
    
        $orderId = $validatedData['order_id'];
    
        $orders = CustomerOrder::where('order_id', $orderId)
            ->whereHas('rewindingProductionOrders') // Corrected case
            ->with('rewindingProductionOrders') // Corrected case
            ->get();
    
            return response()->json([
                'success' => true,
                'orders' => $orders->isEmpty() ? [] : $orders,
            ], 200);
    }

    public function getStitchingOrdersSearchOrderByOrderId(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required',
        ]);

        $orderId = $validatedData['order_id'];

        $orders = CustomerOrder::where('order_id', $orderId)
            ->whereHas('stitchingProductionOrders', function ($query) {

            })
            ->with('stitchingProductionOrders')
            ->get();

            return response()->json([
                'success' => true,
                'orders' => $orders->isEmpty() ? [] : $orders,
            ], 200);
    }

    
    public function getPackingOrdersSearchOrderByOrderId(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required',
        ]);

        $orderId = $validatedData['order_id'];

        $orders = CustomerOrder::where('order_id', $orderId)
            ->whereHas('packingProductionOrders', function ($query) {

            })
            ->with('packingProductionOrders')
            ->get();

            return response()->json([
                'success' => true,
                'orders' => $orders->isEmpty() ? [] : $orders,
            ], 200);
    }

    
}
