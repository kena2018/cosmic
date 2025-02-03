<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\AuthMiddleware;
use App\Models\User;
use App\Http\Requests\UserFormRequest;
use App\Http\Requests\EditUserFormRequest;
use App\Http\Requests\DeleteUserFormRequest;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Auth;
use DataTables;
use App\Models\GarageVendorModel;
use App\Models\CustomerModel;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function users()
    {
        return view('admin.users.index');
    }

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                ->addColumn('roles', function ($user) {
                    return $user->getRoleNames()->implode(', ');
                })
                ->addIndexColumn()
                ->rawColumns(['roles'])
                ->make(true);
        }
    }

    public function add()
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin.users.add-user',compact('roles'));
    }
    public function edit(Request $request, $id)
    {
        $user = User::query()->where('id', $id)->first();
        info('6666666666');
        info($user);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('admin.users.user-edit', ['user' => $user, 'roles'=> $roles, 'userRole'=> $userRole]);
    }
    public function submit(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'contact' => 'required|numeric|digits:10',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if ($request->hasFile('user_photo')) {
            $image = $request->file('user_photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/user_photos');
            $image->move($imagePath, $imageName);
            $input['user_photo'] = 'public/assets/user_photos/' . $imageName;
        }
        $input['password'] = Hash::make($input['password']);
        $input['role_type'] = $input['role_type'] = implode(',', $input['roles']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        if($user->role_type == 'vendor'){
            $garageVendor = new GarageVendorModel();
            $garageVendor->user_id = $user->id;
            $garageVendor->save();
        }
        if($user->role_type == 'customer'){
            echo($user->role_type);
            $customer = new CustomerModel();
            $customer->user_id = $user->id;
            $customer->save();
        }
    
        return redirect()->route('user.index')
                        ->with('success','User created successfully');
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'contact' => 'required|numeric|digits:10',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        info('request all input');
        info($request);
        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/user_photos');
            $image->move($imagePath, $imageName);
            $input['profile'] = 'public/assets/user_photos/' . $imageName;
        }
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $input['role_type'] = $input['role_type'] = implode(',', $input['roles']);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('user.index')
                        ->with('success','User updated successfully');
    }

    public function softDelete(DeleteUserFormRequest $request)
    {
        $data = $request->validated();
        $user = User::find($data['id']);

        if ($user) {
            if ($user->role_type == 'vendor') {
                $garageVendor = GarageVendorModel::where('user_id', $user->id)->first();
                if ($garageVendor) {
                    $garageVendor->delete();
                }
            } elseif ($user->role_type == 'customer') {
                $customer = CustomerModel::where('user_id', $user->id)->first();
                if ($customer) {
                    $customer->delete();
                }
            }

            $user->delete();

            return redirect()->route('user.index')->with('success', __('User Deleted successfully'));
        }
    }

    public function show($id)
    {
        $user = User::query()->where('id', $id)->first();
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('admin.users.show-user', ['user' => $user, 'roles'=> $roles, 'userRole'=> $userRole]);
    }

    public function profile(Request $request)
    {
        $user = User::where('id', Auth::id())->first();

        return view('admin.users.user-profile', compact('user'));
    }

    public function changePassword(Request $request, $id)
    {
        $formData = $request->all();
        $user = User::where('id', $id)->first();
        if(!empty($user)){
            $user->password = Hash::make($formData['password']);
            $user->save();
        }
        
        return redirect()->route('user.profile')->with('success', 'Password Update successfully');

    }

    public function profileUpdate(Request $request, $id)
    {
        $formData = $request->all();
        $user = User::where('id', $id)->first();

        $user->name = $formData['name'];
        $user->email = $formData['email'];
        // $user->gender = $formData['gender'];
        if ($request->hasFile('profile')) {
            $image = $request->file('user_photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/user_photos');
            $image->move($imagePath, $imageName);
            $user->user_photo = 'public/assets/user_photos/' . $imageName;
        }

        $user->save();

        return redirect()->route('user.profile')->with('success', 'User Profile Updated Successfully');
    }

}
