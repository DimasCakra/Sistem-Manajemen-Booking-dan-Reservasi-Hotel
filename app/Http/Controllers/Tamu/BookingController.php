<?php

namespace App\Http\Controllers\Tamu;

use App\Models\TipeKamar;
use App\Http\Controllers\TamuController;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends TamuController
{
    protected function loadKamar($id)
    {
        $type = TipeKamar::findOrFail($id);

        return (object) [
            'id_tipe_kamar' => $type->id_tipe_kamar,
            'nama_tipe' => $type->nama_tipe,
            'harga' => $type->harga_per_malam,
            'jumlah_tamu' => $type->jumlah_tamu,
            'gambar' => $type->foto_kamar && count($type->foto_kamar) ? asset('storage/' . $type->foto_kamar[0]) : 'https://via.placeholder.com/380x260?text=No+Image',
        ];
    }

    protected function resolveDates(Request $request)
    {
        $checkin = $request->query('checkin', now()->format('Y-m-d'));
        $checkout = $request->query('checkout', now()->addDay()->format('Y-m-d'));

        try {
            $start = Carbon::parse($checkin)->startOfDay();
            $end = Carbon::parse($checkout)->startOfDay();
            $durasi = max(1, $start->diffInDays($end));
        } catch (\Exception $e) {
            $checkin = now()->format('Y-m-d');
            $checkout = now()->addDay()->format('Y-m-d');
            $durasi = 1;
        }

        return [
            'checkin' => $checkin,
            'checkout' => $checkout,
            'durasi' => $durasi,
        ];
    }

    public function biodata(Request $request, $id)
    {
        $kamar = $this->loadKamar($id);
        $dates = $this->resolveDates($request);

        $pajak = $kamar->harga * 0.10;
        $total = ($kamar->harga * $dates['durasi']) + $pajak;

        return view('biodata', array_merge(compact('kamar', 'id'), $dates, compact('pajak', 'total')));
    }

    public function payment(Request $request, $id)
    {
        $kamar = $this->loadKamar($id);
        $dates = $this->resolveDates($request);

        $pajak = $kamar->harga * 0.10;
        $total = ($kamar->harga * $dates['durasi']) + $pajak;

        return view('payment', array_merge(compact('kamar', 'id'), $dates, compact('pajak', 'total')));
    }
}
