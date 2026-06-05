<?php

namespace App\Contracts\Repositories;

use App\Models\Program;
use Illuminate\Support\Collection;

interface ProgramRepositoryInterface extends BaseRepositoryInterface
{
    public function findBySlug(string $slug): ?Program;

    public function active(): Collection;

    public function activeOrdered(): Collection;
}
