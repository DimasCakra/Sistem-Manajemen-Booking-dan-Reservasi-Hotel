<?php

namespace App\Http\Controllers\Tamu;

use App\Http\Controllers\TamuController;
use App\Models\TipeKamar;

class DeskripsiController extends TamuController
{
    public function show($id)
    {
        $type = TipeKamar::findOrFail($id);

        $kamar = (object) [
            'id_tipe_kamar' => $type->id_tipe_kamar,
            'nama_tipe' => $type->nama_tipe,
            'harga' => $type->harga_per_malam,
            'fasilitas' => $type->deskripsi,
            'gambar' => $type->foto_kamar && count($type->foto_kamar) ? asset('storage/' . $type->foto_kamar[0]) : 'https://via.placeholder.com/380x260?text=No+Image',
            'available' => $type->kamars()->count(),
            'jumlah_tamu' => $type->jumlah_tamu,
            'rating' => 4.7,
        ];

        return view('deskripsikamar', compact('kamar'));
    }
}
