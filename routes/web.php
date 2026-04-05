<?php

use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KatalogController;



Route::get('/login', [LoginController::class, 'index']);
Route::get('/login', function () {
    return view('login');
});

Route::post('/home', function () {
    return view('home');
});

Route::get('/home', [HomeController::class, 'index']);
Route::get('/katalog', [KatalogController::class, 'index']);