<?php

use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;


Route::get('/login', [LoginController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);
