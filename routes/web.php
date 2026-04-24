<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // WAJIB TAMBAH INI
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\DeskripsiController;
use App\Http\Controllers\ReceptsionistController;
use App\Http\Controllers\BookingController;

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

Route::get('/resepsionis/login', [AuthController::class, 'showResepsionisLogin'])->name('resepsionis.login');
Route::post('/resepsionis/login', [AuthController::class, 'processResepsionisLogin'])->name('resepsionis.login.post');

Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'processAdminLogin'])->name('admin.login.post');


// Logout
Route::post('/logoutresepsionis', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/resepsionis/login');
})->name('logoutresepsionis');

Route::post('/logoutguest', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logoutguest');

Route::post('/logoutadmin', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/admin/login');
})->name('logoutadmin');

// Halaman Tamu
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');
Route::get('/kamar/{id}', [DeskripsiController::class, 'show'])->name('kamar.show');
Route::get('/booking/{id}', [BookingController::class, 'biodata'])->name('booking.biodata');
Route::get('/booking/{id}/payment', [BookingController::class, 'payment'])->name('booking.payment');
// Receptionist
Route::middleware('auth:receptionist')->group(function () {
    Route::get('/resepsionis/resepsionis', [ReceptsionistController::class, 'index'])->name('receptionist.index');
    Route::get('/resepsionis/riwayat', [ReceptsionistController::class, 'riwayat'])->name('resepsionis.riwayatreservasi');
    Route::get('/resepsionis/riwayat/{id}', [ReceptsionistController::class, 'show'])->name('resepsionis.show');
});

// Admin
Route::prefix('admin')->group(function () {
    Route::get('/kelolakamar', function () {
        return view('admin.kelolakamar');
    })->name('admin.kamar');

    Route::get('/crudresepsionis', function () {
        return view('admin.crudresepsionis');
    })->name('admin.resepsionis');

    Route::get('/crudtamu', function () {
        return view('admin.crudtamu');
    })->name('admin.tamu');
});