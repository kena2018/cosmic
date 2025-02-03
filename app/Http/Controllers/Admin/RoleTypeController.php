<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRoleFormRequest;

use App\Http\Requests\DeleteUserRoleFormRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class UserRoleController extends Controller
{
    public function __construct()
    {
          $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $userRoles = Role::orderBy('id','DESC')->paginate(5);
        return view('admin.user_role.index',compact('userRoles'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    public function add()
    {
        $permission = Permission::get();
        return view('admin.user_role.add-user-role',compact('permission'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('admin.user_role.user-role-edit',compact('role','permission','rolePermissions'));
    }

    public function submit(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
    
        $role = Role::create(['name' => $request->input('name')]);
          
        $permissions = [];

            foreach ($request->input('permission') as $permissionId) {
                $permissions[$permissionId] = $permissionId;
            }
            $permissionsArray = array_map('intval', $permissions);
        $role->syncPermissions($permissionsArray);
    
        return redirect()->route('user-role.index')
                        ->with('success','Role created successfully');
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
    
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
    
        $permissions = [];

        foreach ($request->input('permission') as $permissionId) {
            $permissions[$permissionId] = $permissionId;
        }
        $permissionsArray = array_map('intval', $permissions);
        $role->syncPermissions($permissionsArray);
    
        return redirect()->route('user-role.index')
                        ->with('success','Role updated successfully');
    }

    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
    
        return view('admin.user_role.show',compact('role','rolePermissions'));
    }

    public function softDelete(DeleteUserRoleFormRequest $request)
    {
        $data = $request->validated();
        $user = Role::find($data['id']);
        if ($user) {
            $user->delete();
            return redirect()->route('user-role.index')->with('success', __('User role deleted successfully'));
        }

    }
}
