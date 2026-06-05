<?php

namespace App\Repositories;

use App\Contracts\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

abstract class EloquentBaseRepository implements BaseRepositoryInterface
{
    public function __construct(
        protected Model $model,
    ) {}

    public function findById(int $id): ?Model
    {
        return $this->model->newQuery()->find($id);
    }

    public function findAll(): Collection
    {
        return $this->model->newQuery()->get();
    }

    public function paginate(int $perPage = 12): LengthAwarePaginator
    {
        return $this->model->newQuery()->paginate($perPage);
    }

    public function create(array $data): Model
    {
        return $this->model->newQuery()->create($data);
    }

    public function update(int $id, array $data): Model
    {
        $record = $this->model->newQuery()->findOrFail($id);
        $record->update($data);

        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = $this->model->newQuery()->findOrFail($id);

        return (bool) $record->delete();
    }
}
