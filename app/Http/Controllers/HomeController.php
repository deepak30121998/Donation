<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\CauseRepositoryInterface;
use App\Contracts\Repositories\GalleryRepositoryInterface;
use App\Contracts\Repositories\PostRepositoryInterface;
use App\Contracts\Repositories\ProgramRepositoryInterface;
use App\Contracts\Repositories\ServiceRepositoryInterface;
use App\Contracts\Repositories\TestimonialRepositoryInterface;
use App\Models\SiteCounter;
use App\ViewModels\HomeViewModel;
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
        $vm = new HomeViewModel(
            services:     $this->services->activeOrdered(),
            programs:     $this->programs->activeOrdered()->take(3),
            causes:       $this->causes->activeOrdered()->take(3),
            posts:        collect($this->posts->recent(3)),
            testimonials: $this->testimonials->activeOrdered(),
            galleryItems: $this->gallery->activeOrdered(),
            counters:     SiteCounter::ordered()->get(),
        );

        return view('home.index', array_merge($vm->toArray(), [
            'featuredCause' => $vm->featuredCause(),
            'totalRaised'   => $vm->totalRaised(),
            'totalGoal'     => $vm->totalGoal(),
        ]));
    }
}
