<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DataTables;
use Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Request;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel; 
use App\Models\Group;
use App\Models\ProductGroup;
use App\Models\PriceListItem;
use App\Models\ProductCategory;
use App\Models\Material;
use App\Models\MaterialCategory;
use App\Models\MaterialSubCategory;
use App\Models\Outer;
use PDF;
use Illuminate\Validation\ValidationException;
class ProductController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        $metaTitle = 'Product Summary - Cosmic ERP';
        $ProductsName = Product::select('product_name')->groupBy('product_name')->get();
        $Productstype = Product::select('packing_material_type')->groupBy('packing_material_type')->get();
        $materials = Material::whereIn('id', $Productstype->pluck('packing_material_type'))->get();
        $ProductsGaye = Product::select('gage')->groupBy('gage')->get();

        
        if ($request->ajax()) {
        $query = Product::select('id','product_name', 'image', 'group_name', 'alias_sku', 'packing_material_name', 'packing_material_qty', 'bharti', 'number_of_bags_per_box','gage');
                // Make all fields searchable using SearchData
                if (!empty($request->SearchData)) {
                    $search = $request->SearchData;
                    $query->where(function ($q) use ($search) {
                        $q->where('product_name', 'like', "%{$search}%")
                          ->orWhere('alias_sku', 'like', "%{$search}%")
                          ->orWhere('packing_material_qty', 'like', "%{$search}%")
                          ->orWhere('bharti', 'like', "%{$search}%")
                          ->orWhere('number_of_bags_per_box', 'like', "%{$search}%")
                          ->orWhere('gage', 'like', "%{$search}%");
                          $q->orWhereHas('group', function ($q2) use ($search) {
                              $q2->where('name', 'like', "%{$search}%");
                          });
                          $q->orWhereHas('packingMaterial', function ($q3) use ($search) {
                              $q3->where('material_name', 'like', "%{$search}%");
                          });
                    });
                }
        if (!empty($request->pname) ) {
                $query->where('product_name', 'like', "%{$request->pname}%");
            }
        if (!empty($request->ptype) ) {
            $query->where('packing_material_type', 'like', "%{$request->ptype}%");
        }
        if (!empty($request->pgage) ) {
            $query->where('gage', 'like', "%{$request->pgage}%");
        }
        if (!empty($request->MinQty)) {
            $query->where('packing_material_qty', '<=', $request->MinQty);
        }
        // if (!empty($request->SearchData)) {
        //     $query->where('product_name', 'like', "%{$request->SearchData}%");
        // }
        return DataTables::of($query)
            ->addColumn('product_name', function ($product) {
                return $product->product_name ?? '-';
            })

            ->addColumn('image', function ($product) {
                if (!empty($product->image)) {
                    $imageUrl = asset('storage/' . $product->image);
                    return '<img src="' . $imageUrl . '" alt="Product Image" style="max-width:100px">';
                } else {
                    return '<img src="' . asset('storage/placeholder.jpg') . '" alt="No Image" style="max-width:100px">';
                    // Or simply return an empty string
                    return '';
                }
            })
            // ->editColumn('group_name', function ($product) {
            //     return $product->group_name ?? '-';
            // })
            ->addColumn('group_name', function($product){
                $group = ProductGroup::where('id', $product->group_name)->first();
                return $group ? $group->name : '';
                // return $product->group_name ?? '-';
            })
            ->editColumn('alias_sku', function ($product) {
                return $product->alias_sku ?? '-';
            })
            ->editColumn('packing_material_type', function ($product) {
                $materials = Material::where('id', $product->packing_material_name)->first();
                return $materials ? $materials->material_name : '-';
                // return $product->packing_material_type ?? '-';
            })
            ->editColumn('packing_material_qty', function ($product) { 
                return $product->packing_material_qty ?? '-';
            })
            ->editColumn('bharti', function ($product) {
                return $product->bharti ?? '-';
            })
            ->editColumn('number_of_bags_per_box', function ($product) {
                return $product->number_of_bags_per_box ?? '-';
            })
            ->editColumn('gage', function ($product) {
                return $product->gage ?? '-';
            })
            ->addColumn('action', function($product) {
                $pdfUrl = route('product.pdf', $product->id);
                $printUrl = route('product.print', $product->id);
                $viewUrl = route('product.view', $product->id);
                $editUrl = route('products.edit', $product->id);
                $btn = '';
                if (auth()->user()->can('Products Edit')) {
                    $btn = '<a href="' . $editUrl . '" class="btn-sm m-1 confirm-leave-link"><span class="table-group-icons share-icon-tag"></span></a>';
                }
                $btn .= '<a href="' . $viewUrl . '" class="btn-sm m-1 confirm-leave-link"><span class="table-group-icons eye-icon-tag"></span></a>';

                if (auth()->user()->can('Products Pdf')) {
                    $btn .= '<a href="' . $pdfUrl . '" class="btn-sm m-1" target="_blank"><i class="files-group-icons files-icon-tag"></i></a>';    
                }
                if (auth()->user()->can('Products Print')) {
                    $btn .= '<a href="' . $printUrl . '" class="btn-sm m-1" target="_blank"><i class="printss-group-icons printss-icon-tag"></i></a>';    
                }
                if (auth()->user()->can('Products Delete')) {
                    $btn .= '<a href="javascript:void(0)" class="btn-sm m-1 delete-product" data-id="' . $product->id . '"><span class="table-group-icons edit-icon-tag"></span></a>';
                }
                
                return $btn;
            })
            ->rawColumns(['action','image'])
            ->orderColumn('product_name', 'product_name $1')
            ->orderColumn('group_name', 'group_name $1')
            ->make(true);
        }
    
        return view('admin.product.index',compact('ProductsName','Productstype','ProductsGaye','materials','metaTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     $metaTitle = 'Create Product - Cosmic ERP';
    //     $productCategory = ProductCategory::get();
    //     $groups = ProductGroup::orderBy('name')->get();
    //     $materials = Material::get();
    //     $category = MaterialCategory::get();
    //     // $subCategories = MaterialSubCategory::get();
    //     $subCategoriesId = MaterialCategory::where('name', 'Packing Material')->pluck('id');
    //     $subCategories = MaterialSubCategory::where('parent_category_id', $subCategoriesId)->get();
    //     $outerSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Outer')->pluck('id');
    //     $cartonSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Corrug Ated Box')->pluck('id');
    //     $outers = Material::where('sub_category', $outerSubCategoryIds)->get();
    //     $cartons = Material::where('sub_category', $cartonSubCategoryIds)->get();
    //     $paperTubeSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Paper Tube')->pluck('id');
    //     $pipeSizes = Material::where('sub_category', $paperTubeSubCategoryIds)->get();
    //     return view('admin.product.create',compact('metaTitle','productCategory','groups','materials','category','subCategories','outers','cartons','pipeSizes'));
    // }

    public function create()
    {
        $metaTitle = 'Create Product - Cosmic ERP';
        $productCategory = ProductCategory::get();
        $groups = ProductGroup::orderBy('name')->get();
        $materials = Material::get();
        $category = MaterialCategory::get();

        $packingMaterialCategory = MaterialCategory::where('name', 'Packing Material')->first();

        $subCategories = [];
        if ($packingMaterialCategory) {
            $subCategoriesId = $packingMaterialCategory->id;
            $subCategories = MaterialSubCategory::where('parent_category_id', $subCategoriesId)->get();
        }

        $outerSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Outer')->pluck('id');

        $cartonSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Corrug Ated Box')->pluck('id');

        $outers = Material::whereIn('sub_category', $outerSubCategoryIds)->get();
        $cartons = Material::whereIn('sub_category', $cartonSubCategoryIds)->get();

        $paperTubeSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Paper Tube')->pluck('id');

        $pipeSizes = Material::whereIn('sub_category', $paperTubeSubCategoryIds)->get();

        return view('admin.product.create', compact('metaTitle', 'productCategory', 'groups', 'materials', 'category', 'subCategories', 'outers', 'cartons', 'pipeSizes'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // info('555555555555');
        // info($request->all());
        $messages =  [
            'product_name.required' => 'Please enter Product Name.',
            'group_name.required' => 'Please select Group Name.',
            'alias_sku.required' => 'Please enter Alias / SKU.',
            'width.required' => 'Please enter Width in inches.',
            'length.required' => 'Please enter Length in meters.',
            'master_packing.required' => 'Please select the master packing.',
            'bharti.required' => 'Please enter Bharti.',
            'number_of_bags_per_box.required' => 'Please enter Bags/Box.',
           // 'rate.required' => 'Please enter Rate.',
            'packing_material_type.required' => 'Please select Packing Material Sub Category.',
            'packing_material_name.required' => 'Please select packing material name.',
        ];
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'group_name' => 'required',
            'alias_sku' => 'required',
            // 'category' => 'nullable',
            'width' => 'required|numeric',
            'length' => 'nullable|numeric',
            'master_packing' => 'required',
            'bharti' => 'required|integer',
            'number_of_bags_per_box' => 'required|integer',
           // 'rate'=>'required|numeric',
            'packing_material_type'=>'required',
            'packing_material_name'=>'required',
        ],$messages);
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
            'bdl_kg' => isset($request->bdl_kg) ? $request->bdl_kg : '',
            'gram_per_meter' => isset($request->gram_per_meter) ? $request->gram_per_meter : '',
            'packing_material_qty' => isset($request->packing_material_qty)?$request->packing_material_qty:'0',
            'outer_name' => isset($request->outer_name)?$request->outer_name:'',
            'carton_no' => isset($request->carton_no)?$request->carton_no:'',
            'number_of_outer' => isset($request->number_of_outer)?$request->number_of_outer:'0',
            'packing_material_type' => isset($request->packing_material_type)?$request->packing_material_type:'',
           // 'rate' => isset($request->rate)?$request->rate:'',
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

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $metaTitle = 'View Product - Cosmic ERP';
        $groups = ProductGroup::orderBy('name')->get();
        $product = Product::findOrFail($id);
        $materials = Material::where('sub_category', $product->packing_material_type)->get();
        $category = MaterialCategory::get();
        $productCategory = ProductCategory::get();
        
        $packingMaterialCategory = MaterialCategory::where('name', 'Packing Material')->first();

        $subCategories = [];
        if ($packingMaterialCategory) {

            $subCategoriesId = $packingMaterialCategory->id;
            $subCategories = MaterialSubCategory::where('parent_category_id', $subCategoriesId)->get();
        }

        $outerSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Outer')->pluck('id');

        $cartonSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Corrug Ated Box')->pluck('id');

        $cartons = Material::whereIn('sub_category', $cartonSubCategoryIds)->get();
        $outers = Material::whereIn('sub_category', $outerSubCategoryIds)->get();

        $paperTubeSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Paper Tube')->pluck('id');

        $pipeSizes = Material::whereIn('sub_category', $paperTubeSubCategoryIds)->get();
        $selectedCategory = $product->packing_material_category;
        $selectedSubCategory = $product->packing_material_type;
        $selectedMaterial = $product->packing_material_name;

        return view('admin.product.view', compact('metaTitle', 'outers', 'product', 'groups', 'productCategory', 'materials', 'category', 'subCategories', 'selectedCategory', 'selectedSubCategory', 'selectedMaterial', 'cartons', 'pipeSizes'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     $metaTitle = 'Edit Product - Cosmic ERP';
    //     $groups = ProductGroup::orderBy('name')->get();
    //     $product = Product::findOrFail($id);
    //     $materials = Material::where('sub_category',$product->packing_material_type)->get();
    //     $category = MaterialCategory::get();
    //     $productCategory = ProductCategory::get();
    //     // $subCategories = MaterialSubCategory::get();
    //     $selectedCategory = $product->packing_material_category;
    //     $selectedSubCategory = $product->packing_material_type;
    //     $selectedMaterial = $product->packing_material_name;
    //     $subCategoriesId = MaterialCategory::where('name', 'Packing Material')->pluck('id');
    //     $subCategories = MaterialSubCategory::where('parent_category_id', $subCategoriesId)->get();
    //     $outerSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Outer')->pluck('id');
    //     $cartonSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Corrug Ated Box')->pluck('id');
    //     $cartons = Material::where('sub_category', $cartonSubCategoryIds)->get();
    //     $outers = Material::where('sub_category',$outerSubCategoryIds)->get();
    //     $paperTubeSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Paper Tube')->pluck('id');
    //     $pipeSizes = Material::where('sub_category', $paperTubeSubCategoryIds)->get();
    //     // $outers = Outer::get();
    //     return view('admin.product.edit', compact('metaTitle','outers', 'product', 'groups','productCategory','materials','category','subCategories','selectedCategory','selectedSubCategory','selectedMaterial','cartons','pipeSizes'));
    // }

    public function edit($id)
    {
    $metaTitle = 'Edit Product - Cosmic ERP';
    $groups = ProductGroup::orderBy('name')->get();
    $product = Product::findOrFail($id);
    $materials = Material::where('sub_category', $product->packing_material_type)->get();
    $category = MaterialCategory::get();
    $productCategory = ProductCategory::get();
    
    $packingMaterialCategory = MaterialCategory::where('name', 'Packing Material')->first();

    $subCategories = [];
    if ($packingMaterialCategory) {

        $subCategoriesId = $packingMaterialCategory->id;
        $subCategories = MaterialSubCategory::where('parent_category_id', $subCategoriesId)->get();
    }

    $outerSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Outer')->pluck('id');

    $cartonSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Corrug Ated Box')->pluck('id');

    $cartons = Material::whereIn('sub_category', $cartonSubCategoryIds)->get();
    $outers = Material::whereIn('sub_category', $outerSubCategoryIds)->get();

    $paperTubeSubCategoryIds = MaterialSubCategory::where('sub_cat_name', 'Paper Tube')->pluck('id');

    $pipeSizes = Material::whereIn('sub_category', $paperTubeSubCategoryIds)->get();
    $selectedCategory = $product->packing_material_category;
    $selectedSubCategory = $product->packing_material_type;
    $selectedMaterial = $product->packing_material_name;

    return view('admin.product.edit', compact('metaTitle', 'outers', 'product', 'groups', 'productCategory', 'materials', 'category', 'subCategories', 'selectedCategory', 'selectedSubCategory', 'selectedMaterial', 'cartons', 'pipeSizes'));
    }

    public function print($id)
    {
        $groups = ProductGroup::orderBy('name')->get();
        $product = Product::findOrFail($id);
        $materials = Material::get();
        $category = MaterialCategory::get();
        $productCategory = ProductCategory::get();
        $subCategory = MaterialSubCategory::get();
        $selectedCategory = $product->packing_material_category;
        $selectedSubCategory = $product->packing_material_type;
        $selectedMaterial = $product->packing_material_name; 
        $subcategoriesname = MaterialSubCategory::where('id',$selectedSubCategory)->get();
        $outers = Outer::get();
        return view('admin.product.print', compact('subcategoriesname','outers', 'product', 'groups','productCategory','materials','category','subCategory','selectedCategory','selectedSubCategory','selectedMaterial'));
    }
    public function generatePDF($id)
    {
        $groups = ProductGroup::orderBy('name')->get();
        $product = Product::findOrFail($id);
        $materials = Material::get();
        $category = MaterialCategory::get();
        $productCategory = ProductCategory::get();
        $subCategory = MaterialSubCategory::get();
        $selectedCategory = $product->packing_material_category;
        $selectedSubCategory = $product->packing_material_type;
        $selectedMaterial = $product->packing_material_name; 
        $outers = Outer::get();
        $subcategoriesname = MaterialSubCategory::where('id',$selectedSubCategory)->get();
        $data = compact('outers','subcategoriesname', 'product', 'groups','productCategory','materials','category','subCategory','selectedCategory','selectedSubCategory','selectedMaterial');
        $pdf = PDF::loadView('admin.product.pdf', $data);

        return $pdf->download('product' . $id . '.pdf');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // print_r($request->number_of_outer);
        // exit;
        // print_r($request->input('number_of_outer'));
        // exit;
        info('*************');
        info($request->all());
        $messages =  [
            'product_name.required' => 'Please enter Product Name.',
            'group_name.required' => 'Please select Group Name.',
            'alias_sku.required' => 'Please enter Alias / SKU.',
            'width.required' => 'Please enter Width in inches.',
            'length.required' => 'Please enter Length in meters.',
            // 'master_packing.required' => 'Please select the master packing.',
            'bharti.required' => 'Please enter Bharti.',
            'number_of_bags_per_box.required' => 'Please enter Bags/Box.',
            //'rate.required' => 'Please enter Rate.',
            'packing_material_type.required' => 'Please select Packing Material Sub Category.',
            'packing_material_name.required' => 'Please select packing material name.',
        ];
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'group_name' => 'required',
            'alias_sku' => 'required',
            // 'category' => 'nullable',
            'width' => 'required|numeric',
            'length' => 'required|numeric',
            // 'master_packing' => 'required',
            'bharti' => 'required|integer',
            'number_of_bags_per_box' => 'required|integer',
           // 'rate'=>'required|numeric',
            'packing_material_type'=>'required',
            'packing_material_name'=>'required',
        ],$messages);
    $product = Product::findOrFail($id);
    $product->update([
        'product_name' => $request->input('product_name') ?? $product->product_name,
        'group_name' => $request->input('group_name') ?? $product->group_name,
        'alias_sku' => $request->input('alias_sku') ?? $product->alias_sku,
        'category' => $request->input('category') ?? $product->category,
        'width' => $request->input('width') ?? $product->width,
        'length' => $request->input('length') ?? $product->length,
        'gage' => $request->input('gage') ?? $product->gage,
        'master_packing' => $request->input('master_packing') ?? $product->master_packing,
        'bharti' => $request->input('bharti') ?? $product->bharti,
        'number_of_bags_per_box' => $request->input('number_of_bags_per_box') ?? $product->number_of_bags_per_box,
        'pipe_size' => $request->input('pipe_size') ?? $product->pipe_size,
        'rolls_in_1_bdl' => $request->input('rolls_in_1_bdl') ?? $product->rolls_in_1_bdl,
        'roll_weight' => $request->input('roll_weight') ?? $product->roll_weight,
        'sheet_weight' => $request->input('sheet_weight') ?? $product->sheet_weight,
        'roll_weight_to_sheet_weight' => $request->input('roll_weight_to_sheet_weight') ?? $product->roll_weight_to_sheet_weight,
        
        'bdl_kg' => $request->input('bdl_kg', $product->bdl_kg),
        'gram_per_meter' => $request->input('gram_per_meter') ?? $product->gram_per_meter,
        // 'bdl_kg' => $request->input('bdl_kg') ?? $product->bdl_kg,
        'packing_material_qty' => $request->input('packing_material_qty') ?? $product->packing_material_qty,
        'outer_name' => $request->input('outer_name') ?? $product->outer_name,
        'carton_no' => $request->input('carton_no') ?? $product->carton_no,
        'number_of_outer' => $request->input('number_of_outer') ?? $product->number_of_outer,
        'packing_material_type' => $request->input('packing_material_type') ?? $product->packing_material_type,
       // 'rate' => $request->input('rate') ?? $product->rate,
        //'packing_material_category' => $request->input('packing_material_category') ?? $product->packing_material_category,
        'packing_material_name' => $request->input('packing_material_name') ?? $product->packing_material_name,
        ]);
    

    // $product->fill($validatedData);

    // if ($request->hasFile('image')) {
    //     // Delete old image if exists
    //     if ($product->image) {
    //         $oldImagePath = 'public/' . $product->image;
    //         if (Storage::exists($oldImagePath)) {
    //             Storage::delete($oldImagePath);
    //         }
    //     }

    //     // Upload new image
    //     $image = $request->file('image');
    //     $filename = time() . '_' . date('Ymd_His') . '.' . $image->getClientOriginalExtension();
    //     $path = $image->storeAs('public/img/product_images', $filename);

    //     // Check if the file was successfully stored
    //     if ($path) {
    //         $product->image = 'img/product_images/' . $filename; // Save relative path to the image
    //     } else {
    //         // Handle the case where image upload failed
    //         // For example, log an error or set a default image path
    //         // $product->image = null; // Optionally set image to null or default path
    //     }
    // }

    //$product->save();
    // PriceListItem::where('product_id', $product->id)->update([
    //     'rate' => $product->rate,
    //     //'min_qty' => $product->min_quantity,
    // ]);


    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if($product){
            if ($product->image) {
                // Get the image path
                $imagePath = 'public/' . $product->image;
                // Check if the image file exists and delete it
                if (Storage::exists($imagePath)) {
                    Storage::delete($imagePath);
                }
            }
            $product->delete();
            return Response::json(['success' => 'Product deleted successfully.']);    
        }
        return Response::json(['error' => 'Product not found.'], 404);

    }

    public function get_student_data(){
        return Excel::download(new ProductExport, 'students.xlsx');
    }
    public function storeGroup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $group = new ProductGroup;
        $group->name = $request->name;
        $group->save();

        return response()->json([
            'success' => true,
            'group' => [
                'id' => $group->id,
                'name' => $group->name,
            ],
        ]);
    }
    public function productgroupadd(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:191|unique:product_groups,name',
            ], [
                'name.unique' => 'This Product Group name has already been taken. Please choose a different name.',
            ]);
    
            $transform = ProductGroup::create($request->all());
    
            return response()->json([
                'success' => 'Data saved successfully!',
                'newOption' => [
                    'value' => $transform->id,
                    'text' => $transform->name
                ]
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation error occurred.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while saving the group.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getSubcategories($id)
    {
        $subcategories = MaterialSubCategory::where('parent_category_id', $id)->get();
        $subcategory = MaterialSubCategory::where('parent_category_id', $id)->first();
        if ($subcategory) {
            $materials = Material::where('category_id', $id)
                                 ->where('sub_category', $subcategory->id)
                                 ->get();
        }
        return response()->json([
            'subcategories' => $subcategories,
            'materials'     => $materials,
        ]);
    }

public function getMaterials($categoryId, $subcategoryId = null)
{
    info('999999999');
    info($categoryId);
    info($subcategoryId);
    
    if ($subcategoryId) {
        info('****');
        $materials = Material::where('category_id', $categoryId)
                                 ->where('sub_category', $subcategoryId)
                                 ->get();
        // $materials = Material::where('sub_category', $subcategoryId)
                            //  ->get();
    } else {
        info('++++');
        $materials = Material::where('category_id', $categoryId)->get();
    }
info($materials);
    return response()->json([
        'materials' => $materials,
    ]);
}

public function getMaterialsBySubCat($subcategoryId)
{
    
    if ($subcategoryId) {
        $materials = Material::where('sub_category', $subcategoryId)
                                 ->get();
    } 
    info('****');
info($materials);
    return response()->json([
        'materials' => $materials,
    ]);
}

}
