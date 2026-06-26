<?php

namespace App\Services;

use App\Enums\ReservationStatus;
use App\Models\Kamar;
use App\Models\Reservation;
use Illuminate\Support\Facades\Storage;

class ReservationService
{
    public function __construct(
        protected AvailabilityService $availability
    ) {}

    public function releaseKamar(Reservation $reservation): void
    {
        if (!$reservation->kamar_id) {
            return;
        }

        $kamar = Kamar::where('id_kamar', $reservation->kamar_id)->first();
        if (!$kamar || $kamar->status_kamar !== 'terisi') {
            return;
        }

        $hasOtherActive = Reservation::where('kamar_id', $reservation->kamar_id)
            ->where('id', '!=', $reservation->id)
            ->where(function ($query) {
                $query->where('status', ReservationStatus::Ongoing->value)
                    ->orWhere(function ($pendingQuery) {
                        $pendingQuery->where('status', ReservationStatus::Pending->value)
                            ->whereNotNull('bukti_pembayaran');
                    });
            })
            ->exists();

        if (!$hasOtherActive) {
            $kamar->update(['status_kamar' => 'tersedia']);
        }
    }

    public function cancel(Reservation $reservation, bool $deleteBukti = true): void
    {
        if ($deleteBukti && $reservation->bukti_pembayaran) {
            try {
                Storage::disk('public')->delete($reservation->bukti_pembayaran);
            } catch (\Exception) {
                // ignore file deletion errors
            }
        }

        $this->releaseKamar($reservation);

        $reservation->update([
            'status' => ReservationStatus::Cancelled->value,
            'bukti_pembayaran' => $deleteBukti ? null : $reservation->bukti_pembayaran,
        ]);
    }

    public function expireIfTimedOut(Reservation $reservation): bool
    {
        if (!$this->availability->isPaymentWindowExpired($reservation)) {
            return false;
        }

        $this->cancel($reservation);

        return true;
    }

    public function expireStaleReservations(): int
    {
        $cutoff = now()->subMinutes(AvailabilityService::PAYMENT_TIMEOUT_MINUTES);

        $reservations = Reservation::whereIn('status', ReservationStatus::payableValues())
            ->where('created_at', '<=', $cutoff)
            ->get();

        foreach ($reservations as $reservation) {
            $this->cancel($reservation);
        }

        return $reservations->count();
    }

    public function completeStay(Reservation $reservation): bool
    {
        if ($reservation->status !== ReservationStatus::Ongoing->value) {
            return false;
        }

        $reservation->update(['status' => ReservationStatus::Checkout->value]);
        $this->releaseKamar($reservation);

        return true;
    }

    public function markKamarTerisi(Reservation $reservation): void
    {
        if (!$reservation->kamar_id) {
            return;
        }

        $kamar = Kamar::where('id_kamar', $reservation->kamar_id)->first();
        if ($kamar) {
            $kamar->update(['status_kamar' => 'terisi']);
        }
    }
}
