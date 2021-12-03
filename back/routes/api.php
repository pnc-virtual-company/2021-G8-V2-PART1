<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

//user
Route::get('/getAUser/{id}', [UserController::class, "getAUser"]);
Route::post('/signup', [UserController::class, "signup"]);
Route::post('/signin', [UserController::class, "signin"]);

// category 

Route::get('/categories', [CategoryController::class ,'index']);
Route::get('/categories/{id}', [CategoryController::class ,'show']);

Route::post('/categories', [CategoryController::class ,'store']);
Route::put('/categories/{id}', [CategoryController::class ,'update']);
Route::delete('/categories/{id}', [CategoryController::class ,'destroy']);