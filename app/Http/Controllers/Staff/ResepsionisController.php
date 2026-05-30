<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ResepsionisController extends Controller
{

    public function tamuIndex()
    {
        $tamus = User::latest()->get();
        return view('resepsionis.crudtamu', compact('tamus'));
    }


    public function tamuCreate()
    {
        return redirect()->route('resepsionis.tamu');
    }

    public function tamuStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'whatsapp' => 'required|string|max:20',
            'tanggal_lahir' => 'nullable|date',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        if ($request->hasFile('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('foto_profil', 'public');
        }

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
