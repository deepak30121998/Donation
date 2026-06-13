<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\FaqRepositoryInterface;
use App\Contracts\Repositories\TestimonialRepositoryInterface;
use App\Models\FaqCategory;
use App\Models\PageSection;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function __construct(
        protected TestimonialRepositoryInterface $testimonials,
        protected FaqRepositoryInterface         $faqs,
    ) {}

    public function index(): View
    {
        $faqsSect = PageSection::whereIn('page', ['testimonials', 'about'])
            ->where('section_key', 'faqs')
            ->where('is_active', true)
            ->orderByRaw("FIELD(page, 'testimonials', 'about')")
            ->first();

        return view('testimonials.index', [
            'testimonials'  => $this->testimonials->activeOrdered(),
            'faqCategories' => FaqCategory::with(['faqs' => fn ($q) => $q->where('is_active', true)->orderBy('order')])->orderBy('order')->get(),
            'faqsSect'      => $faqsSect,
        ]);
    }
}
