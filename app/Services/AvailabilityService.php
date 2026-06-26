<?php

namespace App\Services;

use App\Enums\ReservationStatus;
use App\Models\Kamar;
use App\Models\Reservation;
use Carbon\Carbon;

class AvailabilityService
{
    public const PAYMENT_TIMEOUT_MINUTES = 15;

    /**
     * Parse check-in/check-out dates from a reservation record.
     *
     * @return array{start: Carbon, end: Carbon}|null
     */
    public function parseReservationDates(Reservation $reservation): ?array
    {
        if ($reservation->check_in && $reservation->check_out) {
            return [
                'start' => Carbon::parse($reservation->check_in)->startOfDay(),
                'end' => Carbon::parse($reservation->check_out)->startOfDay(),
            ];
        }

        if (!$reservation->check_in_out) {
            return null;
        }

        if (str_contains($reservation->check_in_out, ' to ')) {
            [$startString, $endString] = explode(' to ', $reservation->check_in_out, 2);

            try {
                return [
                    'start' => Carbon::parse(trim($startString))->startOfDay(),
                    'end' => Carbon::parse(trim($endString))->startOfDay(),
                ];
            } catch (\Exception) {
                return null;
            }
        }

        if (str_contains($reservation->check_in_out, ' - ')) {
            [$startString, $endString] = explode(' - ', $reservation->check_in_out, 2);

            try {
                return [
                    'start' => Carbon::createFromFormat('d/F/Y', trim($startString))->startOfDay(),
                    'end' => Carbon::createFromFormat('d/F/Y', trim($endString))->startOfDay(),
                ];
            } catch (\Exception) {
                return null;
            }
        }

        return null;
    }

    public function reservationBlocksAvailability(Reservation $reservation): bool
    {
        if (in_array($reservation->status, ReservationStatus::inactiveValues(), true)) {
            return false;
        }

        if ($reservation->status === ReservationStatus::Pending->value && is_null($reservation->bukti_pembayaran)) {
            return false;
        }

        if ($this->isPaymentWindowExpired($reservation)) {
            return false;
        }

        return true;
    }

    public function isPaymentWindowExpired(Reservation $reservation): bool
    {
        if (!in_array($reservation->status, ReservationStatus::payableValues(), true)) {
            return false;
        }

        return $reservation->created_at->diffInMinutes(now()) >= self::PAYMENT_TIMEOUT_MINUTES;
    }

    public function datesOverlap(Carbon $start, Carbon $end, Carbon $resStart, Carbon $resEnd): bool
    {
        return $resStart <= $end && $resEnd >= $start;
    }

    /**
     * Find the first available physical room for a room type and date range.
     */
    public function findAvailableKamar(string $tipeNama, string $checkin, string $checkout): ?string
    {
        $start = Carbon::parse($checkin)->startOfDay();
        $end = Carbon::parse($checkout)->startOfDay();

        $kamars = Kamar::whereHas('tipe', function ($query) use ($tipeNama) {
            $query->where('nama_tipe', $tipeNama);
        })
            ->where('status_kamar', 'tersedia')
            ->orderBy('created_at', 'asc')
            ->get();

        foreach ($kamars as $kamar) {
            if (!$this->kamarHasConflict($kamar->id_kamar, $start, $end)) {
                return $kamar->id_kamar;
            }
        }

        return null;
    }

    public function kamarHasConflict(string $kamarId, Carbon $start, Carbon $end): bool
    {
        $reservations = Reservation::where(function ($query) use ($kamarId) {
            $query->where('kamar_id', $kamarId)
                ->orWhere('room_number', $kamarId);
        })
            ->whereNotIn('status', ReservationStatus::inactiveValues())
            ->get();

        foreach ($reservations as $reservation) {
            if (!$this->reservationBlocksAvailability($reservation)) {
                continue;
            }

            $dates = $this->parseReservationDates($reservation);
            if (!$dates) {
                continue;
            }

            if ($this->datesOverlap($start, $end, $dates['start'], $dates['end'])) {
                return true;
            }
        }

        return false;
    }

    /**
     * Count how many rooms of a type are blocked for a date range (catalog view).
     */
    public function countReservedRoomsForType(string $tipeNama, Carbon $searchStart, Carbon $searchEnd): int
    {
        return Reservation::where('room_type', $tipeNama)
            ->whereNotIn('status', [
                ReservationStatus::Done->value,
                ReservationStatus::Checkout->value,
                ReservationStatus::Cancelled->value,
            ])
            ->get()
            ->filter(function (Reservation $reservation) use ($searchStart, $searchEnd) {
                if (!$this->reservationBlocksAvailability($reservation)) {
                    return false;
                }

                $dates = $this->parseReservationDates($reservation);
                if (!$dates) {
                    return false;
                }

                return $this->datesOverlap(
                    $searchStart->copy()->startOfDay(),
                    $searchEnd->copy()->startOfDay(),
                    $dates['start'],
                    $dates['end']
                );
            })
            ->count();
    }
}
