<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\FaqRepositoryInterface;
use App\Contracts\Repositories\ServiceRepositoryInterface;
use App\Contracts\Repositories\TeamMemberRepositoryInterface;
use App\Contracts\Repositories\TestimonialRepositoryInterface;
use App\Models\FaqCategory;
use App\Models\SiteCounter;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function __construct(
        protected TestimonialRepositoryInterface $testimonials,
        protected TeamMemberRepositoryInterface  $teamMembers,
        protected FaqRepositoryInterface         $faqs,
        protected ServiceRepositoryInterface     $services,
    ) {}

    public function index(): View
    {
        return view('about.index', [
            'testimonials'  => $this->testimonials->activeOrdered(),
            'teamMembers'   => $this->teamMembers->activeOrdered()->take(4),
            'faqCategories' => FaqCategory::with(['faqs' => fn ($q) => $q->where('is_active', true)->orderBy('order')])->orderBy('order')->get(),
            'counters'      => SiteCounter::ordered()->get(),
            'services'      => $this->services->activeOrdered()->take(4),
        ]);
    }
}
