<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| AUTHENTICATION USER / GUEST
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'processRegister'])->name('register.post');
Route::get('/id_number', [AuthController::class, 'showNik'])->name('id_number');
Route::post('/id_number', [AuthController::class, 'processNik'])->name('id_number.post');
Route::post('/register/cancel', [AuthController::class, 'cancelRegister'])->name('register.cancel')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

/*
|--------------------------------------------------------------------------
| AUTHENTICATION STAFF
|--------------------------------------------------------------------------
*/
Route::get('/staff/login', [AuthController::class, 'showStaffLogin'])->name('staff.login');
Route::post('/staff/login', [AuthController::class, 'processStaffLogin'])->name('staff.login.post');

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/
Route::post('/logoutguest', [AuthController::class, 'logoutGuest'])->name('logoutguest');
Route::post('/logoutstaff', [AuthController::class, 'logoutStaff'])->name('logoutstaff');
