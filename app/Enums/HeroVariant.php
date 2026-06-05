<?php

namespace App\Enums;

enum HeroVariant: string
{
    case Image  = 'image';
    case Video  = 'video';
    case Slider = 'slider';

    public function label(): string
    {
        return match($this) {
            self::Image  => 'Static Image',
            self::Video  => 'Background Video',
            self::Slider => 'Image Slider',
        };
    }
}
