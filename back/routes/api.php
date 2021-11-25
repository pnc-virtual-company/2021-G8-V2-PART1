<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

//user
Route::post('/signUp', [UserController::class, "signUp"]);
Route::post('/signIn', [UserController::class, "signIn"]);


//private 
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post("/signOut", [UserController::class, "signOut"]);
});