<?php

namespace App\Http\Controllers; // WAJIB ADA BARIS INI

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Notification;

class ReceptsionistController extends Controller
{
    public function index()
    {
        // Mengambil data dengan eager loading agar ringan
        $reservations = Reservation::with(['guest', 'room'])->latest()->get();
        $notifications = Notification::latest()->get();

        // Menghitung notifikasi yang belum dibaca (asumsi ada kolom 'is_read')
        $newCount = Notification::count();

        // Nama view disesuaikan dengan file kamu: receptsionis.blade.php
        return view('receptsionis', [
            'receptionist' => auth()->user(),
            'reservations' => $reservations,
            'notifications' => $notifications,
            'newCount' => $newCount,
        ]);
    }
}