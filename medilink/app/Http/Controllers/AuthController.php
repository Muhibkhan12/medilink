<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Guard;

class AuthController extends Controller
{
    public function register(Request $request){
        $validateUser = $request->validate([
            'name' => 'required|string|max:255 ',
            'email' => 'required|string|max:255',
            'password'=>'required|string|min:9|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
        ]);
        $token = Auth::guard('api')->login($user);

        return response()->json([
            'message'=>'User Registered Successfully',
            'token' => $token,
        ],201);
    }


    public function login(Request $request){
        $credentials = $request->only('email', 'password'); 
        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json([
                'error' => 'Invalid credentials'
            ], 401);
        }

        return response()->json([
            'message' => 'LoggedIn Successfully',
            'token' => $token,
        ]);
    }
    public function logout(){
        Auth::guard('api')->logout();

        return response()->json([
            'message'=>'Logout Successfully',
        ]);
    }
}
