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
Route::get('/myevents/{id}', [MyeventController::class, 'show']);
Route::post('/myevents', [MyeventController::class, 'store']);
Route::delete('/myevents/{id}', [MyeventController::class, 'destroy']);
Route::put('/myevents/{id}', [MyeventController::class, 'update']);
Route::get('/myevents/search/{title}', [MyeventController::class, 'search']);

// countries
Route::get('/countries', [CountryCityController::class, 'getCountries']);

// category

Route::get('/categories', [CategoryController::class ,'index']);
Route::get('/categories/{id}', [CategoryController::class ,'show']);
Route::get('/categories/search/{key}', [CategoryController::class ,'search']);

Route::post('/categories', [CategoryController::class ,'store']);
Route::put('/categories/{id}', [CategoryController::class ,'update']);
Route::delete('/categories/{id}', [CategoryController::class ,'destroy']);

// user join event

Route::get('/userjoinevents', [UserJoinEventController::class ,'index']);
Route::get('/userjoinevents/{id}', [UserJoinEventController::class ,'show']);
Route::get('/userjoinevents/getUserIdList/{id}', [UserJoinEventController::class ,'getAllUserIdList']);
Route::get('/userjoinevents/search/{key}', [UserJoinEventController::class ,'search']);

Route::post('/userjoinevents', [UserJoinEventController::class ,'store']);
Route::put('/userjoinevents/{id}', [UserJoinEventController::class ,'update']);
Route::post('/userjoinevents/quit', [UserJoinEventController::class ,'destroy']);