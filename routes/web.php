<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Tamu\KatalogController;
use App\Http\Controllers\Tamu\DeskripsiController;
use App\Http\Controllers\ReceptsionistController;
use App\Http\Controllers\Tamu\BookingController;
use App\Http\Controllers\Tamu\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Staff\AdminController;
use App\Http\Controllers\Staff\ResepsionisController;

/*
|--------------------------------------------------------------------------
| HALAMAN AWAL
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATION USER / GUEST
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'processLogin'])
    ->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'processRegister'])
    ->name('register.post');

Route::get('/username', [AuthController::class, 'showUsername'])
    ->name('username');

Route::post('/username', [AuthController::class, 'processUsername'])
    ->name('username.post');

/*
|--------------------------------------------------------------------------
| AUTHENTICATION STAFF
|--------------------------------------------------------------------------
*/

Route::get('/staff/login', [AuthController::class, 'showStaffLogin'])
    ->name('staff.login');

Route::post('/staff/login', [AuthController::class, 'processStaffLogin'])
    ->name('staff.login.post');

/*
|--------------------------------------------------------------------------
| DASHBOARD STAFF
|--------------------------------------------------------------------------
| Polymorphism:
| Sistem menampilkan dashboard berbeda berdasarkan role staff
| Admin -> Dashboard Admin
| Receptionist -> Dashboard Receptionist
*/

Route::middleware('auth:staff')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logoutguest', [AuthController::class, 'logoutGuest'])
    ->name('logoutguest');

Route::post('/logoutstaff', [AuthController::class, 'logoutStaff'])
    ->name('logoutstaff');

/*
|--------------------------------------------------------------------------
| HALAMAN TAMU
|--------------------------------------------------------------------------
*/

Route::get('/home', [TamuController::class, 'index'])
    ->name('home');

Route::get('/katalog', [KatalogController::class, 'index'])
    ->name('katalog');

Route::get('/kamar/{id}', [DeskripsiController::class, 'show'])
    ->name('kamar.show');

Route::get('/booking/{id}', [BookingController::class, 'biodata'])
    ->name('booking.biodata');

Route::get('/booking/{id}/payment', [BookingController::class, 'payment'])
    ->name('booking.payment');

/*
|--------------------------------------------------------------------------
| PROFILE USER
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::post('/profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::get('/profile/orders', [ProfileController::class, 'orders'])
        ->name('profile.orders');

    Route::get('/profile/reviews', [ProfileController::class, 'reviews'])
        ->name('profile.reviews');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD RECEPTIONIST
|--------------------------------------------------------------------------
*/

Route::middleware('auth:staff')->group(function () {

    Route::get('/resepsionis/resepsionis',
        [ReceptsionistController::class, 'index'])
        ->name('receptionist.index');

    Route::get('/resepsionis/verifikasi',
        [ResepsionisController::class, 'verifikasi'])
        ->name('verifikasitamu');

    Route::get('/resepsionis/riwayat',
        [ResepsionisController::class, 'riwayat'])
        ->name('resepsionis.riwayatreservasi');

    Route::get('/resepsionis/riwayat/{id}',
        [ResepsionisController::class, 'show'])
        ->name('reservasi.show');

    // Tamu Management (Create & Read)
    Route::get('/resepsionis/tamu',
        [ResepsionisController::class, 'tamuIndex'])
        ->name('resepsionis.tamu');

    Route::get('/resepsionis/tamu/create',
        [ResepsionisController::class, 'tamuCreate'])
        ->name('resepsionis.tamu.create');

    Route::post('/resepsionis/tamu',
        [ResepsionisController::class, 'tamuStore'])
        ->name('resepsionis.tamu.store');

    Route::get('/resepsionis/tamu/{id}',
        [ResepsionisController::class, 'tamuShow'])
        ->name('resepsionis.tamu.show');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware('auth:staff')
    ->prefix('admin')
    ->group(function () {

    // Tamu Management (CRUD)
    Route::get('/tamu',
        [AdminController::class, 'tamuIndex'])
        ->name('admin.tamu');

    Route::get('/tamu/create',
        [AdminController::class, 'tamuCreate'])
        ->name('admin.tamu.create');

    Route::post('/tamu',
        [AdminController::class, 'tamuStore'])
        ->name('admin.tamu.store');

    Route::get('/tamu/{id}',
        [AdminController::class, 'tamuShow'])
        ->name('admin.tamu.show');

    Route::get('/tamu/{id}/edit',
        [AdminController::class, 'tamuEdit'])
        ->name('admin.tamu.edit');

    Route::put('/tamu/{id}',
        [AdminController::class, 'tamuUpdate'])
        ->name('admin.tamu.update');

    Route::delete('/tamu/{id}',
        [AdminController::class, 'tamuDestroy'])
        ->name('admin.tamu.destroy');

    // Resepsionis Management (CRUD)
    Route::get('/resepsionis',
        [AdminController::class, 'resepsionisIndex'])
        ->name('admin.resepsionis');

    Route::get('/resepsionis/create',
        [AdminController::class, 'resepsionisCreate'])
        ->name('admin.resepsionis.create');

    Route::post('/resepsionis',
        [AdminController::class, 'resepsionisStore'])
        ->name('admin.resepsionis.store');

    Route::get('/resepsionis/{id}',
        [AdminController::class, 'resepsionisShow'])
        ->name('admin.resepsionis.show');

    Route::get('/resepsionis/{id}/edit',
        [AdminController::class, 'resepsionisEdit'])
        ->name('admin.resepsionis.edit');

    Route::put('/resepsionis/{id}',
        [AdminController::class, 'resepsionisUpdate'])
        ->name('admin.resepsionis.update');

    Route::delete('/resepsionis/{id}',
        [AdminController::class, 'resepsionisDestroy'])
        ->name('admin.resepsionis.destroy');

    // Kamar Management (CRUD)
    Route::get('/kamar',
        [AdminController::class, 'kamarIndex'])
        ->name('admin.kamar');

    Route::get('/kamar/create',
        [AdminController::class, 'kamarCreate'])
        ->name('admin.kamar.create');

    Route::post('/kamar',
        [AdminController::class, 'kamarStore'])
        ->name('admin.kamar.store');

    Route::get('/kamar/{id}',
        [AdminController::class, 'kamarShow'])
        ->name('admin.kamar.show');

    Route::get('/kamar/{id}/edit',
        [AdminController::class, 'kamarEdit'])
        ->name('admin.kamar.edit');

    Route::put('/kamar/{id}',
        [AdminController::class, 'kamarUpdate'])
        ->name('admin.kamar.update');

    Route::delete('/kamar/{id}',
        [AdminController::class, 'kamarDestroy'])
        ->name('admin.kamar.destroy');
});

/*
|--------------------------------------------------------------------------
| USER DATA
|--------------------------------------------------------------------------
*/

Route::get('/viewuser', [UserController::class, 'showUsers'])
    ->name('viewuser');
