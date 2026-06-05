<?php

namespace App\Repositories;

use App\Contracts\Repositories\CauseRepositoryInterface;
use App\Models\Cause;
use Illuminate\Support\Collection;

class EloquentCauseRepository extends EloquentBaseRepository implements CauseRepositoryInterface
{
    public function __construct(Cause $model)
    {
        parent::__construct($model);
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
