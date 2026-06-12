<?php

namespace App\ViewModels;

use Illuminate\Support\Collection;

class HomeViewModel
{
    public function __construct(
        public readonly Collection $services,
        public readonly Collection $programs,
        public readonly Collection $causes,
        public readonly Collection $posts,
        public readonly Collection $testimonials,
        public readonly Collection $galleryItems,
        public readonly Collection $counters,
    ) {}

    public function featuredCause(): mixed
    {
        return $this->causes->first();
    }

    public function totalRaised(): float
    {
        return $this->causes->sum('raised_amount');
    }

    public function totalGoal(): float
    {
        return $this->causes->sum('goal_amount');
    }

    public function toArray(): array
    {
        return [
            'services'     => $this->services,
            'programs'     => $this->programs,
            'causes'       => $this->causes,
            'posts'        => $this->posts,
            'testimonials' => $this->testimonials,
            'galleryItems' => $this->galleryItems,
            'counters'     => $this->counters,
        ];
    }
}
