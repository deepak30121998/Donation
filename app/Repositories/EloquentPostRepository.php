<?php

namespace App\Repositories;

use App\Contracts\Repositories\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class EloquentPostRepository extends EloquentBaseRepository implements PostRepositoryInterface
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    public function findBySlug(string $slug): ?Post
    {
        /** @var Post|null */
        return $this->model->newQuery()->where('slug', $slug)->first();
    }

    public function published(): Builder
    {
        return $this->model->newQuery()->scopes(['published']);
    }

    public function byCategory(int $categoryId): Builder
    {
        return $this->model->newQuery()->where('post_category_id', $categoryId);
    }

    public function recent(int $limit = 3): Collection
    {
        return $this->model->newQuery()
            ->scopes(['published'])
            ->orderByDesc('published_at')
            ->limit($limit)
            ->get();
    }
}
