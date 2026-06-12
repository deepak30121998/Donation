<x-layouts.app title="Home">

    {{-- Hero Slider Section --}}
    @php
        $heroSection  = $sections->get('home.hero');
        $heroFeatures = $sections->get('home.hero_features');
        $heroVideoUrl = $siteSettings?->hero_video_url ?: 'https://www.youtube.com/watch?v=Y-x0efG1seA';

        $heroSlides = [
            [
                'image'    => $heroSection?->getFirstMediaUrl('image') ?: asset('images/hero-bg.jpg'),
                'subtitle' => $heroSection?->subtitle ?? 'Welcome to Ujjawal Unnati Foundation',
                'title'    => $heroSection?->title   ?? 'Every life is important — <span>we care</span> for you',
                'body'     => $heroSection?->body     ?? 'Join us in empowering communities across India through women empowerment, cow protection, child welfare, education, and hunger-free drives.',
            ],
            [
                'image'    => asset('images/uuf-hero-2.jpg'),
                'subtitle' => 'Hunger-Free India',
                'title'    => 'No child should sleep <span>hungry</span> tonight',
                'body'     => 'We run regular ration distribution drives, cooked meal camps, and food distribution events across Noida, Ghaziabad, and UP to ensure no family goes without food.',
            ],
            [
                'image'    => asset('images/hero-bg-2.jpg'),
                'subtitle' => 'Education for Everyone',
                'title'    => 'Every child deserves a <span>bright future</span>',
                'body'     => 'Our free coaching centres, notebook distribution drives, and school enrollment campaigns are bringing quality education to underprivileged children across 50+ villages.',
            ],
        ];
    @endphp

    <div class="hero hero-slider-layout">
        <div class="swiper">
            <div class="swiper-wrapper">

                @foreach ($heroSlides as $slide)
                <div class="swiper-slide">
                    <div class="hero-slide">

                        {{-- Background Image --}}
                        <div class="hero-slider-image">
                            <img src="{{ $slide['image'] }}" alt="{{ strip_tags($slide['title']) }}">
                        </div>

                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-8">
                                    <div class="hero-content">
                                        <div class="section-title">
                                            <h3 class="wow fadeInUp">{{ $slide['subtitle'] }}</h3>
                                            <h1 class="text-anime-style-2" data-cursor="-opaque">{!! $slide['title'] !!}</h1>
                                            <p class="wow fadeInUp" data-wow-delay="0.2s">{!! $slide['body'] !!}</p>
                                        </div>

                                        <div class="hero-body wow fadeInUp" data-wow-delay="0.4s">
                                            <div class="hero-btn">
                                                <a href="{{ route('donation.index') }}" class="btn-default">
                                                    {{ $siteSettings?->donate_button_text ?? 'Donate Now' }}
                                                </a>
                                            </div>
                                            <div class="video-play-button">
                                                <p>play video</p>
                                                <a href="{{ $heroVideoUrl }}" class="popup-video" data-cursor-text="Play">
                                                    <i class="fa-solid fa-play"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="hero-footer wow fadeInUp" data-wow-delay="0.6s">
                                            <div class="hero-list">
                                                <ul>
                                                    @if($heroFeatures?->body)
                                                        @foreach(array_filter(array_map('trim', explode("\n", strip_tags($heroFeatures->body)))) as $item)
                                                            <li>{{ $item }}</li>
                                                        @endforeach
                                                    @else
                                                        <li>Women &amp; Child Empowerment</li>
                                                        <li>Gau Sewa &amp; Education</li>
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="hero-help-families">
                                                <h3>{{ $heroFeatures?->title ?? 'Help Families In Need' }}</h3>
                                                <p>{{ $heroFeatures?->subtitle ?? 'Your support can feed 40 children' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach

            </div>
            <div class="hero-pagination"></div>
        </div>
    </div>
    {{-- Hero Slider Section End --}}

    {{-- About Us Section --}}
    @php
        $aboutSection  = $sections->get('home.about');
        $aboutFeature  = $sections->get('home.about_feature');
        $aboutImg1     = $aboutSection?->getFirstMediaUrl('image') ?: asset('images/about-img-1.jpg');
        $aboutImg2     = $aboutSection?->getFirstMediaUrl('image_2') ?: asset('images/about-img-2.jpg');
        $cowsCounter  = $counters->firstWhere('key', 'cows_served');
        $womenCounter = $counters->firstWhere('key', 'women_entrepreneurs');
    @endphp
    <div class="about-us">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-us-images">
                        <div class="about-img-1">
                            <figure class="image-anime">
                                <img src="{{ $aboutImg1 }}" alt="About Us">
                            </figure>
                        </div>
                        <div class="about-img-2">
                            <figure class="image-anime">
                                <img src="{{ $aboutImg2 }}" alt="About Us">
                            </figure>
                        </div>
                        <div class="need-fund-box">
                            <img src="{{ asset('images/icon-funded-dollar.svg') }}" alt="">
                            <p>We've served <span class="counter">{{ $cowsCounter?->value ?? 22500 }}</span>{{ $cowsCounter?->suffix ?? '+' }} Cows</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="about-us-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{ $sections->get('home.about')?->subtitle ?? 'about us' }}</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $sections->get('home.about')?->title ?? 'United in compassion, changing lives' }}</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">{!! $sections->get('home.about')?->body ?? 'Driven by compassion and a shared vision, we work hand-in-hand with communities to create meaningful change.' !!}</p>
                        </div>

                        <div class="about-us-body">
                            <div class="about-us-body-content">
                                <div class="about-support-box wow fadeInUp" data-wow-delay="0.4s">
                                    <div class="icon-box">
                                        <img src="{{ asset('images/icon-about-support.svg') }}" alt="">
                                    </div>
                                    <div class="about-support-content">
                                        <h3>{{ $aboutFeature?->title ?? 'Healthcare Support' }}</h3>
                                        <p>{{ $aboutFeature?->subtitle ?? 'Providing essential healthcare services and resources to communities.' }}</p>
                                    </div>
                                </div>
                                <div class="about-btn wow fadeInUp" data-wow-delay="0.6s">
                                    <a href="{{ $aboutSection?->button_url ?? route('about') }}" class="btn-default">
                                        {{ $aboutSection?->button_text ?? 'about us' }}
                                    </a>
                                </div>
                            </div>

                            <div class="helped-fund-item">
                                <div class="helped-fund-img">
                                    <figure class="image-anime">
                                        <img src="{{ asset('images/helped-fund-img.jpg') }}" alt="">
                                    </figure>
                                </div>
                                <div class="helped-fund-content">
                                    <h2><span class="counter">{{ number_format($womenCounter?->value ?? 115000) }}</span>{{ $womenCounter?->suffix ?? '+' }}</h2>
                                    <h3>{{ $womenCounter?->label ?? 'Women Entrepreneurs' }}</h3>
                                    <p>Empowered through skill training &amp; microfinance.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- About Us Section End --}}

    {{-- Our Services Section --}}
    <div class="our-services">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">{{ $sections->get('home.services')?->subtitle ?? 'services' }}</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $sections->get('home.services')?->title ?? 'Our comprehensive services' }}</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">{!! $sections->get('home.services')?->body ?? 'Our services are focused on creating lasting change through community development, healthcare access, educational support, and emergency relief.' !!}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="service-slider">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                @foreach ($services as $service)
                                    <div class="swiper-slide">
                                        <x-service-card :service="$service" />
                                    </div>
                                @endforeach
                            </div>
                            <div class="service-slider-pagination"></div>
                            <div class="service-button-prev"></div>
                            <div class="service-button-next"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="section-footer-text wow fadeInUp" data-wow-delay="0.6s">
                        <p>You will be satisfied with our work. <a href="{{ route('contact.index') }}">Contact us today</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Our Services Section End --}}

    {{-- What We Do Section --}}
    @php
        $whatWeDo   = $sections->get('home.what_we_do');
        $whatWeDo1  = $sections->get('home.what_we_do_1');
        $whatWeDo2  = $sections->get('home.what_we_do_2');
        $whatWeDo3  = $sections->get('home.what_we_do_3');
        $whatWeDoImgs = [
            $whatWeDo?->getFirstMediaUrl('image') ?: asset('images/what-we-do-image-1.jpg'),
            $whatWeDo?->getFirstMediaUrl('image_2') ?: asset('images/what-we-do-image-2.jpg'),
        ];
    @endphp
    <div class="what-we-do">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="what-we-do-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{ $whatWeDo?->subtitle ?? 'what we do' }}</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $whatWeDo?->title ?? 'Building hope creating lasting change' }}</h2>
                        </div>

                        <div class="what-we-list">
                            <div class="what-we-item wow fadeInUp" data-wow-delay="0.2s">
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-what-we-1.svg') }}" alt="">
                                </div>
                                <div class="what-we-item-content">
                                    <h3>{{ $whatWeDo1?->title ?? 'economic empowerment' }}</h3>
                                    <p>{{ $whatWeDo1?->subtitle ?? 'Empowering individuals through job training, financial literacy, and small business support.' }}</p>
                                </div>
                            </div>

                            <div class="what-we-item wow fadeInUp" data-wow-delay="0.4s">
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-what-we-2.svg') }}" alt="">
                                </div>
                                <div class="what-we-item-content">
                                    <h3>{{ $whatWeDo2?->title ?? 'clean water and sanitation' }}</h3>
                                    <p>{{ $whatWeDo2?->subtitle ?? 'Empowering individuals through job training, financial literacy, and small business support.' }}</p>
                                </div>
                            </div>

                            <div class="what-we-item wow fadeInUp" data-wow-delay="0.6s">
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-what-we-3.svg') }}" alt="">
                                </div>
                                <div class="what-we-item-content">
                                    <h3>{{ $whatWeDo3?->title ?? 'community development' }}</h3>
                                    <p>{{ $whatWeDo3?->subtitle ?? 'Empowering individuals through job training, financial literacy, and small business support.' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="what-we-do-images">
                        <div class="what-we-do-img-1">
                            <figure class="image-anime reveal">
                                <img src="{{ $whatWeDoImgs[0] }}" alt="">
                            </figure>
                        </div>
                        <div class="what-we-do-img-2">
                            <figure class="image-anime">
                                <img src="{{ $whatWeDoImgs[1] }}" alt="">
                            </figure>
                        </div>
                        <div class="donate-now-box">
                            <a href="{{ route('donation.index') }}"><img src="{{ asset('images/icon-donate-now.svg') }}" alt="">donate now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- What We Do Section End --}}

    {{-- Our Causes Section --}}
    <div class="our-causes">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">{{ $sections->get('home.causes')?->subtitle ?? 'our causes' }}</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $sections->get('home.causes')?->title ?? 'Supporting communities causes' }}</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">{!! $sections->get('home.causes')?->body ?? 'We focus on impactful causes that address urgent community needs, from healthcare and education to food security and for lasting change.' !!}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($causes as $cause)
                    <div class="col-lg-4 col-md-6">
                        <x-cause-card :cause="$cause" />
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- Our Causes Section End --}}

    {{-- Why Choose Us Section --}}
    @php
        $whyChoose     = $sections->get('home.why_choose_us');
        $whyChooseImg1 = $whyChoose?->getFirstMediaUrl('image') ?: asset('images/why-choose-img-1.jpg');
        $whyChooseImg2 = $whyChoose?->getFirstMediaUrl('image_2') ?: asset('images/why-choose-img-2.jpg');
        $whyChooseItems = $whyChoose?->body
            ? array_values(array_filter(array_map('trim', explode("\n", strip_tags($whyChoose->body)))))
            : ['community-centered approach', 'transparency and accountability', 'empowerment through partnership', 'volunteer and donor engagement'];
    @endphp
    <div class="why-choose-us">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="why-choose-images">
                        <div class="why-choose-image-1">
                            <figure class="image-anime">
                                <img src="{{ $whyChooseImg1 }}" alt="">
                            </figure>
                        </div>
                        <div class="why-choose-image-2">
                            <figure class="image-anime">
                                <img src="{{ $whyChooseImg2 }}" alt="">
                            </figure>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="why-choose-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{ $whyChoose?->subtitle ?? 'why choose us' }}</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $whyChoose?->title ?? 'Why we stand out together' }}</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">{{ $whyChoose?->button_text ?? 'Our dedication, transparency, and community-driven approach set us apart.' }}</p>
                        </div>

                        <div class="why-choose-list wow fadeInUp" data-wow-delay="0.4s">
                            <ul>
                                @foreach($whyChooseItems as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="why-choose-counters">
                            @foreach ($counters as $counter)
                                <div class="why-choose-counter-item">
                                    <h2>
                                        {{ $counter->prefix }}<span class="counter">{{ $counter->value }}</span>{{ $counter->suffix }}
                                    </h2>
                                    <p>{{ $counter->label }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Why Choose Us Section End --}}

    {{-- Our Programs Section --}}
    <div class="our-program">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">{{ $sections->get('home.programs')?->subtitle ?? 'our program' }}</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $sections->get('home.programs')?->title ?? 'Empowering our programs' }}</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">{!! $sections->get('home.programs')?->body ?? 'Our programs are designed to create sustainable change by addressing community needs, empowering individuals, and promoting long-term development through education.' !!}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($programs as $program)
                    <div class="col-lg-4 col-md-6">
                        <x-program-card :program="$program" />
                    </div>
                @endforeach

                @php $programsFooter = $sections->get('home.programs_footer'); @endphp
                <div class="col-lg-12">
                    <div class="section-footer-text wow fadeInUp" data-wow-delay="0.6s">
                        @if($programsFooter?->body)
                            <p>{!! $programsFooter->body !!}</p>
                        @else
                            <p>Your monthly <a href="{{ route('donation.index') }}">gift of $36</a> ensures that kids living in poverty have access to life-changing benefits</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Our Programs Section End --}}

    {{-- Scrolling Ticker --}}
    @php
        $tickerSection = $sections->get('home.ticker');
        $tickerItems = $tickerSection?->body
            ? array_values(array_filter(array_map('trim', explode("\n", strip_tags($tickerSection->body)))))
            : ['Health Support', 'Education Support', 'Food Support'];
        // Duplicate to fill the ticker (need at least 6 items for smooth scroll)
        while (count($tickerItems) < 6) { $tickerItems = array_merge($tickerItems, $tickerItems); }
    @endphp
    <div class="scrolling-ticker">
        <div class="scrolling-ticker-box">
            <div class="scrolling-content">
                @foreach($tickerItems as $item)
                    <span><img src="{{ asset('images/icon-asterisk.svg') }}" alt="">{{ $item }}</span>
                @endforeach
            </div>
            <div class="scrolling-content" aria-hidden="true">
                @foreach($tickerItems as $item)
                    <span><img src="{{ asset('images/icon-asterisk.svg') }}" alt="">{{ $item }}</span>
                @endforeach
            </div>
        </div>
    </div>
    {{-- Scrolling Ticker End --}}

    {{-- Our Features Section --}}
    <div class="our-features">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">our feature</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Highlights our impactful work</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">Discover the positive change we've created through our programs, partnerships, and dedicated efforts.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    @php
                        $womenCtr      = $counters->firstWhere('key', 'women_entrepreneurs');
                        $cowsCtr       = $counters->firstWhere('key', 'cows_served');
                        $livesCtr      = $counters->firstWhere('key', 'lives_transformed');
                        $featItems = [
                            [
                                'img'   => asset('images/our-features-img-1.jpg'),
                                'icon'  => asset('images/icon-our-features-1.svg'),
                                'value' => $womenCtr?->value ?? 115000,
                                'suffix'=> $womenCtr?->suffix ?? '+',
                                'label' => 'Women Entrepreneurs',
                                'desc'  => 'Trained through skill development, self-help groups, and microfinance support across UP & Delhi NCR.',
                            ],
                            [
                                'img'   => asset('images/our-features-img-2.jpg'),
                                'icon'  => asset('images/icon-our-features-2.svg'),
                                'value' => $cowsCtr?->value ?? 22500,
                                'suffix'=> $cowsCtr?->suffix ?? '+',
                                'label' => 'Mother Cows Served',
                                'desc'  => 'Cared for through our Gaushala, daily fodder drives, and free veterinary medical camps.',
                            ],
                            [
                                'img'   => asset('images/our-features-img-3.jpg'),
                                'icon'  => asset('images/icon-our-features-3.svg'),
                                'value' => $livesCtr?->value ?? 12000,
                                'suffix'=> $livesCtr?->suffix ?? '+',
                                'label' => 'Lives Transformed',
                                'desc'  => 'Through ration distribution, cooked meal camps, education drives, and child rehabilitation programs.',
                            ],
                        ];
                    @endphp
                    <div class="our-features-list">
                        @foreach ($featItems as $feat)
                        <div class="our-features-item">
                            <div class="our-features-image">
                                <figure class="image-anime reveal">
                                    <img src="{{ $feat['img'] }}" alt="{{ $feat['label'] }}">
                                </figure>
                            </div>
                            <div class="our-features-content">
                                <div class="our-features-body">
                                    <h2><span class="counter">{{ number_format($feat['value']) }}</span>{{ $feat['suffix'] }}</h2>
                                    <h3>{{ $feat['label'] }}</h3>
                                    <p>{{ $feat['desc'] }}</p>
                                </div>
                                <div class="icon-box">
                                    <img src="{{ $feat['icon'] }}" alt="">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Our Features Section End --}}

    {{-- Donate Now Section --}}
    <div class="donate-now parallaxie">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="donate-image-collage wow fadeInLeft">
                        <div class="donate-collage-inner">
                            <figure class="donate-collage-img-1 image-anime">
                                <img src="{{ asset('images/uuf-donate-bg.jpg') }}" alt="Children receiving food from UUF">
                            </figure>
                            <figure class="donate-collage-img-2 image-anime">
                                <img src="{{ asset('images/uuf-c10.jpg') }}" alt="UUF clothes distribution">
                            </figure>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="donate-box">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{ $sections->get('home.donate_cta')?->subtitle ?? 'donate now' }}</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $sections->get('home.donate_cta')?->title ?? 'Your Donation Changes Lives' }}</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">{!! $sections->get('home.donate_cta')?->body ?? 'Your generous support enables us to continue our mission of empowering communities, protecting cows, and ensuring no family goes hungry.' !!}</p>
                        </div>
                        <div class="wow fadeInUp" data-wow-delay="0.4s">
                            <a href="{{ route('donation.index') }}" class="btn-default">
                                {{ $siteSettings?->donate_button_text ?? 'Donate Now' }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Donate Now Section End --}}

    {{-- How It Works Section --}}
    @php $howItWorks = $sections->get('home.how_it_works'); @endphp
    <div class="how-it-work">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">{{ $howItWorks?->subtitle ?? 'How it work' }}</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $howItWorks?->title ?? 'Step by step working process' }}</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">{!! $howItWorks?->body ?? 'Our step-by-step process ensures meaningful change: identifying community needs, designing tailored programs, implementing sustainable solutions.' !!}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="how-it-work-list">
                        <div class="how-it-work-item">
                            <div class="how-it-work-image">
                                <figure class="image-anime reveal">
                                    <img src="{{ asset('images/how-it-work-img-1.jpg') }}" alt="UUF community outreach">
                                </figure>
                            </div>
                            <div class="how-it-work-content wow fadeInUp" data-wow-delay="0.2s">
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-how-it-work-1.svg') }}" alt="">
                                </div>
                                <div class="how-it-work-body">
                                    <h3>Identify Community Needs</h3>
                                    <p>We visit villages, urban slums, and schools across Noida and UP to understand the real challenges faced by women, children, and animals.</p>
                                </div>
                            </div>
                        </div>

                        <div class="how-it-work-item">
                            <div class="how-it-work-image">
                                <figure class="image-anime reveal">
                                    <img src="{{ asset('images/how-it-work-img-2.jpg') }}" alt="UUF women empowerment program">
                                </figure>
                            </div>
                            <div class="how-it-work-content wow fadeInUp" data-wow-delay="0.4s">
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-how-it-work-2.svg') }}" alt="">
                                </div>
                                <div class="how-it-work-body">
                                    <h3>Design Targeted Programs</h3>
                                    <p>We create tailored initiatives — Gau Sewa shelters, ration drives, skill training for women, and free education centres for underprivileged children.</p>
                                </div>
                            </div>
                        </div>

                        <div class="how-it-work-item">
                            <div class="how-it-work-image">
                                <figure class="image-anime reveal">
                                    <img src="{{ asset('images/how-it-work-img-3.jpg') }}" alt="UUF education delivery">
                                </figure>
                            </div>
                            <div class="how-it-work-content wow fadeInUp" data-wow-delay="0.6s">
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-how-it-work-3.svg') }}" alt="">
                                </div>
                                <div class="how-it-work-body">
                                    <h3>Deliver Direct Support</h3>
                                    <p>Our trained volunteers deliver food, clothing, education, legal aid, and cow care directly to families and communities who need it most.</p>
                                </div>
                            </div>
                        </div>

                        <div class="how-it-work-item">
                            <div class="how-it-work-image">
                                <figure class="image-anime reveal">
                                    <img src="{{ asset('images/how-it-work-img-4.jpg') }}" alt="UUF Gau Sewa impact">
                                </figure>
                            </div>
                            <div class="how-it-work-content wow fadeInUp" data-wow-delay="0.8s">
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-how-it-work-4.svg') }}" alt="">
                                </div>
                                <div class="how-it-work-body">
                                    <h3>Measure & Share Impact</h3>
                                    <p>We track every life changed — 22,500+ cows served, 1,15,000+ women trained, 12,000+ lives transformed — and share transparent reports with our supporters.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @php $howItWorksFooter = $sections->get('home.how_it_works'); @endphp
                <div class="col-lg-12">
                    <div class="section-footer-text how-work-footer-text wow fadeInUp" data-wow-delay="0.8s">
                        @if($howItWorksFooter?->button_text)
                            <p>{{ $howItWorksFooter->button_text }}. <a href="{{ $howItWorksFooter->button_url ?: route('donation.index') }}">Donate now</a></p>
                        @else
                            <p>Your donation helps us reach more families, rescue more cows, and educate more children across Noida and UP. <a href="{{ route('donation.index') }}">Donate now</a></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- How It Works Section End --}}

    {{-- Testimonials Section --}}
    <div class="our-testimonials">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="testimonials-image">
                        <div class="testimonials-img">
                            <figure class="image-anime reveal">
                                <img src="{{ asset('images/testimonials-image.jpg') }}" alt="">
                            </figure>
                        </div>
                        <div class="helthcare-support-circle">
                            <a href="{{ route('contact.index') }}">
                                <img src="{{ asset('images/healthcare-support-circle.svg') }}" alt="">
                            </a>
                        </div>
                        @php $livesCounter = $counters->firstWhere('key', 'lives_transformed'); @endphp
                        <div class="client-review-box">
                            <h2><span class="counter">{{ $livesCounter ? number_format($livesCounter->value / 1000, 0) : '12' }}</span>k+</h2>
                            <p>lives transformed</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="testimonials-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{ $sections->get('home.testimonials')?->subtitle ?? 'testimonials' }}</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $sections->get('home.testimonials')?->title ?? 'What people say about us' }}</h2>
                        </div>

                        <div class="testimonial-slider">
                            <div class="swiper">
                                <div class="swiper-wrapper" data-cursor-text="Drag">
                                    @foreach ($testimonials as $testimonial)
                                        <div class="swiper-slide">
                                            <x-testimonial-card :testimonial="$testimonial" />
                                        </div>
                                    @endforeach
                                </div>
                                <div class="testimonial-pagination"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Testimonials Section End --}}

    {{-- Gallery Section --}}
    <div class="our-gallery">
        <div class="container-fluid">
            <div class="row section-row no-gutters">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">{{ $sections->get('home.gallery')?->subtitle ?? 'gallery' }}</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $sections->get('home.gallery')?->title ?? 'Our image gallery' }}</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="our-gallery-nav wow fadeInUp" data-wow-delay="0.2s">
                        <ul>
                            <li><a href="#" class="active-btn" data-filter="*">{{ \App\Enums\GalleryCategory::All->label() }}</a></li>
                            <li><a href="#" data-filter=".{{ \App\Enums\GalleryCategory::Health->value }}">{{ \App\Enums\GalleryCategory::Health->label() }}</a></li>
                            <li><a href="#" data-filter=".{{ \App\Enums\GalleryCategory::Education->value }}">{{ \App\Enums\GalleryCategory::Education->label() }}</a></li>
                            <li><a href="#" data-filter=".{{ \App\Enums\GalleryCategory::Food->value }}">{{ \App\Enums\GalleryCategory::Food->label() }}</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="gallery-item-boxes">
                        @foreach ($galleryItems as $item)
                            <div class="gallery-item-box {{ $item->category->value }}">
                                <figure class="image-anime">
                                    <img src="{{ $item->getFirstMediaUrl('gallery') ?: asset('images/placeholder.jpg') }}"
                                         alt="{{ $item->title ?? 'Gallery Image' }}">
                                </figure>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Gallery Section End --}}

    {{-- Blog Section --}}
    <div class="our-blog">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">{{ $sections->get('home.blog')?->subtitle ?? 'latest post' }}</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $sections->get('home.blog')?->title ?? 'Stories of impact and hope' }}</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">{!! $sections->get('home.blog')?->body ?? "Explore inspiring stories and updates about our initiatives, successes, and the lives we've touched." !!}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        <x-post-card :post="$post" />
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- Blog Section End --}}

</x-layouts.app>
