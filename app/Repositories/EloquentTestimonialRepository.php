<?php

namespace App\Repositories;

use App\Contracts\Repositories\TestimonialRepositoryInterface;
use App\Models\Testimonial;
use Illuminate\Support\Collection;

class EloquentTestimonialRepository extends EloquentBaseRepository implements TestimonialRepositoryInterface
{
    public function __construct(Testimonial $model)
    {
        parent::__construct($model);
    }

    public function activeOrdered(): Collection
    {
        return $this->model->newQuery()->scopes(['active', 'ordered'])->get();
    }
}
