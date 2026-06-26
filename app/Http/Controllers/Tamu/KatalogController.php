<?php

namespace App\Http\Controllers\Tamu;

use App\Http\Controllers\TamuController;
use App\Models\Review;
use App\Models\TipeKamar;
use App\Services\AvailabilityService;
use App\Services\ReservationService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KatalogController extends TamuController
{
    public function __construct(
        protected AvailabilityService $availability,
        protected ReservationService $reservationService
    ) {}

    public function index(Request $request)
    {
        $request = $request ?? request();
        $checkin = $request->query('checkin');
        $checkout = $request->query('checkout');
        $guests = (int) $request->query('guests', 2);

        $this->reservationService->expireStaleReservations();

        $tipeKamars = TipeKamar::with('kamars')->orderBy('id_tipe_kamar', 'desc')->get();

        $searchHasDates = false;
        $searchStart = null;
        $searchEnd = null;

        if ($checkin && $checkout) {
            try {
                $searchStart = Carbon::parse($checkin)->startOfDay();
                $searchEnd = Carbon::parse($checkout)->startOfDay();
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
                $reservedCount = $this->availability->countReservedRoomsForType(
                    $type->nama_tipe,
                    $searchStart,
                    $searchEnd
                );
            }

            $avgRating = Review::where('room_type', $type->nama_tipe)->avg('rating') ?? 0;

            return (object) [
                'id_tipe_kamar' => $type->id_tipe_kamar,
                'nama_tipe' => $type->nama_tipe,
                'harga' => $type->harga_per_malam,
                'available' => max(0, $totalRooms - $reservedCount),
                'rating' => round($avgRating, 1),
                'fasilitas' => $type->deskripsi,
                'gambar' => $type->foto_kamar && count($type->foto_kamar) ? asset('storage/' . $type->foto_kamar[0]) : 'https://via.placeholder.com/380x260?text=No+Image',
                'jumlah_tamu' => $type->jumlah_tamu,
            ];
        })->filter()->values();

        return view('katalog', compact('kamars', 'checkin', 'checkout', 'guests'));
    }
}
