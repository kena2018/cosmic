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



class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $metaTitle = 'Staff Role Summary - Cosmic ERP';
        if ($request->ajax()) {
        $query = Role::select('id','name');
        if ($request->has('SearchData') && !empty($request->SearchData)) {
            $search = $request->get('SearchData');
            $query->where('name', 'like', '%' . $search . '%'); // Filter roles based on the search input
        }
        return DataTables::of($query)
        
            ->addColumn('name', function ($role) {
                return $role->name ?? '-';
            })
            ->addColumn('action', function($role) {
                if ($role->name!== 'Admin User') {
                $editUrl = route('roles.edit', $role->id);
                $viewUrl = route('role.view', $role->id);
                $pdfUrl = route('role.pdf', $role->id);
                $printUrl = route('role.print', $role->id);
                // $deleteUrl = route('roles.destroy', $role->id);
                $btn = '';
                if (auth()->user()->can('Role Edit')) {
                    $btn = '<a href="' . $editUrl . '" class="btn-sm m-1 confirm-leave-link"><span class="table-group-icons share-icon-tag"></span></a>';
                }
                $btn .= '<a href="' . $viewUrl . '" class="btn-sm m-1 confirm-leave-link"><span class="table-group-icons eye-icon-tag"></span></a>';
                if (auth()->user()->can('Role Pdf')) {
                    $btn .= '<a href="' . $pdfUrl . '" class="btn-sm m-1" target="_blank"><i class="files-group-icons files-icon-tag"></i></a>';
                }
                if (auth()->user()->can('Role Print')) {
                    $btn .= '<a href="' . $printUrl . '" class="btn-sm m-1" target="_blank"><i class="printss-group-icons printss-icon-tag"></i></a>';
                }
                if (auth()->user()->can('Role Delete')) {
                    $btn .= '<a href="javascript:void(0)" class="btn-sm m-1 delete-role" data-id="' . $role->id . '" id="roleModal"><span class="table-group-icons edit-icon-tag"></span></a>';
                }
                
                
                return $btn;
            }else{
                return '-';
            }
            })
            ->rawColumns(['action'])
            ->orderColumn('name', 'name $1')
            ->make(true);
        }
        return view('admin.role.index',compact('metaTitle'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $metaTitle = 'Create Staff Role - Cosmic ERP';
        $permissions = Permission::get();
        return view('admin.role.create',compact('permissions','metaTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array',
            // 'permission' => 'required',
        ]);
        $role = Role::create(['name' => $request->input('name')]);
        $permissions = [];
        if( !empty($request->permissions)){
        //     print_r($request->permissions);
        // exit;
            
            foreach ($request->permissions as $permissionId) {
                $permissions[$permissionId] = $permissionId;
            }
            $permissionsArray = array_map('intval', $permissions);
            $role->syncPermissions($permissionsArray);
        }
    
        return redirect()->route('roles.index')
                        ->with('success','Role created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $metaTitle = 'View Staff Role - Cosmic ERP';
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        
        return view('admin.role.view',compact('role','permissions','rolePermissions','metaTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $metaTitle = 'Edit Staff Role - Cosmic ERP';
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        
        return view('admin.role.edit',compact('role','permissions','rolePermissions','metaTitle'));
    }
    public function print($id)
    {
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        
        return view('admin.role.print',compact('role','permissions','rolePermissions'));
    }
    public function generatePDF($id)
    {
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        $data = compact('role','permissions','rolePermissions');
        $pdf = PDF::loadView('admin.role.pdf', $data);

        return $pdf->download('role' . $id . '.pdf');
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
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'array',
        ]);
        // Find the role by ID
        $role = Role::find($id);
        if (!$role) {
            return redirect()->route('roles.index')->with('error', 'Role not found.');
        }

         // Update the role name
        $role->name = $request->input('name');
        $role->save();

        // Update the role's permissions
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        if($role){
            $role->delete();
            return Response::json(['success' => 'role deleted successfully.']);    
        }
        return Response::json(['error' => 'role not found.'], 404);
    }
}
