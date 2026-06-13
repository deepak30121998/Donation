<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\FaqRepositoryInterface;
use App\Contracts\Repositories\ServiceRepositoryInterface;
use App\Contracts\Repositories\TestimonialRepositoryInterface;
use App\Models\FaqCategory;
use App\Models\PageSection;
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
        $counters    = SiteCounter::ordered()->get();
        $allSections = PageSection::whereIn('page', ['services', 'home'])
            ->where('is_active', true)
            ->get()
            ->keyBy(fn ($s) => $s->page . '.' . $s->section_key);

        return view('services.index', [
            'services'      => $this->serviceRepo->activeOrdered(),
            'testimonials'  => $this->testimonials->activeOrdered(),
            'faqCategories' => FaqCategory::with(['faqs' => fn ($q) => $q->where('is_active', true)->orderBy('order')])->orderBy('order')->get(),
            'counters'      => $counters,
            'testSection'   => $allSections->get('services.testimonials') ?? $allSections->get('home.testimonials'),
            'faqsSect'      => $allSections->get('services.faqs') ?? $allSections->get('about.faqs'),
            'reviewCtr'     => $counters->firstWhere('key', 'lives_transformed'),
        ]);
    }

    public function show(string $slug): View
    {
        $service = $this->serviceRepo->findBySlug($slug);
        abort_if(! $service, 404);

        $allServices = $this->serviceRepo->activeOrdered();
        $vm          = new ServiceViewModel(service: $service, allServices: $allServices);

        $faqCategories = \App\Models\FaqCategory::with([
            'faqs' => fn ($q) => $q->where('is_active', true)->orderBy('order'),
        ])->orderBy('order')->get();

        $showSections = PageSection::where('page', 'services')
            ->where('is_active', true)
            ->get()
            ->keyBy('section_key');

        $stepsSection = $showSections->get('steps');
        $steps = [
            [
                'no'    => '01',
                'icon'  => 'icon-service-entry-content-1.svg',
                'title' => $stepsSection?->title    ?? 'Community Outreach',
                'desc'  => 'We identify communities in need through field surveys, local volunteers, and partner organisations across Noida and UP.',
            ],
            [
                'no'    => '02',
                'icon'  => 'icon-service-entry-content-2.svg',
                'title' => $stepsSection?->subtitle ?? 'Program Delivery',
                'desc'  => 'Our trained team delivers services directly — at homes, schools, shelters, gaushalas, or community centres.',
            ],
            [
                'no'    => '03',
                'icon'  => 'icon-service-entry-content-3.svg',
                'title' => $stepsSection?->button_text ?? 'Follow-up & Impact',
                'desc'  => 'We track progress, gather community feedback, and continuously improve our programs for lasting change.',
            ],
        ];

        return view('services.show', array_merge($vm->toArray(), [
            'nextService'    => $vm->nextService(),
            'prevService'    => $vm->prevService(),
            'faqCategories'  => $faqCategories,
            'bannerUrl'      => $service->getFirstMediaUrl('banner') ?: $service->getFirstMediaUrl('thumb') ?: asset('images/placeholder.jpg'),
            'thumbUrl'       => $service->getFirstMediaUrl('thumb') ?: asset('images/placeholder.jpg'),
            'qualitySection' => $showSections->get('quality'),
            'steps'          => $steps,
            'stepsHeading'   => $showSections->get('steps_heading'),
            'commitmentBody' => $showSections->get('commitment')?->body,
        ]));
    }
}
