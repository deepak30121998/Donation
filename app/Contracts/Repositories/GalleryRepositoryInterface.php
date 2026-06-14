<?php

namespace App\Contracts\Repositories;

use Illuminate\Support\Collection;

interface GalleryRepositoryInterface extends BaseRepositoryInterface
{
    public function activeOrdered(): Collection;

    public function byCategory(int $categoryId): Collection;
}
