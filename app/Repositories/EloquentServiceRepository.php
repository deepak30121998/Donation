<?php

namespace App\Repositories;

use App\Contracts\Repositories\ServiceRepositoryInterface;
use App\Models\Service;
use Illuminate\Support\Collection;

class EloquentServiceRepository extends EloquentBaseRepository implements ServiceRepositoryInterface
{
    public function __construct(Service $model)
    {
        parent::__construct($model);
    }

    public function findBySlug(string $slug): ?Service
    {
        /** @var Service|null */
        return $this->model->newQuery()->where('slug', $slug)->first();
    }

    public function active(): Collection
    {
        return $this->model->newQuery()->scopes(['active'])->get();
    }

    public function activeOrdered(): Collection
    {
        return $this->model->newQuery()->scopes(['active', 'ordered'])->get();
    }
}
