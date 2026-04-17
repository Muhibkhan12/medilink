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
}
