<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\CauseRepositoryInterface;
use App\Contracts\Repositories\GalleryRepositoryInterface;
use App\Contracts\Repositories\PostRepositoryInterface;
use App\Contracts\Repositories\ProgramRepositoryInterface;
use App\Contracts\Repositories\ServiceRepositoryInterface;
use App\Contracts\Repositories\TestimonialRepositoryInterface;
use App\Models\SiteCounter;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        protected ServiceRepositoryInterface     $services,
        protected ProgramRepositoryInterface     $programs,
        protected CauseRepositoryInterface       $causes,
        protected PostRepositoryInterface        $posts,
        protected TestimonialRepositoryInterface $testimonials,
        protected GalleryRepositoryInterface     $gallery,
    ) {}

    public function index(): View
    {
        return view('home.index', [
            'services'     => $this->services->activeOrdered()->take(3),
            'programs'     => $this->programs->activeOrdered()->take(3),
            'causes'       => $this->causes->activeOrdered()->take(3),
            'posts'        => $this->posts->recent(3),
            'testimonials' => $this->testimonials->activeOrdered(),
            'galleryItems' => $this->gallery->activeOrdered(),
            'counters'     => SiteCounter::ordered()->get(),
        ]);
    }
}
