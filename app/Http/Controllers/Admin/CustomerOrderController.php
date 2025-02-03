<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Product;
use App\Models\Transform;
use App\Models\Group;
use App\Models\ProductGroup;
use App\Models\Color;
use App\Models\CustomerOrder;
use App\Models\ProductCategory;
use App\Models\Material;
use App\Models\PriceList;
use App\Models\PriceListItem;
use DataTables;
use App\Models\ProductOrder;
use App\Models\Outer;
use Illuminate\Support\Facades\Response;
use DB;
use Carbon\Carbon;
use PDF;
use App\Models\MaterialCategory;
use App\Models\MaterialSubCategory;

class CustomerOrderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Request $request)
    // {
    //     $totalOrders = CustomerOrder::count();
    //     // $customerOrder = CustomerOrder::groupBy('order_date')->count();
    //     $customerOrder = CustomerOrder::where('status','pending')->count();
    //     $orderStatuses = CustomerOrder::select('dispatched', DB::raw('count(*) as count'))
    //         ->whereIn('dispatched', ['dispatched', 'partially', 'delivered'])
    //         ->groupBy('dispatched')
    //         ->pluck('count', 'dispatched');
    //     $dispatchedOrder = $orderStatuses['dispatched'] ?? 0;
    //     $pertiallydispatchedOrder = $orderStatuses['partially'] ?? 0;
    //     $deliverddispatchedOrder = $orderStatuses['delivered'] ?? 0;
    //     // $dispatchedOrder = CustomerOrder::where('dispatched','dispatched')->count();
    //     // $pertiallydispatchedOrder = CustomerOrder::where('dispatched','partially')->count();
    //     // $deliverddispatchedOrder = CustomerOrder::where('dispatched','delivered')->count();
    //     if ($request->ajax()) {
    //     $query = CustomerOrder::select('order_date','id','order_id','customer_id','city_id','state_id','amount','total_bundle')->with('customer', 'cities','state');
    //     if (!empty($request->SearchData)) {
    //         $search = $request->SearchData;
    //         $query->where(function($q) use ($search) {
    //             $q->where('amount', 'like', "%{$search}%")
    //             ->orWhere('order_date', 'like', "%{$search}%")
    //             ->orWhere('order_id', 'like', "%{$search}%");
    //             $q->orWhereHas('customer', function($q) use ($search) {
    //                 $q->where('company_name', 'like', "%{$search}%")
    //                   ->orWhere('first_name', 'like', "%{$search}%")
    //                   ->orWhere('last_name', 'like', "%{$search}%");
    //             });
    //             $q->orWhereHas('cities', function($q) use ($search) {
    //                 $q->where('name', 'like', "%{$search}%");
    //             });
    
    //             // Search in related 'state' fields
    //             $q->orWhereHas('state', function($q) use ($search) {
    //                 $q->where('name', 'like', "%{$search}%");
    //             });
    //         //   ->orWhere('total_bundle', 'like', "%{$search}%");
    //         });
            
    //     }
    //     return DataTables::of($query)
    //         ->addColumn('order_date', function($customerOrder){
    //             return $customerOrder->order_date ?? '-';
    //         })
    //         ->addColumn('order_id', function($customerOrder){
    //             return $customerOrder->order_id ?? '-';
    //         })
    //         ->addColumn('customer', function($customerOrder){
    //             // return $customerOrder->customer->company_name ?? '';
    //             $customer = Customer::where('id', $customerOrder->customer_id)->first();
    //             return $customer ? $customer->company_name: '';
    //         })
    //         ->addColumn('city', function($customerOrder){
    //             return $customerOrder->cities->name ?? '';
    //         })
    //         ->addColumn('state', function($customerOrder){
    //             return $customerOrder->state->name ?? '';
    //             // $state = State::where('id', $customerOrder->state_id)->first();
    //             // return $state ? $state->name : '';
    //         })
    //         ->addColumn('amount', function($customerOrder){
    //             return $customerOrder->amount ? '₹' . number_format($customerOrder->amount, 2, '.', ',') : '-';
    //             // return $customerOrder->amount ? '₹' . formatIndianCurrency($customerOrder->amount) : '-';
    //         })
            
    //         ->addColumn('total_bundle', function($customerOrder){
    //             return ProductOrder::where('customer_orders_id', $customerOrder->id)->sum('bdl_kg');
    //         })  
    //         ->addColumn('action', function($customer) {
    //             $editUrl = route('customerOrder.edit', $customer->id);
    //             $btn = '<a href="' . $editUrl . '" class="btn-sm m-1"><span class="table-group-icons share-icon-tag"></span></a>';
    //             $btn .= '<a href="javascript:void(0)" class="btn-sm m-1 delete-customerOrder" data-id="' . $customer->id . '"><span class="table-group-icons edit-icon-tag"></span></a>';
                
    //             return $btn;
    //         })
    //         ->rawColumns(['action'])
    //         ->orderColumn('order_date', 'order_date $1')
    //         ->orderColumn('order_id', 'order_id $1')
            
    //         ->make(true);
    //     }
    //     return view('admin.customer-order.index',compact('totalOrders','customerOrder','dispatchedOrder', 'pertiallydispatchedOrder','deliverddispatchedOrder'));
        
    // }

    public function index(Request $request)
{
    $metaTitle = 'Customer Order Summary - Cosmic ERP';
    $totalOrders = CustomerOrder::count();
    $customerOrder = CustomerOrder::where('status', 'pending')->count();

    $orderStatuses = CustomerOrder::select('dispatched', DB::raw('count(*) as count'))
        ->whereIn('dispatched', ['dispatched', 'partially', 'delivered'])
        ->groupBy('dispatched')
        ->pluck('count', 'dispatched');

    $dispatchedOrder = $orderStatuses['dispatched'] ?? 0;
    $pertiallydispatchedOrder = $orderStatuses['partially'] ?? 0;
    $deliverddispatchedOrder = $orderStatuses['delivered'] ?? 0;

    if ($request->ajax()) {
        $query = CustomerOrder::select(
                'customer_orders.order_date',
                'customer_orders.id',
                'customer_orders.serial_number',
                'customer_orders.order_id',
                'customer_orders.amount',
                'customer_orders.total_bundle',
                // 'customer_orders.total_number',
                'customers.company_name',
                'customers.first_name',
                'customers.last_name',
                'cities.name as city_name',
                'states.name as state_name'
            )
            ->leftJoin('customers', 'customer_orders.customer_id', '=', 'customers.id')
            ->leftJoin('cities', 'customer_orders.city_id', '=', 'cities.id')
            ->leftJoin('states', 'customer_orders.state_id', '=', 'states.id')
            ->orderBy('customer_orders.id', 'desc');

        if (!empty($request->SearchData)) {
            $search = $request->SearchData;
            $query->where(function ($q) use ($search) {
                $q->where('customer_orders.amount', 'like', "%{$search}%")
                  ->orWhere('customer_orders.order_date', 'like', "%{$search}%")
                  ->orWhere('customer_orders.order_id', 'like', "%{$search}%")
                  ->orWhere('customers.company_name', 'like', "%{$search}%")
                  ->orWhere('customers.first_name', 'like', "%{$search}%")
                  ->orWhere('customers.last_name', 'like', "%{$search}%")
                  ->orWhere('cities.name', 'like', "%{$search}%")
                  ->orWhere('states.name', 'like', "%{$search}%");
            });
        }

        return DataTables::of($query)
            ->addColumn('full_name', function ($customer) {
                return $customer->first_name . ' ' . $customer->last_name;
            })
            ->addColumn('order_date', function ($customerOrder) {
                return $customerOrder->order_date ? \Carbon\Carbon::parse($customerOrder->order_date)->format('d-m-Y') : '-';
            })
            // ->addColumn('serial_number', function ($customerOrder) {
            //     return $customerOrder->order_date ? \Carbon\Carbon::parse($customerOrder->serial_number)->format('d-m-Y') : '-';
            // })
            ->addColumn('serial_number', function ($customerOrder) {
                return $customerOrder->serial_number ?? '-';
            })
            ->addColumn('order_id', function ($customerOrder) {
                $editUrl = route('customerOrder.edit', $customerOrder->id);
                return '<a href="' . $editUrl . '" class="btn-sm m-1 confirm-leave-link text-underline">' . ($customerOrder->order_id ?? '-') . '</a>';
            })
            // ->rawColumns(['order_id']) // Specify that the 'order_id' column contains raw HTML
            
            
            // ->addColumn('order_id', function ($customerOrder) {
            //     return $customerOrder->order_id ?? '-';
            // })
            ->addColumn('customer', function ($customerOrder) {
                return $customerOrder->company_name ?? '';
            })
            ->addColumn('city', function ($customerOrder) {
                return $customerOrder->city_name ?? '';
            })
            ->addColumn('state', function ($customerOrder) {
                return $customerOrder->state_name ?? '';
            })
            ->addColumn('amount', function($customerOrder){
                // return $customerOrder->amount ? '₹' . number_format($customerOrder->amount, 2, '.', ',') : '-';
                return $customerOrder->amount ? formatIndianCurrency($customerOrder->amount) : '-';
            })
            ->addColumn('total_bundle', function ($customerOrder) {
                $totalBundle = ProductOrder::where('customer_orders_id', $customerOrder->id)->sum('bdl_kg');
                return $totalBundle ? formatIndianCurrencyNumber($totalBundle) : '-';
            })
            ->addColumn('total_number', function ($customerOrder) {
                return ProductOrder::where('customer_orders_id', $customerOrder->id)->count();
            })            
            // ->addColumn('total_number', function ($customerOrder) {
            //     return ProductOrder::where('customer_orders_id', $customerOrder->id)->sum('roll_counte');
            // })
            ->addColumn('action', function ($customer) {
                $editUrl = route('customerOrder.edit', $customer->id);
                $viewUrl = route('customerOrder.view', $customer->id);
                $printUrl = route('customerOrder.print', $customer->id);
                $pdfUrl = route('customerOrder.pdf', $customer->id);
                $btn = '';
                if (auth()->user()->can('CustomerOrder Edit')) {
                    $btn = '<a href="' . $editUrl . '" class="btn-sm m-1 confirm-leave-link"><span class="table-group-icons share-icon-tag"></span></a>';
                }
                $btn .= '<a href="' . $viewUrl . '" class="btn-sm m-1 confirm-leave-link"><span class="table-group-icons eye-icon-tag"></span></a>';
                if (auth()->user()->can('CustomerOrder Pdf')) {
                    $btn .= '<a href="' . $pdfUrl . '" class="btn-sm m-1" target="_blank"><i class="files-group-icons files-icon-tag"></i></a>';
                }
                if (auth()->user()->can('CustomerOrder print')) {
                    $btn .= '<a href="' . $printUrl . '" class="btn-sm m-1" target="_blank"><i class="printss-group-icons printss-icon-tag"></i></a>';
                }
                if (auth()->user()->can('CustomerOrder Delete')) {
                    $btn .= '<a href="javascript:void(0)" class="btn-sm m-1 delete-customerOrder" data-id="' . $customer->id . '"><span class="table-group-icons edit-icon-tag"></span></a>';
                }
                return $btn;
            })
            ->rawColumns(['action','order_id'])
            ->orderColumn('company_name', 'customers.company_name $1')
            ->orderColumn('city', 'cities.name $1')
            ->orderColumn('state', 'states.name $1')
            ->orderColumn('amount', 'customer_orders.amount $1')
            ->orderColumn('total_bundle', 'total_bundle $1')
            ->orderColumn('order_date', 'customer_orders.order_date $1')
            ->orderColumn('order_id', 'customer_orders.order_id $1')
            ->orderColumn('serial_number', 'customer_orders.serial_number $1')
            ->make(true);
    }

    return view('admin.customer-order.index', compact('metaTitle','totalOrders', 'customerOrder', 'dispatchedOrder', 'pertiallydispatchedOrder', 'deliverddispatchedOrder'));
    }
    // YourController.php
    public function getLastPriceListId($customerId)
    {
        // Fetch the last order with a non-empty price list for the specified customer
        $lastOrder = CustomerOrder::where('customer_id', $customerId)
                                  ->whereNotNull('price_list')
                                  ->where('price_list', '!=', '')
                                  ->latest()
                                  ->first();
    
        // Extract the price list ID if available
        $priceListId = $lastOrder ? $lastOrder->price_list : null;
    
        // Logging for debugging purposes
        info('Customer ID:', [$customerId]);
        info('Last Order with Non-Empty Price List:', [$lastOrder]);
    
        return response()->json(['price_list' => $priceListId]);
    }
    
    

    public function generatePDF($id)
    {
        // $customerOrder = CustomerOrder::with(['products', 'customer'])->findOrFail($id);
        
        // $pdf = PDF::loadView('admin.customer-order.pdf', compact('customerOrder'));

        // return $pdf->download('customer_order_' . $id . '.pdf');

        $totalIntegratedSum = 0;
        $totalAmountSum = 0;
        $totalTaxAmountSum = 0;
        $totalBdl = 0;
        $countrys = Country::get();
        $category = ProductCategory::get();
        $materiyals = Material::get();
        $productsOrders = ProductOrder::where('customer_orders_id',$id)->get();
        $customers = Customer::where('status', 'active')->get();
        $products = Product::with('packingMaterial')->get();
        $customerOrders = CustomerOrder::find($id);
        $states = State::where('country_id', $customerOrders->country_id)->get();
        $cities = City::where('state_id', $customerOrders->state_id)->get();
        
        $countries = Country::all();
        $transforms = Transform::get();
        $groups = Group::get();
        $productgroups = ProductGroup::get();
        $colors = Color::get();
        $pricelists = PriceList::get();
        $outers = Outer::get();
        foreach ($productsOrders as $productId) {
            $totalValue = $productId->total ?? 0;
            $totalbdl = $productId->bdl_kg ?? 0;
            
            $gstValue = 18.0; // Assuming a fixed GST value; replace with dynamic if needed.
            $integrated = ($totalValue * $gstValue) / 100;
            $taxAmount = $totalValue + $integrated;
        
            $totalIntegratedSum += $integrated;
            // $totalAmountSum += $totalValue;
            $totalAmountSum += $taxAmount;
            $totalTaxAmountSum += $totalValue;
            // $totalTaxAmountSum += $taxAmount;
            $totalBdl += $totalbdl; 
            $productDetails[] = [
                'totalValue' => $totalValue,
                'gstValue' => $gstValue,
                'integrated' => $integrated,
                'taxAmount' => $taxAmount,
            ];
        }
        $data = compact('productDetails', 'totalIntegratedSum','totalBdl', 'totalAmountSum','totalTaxAmountSum','outers', 'productgroups', 'customers','states','cities','materiyals','category','products','customerOrders','productsOrders','transforms','countrys','groups','colors','pricelists');
        $pdf = PDF::loadView('admin.customer-order.pdf', $data);

        return $pdf->download('customer_order_' . $id . '.pdf');
        // return view('pdf.customer-order', compact('customerOrders', 'productsOrders', 'productDetails', 'totalIntegratedSum', 'totalAmountSum'));

        // return view('admin.customer-order.pdf', compact('productDetails', 'totalIntegratedSum','totalBdl', 'totalAmountSum','totalTaxAmountSum','outers', 'productgroups', 'customers','states','cities','materiyals','category','products','customerOrders','productsOrders','transforms','countrys','groups','colors','pricelists'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     $metaTitle = 'Create Customer Order - Cosmic ERP';
    //     $countrys = Country::get();
    //     $states = State::get();
    //     $cities = City::get();
    //     $lastOrder = CustomerOrder::latest('id')->first();
    //     $lastOrderId = $lastOrder ? $lastOrder->id : '0';
    //     $formattedLastOrderId = 'COS-'.$lastOrderId;
    //     // $currentDate = Carbon::now()->format('-dM');
    //     // $formattedLastOrderId = $lastOrderId ? $lastOrderId . $currentDate : $currentDate;
    //     $customers = Customer::where('status', 'active')->get();  // Assuming '1' means active
    //     // $customers = Customer::get();
    //     $products = Product::with('packingMaterial')->get();
    //     $transforms = Transform::get();
    //     $groups = Group::get();
    //     $colors = Color::get();
    //     $category = ProductCategory::get();
    //     $materiyals = Material::get();
    //     $pricelists = PriceList::get();
    //     // $outers = Outer::get();
        
    //     $outerSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Outer')->pluck('id');
    //     $outers = Material::where('sub_category', $outerSubCategoryIds)->get();
    //     $cartonSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Corrug Ated Box')->pluck('id');
    //     $cartons = Material::where('sub_category', $cartonSubCategoryIds)->get();
    //     $materials = Material::get();
    //     $materialCategory = MaterialCategory::get();
    //     // $subCategory = MaterialSubCategory::get();
    //     // $subCategories = MaterialSubCategory::get();
        
    //     $subCategoriesId = MaterialCategory::where('name', 'Packing Material')->pluck('id');
    //     $subCategories = MaterialSubCategory::where('parent_category_id', $subCategoriesId)->get();
    //     // $pricelists = PriceListItem::with('priceList')->get();

    //     // $pricelists= PriceListItem::get();
    //     return view('admin.customer-order.create',compact('metaTitle','subCategories','materialCategory','outers', 'cartons','category','materials','customers','products','formattedLastOrderId','transforms','countrys','states','cities','groups','colors','pricelists'));
    // }
//     public function create()
// {
//     $metaTitle = 'Create Customer Order - Cosmic ERP';
//     $countrys = Country::get();
//     $states = State::get();
//     $cities = City::get();
    
//     // Get the current date
//     $currentDate = Carbon::now();
//     $datePart = $currentDate->format('dMy'); // e.g., '15Nov24'
    
//     // Get today's order count and increment for the new order
//     $todayOrdersCount = CustomerOrder::whereDate('created_at', $currentDate->toDateString())->count() + 1;
//     $formattedLastOrderId = $datePart . '-' . str_pad($todayOrdersCount, 2, '0', STR_PAD_LEFT);

//     $customers = Customer::where('status', 'active')->get();
//     $products = Product::with('packingMaterial')->get();
//     $transforms = Transform::get();
//     $groups = Group::get();
//     $productgroups = ProductGroup::get();
//     $colors = Color::get();
//     $category = ProductCategory::get();
//     $pricelists = PriceList::get();
//     $materials = Material::get();
//     $outerSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Outer')->pluck('id');
//     $outers = Material::where('sub_category', $outerSubCategoryIds)->get();
    
//     $cartonSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Corrug Ated Box')->pluck('id');
//     $cartons = Material::where('sub_category', $cartonSubCategoryIds)->get();
    
//     $materialCategory = MaterialCategory::get();

//     $subCategoriesId = MaterialCategory::where('name', 'Packing Material')->pluck('id');
//     $subCategories = MaterialSubCategory::where('parent_category_id', $subCategoriesId)->get();
//     $paperTubeSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Paper Tube')->pluck('id');
//     $pipeSizes = Material::where('sub_category', $paperTubeSubCategoryIds)->get();
//     $stickerSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Sticker')->pluck('id');
//     $stickers = Material::where('sub_category', $stickerSubCategoryIds)->get();
//     return view('admin.customer-order.create', compact(
//         'metaTitle', 'subCategories', 'materialCategory', 'outers', 'cartons', 'category',
//         'materials', 'customers', 'products', 'formattedLastOrderId', 'transforms', 
//         'countrys', 'states', 'cities', 'groups', 'colors', 'pricelists', 'productgroups','pipeSizes','stickers'
//     ));
// }

public function create()
{
    $metaTitle = 'Create Customer Order - Cosmic ERP';
    $countrys = Country::get();
    $states = State::get();
    $cities = City::get();
    
    $currentDate = Carbon::now();
    $datePart = $currentDate->format('dMy'); 
    $day = $currentDate->format('d');  // Get the day part
    $month = $currentDate->format('M');  // Get the month part
    $year = $currentDate->format('y');

    $todayOrdersCount = CustomerOrder::whereDate('created_at', $currentDate->toDateString())->count() + 1;
    $lastOrder = CustomerOrder::latest('id')->first();
    $nextOrderId = $lastOrder ? $lastOrder->id + 1 : 1;
   // $formattedLastOrderId = $datePart . '-' . str_pad($todayOrdersCount, 2, '0', STR_PAD_LEFT);
    $formattedLastOrderId = $datePart . '-' . $nextOrderId;
    // $todayOrdersCount = CustomerOrder::whereDate('created_at', $currentDate->toDateString())->count() + 1;
    $formattedsrnumberId = $nextOrderId .'-'.$day.'th'.$month.' '.$year;
    // $formattedRecipeId =  $datePart .'-'. str_pad($todayOrdersCount, 2, '0', STR_PAD_LEFT  );

    $customers = Customer::where('status', 'active')->get();
    $products = Product::with('packingMaterial')->get();
    $transforms = Transform::get();
    $groups = Group::get();
    $productgroups = ProductGroup::get();
    $colors = Color::get();
    $category = ProductCategory::get();
    $pricelists = PriceList::get();
    $materials = Material::get();
    
    $outerSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Outer')->pluck('id');
    $outers = Material::whereIn('sub_category', $outerSubCategoryIds)->get();

    $cartonSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Corrug Ated Box')->pluck('id');
    $cartons = Material::whereIn('sub_category', $cartonSubCategoryIds)->get();

    $materialCategory = MaterialCategory::get();

    $packingMaterialCategory = MaterialCategory::where('name', 'Packing Material')->first();

    $subCategories = [];
    if ($packingMaterialCategory) {

        $subCategoriesId = $packingMaterialCategory->id;
        $subCategories = MaterialSubCategory::where('parent_category_id', $subCategoriesId)->get();
    }

    $paperTubeSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Paper Tube')->pluck('id');
    $pipeSizes = Material::whereIn('sub_category', $paperTubeSubCategoryIds)->get();

    $stickerSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Sticker')->pluck('id');
    $stickers = Material::whereIn('sub_category', $stickerSubCategoryIds)->get();

    return view('admin.customer-order.create', compact(
        'metaTitle', 'subCategories', 'materialCategory', 'outers', 'cartons', 'category',
        'materials', 'customers', 'products', 'formattedLastOrderId','formattedsrnumberId', 'transforms', 
        'countrys', 'states', 'cities', 'groups', 'colors', 'pricelists', 'productgroups',
        'pipeSizes', 'stickers'
    ));
}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        info('**');
        info($request->all());
        $request->merge([
            'roll_counte' => array_map('convertToPlainNumber', $request->roll_counte),
            'rate' => array_map('convertToPlainNumber', $request->rate),
            'total' => array_map('convertToPlainNumber', $request->total),
        ]);
        $validated = $request->validate([
            'customer' => 'required|integer',
            'product.*' => 'required|integer',
            // 'serial_number' => 'required|string',
            'sku.*' => 'required|string',
            'color.*' => 'nullable|string',
            'sticker_name.*' => 'nullable|string',
            'packing_material_type.*' => 'required',
            'bdl_kg.*' => 'required|string',
            'bharti.*' => 'required',
            'unit_box.*' => 'required|numeric',
            'roll_counte.*' => 'required|numeric',
            'rate.*' => ['required', 'regex:/^\d+(\.\d{1,3})?$/'],
            'total.*' => 'required|numeric',
            'delivery_date' => ['required', 'date', 'after_or_equal:today'],
            'remark.*'=> 'nullable|string',
            'qty.*'=> 'nullable|string',

            ],[
                'delivery_date.required' => 'Please select Delivery Date.',
                'delivery_date.date' => 'Please enter a valid date.',
                'delivery_date.after_or_equal' => 'The delivery date must be greater than today.',
                'customer.required' => 'Please select Company.',
                'product.*.required' => 'Please select Product Name.',
                'rate.*.required' => 'Please enter Rate.',
                'rate.*.regex' => 'The Rate must be a number with up to 3 decimal places',
                //'sticker_name.*.required'=> 'Please enter Sticker.',
                'packing_material_type.*.required'=> 'Please enter Packing Material Name.',
                'bdl_kg.*.required'=> 'Please enter BDL.',
                'bharti.*.required'=> 'Please enter Bharti.',
                'unit_box.*.required'=> 'Please enter Bag/Box.',
                'roll_counte.*.required'=> 'Please enter Total Roll',
                'total.*.required'=> 'Please enter Total.',
        ]);

        
        $orderDate = $request->order_date ?? now()->toDateString();
        $customerdata = Customer::select('city_id','state_id','country_id')->where('id', $request->customer)->first();
        $customerOrder = CustomerOrder::create([
            'customer_id' => isset($request->customer)?$request->customer :'',
            'serial_number' => isset($request->serial_number)?$request->serial_number :'',
            'contact' => isset($request->contact)?$request->contact :'',
            'price_list' => isset($request->price_list)?$request->price_list :'',
            'shipping_address' => isset($request->shipping_address)?$request->shipping_address :'',
            'packing_name' => isset($request->packing_name)?$request->packing_name :'',
            'order_id' => isset($request->order_id)?$request->order_id :'',
            'customer_notes' => isset($request->customer_notes)?$request->customer_notes :'',
'delivery_date' => isset($request->delivery_date) && !empty($request->delivery_date) ? $request->delivery_date : null,
            'order_type' => isset($request->options)?$request->options :'',
            'city_id' => isset($customerdata->city_id)?$customerdata->city_id:'',
            'state_id' => isset($customerdata->state_id)?$customerdata->state_id:'',
            'country_id' => isset($customerdata->country_id)?$customerdata->country_id:'',
            'amount' => 0, 
            'total_bundle' => 0, 
            'order_date' => $orderDate,
            'dispatched' => isset($request->dispatched)?$request->dispatched: '',
            'remark' => isset($request->remark)?$request->remark: '',

        ]);
        $totalAmount = '0';
        $totalbundle = '0';
         foreach ($validated['product'] as $key => $productId) {
            // $subTotal = $validated['sub_total'][$key] ?? 0;
            $bundleTotal = $validated['bdl_kg'][$key] ?? 0;
            $totalAmount = $validated['total'][$key] ?? 0;
            // $totalAmount += $subTotal; 
            $totalbundle += $bundleTotal; 
            ProductOrder::create([
                'customer_orders_id' => $customerOrder->id,
                'product_id' => $productId,
                'sku' => $validated['sku'][$key] ?? null,
                'colour' => $validated['color'][$key] ?? null,
                'sticker_name' => $validated['sticker_name'][$key] ?? null,
                'packing_material_type' => $validated['packing_material_type'][$key] ?? null,
                'bdl_kg' => $validated['bdl_kg'][$key] ?? null,
                'bharti' => $validated['bharti'][$key] ?? null,
                'packing' => $validated['packing'][$key] ?? null,
                'unit_box' => $validated['unit_box'][$key] ?? null,
                'roll_counte' => $validated['roll_counte'][$key] ?? null,
                'qty' => $validated['qty'][$key] ?? null,
                'rate' => $validated['rate'][$key] ?? null,
                'total' => $validated['total'][$key] ?? null,
                'remark' => $validated['remark'][$key] ?? null,
            ]);
        }
        $customerOrder->update(['amount' => $totalAmount,'total_bundle' => $totalbundle]);

        
        return redirect()->route('customerOrder.index')->with('success', 'Order saved successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $metaTitle = 'View Customer Order - Cosmic ERP';
        $stickerSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Sticker')->pluck('id');
        $stickers = Material::whereIn('sub_category', $stickerSubCategoryIds)->get();
        $countrys = Country::get();
        $category = ProductCategory::get();
        $materiyals = Material::get();
        $productsOrders = ProductOrder::where('customer_orders_id',$id)->get();
        $customers = Customer::where('status', 'active')->get();
        $products = Product::with('packingMaterial')->get();
        $customerOrders = CustomerOrder::find($id);
        $transforms = Transform::get();
        $groups = Group::get();
        $colors = Color::get();
        $pricelists = PriceList::get();
        $outers = Outer::get();
        return view('admin.customer-order.view', compact(
            'metaTitle',  'materiyals', 'outers',
            'customers', 'category', 'products', 'customerOrders', 'productsOrders', 'transforms',
            'countrys', 'groups', 'colors', 'pricelists',  'stickers'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     $metaTitle = 'Edit Customer Order - Cosmic ERP';
    //     $countrys = Country::get();
    //     $category = ProductCategory::get();
    //     $materiyals = Material::get();
    //     $productsOrders = ProductOrder::where('customer_orders_id',$id)->get();
    //     $customers = Customer::where('status', 'active')->get();
    //     $products = Product::with('packingMaterial')->get();
    //     $customerOrders = CustomerOrder::find($id);
    //     info('****');
    //     info($customerOrders);
    //     $transforms = Transform::get();
    //     $groups = Group::get();
    //     $productgroups = ProductGroup::get();
    //     $colors = Color::get();
    //     $pricelists = PriceList::get();
    //     $outerSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Outer')->pluck('id');
    //     $cartonSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Corrug Ated Box')->pluck('id');
    //     $cartons = Material::where('sub_category', $cartonSubCategoryIds)->get();
    //     $outers = Material::where('sub_category', $outerSubCategoryIds)->get();
    //     $materials = Material::get();
    //     $materialCategory = MaterialCategory::get();
    //     // $subCategory = MaterialSubCategory::get();
    //     // $subCategories = MaterialSubCategory::get();
        
    //     $subCategoriesId = MaterialCategory::where('name', 'Packing Material')->pluck('id');
    //     $subCategories = MaterialSubCategory::where('parent_category_id', $subCategoriesId)->get();
    //     $paperTubeSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Paper Tube')->pluck('id');
    //     $pipeSizes = Material::where('sub_category', $paperTubeSubCategoryIds)->get();
    //     $stickerSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Sticker')->pluck('id');
    //     $stickers = Material::where('sub_category', $stickerSubCategoryIds)->get();
    //     return view('admin.customer-order.edit', compact('metaTitle','productgroups','subCategories','cartons', 'materialCategory','materials','outers','customers','materiyals','category','products','customerOrders','productsOrders','transforms','countrys','groups','colors','pricelists','pipeSizes','stickers'));
    // }

    public function edit($id)
    {
        $metaTitle = 'Edit Customer Order - Cosmic ERP';
        $countrys = Country::get();
        $category = ProductCategory::get();
        $materiyals = Material::get();
        $productsOrders = ProductOrder::where('customer_orders_id', $id)->get();
        $customers = Customer::where('status', 'active')->get();
        $products = Product::with('packingMaterial')->get();
        $customerOrders = CustomerOrder::find($id);
    
        info('****');
        info($customerOrders);
    
        $transforms = Transform::get();
        $groups = Group::get();
        $productgroups = ProductGroup::get();
        $colors = Color::get();
        $pricelists = PriceList::get();
        
        $outerSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Outer')->pluck('id');
        $outers = Material::whereIn('sub_category', $outerSubCategoryIds)->get();
        
        $cartonSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Corrug Ated Box')->pluck('id');
        $cartons = Material::whereIn('sub_category', $cartonSubCategoryIds)->get();

        $materialCategory = MaterialCategory::get();
        $materials = Material::get();
        
        $subCategoriesId = MaterialCategory::where('name', 'Packing Material')->pluck('id')->first();
        
        $subCategories = [];
        if ($subCategoriesId) {
            $subCategories = MaterialSubCategory::where('parent_category_id', $subCategoriesId)->get();
        }
    
        $paperTubeSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Paper Tube')->pluck('id');
        $pipeSizes = Material::whereIn('sub_category', $paperTubeSubCategoryIds)->get();
        
        $stickerSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Sticker')->pluck('id');
        $stickers = Material::whereIn('sub_category', $stickerSubCategoryIds)->get();
    
        return view('admin.customer-order.edit', compact(
            'metaTitle', 'productgroups', 'subCategories', 'cartons', 'materialCategory', 'materiyals', 'outers',
            'customers', 'category', 'products', 'customerOrders', 'productsOrders', 'transforms',
            'countrys', 'groups', 'colors', 'pricelists', 'pipeSizes', 'stickers','materials'
        ));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id){
        $countrys = Country::get();
        $category = ProductCategory::get();
        $materiyals = Material::get();
        $productsOrders = ProductOrder::where('customer_orders_id',$id)->get();
        $customers = Customer::where('status', 'active')->get();
        $products = Product::with('packingMaterial')->get();
        $customerOrders = CustomerOrder::find($id);
        $transforms = Transform::get();
        $groups = Group::get();
        $colors = Color::get();
        $pricelists = PriceList::get();
        $outers = Outer::get();
        return view('admin.customer-order.print', compact('outers','customers','materiyals','category','products','customerOrders','productsOrders','transforms','countrys','groups','colors','pricelists'));
    }
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->merge([
            'roll_counte' => array_map('convertToPlainNumber', $request->roll_counte),
            'rate' => array_map('convertToPlainNumber', $request->rate),
            'total' => array_map('convertToPlainNumber', $request->total),
        ]);        info('info*9699*');
        $validated = $request->validate([
            // 'customer' => 'nullable|integer',
            // 'product.*' => 'nullable|integer',
            // 'sku.*' => 'nullable|string',
            // 'color.*' => 'nullable|string', // Make color nullable if not always required
            // 'sticker_name.*' => 'nullable|string',
            // 'packing_material_type.*' => 'nullable|string',
            // 'bdl_kg.*' => 'nullable|string',
            // 'bharti.*' => 'nullable|string',
            // 'unit_box.*' => 'nullable|numeric',
            // 'roll_counte.*' => 'nullable|numeric',
            // 'rate.*' => ['nullable', 'regex:/^\d+(\.\d{1,3})?$/'],
            // 'total.*' => 'nullable|numeric',
            // 'remark.*'=> 'nullable|string',
            // 'delivery_date' => ['nullable', 'date', 'after:today'],
            'customer' => 'required|integer',
            'product.*' => 'required|integer',
            // 'serial_number' => 'required|string',
            'sku.*' => 'required|string',
            'color.*' => 'nullable|string',
            'sticker_name.*' => 'nullable|string',
            'packing_material_type.*' => 'required',
            'bdl_kg.*' => 'required|string',
            'bharti.*' => 'required',
            'unit_box.*' => 'required|numeric',
            'roll_counte.*' => 'required|numeric',
            'rate.*' => ['nullable', 'regex:/^\d+(\.\d{1,3})?$/'],
            'total.*' => 'required|numeric',
            'remark.*'=> 'nullable|string',
            'delivery_date' => ['required', 'date'],
        ], [
            'delivery_date.required' => 'The delivery date is required.',
            'delivery_date.date' => 'Please enter a valid date.',
            'delivery_date.after' => 'The delivery date must be greater than today.',
            'customer.required' => 'The Company field is required.',
            'product.*.required' => 'The Product field is required.',
            'rate.*.required' => 'The Rate field is required.',
            'rate.*.regex' => 'The Rate must be a number with up to 3 decimal places.',
            //'sticker_name.*.required' => 'The Sticker field is required.',
            'packing_material_type.*.required' => 'The Packing Material Type field is required.',
            'bdl_kg.*.required' => 'The BDL field is required.',
            'bharti.*.required' => 'The Bharti field is required.',
            'unit_box.*.required' => 'The Unit Box field is required.',
            'roll_counte.*.required' => 'The Roll Counte field is required.',
            'total.*.required' => 'The Total field is required.',
        ]);
    
        // Fetch the existing customer order
        $customerOrder = CustomerOrder::findOrFail($id);
    
        // Get customer data
        $customerData = Customer::select('city_id', 'state_id', 'country_id')
            ->where('id', $request->customer)
            ->first();
    
        // Update the customer order
        $customerOrder->update([
            'customer_id' => $request->customer ?? '',
            'serial_number' => $request->serial_number ?? '',
            'contact' => $request->contact ?? '',
            'price_list' => $request->price_list ?? '',
            'shipping_address' => $request->shipping_address ?? '',
            'packing_name' => $request->packing_name ?? '',
            'order_id' => $request->order_id ?? '',
            'customer_notes' => $request->customer_notes ?? '',
            'delivery_date' => isset($request->delivery_date) && !empty($request->delivery_date) ? $request->delivery_date : null,
            'city_id' => $customerData->city_id ?? '',
            'state_id' => $customerData->state_id ?? '',
            'country_id' => $customerData->country_id ?? '',
            'order_date' => $request->order_date ?? now()->toDateString(),
            'order_type' => $request->options ?? '',
            'dispatched' => $request->dispatched ?? '',
        ]);
    
        // Delete existing ProductOrder records for this customer order
        ProductOrder::where('customer_orders_id', $customerOrder->id)->delete();
    
        // Update product orders
        $totalAmount = 0;
        $totalBundle = 0;
    
        foreach ($validated['product'] as $key => $productId) {
            $bundleTotal = $validated['bdl_kg'][$key] ?? 0;
            $totalAmount += $validated['total'][$key] ?? 0;
            $totalBundle += $bundleTotal;
    
            ProductOrder::create([
                'customer_orders_id' => $customerOrder->id,
                'product_id' => $productId,
                'sku' => $validated['sku'][$key],
                'colour' => $validated['color'][$key] ?? null,
                'sticker_name' => $validated['sticker_name'][$key]  ?? null,
                'packing_material_type' => $validated['packing_material_type'][$key],
                'bdl_kg' => $validated['bdl_kg'][$key],
                'bharti' => $validated['bharti'][$key],
                'unit_box' => $validated['unit_box'][$key],
                'roll_counte' => $validated['roll_counte'][$key],
                'rate' => $validated['rate'][$key],
                'total' => $validated['total'][$key],
                'remark' => $validated['remark'][$key] ?? null,
            ]);
        }
    
        // Update the customer order with the total amount and bundle
        $customerOrder->update([
            'amount' => $totalAmount,
            'total_bundle' => $totalBundle,
        ]);
    
        return redirect()->route('customerOrder.index')->with('success', 'Order updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = CustomerOrder::findOrFail($id);
        if($customer){
            $customer->delete();
            return Response::json(['success' => 'customer deleted successfully.']);    
        }
        return Response::json(['error' => 'customer not found.'], 404);
    }

public function deleteColor(Request $request)
{
    info('**************');
    info($request->all());
    $colorName = $request->input('color_name');

    $color = Color::where('name', $colorName)->first();
    if ($color) {
        $color->delete();
    }
    return response()->json(['success' => true]);
}
    public function add(Request $request){
        $messages =  [
            'product_name.required' => 'Please enter a valid product name.',
            'group_name.required' => 'Please select a valid group name.',
            'alias_sku.required' => 'Please enter a valid alias/sku.',
            'width.required' => 'Please enter a valid width.',
            'master_packing.required' => 'Please select the master packing.',
            'bharti.required' => 'Please enter a valid bharti.',
            'number_of_bags_per_box.required' => 'Please enter a valid bags per box.',
            //'rate.required' => 'Please enter a valid rate.',
        ];
        $product = new Product([
            'product_name' => isset($request->product_name)?$request->product_name :'',
            'group_name' => isset($request->group_name)?$request->group_name:'',
            'alias_sku' => isset($request->alias_sku)?$request->alias_sku:'',
            'category' => isset($request->category)?$request->category:'',
            'width' => isset($request->width)?$request->width:'',
            'length' => isset($request->length)?$request->length:'',
            'gage' => isset($request->gage)?$request->gage:'0',
            'gsm' => isset($request->gsm)?$request->gsm:'',
            'master_packing' => isset($request->master_packing)?$request->master_packing:'',
            'bharti' => isset($request->bharti)?$request->bharti:'',
            'number_of_bags_per_box' => isset($request->number_of_bags_per_box)?$request->number_of_bags_per_box:'',
            'pipe_size' => isset($request->pipe_size)?$request->pipe_size:'',
            'rolls_in_1_bdl' => isset($request->rolls_in_1_bdl)?$request->rolls_in_1_bdl:'',
            'roll_weight' => isset($request->roll_weight)?$request->roll_weight:'',
            'sheet_weight' => isset($request->sheet_weight)?$request->sheet_weight:'',
            'roll_weight_to_sheet_weight' => isset($request->roll_weight_to_sheet_weight)?$request->roll_weight_to_sheet_weight:'',
            //'bdl_kg' => isset($request->bdl_kg)?$request->bdl_kg:'',
            'bdl_kg' => isset($request->bdl_kg) ? round($request->bdl_kg) : '',
            'gram_per_meter' => isset($request->gram_per_meter)?$request->gram_per_meter:'',
            'packing_material_qty' => isset($request->packing_material_qty)?$request->packing_material_qty:'0',
            'outer_name' => isset($request->outer_name)?$request->outer_name:'',
            'carton_no' => isset($request->carton_no)?$request->carton_no:'',
            'number_of_outer' => isset($request->number_of_outer)?$request->number_of_outer:'0',
            'packing_material_type' => isset($request->packing_material_type)?$request->packing_material_type:'',
            //'rate' => isset($request->rate)?$request->rate:'',
            //'min_quantity' => isset($request->min_quantity)?$request->min_quantity:'',
            //'packing_material_category' => isset($request->packing_material_category)?$request->packing_material_category:'',
            'packing_material_name' => isset($request->packing_material_name)?$request->packing_material_name:'',
        ]);
        $product->save();
        // $product = new Product($request->all());
        if ($request->hasFile('image')) {
            $image = $request->file('image');
                $filename = time() . '_' . date('Ymd_His') . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('public/img/product_images', $filename);
                if ($path) {
                    $product->image = 'img/product_images/' . $filename; // Save relative path to the image
                } else {
                }
        }

        $product->save();
        $materialname = Material::select('material_name')->where('id', $product->packing_material_name)->first();
        return response()->json([
            'success' => 'Data saved successfully!',
            'newOption' => [
                'value' => $product->id,
                'text' => $product->product_name,
                'pmt'=>$product->alias_sku,
                'bdl'=>$product->bdl_kg,
                'bharti'=>$product->bharti,
                'bagbox'=>$product->number_of_bags_per_box,
                //'rate'=>$product->rate,
                'id'=>$product->id,
                'rolls1bdl'=>$product->rolls_in_1_bdl,
                'product'=>$product,
                'packingmaterialname'=> $materialname->material_name,
                
            ],
            'newOptionsecound' => [
                'value' => $product->id,
                'text' => $product->alias_sku,
                // 'pmt'=>$product->alias_sku,
                'bdl'=>$product->bdl_kg,
                'bharti'=>$product->bharti,
                'bagbox'=>$product->number_of_bags_per_box,
                'rate'=>$product->rate,
                'id'=>$product->id,
                'rolls1bdl'=>$product->rolls_in_1_bdl,
                'product'=>$product,
                'packingmaterialname'=> $materialname->material_name,
            ]
        ]);
    }

    public function storeGroup($priceListId)
    {
        $products = PriceListItem::where('price_list_id', $priceListId)->get()->unique('product_id');

        return response()->json($products);
    }


}
