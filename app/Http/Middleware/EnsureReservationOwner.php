<?php

namespace App\Http\Middleware;

use App\Models\Reservation;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureReservationOwner
{
    public function handle(Request $request, Closure $next): Response
    {
        $reservationId = $request->route('reservation_id');
        $reservation = Reservation::find($reservationId);

        if (!$reservation) {
            abort(404);
        }

        $sessionMatch = (int) session('booking_reservation_id') === (int) $reservation->id;
        $userMatch = auth()->check() && (int) $reservation->user_id === (int) auth()->id();

        if (!$sessionMatch && !$userMatch) {
            return redirect()->route('home')->with('error', 'Anda tidak memiliki akses ke reservasi ini.');
        }

        return $next($request);
    }
}
