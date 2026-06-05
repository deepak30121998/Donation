<?php

namespace App\Contracts\Repositories;

use Illuminate\Support\Collection;

interface TestimonialRepositoryInterface extends BaseRepositoryInterface
{
    public function activeOrdered(): Collection;
}
