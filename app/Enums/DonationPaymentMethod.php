<?php

namespace App\Enums;

enum DonationPaymentMethod: string
{
    case Online  = 'online';
    case Offline = 'offline';
    case Test    = 'test';

    public function label(): string
    {
        return match($this) {
            self::Online  => 'Online',
            self::Offline => 'Offline',
            self::Test    => 'Test',
        };
    }
}
