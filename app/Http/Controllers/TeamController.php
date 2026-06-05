<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\TeamMemberRepositoryInterface;
use Illuminate\View\View;

class TeamController extends Controller
{
    public function __construct(
        protected TeamMemberRepositoryInterface $teamRepo,
    ) {}

    public function index(): View
    {
        return view('team.index', [
            'members' => $this->teamRepo->activeOrdered(),
        ]);
    }
}
