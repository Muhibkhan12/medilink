<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUser($id){
        // $user = User::findOrFail($id);
        // return response()->json([
        //     'Status'=>'User Found',
        // ],201);

        try{
            $user = User::findOrFail($id);

            return response()->json([
                'Status' => 'User Found',
                'user' => $user,
            ],200);
        }catch(\Exception $e){
            return response()->json([
                'message' => 'Error Occured',
                'error' => $e->getMessage(),
            ],500);
        }
    }

    public function updateUser(Request $request, $id){
        try{
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->number = $request->number;
            $user->role = $request->role;
            $user->address = $request->address;

            $user->save();
            return response()->json([
                'message'=>'User Updated Successfully',
                'user'=> $user,
            ],200);
        }catch(\Exception $e){
            return response()->json([
                'message'=>'Error Occured',
                'error' => $e->getMessage(),
            ],404);
        }
    }

    public function deleteUser($id){
        try{
            $user = User::where('id',$id)->delete();
            

            return response()->json([
                'message'=>'User Deleted Successfully',
            ],200);
        }catch(\Exception $e){
            return response()->json([
                'message'=> 'Error Occured',
                'error' => $e->getMessage(),
            ],500);
        };
    }
}
