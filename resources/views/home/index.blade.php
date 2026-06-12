<x-layouts.app title="Home">

    {{-- Hero Section --}}
    @php
        $heroSection = $sections->get('home.hero');
        $heroImg = $heroSection?->getFirstMediaUrl('image');
        $heroVideoUrl = $heroSection?->button_url ?: 'https://www.youtube.com/watch?v=Y-x0efG1seA';
    @endphp
    <div class="hero parallaxie" @if($heroImg) style="background-image: url('{{ $heroImg }}')" @endif>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="hero-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{ $sections->get('home.hero')?->subtitle ?? 'welcome our charity' }}</h3>
                            <h1 class="text-anime-style-2" data-cursor="-opaque">{{ $sections->get('home.hero')?->title ?? 'Empower change, one act of kindness at a time' }}</h1>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">{!! $sections->get('home.hero')?->body ?? 'Join us in creating brighter futures by providing hope, delivering help, and fostering lasting change for communities in need around the world.' !!}</p>
                        </div>

                        <div class="hero-body wow fadeInUp" data-wow-delay="0.4s">
                            <div class="hero-btn">
                                <a href="{{ route('donation.index') }}" class="btn-default">donate now</a>
                            </div>
                            <div class="video-play-button">
                                <p>play video</p>
                                <a href="{{ $heroVideoUrl }}" class="popup-video" data-cursor-text="Play">
                                    <i class="fa-solid fa-play"></i>
                                </a>
                            </div>
                        </div>

                        @php $heroFeatures = $sections->get('home.hero_features'); @endphp
                        <div class="hero-footer wow fadeInUp" data-wow-delay="0.6s">
                            <div class="hero-list">
                                <ul>
                                    @if($heroFeatures?->body)
                                        @foreach(array_filter(explode("\n", strip_tags($heroFeatures->body))) as $item)
                                            <li>{{ trim($item) }}</li>
                                        @endforeach
                                    @else
                                        <li>Education and Skill Development</li>
                                        <li>Women and Youth Empowerment</li>
                                    @endif
                                </ul>
                            </div>
                            <div class="hero-help-families">
                                <h3>{{ $heroFeatures?->title ?? 'Help Families In Need' }}</h3>
                                <p>{{ $heroFeatures?->subtitle ?? 'Your gift of $235 can feed 40 children' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Hero Section End --}}

    {{-- About Us Section --}}
    @php
        $aboutSection  = $sections->get('home.about');
        $aboutFeature  = $sections->get('home.about_feature');
        $aboutImg1     = $aboutSection?->getFirstMediaUrl('image') ?: asset('images/about-img-1.jpg');
        $aboutImg2     = $aboutSection?->getFirstMediaUrl('image_2') ?: asset('images/about-img-2.jpg');
        $fundedCounter = $counters->firstWhere('key', 'funded_amount');
        $helpedCounter = $counters->firstWhere('key', 'helped_count');
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
                            <p>We've funded <span class="counter">{{ $fundedCounter?->value ?? 75 }}</span>{{ $fundedCounter?->suffix ?? 'k' }} Dollars</p>
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
                                    <h2><span class="counter">{{ number_format($helpedCounter?->value ?? 75958) }}</span>{{ $helpedCounter?->suffix ?? '' }}</h2>
                                    <h3>{{ $helpedCounter?->label ?? 'helped fund' }}</h3>
                                    <p>Supporting growth through community-funding.</p>
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
                @foreach ($services as $service)
                    <div class="col-lg-4 col-md-6">
                        <x-service-card :service="$service" />
                    </div>
                @endforeach

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
                            <p class="wow fadeInUp" data-wow-delay="0.2s">{{ $whyChoose?->subtitle ?? 'Our dedication, transparency, and community-driven approach set us apart.' }}</p>
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
                    <div class="our-features-list">
                        <div class="our-features-item">
                            <div class="our-features-image">
                                <figure class="image-anime reveal">
                                    <img src="{{ asset('images/our-features-img-1.jpg') }}" alt="">
                                </figure>
                            </div>
                            <div class="our-features-content">
                                <div class="our-features-body">
                                    <h2><span class="counter">96</span>%</h2>
                                    <h3>healthcare support</h3>
                                    <p>Provide essential healthcare services and resources to communities.</p>
                                </div>
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-our-features-1.svg') }}" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="our-features-item">
                            <div class="our-features-image">
                                <figure class="image-anime reveal">
                                    <img src="{{ asset('images/our-features-img-2.jpg') }}" alt="">
                                </figure>
                            </div>
                            <div class="our-features-content">
                                <div class="our-features-body">
                                    <h2><span class="counter">94</span>%</h2>
                                    <h3>education support</h3>
                                    <p>Provide essential healthcare services and resources to communities.</p>
                                </div>
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-our-features-2.svg') }}" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="our-features-item">
                            <div class="our-features-image">
                                <figure class="image-anime reveal">
                                    <img src="{{ asset('images/our-features-img-3.jpg') }}" alt="">
                                </figure>
                            </div>
                            <div class="our-features-content">
                                <div class="our-features-body">
                                    <h2><span class="counter">95</span>%</h2>
                                    <h3>food support</h3>
                                    <p>Provide essential healthcare services and resources to communities.</p>
                                </div>
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-our-features-3.svg') }}" alt="">
                                </div>
                            </div>
                        </div>
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
                    <div class="intro-video-box">
                        <div class="video-play-button">
                            <a href="{{ $sections->get('home.donate_cta')?->button_url ?: $heroVideoUrl }}" class="popup-video" data-cursor-text="Play">
                                <i class="fa-solid fa-play"></i>
                            </a>
                        </div>

                        <div class="donar-company-slider">
                            <div class="swiper">
                                <div class="swiper-wrapper" data-cursor-text="Drag">
                                    <div class="swiper-slide">
                                        <div class="donar-company-logo">
                                            <img src="{{ asset('images/donar-company-logo-1.png') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="donar-company-logo">
                                            <img src="{{ asset('images/donar-company-logo-2.png') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="donar-company-logo">
                                            <img src="{{ asset('images/donar-company-logo-3.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="donate-box">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{ $sections->get('home.donate_cta')?->subtitle ?? 'donate now' }}</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $sections->get('home.donate_cta')?->title ?? 'Donate us' }}</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">{!! $sections->get('home.donate_cta')?->body ?? 'Your generous support enables us to continue our mission of spreading love and serving our community.' !!}</p>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success mb-4">{{ session('success') }}</div>
                        @endif

                        <x-donation-form :causes="$causes" />
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
                                    <img src="{{ asset('images/how-it-work-img-1.jpg') }}" alt="">
                                </figure>
                            </div>
                            <div class="how-it-work-content wow fadeInUp" data-wow-delay="0.4s">
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-how-it-work-1.svg') }}" alt="">
                                </div>
                                <div class="how-it-work-body">
                                    <h3>healthcare support</h3>
                                    <p>Provide essential healthcare service and resources to communities.</p>
                                </div>
                            </div>
                        </div>

                        <div class="how-it-work-item">
                            <div class="how-it-work-image">
                                <figure class="image-anime reveal">
                                    <img src="{{ asset('images/how-it-work-img-2.jpg') }}" alt="">
                                </figure>
                            </div>
                            <div class="how-it-work-content wow fadeInUp" data-wow-delay="0.4s">
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-how-it-work-2.svg') }}" alt="">
                                </div>
                                <div class="how-it-work-body">
                                    <h3>Plan and design</h3>
                                    <p>Provide essential healthcare service and resources to communities.</p>
                                </div>
                            </div>
                        </div>

                        <div class="how-it-work-item">
                            <div class="how-it-work-image">
                                <figure class="image-anime reveal">
                                    <img src="{{ asset('images/how-it-work-img-3.jpg') }}" alt="">
                                </figure>
                            </div>
                            <div class="how-it-work-content wow fadeInUp" data-wow-delay="0.6s">
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-how-it-work-3.svg') }}" alt="">
                                </div>
                                <div class="how-it-work-body">
                                    <h3>Implement solutions</h3>
                                    <p>Provide essential healthcare service and resources to communities.</p>
                                </div>
                            </div>
                        </div>

                        <div class="how-it-work-item">
                            <div class="how-it-work-image">
                                <figure class="image-anime reveal">
                                    <img src="{{ asset('images/how-it-work-img-4.jpg') }}" alt="">
                                </figure>
                            </div>
                            <div class="how-it-work-content wow fadeInUp" data-wow-delay="0.6s">
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-how-it-work-4.svg') }}" alt="">
                                </div>
                                <div class="how-it-work-body">
                                    <h3>Report and share</h3>
                                    <p>Provide essential healthcare service and resources to communities.</p>
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
                            <p><span>$250</span> Help Our Kids with Education, Food, Health Support. <a href="{{ route('donation.index') }}">Donate now</a></p>
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
                        @php
                            $reviewCounter = $counters->firstWhere('key', 'customer_reviews')
                                ?? $counters->firstWhere('key', 'helped_count');
                        @endphp
                        <div class="client-review-box">
                            <h2><span class="counter">{{ $reviewCounter ? number_format($reviewCounter->value / 1000, 0) : '20' }}</span>k</h2>
                            <p>customer review</p>
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
                            <li><a href="#" class="active-btn" data-filter="*">all</a></li>
                            <li><a href="#" data-filter=".health">health</a></li>
                            <li><a href="#" data-filter=".education">education</a></li>
                            <li><a href="#" data-filter=".food">food</a></li>
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
