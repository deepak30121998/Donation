<?php

namespace App\Repositories;

use App\Contracts\Repositories\GalleryRepositoryInterface;
use App\Models\GalleryItem;
use Illuminate\Support\Collection;

class EloquentGalleryRepository extends EloquentBaseRepository implements GalleryRepositoryInterface
{
    public function __construct(GalleryItem $model)
    {
        parent::__construct($model);
    }

    public function activeOrdered(): Collection
    {
        return $this->model->newQuery()->scopes(['active', 'ordered'])->get();
    }

    public function byCategory(string $category): Collection
    {
        return $this->model->newQuery()
            ->scopes(['active'])
            ->where('category', $category)
            ->orderBy('order')
            ->get();
    }
}
