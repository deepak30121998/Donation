<?php

namespace App\Contracts\Repositories;

use Illuminate\Support\Collection;

interface DonationRepositoryInterface extends BaseRepositoryInterface
{
    public function totalRaised(): float;

    public function recent(int $limit = 5): Collection;
}
