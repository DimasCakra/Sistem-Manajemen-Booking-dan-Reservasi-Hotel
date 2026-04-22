<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // WAJIB TAMBAH INI
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\DeskripsiController;
use App\Http\Controllers\ReceptsionistController;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/register', function () {
    return view('register');
})->name('register');

// Logout (Gunakan Auth Facade agar tidak error)
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

// Main Routes
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');
Route::get('/kamar/{id}', [DeskripsiController::class, 'show'])->name('kamar.show');
Route::get('/booking/{id}', [BookingController::class, 'biodata'])->name('booking.biodata');
Route::get('/booking/{id}/payment', [BookingController::class, 'payment'])->name('booking.payment');
// Receptionist
Route::get('/receptionist', [ReceptsionistController::class, 'index'])->name('receptionist.index');