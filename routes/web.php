<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // WAJIB TAMBAH INI
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\DeskripsiController;
use App\Http\Controllers\ReceptsionistController;

Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'processRegister'])->name('register.post');

Route::get('/username', [AuthController::class, 'showUsername'])->name('username');
Route::post('/username', [AuthController::class, 'processUsername'])->name('username.post');
    
// resepsionis login
Route::get('/resepsionislogin', function () {
    return view('resepsionislogin'); })->name('resepsionislogin');
Route::post('/resepsionislogin', [AuthController::class, 'processResepsionisLogin'])->name('resepsionis.login.post');

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

// Receptionist
Route::middleware('auth:receptionist')->group(function () {
    Route::get('/receptionist', [ReceptsionistController::class, 'index'])->name('receptionist.index');
    Route::get('/resepsionis/riwayat', [ReceptsionistController::class, 'riwayat'])->name('resepsionis.riwayatreservasi');
    Route::get('/resepsionis/riwayat/{id}', [ReceptsionistController::class, 'show'])->name('resepsionis.show');
});