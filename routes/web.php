<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA / BASE ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('home');
});

Route::middleware('auth:staff')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/viewuser', [UserController::class, 'showUsers'])->name('viewuser');

/*
|--------------------------------------------------------------------------
| IMPORT PECAHAN ROUTE (MODULAR)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
require __DIR__.'/tamu.php';
require __DIR__.'/resepsionis.php';
require __DIR__.'/admin.php';
