<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\FaqRepositoryInterface;
use App\Contracts\Repositories\ServiceRepositoryInterface;
use App\Contracts\Repositories\TestimonialRepositoryInterface;
use App\Models\FaqCategory;
use App\Models\SiteCounter;
use App\ViewModels\ServiceViewModel;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function __construct(
        protected ServiceRepositoryInterface     $serviceRepo,
        protected TestimonialRepositoryInterface $testimonials,
        protected FaqRepositoryInterface         $faqs,
    ) {}

    public function index(): View
    {
        return view('services.index', [
            'services'      => $this->serviceRepo->activeOrdered(),
            'testimonials'  => $this->testimonials->activeOrdered(),
            'faqCategories' => FaqCategory::with(['faqs' => fn ($q) => $q->where('is_active', true)->orderBy('order')])->orderBy('order')->get(),
            'counters'      => SiteCounter::ordered()->get(),
        ]);
    }

    public function show(string $slug): View
    {
        $service = $this->serviceRepo->findBySlug($slug);
        abort_if(! $service, 404);

        $allServices = $this->serviceRepo->activeOrdered();
        $vm          = new ServiceViewModel(service: $service, allServices: $allServices);

        return view('services.show', array_merge($vm->toArray(), [
            'nextService' => $vm->nextService(),
            'prevService' => $vm->prevService(),
        ]));
    }
}
