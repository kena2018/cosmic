<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use DataTables;
use Session;
use DB;
use PDF;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $metaTitle = 'Permission Summary - Cosmic ERP';
        if ($request->ajax()) {
            $query = Permission::select('id','name');
            if ($request->has('SearchData') && !empty($request->SearchData)) {
                $search = $request->get('SearchData');
                $query->where('name', 'like', '%' . $search . '%'); // Filter permissions by name
            }
            return DataTables::of($query)
            ->addColumn('name', function ($permission) {
                return $permission->name ?? '-';
            })
            ->addColumn('action', function($permission) {
                $editUrl = route('permissions.edit', $permission->id);
                $viewUrl = route('permission.view', $permission->id);
                // $deleteUrl = route('permissions.destroy', $permission->id);
                $pdfUrl = route('permission.pdf', $permission->id);
                $printUrl = route('permission.print', $permission->id);
                $btn = '';
                if (auth()->user()->can('permissions Edit')) {
                    $btn = '<a href="' . $editUrl . '" class="btn-sm m-1 confirm-leave-link"><span class="table-group-icons share-icon-tag"></span></a>';
                }
                $btn .= '<a href="' . $viewUrl . '" class="btn-sm m-1 confirm-leave-link"><span class="table-group-icons eye-icon-tag"></span></a>';
                if (auth()->user()->can('permissions Pdf')) {
                    
                $btn .= '<a href="' . $pdfUrl . '" class="btn-sm m-1" target="_blank"><i class="files-group-icons files-icon-tag"></i></a>';
                }
                if (auth()->user()->can('permissions Print')) {
                    
                $btn .= '<a href="' . $printUrl . '" class="btn-sm m-1" target="_blank"><i class="printss-group-icons printss-icon-tag"></i></a>';
                }
                if (auth()->user()->can('permissions Delete')) {
                    
                $btn .= '<a href="javascript:void(0)" class="btn-sm m-1 delete-permission" data-id="' . $permission->id . '"><span class="table-group-icons edit-icon-tag"></span></a>';
                }
                return $btn;
            })
            ->rawColumns(['action'])
            ->orderColumn('name', function ($query, $order) {
                $query->orderBy('name', $order); // Correct ordering logic for 'name'
            })
            ->make(true);
        }
        return view('admin.permission.index',compact('metaTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $metaTitle = 'Create Permission - Cosmic ERP';
        return view('admin.permission.create',compact('metaTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
        ]);

        $permission = Permission::create(['name' => $request->name]);
        $role = Role::where( 'name','Admin User')->first();
        $role->givePermissionTo($permission->name);


        return redirect()->route('permissions.index')->with('success', 'Permission created successfully!');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $metaTitle = 'View Permission - Cosmic ERP';
        $permission = Permission::find($id);
        return view('admin.permission.view', compact('permission','metaTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $metaTitle = 'Edit Permission - Cosmic ERP';
        $permission = Permission::find($id);
        return view('admin.permission.edit', compact('permission','metaTitle'));
    }
    public function print($id)
    {
        $permission = Permission::find($id);
        return view('admin.permission.print', compact('permission'));
    }
    public function generatePDF($id)
    {
        $permission = Permission::find($id);
        $data = compact('permission');
        $pdf = PDF::loadView('admin.permission.pdf', $data);

        return $pdf->download('permission' . $id . '.pdf');
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
            'name' => 'required|string|max:255|unique:permissions,name,' . $id,
        ]);
        $permission = Permission::find($id);
        $permission->name = $request->name;
        $permission->save();

        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        if($permission){
            $permission->delete();
            return Response::json(['success' => 'permission deleted successfully.']);    
        }
        return Response::json(['error' => 'permission not found.'], 404);
    }
}
