<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GroupPricing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use DataTables;
use App\Models\Group;

class GroupPricingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $metaTitle = 'Group Price Summary - Cosmic ERP';
        if ($request->ajax()) {
            $data = GroupPricing::select([
                'id',
                'name',
                'group_id',
                'start_date',
                'effective_upto'
            ])->orderBy('id', 'desc');

            return DataTables::of($data)
                // ->addColumn('assign_products', function ($row) {
                //     return '<button class="table-btns">Assign Products</button>';
                // })
                ->addColumn('assign_products', function ($row) {
                    $url = route('price-list.index'); // Generate the URL for the route
                    return '<a href="' . $url . '"><button class="table-btns">Assign Products</button></a>';
                })
                ->addColumn('actions', function ($row) {
                    $editUrl = route('group_pricing.edit', $row->id);
                    $pdfUrl = route('group_pricing.pdf', $row->id);
                    $btn = '<a href="' . $editUrl . '" class="btn-sm m-1"><span class="table-group-icons share-icon-tag"></span></a>';
                    $btn .= '<a href="' . $pdfUrl . '" class="btn-sm m-1"><i class="fas fa-file-pdf" style="font-size: 24px; width: 10px; height: 40px; line-height: 40px;"></i></a>';
                    $btn .= '<a href="javascript:void(0)" class="btn-sm m-1 delete-customer" data-id="' . $row->id . '"><span class="table-group-icons edit-icon-tag"></span></a>';
                    
                    return $btn;
                    // return '<a href="javascript:void(0);" class="btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal"><span class="table-group-icons edit-icon-tag"></span></a>';
                })
                ->rawColumns(['assign_products', 'actions'])
                ->make(true);
        }

        return view('Admin.group-pricing.index',compact('metaTitle'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $metaTitle = 'Group Price Create - Cosmic ERP';
        $groups = Group::get();
        return view('admin.group-pricing.create',compact('groups','metaTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'name' => 'required',
        //     'group_id' => 'required|numeric',
        //     'start_date' => 'required|date',
        //     'effective_upto' => 'required|date|after_or_equal:start_date',
        // ]);
        $validatedData = $request->validate([
            'name' => 'nullable',
            'group_id' => 'nullable|numeric',
            'start_date' => 'nullable|date',
            'effective_upto' => 'nullable|date|after_or_equal:start_date',
        ]);
        GroupPricing::create($validatedData);

        return redirect()->route('group-pricing.index')->with('success', 'Group pricing created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $metaTitle = 'Group Price Edit - Cosmic ERP';
        $groups = Group::get();
        $groupPricing = GroupPricing::findOrFail($id);
        return view('admin.group-pricing.edit', compact('metaTitle','groupPricing','groups'));
    }

    public function generatePDF($id)
    {
        $groups = Group::get();
        $groupPricing = GroupPricing::findOrFail($id);
        $data = compact('groupPricing','groups');
        $pdf = PDF::loadView('admin.group-pricing.pdf', $data);

        return $pdf->download('group-pricing' . $id . '.pdf');
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
        $validatedData = $request->validate([
            'name' => 'required',
            'group_id' => 'required|numeric',
            'start_date' => 'required|date',
            'effective_upto' => 'required|date|after_or_equal:start_date',
        ]);

        $groupPricing = GroupPricing::findOrFail($id);
        $groupPricing->update($validatedData);

        return redirect()->route('group-pricing.index')->with('success', 'Group pricing updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     info('************');
    //     info($id);
    //     $groupPricing = GroupPricing::findOrFail($id);
    //     $groupPricing->delete();

    //     return response()->json(['success' => 'Group pricing deleted successfully.']);
    // }
    public function destroy($id)
    {
        $GroupPricing = GroupPricing::findOrFail($id);
        if($GroupPricing){
            $GroupPricing->delete();
            return response()->json(['success' => 'GroupPricing deleted successfully.']);    
        }
        return response()->json(['error' => 'GroupPricing not found.'], 404);

    }
}