<?php

namespace App\Repositories;

use App\Contracts\Repositories\DonationRepositoryInterface;
use App\Models\Donation;
use Illuminate\Support\Collection;

class EloquentDonationRepository extends EloquentBaseRepository implements DonationRepositoryInterface
{
    public function __construct(Donation $model)
    {
        parent::__construct($model);
    }

    public function totalRaised(): float
    {
        return (float) $this->model->newQuery()
            ->scopes(['completed'])
            ->sum('amount');
    }

    public function recent(int $limit = 5): Collection
    {
        return $this->model->newQuery()
            ->scopes(['completed'])
            ->orderByDesc('donated_at')
            ->limit($limit)
            ->get();
    }
}
