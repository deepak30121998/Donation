<?php

namespace App\Repositories;

use App\Contracts\Repositories\TeamMemberRepositoryInterface;
use App\Models\TeamMember;
use Illuminate\Support\Collection;

class EloquentTeamMemberRepository extends EloquentBaseRepository implements TeamMemberRepositoryInterface
{
    public function __construct(TeamMember $model)
    {
        parent::__construct($model);
    }

    public function activeOrdered(): Collection
    {
        return $this->model->newQuery()->scopes(['active', 'ordered'])->get();
    }
}
