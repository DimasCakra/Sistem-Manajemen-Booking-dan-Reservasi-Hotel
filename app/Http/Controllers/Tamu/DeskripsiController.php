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
            'nama_tipe'     => $type->nama_tipe,
            'harga'         => $type->harga_per_malam,
            'fasilitas'     => $type->deskripsi,
            'foto_kamar'    => $type->foto_kamar, // KIRIM KAN DATA STRING JSON ASLI KE BLADE
            'available'     => $type->kamars()->where('status_kamar', 'Tersedia')->count(),
            'jumlah_tamu'   => $type->jumlah_tamu ?? 2,
            'rating'        => 4.7,
        ];

        return view('deskripsikamar', compact('kamar'));
    }
}
