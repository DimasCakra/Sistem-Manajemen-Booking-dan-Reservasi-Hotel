<?php

namespace App\Http\Controllers\Tamu;

use App\Http\Controllers\TamuController;
use App\Models\TipeKamar;

class DeskripsiController extends TamuController
{
    public function show($id)
    {
        $type = TipeKamar::findOrFail($id);

        $avgRating = \App\Models\Review::where('room_type', $type->nama_tipe)->avg('rating') ?? 0;
        $reviews = \App\Models\Review::where('room_type', $type->nama_tipe)
            ->with('user')
            ->orderBy('id', 'desc')
            ->get();

        $kamar = (object) [
            'id_tipe_kamar' => $type->id_tipe_kamar,
            'nama_tipe'     => $type->nama_tipe,
            'harga'         => $type->harga_per_malam,
            'fasilitas'     => $type->deskripsi,
            'foto_kamar'    => $type->foto_kamar, // KIRIM KAN DATA STRING JSON ASLI KE BLADE
            'available'     => $type->kamars()->where('status_kamar', 'Tersedia')->count(),
            'jumlah_tamu'   => $type->jumlah_tamu ?? 2,
            'rating'        => round($avgRating, 1),
        ];

        return view('deskripsikamar', compact('kamar', 'reviews'));
    }
}
