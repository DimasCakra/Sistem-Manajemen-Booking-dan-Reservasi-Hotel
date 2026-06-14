<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReceptsionistController;
use App\Http\Controllers\Staff\ResepsionisController;

/*
|--------------------------------------------------------------------------
| DASHBOARD RECEPTIONIST
|--------------------------------------------------------------------------
*/
Route::middleware('auth:staff')->group(function () {
    Route::get('/resepsionis/resepsionis', [ReceptsionistController::class, 'index'])->name('receptionist.index');
    Route::get('/resepsionis/verifikasi/{id}', [ResepsionisController::class, 'verifikasi'])->name('verifikasitamu');
    Route::post('/resepsionis/verifikasi/{id}', [ResepsionisController::class, 'updateVerifikasi'])->name('resepsionis.verifikasi.update');
    Route::get('/resepsionis/riwayat', [ResepsionisController::class, 'riwayat'])->name('resepsionis.riwayatreservasi');
    Route::get('/resepsionis/riwayat/{id}', [ResepsionisController::class, 'show'])->name('reservasi.show');

    // Tamu Management (Create & Read)
    Route::get('/resepsionis/tamu', [ResepsionisController::class, 'tamuIndex'])->name('resepsionis.tamu');
    Route::get('/resepsionis/tamu/create', [ResepsionisController::class, 'tamuCreate'])->name('resepsionis.tamu.create');
    Route::post('/resepsionis/tamu', [ResepsionisController::class, 'tamuStore'])->name('resepsionis.tamu.store');
    Route::get('/resepsionis/tamu/{id}', [ResepsionisController::class, 'tamuShow'])->name('resepsionis.tamu.show');
});
