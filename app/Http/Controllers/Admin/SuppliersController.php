<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Suppliers;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;
use DataTables;
use Session;
use Illuminate\Support\Facades\Response;
use App\Rules\GstNumber;
use App\Models\Material;
use App\Models\MaterialSubCategory;

use PDF;

class SuppliersController extends Controller
{
    // public function index(Request $request)
    // {
        
    //     if ($request->ajax()) {
    //     $searchData = $request->input('SearchData');
    //     $query = Suppliers::with('material')->select('id','name', 'company_name', 'city','state','contect_cmp','material');
    //     if (!empty($searchData)) {
    //         $cityId = City::where('name', 'like', "%{$searchData}%")->pluck('id')->first();
    //         $query->where(function ($query) use ($searchData, $cityId) {
    //             $query->where('company_name', 'like', "%{$searchData}%")
    //                 ->orWhere('name', 'like', "%{$searchData}%")
    //                 // ->orWhere('material', 'like', "%{$searchData}%")
    //                 ->orWhere('contect_cmp', 'like', "%{$searchData}%")
    //                 ->orWhere('city', $cityId); // Match city ID if available
                    
    //         });
    //         $query->orWhereHas('material', function ($q) use ($searchData) { // singular 'material'
    //             $q->where('material_name', 'like', "%{$searchData}%");
    //         });
    //     }
    //     return DataTables::of($query)
            
    //         ->editColumn('company_name', function ($suppliers) {
    //             return $suppliers->company_name ?? '-';
    //         })
    //         ->editColumn('name', function ($supplier) {
    //             return $supplier->name ?? '-';
    //         })
    //         ->editColumn('city', function ($supplier) {
    //             $city = City::where('id', $supplier->city)->first();
    //             return $city ? $city->name : '';

    //         })
            
    //         ->editColumn('material', function ($supplier) {
    //             $material = Material::where('id', $supplier->material)->first();
    //             return $material ? $material->material_name : '';
    //             // return $supplier->material ?? '-'; // Accessing the related material's name
    //         })
    //         ->editColumn('state', function ($supplier) {
    //             $state = State::where('id', $supplier->state)->first();
    //             return $state ? $state->name : '';
    //         })

    //         ->editColumn('contect_cmp', function ($supplier) {
    //             return $supplier->contect_cmp ?? '-';
    //         })
    //         ->addColumn('action', function($supplier) {

    //             $editUrl = route('suppliers.edit', $supplier->id);
    //             $btn = '<a href="' . $editUrl . '" class="btn-sm m-1"><span class="table-group-icons share-icon-tag"></span></a>';
    //             $btn .= '<a href="javascript:void(0)" class="btn-sm m-1 delete-supplier" data-id="' . $supplier->id . '"><span class="table-group-icons edit-icon-tag"></span></a>';
    //             return $btn;
    //         })
    //         ->rawColumns(['action'])
    //         ->make(true);
    //     }
    
    //     return view('admin.suppliers.index');
    // }
    public function index(Request $request){
        // $query = Suppliers::with('material')->select(
        //     'suppliers.id',
        //     'suppliers.name',
        //     'suppliers.company_name',
        //     'suppliers.contect_cmp',
        //     'suppliers.material')
        //     ->leftJoin('cities', 'suppliers.city', '=', 'cities.id')
        //     ->leftJoin('states', 'suppliers.state', '=', 'states.id');
        //     foreach($query as $data){
        //         var_dump($data->name);
        //         exit;
        //     }
        $metaTitle = 'Supplier Summary - Cosmic ERP';
        if ($request->ajax()) {
            $query = Suppliers::with('material')->select(
                'suppliers.id',
                'suppliers.name',
                'suppliers.company_name',
                'suppliers.contect_cmp',
                'suppliers.material',
                'cities.name as city_name',
                'states.name as state_name')
                ->leftJoin('cities', 'suppliers.city', '=', 'cities.id')
                ->leftJoin('states', 'suppliers.state', '=', 'states.id');
            if (!empty($request->SearchData)) {
                $search = $request->SearchData;
                
                $query->where(function ($q) use ($search) {
                    $q->where('suppliers.name', 'like', "%{$search}%")
                        ->orWhere('suppliers.company_name', 'like', "%{$search}%")
                        ->orWhere('suppliers.contect_cmp', 'like', "%{$search}%")
                        ->orWhere('cities.name', 'like', "%{$search}%")
                        ->orWhere('states.name', 'like', "%{$search}%");
                });
                
                $query->orWhereHas('material', function ($q) use ($search) {
                    $q->where('material_name', 'like', "%{$search}%");
                });
            // });
            }
            return DataTables::of($query)
            ->editColumn('company_name', function ($suppliers) {
                return $suppliers->company_name ?? '-';
            })
            ->editColumn('name', function ($supplier) {
                return $supplier->name ?? '-';
            })
            ->addColumn('city', function ($supplier) {
                // $city = City::where('id', $supplier->city)->first();
                // return $city ? $city->name : '';
                return $supplier->city_name ?? '';
            })
            ->editColumn('material', function ($supplier) {
                $material = MaterialSubCategory::where('id', $supplier->material)->first();
                return $material ? $material->sub_cat_name : '';
                // return $supplier->material ?? '-'; // Accessing the related material's name
            })
            ->addColumn('state', function ($supplier) {
                return $supplier->state_name ?? '';
            })
            ->editColumn('contect_cmp', function ($supplier) {
                return $supplier->contect_cmp ?? '-';
            })
            ->addColumn('action', function($supplier) {
                $pdfUrl = route('supplier.pdf', $supplier->id);
                $viewUrl = route('suppliers.view', $supplier->id);
                $editUrl = route('suppliers.edit', $supplier->id);
                $printUrl = route('suppliers.print', $supplier->id);
                $btn ='';
                if (auth()->user()->can('Suppliers Edit')) {
                    $btn = '<a href="' . $editUrl . '" class="btn-sm m-1 confirm-leave-link"><span class="table-group-icons share-icon-tag"></span></a>';
                    
                }
                $btn .= '<a href="' . $viewUrl . '" class="btn-sm m-1 confirm-leave-link"><span class="table-group-icons eye-icon-tag"></span></a>';
                if (auth()->user()->can('Suppliers Pdf')) {
                    $btn .= '<a href="' . $pdfUrl . '" class="btn-sm m-1" target="_blank"><i class="files-group-icons files-icon-tag"></i></a>';
                }
                if (auth()->user()->can('Suppliers Print')) {
                    $btn .= '<a href="' . $printUrl . '" class="btn-sm m-1" target="_blank"><i class="printss-group-icons printss-icon-tag"></i></a>';
                }
                if (auth()->user()->can('Suppliers Delete')) {
                    $btn .= '<a href="javascript:void(0)" class="btn-sm m-1 delete-supplier" data-id="' . $supplier->id . '"><span class="table-group-icons edit-icon-tag"></span></a>';
                }
                return $btn;
            })
            ->rawColumns(['action'])
            ->orderColumn('company_name', 'suppliers.company_name $1')
            ->orderColumn('city', 'cities.name $1')
            ->orderColumn('state', 'states.name $1')
            ->orderColumn('name', 'suppliers.name $1')
            ->orderColumn('contect_cmp', 'suppliers.contect_cmp $1')
            ->make(true);
        }
        
        return view('admin.suppliers.index',compact('metaTitle'));
    }
    public function getFaqData(Request $request){
        $suppliers = Suppliers::latest()->get();
        return DataTables::of($suppliers)
        ->editColumn('supplier_id', function ($suppliers) {
            return isset($suppliers->id) ? $suppliers->id : '';
        })
        ->editColumn('company_name', function ($suppliers) {
            return isset($suppliers->company_name) ? $suppliers->company_name : '';
        })
        ->editColumn('contect_name', function ($suppliers) {
            return isset($suppliers->name) ? $suppliers->name : '';
        })
        ->editColumn('city', function ($suppliers) {
            return isset($suppliers->city) ? $suppliers->city : '';
        })
        
        ->editColumn('material', function ($suppliers) {
            return isset($suppliers->material) ? $suppliers->material : '';
        })
        ->editColumn('contect_number', function ($suppliers) {
            return isset($suppliers->contect_cmp) ? $suppliers->contect_cmp : '';
        })
        ->editColumn('added_on', function ($suppliers) {
            return '-';
        })
        
        ->addColumn('action', function ($suppliers) {
            return
                '<a class="badge badge-light-primary text-start me-2 action-edit" href="' . route('suppliers.edit', [$suppliers->id]) . '"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>' .
                '<button class="badge badge-light-danger text-start action-delete openModalBtn" onclick="confirmDelete1('.$suppliers->id.')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash" style="color: #f00;"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></button>';
        })
        ->rawColumns(['action']) // Specify 'status' column as raw HTML
        ->make(true);
    }

    public function add(Request $request){
        return view('admin.suppliers.add');
    }
    public function create( Request $request ){
        $metaTitle = 'Create Supplier - Cosmic ERP';
        $countrys = Country::get();
        $gstTypes = ['Registered', 'Unregistered', 'Composition Taxpayer', 'SEZ','Overseas'];
        $materials = MaterialSubCategory::get(); 
        return view('admin.suppliers.create',compact('countrys','gstTypes','materials','metaTitle'));
    }

    public function store(Request $request){
        // print_r($request->country_id);
        // exit;
        $messages = [
            'company_name.required'=> 'Please enter Company Name.',
            'gst_number.required'=> 'Please enter GST number.',
            'contect_cmp.required'=>'Please enter Phone No.',
            'address.required'=>'Please enter Address.',
            'pincode.required'=>'Please enter Pincode.',
            'country_id.required'=>'Please select Country.',
            'state_id.required'=>'Please select State.',
            'city_id.required'=>'Please select City.',
            'material.required'=>'Please select Material Sub Category.',
            'name.required'=>'Please enter Name.',
        ];
        $request->validate([
            'company_name' => 'required|string|max:255',
            'gst_number' => ['required', new GstNumber, 'unique:suppliers,gst_number'],
            'contect_cmp' => 'required|digits_between:10,13',
            'address' => 'required|string|max:255',
            'pincode' => 'required|digits:6',
            'country_id'=>'required|string|max:255',
            'state_id'=>'required|string|max:255',
            'city_id'=>'required|string|max:255',
            'material'=>'required|string|max:255',
            'name' => 'required|string|max:255',
            'contact' => 'nullable|digits_between:10,13',
            'gst_type' => 'nullable|string|max:255',
        ], $messages);
        // $request->validate([
        //     'company_name' => 'string|max:255',
        //     'gst_number' => [ new GstNumber, 'unique:suppliers,gst_number'],
        //     'contect_cmp' => 'digits_between:10,13',
        //     'address' => 'string|max:255',
        //     'pincode' => 'digits:6',
        //     'country_id'=>'string|max:255',
        //     'state_id'=>'string|max:255',
        //     'city_id'=>'string|max:255',
        //     'material'=>'string|max:255',
        //     'name' => 'string|max:255',
        //     'email' => 'email|max:255',
        //     'contact' => 'digits_between:10,13',
        //     // 'gst_number' => 'nullable|string|max:255',
        //     'gst_type' => 'nullable|string|max:255',
        //     'email_cmp' => 'nullable|email|max:255',
        // ], $messages);
        


        // Create a new supplier
        $supplier = new Suppliers([
            'name' => isset($request->name)?$request->name :'',
            'email' => isset($request->email)?$request->email:'',
            'contect' => isset($request->contact)?$request->contact:'',
            'gst_number' => isset($request->gst_number)?$request->gst_number:'',
            'gst_type' => isset($request->gst_type)?$request->gst_type:'',
            'company_name' => isset($request->company_name)?$request->company_name:'',
            'email_cmp' => isset($request->email_cmp)?$request->email_cmp:'',
            'contect_cmp' => isset($request->contect_cmp)?$request->contect_cmp:'',
            'address1' => isset($request->address)?$request->address:'',
            'address2' => isset($request->address2)?$request->address2:'',
            'pincode' => isset($request->pincode)?$request->pincode:'0',
            'city' => isset($request->city_id)?$request->city_id:'',
            'state' => isset($request->state_id)?$request->state_id:'',
            'country' => isset($request->country_id)?$request->country_id:'',
            'material' => isset($request->material)?$request->material:'',
        ]);

        // Save the supplier
        $supplier->save();

        // Redirect with a success message
        return redirect()->route('suppliers.index')
                        ->with('success','Supplier added successfully');
    }

    public function edit(Request $request,$id){
        $metaTitle = 'Edit Supplier - Cosmic ERP';
        $suppliers = Suppliers::findOrFail($id);
        $countries = Country::get();
        $materials = MaterialSubCategory::get();
        $gstTypes = ['Registered', 'Unregistered', 'Composition Taxpayer', 'SEZ','Overseas'];
        return view('admin.suppliers.edit', compact('suppliers','gstTypes','countries','materials','metaTitle'));
    }
    public function show($id)
    {
        $metaTitle = 'View Supplier - Cosmic ERP';
        $suppliers = Suppliers::findOrFail($id);
        $countries = Country::get();
        $states = State::where('country_id', $suppliers->country)->get();
        $cities = City::where('state_id', $suppliers->state)->get();

        $materials = MaterialSubCategory::get();
        $gstTypes = ['Registered', 'Unregistered', 'Composition Taxpayer', 'SEZ','Overseas'];
        return view('admin.suppliers.view', compact('suppliers','states','cities','gstTypes','countries','materials','metaTitle'));
    }
    public function print(Request $request,$id){
        $suppliers = Suppliers::findOrFail($id);
        $countries = Country::get();
        $states = State::where('country_id', $suppliers->country)->get();
        $cities = City::where('state_id', $suppliers->state)->get();
        $materials = Material::get();
        $gstTypes = ['CGST', 'SGST', 'IGST', 'UTGST'];
        return view('admin.suppliers.print', compact('suppliers','states','cities','gstTypes','countries','materials'));
    }
    public function generatePDF($id)
    {
        $supplier = Suppliers::findOrFail($id);
        $countries = Country::get();
        $states = State::where('country_id', $supplier->country)->get();
        $cities = City::where('state_id', $supplier->state)->get();
        $materials = Material::get();
        $gstTypes = ['CGST', 'SGST', 'IGST', 'UTGST'];
        $data = compact('supplier','gstTypes','countries','materials','states','cities');
        $pdf = PDF::loadView('admin.suppliers.pdf', $data);

        return $pdf->download('supplier' . $id . '.pdf');
    }

    public function update(Request $request, $id){
        // print_r($request->contect);
        // exit;
        $messages = [
            'company_name.required'=> 'Please enter Company Name.',
            'gst_number.required'=> 'Please enter GST number.',
            'contect_cmp.required'=>'Please enter Phone No.',
            'address.required'=>'Please enter Address.',
            'pincode.required'=>'Please enter Pincode.',
            'country_id.required'=>'Please select Country.',
            'state_id.required'=>'Please select State.',
            'city_id.required'=>'Please select City.',
            'material.required'=>'Please select Material Sub Category.',
            'name.required'=>'Please enter Name.',
        ];
        $request->validate([
            'company_name' => 'required|string|max:255',
            'gst_number' => ['required', new GstNumber, 'unique:suppliers,gst_number,'.$id],
            'contect_cmp' => 'required|digits_between:10,13',
            'address' => 'required|string|max:255',
            'pincode' => 'required|digits:6',
            'country_id'=>'required|string|max:255',
            'state_id'=>'required|string|max:255',
            'city_id'=>'required|string|max:255',
            'material'=>'required|string|max:255',
            'name' => 'required|string|max:255',
            // 'email' => 'nullable|email|max:255',
            'contect' => 'nullable|digits_between:10,13',
            'gst_type' => 'nullable|string|max:255',
            // 'company_name' => 'required|string|max:255',
            'email_cmp' => 'nullable|email|max:255',
        ], $messages);
        // $request->validate([
        //     'company_name' => 'string|max:255',
        //     'gst_number' => [ new GstNumber, 'unique:suppliers,gst_number,'.$id],
        //     'contect_cmp' => 'digits_between:10,13',
        //     'address' => 'string|max:255',
        //     'pincode' => 'digits:6',
        //     'country_id'=>'string|max:255',
        //     'state_id'=>'string|max:255',
        //     'city_id'=>'string|max:255',
        //     'material'=>'string|max:255',
        //     'name' => 'string|max:255',
        //     'email' => 'nullable|email|max:255',
        //     'contect' => 'digits_between:10,13',
        //     'gst_type' => 'nullable|string|max:255',
        //     'company_name' => 'string|max:255',
        //     'email_cmp' => 'nullable|email|max:255',
        // ], $messages);
        $supplier = Suppliers::findOrFail($id);
        $supplier->update([
            'name' => $request->input('name') ?? $supplier->name,
        'email' => $request->input('email') ?? $supplier->email,
        'contect' => $request->input('contect') ?? $supplier->contect,
        'gst_number' => $request->input('gst_number') ?? $supplier->gst_number,
        'gst_type' => $request->input('gst_type') ?? $supplier->gst_type,
        'company_name' => $request->input('company_name') ?? $supplier->company_name,
        'email_cmp' => $request->input('email_cmp') ?? $supplier->email_cmp,
        'contect_cmp' => $request->input('contect_cmp') ?? $supplier->contect_cmp,
        'address1' => $request->input('address') ?? $supplier->address,
        'address2' => $request->input('address2') ?? $supplier->address2,
        'pincode' => $request->input('pincode') ?? $supplier->pincode,
        'city' => $request->input('city_id') ?? $supplier->city,
        'state' => $request->input('state_id') ?? $supplier->state,
        'country' => $request->input('country_id') ?? $supplier->country,
        'material' => $request->input('material') ?? $supplier->material,
        ]);
        // $supplier->update($request->all());

        // Redirect with success message
        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully');
    }
    public function softDelete(DeleteUserFormRequest $request)
    {
        print_r($id);
        exit;
        $data = $request->validated();
        $supplier = Suppliers::find($data['id']);
        if ($supplier) {
            $supplier->delete();
            return redirect()->route('suppliers.index')->with('success', __('Supplier deleted successfully'));
        }

    }

    public function destroy($id)
    {
        $supplier = Suppliers::findOrFail($id);
        if($supplier){
            $supplier->delete();
            return Response::json(['success' => 'supplier deleted successfully.']);    
        }
        return Response::json(['error' => 'supplier not found.'], 404);

    }
}
