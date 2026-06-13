<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\CauseRepositoryInterface;
use App\Contracts\Repositories\GalleryRepositoryInterface;
use App\Contracts\Repositories\PostRepositoryInterface;
use App\Contracts\Repositories\ProgramRepositoryInterface;
use App\Contracts\Repositories\ServiceRepositoryInterface;
use App\Contracts\Repositories\TestimonialRepositoryInterface;
use App\Models\PageSection;
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
        $counters = SiteCounter::ordered()->get();

        $homeSections = PageSection::where('page', 'home')
            ->where('is_active', true)
            ->with('media')
            ->get()
            ->keyBy('section_key');

        $heroSection  = $homeSections->get('hero');
        $heroFeatures = $homeSections->get('hero_features');
        $aboutSection = $homeSections->get('about');
        $aboutFeature = $homeSections->get('about_feature');
        $whatWeDo     = $homeSections->get('what_we_do');
        $whatWeDo1    = $homeSections->get('what_we_do_1');
        $whatWeDo2    = $homeSections->get('what_we_do_2');
        $whatWeDo3    = $homeSections->get('what_we_do_3');
        $whyChoose    = $homeSections->get('why_choose_us');
        $programsFooter = $homeSections->get('programs_footer');
        $tickerSection  = $homeSections->get('ticker');
        $howItWorks     = $homeSections->get('how_it_works');

        $heroSlides = $homeSections
            ->filter(fn ($s, $key) => preg_match('/^hero(_\d+)?$/', $key))
            ->sortBy(fn ($s) => $s->order ?? 0)
            ->map(fn ($s) => [
                'image'       => $s->getFirstMediaUrl('image') ?: asset('images/hero-bg.jpg'),
                'subtitle'    => $s->subtitle ?? 'Welcome to Ujjawal Unnati Foundation',
                'title'       => $s->title    ?? 'Every life is important — <span>we care</span> for you',
                'body'        => $s->body     ?? '',
                'button_text' => $s->button_text ?? 'Donate Now',
                'button_url'  => $s->button_url  ?? '/donation',
            ])
            ->values()
            ->toArray();

        $whyChooseItems = $whyChoose?->body
            ? array_values(array_filter(array_map('trim', explode("\n", strip_tags($whyChoose->body)))))
            : ['community-centered approach', 'transparency and accountability', 'empowerment through partnership', 'volunteer and donor engagement'];

        $tickerItems = $tickerSection?->body
            ? array_values(array_filter(array_map('trim', explode("\n", strip_tags($tickerSection->body)))))
            : ['Health Support', 'Education Support', 'Food Support'];
        while (count($tickerItems) < 6) {
            $tickerItems = array_merge($tickerItems, $tickerItems);
        }

        $womenCtr  = $counters->firstWhere('key', 'women_entrepreneurs');
        $cowsCtr   = $counters->firstWhere('key', 'cows_served');
        $livesCtr  = $counters->firstWhere('key', 'lives_transformed');

        $featItems = [
            [
                'img'    => asset('images/our-features-img-1.jpg'),
                'icon'   => asset('images/icon-our-features-1.svg'),
                'value'  => $womenCtr?->value ?? 115000,
                'suffix' => $womenCtr?->suffix ?? '+',
                'label'  => 'Women Entrepreneurs',
                'desc'   => 'Trained through skill development, self-help groups, and microfinance support across UP & Delhi NCR.',
            ],
            [
                'img'    => asset('images/our-features-img-2.jpg'),
                'icon'   => asset('images/icon-our-features-2.svg'),
                'value'  => $cowsCtr?->value ?? 22500,
                'suffix' => $cowsCtr?->suffix ?? '+',
                'label'  => 'Mother Cows Served',
                'desc'   => 'Cared for through our Gaushala, daily fodder drives, and free veterinary medical camps.',
            ],
            [
                'img'    => asset('images/our-features-img-3.jpg'),
                'icon'   => asset('images/icon-our-features-3.svg'),
                'value'  => $livesCtr?->value ?? 12000,
                'suffix' => $livesCtr?->suffix ?? '+',
                'label'  => 'Lives Transformed',
                'desc'   => 'Through ration distribution, cooked meal camps, education drives, and child rehabilitation programs.',
            ],
        ];

        $vm = new HomeViewModel(
            services:     $this->services->activeOrdered(),
            programs:     $this->programs->activeOrdered()->take(3),
            causes:       $this->causes->activeOrdered()->take(3),
            posts:        collect($this->posts->recent(3)),
            testimonials: $this->testimonials->activeOrdered(),
            galleryItems: $this->gallery->activeOrdered(),
            counters:     $counters,
        );

        return view('home.index', array_merge($vm->toArray(), [
            'featuredCause'  => $vm->featuredCause(),
            'totalRaised'    => $vm->totalRaised(),
            'totalGoal'      => $vm->totalGoal(),
            'heroSection'    => $heroSection,
            'heroFeatures'   => $heroFeatures,
            'heroVideoUrl'   => config('app.hero_video_url', 'https://www.youtube.com/watch?v=Y-x0efG1seA'),
            'heroSlides'     => $heroSlides,
            'aboutSection'   => $aboutSection,
            'aboutFeature'   => $aboutFeature,
            'aboutImg1'      => $aboutSection?->getFirstMediaUrl('image') ?: asset('images/about-img-1.jpg'),
            'aboutImg2'      => $aboutSection?->getFirstMediaUrl('image_2') ?: asset('images/about-img-2.jpg'),
            'cowsCounter'    => $cowsCtr,
            'womenCounter'   => $womenCtr,
            'whatWeDo'       => $whatWeDo,
            'whatWeDo1'      => $whatWeDo1,
            'whatWeDo2'      => $whatWeDo2,
            'whatWeDo3'      => $whatWeDo3,
            'whatWeDoImgs'   => [
                $whatWeDo?->getFirstMediaUrl('image') ?: asset('images/what-we-do-image-1.jpg'),
                $whatWeDo?->getFirstMediaUrl('image_2') ?: asset('images/what-we-do-image-2.jpg'),
            ],
            'whyChoose'      => $whyChoose,
            'whyChooseImg1'  => $whyChoose?->getFirstMediaUrl('image') ?: asset('images/why-choose-img-1.jpg'),
            'whyChooseImg2'  => $whyChoose?->getFirstMediaUrl('image_2') ?: asset('images/why-choose-img-2.jpg'),
            'whyChooseItems' => $whyChooseItems,
            'programsFooter' => $programsFooter,
            'tickerItems'    => $tickerItems,
            'howItWorks'     => $howItWorks,
            'featItems'      => $featItems,
            'livesCounter'   => $livesCtr,
        ]));
    }
}
