<?php

namespace App\Enums;

enum GalleryCategory: string
{
    case All       = 'all';
    case Health    = 'health';
    case Education = 'education';
    case Food      = 'food';

    public function label(): string
    {
        return match($this) {
            self::All       => 'All',
            self::Health    => 'Health',
            self::Education => 'Education',
            self::Food      => 'Food',
        };
    }

    public function filterClass(): string
    {
        return match($this) {
            self::All       => '*',
            self::Health    => '.health',
            self::Education => '.education',
            self::Food      => '.food',
        };
    }
}
