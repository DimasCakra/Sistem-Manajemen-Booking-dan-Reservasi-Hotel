<?php

use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\LoginController;

Route::get('/login', [LoginController::class, 'index']);
