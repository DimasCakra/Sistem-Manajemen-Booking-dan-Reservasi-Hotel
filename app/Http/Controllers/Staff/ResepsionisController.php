<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResepsionisController extends Controller
{

    public function tamuIndex()
    {
        $tamus = User::latest()->get();
        return view('resepsionis.crudtamu', compact('tamus'));
    }


    public function tamuCreate()
    {
        return view('resepsionis.tambah_tamu');
    }

    public function tamuStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'whatsapp' => 'required|string|max:20',
            'username' => 'nullable|string|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('resepsionis.tamu')->with('success', 'Tamu berhasil ditambahkan');
    }

    public function tamuShow($id)
    {
        $tamu = User::find($id);

        if (!$tamu) {
            return redirect()->route('resepsionis.tamu')->with('error', 'Tamu tidak ditemukan');
        }

        return view('resepsionis.detail_tamu', compact('tamu'));
    }

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

    public function show($id)
    {
        $detail = Reservation::find($id);

        if (!$detail) {
            return redirect()->route('resepsionis.riwayatreservasi')->with('error', 'Reservasi tidak ditemukan');
        }

        return view('resepsionis.detailreservasi', compact('detail'));
    }

    public function verifikasi()
    {
        return view('resepsionis.verifikasitamu');
    }
}
