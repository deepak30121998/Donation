<?php

namespace App\Contracts\Repositories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

interface PostRepositoryInterface extends BaseRepositoryInterface
{
    public function findBySlug(string $slug): ?Post;

    public function published(): Builder;

    public function byCategory(int $categoryId): Builder;

    public function recent(int $limit = 3): Collection;
}
