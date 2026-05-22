<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // WAJIB TAMBAH INI
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\DeskripsiController;
use App\Http\Controllers\ReceptsionistController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

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

Route::get('/staff/login', [AuthController::class, 'showStaffLogin'])->name('staff.login');
Route::post('/staff/login', [AuthController::class, 'processStaffLogin'])->name('staff.login.post');


// Logout
Route::post('/logoutguest', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logoutguest');

Route::post('/logoutstaff', function () {
    Auth::guard('staff')->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('staff.login');
})->name('logoutstaff');

// Halaman Tamu
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');
Route::get('/kamar/{id}', [DeskripsiController::class, 'show'])->name('kamar.show');
Route::get('/booking/{id}', [BookingController::class, 'biodata'])->name('booking.biodata');
Route::get('/booking/{id}/payment', [BookingController::class, 'payment'])->name('booking.payment');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/orders', [ProfileController::class, 'orders'])->name('profile.orders');
    Route::get('/profile/reviews', [ProfileController::class, 'reviews'])->name('profile.reviews');
});

// Receptionist
Route::middleware('auth:staff')->group(function () {
    Route::get('/resepsionis/resepsionis', [ReceptsionistController::class, 'index'])->name('receptionist.index');
    Route::get('/resepsionis/verifikasi', function () {return view('resepsionis.verifikasitamu');})->name('verifikasitamu');
    Route::get('/resepsionis/riwayat', [ReceptsionistController::class, 'riwayat'])->name('resepsionis.riwayatreservasi');
    Route::get('/resepsionis/riwayat/{id}', [ReceptsionistController::class, 'show'])->name('reservasi.show');
    Route::get('/resepsionis/tamu', function () {return view('resepsionis.crudtamu');})->name('resepsionis.tamu');
});

// Admin
Route::middleware('auth:staff')->prefix('admin')->group(function () {
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


Route::get('/viewuser', [UserController::class, 'showUsers'])->name('viewuser');