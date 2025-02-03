<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request)
    {    
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            //'user_type' => 'required',
        ]);
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
    
            $user = Auth::user();
            $token = $user->createToken('API Token')->plainTextToken;

            // if ($user->user_type !== $credentials['user_type']) {
            //     return response()->json([
            //         'requestCode' => 403,
            //         'status' => 0,
            //         'message' => 'User type does not match.',
            //     ]);
            // }
    
            return response()->json([
                'requestCode'=>200,
                'status'=>1 ,
                'message' => 'Login successful',
                'token' => $token
            ]);
        }else{
            return response()->json([
                'requestCode'=>404,
                'status'=>0 ,
                'message' => 'These credentials do not match our records.',
            ]);

        }
    
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
}

