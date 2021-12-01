<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

//user
Route::post('/signup', [UserController::class, "signup"]);
Route::post('/signin', [UserController::class, "signin"]);
