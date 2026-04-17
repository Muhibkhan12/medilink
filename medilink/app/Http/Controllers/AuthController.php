<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password'=>'required|string|min:6|confirmed',
            'number'=>'required|string|max:20',
            'address'=>'required|string|max:200',
            'role' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'number' => $request->number,
            'role' => $request->role,
            'address' => $request->address,
        ]);

        $token = Auth::guard('api')->login($user);

        return $this->responseWithToken($token);
    }

    public function login(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json([
                'error' => 'Invalid credentials'
            ], 401);
        }

        return $this->responseWithToken($token);
    }



    // public function logout(){
    //     Auth::guard('api')->logout();

    //     return response()->json([
    //         'message'=>'Logout Successfully',
    //     ]);
    // }
        public function logout()
{
    try {
        auth('api')->logout();

        return response()->json([
            'status' => true,
            'message' => 'Logout Successfully',
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Logout Failed',
        ], 500);
    }
}


    protected function responseWithToken($token){
    return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => config('jwt.ttl') * 60,
        'user' => auth('api')->user()
    ]);
}
}