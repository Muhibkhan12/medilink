<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register',[AuthController::class,'register'])->name('register-user');
Route::middleware('auth:api')->post('/logout', [AuthController::class, 'logout']);

Route::prefix('/user')->group(function(){
    Route::get('/{id}',[UserController::class,'getUser'])->name('get-user');
    Route::put('/update/{id}',[UserController::class,'updateUser'])->name('update-user');
    Route::delete('/delete/{id}',[UserController::class,'deleteUser'])->name('delete-user');
});