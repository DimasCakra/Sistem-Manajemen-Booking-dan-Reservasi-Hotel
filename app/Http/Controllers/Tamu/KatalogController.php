<?php

namespace App\Http\Controllers\Tamu;

use App\Http\Controllers\TamuController;
use App\Models\Reservation;
use App\Models\TipeKamar;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KatalogController extends TamuController
{
    public function index(Request $request)
    {
        $request = $request ?? request();
        $checkin = $request->query('checkin');
        $checkout = $request->query('checkout');
        $guests = (int) $request->query('guests', 2);

        $tipeKamars = TipeKamar::with('kamars')->orderBy('id_tipe_kamar', 'desc')->get();

        $searchHasDates = false;
        $searchStart = null;
        $searchEnd = null;

        if ($checkin && $checkout) {
            try {
                $searchStart = Carbon::parse($checkin)->startOfDay();
                $searchEnd = Carbon::parse($checkout)->endOfDay();
                $searchHasDates = true;
            } catch (\Exception $e) {
                $searchHasDates = false;
            }
        }

        $kamars = $tipeKamars->map(function (TipeKamar $type) use ($searchHasDates, $searchStart, $searchEnd, $guests) {
            if ($type->jumlah_tamu < $guests) {
                return null;
            }

            $totalRooms = $type->kamars->count();
            $reservedCount = 0;

            if ($searchHasDates && $totalRooms > 0) {
                $reservedCount = Reservation::where('room_type', $type->nama_tipe)
                    ->where('status', '!=', 'done')
                    ->get()
                    ->filter(function (Reservation $reservation) use ($searchStart, $searchEnd) {
                        if (!str_contains($reservation->check_in_out, ' - ')) {
                            return false;
                        }

                        [$startString, $endString] = explode(' - ', $reservation->check_in_out);

                        try {
                            $start = Carbon::createFromFormat('d/F/Y', trim($startString))->startOfDay();
                            $end = Carbon::createFromFormat('d/F/Y', trim($endString))->endOfDay();
                        } catch (\Exception $e) {
                            return false;
                        }

                        return $start <= $searchEnd && $end >= $searchStart;
                    })
                    ->count();
            }

            return (object) [
                'id_tipe_kamar' => $type->id_tipe_kamar,
                'nama_tipe' => $type->nama_tipe,
                'harga' => $type->harga_per_malam,
                'available' => max(0, $totalRooms - $reservedCount),
                'rating' => 4.7,
                'fasilitas' => $type->deskripsi,
                'gambar' => $type->foto_kamar && count($type->foto_kamar) ? asset('storage/' . $type->foto_kamar[0]) : 'https://via.placeholder.com/380x260?text=No+Image',
                'jumlah_tamu' => $type->jumlah_tamu,
            ];
        })->filter()->values();

        return view('katalog', compact('kamars', 'checkin', 'checkout', 'guests'));
    }
}
