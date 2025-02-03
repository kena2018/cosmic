<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PriceList;
use App\Models\PriceListItem;
use Illuminate\Http\Request;
use App\Models\Product;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PriceListExport;
use Illuminate\Support\Facades\Validator;
use PDF;
use App\Models\MaterialSubCategory;

class PriceListController extends Controller
{
    public function index(Request $request)
    {
        $metaTitle = 'Group Price Summary - Cosmic ERP';
        if ($request->ajax()) {
            $query = PriceList::withCount('priceListItems')->orderBy('id', 'desc');

            if (!empty($request->SearchData)) {
                $search = $request->SearchData;
                $query->where('list_name', 'like', "%{$search}%")
               ->orwhere('discount', 'like', "%{$search}%");
                // ->orwhere('price_list_items_count', 'like', "%{$search}%");
            }

            $data = $query->get();

            return DataTables::of($data)
                ->addColumn('list_name', function ($priceList) {
                    return $priceList->list_name;
                })
                ->addColumn('discount', function ($priceList) {
                    return $priceList->discount ? $priceList->discount . '%' : '-';
                    // return $priceList->discount;
                })
                ->addColumn('created_at', function ($priceList) {
                    return $priceList->created_at ? $priceList->created_at->format('d-m-Y') : 'N/A';
                })
                ->addColumn('updated_at', function ($priceList) {
                    return $priceList->updated_at ? $priceList->updated_at->format('d-m-Y') : 'N/A';
                })
                ->addColumn('product_count', function ($priceList) {
                    return $priceList->price_list_items_count;
                })
                ->addColumn('actions', function ($priceList) {
                    $editUrl = route('price-list.edit', $priceList->id);
                    $viewUrl = route('price-list.view', $priceList->id);
                    $deleteUrl = route('price-list.destroy', $priceList->id);
                    $printUrl = route('price-list.print', $priceList->id);
                    $pdfUrl = route('price-list.pdf', $priceList->id);
                    $btn = '';
                    if (auth()->user()->can('Group Pricing Edit')) {
                        $btn = '<a href="' . $editUrl . '" class="btn-sm m-1 confirm-leave-link"><span class="table-group-icons share-icon-tag"></span></a>';
                    }
                    $btn .= '<a href="' . $viewUrl . '" class="btn-sm m-1 confirm-leave-link"><span class="table-group-icons eye-icon-tag"></span></a>';
                    if (auth()->user()->can('Group Pricing Pdf')) {
                        $btn .= '<a href="' . $pdfUrl . '" class="btn-sm m-1" target="_blank"><i class="files-group-icons files-icon-tag"></i></a>';
                    }
                    if (auth()->user()->can('Group Pricing Print')) {
                        $btn .= '<a href="' . $printUrl . '" class="btn-sm m-1" target="_blank"><i class="printss-group-icons printss-icon-tag"></i></a>';
                        
                    }
                    if (auth()->user()->can('Group Pricing Delete')) {
                        $btn .= '<a href="javascript:void(0)" class="btn-sm m-1 delete-product" data-id="' . $priceList->id . '" data-url="' . $deleteUrl . '" data-bs-toggle="modal" data-bs-target="#productModal"><span class="table-group-icons edit-icon-tag"></span></a>';
                    }
                    
                    return $btn;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        $products = Product::all();

        return view('admin.price-list.index', compact('products','metaTitle'));
    }
    public function show($id) {
        $metaTitle = 'View Group Price - Cosmic ERP';
        $priceList = PriceList::findOrFail($id);
        $products = Product::all();
        $PriceListItems = PriceListItem::where('price_list_id',$id)->get();
        return view('admin.price-list.view', compact('priceList', 'products','PriceListItems','metaTitle'));
    }
    
    public function edit(Request $request, $id)
    {
        $metaTitle = 'Edit Group Price - Cosmic ERP';
        $priceList = PriceList::findOrFail($id);
    
        // foreach ($priceList->items as $item) {
        //     $product = $item->product;
        //     $rate = $product->rate ?? 0;
        //     $discountRate = $rate - ($rate * $priceList->discount / 100);

        //     if ($item->discount_rate !== $discountRate) {
        //         $item->update([
        //             'rate' => $rate,
        //             'discount_rate' => $discountRate,
        //         ]);
        //     }
        // }
    
        // if ($request->ajax()) {
        //     $data = PriceListItem::with('product')
        //         ->where('price_list_id', $id)
        //         ->distinct()
        //         ->get();
    
        //     return DataTables::of($data)
        //         ->addColumn('product_name', function ($item) {
        //             return $item->product->product_name ?? '-';
        //         })
        //         ->addColumn('min_qty', function ($item) {
        //             return $item->min_qty ?? '-';
        //         })
        //         ->addColumn('rate', function ($item) {
        //             return $item->rate ?? '-';
        //         })
        //         ->addColumn('discount_rate', function ($item) {
        //             return $item->discount_rate ?? '-';
        //         })
        //         ->addColumn('special_rate', function ($item) {
        //             return '<input type="text" class="form-control special-rate" data-id="' . $item->id . '" value="' . ($item->special_rate ?? '') . '">';
        //         })
        //         ->addColumn('actions', function ($item) {
        //             $deleteUrl = route('price-list-item.delete', $item->id);
        //             return '<a href="javascript:void(0)" class="btn-sm m-1 delete-product" data-id="' . $item->id . '" data-url="' . $deleteUrl . '" data-bs-toggle="modal" data-bs-target="#productModal"><span class="table-group-icons edit-icon-tag"></span></a>';
        //         })
        //         ->rawColumns(['actions', 'special_rate'])
        //         ->make(true);
        // }
    
        $products = Product::all();
        $PriceListItems = PriceListItem::where('price_list_id',$id)->get();
        return view('admin.price-list.edit', compact('priceList', 'products','PriceListItems','metaTitle'));
    }  

    public function generatePDF($id)
    {
        $priceList = PriceList::findOrFail($id);
        $products = Product::all();
        $MaterialSubCategories = MaterialSubCategory::all();
        $PriceListItems = PriceListItem::where('price_list_id',$id)
        ->join('products', 'price_list_items.product_id', '=', 'products.id')
        ->select('price_list_items.*', 'products.master_packing', 'products.product_name','products.packing_material_type')
        // ->leftJoin('MaterialSubCategory', 'products.packing_material_type', '=', 'MaterialSubCategory.id')
        ->get();
        // print_r($PriceListItems);
        // exit;
        $groupedItems = $PriceListItems->groupBy('master_packing');
        $groupedData = [];
        $groupedItems = $PriceListItems->groupBy(function ($item) {
            return $item->master_packing ?? 'Unknown'; // Group by master_packing or 'Unknown'
        });
        foreach ($PriceListItems as $item) {
            $masterPacking = $item->master_packing ?? 'Unknown'; // Handle null or missing values
            $productId = $item->product_id;
        
            // Create a group for the master_packing type
            $groupedData[$masterPacking][] = [
                'ProductID' => $productId,
                'MasterPacking' => $masterPacking,
            ];
        }
        if (isset($groupedData['Bag']) && isset($groupedData['Box'])) {
            $combinedGroup = array_merge($groupedData['Bag'], $groupedData['Box']);
            $groupedData['BagAndBox'] = $combinedGroup;
        
            // Optionally unset Bag and Box if you want only the combined group
            unset($groupedData['Bag'], $groupedData['Box']);
        }
        
        // print_r($groupedData);
        // exit;
        // return view('admin.price-list.pdf', compact('MaterialSubCategories','priceList','groupedData', 'products','PriceListItems','groupedItems'));
        $data = compact('MaterialSubCategories','priceList','groupedData', 'products','PriceListItems','groupedItems');
        // $data = compact('priceList', 'products','PriceListItems');
        $pdf = PDF::loadView('admin.price-list.pdf', $data);
        return $pdf->download('group-pricing' . $id . '.pdf');
        // return view('admin.price-list.pdf', compact('priceList', 'products','PriceListItems'));

    }
    public function print($id)
    {
        $priceList = PriceList::findOrFail($id);
        $products = Product::all();
        $PriceListItems = PriceListItem::where('price_list_id',$id)->get();
        return view('admin.price-list.print', compact('priceList', 'products','PriceListItems'));
    }
    // public function update(Request $request, $id)
    // {
    //     $messages = [
    //         'list_name.required' => 'Please enter List Name.',
    //         'discount.required' => 'Please enter Discount.',
    //         'product_id.required' => 'Please select Product Name.',
    //         'min_qty.required' => 'Please enter Min QTY',
    //         'rate.required' => 'Please enter Rate.',
    //     ];
    //     $validatedData = $request->validate([
    //         'list_name' => 'required|string|max:255',
    //         'discount' => 'required|numeric|min:0|max:100',
    //         // 'product_id' => 'nullable|array',
    //         'product_id.*' => 'required_with:product_name|exists:products,id',
    //         'special_rate.*' => 'nullable|numeric|min:0',
    //         'min_qty.*' => 'required|numeric|min:0',
    //     ], [
    //         'discount.numeric' => 'The discount must be a valid number.', // Custom error message
    //         'discount.min' => 'The discount cannot be less than 0.',
    //         'discount.max' => 'The discount cannot be greater than 100.',
    //         'min_qty.*.required' =>'The minimum quantity is required.',
    //     ], $messages);
    //     $priceList = PriceList::findOrFail($id);
    
    //     $priceList->update([
    //         'list_name' => $request->list_name ?? '',
    //         'discount' => $request->discount ?? '',

    //     ]);
    //     PriceListItem::where('price_list_id', $id)->delete();
    
    //     if (!empty($validatedData['product_id'])) {
    //         foreach ($validatedData['product_id'] as $index => $productId) {
    //             $product = Product::findOrFail($productId);
    //             $rate = $product->rate ?? 0;
    //             $discountRate = $rate - ($rate * $validatedData['discount'] / 100);
    
    //             PriceListItem::updateOrCreate(
    //                 [
    //                     'price_list_id' => $priceList->id,
    //                     'product_id' => $productId,
    //                 ],
    //                 [
    //                     'min_qty' => $validatedData['min_qty'][$index] ?? null,
    //                     'rate' => $rate,
    //                     'discount_rate' => $discountRate,
    //                     'special_rate' => $validatedData['special_rate'][$index] ?? null,
    //                 ]
    //             );
    //         }
    //     }
    
    //     foreach ($priceList->items as $item) {
    //         $product = $item->product;
    //         $rate = $product->rate ?? 0;
    //         $discountRate = $rate - ($rate * $validatedData['discount'] / 100);
    
    //         if ($item->rate !== $rate || $item->discount_rate !== $discountRate) {
    //             $item->update([
    //                 'rate' => $rate,
    //                 'discount_rate' => $discountRate,
    //             ]);
    //         }
    //     }  
    //     return redirect()->route('price-list.index', $id)->with('success', 'Price list updated successfully.');
    // }  
    
    public function update(Request $request, $id)
{
    $messages = [
        'list_name.required' => 'Please enter List Name.',
        'discount.required' => 'Please enter Discount.',
        'product_id.required' => 'Please select Product Name.',
        'min_qty.required' => 'Please enter Min QTY.',
        'rate.required' => 'Please enter Rate.',
    ];

    $validatedData = $request->validate([
        'list_name' => 'required|string|max:255',
        'discount' => 'required|numeric|min:0|max:100',
        'product_id.*' => 'required_with:product_name|exists:products,id',
        'special_rate.*' => 'nullable|numeric|min:0',
        'min_qty.*' => 'required|numeric|min:0',
        'rate.*' => 'required|numeric|min:0',
        'discount_rate.*' => 'required|numeric|min:0',
    ], [
        'discount.numeric' => 'The discount must be a valid number.',
        'discount.min' => 'The discount cannot be less than 0.',
        'discount.max' => 'The discount cannot be greater than 100.',
        'min_qty.*.required' => 'The minimum quantity is required.',
    ], $messages);

    // Update the price list record
    $priceList = PriceList::findOrFail($id);
    $priceList->update([
        'list_name' => $request->list_name ?? '',
        'discount' => $request->discount ?? '',
    ]);

    // Delete existing items associated with this price list
    PriceListItem::where('price_list_id', $id)->delete();

    // Recreate items with data from the request
    if (!empty($validatedData['product_id'])) {
        foreach ($validatedData['product_id'] as $index => $productId) {
            PriceListItem::create([
                'price_list_id' => $priceList->id,
                'product_id' => $productId,
                'min_qty' => $validatedData['min_qty'][$index] ?? null, //rate - (rate * discount / 100);
                'rate' => $validatedData['rate'][$index] ?? null, // Use rate from the request
                // 'discount_rate' => $validatedData['rate'][$index] -($validatedData['rate'][$index]*$request->discount/100) ?? null, // Use discount rate from the request
                'discount_rate' => $validatedData['discount_rate'][$index]  ?? null, // Use discount rate from the request
                'special_rate' => $validatedData['special_rate'][$index] ?? null,
            ]);
        }
    }

    return redirect()->route('price-list.index', $id)->with('success', 'Price list updated successfully.');
}


    public function updateSpecialRate(Request $request, $id)
    {
        $request->validate([
            'special_rate' => 'nullable|numeric|min:0',
        ]);

        $priceListItem = PriceListItem::findOrFail($id);

        $priceListItem->update([
            'special_rate' => $request->input('special_rate'),
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $priceList = PriceList::findOrFail($id);

        if ($priceList) {
            $priceList->items()->delete();

            $priceList->delete();

            return response()->json(['success' => 'PriceList and its related items deleted successfully.']);    
        }

        return response()->json(['error' => 'PriceList not found.'], 404);
    }
    public function export($id)
    {
        $priceList = PriceList::findOrFail($id);
        $items = PriceListItem::with('product')
            ->where('price_list_id', $id)
            ->get();

        return Excel::download(new PriceListExport(
            $items, 
            $priceList->list_name, 
            $priceList->discount
        ), 'price_list.xlsx');
    }



    public function create()
    {
        $metaTitle = 'Create Group Price - Cosmic ERP';
        $products = Product::all();

        return view('admin.price-list.create', compact('products','metaTitle'));
    }

    // public function store(Request $request)
    // {
    //     info('5555');
    //     info($request->all());
    //     if ($request->has('discount')) {
    //         $discount = $request->input('discount');
            
    //         if (is_string($discount)) {
    //             $discount = str_replace('%', '', $discount);
    //         }

    //         $request->merge(['discount' => $discount]);
    //     }
    //     $messages = [
    //         'list_name.required' => 'Please enter List Name.',
    //         'discount.required' => 'Please enter Discount.',
    //         'product_id.required' => 'Please select Product Name.',
    //         'min_qty.required' => 'Please enter Min QTY.',
    //         'rate.required' => 'Please enter Rate.',
    //     ];
    //     $validatedData = $request->validate([
    //         'list_name' => 'required|string|max:255',
    //         'discount' => 'required|numeric|min:0|max:100',
    //         'product_id.*' => 'required_with:product_name|exists:products,id',
    //         'special_rate.*' => 'nullable|numeric|min:0',
    //         'min_qty.*' => 'required|numeric|min:0',
    //     ], [
    //         'discount.numeric' => 'The discount must be a valid number.',
    //         'discount.min' => 'The discount cannot be less than 0.',
    //         'discount.max' => 'The discount cannot be greater than 100.',
    //         'min_qty.*.required' =>'The minimum quantity is required.',
    //     ], $messages);

    //     $priceList = PriceList::create([
    //         'list_name' =>isset($request->list_name)?$request->list_name :'',
    //         'discount' =>isset($request->discount)?$request->discount :'',
    //     ]);

    //     if (!empty($validatedData['product_id'][0])) {

    //         foreach ($validatedData['product_id'] as $index => $productId) {
    //             $product = Product::findOrFail($productId);

    //             $rate = $product->rate ?? 0;

    //             $discountRate = $rate - ($rate * $validatedData['discount'] / 100);

    //             PriceListItem::create([
    //                 'price_list_id' => $priceList->id,
    //                 'product_id' => $productId,
    //                 'min_qty' => $validatedData['min_qty'][$index] ?? null,
    //                 'rate' => $rate,
    //                 'discount_rate' => $discountRate,
    //                 'special_rate' => $validatedData['special_rate'][$index] ?? null,
    //             ]);
    //         }
    //     }
    //     return redirect()->route('price-list.index')->with('success', 'Price list created successfully.');
    // }

    public function store(Request $request)
        {
            info('5555');
            info($request->all());

            if ($request->has('discount')) {
                $discount = $request->input('discount');

                if (is_string($discount)) {
                    $discount = str_replace('%', '', $discount);
                }

                $request->merge(['discount' => $discount]);
            }

            $messages = [
                'list_name.required' => 'Please enter List Name.',
                'discount.required' => 'Please enter Discount.',
                'product_id.required' => 'Please select Product Name.',
                'min_qty.required' => 'Please enter Min QTY.',
                'rate.required' => 'Please enter Rate.',
            ];

            $validatedData = $request->validate([
                'list_name' => 'required|string|max:255',
                'discount' => 'required|numeric|min:0|max:100',
                'product_id.*' => 'required_with:product_name|exists:products,id',
                'special_rate.*' => 'nullable|numeric|min:0',
                'min_qty.*' => 'required|numeric|min:0',
                'rate.*' => 'required|numeric|min:0',
                'discount_rate.*' => 'required|numeric|min:0',
            ], [
                'discount.numeric' => 'The discount must be a valid number.',
                'discount.min' => 'The discount cannot be less than 0.',
                'discount.max' => 'The discount cannot be greater than 100.',
                'min_qty.*.required' => 'The minimum quantity is required.',
            ], $messages);

            $priceList = PriceList::create([
                'list_name' => $request->list_name ?? '',
                'discount' => $request->discount ?? '',
            ]);

            if (!empty($validatedData['product_id'][0])) {
                foreach ($validatedData['product_id'] as $index => $productId) {
                    PriceListItem::create([
                        'price_list_id' => $priceList->id,
                        'product_id' => $productId,
                        'min_qty' => $validatedData['min_qty'][$index] ?? null,
                        'rate' => $validatedData['rate'][$index] ?? null, // Use rate from the request
                        'discount_rate' => $validatedData['discount_rate'][$index] ?? null, // Use discounted rate from the request
                        'special_rate' => $validatedData['special_rate'][$index] ?? null,
                    ]);
                }
            }

            return redirect()->route('price-list.index')->with('success', 'Price list created successfully.');
        }

    public function deletePriceListItem($id)
    {
        try {
            $priceListItem = PriceListItem::findOrFail($id);

            $priceListItem->delete();

            return redirect()->back()->with('success', 'Price list item deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the price list item.');
        }
    }


}
