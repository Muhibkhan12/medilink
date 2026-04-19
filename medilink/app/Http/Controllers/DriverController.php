<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function driverRegister(Request $request){ 
        $request->validate([
            'license_number' => 'required|string',
       ]);
       $user= auth()->user();
    }
}
