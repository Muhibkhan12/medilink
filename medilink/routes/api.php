<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->post('/logout', [AuthController::class, 'logout']);

Route::prefix('/user')->group(function(){
    Route::post('/register',[AuthController::class,'register'])->name('register-user');
    Route::get('/{id}',[UserController::class,'getUser'])->name('get-user');
    Route::put('/update/{id}',[UserController::class,'updateUser'])->name('update-user');
    Route::delete('/delete/{id}',[UserController::class,'deleteUser'])->name('delete-user');
});

Route::prefix('/driver')->group(function(){
    Route::post('/register',[DriverController::class,'driverRegister'])->name('driver-registeration');
    Route::get('/information/{id}',[DriverController::class,'driverInfo'])->name('driver-info');
    Route::put('/information-update/{id}',[DriverController::class,'updateDriverInfo'])->name('update-driver-info');
    Route::delete('/delete-info/{id}',[DriverController::class,'deleteDriver'])->name('delete-driver');
});