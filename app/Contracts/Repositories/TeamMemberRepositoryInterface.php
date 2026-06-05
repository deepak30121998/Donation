<?php

namespace App\Contracts\Repositories;

use Illuminate\Support\Collection;

interface TeamMemberRepositoryInterface extends BaseRepositoryInterface
{
    public function activeOrdered(): Collection;
}
