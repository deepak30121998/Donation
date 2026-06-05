<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\ProgramRepositoryInterface;
use Illuminate\View\View;

class ProgramController extends Controller
{
    public function __construct(
        protected ProgramRepositoryInterface $programRepo,
    ) {}

    public function index(): View
    {
        return view('programs.index', [
            'programs' => $this->programRepo->activeOrdered(),
        ]);
    }

    public function show(string $slug): View
    {
        $program = $this->programRepo->findBySlug($slug);
        abort_if(! $program, 404);

        return view('programs.show', [
            'program'  => $program,
            'programs' => $this->programRepo->activeOrdered(),
        ]);
    }
}
