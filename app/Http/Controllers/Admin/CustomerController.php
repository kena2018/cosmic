<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerOrder;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Group;
use App\Models\Color;
use Illuminate\Support\Facades\Log;
use App\Rules\GstNumber;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Validation\ValidationException;




class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index( Request $request)
    // {
    //     $metaTitle = 'Customer - Summary';
    //     info('in this section');

    //     $totalRecords = Customer::count();
    //     $activeCustomers = Customer::where('status', 1)->count();
    //     // Count of inactive customers
    //     $inactiveCustomers = Customer::where('status', 'inactive')->count();
        
    //     if ($request->ajax()) {
    //     $query = Customer::with(['State','City'])->select('id','company_name','state_id', 'first_name', 'last_name','city_id','contect', 'group','matrix','status');
    //     if (!empty($request->SearchData)) {
    //         $query->where('company_name', 'like', "%{$request->SearchData}%")
    //             ->orwhere('first_name', 'like', "%{$request->SearchData}%")
    //             ->orwhere('last_name', 'like', "%{$request->SearchData}%")
    //             ->orwhere('contect', 'like', "%{$request->SearchData}%")
    //             ->orwhere('group', 'like', "%{$request->SearchData}%")
    //             ->orwhere('matrix', 'like', "%{$request->SearchData}%")
    //             // ->orwhere('last_order', 'like', "%{$request->SearchData}%")
    //             ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$request->SearchData}%"]);

    //         $query->orWhereHas('city', function($q) use ($request) {
    //             $q->where('name', 'like', "%{$request->SearchData}%");
    //         });
    //     }
    //     return DataTables::of($query)
    //         ->addColumn('full_name', function ($customer) {
    //             return $customer->first_name . ' ' . $customer->last_name;
    //         })->orderColumn('full_name', function ($query, $order) {
    //             $query->orderBy('first_name', $order)
    //                   ->orderBy('last_name', $order);
    //         })
    //         ->editColumn('company_name', function ($customer) {
    //             return $customer->company_name ?? '-';
    //         })
    //         ->editColumn('contect', function ($customer) {
    //             return $customer->contect ?? '-';
    //         })
    //         ->addColumn('city_name', function ($customer) {
    //             return $customer->city ? $customer->city->name : '-';
    //         })
    //         ->addColumn('state_name', function ($customer) {
    //             return $customer->state ? $customer->state->name : '-';
    //         })
    //         ->editColumn('group', function ($customer) {
    //             return $customer->group ?? '-';
    //         })
    //         ->editColumn('matrix', function ($customer) {
    //             return $customer->matrix ?? '-';
    //         })
    //         // ->editColumn('last_order', function ($customer) {
    //         //     return '-';
    //         // })
    //         ->editColumn('last_order', function ($customer) {
    //             $lastOrder = $customer->orders->first(); // Get the latest order
    //             return $lastOrder ? $lastOrder->created_at->format('Y-m-d') : '-'; // Format the date or return '-'
    //         })
    //         // ->editColumn('status', function ($customer) {
    //         //     return $customer->status ?? '-';
    //         // })
    //         ->editColumn('status', function ($customer) {
    //             // Adjust the condition based on your status values
    //             $checked = ($customer->status === 'active') ? 'checked' : '';
    //             return '<label class="switch">
    //                         <input type="checkbox" class="toggle-status" data-id="' . $customer->id . '" ' . $checked . '>
    //                         <span class="slider round"></span>
    //                     </label>';
    //         })
    //         ->addColumn('action', function($customer) {
    //             $editUrl = route('customers.edit', $customer->id);
    //             $btn = '<a href="' . $editUrl . '" class="btn-sm m-1"><span class="table-group-icons share-icon-tag"></span></a>';
    //             // $btn .= '<a href="javascript:void(0)" class="btn-sm m-1 delete-customer" data-id="' . $customer->id . '"><span class="table-group-icons edit-icon-tag"></span></a>';
    //             $hasPendingOrder = CustomerOrder::where('customer_id', $customer->id)
    //                 ->where('status', 'pending')
    //                 ->exists();
    //                 if ($hasPendingOrder) {
    //                     $btn .= '<a href="javascript:void(0)" class="btn-sm m-1 pending-order" data-id="' . $customer->id . '" data-toggle="tooltip" title="Transation has been added do not delete customer."><i class=" fas fa-info-circle"style="font-size: 24px; width: 10px; height: 40px; line-height: 40px;"></i></a>';
    //                     // $btn .= '<a href="javascript:void(0)" class="btn-sm m-1 pending-order" data-id="' . $customer->id . '"><span class="table-group-icons eye-icon-tag"></span></a>';
    //                 }else{
    //                     $btn .= '<a href="javascript:void(0)" class="btn-sm m-1 delete-customer" data-id="' . $customer->id . '"><span class="table-group-icons edit-icon-tag"></span></a>';
    //                 }
    //             return $btn;
    //         })
    //         ->rawColumns(['status','action'])
            
    //         ->make(true);
    //     }
    
    //     return view('admin.customers.index',compact('totalRecords','activeCustomers','inactiveCustomers','metaTitle'));
    // }

    public function index(Request $request)
    {
        $metaTitle = 'Customers Summary - Cosmic ERP';

        $totalRecords = Customer::count();
        $activeCustomers = Customer::where('status', 1)->count();
        $inactiveCustomers = Customer::where('status', 'inactive')->count();
    
        if ($request->ajax()) {

            $query = Customer::with(['State', 'City', 'orders'])
                ->select('customers.id', 'customers.company_name', 'customers.state_id', 
                         'customers.first_name', 'customers.last_name', 'customers.city_id', 
                         'customers.contect', 'customers.group', 'customers.matrix', 'customers.status')
                ->leftJoin('cities', 'customers.city_id', '=', 'cities.id');
    
            if (!empty($request->SearchData)) {
                $query->where('customers.company_name', 'like', "%{$request->SearchData}%")
                    ->orWhere('customers.first_name', 'like', "%{$request->SearchData}%")
                    ->orWhere('customers.last_name', 'like', "%{$request->SearchData}%")
                    ->orWhere('customers.contect', 'like', "%{$request->SearchData}%")
                    ->orWhere('customers.group', 'like', "%{$request->SearchData}%")
                    ->orWhere('customers.matrix', 'like', "%{$request->SearchData}%")
                    ->orWhereRaw("CONCAT(customers.first_name, ' ', customers.last_name) LIKE ?", ["%{$request->SearchData}%"]);
                    
                $query->orWhere('cities.name', 'like', "%{$request->SearchData}%");
            }

            if ($request->has('order')) {
                $orderColumn = $request->get('columns')[$request->get('order')[0]['column']]['name'];
                $orderDirection = $request->get('order')[0]['dir'];

                if ($orderColumn == 'city_name') {
                    $query->orderBy('cities.name', $orderDirection);
                } elseif ($orderColumn == 'last_order') {
                    $query->leftJoin('customer_orders', 'customers.id', '=', 'customer_orders.customer_id')
                        ->select('customers.id', 'customers.company_name', 'customers.state_id', 
                                 'customers.first_name', 'customers.last_name', 'customers.city_id', 
                                 'customers.contect', 'customers.group', 'customers.matrix', 
                                 'customers.status', DB::raw('MAX(customer_orders.created_at) as last_order'))
                        ->groupBy('customers.id', 'customers.company_name', 'customers.state_id', 
                                  'customers.first_name', 'customers.last_name', 'customers.city_id', 
                                  'customers.contect', 'customers.group', 'customers.matrix', 'customers.status')
                        ->orderBy('last_order', $orderDirection);
                } else {
                    if ($orderColumn == 'full_name') {
                        $query->orderBy('customers.first_name', $orderDirection)
                              ->orderBy('customers.last_name', $orderDirection);
                    } else {
                        $query->orderBy("customers.{$orderColumn}", $orderDirection);
                    }
                }
            }
    
            return DataTables::of($query)
                ->addColumn('full_name', function ($customer) {
                    return $customer->first_name . ' ' . $customer->last_name;
                })
                ->orderColumn('full_name', function ($query, $order) {
                    $query->orderBy('customers.first_name', $order)
                          ->orderBy('customers.last_name', $order);
                })
                ->addColumn('group', function($customer){
                    $group = Group::where('id', $customer->group)->first();
                    return $group ? $group->name : '';
                    // return $product->group_name ?? '-';
                })
                ->addColumn('city_name', function ($customer) {
                    return $customer->city ? $customer->city->name : '-';
                })
                ->addColumn('state_name', function ($customer) {
                    return $customer->state ? $customer->state->name : '-';
                })
                ->editColumn('status', function ($customer) {
                    $checked = ($customer->status === 'active') ? 'checked' : '';
                    return '<label class="switch">
                                <input type="checkbox" class="toggle-status" data-id="' . $customer->id . '" ' . $checked . '>
                                <span class="slider round"></span>
                            </label>';
                })
                ->addColumn('action', function ($customer) {
                    $editUrl = route('customers.edit', $customer->id);
                    $viewUrl = route('customers.view', $customer->id);
                    $pdfUrl = route('customer.pdf', $customer->id);
                    $printUrl = route('customers.print', $customer->id);
                    $btn = '';
                    if (auth()->user()->can('Customer Edit')) {
                        $btn = '<a href="' . $editUrl . '" class="btn-sm m-1 confirm-leave-link"><span class="table-group-icons share-icon-tag"></span></a>';
                    }
                    $btn .= '<a href="' . $viewUrl . '" class="btn-sm m-1 confirm-leave-link"><span class="table-group-icons eye-icon-tag"></span></a>';
                    if (auth()->user()->can('Customer Pdf')) {
                        $btn .= '<a href="' . $pdfUrl . '" class="btn-sm m-1" target="_blank"><i class="files-group-icons files-icon-tag"></i></a>';
                    }
                    if (auth()->user()->can('Customer Print')) {
                        $btn .= '<a href="' . $printUrl . '" class="btn-sm m-1" target="_blank"><i class="printss-group-icons printss-icon-tag"></i></a>';
                        $hasPendingOrder = CustomerOrder::where('customer_id', $customer->id)
                            ->where('status', 'pending')
                            ->exists();
                    }if (auth()->user()->can('Customer Delete')) {
                        if ($hasPendingOrder) {
                            $btn .= '<a href="javascript:void(0)" class="btn-sm m-1 pending-order" data-id="' . $customer->id . '" data-toggle="tooltip" title="Transaction has been added, do not delete customer."><i class="infromation-group-icon information-tab-icons"></i></a>';
                        } else {
                            $btn .= '<a href="javascript:void(0)" class="btn-sm m-1 delete-customer" data-id="' . $customer->id . '"><span class="table-group-icons edit-icon-tag"></span></a>';
                        }
                    }
                    
                    return $btn;
                })
                ->addColumn('last_order', function ($customer) {
                    $lastOrder = $customer->orders->sortByDesc('created_at')->first();
                    return $lastOrder ? $lastOrder->created_at->format('d-m-Y') : '-';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
    
        return view('admin.customers.index', compact('totalRecords', 'activeCustomers', 'inactiveCustomers', 'metaTitle'));
    }
    
    
    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $metaTitle = 'Create Customers - Cosmic ERP';
        // $metaTitle = 'Customers - Create';
        $countrys = Country::get();
        $states = State::get();
        $cities = City::get();
        $groups = Group::get();
        

        return view('admin.customers.create',compact('countrys','groups','metaTitle'));
        //
    }

    public function getStates($countryId){
        $states = State::where('country_id', $countryId)->get();
        return response()->json($states);
    }
    public function getCities($stateId){
        $states = City::where('state_id', $stateId)->get();
        return response()->json($states);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request-
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
        $messages = [
            'company_name.required' => 'Please enter company name.',
            'gstin.required' => 'Please enter GST number.',
            'address1.required' => 'Please enter address.',
            'contect.nullable' => 'Please enter phone number',
            
        ]; 
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            // 'gstin' => 'nullable|string|max:255|unique:customers',
            'gstin' => ['required', new GstNumber, 'unique:customers,gstin'],
            'payment_terms' => 'nullable|string|max:255',
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'country_id' => 'required|integer',
            'state_id' => 'required|integer',
            'pin' => 'nullable|integer',
            'city_id' => 'required|integer',
            'first_name' => ['required','string','max:255','regex:/^[a-zA-Z0-9\s]+$/' ],
            'last_name' => [ 'nullable', 'string', 'max:255', 'regex:/^[a-zA-Z0-9\s]*$/' ],
            // 'first_name' => 'required|string|max:255',
            // 'last_name' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'alt_phone' => 'nullable|digits_between:10,13',
            'contect' => 'required|digits_between:10,13',
            'group' => 'nullable|string|max:255',
            'matrix' => 'nullable|string|max:255',
        ], $messages);
        
        $customer = new Customer([
            'company_name' => isset($request->company_name)?$request->company_name :'',
            'gstin' => isset($request->gstin)?$request->gstin:'',
            'payment_terms' => isset($request->payment_terms)?$request->payment_terms:'',
            'address1' => isset($request->address1)?$request->address1:'',
            'address2' => isset($request->address2)?$request->address2:'',
            'country_id' => isset($request->country_id)?$request->country_id:'',
            'state_id' => isset($request->state_id)?$request->state_id:'',
            'pin' => isset($request->pin)?$request->pin:'000000',
            'city_id' => isset($request->city_id)?$request->city_id:'',
            'first_name' => isset($request->first_name)?$request->first_name:'',
            'last_name' => isset($request->last_name)?$request->last_name:'',
            'email' => isset($request->email)?$request->email:'',
            'contect' => isset($request->contect)?$request->contect:'',
            'alt_phone' => isset($request->alt_phone)?$request->alt_phone:'',
            'group' => isset($request->group)?$request->group:'',
            'matrix' => isset($request->matrix)?$request->matrix:'',
        ]);
        $customer->save();


        // $customer = Customer::create($validatedData);
         return redirect()->route('customers.index')->with('success', 'Customer created successfully');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $metaTitle = 'View Customers - Cosmic ERP';
        $customer = Customer::findOrFail($id);
        $countries = Country::all();
        $groups = Group::get();
        return view('admin.customers.view', compact('customer','countries','groups','metaTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $metaTitle = 'Edit Customers - Cosmic ERP';
        $customer = Customer::findOrFail($id);
        $countries = Country::all();
        $groups = Group::get();
        return view('admin.customers.edit', compact('customer','countries','groups','metaTitle'));
    }

    public function generatePDF($id)
    {
        $customer = Customer::findOrFail($id);
        $countries = Country::all();
        $groups = Group::get();
        $data = compact('customer','countries','groups');
        $pdf = PDF::loadView('admin.customers.pdf', $data);

        return $pdf->download('customer_' . $id . '.pdf');
    }

    public function print($id)
    {
        $customer = Customer::findOrFail($id);
        // $suppliers = Suppliers::findOrFail($id);
        // $countries = Country::get();
        $states = State::where('country_id', $customer->country_id)->get();
        $cities = City::where('state_id', $customer->state_id)->get();
        
        $countries = Country::all();
        $groups = Group::get();
        return view('admin.customers.print', compact('customer','countries','groups','states','cities'));
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
        $messages = [
            'address1.required' => 'Please enter address.',
            'contect.nullable' => 'Please enter contact.',
            
        ];
        
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'gstin' => ['required', new GstNumber, 'unique:customers,gstin,'.$id],
            'payment_terms' => 'nullable|string|max:255',
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'country_id' => 'required|integer',
            'state_id' => 'required|integer',
            'pin' => 'nullable|integer',
            'city_id' => 'required|integer',
            'first_name' => [
                        'required',
                        'string',
                        'max:255',
                        'regex:/^[a-zA-Z\s]+$/', // Allows only letters and spaces
                ],
            'last_name' => [
                        'nullable',
                        'string',
                        'max:255',
                        'regex:/^[a-zA-Z\s]*$/', // Allows only letters and spaces (nullable)
                ],
            // 'first_name' => 'required|string|max:255',
            // 'last_name' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'contect' => 'nullable|digits_between:10,13',
            'alt_phone' => 'nullable|digits_between:10,13',
            'group' => 'nullable|string|max:255',
            'matrix' => 'nullable|string|max:255',
    ],$messages);

    $customer = Customer::findOrFail($id);
    $customer->update([
        'company_name' => $request->input('company_name') ?? $customer->company_name,
        'gstin' => $request->input('gstin') ?? $customer->gstin,
        'payment_terms' => $request->input('payment_terms') ?? $customer->payment_terms,
        'address1' => $request->input('address1') ?? $customer->address1,
        'address2' => $request->input('address2') ?? '',
        'country_id' => $request->input('country_id') ?? $customer->country_id,
        'state_id' => $request->input('state_id') ?? $customer->state_id,
        'pin' => $request->input('pin') ?? $customer->pin,
        'city_id' => $request->input('city_id') ?? $customer->city_id,
        'first_name' => $request->input('first_name') ?? $customer->first_name,
        'last_name' => $request->input('last_name') ?? '',
        'email' => $request->input('email') ?? '',
        'contect' => $request->input('contect') ?? $customer->contect,
        'alt_phone' => $request->input('alt_phone') ?? '',
        'group' => $request->input('group') ?? '',
        'matrix' => $request->input('matrix') ?? $customer->matrix,
        ]);
    

    return redirect()->route('customers.index')->with('success', 'Customer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $customer = Customer::findOrFail($id);
    //     if($customer){
    //         $customer->delete();
    //         return Response::json(['success' => 'customer deleted successfully.']);    
    //     }
    //     return Response::json(['error' => 'customer not found.'], 404);

    // }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        // Check if the customer has any pending orders
        $pendingOrders = CustomerOrder::where('customer_id', $id)
                                    ->where('status', 'pending')
                                    ->exists();
        info('5555555555555555');
        info($pendingOrders);
        if ($pendingOrders) {
            info('44444');
            // Return a response indicating that the customer cannot be deleted
            return Response::json(['error' => 'Customer cannot be deleted due to pending orders.'], 400);
        }

        if($customer) {
            $customer->delete();
            return Response::json(['success' => 'Customer deleted successfully.']);
        }

        return Response::json(['error' => 'Customer not found.'], 404);
    }                               

    public function updateStatus(Request $request)
    {
        $customer = Customer::find($request->id);
        if ($customer) {
            $customer->status = $request->status;
            $customer->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'error' => 'Customer not found']);
    }
    public function add( Request $request)
    {
        $messages = [
            'address1.required' => 'The address field is required.',
            'contect.nullable' => 'The contact field is required.',
            
        ]; 
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            // 'gstin' => 'nullable|string|max:255|unique:customers',
            'gstin' => ['required', new GstNumber, 'unique:customers,gstin'],
            'payment_terms' => 'required|string|max:255',
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'country_id' => 'required|integer',
            'state_id' => 'required|integer',
            'pin' => 'nullable|integer',
            'city_id' => 'required|integer',
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'contect' => 'required|digits_between:10,13',
            'group' => 'nullable|string|max:255',
            'matrix' => 'nullable|string|max:255',
            'alt_phone' => 'nullable|digits_between:10,13',
        ], $messages);
        
        $customer = new Customer([
            'company_name' => isset($request->company_name)?$request->company_name :'',
            'gstin' => isset($request->gstin)?$request->gstin:'',
            'payment_terms' => isset($request->payment_terms)?$request->payment_terms:'',
            'address1' => isset($request->address1)?$request->address1:'',
            'address2' => isset($request->address2)?$request->address2:'',
            'country_id' => isset($request->country_id)?$request->country_id:'',
            'state_id' => isset($request->state_id)?$request->state_id:'',
            'pin' => isset($request->pin)?$request->pin:'',
            'city_id' => isset($request->city_id)?$request->city_id:'',
            'first_name' => isset($request->first_name)?$request->first_name:'',
            'last_name' => isset($request->last_name)?$request->last_name:'',
            'email' => isset($request->email)?$request->email:'',
            'contect' => isset($request->contect)?$request->contect:'',
            'group' => isset($request->group)?$request->group:'',
            'matrix' => isset($request->matrix)?$request->matrix:'',
            'alt_phone' => isset($request->alt_phone)?$request->alt_phone:'',
        ]);
        $customer->save();


        // $customer = Customer::create($validatedData);
        return response()->json([
            'success' => 'Data saved successfully!',
            'newOption' => [
                'value' => $customer->id,
                'text' => $customer->company_name,
                'data-no'=> $customer->contect
            ]
        ]);
         // return redirect()->route('customers.index')->with('success', 'Customer created successfully');
        // print_r('data');
    }

    public function groupadd(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255|unique:grops,name',
        // ], [
        //     'name.unique' => 'This Group name has already been taken. Please choose a different name.', // Custom message for unique validation
        // ]);
        // $transform =Group::create($request->all());
        

        // return response()->json([
        //     'success' => 'Data saved successfully!',
        //     'newOption' => [
        //         'value' => $transform->id,
        //         'text' => $transform->name
        //     ]
        // ]);
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:groups,name',
            ], [
                'name.unique' => 'This Group name has already been taken. Please choose a different name.',
            ]);
    
            $transform = Group::create($request->all());
    
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
    public function coloradd(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:colors,name',
        ], [
            'name.unique' => 'This color name has already been taken. Please choose a different name.', // Custom message for unique validation
        ]);

        $transform =Color::create($request->all());

        return response()->json([
            'success' => 'Data saved successfully!',
            'newOption' => [
                'value' => $transform->id,
                'text' => $transform->name
            ]
        ]);
        
    }
}
