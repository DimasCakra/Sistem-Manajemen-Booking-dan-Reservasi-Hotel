<?php

namespace App\Http\Controllers\Tamu;

use Illuminate\Http\Request;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\Tamu\KatalogController;

class BookingController extends TamuController
{
    public function biodata($id)
    {
        $allKamars = KatalogController::$dataKamars;

        if (!isset($allKamars[$id])) {
            abort(404);
        }

        $kamar = (object) $allKamars[$id];

        // Mock data for check-in and check-out
        $checkin = request()->query('checkin', '12 Oct 2023');
        $checkout = request()->query('checkout', '13 Oct 2023');
        $durasi = 1;
        $pajak = $kamar->harga * 0.10; // 10% tax
        $total = $kamar->harga + $pajak;

        return view('biodata', compact('kamar', 'id', 'checkin', 'checkout', 'durasi', 'pajak', 'total'));
    }

    public function payment($id)
    {
        $allKamars = KatalogController::$dataKamars;

        if (!isset($allKamars[$id])) {
            abort(404);
        }

        $kamar = (object) $allKamars[$id];

        // Mock data
        $checkin = request()->query('checkin', '12 Oct 2023');
        $checkout = request()->query('checkout', '13 Oct 2023');
        $durasi = 1;
        $pajak = $kamar->harga * 0.10;
        $total = $kamar->harga + $pajak;

        return view('payment', compact('kamar', 'id', 'checkin', 'checkout', 'durasi', 'pajak', 'total'));
    }
}
