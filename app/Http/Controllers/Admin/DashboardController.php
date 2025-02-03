<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductionOrder;
use App\Models\CustomerOrder;
use App\Models\ProductOrder;
use App\Models\Product;
use App\Models\LaminationProductionOrder;
use App\Models\ExtruderProductionOrder;
use App\Models\RewindingProductionOrder;
use App\Models\StitchingProductionOrder;
use App\Models\PackingProductionOrder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Material;
use App\Models\Customer;
use App\Models\Transform;

class DashboardController extends Controller
{
    // Middleware to restrict access to authenticated users
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'verified']);
    // }

    public function index(Request $request)
    {
        $productionDetails = $this->getProductionDetails();
        $customerOrderDetails  = $this->getOrderDetails($request);
        $materialDetails  = $this->getMaterialsDetail($request);
        $details = $this->getProductionDetails();
        $Customers= Customer::get();
        $productionAndDispatcedDetails = $details['productionVsDispatch'];
        $maxYValue = $details['maxYValue'];
        $yAxisLabels = $details['yAxisLabels'];
        $xAxisLabels = $details['xAxisLabels'];
        $statistics = $this->getStatistics();
        if ($request->ajax()) {
            return view('dashboard-append', compact('productionDetails','Customers', 'customerOrderDetails', 'productionAndDispatcedDetails', 'statistics','maxYValue','yAxisLabels','xAxisLabels','materialDetails'));
        }

        return view('dashboard', compact('productionDetails', 'statistics', 'Customers','productionAndDispatcedDetails', 'customerOrderDetails','maxYValue','yAxisLabels','xAxisLabels','materialDetails'));
    }
    
    private function getMaterialsDetail(Request $request)
    {        info($request->all());

        $startDate = null;
        $endDate = now(); 
        switch ($request->filter) {
            case 'today':
                $startDate = now()->startOfDay();
                break;
            case 'current_week':
                $startDate = now()->subWeek()->startOfDay();
                break;
            case 'current_month':
                $startDate = now()->subMonth()->startOfDay();
                break;
            case 'current_year':
                $startDate = now()->startOfYear();
                break;
            // case 'custom_date':
            //     break;
            default:
                break;
        }
        if ($request->filter == 'custom_date' && $request->start_date && $request->end_date) {
            $startDate = $request->start_date;
            $endDate = $request->end_date;
        } else {
            info('Condition not met. Filter: ' . $request->filter);
        }
      return  Material::with('product','category','subCategory')
      ->when($startDate, function ($query) use ($startDate) {
        return $query->whereDate('materials.created_at', '>=', $startDate);
    })
    ->when($endDate, function ($query) use ($endDate) {
        return $query->whereDate('materials.created_at', '<=', $endDate);
    })
    ->when(!$startDate && !$endDate, function ($query) {
        $currentMonthStart = Carbon::now()->startOfMonth()->toDateString();
        $currentMonthEnd = Carbon::now()->endOfMonth()->toDateString();
        
        return $query->whereDate('materials.created_at', '>=', $currentMonthStart)
                     ->whereDate('materials.created_at', '<=', $currentMonthEnd);
    })
      ->get();

    }
    private function getProductionDetails()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $productionData = ProductionOrder::select(
            DB::raw('SUM(bundle_quantity) as total_production'),
            DB::raw('CASE 
                        WHEN DAY(created_at) BETWEEN 1 AND 10 THEN "1-10" 
                        WHEN DAY(created_at) BETWEEN 11 AND 20 THEN "11-20" 
                        ELSE "21-31" 
                    END as day_range')
        )
        ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
        ->groupBy('day_range')
        ->get();
    
        $dispatchData = CustomerOrder::select(
            DB::raw('SUM(total_bundle) as total_dispatch'),
            DB::raw('CASE 
                        WHEN DAY(delivery_date) BETWEEN 1 AND 10 THEN "1-10" 
                        WHEN DAY(delivery_date) BETWEEN 11 AND 20 THEN "11-20" 
                        ELSE "21-31" 
                    END as day_range')
        )
        ->whereBetween('delivery_date', [$startOfMonth, $endOfMonth])
        ->groupBy('day_range')
        ->get();
    
        if ($productionData->isEmpty() && $dispatchData->isEmpty()) {
            return [
                'productionVsDispatch' => [],
                'maxYValue' => 0,
                'yAxisLabels' => [],
                'xAxisLabels' => ['1-10', '11-20', '21-31'],
            ];
        }
    
        $productionVsDispatch = [];
        $maxProduction = 0;
        $maxDispatch = 0;
    
        foreach (['1-10', '11-20', '21-31'] as $range) {
            $production = $productionData->firstWhere('day_range', $range)->total_production ?? 0;
            $dispatch = $dispatchData->firstWhere('day_range', $range)->total_dispatch ?? 0;
    
            $maxProduction = max($maxProduction, $production);
            $maxDispatch = max($maxDispatch, $dispatch);
    
            $productionVsDispatch[] = [
                'day_range' => $range,
                'production' => $production,
                'dispatch' => $dispatch,
            ];
        }
    
        $maxValue = max($maxProduction, $maxDispatch);
        
        $maxYValue = $this->calculateMaxYValue($maxValue);

        $stepValue = max(1, ceil($maxYValue / 5));

        $yAxisLabels = [];
        for ($i = $maxYValue; $i >= 0; $i -= $stepValue) {
            $yAxisLabels[] = round($i, -1);
        }
    
        $xAxisLabels = ['1-10', '11-20', '21-31'];
    
        return [
            'productionVsDispatch' => $productionVsDispatch,
            'maxYValue' => $maxYValue,
            'yAxisLabels' => array_unique($yAxisLabels),
            'xAxisLabels' => $xAxisLabels,
        ];
    }
    
    private function calculateMaxYValue($value)
    {
        if ($value <= 0) {
            return 0; 
        }
    
        if ($value < 100) {
            return ceil($value / 10) * 10;
        } elseif ($value < 1000) {
            return ceil($value / 50) * 50;
        } else {

            return $this->roundToNearestUpperSignificant($value);
        }
    }
    
    private function roundToNearestUpperSignificant($value)
    {
        $magnitude = ceil(log10($value));
        $factor = pow(10, $magnitude);
        return ceil($value / $factor) * $factor;
    }
    
    
    

    

    private function getOrderDetails(Request $request)
    {
        info($request->all());

        $startDate = null;
        $endDate = now(); 
        switch ($request->filter) {
            case 'today':
                $startDate = now()->startOfDay();
                break;
            case 'current_week':
                $startDate = now()->subWeek()->startOfDay();
                break;
            case 'current_month':
                $startDate = now()->subMonth()->startOfDay();
                break;
            case 'current_year':
                $startDate = now()->startOfYear();
                break;
            // case 'custom_date':
            //     break;
            default:
                break;
        }
        if ($request->filter == 'custom_date' && $request->start_date && $request->end_date) {
            $startDate = $request->start_date;
            $endDate = $request->end_date;
        } else {
            info('Condition not met. Filter: ' . $request->filter);
        }
        $orders = CustomerOrder::whereBetween('created_at', [now()->subMonth(), now()])
        ->with('customer')
        ->when($startDate, function ($query) use ($startDate) {
            return $query->whereDate('customer_orders.created_at', '>=', $startDate);
        })
        ->when($endDate, function ($query) use ($endDate) {
            return $query->whereDate('customer_orders.created_at', '<=', $endDate);
        })
        ->when(!$startDate && !$endDate, function ($query) {
            $currentMonthStart = Carbon::now()->startOfMonth()->toDateString();
            $currentMonthEnd = Carbon::now()->endOfMonth()->toDateString();
            
            return $query->whereDate('customer_orders.created_at', '>=', $currentMonthStart)
                         ->whereDate('customer_orders.created_at', '<=', $currentMonthEnd);
        })
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

        $latestProductionOrders = ProductionOrder::whereBetween('created_at', [now()->subMonth(), now()])
        ->with('product')
        ->when($startDate, function ($query) use ($startDate) {
            return $query->whereDate('production_order.created_at', '>=', $startDate);
        })
        ->when($endDate, function ($query) use ($endDate) {
            return $query->whereDate('production_order.created_at', '<=', $endDate);
        })
        ->when(!$startDate && !$endDate, function ($query) {
            $currentMonthStart = Carbon::now()->startOfMonth()->toDateString();
            $currentMonthEnd = Carbon::now()->endOfMonth()->toDateString();
            
            return $query->whereDate('production_order.created_at', '>=', $currentMonthStart)
                         ->whereDate('production_order.created_at', '<=', $currentMonthEnd);
        })
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

            $orderIds = $orders->pluck('id');
            
            $productOrders = ProductOrder::whereIn('customer_orders_id', $orderIds)->get();
            
            $productIds = $productOrders->pluck('product_id');

            $laminationOrders = LaminationProductionOrder::select(
                'production_order.id as production_id',
                'production_order.bundle_quantity',
                'production_order.lamination_type',
                'customer_orders.order_id',
                'customer_orders.customer_id',
                // 'customer_orders.total_bundle',bundle_quantity
                'products.product_name',
                'customer_orders.id as customer_order_id',
                'customers.first_name',
                'customers.last_name',
                // 'customers.first_name as customer_name',
                DB::raw('COUNT(CASE WHEN lamination_production_orders.status = "completed" THEN 1 END) as completed_count'),
                DB::raw('COUNT(CASE WHEN lamination_production_orders.status = "pending" THEN 1 END) as pending_count'),
                DB::raw('COUNT(lamination_production_orders.id) as total_orders')
                
            )
            ->leftJoin('products', 'lamination_production_orders.product_id', '=', 'products.id')
            // ->leftJoin('customers', 'customer_orders.customer_id', '=', 'customers.id')
            ->leftJoin('production_order', 'lamination_production_orders.production_order_id', '=', 'production_order.id')
            ->leftJoin('product_orders', function($join) {
                $join->on('lamination_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
                     ->on('lamination_production_orders.product_id', '=', 'product_orders.product_id');
            })
            ->leftJoin('customer_orders', 'lamination_production_orders.customer_order_id', '=', 'customer_orders.id')
            ->leftJoin('customers', 'customer_orders.customer_id', '=', 'customers.id')
            ->leftJoin('materials', 'products.packing_material_type', '=', 'materials.id')
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('lamination_production_orders.created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('lamination_production_orders.created_at', '<=', $endDate);
            })
            ->when(!$startDate && !$endDate, function ($query) {
                $currentMonthStart = Carbon::now()->startOfMonth()->toDateString();
                $currentMonthEnd = Carbon::now()->endOfMonth()->toDateString();
                
                return $query->whereDate('lamination_production_orders.created_at', '>=', $currentMonthStart)
                             ->whereDate('lamination_production_orders.created_at', '<=', $currentMonthEnd);
            })
            ->groupBy('customer_orders.id','production_order.bundle_quantity','production_order.lamination_type', 'customers.first_name', 'customers.last_name','customer_orders.order_id','customer_orders.customer_id', 'products.product_name', 'production_order.id')  // Group by order_id as well
            ->get();
        
        
        
        
            $extrusionOrders = ExtruderProductionOrder::select(
                'production_order.id as production_id',
                'customer_orders.order_id',
                'customer_orders.customer_id',
                'production_order.bundle_quantity',
                'products.product_name',
                'customer_orders.id as customer_order_id',
                'customers.first_name',
                'customers.last_name',
                DB::raw('COUNT(CASE WHEN extruder_production_orders.status = "completed" THEN 1 END) as completed_count'),
                DB::raw('COUNT(CASE WHEN extruder_production_orders.status = "pending" THEN 1 END) as pending_count'),
                DB::raw('COUNT(extruder_production_orders.id) as total_orders')
            )
            ->leftJoin('products', 'extruder_production_orders.product_id', '=', 'products.id')
            ->leftJoin('production_order', 'extruder_production_orders.production_order_id', '=', 'production_order.id')
            ->leftJoin('product_orders', function($join) {
                $join->on('extruder_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
                     ->on('extruder_production_orders.product_id', '=', 'product_orders.product_id');
            })
            ->leftJoin('customer_orders', 'extruder_production_orders.customer_order_id', '=', 'customer_orders.id')
            ->leftJoin('customers', 'customer_orders.customer_id', '=', 'customers.id')
            ->leftJoin('materials', 'products.packing_material_type', '=', 'materials.id')
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('extruder_production_orders.created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('extruder_production_orders.created_at', '<=', $endDate);
            })
            ->when(!$startDate && !$endDate, function ($query) {
                $currentMonthStart = Carbon::now()->startOfMonth()->toDateString();
                $currentMonthEnd = Carbon::now()->endOfMonth()->toDateString();
                
                return $query->whereDate('extruder_production_orders.created_at', '>=', $currentMonthStart)
                             ->whereDate('extruder_production_orders.created_at', '<=', $currentMonthEnd);
            })
            ->groupBy('customer_orders.id', 'production_order.bundle_quantity','customers.first_name', 'customers.last_name','customer_orders.customer_id', 'customer_orders.order_id', 'products.product_name','production_order.id')  // Group by order_id as well
            ->get();

            $rewindingOrders = RewindingProductionOrder::select(
                'production_order.id as production_id',
                'customer_orders.order_id',
                'products.product_name',
                'production_order.bundle_quantity',
                'customer_orders.id as customer_order_id',
                'customer_orders.customer_id',
                'customers.first_name',
                'customers.last_name',
                DB::raw('COUNT(CASE WHEN rewinding_production_orders.status = "completed" THEN 1 END) as completed_count'),
                DB::raw('COUNT(CASE WHEN rewinding_production_orders.status = "pending" THEN 1 END) as pending_count'),
                DB::raw('COUNT(rewinding_production_orders.id) as total_orders')
            )
            ->leftJoin('products', 'rewinding_production_orders.product_id', '=', 'products.id')
            ->leftJoin('production_order', 'rewinding_production_orders.production_order_id', '=', 'production_order.id')
            ->leftJoin('product_orders', function($join) {
                $join->on('rewinding_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
                     ->on('rewinding_production_orders.product_id', '=', 'product_orders.product_id');
            })
            ->leftJoin('customer_orders', 'rewinding_production_orders.customer_order_id', '=', 'customer_orders.id')
            ->leftJoin('customers', 'customer_orders.customer_id', '=', 'customers.id')
            ->leftJoin('materials', 'products.packing_material_type', '=', 'materials.id')
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('rewinding_production_orders.created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('rewinding_production_orders.created_at', '<=', $endDate);
            })
            ->when(!$startDate && !$endDate, function ($query) {
                $currentMonthStart = Carbon::now()->startOfMonth()->toDateString();
                $currentMonthEnd = Carbon::now()->endOfMonth()->toDateString();
                
                return $query->whereDate('rewinding_production_orders.created_at', '>=', $currentMonthStart)
                             ->whereDate('rewinding_production_orders.created_at', '<=', $currentMonthEnd);
            })
            ->groupBy('customer_orders.id', 'production_order.bundle_quantity', 'customers.first_name', 'customers.last_name','customer_orders.customer_id', 'customer_orders.order_id', 'products.product_name', 'production_order.id')
            ->get();
            
            $stitchingOrders = stitchingProductionOrder::select(
                'production_order.id as production_id',
                'customer_orders.order_id',
                'products.product_name',
                'production_order.bundle_quantity',
                'customer_orders.id as customer_order_id',
                'customer_orders.customer_id',
                'customers.first_name',
                'customers.last_name',
                DB::raw('COUNT(CASE WHEN stitching_production_orders.status = "completed" THEN 1 END) as completed_count'),
                DB::raw('COUNT(CASE WHEN stitching_production_orders.status = "pending" THEN 1 END) as pending_count'),
                DB::raw('COUNT(stitching_production_orders.id) as total_orders')
            )
            ->leftJoin('products', 'stitching_production_orders.product_id', '=', 'products.id')
            ->leftJoin('production_order', 'stitching_production_orders.production_order_id', '=', 'production_order.id')
            ->leftJoin('product_orders', function($join) {
                $join->on('stitching_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
                     ->on('stitching_production_orders.product_id', '=', 'product_orders.product_id');
            })
            ->leftJoin('customer_orders', 'stitching_production_orders.customer_order_id', '=', 'customer_orders.id')
            ->leftJoin('customers', 'customer_orders.customer_id', '=', 'customers.id')
            ->leftJoin('materials', 'products.packing_material_type', '=', 'materials.id')
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('stitching_production_orders.created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('stitching_production_orders.created_at', '<=', $endDate);
            })
            ->when(!$startDate && !$endDate, function ($query) {
                $currentMonthStart = Carbon::now()->startOfMonth()->toDateString();
                $currentMonthEnd = Carbon::now()->endOfMonth()->toDateString();
                
                return $query->whereDate('stitching_production_orders.created_at', '>=', $currentMonthStart)
                             ->whereDate('stitching_production_orders.created_at', '<=', $currentMonthEnd);
            })
            ->groupBy('customer_orders.id','production_order.bundle_quantity','customers.first_name', 'customers.last_name','customer_orders.customer_id', 'customer_orders.order_id', 'products.product_name', 'production_order.id')  // Group by order_id as well
            ->get();

            $packingOrders = PackingProductionOrder::select(
                'production_order.id as production_id',
                'customer_orders.order_id',
                'products.product_name',
                'production_order.bundle_quantity',
                'customer_orders.id as customer_order_id',
                'customer_orders.customer_id',
                'customers.first_name',
                'customers.last_name',
                DB::raw('COUNT(CASE WHEN packing_production_orders.status = "completed" THEN 1 END) as completed_count'),
                DB::raw('COUNT(CASE WHEN packing_production_orders.status = "pending" THEN 1 END) as pending_count'),
                DB::raw('COUNT(packing_production_orders.id) as total_orders')
            )
            ->leftJoin('products', 'packing_production_orders.product_id', '=', 'products.id')
            ->leftJoin('production_order', 'packing_production_orders.production_order_id', '=', 'production_order.id')
            ->leftJoin('product_orders', function($join) {
                $join->on('packing_production_orders.customer_order_id', '=', 'product_orders.customer_orders_id')
                     ->on('packing_production_orders.product_id', '=', 'product_orders.product_id');
            })
            ->leftJoin('customer_orders', 'packing_production_orders.customer_order_id', '=', 'customer_orders.id')
            ->leftJoin('customers', 'customer_orders.customer_id', '=', 'customers.id')
            ->leftJoin('materials', 'products.packing_material_type', '=', 'materials.id')
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('packing_production_orders.created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('packing_production_orders.created_at', '<=', $endDate);
            })
            ->when(!$startDate && !$endDate, function ($query) {
                $currentMonthStart = Carbon::now()->startOfMonth()->toDateString();
                $currentMonthEnd = Carbon::now()->endOfMonth()->toDateString();
                
                return $query->whereDate('packing_production_orders.created_at', '>=', $currentMonthStart)
                             ->whereDate('packing_production_orders.created_at', '<=', $currentMonthEnd);
            })
            ->groupBy('customer_orders.id', 'production_order.bundle_quantity','customers.first_name', 'customers.last_name','customer_orders.customer_id','customer_orders.order_id', 'products.product_name', 'production_order.id')
            ->get();

            $customerOrders = CustomerOrder::select(
                            'customer_orders.*',
                            'products.product_name',
                            'products.alias_sku',
                            'products.number_of_bags_per_box',
                            'products.rolls_in_1_bdl',
                            'products.master_packing',
                            'product_orders.packing_material_type',
                            'product_orders.colour',
                            'product_orders.bharti',
                            'product_orders.bdl_kg',
                            'customers.company_name',
                            'customers.matrix',
                            'customer_orders.packing_name'
                        )
                        ->leftJoin('product_orders', 'customer_orders.id', '=', 'product_orders.customer_orders_id')
                        ->leftJoin('products', 'product_orders.product_id', '=', 'products.id')
                        ->leftJoin('customers', 'customer_orders.customer_id', '=', 'customers.id')
                        ->join('production_order', function ($join) {
                            $join->on('customer_orders.id', '=', 'production_order.sales_order')
                                 ->where('production_order.status', 'completed');
                        })
                        ->whereIn('customer_orders.id', $orderIds)
                        ->when($startDate, function ($query) use ($startDate) {
                            return $query->whereDate('customer_orders.created_at', '>=', $startDate);
                        })
                        ->when($endDate, function ($query) use ($endDate) {
                            return $query->whereDate('customer_orders.created_at', '<=', $endDate);
                        })
                        ->when(!$startDate && !$endDate, function ($query) {
                            $currentMonthStart = Carbon::now()->startOfMonth()->toDateString();
                            $currentMonthEnd = Carbon::now()->endOfMonth()->toDateString();
                    
                            return $query->whereDate('customer_orders.created_at', '>=', $currentMonthStart)
                                         ->whereDate('customer_orders.created_at', '<=', $currentMonthEnd);
                        })
                        ->orderByRaw('CAST(customers.matrix AS SIGNED) ASC')
                        ->get()
                        ->groupBy('packing_name');
            

            $transport = Transform::get();
        
            // $customerOrders = CustomerOrder::select(
            //     'customer_orders.*',
            //     'products.product_name',
            //     'products.alias_sku',
            //     'products.number_of_bags_per_box',
            //     'products.rolls_in_1_bdl',
            //     'products.master_packing',
            //     'product_orders.packing_material_type',
            //     'product_orders.colour',
            //     'product_orders.bharti',
            //     'product_orders.bdl_kg',
            //     'customers.company_name',
            //     'customers.matrix',
            //     'customer_orders.packing_name'  // Add packing_name here
            // )
            // ->leftJoin('product_orders', 'customer_orders.id', '=', 'product_orders.customer_orders_id')
            // ->leftJoin('products', 'product_orders.product_id', '=', 'products.id')
            // ->leftJoin('customers', 'customer_orders.customer_id', '=', 'customers.id')
            // ->whereIn('customer_orders.id', $orderIds)
            // ->when($startDate, function ($query) use ($startDate) {
            //     return $query->whereDate('customer_orders.created_at', '>=', $startDate);
            // })
            // ->when($endDate, function ($query) use ($endDate) {
            //     return $query->whereDate('customer_orders.created_at', '<=', $endDate);
            // })
            // ->when(!$startDate && !$endDate, function ($query) {
            //     $currentMonthStart = Carbon::now()->startOfMonth()->toDateString();
            //     $currentMonthEnd = Carbon::now()->endOfMonth()->toDateString();
        
            //     return $query->whereDate('customer_orders.created_at', '>=', $currentMonthStart)
            //                  ->whereDate('customer_orders.created_at', '<=', $currentMonthEnd);
            // })
            // ->orderByRaw('CAST(customers.matrix AS SIGNED) ASC')
            // ->get()
            // ->groupBy('packing_name');
            return [
                'orders' => $orders,
                'laminationOrders' => $laminationOrders,
                'extrusionOrders' => $extrusionOrders,
                'packingOrders' => $packingOrders,
                'rewindingOrders' => $rewindingOrders,
                'stitchingOrders' => $stitchingOrders,
                'customerOrders' => $customerOrders,
                'transport' => $transport,
                'latestProductionOrders' => $latestProductionOrders,
            ];
    }

    private function getStatistics()
    {
        return [
            'dispatch_by_transport' => [
                'customer_1' => ['weight' => 200, 'bags' => 50],
                'customer_2' => ['weight' => 300, 'bags' => 75],
            ],
            'material_to_be_purchased' => [
                'material_1' => ['qty' => 500, 'pending_orders' => 5],
                'material_2' => ['qty' => 800, 'pending_orders' => 3],
            ],
        ];
    }
}

