<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Notification;

class ReceptsionistController extends Controller
{
    // Dashboard Utama
    public function index()
    {
        // Hapus 'with' karena tabel kita masih satu kesatuan
        $reservations = Reservation::latest()->get();
        $notifications = Notification::latest()->get();
        $newCount = Notification::count();

        return view('receptsionis', [
            'receptionist' => auth()->user(),
            'reservations' => $reservations,
            'notifications' => $notifications,
            'newCount' => $newCount,
        ]);
    }

    // Halaman Riwayat (Tabel)
    public function riwayat(Request $request)
    {
        $status = $request->query('status');
        $query = Reservation::query();

        if ($status) {
            $query->where('status', $status);
        }

        $reservations = $query->latest()->get();

        return view('resepsionis.riwayatreservasi', compact('reservations', 'status'));
    }

    // Halaman Detail (Read-Only)
    public function show($id)
    {
        $detail = Reservation::findOrFail($id);
        return view('resepsionis.detailreservasi', compact('detail'));
    }
}