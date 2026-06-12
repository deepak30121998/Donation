<?php

namespace App\Enums;

enum FaqCategory: string
{
    case General   = 'general';
    case Donation  = 'donation';
    case Programs  = 'programs';
    case Volunteer = 'volunteer';
    case Other     = 'other';

    public function label(): string
    {
        return match($this) {
            self::General   => 'General',
            self::Donation  => 'Donation',
            self::Programs  => 'Programs',
            self::Volunteer => 'Volunteer',
            self::Other     => 'Other',
        };
    }
}
