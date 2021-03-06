<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use App\Http\Controllers\MyeventController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryCityController;
use App\Http\Controllers\UserJoinEventController;

//user
Route::get('/users',[UserController::class,'getUsers']);
Route::get('/getAUser/{id}', [UserController::class, "getAUser"]);
Route::post('/signup', [UserController::class, "signup"]);
Route::post('/signin', [UserController::class, "signin"]);


// myEvent
Route::get('/myevents', [MyeventController::class, 'index']);
Route::get('/myevents/city/{city}', [MyeventController::class, 'filterByCity']);
Route::post('/myevents', [MyeventController::class, 'store']);
Route::delete('/myevents/{id}', [MyeventController::class, 'destroy']);
Route::put('/myevents/{id}', [MyeventController::class, 'update']);

// countries
Route::get('/countries', [CountryCityController::class, 'getCountries']);

// category
Route::get('/categories', [CategoryController::class ,'index']);

Route::post('/categories', [CategoryController::class ,'store']);
Route::put('/categories/{id}', [CategoryController::class ,'update']);
Route::delete('/categories/{id}', [CategoryController::class ,'destroy']);

// user join event
Route::post('/userjoinevents', [UserJoinEventController::class ,'store']);
Route::post('/userjoinevents/quit', [UserJoinEventController::class ,'destroy']);