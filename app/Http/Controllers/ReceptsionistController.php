<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReceptsionistController extends Controller
{
    // Dashboard Utama
    public function index()
    {
        // Hapus 'with' karena tabel kita masih satu kesatuan
        $reservations = Reservation::latest()->get();

        return view('resepsionis.receptsionis', [
            'receptionist' => auth()->user(),
            'reservations' => $reservations,
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
        $detail = Reservation::find($id);

        if (!$detail) {
            $detail = new Reservation();
            $detail->id = $id;
            
            if ($id == 1) {
                $detail->nama_lengkap = 'Briyan Abisai';
                $detail->email = 'briyan@gmail.com';
                $detail->whatsapp = '081234567890';
                $detail->room_type = 'Standard Room';
                $detail->room_number = '102';
                $detail->check_in = '2026-04-27';
                $detail->check_out = '2026-04-28';
                $detail->total_biaya = 800000;
                $detail->status = 'ongoing';
            } else {
                $detail->nama_lengkap = 'Damar Widi Nugroho';
                $detail->email = 'damar@polibatam.ac.id';
                $detail->whatsapp = '089988776655';
                $detail->room_type = 'Suite Room';
                $detail->room_number = '205';
                $detail->check_in = '2026-04-25';
                $detail->check_out = '2026-04-27';
                $detail->total_biaya = 2500000;
                $detail->status = 'done';
            }
        }

        return view('resepsionis.detailreservasi', compact('detail'));
    }
}