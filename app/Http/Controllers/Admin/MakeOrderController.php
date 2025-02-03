<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\makeOrder;
use DataTables;
use Illuminate\Support\Facades\Response;


class MakeOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        $metaTitle = 'Order material Summary - Cosmic ERP';
        if ($request->ajax()) {
        $query = makeOrder::select('id','product_id','sku','colour','packing','qty_in_bundle','bharti','bag_box','status')->orderBy('id', 'desc');
        return DataTables::of($query)
            ->editColumn('product_id', function ($makeOrders) {
                return $makeOrders->product_id ?? '';
            })
            ->editColumn('sku', function ($makeOrders) {
                return $makeOrders->sku ?? '';
            })
            ->editColumn('colour', function ($makeOrders) {
                return $makeOrders->colour ?? '';
            })
            ->editColumn('packing', function ($makeOrders) {
                return $makeOrders->packing ?? '';
            })
            ->editColumn('qty_in_bundle', function ($makeOrders) {
                return $makeOrders->qty_in_bundle ?? '';
            })
            ->editColumn('bharti', function ($makeOrders) {
                return $makeOrders->bharti ?? '';
            })
            ->editColumn('bag_box', function ($makeOrders) {
                return $makeOrders->bag_box ?? '';
            })
            ->editColumn('status', function ($makeOrders) {
                return $makeOrders->status ?? '';
            })
            ->addColumn('action', function($makeOrders) {
                $editRoute = route('make_order.edit', $makeOrders->id);
                // $deleteRoute = route('make-order.destroy', $makeOrders->id);
                $btn = '<a href="'. $editRoute .'" class="action-content"><span class="table-group-icons share-icon-tag"></span></a>';
                $btn .= '<a href="javascript:void(0)" class="btn-sm m-1 delete-makeOrder" data-id="' . $makeOrders->id . '"><span class="table-group-icons edit-icon-tag"></span></a>';
                // $btn .= '<a href="'. $deleteRoute .'" class="action-content"><span class="table-group-icons edit-icon-tag"></span></a>';
                // $btn .= '<button class="action-content delete-button" data-id="'. $makeOrders->id .'"><span class="table-group-icons edit-icon-tag"></span></button>';
                return $btn;
                // return '-';

            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.make-order.index',compact('metaTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $metaTitle = 'Order material Summary - Cosmic ERP';
        return view('admin.make-order.create',compact('metaTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'product_name.required' => 'The Product name field is required.',
            'qty_in_bundle.required' => 'The QTY In Bundle is required.',
            'bag_box.required' => 'The Bag Bax is required.',
            
        ]; 
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'sku' => 'required|string|max:255',
            'colour' => 'required|string|max:255',
            'packing' => 'required|string|max:255',
            'qty_in_bundle' => 'required|string|max:255',
            'bharti' => 'required|string|max:255',
            'bag_box' => 'required|string|max:255',
            
        ], $messages);
        
        $makeOrders = new makeOrder([
            'product_id' => isset($request->product_name)?$request->product_name :'',
            'status' => isset($request->status)?$request->status:'',
            'sku' => isset($request->sku)?$request->sku:'',
            'colour' => isset($request->colour)?$request->colour:'',
            'packing' => isset($request->packing)?$request->packing:'',
            'qty_in_bundle' => isset($request->qty_in_bundle)?$request->qty_in_bundle:'',
            'bharti' => isset($request->bharti)?$request->bharti:'',
            'bag_box' => isset($request->bag_box)?$request->bag_box:'',
        ]);
        $makeOrders->save();


        // $customer = Customer::create($validatedData);
         return redirect()->route('make_order.index')->with('success', 'Make Order created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $metaTitle = 'Order material Summary - Cosmic ERP';
        $makeOrders = makeOrder::find($id);
        return view('admin.make-order.edit', compact('makeOrders','metaTitle'));
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
            'product_name.required' => 'The Product name field is required.',
            'qty_in_bundle.required' => 'The QTY In Bundle is required.',
            'bag_box.required' => 'The Bag Bax is required.',
            
        ]; 
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'sku' => 'required|string|max:255',
            'colour' => 'required|string|max:255',
            'packing' => 'required|string|max:255',
            'qty_in_bundle' => 'required|string|max:255',
            'bharti' => 'required|string|max:255',
            'bag_box' => 'required|string|max:255',
            
        ], $messages);
        
        $makeOrders = makeOrder::findOrFail($id);
        $makeOrders->update([
            'product_id' => $request->input('product_name') ?? $makeOrders->product_id,
            'status' => $request->input('status') ?? $makeOrders->status,
            'sku' => $request->input('sku') ?? $makeOrders->sku,
            'colour' => $request->input('colour') ?? $makeOrders->colour,
            'packing' => $request->input('packing') ?? $makeOrders->packing,
            'qty_in_bundle' => $request->input('qty_in_bundle') ?? $makeOrders->qty_in_bundle,
            'bharti' => $request->input('bharti') ?? $makeOrders->bharti,
            'bag_box' => $request->input('bag_box') ?? $makeOrders->bag_box,
        ]);
        $makeOrders->save();


        // $customer = Customer::create($validatedData);
         return redirect()->route('make_order.index')->with('success', 'Make Order Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $makeOrders = makeOrder::find($id);

        if ($makeOrders) {
            $makeOrders->delete();
            return Response::json(['success' => 'Make Order deleted successfully.']);
        }

        return Response::json(['error' => 'Make Order not found.'], 404);
    }
}
