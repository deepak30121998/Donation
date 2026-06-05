<?php

namespace App\Contracts\Repositories;

use Illuminate\Support\Collection;

interface CauseRepositoryInterface extends BaseRepositoryInterface
{
    public function active(): Collection;

    public function activeOrdered(): Collection;
}
