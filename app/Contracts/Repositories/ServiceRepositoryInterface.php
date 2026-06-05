<?php

namespace App\Contracts\Repositories;

use App\Models\Service;
use Illuminate\Support\Collection;

interface ServiceRepositoryInterface extends BaseRepositoryInterface
{
    public function findBySlug(string $slug): ?Service;

    public function active(): Collection;

    public function activeOrdered(): Collection;
}
