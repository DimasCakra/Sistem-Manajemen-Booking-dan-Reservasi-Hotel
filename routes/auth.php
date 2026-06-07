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
Route::get('/nik', [AuthController::class, 'showNik'])->name('nik');
Route::post('/nik', [AuthController::class, 'processNik'])->name('nik.post');

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
