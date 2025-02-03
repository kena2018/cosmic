<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;
use DataTables;
use App\Models\Product;
use App\Models\MaterialCategory;
use App\Models\MaterialSubCategory;
use Illuminate\Support\Facades\Response;
use PDF;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        $metaTitle = 'Material Summary - Cosmic ERP';
        if ($request->ajax()) {
            $query = Material::with('product') 
            ->select([
                'id', 'material_name', 'category_id','sub_category', 'quantity', 'unit',
                'remark',
            ]);
            if ($request->has('SearchData') && !empty($request->SearchData)) {
                $search = $request->get('SearchData');
                $query->where(function ($q) use ($search) {
                    $q->where('quantity', 'like', '%' . $search . '%')
                      ->orWhere('unit', 'like', '%' . $search . '%')
                      ->orWhere('material_name', 'like', '%' . $search . '%')
                      ->orWhere('id', 'like', '%' . $search . '%')
                      ->orWhereHas('category', function ($categoryQuery) use ($search) {
                          $categoryQuery->where('name', 'like', '%' . $search . '%');
                      })
                      ->orWhereHas('subCategory', function ($materialSubQuery) use ($search) {
                          $materialSubQuery->where('sub_cat_name', 'like', '%' . $search . '%');
                      });
                });
                // $query->where(function($q) use ($search) {
                //     $q->where('material_name', 'like', '%' . $search . '%')
                //       ->orWhere('quantity', 'like', '%' . $search . '%')
                //       ->orWhere('unit', 'like', '%' . $search . '%')
                //       ->orWhere('remark', 'like', '%' . $search . '%');
                // })
                // ->orWhereHas('category', function($query) use ($search) {
                //     $query->where('name', 'like', '%' . $search . '%');
                // })
                // ->orWhereHas('subCategory', function($query) use ($search) {
                //     $query->where('name', 'like', '%' . $search . '%');
                // });
            }
    
            return DataTables::of($query)
                ->editColumn('category_id', function ($material) {
                    if ($material->category_id == 'raw_material') {
                        return 'Raw Material';
                    }
                    return $material->category ? $material->category->name : '-'; 
                })
                ->editColumn('sub_category', function ($material) {
                    return $material->subCategory ? $material->subCategory->sub_cat_name : '-';
                })
                ->editColumn('quantity', function ($order) {
                    return $order->quantity ?? '-';
                    // return $order->created_at ? $order->created_at->format('Y-m-d H:i:s') : '-';
                })
                ->editColumn('unit', function ($order) {
                    return $order->unit ?? '-';
                    // return $order->created_at ? $order->created_at->format('Y-m-d H:i:s') : '-';
                })
                ->editColumn('created_at', function ($order) {
                    return $order->created_at ? $order->created_at->format('Y-m-d H:i:s') : '-';
                })
                ->editColumn('updated_at', function ($order) {
                    return $order->updated_at ? $order->updated_at->format('Y-m-d H:i:s') : '-';
                })
                ->addColumn('action', function($order) {
                    $editUrl = route('material.edit', $order->id);
                    $viewUrl = route('material.view', $order->id);
                    // $deleteUrl = route('material.destroy', $order->id);
                    $pdfUrl = route('material.pdf', $order->id);
                    $printUrl = route('material.print', $order->id);
                    $btn = '';
                    if (auth()->user()->can('material Edit')) {
                        $btn = '<a href="' . $editUrl . '" class="btn-sm m-1 confirm-leave-link"><span class="table-group-icons share-icon-tag"></span></a>';
                    }
                    
                    $btn .= '<a href="' . $viewUrl . '" class="btn-sm m-1 confirm-leave-link"><span class="table-group-icons eye-icon-tag"></span></a>';
                    if (auth()->user()->can('material Pdf')) {
                        $btn .= '<a href="' . $pdfUrl . '" class="btn-sm m-1" target="_blank"><i class="files-group-icons files-icon-tag"></i></a>';
                    }
                    if (auth()->user()->can('material Print')) {
                        $btn .= '<a href="' . $printUrl . '" class="btn-sm m-1" target="_blank"><i class="printss-group-icons printss-icon-tag"></i></a>';
                    }
                    if (auth()->user()->can('material Delete')) {
                        $btn .= '<a href="javascript:void(0)" class="btn-sm m-1 delete-material" data-id="' . $order->id . '"><span class="table-group-icons edit-icon-tag"></span></a>';
                    }
                    // $btn .= '<a href="javascript:void(0)" class="btn-sm m-1 delete-customer" data-id="' . $order->id . '"><span class="table-group-icons edit-icon-tag"></span></a>';

                    return $btn;
                })
                ->orderColumn('quantity', 'quantity $1')
                ->orderColumn('unit', 'unit $1')
                ->rawColumns(['action'])
                ->make(true);
        }
    
        return view('admin.materials.index',compact('metaTitle'));
    }

    public function create()
    {
        $metaTitle = 'Create Material - Cosmic ERP';
        $products = Product::orderBy('product_name')->get();

       $category = MaterialCategory::get();
        return view('admin.materials.add',compact('products','category','metaTitle'));
    }

    public function store(Request $request)
    {
        $messages = [
            'category_id.required' => 'Please select Material Category.',
            'sub_category.required' => 'Please select Sub Category.',
            'material_name.required'=> 'Please enter Material Name.',
            'material_width.nullable'=> 'Please enter Material Name.',
            'unit1.required' => 'Please enter  unit 1.',
        ];
        $validatedData = $request->validate([
            'category_id' => 'required',
            'sub_category' => 'nullable|string|max:255',
            'material_name' => 'required|string|max:255',
            'material_width' => 'nullable',
            'unit1' => 'required|string|max:255',
            'unit2' => 'nullable|string|max:255',
            'material_weight' => 'required|numeric|min:0',
            'remark' => 'nullable|string|max:255',
            'material_product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], $messages);


        // $subCategoryId = null;

        // if ($request->filled('sub_category')) {

        //     $subCategory = new MaterialSubCategory();
        //     $subCategory->sub_cat_name = $request->input('sub_category');
        //     $subCategory->parent_category_id = $request->input('category_id');
        //     $subCategory->status = 'active';

        //     $subCategory->save();

        //     $subCategoryId = $subCategory->id; 
        // }

        $material = new Material([
            'category_id' => isset($request->category_id)?$request->category_id :'',
            'sub_category' => isset($request->sub_category)?$request->sub_category :'',
            'material_name' => isset($request->material_name)?$request->material_name :'',
            'material_width' => isset($request->material_width)?$request->material_width :'',
            'quantity' => isset($request->unit1)?$request->unit1 :'',
            'unit' => isset($request->unit2)?$request->unit2 :'',
            'material_weight' => isset($request->material_weight)?$request->material_weight :'',
            'remark' => isset($request->remark)?$request->remark :'',
            
        ]);
        // $material->save();

        // $material = new Material();
        // $material->category_id = $request->input('category_id');
        // $material->sub_category = $request->input('sub_category');
        // $material->material_name = $request->input('material_name');
        // $material->quantity = $request->input('unit1');
        // $material->unit = $request->input('unit2');
        // $material->remark = $request->input('remark');
        if ($request->hasFile('material_product_image')) {
            $image = $request->file('material_product_image');
            $imagePath = $image->store('material_images', 'public');
            $material->material_product_image = $imagePath;
        }

        $material->save();

        return redirect()->route('material.index')->with('success', 'Material created successfully.');
    }

    public function edit($id)
    {
        $metaTitle = 'Edit Material - Cosmic ERP';
        $products = Product::orderBy('product_name')->get();
        $material = Material::findOrFail($id);
        $category = MaterialCategory::get();
    
        // Retrieve subcategories based on the material's category_id
        $subcategories = MaterialSubCategory::where('parent_category_id', $material->category_id)->get();
    
        return view('admin.materials.edit', compact('material', 'products', 'category', 'subcategories','metaTitle'));
    }
    public function show($id)
    {
        $metaTitle = 'View Material - Cosmic ERP';
        $products = Product::orderBy('product_name')->get();
        $material = Material::findOrFail($id);
        $category = MaterialCategory::get();
    
        // Retrieve subcategories based on the material's category_id
        $subcategories = MaterialSubCategory::where('parent_category_id', $material->category_id)->get();
    
        return view('admin.materials.view', compact('material', 'products', 'category', 'subcategories','metaTitle'));
    }
    public function print($id)
    {
        $products = Product::orderBy('product_name')->get();
        $material = Material::findOrFail($id);
        
        $category = MaterialCategory::get();
        $subCategory = MaterialSubCategory::get();
        // $subCategory = null;
        // if ($material->sub_category) {
        //     $subCategory = MaterialSubCategory::find($material->sub_category);
        // }

        return view('admin.materials.print', compact('material', 'products', 'category', 'subCategory'));
    }

    public function generatePDF($id)
    {
        $products = Product::orderBy('product_name')->get();
        $material = Material::findOrFail($id);
        $category = MaterialCategory::get();

        $subCategory = null;
        if ($material->sub_category) {
            $subCategory = MaterialSubCategory::find($material->sub_category);
        }
        $data = compact('material', 'products', 'category', 'subCategory');
        $pdf = PDF::loadView('admin.materials.pdf', $data);

        return $pdf->download('material' . $id . '.pdf');
    }


    public function update(Request $request, $id)
    {
        $messages = [
            'category_id.required' => 'Please select a valid material category.',
            'sub_category.required' => 'Please enter a valid material name.',
            'unit1.required' => 'Please enter a valid unit 1.',
        ];
        $validatedData = $request->validate([
            'category_id' => 'required',
            'sub_category' => 'required|string|max:255',
            'material_name' => 'required|string|max:255',
            'material_width' => 'nullable',
            'unit1' => 'required|string|max:255',
            'unit2' => 'nullable|string|max:255',
            'material_weight' => 'required|numeric|min:0',
            'remark' => 'nullable|string|max:255',
            'material_product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], $messages);
        $material = Material::findOrFail($id);
        $material->update([
            'category_id' => $request->input('category_id') ?? '',
            'sub_category' => $request->input('sub_category') ?? '',
            'material_name' => $request->input('material_name') ?? '',
            'material_width' => $request->input('material_width') ?? '',
            'quantity' => $request->input('unit1') ?? '',
            'unit' => $request->input('unit2') ?? '',
            'material_weight' => $request->input('material_weight') ?? '',
            'remark' => $request->input('remark') ?? '',
            
        ]);
        // $material = Material::findOrFail($id);
        // $material->category_id = $request->input('category_id');
        // $material->sub_category = $request->input('sub_category');
        // $material->material_name = $request->input('material_name');
        // $material->quantity = $request->input('unit1');
        // $material->unit = $request->input('unit2');
        // $material->remark = $request->input('remark');

        if ($request->hasFile('material_product_image')) {
            $imagePath = $request->file('material_product_image')->store('material_images', 'public');
            $material->material_product_image = $imagePath;
        }

        $material->save();

        return redirect()->route('material.index')->with('success', 'Material updated successfully.');
    }

    public function destroy($id)
    {
        $materials = Material::findOrFail($id);
        if($materials){
            $materials->delete();
            return Response::json(['success' => 'Material deleted successfully.']);    
        }
        return Response::json(['error' => 'Material not found.'], 404);
    }
}
