<?php

namespace App\Enums;

enum ReservationStatus: string
{
    case Temporary = 'temporary';
    case Pending = 'pending';
    case Ongoing = 'ongoing';
    case Checkout = 'checkout';
    case Cancelled = 'cancelled';
    case Done = 'done';

    /** Statuses that no longer block room availability. */
    public static function inactiveValues(): array
    {
        return [
            self::Temporary->value,
            self::Cancelled->value,
            self::Done->value,
            self::Checkout->value,
        ];
    }

    /** Statuses shown as completed in guest/staff UI. */
    public static function completedValues(): array
    {
        return [self::Checkout->value, self::Done->value];
    }

    /** Statuses visible on guest order history. */
    public static function guestOrderValues(): array
    {
        return [
            self::Temporary->value,
            self::Pending->value,
            self::Ongoing->value,
            self::Checkout->value,
            self::Done->value,
            self::Cancelled->value,
        ];
    }

    /** Statuses allowed on the payment page. */
    public static function payableValues(): array
    {
        return [self::Temporary->value, self::Pending->value];
    }
}
