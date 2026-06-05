<?php

namespace App\Repositories;

use App\Contracts\Repositories\ProgramRepositoryInterface;
use App\Models\Program;
use Illuminate\Support\Collection;

class EloquentProgramRepository extends EloquentBaseRepository implements ProgramRepositoryInterface
{
    public function __construct(Program $model)
    {
        parent::__construct($model);
    }

    public function findBySlug(string $slug): ?Program
    {
        /** @var Program|null */
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
