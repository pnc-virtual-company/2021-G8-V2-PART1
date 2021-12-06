<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MyeventController;

//user
Route::post('/signup', [UserController::class, "signup"]);
Route::post('/signin', [UserController::class, "signin"]);

// myEvent
Route::get('/myevents', [MyeventController::class, 'index']);
Route::get('/myevents/{id}', [MyeventController::class, 'show']);
Route::post('/myevents', [MyeventController::class, 'store']);
Route::delete('/myevents/{id}', [MyeventController::class, 'destroy']);
Route::put('/myevents/{id}', [MyeventController::class, 'update']);
Route::get('/myevents/search/{title}', [MyeventController::class, 'search']);

Route::get('/countries',[MyeventController::class, 'getCountries']);
