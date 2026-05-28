<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Staff\AdminController;

/*
|--------------------------------------------------------------------------
| DASHBOARD ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware('auth:staff')->prefix('admin')->group(function () {
    // Tamu Management (CRUD)
    Route::get('/tamu', [AdminController::class, 'tamuIndex'])->name('admin.tamu');
    Route::get('/tamu/create', [AdminController::class, 'tamuCreate'])->name('admin.tamu.create');
    Route::post('/tamu', [AdminController::class, 'tamuStore'])->name('admin.tamu.store');
    Route::get('/tamu/{id}', [AdminController::class, 'tamuShow'])->name('admin.tamu.show');
    Route::get('/tamu/{id}/edit', [AdminController::class, 'tamuEdit'])->name('admin.tamu.edit');
    Route::put('/tamu/{id}', [AdminController::class, 'tamuUpdate'])->name('admin.tamu.update');
    Route::delete('/tamu/{id}', [AdminController::class, 'tamuDestroy'])->name('admin.tamu.destroy');

    // Resepsionis Management (CRUD)
    Route::get('/resepsionis', [AdminController::class, 'resepsionisIndex'])->name('admin.resepsionis');
    Route::get('/resepsionis/create', [AdminController::class, 'resepsionisCreate'])->name('admin.resepsionis.create');
    Route::post('/resepsionis', [AdminController::class, 'resepsionisStore'])->name('admin.resepsionis.store');
    Route::get('/resepsionis/{id}', [AdminController::class, 'resepsionisShow'])->name('admin.resepsionis.show');
    Route::get('/resepsionis/{id}/edit', [AdminController::class, 'resepsionisEdit'])->name('admin.resepsionis.edit');
    Route::put('/resepsionis/{id}', [AdminController::class, 'resepsionisUpdate'])->name('admin.resepsionis.update');
    Route::delete('/resepsionis/{id}', [AdminController::class, 'resepsionisDestroy'])->name('admin.resepsionis.destroy');

    // Kamar Management (CRUD)
    Route::get('/kamar', [AdminController::class, 'kamarIndex'])->name('admin.kamar');
    Route::get('/kamar/create', [AdminController::class, 'kamarCreate'])->name('admin.kamar.create');
    Route::post('/kamar', [AdminController::class, 'kamarStore'])->name('admin.kamar.store');
    Route::get('/kamar/{id}', [AdminController::class, 'kamarShow'])->name('admin.kamar.show');
    Route::get('/kamar/{id}/edit', [AdminController::class, 'kamarEdit'])->name('admin.kamar.edit');
    Route::put('/kamar/{id}', [AdminController::class, 'kamarUpdate'])->name('admin.kamar.update');
    Route::delete('/kamar/{id}', [AdminController::class, 'kamarDestroy'])->name('admin.kamar.destroy');
});
