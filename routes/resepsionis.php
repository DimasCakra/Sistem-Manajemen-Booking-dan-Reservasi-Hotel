<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Staff\ResepsionisController;

/*
|--------------------------------------------------------------------------
| DASHBOARD RECEPTIONIST
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:staff', 'staff.role:receptionist'])->group(function () {
    Route::get('/resepsionis/resepsionis', [ResepsionisController::class, 'index'])->name('receptionist.index');
    Route::get('/resepsionis/verifikasi/{id}', [ResepsionisController::class, 'verifikasi'])->name('verifikasitamu');
    Route::post('/resepsionis/verifikasi/{id}', [ResepsionisController::class, 'updateVerifikasi'])->name('resepsionis.verifikasi.update');
    Route::get('/resepsionis/riwayat', [ResepsionisController::class, 'riwayat'])->name('resepsionis.riwayatreservasi');
    Route::get('/resepsionis/riwayat/{id}', [ResepsionisController::class, 'show'])->name('reservasi.show');
    Route::post('/resepsionis/riwayat/{id}/selesai', [ResepsionisController::class, 'selesaikanReservasi'])->name('resepsionis.selesai');
    Route::get('/resepsionis/riwayat/{id}/pdf', [ResepsionisController::class, 'generatePDF'])->name('resepsionis.pdf');

    Route::get('/resepsionis/tamu', [ResepsionisController::class, 'tamuIndex'])->name('resepsionis.tamu');
    Route::get('/resepsionis/tamu/create', [ResepsionisController::class, 'tamuCreate'])->name('resepsionis.tamu.create');
    Route::post('/resepsionis/tamu', [ResepsionisController::class, 'tamuStore'])->name('resepsionis.tamu.store');
    Route::get('/resepsionis/tamu/{id}', [ResepsionisController::class, 'tamuShow'])->name('resepsionis.tamu.show');
});
