<?php

namespace App\Console\Commands;

use App\Services\ReservationService;
use Illuminate\Console\Command;

class ExpireReservationsCommand extends Command
{
    protected $signature = 'reservations:expire';

    protected $description = 'Cancel temporary and pending reservations that exceeded the payment window';

    public function handle(ReservationService $reservationService): int
    {
        $count = $reservationService->expireStaleReservations();

        $this->info("Expired {$count} reservation(s).");

        return self::SUCCESS;
    }
}
