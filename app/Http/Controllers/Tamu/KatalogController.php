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
                    ->whereNotIn('status', ['done', 'cancelled'])
                    ->get()
                    ->filter(function (Reservation $reservation) use ($searchStart, $searchEnd) {
                        if ($reservation->status === 'pending' && $reservation->created_at->diffInMinutes(now()) >= 15) {
                            $reservation->update(['status' => 'cancelled']);
                            return false;
                        }

                        if (!str_contains($reservation->check_in_out, ' - ') && !str_contains($reservation->check_in_out, ' to ')) {
                            return false;
                        }

                        $separator = str_contains($reservation->check_in_out, ' to ') ? ' to ' : ' - ';
                        [$startString, $endString] = explode($separator, $reservation->check_in_out);

                        try {
                            $format = str_contains($reservation->check_in_out, ' to ') ? 'Y-m-d' : 'd/F/Y';
                            $start = Carbon::createFromFormat($format, trim($startString))->startOfDay();
                            $end = Carbon::createFromFormat($format, trim($endString))->endOfDay();
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
