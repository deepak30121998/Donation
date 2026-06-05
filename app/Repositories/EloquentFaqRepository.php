<?php

namespace App\Repositories;

use App\Contracts\Repositories\FaqRepositoryInterface;
use App\Models\Faq;
use Illuminate\Support\Collection;

class EloquentFaqRepository extends EloquentBaseRepository implements FaqRepositoryInterface
{
    public function __construct(Faq $model)
    {
        parent::__construct($model);
    }

    public function withCategories(): Collection
    {
        return $this->model->newQuery()
            ->scopes(['active', 'ordered'])
            ->with('category')
            ->get();
    }

    public function byCategory(int $categoryId): Collection
    {
        return $this->model->newQuery()
            ->scopes(['active', 'ordered'])
            ->where('faq_category_id', $categoryId)
            ->get();
    }
}
