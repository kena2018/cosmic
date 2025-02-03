<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Session;
use DB;
use PDF;

class StaffManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $metaTitle = 'Staff Management Summary - Cosmic ERP';
        if ($request->ajax()) {
        $query = user::with('roles')->select('id','name','email', 'contect');
        if (!empty($request->SearchData)) {
                    // Assign the search data to a variable
            $search = $request->SearchData;

            // Search in user fields (name, email, contact)
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('contect', 'like', "%{$search}%");
            });

            // Search in related roles name
            $query->orWhereHas('roles', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }
        return DataTables::of($query)
            ->editColumn('email', function ($user) {
                return $user->email ?? '';
            })
            ->editColumn('contect', function ($user) {
                return $user->contect ?? '';
            })
            ->editColumn('name', function ($user) {
                return $user->name ?? '';
            })
            ->addColumn('roles', function ($user) {
                return $user->roles->pluck('name','name')->implode(', ');
            })
            ->addColumn('action', function($user) {
                // if ($user->roles->pluck('name','name')->implode(', ') !== 'Super Admin') {
                    $editUrl = route('staff-management.edit', $user->id);
                    $viewUrl = route('staff-management.view', $user->id);
                    $pdfUrl = route('staff-management.pdf', $user->id);
                    $printUrl = route('staff-management.print', $user->id);
                // $deleteUrl = route('users.destroy', $user->id);
                $btn ='';
                if (auth()->user()->can('Staff Management Edit')) {
                    $btn = '<a href="' . $editUrl . '" class="btn-sm m-1 confirm-leave-link"><span class="table-group-icons share-icon-tag"></span></a>';
                    
                }
                $btn .= '<a href="' . $viewUrl . '" class="btn-sm m-1 confirm-leave-link"><span class="table-group-icons eye-icon-tag"></span></a>';
                if (auth()->user()->can('Staff Management Pdf')) {
                    $btn .= '<a href="' . $pdfUrl . '" class="btn-sm m-1" target="_blank"><i class="files-group-icons files-icon-tag"></i></a>';
                }
                if (auth()->user()->can('Staff Management Print')) {
                    $btn .= '<a href="' . $printUrl . '" class="btn-sm m-1" target="_blank"><i class="printss-group-icons printss-icon-tag"></i></a>';
                }
                if (auth()->user()->can('Staff Management Delete')) {
                    $btn .= '<a href="javascript:void(0)" class="btn-sm m-1 delete-staffs" data-id="' . $user->id . '"><span class="table-group-icons edit-icon-tag"></span></a>';
                }
                return $btn;
                // }
                // else{
                //     return '-';
                // }
                // return $user->roles->pluck('name','name')->implode(', ');

                
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.staff-management.index',compact('metaTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $metaTitle = 'Create Staff Management - Cosmic ERP';
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.staff-management.create',compact('roles','permissions','metaTitle'));
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
            'contect.required' => 'The contact field is required.',
        ]; 
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'contect' => 'required|digits_between:10,13|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:15',
                'confirmed',
                'unique:users',               // Ensure password is unique for users
                'regex:/[A-Z]/',              // Must contain at least one uppercase letter
                'regex:/[a-z]/',              // Must contain at least one lowercase letter
                'regex:/[0-9]/',              // Must contain at least one digit
                'regex:/[@$!%*#?&]/',         // Must contain at least one special character
            ],
            // 'password' => 'required|string|min:8|max:15|confirmed|unique:users','regex:/[A-Z]/','regex:/[a-z]/','regex:/[0-9]/','regex:/[@$!%*#?&]/',
            'roles' => 'required|array', // Ensure roles are provided as an array
            // 'roles.*' => 'exists:roles,id', // Ensure each role exists in the roles table
            // 'permissions' => 'sometimes|array', // Permissions are optional
            // 'permissions.*' => 'exists:permissions,id' // Ensure each permission exists in the permissions table

        ], $messages);
        $data = $request->all();
        $user = $this->UserStore($data);
        $user->roles()->sync($data['roles']);
        $permissions = [];
        if( !empty($request->permissions)){
        //     print_r($request->permissions);
        // exit;
            
            foreach ($request->permissions as $permissionId) {
                $permissions[$permissionId] = $permissionId;
            }
            $permissionsArray = array_map('intval', $permissions);
            $user->syncPermissions($permissionsArray);
        }
        // $roles = Role::whereIn('id', $data['roles'])->get();
        return redirect()->route('staff-management.index')->with('success', 'Staff Management created successfully!');
    }

    public function UserStore(array $data)
    {
        $roleName = Role::whereIn('id', $data['roles'])->pluck('name')->first();
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'contect' => $data['contect'],
        'password' => Hash::make($data['password']),
        'role_type' => $roleName,
      ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $metaTitle = 'View Staff Management - Cosmic ERP';
        $roles = Role::all();
        $user = User::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")
                        // ->whereIn("permission_id", $user->permissions->pluck('id'))
                        // ->pluck('permission_id')
                        // ->all();
            ->where("role_has_permissions.role_id",$id)
                ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                ->all();
        return view('admin.staff-management.view', compact('user','roles','rolePermissions','permissions','metaTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $metaTitle = 'Edit Staff Management - Cosmic ERP';
        $roles = Role::all();
        $user = User::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")
                        // ->whereIn("permission_id", $user->permissions->pluck('id'))
                        // ->pluck('permission_id')
                        // ->all();
            ->where("role_has_permissions.role_id",$id)
                ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                ->all();
        return view('admin.staff-management.edit', compact('user','roles','rolePermissions','permissions','metaTitle'));
    }
    public function print($id)
    {
        // $roles = Role::all();
        $roles = Role::find($id);
        $user = User::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")
                        ->whereIn("permission_id", $user->permissions->pluck('id'))
                        ->pluck('permission_id')
                        ->all();
    //         ->where("role_has_permissions.role_id",$id)
    //             ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
    //             ->all();
        return view('admin.staff-management.print', compact('user','roles','rolePermissions','permissions'));
    }
    public function generatePDF($id)
    {
        $roles = Role::all();
        $user = User::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")
                        ->whereIn("permission_id", $user->permissions->pluck('id'))
                        ->pluck('permission_id')
                        ->all();
        $data = compact('user','roles','rolePermissions','permissions');
        $pdf = PDF::loadView('admin.staff-management.pdf', $data);

        return $pdf->download('staff-management' . $id . '.pdf');
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
        $user = User::find($id);

        if (!$user) {
            return Response::json(['error' => 'User not found.'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$id,
            'contect' => 'required|digits_between:10,13|unique:users,contect,'.$id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'required|array', // Ensure roles are provided as an array
            'roles.*' => 'exists:roles,id' // Ensure each role exists in the roles table
        ]);
        $data = $request->all();
        $roleName = Role::whereIn('id', $data['roles'])->pluck('name')->first();

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'contect' => $data['contect'],
            'role_type' => $roleName,
        ]);

        // Update password if provided
        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
            $user->save();
        }

        // Sync roles
        $user->roles()->sync($data['roles']);
        $user->permissions()->sync($request->input('permissions', []));
        return redirect()->route('staff-management.index')->with('success', 'Staff Management updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Staff = User::find($id);

        if ($Staff) {
            $Staff->delete();
            return Response::json(['success' => 'Staff Management deleted successfully.']);
        }

        return Response::json(['error' => 'Staff Management not found.'], 404);
    }
    
}
