<x-layouts.app title="Home">

    {{-- Hero Slider Section --}}

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

                <div class="col-lg-12">
                    <div class="section-footer-text how-work-footer-text wow fadeInUp" data-wow-delay="0.8s">
                        @if($howItWorks?->button_text)
                            <p>{{ $howItWorks->button_text }}. <a href="{{ $howItWorks->button_url ?: route('donation.index') }}">Donate now</a></p>
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
                            <li><a href="#" class="active-btn" data-filter="*">All</a></li>
                            @foreach ($galleryCategories as $category)
                                <li><a href="#" data-filter=".{{ $category->slug }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="gallery-item-boxes">
                        @foreach ($galleryItems as $item)
                            <div class="gallery-item-box {{ $item->categoryClass }}">
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
