<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\FaqRepositoryInterface;
use App\Contracts\Repositories\ServiceRepositoryInterface;
use App\Contracts\Repositories\TeamMemberRepositoryInterface;
use App\Contracts\Repositories\TestimonialRepositoryInterface;
use App\Models\FaqCategory;
use App\Models\PageSection;
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
        $counters = SiteCounter::ordered()->get();

        $aboutSections = PageSection::whereIn('page', ['about', 'home'])
            ->where('is_active', true)
            ->with('media')
            ->get()
            ->keyBy(fn ($s) => $s->page . '.' . $s->section_key);

        $approach         = $aboutSections->get('about.approach');
        $aboutFacts       = $aboutSections->get('about.facts');
        $whyChoose        = $aboutSections->get('about.why_choose_us') ?? $aboutSections->get('home.why_choose_us');
        $howWeHelp        = $aboutSections->get('about.how_we_help');
        $teamSection      = $aboutSections->get('about.team');
        $testimSection    = $aboutSections->get('about.testimonials') ?? $aboutSections->get('home.testimonials');
        $faqsSection      = $aboutSections->get('about.faqs');
        $aboutFeature     = $aboutSections->get('about.feature') ?? $aboutSections->get('home.about_feature');

        $whyItems = $whyChoose?->body
            ? array_values(array_filter(array_map('trim', explode("\n", strip_tags($whyChoose->body)))))
            : ['community-centered approach', 'transparency and accountability', 'empowerment through partnership', 'volunteer and donor engagement'];

        $howHelpItems = $howWeHelp?->body
            ? array_values(array_filter(array_map('trim', explode("\n", strip_tags($howWeHelp->body)))))
            : ['Community Development Programs', 'Women and Youth Empowerment', 'Advocacy and Awareness Campaigns'];

        return view('about.index', [
            'testimonials'     => $this->testimonials->activeOrdered(),
            'teamMembers'      => $this->teamMembers->activeOrdered()->take(4),
            'faqCategories'    => FaqCategory::with(['faqs' => fn ($q) => $q->where('is_active', true)->orderBy('order')])->orderBy('order')->get(),
            'counters'         => $counters,
            'services'         => $this->services->activeOrdered()->take(4),
            'aboutFacts'       => $aboutFacts,
            'aboutImg1'        => $aboutFacts?->getFirstMediaUrl('image') ?: asset('images/about-img-1.jpg'),
            'aboutImg2'        => $aboutFacts?->getFirstMediaUrl('image_2') ?: asset('images/about-img-2.jpg'),
            'cowsCtr'          => $counters->firstWhere('key', 'cows_served'),
            'womenCtr'         => $counters->firstWhere('key', 'women_entrepreneurs'),
            'reviewCtr'        => $counters->firstWhere('key', 'lives_transformed'),
            'aboutFeature'     => $aboutFeature,
            'approach'         => $approach,
            'approachImg'      => $approach?->getFirstMediaUrl('image') ?: asset('images/our-approach-image.jpg'),
            'whyChoose'        => $whyChoose,
            'whyImg1'          => $whyChoose?->getFirstMediaUrl('image') ?: asset('images/why-choose-img-1.jpg'),
            'whyImg2'          => $whyChoose?->getFirstMediaUrl('image_2') ?: asset('images/why-choose-img-2.jpg'),
            'whyItems'         => $whyItems,
            'howWeHelp'        => $howWeHelp,
            'howHelpItems'     => $howHelpItems,
            'teamSection'      => $teamSection,
            'testimSection'    => $testimSection,
            'testimImg'        => $testimSection?->getFirstMediaUrl('image') ?: asset('images/testimonials-image.jpg'),
            'faqsSection'      => $faqsSection,
        ]);
    }
}
