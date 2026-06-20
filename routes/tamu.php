<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\Tamu\KatalogController;
use App\Http\Controllers\Tamu\DeskripsiController;
use App\Http\Controllers\Tamu\BookingController;
use App\Http\Controllers\Tamu\ProfileController;

/*
|--------------------------------------------------------------------------
| HALAMAN TAMU (AKSES PUBLIK)
|--------------------------------------------------------------------------
*/
Route::get('/home', [TamuController::class, 'index'])->name('home');
Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');
Route::get('/kamar/{id}', [DeskripsiController::class, 'show'])->name('kamar.show');
Route::get('/booking/{id}', [BookingController::class, 'biodata'])->name('booking.biodata');
Route::post('/booking/{id}/biodata', [BookingController::class, 'storeBiodata'])->name('booking.biodata.store');
Route::get('/booking/payment/{reservation_id}', [BookingController::class, 'payment'])->name('booking.payment');
Route::post('/booking/payment/{reservation_id}', [BookingController::class, 'storePayment'])->name('booking.payment.store');
Route::post('/booking/payment/{reservation_id}/cancel', [BookingController::class, 'cancelPayment'])->name('booking.payment.cancel');

/*
|--------------------------------------------------------------------------
| PROFILE USER (HARUS LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/orders', [ProfileController::class, 'orders'])->name('profile.orders');
    Route::post('/profile/orders/{id}/review', [ProfileController::class, 'storeReview'])->name('profile.review.store');
    Route::get('/profile/reviews', [ProfileController::class, 'reviews'])->name('profile.reviews');
});
