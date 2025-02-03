<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRoleFormRequest;
use App\Http\Requests\DeleteUserRoleFormRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use DataTables;
use Session;
use Illuminate\Support\Facades\Response;


class UserRoleController extends Controller
{
    public function __construct()
    {}

    public function index(Request $request)
    {
        // $query = Role::with('permissions')->select('id','name')->get();
        // print_r($query);
        // exit;
        if ($request->ajax()) {
        $query = Role::with('permissions')->select('id','name')->orderBy('id', 'desc');
        return DataTables::of($query)
            ->editColumn('name', function ($role) {
                return $role->name ?? '';
            })
            ->addColumn('permissions', function ($role) {
                return $role->permissions->pluck('name','name')->implode(', ');
            })
            ->addColumn('action', function($role) {
                $editRoute = route('user-role.edit', $role->id);
                $deleteRoute = route('user-role.destroy', $role->id);
                $btn = '<a href="'. $editRoute .'" class="action-content"><span class="table-group-icons share-icon-tag"></span></a>';
                $btn .= '<a href="'. $deleteRoute .'" class="action-content"><span class="table-group-icons edit-icon-tag"></span></a>';
                // $btn .= '<button class="action-content delete-button" data-id="'. $role->id .'"><span class="table-group-icons edit-icon-tag"></span></button>';
                return $btn;
                // return '-';

            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.user_role.index');
        // $userRoles = Role::orderBy('id','DESC')->paginate(15);
        // return view('admin.user_role.index',compact('userRoles'))->with('i', ($request->input('page', 1) - 1) * 15);
    }
    
    public function add()
    {
        $permissions = Permission::get();
        return view('admin.user_role.add-user-role',compact('permissions'));
    }

    public function edit($id)
    {
        // print_r('data');
        // exit;
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        // print_r($rolePermissions);
        return view('admin.user_role.user-role-edit',compact('role','permissions','rolePermissions'));
        // return view('admin.user_role.user-role-edit');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            // 'permission' => 'required',
        ]);
        // $this->validate($request, [
        //     'name' => 'required|unique:roles,name',
        //     'permission' => 'required',
        // ]);
    
        $role = Role::create(['name' => $request->input('name')]);
          
        $permissions = [];
        if( !empty($permissions)){
            
            foreach ($request->input('permission') as $permissionId) {
                $permissions[$permissionId] = $permissionId;
            }
            $permissionsArray = array_map('intval', $permissions);
            $role->syncPermissions($permissionsArray);
        }
    
        return redirect()->route('user-role.index')
                        ->with('success','Role created successfully');
    }
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'array',
        ]);
        // Find the role by ID
        $role = Role::find($id);
        if (!$role) {
            return redirect()->route('user-role.index')->with('error', 'Role not found.');
        }

         // Update the role name
        $role->name = $request->input('name');
        $role->save();

        // Update the role's permissions
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('user-role.index')->with('success', 'Role updated successfully.');
        // print_r('data');
        // exit;
        //     // $this->validate($request, [
        //     //     'name' => 'required',
        //     //     'permission' => 'required',
        //     // ]);
        // $request->validate([
        //     'name' => 'required',
        //     'permission' => 'required',
        // ]);
    
        // $role = Role::find($id);
        // $role->name = $request->input('name');
        // $role->save();
    
        // $permissions = [];

        // foreach ($request->input('permission') as $permissionId) {
        //     $permissions[$permissionId] = $permissionId;
        // }
        // $permissionsArray = array_map('intval', $permissions);
        // $role->syncPermissions($permissionsArray);
    
        // return redirect()->route('user-role.index')
        //                 ->with('success','Role updated successfully');
    }

    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
    
        return view('admin.user_role.show',compact('role','rolePermissions'));
    }

    public function softDelete($id)
    {
        print_r('data');
        exit;

        // $role = Role::find($id);

        // if ($role) {
        //     $role->delete();
        //     return Response::json(['success' => 'Role deleted successfully.']);
        // }

        // return Response::json(['error' => 'Role not found.'], 404);

        // $data = $request->validated();
        // $user = Role::find($data['id']);
        // if ($user) {
        //     $user->delete();
        //     return redirect()->route('user-role.index')->with('success', __('User role deleted successfully'));
        // }

    }
}
