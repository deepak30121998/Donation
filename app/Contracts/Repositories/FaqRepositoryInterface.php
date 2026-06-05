<?php

namespace App\Contracts\Repositories;

use Illuminate\Support\Collection;

interface FaqRepositoryInterface extends BaseRepositoryInterface
{
    public function withCategories(): Collection;

    public function byCategory(int $categoryId): Collection;
}
