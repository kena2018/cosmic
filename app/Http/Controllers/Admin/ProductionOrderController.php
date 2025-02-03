<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductionOrder;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DataTables;
use Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Customer;
// use App\Models\LaminationName;

// use Illuminate\Support\Facades\Request;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\CustomerOrder;
use App\Models\ProductOrder;
use App\Models\LaminationName;
use App\Models\LaminationProductionOrder;
use App\Models\ExtruderProductionOrder;
use App\Models\Material;
use App\Models\MaterialCategory;
use App\Models\MaterialSubCategory;
use App\Models\ProductCategory;
use App\Models\RecipeMaster;
use PDF;

class ProductionOrderController extends Controller
{
    public function index(Request $request)
    {
        $metaTitle = 'Work Order Summary - Cosmic ERP';
        if ($request->ajax()) {
            $query = ProductionOrder::with('company','product','customerOrder')->select([
                'id', 'production_varient_name', 'product_type', 'order_type', 'company_name',
                'sales_order', 'qty_required', 'sku', 'extrusion_gauge', 'extrusion_colour',
                'extrusion_size', 'extrusion_recipe', 'extrusion_qty_of_packing', 'rewinding_pipe',
                'rewinding_sticker', 'rewinding_qty_in_rolls', 'rewinding_colour', 'rewinding_width'
                , 'rewinding_length', 'start_date',
                'packing_gauge', 'packing_colour', 'packing_width', 'packing_length', 'packing_bharti',
                'packing_name', 'packing_sticker', 'packing_carton', 'packing_pipe', 'packing_outer_name',
                'packing_qty_rolls', 'packing_qty_bundle', 'sticching_product_name', 'sticching_colour',
                'sticching_packing_name', 'sticching_packing_type', 'sticching_qty_bundle', 'sticching_bharti',
                'sticching_qty_rolls', 'sticching_bag', 'created_at', 'updated_at','qty_required','bundle_quantity'
            ]);
            if (!empty($request->SearchData)) {
                $search = $request->SearchData;
                $query->where('product_type', 'like', "%{$search}%")
                      ->orWhere('company_name', 'like', "%{$search}%")
                      ->orWhere('order_type', 'like', "%{$search}%")
                      ->orWhere('sales_order', 'like', "%{$search}%")
                      ->orWhere('qty_required', 'like', "%{$search}%")
                      ->orWhere('sku', 'like', "%{$search}%")
                      ->orWhereHas('company', function ($q) use ($search) {
                          $q->where('company_name', 'like', "%{$search}%");
                      })
                      ->orWhereHas('product', function ($q) use ($search) {
                          $q->where('product_name', 'like', "%{$search}%");
                      });
            }
            return DataTables::of($query)
            ->editColumn('company_name', function ($order) {
                return $order->company ? $order->company->company_name : 'SELF'; 
            })
            ->editColumn('product_type', function ($order) {
                return $order->product ? $order->product->product_name : '-'; 
            })
            ->editColumn('sales_order', function ($order) {
                return $order->customerOrder ? $order->customerOrder->order_id : 'SELF';
            })
                ->editColumn('created_at', function ($order) {
                    return $order->created_at ? $order->created_at->format('d-m-Y') : '-';
                })
                ->editColumn('updated_at', function ($order) {
                    return $order->updated_at ? $order->updated_at->format('Y-m-d H:i:s') : '-';
                })
                ->addColumn('action', function($order) {
                    $editUrl = route('production_order.edit', $order->id);
                    // $deleteUrl = route('production_order.destroy', $order->id);
                    $pdfUrl = route('production_order.pdf', $order->id);
                    $printUrl = route('production_order.print', $order->id);
                    $viewUrl = route('production_order.view', $order->id);
                    $btn = '';
                    if (auth()->user()->can('Production Edit')) {
                        $btn = '<a href="' . $editUrl . '" class="btn-sm m-1 confirm-leave-link"><span class="table-group-icons share-icon-tag"></span></a>';
                    }    
                        $btn .= '<a href="' . $viewUrl . '" class="btn-sm m-1 confirm-leave-link"><span class="table-group-icons eye-icon-tag"></span></a>';
                    
                    if (auth()->user()->can('Production Pdf')) {
                        $btn .= '<a href="' . $pdfUrl . '" class="btn-sm m-1" target="_blank"><i class="files-group-icons files-icon-tag"></i></a>';
                    }
                    if (auth()->user()->can('Production Print')) {
                        $btn .= '<a href="' . $printUrl . '" class="btn-sm m-1" target="_blank"><i class="printss-group-icons printss-icon-tag"></i></a>';
                    }
                    if (auth()->user()->can('Production Delete')) {
                        $btn .= '<a href="javascript:void(0)" class="btn-sm m-1 delete-production" data-id="' . $order->id . '"><span class="table-group-icons edit-icon-tag"></span></a>';
                    }
                    
                    
                    return $btn;
                })
                ->rawColumns(['action'])
                // ->orderColumn('qty_required', 'production_order.qty_required $1')
                ->orderColumn('bundle_quantity', function ($query, $order) {
                    $query->orderBy('bundle_quantity', $order);
                })
                ->make(true);
        }
    
        return view('admin.production-order.index',compact('metaTitle'));
    }
    

    // public function create()
    // {
    //     $metaTitle = 'Create Work Order - Cosmic ERP';
    //     // $products = Product::all();
    //     $products = Product::orderBy('product_name')->get();
    //     $customers = Customer::orderBy('first_name')->get();
    //     $CategoriesId = MaterialCategory::where('name', 'Raw material')->pluck('id');
    //     $laminationpaperReelId = MaterialSubCategory::where('sub_cat_name','Paper Reel')->pluck('id');
    //     $laminationnameId = MaterialSubCategory::where('sub_cat_name','Lamination Film')->pluck('id');
    //     $laminationGumId = MaterialSubCategory::where('sub_cat_name','Gum')->pluck('id');
    //     $laminationpapernames = Material::where('category_id', $CategoriesId)->where('sub_category', $laminationpaperReelId)->get();
    //     $laminationnames = Material::where('category_id', $CategoriesId)->where('sub_category', $laminationnameId)->get();
    //     $laminationgums = Material::where('category_id', $CategoriesId)->where('sub_category', $laminationGumId)->get();
    //     // $laminations = LaminationName::get();
    //     return view('admin.production-order.add', compact('products', 'customers','laminationpapernames','laminationnames','laminationgums','metaTitle'));
    // }

    public function create()
{
    $metaTitle = 'Create Work Order - Cosmic ERP';
    // $products = Product::orderBy('product_name')->get();
    $products = Product::with(['pipeSizeMaterial', 'outerNameMaterial', 'cartonMaterial'])
    ->orderBy('product_name')
    ->get();
    $recipemasters = RecipeMaster::get();
    $currentDate = Carbon::now();
    $datePart = $currentDate->format('dMy'); 

    $todayOrdersCount = ProductionOrder::whereDate('created_at', $currentDate->toDateString())->count() + 1;
    $formattedLastOrderId = $datePart . '-' . str_pad($todayOrdersCount, 2, '0', STR_PAD_LEFT);
    $customers = Customer::orderBy('first_name')->get();
    $CategoriesId = MaterialCategory::where('name', 'Raw material')->pluck('id');
    $materials = Material::get();
    $stickerSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Sticker')->pluck('id');
    $stickers = Material::whereIn('sub_category', $stickerSubCategoryIds)->get();
    if ($CategoriesId->isEmpty()) {

        $laminationpapernames = collect();
        $laminationnames = collect();
        $laminationgums = collect();
    } else {
        $laminationpaperReelId = MaterialSubCategory::where('sub_cat_name', 'Paper Reel')->pluck('id');
        $laminationnameId = MaterialSubCategory::where('sub_cat_name', 'Lamination Film')->pluck('id');
        $laminationGumId = MaterialSubCategory::where('sub_cat_name', 'Gum')->pluck('id');
        
        $laminationpapernames = Material::where('category_id', $CategoriesId)
                                        ->whereIn('sub_category', $laminationpaperReelId)
                                        ->get();
                                        
        $laminationnames = Material::where('category_id', $CategoriesId)
                                   ->whereIn('sub_category', $laminationnameId)
                                   ->get();
                                   
        $laminationgums = Material::where('category_id', $CategoriesId)
                                  ->whereIn('sub_category', $laminationGumId)
                                  ->get();
    }

    return view('admin.production-order.add', compact(
        'materials','stickers','products', 'customers','recipemasters', 'laminationpapernames', 'laminationnames', 'laminationgums', 'metaTitle','formattedLastOrderId'
    ));
}



    public function store(Request $request)
    {
        info('create*****');
        info($request->all());
        $messages =  ['production_varient_name.nullable' => 'The gauge field is required.',
                'start_date.required' => 'The Start date is required.',
                'start_date.date' => 'Please enter date.',
                'start_date.after' => 'The Start date must be greater than today.',
        ];
        $validatedData = $request->validate([
            'production_varient_name' => 'nullable|string|max:255s',
            'product_type' => 'required|string|max:255',
            'order_type' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'sales_order' => 'nullable|string|max:255',
            'qty_required' => 'nullable|string',
            'sku' => 'required|string|max:255',
            'extrusion_gauge' => 'nullable|string|max:255',
            'extrusion_internal_notes' => 'nullable|string',
            'extrusion_colour' => 'nullable|string|max:255',
            'start_date' => ['required', 'date'],
        ],$messages);

        $ProductionOrders = new ProductionOrder([
            'production_varient_name' => isset($request->production_varient_name)?$request->production_varient_name :'',
            'product_type' => isset($request->product_type)?$request->product_type :'',
            'order_type' => isset($request->order_type)?$request->order_type :'',
            'company_name' => isset($request->company_name)?$request->company_name :'',
            'sales_order' => isset($request->sales_order)?$request->sales_order :'',
            'qty_required' => isset($request->qty_required)?$request->qty_required :'',
            'remark' => isset($request->remark)?$request->remark :'',
            'pending_bundle_qty' => isset($request->pending_bundle_quantity)?$request->pending_bundle_quantity :0,
            'bundle_quantity' => isset($request->bundle_quantity)?$request->bundle_quantity :'',
            'sku' => isset($request->sku)?$request->sku :'',
            'extrusion_gauge' => isset($request->extrusion_gauge)?$request->extrusion_gauge :'',
            'extrusion_colour' => isset($request->extrusion_colour)?$request->extrusion_colour :'',
            'extrusion_size' => isset($request->extrusion_size)?$request->extrusion_size :'',
            'extrusion_recipe' => isset($request->extrusion_recipe)?$request->extrusion_recipe :'',
            'extrusion_qty_of_packing' => isset($request->extrusion_qty_of_packing)?$request->extrusion_qty_of_packing :'',
            'extrusion_internal_notes' => isset($request->extrusion_internal_notes)?$request->extrusion_internal_notes :'',
            'lamination_paper_name' => isset($request->lamination_paper_name)?$request->lamination_paper_name :'',
            'lamination_name' => isset($request->lamination_name)?$request->lamination_name :'',
            'lamination_gun_name' => isset($request->lamination_gun_name)?$request->lamination_gun_name :'',
            'lamination_type' => isset($request->lamination_type)?$request->lamination_type :'',
            'lamination_internal_notes' => isset($request->lamination_internal_notes)?$request->lamination_internal_notes :'',
            'rewinding_pipe' => isset($request->rewinding_pipe)?$request->rewinding_pipe :'',
            'rewinding_bharti' => isset($request->rewinding_bharti)?$request->rewinding_bharti :'',
            'rewinding_material_name' => isset($request->rewinding_material_name)?$request->rewinding_material_name :'',
            'rewinding_internal_notes' => isset($request->rewinding_internal_notes)?$request->rewinding_internal_notes :'',
            'rewinding_sticker' => isset($request->rewinding_sticker)?$request->rewinding_sticker :'',
            'rewinding_qty_in_rolls' => isset($request->rewinding_qty_in_rolls)?$request->rewinding_qty_in_rolls :'',
            'rewinding_colour' => isset($request->rewinding_colour)?$request->rewinding_colour :'',
            'rewinding_width' => isset($request->rewinding_width)?$request->rewinding_width :'',
            'rewinding_qty_in_bundle' => isset($request->rewinding_qty_in_bundle)?$request->rewinding_qty_in_bundle :'',
            'rewinding_length' => isset($request->rewinding_length)?$request->rewinding_length :'',
            'start_date' => isset($request->start_date)?$request->start_date :'',
            // 'internal_notes' => isset($request->internal_notes)?$request->internal_notes :'',
            'packing_gauge' => isset($request->packing_gauge)?$request->packing_gauge :'',
            'packing_colour' => isset($request->packing_colour)?$request->packing_colour :'',
            'packing_width' => isset($request->packing_width)?$request->packing_width :'',
            'packing_length' => isset($request->packing_length)?$request->packing_length :'',
            'packing_bharti' => isset($request->packing_bharti)?$request->packing_bharti :'',
            'packing_name' => isset($request->packing_name)?$request->packing_name :'',
            'packing_sticker' => isset($request->packing_sticker)?$request->packing_sticker :'',
            'packing_carton' => isset($request->packing_carton)?$request->packing_carton :'',
            'packing_pipe' => isset($request->packing_pipe)?$request->packing_pipe :'',
            'packing_outer_name' => isset($request->packing_outer_name)?$request->packing_outer_name :'',
            'packing_qty_rolls' => isset($request->packing_qty_rolls)?$request->packing_qty_rolls :'',
            'packing_qty_bundle' => isset($request->packing_qty_bundle)?$request->packing_qty_bundle :'',
            'packing_internal_notes' => isset($request->packing_internal_notes)?$request->packing_internal_notes :'',
            'sticching_product_name' => isset($request->sticching_product_name)?$request->sticching_product_name :'',
            'sticching_colour' => isset($request->sticching_colour)?$request->sticching_colour :'',
            'sticching_packing_name' => isset($request->sticching_packing_name)?$request->sticching_packing_name :'',
            'sticching_packing_type' => isset($request->sticching_packing_type)?$request->sticching_packing_type :'',
            'sticching_qty_bundle' => isset($request->sticching_qty_bundle)?$request->sticching_qty_bundle :'',
            'sticching_bharti' => isset($request->sticching_bharti)?$request->sticching_bharti :'',
            'sticching_qty_rolls' => isset($request->sticching_qty_rolls)?$request->sticching_qty_rolls :'',
            'sticching_bag' => isset($request->sticching_bag)?$request->sticching_bag :'',
            'Stitching_internal_notes' => isset($request->Stitching_internal_notes)?$request->Stitching_internal_notes :'',
            'machine' => isset($request->machine)?$request->machine :'',
            'date' => isset($request->date)?$request->date:'',
            'shift' => isset($request->shift)?$request->shift:'',
            
        ]);
        $ProductionOrders->save();

        $product = Product::find($request->product_type);
        if ($product) {
            if (in_array($product->category, [1, 2])) {
                $LaminationProductionOrder = new LaminationProductionOrder([
                    'production_order_id' => $ProductionOrders->id ?? '',
                    'customer_order_id' => $request->sales_order ?? '',
                    'customer_id' => $request->company_name ?? '',
                    'product_id' => $request->product_type ?? '',
                    'machine' => '',
                    'date' => '',
                    'meter' => '',
                    'status' => 'pending',
                ]);
                $LaminationProductionOrder->save();
            }else{
                $ExtruderProductionOrder = new ExtruderProductionOrder([
                    'lamination_id' =>'',
                    'production_order_id' => $ProductionOrders->id ?? '',
                    'customer_order_id' => $request->sales_order ?? '',
                    'customer_id' => $request->company_name ?? '',
                    'product_id' => $request->product_type ?? '',
                    'machine' => '',
                    'date' => '',
                    'shift' => '',
                    'qty' => '',
                    'size' => '',
                    'status' => 'pending',
                ]);
                $ExtruderProductionOrder->save();
            }
        }


        return redirect()->route('production_order.index')->with('success', 'Work order created successfully.');
    
    }
    // public function edit($id)
    // {
    //     $metaTitle = 'Cosmic ERP - Edit Production Order';
    //     $products = Product::orderBy('product_name')->get();
    //     $customers = Customer::orderBy('first_name')->get();
    //     $productionOrder = ProductionOrder::find($id);
    //     $salesOrders = CustomerOrder::where('customer_id', $productionOrder->company_name)->get();
    //     return view('admin.production-order.edit', compact('productionOrder','products','customers','salesOrders','metaTitle'));
    // }

//     public function edit($id)
// {
//     $metaTitle = 'Edit Work Order - Cosmic ERP';
//     $productionOrder = ProductionOrder::find($id);   

//     // Assuming `customer_order_id` is the foreign key in `production_orders` pointing to `customer_orders` table
//     $salesOrderId = $productionOrder->sales_order; // Replace with the correct field if different
//     $productId = $productionOrder->product_type;
//     $pendingBundleQty = $this->getCompaniesByProduct($productId,$salesOrderId,)->getData()->pending_bdl_kg;
//     // Replace with the correct field if different
//     $salesOrders = CustomerOrder::where('customer_id', $productionOrder->company_name)->get();
    
//     // Fetch products related to the selected sales order using the existing function
//     $products = $this->getProductsBySalesOrder($salesOrderId)->getData()->products;

//     $customers = Customer::orderBy('first_name')->get();
//     $CategoriesId = MaterialCategory::where('name', 'Raw material')->pluck('id');
//     $laminationpaperReelId = MaterialSubCategory::where('sub_cat_name','Paper Reel')->pluck('id');
//     $laminationnameId = MaterialSubCategory::where('sub_cat_name','Lamination Film')->pluck('id');
//     $laminationGumId = MaterialSubCategory::where('sub_cat_name','Gum')->pluck('id');
//     $laminationpapernames = Material::where('category_id', $CategoriesId)->where('sub_category', $laminationpaperReelId)->get();
//     $laminationnames = Material::where('category_id', $CategoriesId)->where('sub_category', $laminationnameId)->get();
//     $laminationgums = Material::where('category_id', $CategoriesId)->where('sub_category', $laminationGumId)->get();
//     $sticchingPackingType = Material::where('id', $productionOrder->sticching_packing_type)->get();
//     return view('admin.production-order.edit', compact('sticchingPackingType','laminationgums','laminationnames','laminationpapernames','productionOrder', 'products', 'customers', 'salesOrders', 'metaTitle', 'pendingBundleQty'));
// }
public function show($id){
    $metaTitle = 'View Work Order - Cosmic ERP';
    $productionOrder = ProductionOrder::find($id);   
    $category = ProductCategory::get();

    // Assuming `customer_order_id` is the foreign key in `production_orders` pointing to `customer_orders` table
    $salesOrderId = $productionOrder->sales_order; // Replace with the correct field if different
    $productId = $productionOrder->product_type;
    $pendingBundleQty = $this->getCompaniesByProduct($productId, $salesOrderId)->getData()->pending_bdl_kg;
info('pendingBundleQty');
info($pendingBundleQty);
    // Replace with the correct field if different
    $salesOrders = CustomerOrder::where('customer_id', $productionOrder->company_name)->get();
    
    // Fetch products related to the selected sales order using the existing function
    $productsData = $this->getProductsBySalesOrder($salesOrderId);
    $products = $productsData['products'];

    $customers = Customer::orderBy('first_name')->get();

    // Get category ID for 'Raw material'
    $CategoriesId = MaterialCategory::where('name', 'Raw material')->pluck('id');

    // Initialize variables as empty collections
    $laminationpapernames = collect();
    $laminationnames = collect();
    $laminationgums = collect();

    // Check if CategoriesId is not empty
    if (!$CategoriesId->isEmpty()) {
        $laminationpaperReelId = MaterialSubCategory::where('sub_cat_name', 'Paper Reel')->pluck('id');
        $laminationnameId = MaterialSubCategory::where('sub_cat_name', 'Lamination Film')->pluck('id');
        $laminationGumId = MaterialSubCategory::where('sub_cat_name', 'Gum')->pluck('id');
        
        // Fetch materials based on category and subcategory if subcategory IDs are not empty
        if (!$laminationpaperReelId->isEmpty()) {
            $laminationpapernames = Material::whereIn('category_id', $CategoriesId)
                                            ->whereIn('sub_category', $laminationpaperReelId)
                                            ->get();
        }
        if (!$laminationnameId->isEmpty()) {
            $laminationnames = Material::whereIn('category_id', $CategoriesId)
                                       ->whereIn('sub_category', $laminationnameId)
                                       ->get();
        }
        if (!$laminationGumId->isEmpty()) {
            $laminationgums = Material::whereIn('category_id', $CategoriesId)
                                      ->whereIn('sub_category', $laminationGumId)
                                      ->get();
        }
    }

    $sticchingPackingType = Material::where('id', $productionOrder->sticching_packing_type)->get();

    return view('admin.production-order.view', compact(
        'sticchingPackingType', 'laminationgums', 'laminationnames', 'laminationpapernames',
        'productionOrder', 'products', 'customers', 'salesOrders', 'metaTitle', 'pendingBundleQty','category'
    ));
}

public function edit($id)
{
    $metaTitle = 'Edit Work Order - Cosmic ERP';
    $productionOrder = ProductionOrder::find($id);   
    $recipemasters = RecipeMaster::get();
    // Assuming `customer_order_id` is the foreign key in `production_orders` pointing to `customer_orders` table
    $salesOrderId = $productionOrder->sales_order; // Replace with the correct field if different
    $productId = $productionOrder->product_type;
    // $pendingBundleQty = $this->getCompaniesByProduct($productId, $salesOrderId)->getData()->pending_bdl_kg;
    $data = $this->getCompaniesByProduct($productId, $salesOrderId)->getData();
    $pendingBundleQty = isset($data->pending_bdl_kg) ? $data->pending_bdl_kg : 0; // Default to 0 if not set

    info('pendingBundleQty');
    info($pendingBundleQty);
    // Replace with the correct field if different
    $salesOrders = CustomerOrder::where('customer_id', $productionOrder->company_name)->get();
    
    // Fetch products related to the selected sales order using the existing function
    $productsData = $this->getProductsBySalesOrder($salesOrderId);
    $products = $productsData['products'];
    $productdatas = Product::with(['pipeSizeMaterial', 'outerNameMaterial', 'cartonMaterial'])
    ->orderBy('product_name')
    ->get();

    $customers = Customer::orderBy('first_name')->get();

    // Get category ID for 'Raw material'
    $CategoriesId = MaterialCategory::where('name', 'Raw material')->pluck('id');

    // Initialize variables as empty collections
    $laminationpapernames = collect();
    $laminationnames = collect();
    $laminationgums = collect();
    $materials = Material::get();
    $stickerSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Sticker')->pluck('id');
    $stickers = Material::whereIn('sub_category', $stickerSubCategoryIds)->get();
    // Check if CategoriesId is not empty
    if (!$CategoriesId->isEmpty()) {
        $laminationpaperReelId = MaterialSubCategory::where('sub_cat_name', 'Paper Reel')->pluck('id');
        $laminationnameId = MaterialSubCategory::where('sub_cat_name', 'Lamination Film')->pluck('id');
        $laminationGumId = MaterialSubCategory::where('sub_cat_name', 'Gum')->pluck('id');
        
        // Fetch materials based on category and subcategory if subcategory IDs are not empty
        if (!$laminationpaperReelId->isEmpty()) {
            $laminationpapernames = Material::whereIn('category_id', $CategoriesId)
                                            ->whereIn('sub_category', $laminationpaperReelId)
                                            ->get();
        }
        if (!$laminationnameId->isEmpty()) {
            $laminationnames = Material::whereIn('category_id', $CategoriesId)
                                       ->whereIn('sub_category', $laminationnameId)
                                       ->get();
        }
        if (!$laminationGumId->isEmpty()) {
            $laminationgums = Material::whereIn('category_id', $CategoriesId)
                                      ->whereIn('sub_category', $laminationGumId)
                                      ->get();
        }
    }

    $sticchingPackingType = Material::where('id', $productionOrder->sticching_packing_type)->get();

    return view('admin.production-order.edit', compact(
        'materials','stickers','sticchingPackingType','recipemasters', 'laminationgums', 'laminationnames', 'laminationpapernames',
        'productionOrder', 'products', 'customers', 'salesOrders', 'metaTitle', 'pendingBundleQty','productdatas'
    ));
}



    public function generatePDF($id)
    {
    $category = ProductCategory::get();

        $products = Product::orderBy('product_name')->get();
        $customers = Customer::orderBy('first_name')->get();
        $productionOrder = ProductionOrder::find($id);
        $salesOrders = CustomerOrder::where('customer_id', $productionOrder->company_name)->get();
        $data = compact('productionOrder','products','customers','salesOrders','category');
        $pdf = PDF::loadView('admin.production-order.pdf', $data);

        return $pdf->download('production-order' . $id . '.pdf');
    }
    public function update(Request $request, $id)
    {
info('++++++++++++');
info($request->all());
        $ProductionOrders = ProductionOrder::find($id);

        if ($ProductionOrders) {
            $ProductionOrders->update([
                'production_varient_name' => $request->production_varient_name ?? '',
                'product_type' => $request->product_type ?? '',
                'order_type' => $request->order_type ?? '',
                'company_name' => $request->company_name ?? '',
                'remark' => $request->remark ?? '',
                'sales_order' => $request->sales_order ?? '',
                'qty_required' => $request->qty_required ?? '',
                'pending_bundle_qty' => $request->pending_bundle_quantity ?? '',
                'bundle_quantity' => $request->bundle_quantity ?? '',
                'sku' => $request->sku ?? '',
                'extrusion_gauge' => $request->extrusion_gauge ?? '',
                'extrusion_colour' => $request->extrusion_colour ?? '',
                'extrusion_size' => $request->extrusion_size ?? '',
                'extrusion_recipe' => $request->extrusion_recipe ?? '',
                'extrusion_internal_notes' => $request->extrusion_internal_notes ?? '',
                'extrusion_qty_of_packing' => $request->extrusion_qty_of_packing ?? '',
                'lamination_paper_name' => $request->lamination_paper_name ?? '',
                'lamination_name' => $request->lamination_name ?? '',
                'lamination_gun_name' => $request->lamination_gun_name ?? '',
                'lamination_type' => $request->lamination_type ?? '',
                'lamination_internal_notes' => $request->lamination_internal_notes ?? '',
                'rewinding_pipe' => $request->rewinding_pipe ?? '',
                'rewinding_bharti' => $request->rewinding_bharti ?? '',
                'rewinding_material_name' => $request->rewinding_material_name ?? '',
                'rewinding_internal_notes' => $request->rewinding_internal_notes ?? '',
                'rewinding_sticker' => $request->rewinding_sticker ?? '',
                'rewinding_qty_in_rolls' => $request->rewinding_qty_in_rolls ?? '',
                'rewinding_colour' => $request->rewinding_colour ?? '',
                'rewinding_width' => $request->rewinding_width ?? '',
                'rewinding_qty_in_bundle' => $request->rewinding_qty_in_bundle ?? '',
                'rewinding_length' => $request->rewinding_length ?? '',
                'start_date' => $request->start_date ?? '',
                // 'internal_notes' => $request->internal_notes ?? '',
                'packing_gauge' => $request->packing_gauge ?? '',
                'packing_colour' => $request->packing_colour ?? '',
                'packing_width' => $request->packing_width ?? '',
                'packing_length' => $request->packing_length ?? '',
                'packing_bharti' => $request->packing_bharti ?? '',
                'packing_name' => $request->packing_name ?? '',
                'packing_sticker' => $request->packing_sticker ?? '',
                'packing_carton' => $request->packing_carton ?? '',
                'packing_pipe' => $request->packing_pipe ?? '',
                'packing_outer_name' => $request->packing_outer_name ?? '',
                'packing_qty_rolls' => $request->packing_qty_rolls ?? '',
                'packing_qty_bundle' => $request->packing_qty_bundle ?? '',
                'packing_internal_notes' => $request->packing_internal_notes ?? '',
                'sticching_product_name' => $request->sticching_product_name ?? '',
                'sticching_colour' => $request->sticching_colour ?? '',
                'sticching_packing_name' => $request->sticching_packing_name ?? '',
                'sticching_packing_type' => $request->sticching_packing_type ?? '',
                'sticching_qty_bundle' => $request->sticching_qty_bundle ?? '',
                'sticching_bharti' => $request->sticching_bharti ?? '',
                'sticching_qty_rolls' => $request->sticching_qty_rolls ?? '',
                'sticching_bag' => $request->sticching_bag ?? '',
                'Stitching_internal_notes' => $request->Stitching_internal_notes ?? '',
                'machine' => $request->machine ?? '',
                'date' => $request->date ?? '',
                'shift' => $request->shift ?? '',
            ]);
            $product = Product::find($request->product_name);
            if ($product) {
                if (in_array($product->category, [1, 2])) {
                    // Find existing LaminationProductionOrder
                    $LaminationProductionOrder = LaminationProductionOrder::where('production_order_id', $ProductionOrders->id)->first();
            
                    info('999999');
                    info($LaminationProductionOrder);
                    if ($LaminationProductionOrder) {
                        // Update existing record
                        $LaminationProductionOrder->update([
                            'customer_order_id' => $request->sales_order ?? $LaminationProductionOrder->customer_order_id,
                            'customer_id' => $request->company_name ?? $LaminationProductionOrder->customer_id,
                            'product_id' => $request->product_name ?? $LaminationProductionOrder->product_id,
                            'machine' => $LaminationProductionOrder->machine,
                            'date' => $LaminationProductionOrder->date,
                            'meter' => $LaminationProductionOrder->meter,
                            'status' => 'pending',
                        ]);
                    }
                } else {
                    // Find existing ExtruderProductionOrder
                    $ExtruderProductionOrder = ExtruderProductionOrder::where('production_order_id', $ProductionOrders->id)->first();
            
                    if ($ExtruderProductionOrder) {
                        // Update existing record
                        $ExtruderProductionOrder->update([
                            'lamination_id' => $ExtruderProductionOrder->lamination_id,
                            'customer_order_id' => $request->sales_order ?? $ExtruderProductionOrder->customer_order_id,
                            'customer_id' => $request->company_name ?? $ExtruderProductionOrder->customer_id,
                            'product_id' => $request->product_name ?? $ExtruderProductionOrder->product_id,
                            'machine' => $ExtruderProductionOrder->machine,
                            'date' => $ExtruderProductionOrder->date,
                            'shift' => $ExtruderProductionOrder->shift,
                            'qty' => $ExtruderProductionOrder->qty,
                            'size' => $ExtruderProductionOrder->size,
                            'status' => 'pending',
                        ]);
                    }
                }
            }
            


        } else {
            // Handle the case where the ProductionOrder with the given ID does not exist
        }


        return redirect()->route('production_order.index')->with('success', 'Work order updated successfully');
    }
    // public function getOrdersByCustomer($customerId)
    // {
    //     $orders = CustomerOrder::where('customer_id', $customerId)->where('status', 'pending')->get();

    //     $orderIds = $orders->pluck('id');
    //     info('orderIds');
    //     info($orderIds);
    //     $productOrders = ProductOrder::whereIn('customer_orders_id', $orderIds)->get();
        
    //     $productIds = $productOrders->pluck('product_id');
        
    //     $products = Product::whereIn('id', $productIds)->get();
        
    //     $orders->transform(function ($order) use ($productOrders) {
    //         $orderProductOrders = $productOrders->where('customer_orders_id', $order->id);
            
    //         $order->product_orders = $orderProductOrders;        
    //         return $order;
    //     });

    //     $products->transform(function ($product) use ($productOrders) {
    //         $productProductOrders = $productOrders->where('product_id', $product->id);
        
    //         $product->product_orders = $productProductOrders;        
    //         return $product;
    //     });
        
    //     info('orders');
    //     info($orders);
    //     return response()->json([
    //         'products' => $products,
    //         'orders' => $orders,
    //         'productOrders' => $productOrders,
    //     ]);
    // }

    public function getOrdersByCustomer($customerId)
    {
        // print_r($customerId);
        // exit;
        // Fetch orders for the customer with pending status
        $orders = CustomerOrder::where('customer_id', $customerId)
            ->where('status', 'pending')
            ->get();

        $orderIds = $orders->pluck('id');
        // print_r($orderIds);
        // exit;
        // $productOrders = ProductOrder::whereIn('customer_orders_id', $orderIds)->get();
        // $products = Product::whereIn('id', $productOrders->pluck('product_id'))->get();
        // $Materials = Material::whereIn('id', $productOrders->pluck('sticker_name'))->get();

        // $orders->transform(function ($order) use ($productOrders) {
        //     $order->product_orders = $productOrders->where('customer_orders_id', $order->id);
        //     return $order;
        // });
        // // $formattedOrders = $orders->flatMap(function ($order) use ($materials) {
        // //     // For each order, loop through its product orders
        // //     return $order->product_orders->map(function ($productOrder) use ($order, $materials) {
        // //         // Find the corresponding material data based on sticker_name
        // //         $material = $materials->firstWhere('id', $productOrder->sticker_name);
        
        // //         return [
        // //             'order_id' => $order->id,
        // //             'product_order_id' => $productOrder->id,
        // //             'sticker_name' => $material ? $material->name : null,
        // //             'colour' => $productOrder->colour,
        // //             'remark' => $productOrder->remark,
        // //             'product_id' => $productOrder->product_id,
        // //             'product_name' => $products->firstWhere('id', $productOrder->product_id)->name ?? null,
        // //         ];
        // //     });
        // // });

        // return response()->json([
        //     'orders' => $orders,
        //     'material'=> $Materials, 
        // ]);
        $productOrders = ProductOrder::whereIn('customer_orders_id', $orderIds)->get();
        $products = Product::whereIn('id', $productOrders->pluck('product_id'))->get();
        $materials = Material::whereIn('id', $productOrders->pluck('sticker_name'))->get();

        // Transform orders to attach product orders
        $orders->transform(function ($order) use ($productOrders) {
            // Get all product orders for this specific order
            // $order->product_orders = $productOrders->where('customer_orders_id', $order->id)
            //                                ->pluck('product_id');
            $order->product_orders = $productOrders->where('customer_orders_id', $order->id);
            return $order;
        });
        
        // // Now we'll prepare the response and separate data as needed
        // $formattedOrders = $orders->flatMap(function ($order) use ($materials) {
        //     // For each order, loop through its product orders
        //     return $order->product_orders->map(function ($productOrder) use ($order, $materials) {
        //         // Find the corresponding material data based on sticker_name
        //         $material = $materials->firstWhere('id', $productOrder->sticker_name);

        //         return [
        //             'order_id' => $order->id,
        //             'product_order_id' => $productOrder->id,
        //             'sticker_name' => $material ? $material->material_name : null,
        //             'colour' => $productOrder->colour,
        //             'remark' => $productOrder->remark,
        //             'product_id' => $productOrder->product_id,
        //             'product_name' => $products->firstWhere('id', $productOrder->product_id)->product_name ?? null,
        //         ];
        //     });
        // });

        // Return the transformed response
        return response()->json([
            'orders' => $orders,
            'materials' => $materials,
            'products' => $products,
        ]);
    }
    public function getOrdersBysticker($customerId)
    {
        $Materials = Material::whereIn('id', $customerId)->get();


        return response()->json([
            'materials'=> $Materials, 
        ]);
    }

    public function getProductsBySalesOrder($salesOrderId)
    {
        // Fetch products related to the selected sales order
        $salesOrder = CustomerOrder::with(['productOrders.product'])->find($salesOrderId);
        $products = $salesOrder ? $salesOrder->productOrders->map->product : [];
        info('898989');
        info($products);
        return [
            'products' => $products,
        ];
    }
    public function getMasterPackingData(Request $request)
    {
        
        $masterPacking = $request->input('master_packing');
        $masterPackingID = MaterialSubCategory::where('sub_cat_name',$masterPacking)->pluck('id');
        $packingType = Material::where('sub_category', $masterPackingID)->get();
        return response()->json([
            'success' => true,
            'data' => $packingType,
        ]);
    }



//     public function getCompaniesByProduct($productId,$salesOrderId)
//     {
//         $totalBundleQty = ProductOrder::where('product_id', $productId)
//         ->where('customer_orders_id', $salesOrderId)
//         ->pluck('bdl_kg');

//         $completedProductionBundleQty = ProductionOrder::where('product_type', $productId)
//     ->where('sales_order', $salesOrderId)
//     ->sum('bundle_quantity');

//     $pendingBdlQty = $totalBundleQty - $completedProductionBundleQty;
// info('+++++++++++++');
// info($pendingBdlQty);
        

//         $productOrders = ProductOrder::where('product_id', $productId)->get();
    
//         if ($productOrders->isEmpty()) {
//             return response()->json([
//                 'message' => 'No companies found for this product.',
//                 'companies' => [],
//             ]);
//         }

//         $companyOrderIds = $productOrders->pluck('customer_orders_id');
    
//         $customerOrders = CustomerOrder::whereIn('id', $companyOrderIds)->get();
    
//         $customerIds = $customerOrders->pluck('customer_id');
//         $companies = Customer::whereIn('id', $customerIds)->get();
    
//         if ($companies->isEmpty()) {
//             return response()->json([
//                 'message' => 'No companies found for this product.',
//                 'companies' => [],
//             ]);
//         }

//         return response()->json([
//             'message' => 'Companies fetched successfully.',
//             'companies' => $companies,
//             'bdl_kg' => $totalBundleQty,
//         ]);
//     }

// public function getCompaniesByProduct($productId, $salesOrderId)
// {
//     info('productId');
//     info($productId);
//     info('salesOrderId');
//     info($salesOrderId);
//     $totalBundleQty = ProductOrder::where('product_id', $productId)
//         ->where('customer_orders_id', $salesOrderId)
//         ->pluck('bdl_kg')
//         ->sum();

//     $remark = ProductOrder::where('product_id', $productId)
//         ->where('customer_orders_id', $salesOrderId)
//         ->pluck('remark');

//     $completedProductionBundleQty = ProductionOrder::where('product_type', $productId)
//         ->where('sales_order', $salesOrderId)
//         ->sum('bundle_quantity');

//         info('totalBundleQty');
//         info($totalBundleQty);
//         info('completedProductionBundleQty');
//         info($completedProductionBundleQty);
//     $pendingBdlQty = $totalBundleQty - $completedProductionBundleQty;

//     $productOrders = ProductOrder::where('product_id', $productId)->get();

//     if ($productOrders->isEmpty()) {
//         return response()->json([
//             'message' => 'No companies found for this product.',
//             'companies' => [],
//         ]);
//     }

//     $companyOrderIds = $productOrders->pluck('customer_orders_id');

//     $customerOrders = CustomerOrder::whereIn('id', $companyOrderIds)->get();

//     $customerIds = $customerOrders->pluck('customer_id');

//     $companies = Customer::whereIn('id', $customerIds)->get();

//     if ($companies->isEmpty()) {
//         return response()->json([
//             'message' => 'No companies found for this product.',
//             'companies' => [],
//         ]);
//     }

//     return response()->json([
//         'message' => 'Companies fetched successfully.',
//         'companies' => $companies,
//         'bdl_kg' => $totalBundleQty,
//         'pending_bdl_kg' => $pendingBdlQty,
//         'remark' => $remark,
//     ]);
// }

public function getCompaniesByProduct($productId, $salesOrderId = null)
{
    info('productId: ' . $productId);
    info('salesOrderId: ' . $salesOrderId);

    // Base query for Product Orders
    $productOrderQuery = ProductOrder::where('product_id', $productId);

    // Add condition for salesOrderId if it is provided
    if (!empty($salesOrderId)) {
        $productOrderQuery->where('customer_orders_id', $salesOrderId);
        $sticker_name = $productOrderQuery->pluck('sticker_name');
        $colour = $productOrderQuery->pluck('colour');
    }else {
        // If no salesOrderId, set sticker_name to an empty value (or an empty collection)
        $sticker_name = collect([]);
        $colour = collect([]);
    }

    // Total Bundle Quantity
    $totalBundleQty = $productOrderQuery->pluck('bdl_kg')->sum();

    // Remark (conditionally filtered)
    $remark = $productOrderQuery->pluck('remark');
    
    // $sticker_name = $productOrderQuery->pluck('sticker_name');
    // $stickerSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Sticker')->pluck('id');
    // $allstickers = Material::whereIn('sub_category', $stickerSubCategoryIds)->get();
    // $colour = $productOrderQuery->pluck('colour');

    // Base query for Production Orders
    $productionOrderQuery = ProductionOrder::where('product_type', $productId);

    if (!empty($salesOrderId)) {
        $productionOrderQuery->where('sales_order', $salesOrderId);
    }

    // Completed Production Bundle Quantity
    $completedProductionBundleQty = $productionOrderQuery->sum('bundle_quantity');

    info('totalBundleQty: ' . $totalBundleQty);
    info('completedProductionBundleQty: ' . $completedProductionBundleQty);

    // Pending Bundle Quantity
    $pendingBdlQty = $totalBundleQty - $completedProductionBundleQty;

    // Get all Product Orders for the given product
    $productOrders = ProductOrder::where('product_id', $productId)->get();

    if ($productOrders->isEmpty()) {
        return response()->json([
            'message' => 'No companies found for this product.',
            'companies' => [],
        ]);
    }

    // Extract unique Customer Orders IDs
    $companyOrderIds = $productOrders->pluck('customer_orders_id');

    // Fetch Customer Orders and related Companies
    $customerOrders = CustomerOrder::whereIn('id', $companyOrderIds)->get();
    $customerIds = $customerOrders->pluck('customer_id');

    $companies = Customer::whereIn('id', $customerIds)->get();

    if ($companies->isEmpty()) {
        return response()->json([
            'message' => 'No companies found for this product.',
            'companies' => [],
        ]);
    }
    // $sticker_names = $sticker_name->isEmpty() ? 'data' : $sticker_name;
    // Return the final response
    return response()->json([
        'message' => 'Companies fetched successfully.',
        'companies' => $companies,
        'bdl_kg' => $totalBundleQty,
        'pending_bdl_kg' => $pendingBdlQty,
        'remark' => $remark,
        'sticker_name' => $sticker_name,
        'colour' => $colour,
    ]);
}


    public function destroy($id)
    {
    
        $ProductionOrders = ProductionOrder::findOrFail($id);
        if($ProductionOrders){
            $ProductionOrders->delete();
            return Response::json(['success' => 'Production deleted successfully.']);    
        }
        return Response::json(['error' => 'Production not found.'], 404);

    }
    // public function getProductByMaterial($materialId) {
    //     $materialName = Material::where('id', $materialId)->pluck('material_name')->first();
    //     return response()->json([
    //         'success' => true,
    //         'name' => $materialName ?? '', // Return blank if no name is found
    //     ]);
    // }

    public function getProductByMaterial($materialId) {
        $material = Material::with('category','subCategory')
            ->where('id', $materialId)
            ->first();
    
        return response()->json([
            'success' => true,
            'name' => $material->material_name ?? '', // Material name
            'category_name' => $material->subCategory->sub_cat_name ?? '', // Category name
            'material_weight' => $material->material_weight ?? '', // Category name
            // 'material_name' => $material->material_name ?? '' // Category name
        ]);
    }
    public function getProductByOuter($outerId) {
        $material = Material::with('category')
            ->where('id', $outerId)
            ->first();
    
        return response()->json([
            'success' => true,
            'name' => $material->material_name ?? '', // Material name
        ]);
    }
    public function getProductByCarton($cartonId) {
        $material = Material::with('category')
            ->where('id', $cartonId)
            ->first();
    
        return response()->json([
            'success' => true,
            'name' => $material->material_name ?? '', // Material name
        ]);
    }
    public function getProductBySize($sizeId) {
        $material = Material::with('category')
            ->where('id', $sizeId)
            ->first();
    
        return response()->json([
            'success' => true,
            'name' => $material->material_name ?? '', // Material name
        ]);
    }
    public function getProductBySticker($sizeId) {
        $material = Material::with('category')
            ->where('id', $sizeId)
            ->first();
    
        return response()->json([
            'success' => true,
            'name' => $material->material_name ?? '', // Material name
        ]);
    }
    public function getProductBymaterialName($MaterialNameId) {
        $material = Material::with('category')
            ->where('id', $MaterialNameId)
            ->first();
    
        return response()->json([
            'success' => true,
            'name' => $material->material_name ?? '', // Material name
        ]);
    }
    public function print( $id ){
        $category = ProductCategory::get();
        $materials = Material::get();
        $products = Product::orderBy('product_name')->get();
        $customers = Customer::orderBy('first_name')->get();
        $productionOrder = ProductionOrder::find($id);
        $salesOrders = CustomerOrder::where('customer_id', $productionOrder->company_name)->get();
        return view('admin.production-order.print', compact('productionOrder','materials','products','customers','salesOrders','category'));
    }
}
