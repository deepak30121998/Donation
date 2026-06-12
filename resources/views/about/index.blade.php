<x-layouts.app title="{{ $sections->get('about.hero')?->title ?? 'About Us' }}">

    <x-page-header
        title="{{ $sections->get('about.hero')?->title ?? '<span>About</span> Us' }}"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'About Us', 'url' => ''],
        ]"
    />

    {{-- About Us Section --}}
    @php
        $aboutFacts   = $sections->get('about.facts');
        $aboutImg1    = $aboutFacts?->getFirstMediaUrl('image') ?: asset('images/about-img-1.jpg');
        $aboutImg2    = $aboutFacts?->getFirstMediaUrl('image_2') ?: asset('images/about-img-2.jpg');
        $fundedCtr    = $counters->firstWhere('key', 'funded_amount');
        $helpedCtr    = $counters->firstWhere('key', 'helped_count');
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
                            <p>We've funded <span class="counter">{{ $fundedCtr?->value ?? 75 }}</span>{{ $fundedCtr?->suffix ?? 'k' }} Dollars</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="about-us-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{ $aboutFacts?->subtitle ?? 'about us' }}</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $aboutFacts?->title ?? 'United in compassion, changing lives' }}</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">{!! $aboutFacts?->body ?? 'Driven by compassion and a shared vision, we work hand-in-hand with communities to create meaningful change.' !!}</p>
                        </div>

                        <div class="about-us-body">
                            <div class="about-us-body-content">
                                @php $aboutFeature = $sections->get('about.feature') ?? $sections->get('home.about_feature'); @endphp
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
                                    <a href="{{ $aboutFacts?->button_url ?? route('donation.index') }}" class="btn-default">
                                        {{ $aboutFacts?->button_text ?? 'donate now' }}
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
                                    <h2><span class="counter">{{ number_format($helpedCtr?->value ?? 75958) }}</span>{{ $helpedCtr?->suffix ?? '' }}</h2>
                                    <h3>{{ $helpedCtr?->label ?? 'helped fund' }}</h3>
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

    {{-- Our Approach Section --}}
    @php $approach = $sections->get('about.approach'); @endphp
    <div class="our-approach">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="our-approach-box-content">
                        <div class="our-approach-content">
                            <div class="section-title">
                                <h3 class="wow fadeInUp">{{ $approach?->subtitle ?? 'our approach' }}</h3>
                                <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $approach?->title ?? 'Compassionate solutions for lasting impact' }}</h2>
                                <p class="wow fadeInUp" data-wow-delay="0.2s">{!! $approach?->body ?? 'Our approach focuses on creating sustainable change by addressing root causes, empowering communities, and delivering compassionate solutions.' !!}</p>
                            </div>

                            <div class="our-approach-btn wow fadeInUp" data-wow-delay="0.4s">
                                <a href="{{ $approach?->button_url ?? route('contact.index') }}" class="btn-default">
                                    {{ $approach?->button_text ?? 'contact now' }}
                                </a>
                            </div>

                            <div class="mission-vision-box wow fadeInUp" data-wow-delay="0.6s">
                                <div class="mission-vision-item">
                                    <div class="icon-box">
                                        <img src="{{ asset('images/icon-our-mission.svg') }}" alt="">
                                    </div>
                                    <div class="mission-vision-content">
                                        <h3>{{ $sections->get('about.mission')?->title ?? 'our mission' }}</h3>
                                        <p>{!! $sections->get('about.mission')?->body ?? 'We strive to create positive change, empower communities, and build a better world.' !!}</p>
                                    </div>
                                </div>

                                <div class="mission-vision-item">
                                    <div class="icon-box">
                                        <img src="{{ asset('images/icon-our-vision.svg') }}" alt="">
                                    </div>
                                    <div class="mission-vision-content">
                                        <h3>{{ $sections->get('about.vision')?->title ?? 'our vision' }}</h3>
                                        <p>{!! $sections->get('about.vision')?->body ?? 'A world where every individual has access to equal opportunities and resources.' !!}</p>
                                    </div>
                                </div>

                                <div class="mission-vision-item">
                                    <div class="icon-box">
                                        <img src="{{ asset('images/icon-our-value.svg') }}" alt="">
                                    </div>
                                    <div class="mission-vision-content">
                                        <h3>{{ $sections->get('about.values')?->title ?? 'our value' }}</h3>
                                        <p>{!! $sections->get('about.values')?->body ?? 'Integrity, compassion, and accountability guide everything we do.' !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="our-approach-image">
                            @php $approachImg = $approach?->getFirstMediaUrl('image') ?: asset('images/our-approach-image.jpg'); @endphp
                            <figure class="image-anime">
                                <img src="{{ $approachImg }}" alt="Our Approach">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Our Approach Section End --}}

    {{-- Why Choose Us Section --}}
    @php
        $whyChoose    = $sections->get('about.why_choose_us') ?? $sections->get('home.why_choose_us');
        $whyImg1      = $whyChoose?->getFirstMediaUrl('image') ?: asset('images/why-choose-img-1.jpg');
        $whyImg2      = $whyChoose?->getFirstMediaUrl('image_2') ?: asset('images/why-choose-img-2.jpg');
        $whyItems     = $whyChoose?->body
            ? array_values(array_filter(array_map('trim', explode("\n", strip_tags($whyChoose->body)))))
            : ['community-centered approach', 'transparency and accountability', 'empowerment through partnership', 'volunteer and donor engagement'];
        $yearsCtr     = $counters->firstWhere('key', 'years_experience');
        $volunteerCtr = $counters->firstWhere('key', 'volunteers');
        $officesCtr   = $counters->firstWhere('key', 'offices');
    @endphp
    <div class="why-choose-us">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="why-choose-images">
                        <div class="why-choose-image-1">
                            <figure class="image-anime">
                                <img src="{{ $whyImg1 }}" alt="">
                            </figure>
                        </div>
                        <div class="why-choose-image-2">
                            <figure class="image-anime">
                                <img src="{{ $whyImg2 }}" alt="">
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
                                @foreach($whyItems as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="why-choose-counters">
                            @foreach ($counters->whereNotIn('key', ['funded_amount', 'helped_count']) as $counter)
                                <div class="why-choose-counter-item">
                                    <h2>{{ $counter->prefix ?? '' }}<span class="counter">{{ $counter->value }}</span>{{ $counter->suffix }}</h2>
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

    {{-- How We Help Section --}}
    @php
        $howWeHelp     = $sections->get('about.how_we_help');
        $howWeHelpImg  = $howWeHelp?->getFirstMediaUrl('image') ?: null;
        $howHelpItems  = $howWeHelp?->body
            ? array_values(array_filter(array_map('trim', explode("\n", strip_tags($howWeHelp->body)))))
            : ['Community Development Programs', 'Women and Youth Empowerment', 'Advocacy and Awareness Campaigns'];
    @endphp
    <div class="how-we-help">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="how-we-help-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{ $howWeHelp?->subtitle ?? 'how we help' }}</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $howWeHelp?->title ?? 'Bringing hope to every community' }}</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">{{ $howWeHelp?->subtitle ?? 'We work tirelessly to uplift communities by providing resources, support, and sustainable solutions.' }}</p>
                        </div>

                        <div class="how-we-help-body wow fadeInUp" data-wow-delay="0.4s">
                            <ul>
                                @foreach($howHelpItems as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="how-we-help-btn wow fadeInUp" data-wow-delay="0.6s">
                            <a href="{{ $howWeHelp?->button_url ?? route('contact.index') }}" class="btn-default">
                                {{ $howWeHelp?->button_text ?? 'contact now' }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="how-help-list">
                        @php $howHelpServices = $services ?? collect(); @endphp
                        @if($howHelpServices->isNotEmpty())
                            @foreach($howHelpServices->take(4) as $i => $service)
                                <div class="how-help-item wow fadeInUp" @if($i > 0) data-wow-delay="{{ $i * 0.2 }}s" @endif>
                                    <div class="icon-box">
                                        @php $iconNum = ($i % 4) + 1; @endphp
                                        <img src="{{ asset('images/icon-how-help-' . $iconNum . '.svg') }}" alt="">
                                    </div>
                                    <div class="how-help-item-content">
                                        <h3>{{ $service->title }}</h3>
                                        <p>{{ $service->short_description ?? 'Supporting communities with essential resources.' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="how-help-item wow fadeInUp">
                                <div class="icon-box"><img src="{{ asset('images/icon-how-help-1.svg') }}" alt=""></div>
                                <div class="how-help-item-content">
                                    <h3>healthcare access</h3>
                                    <p>Providing medical care, health education, and wellness resources.</p>
                                </div>
                            </div>
                            <div class="how-help-item wow fadeInUp" data-wow-delay="0.2s">
                                <div class="icon-box"><img src="{{ asset('images/icon-how-help-2.svg') }}" alt=""></div>
                                <div class="how-help-item-content">
                                    <h3>hunger relief</h3>
                                    <p>Providing medical care, health education, and wellness resources.</p>
                                </div>
                            </div>
                            <div class="how-help-item wow fadeInUp" data-wow-delay="0.4s">
                                <div class="icon-box"><img src="{{ asset('images/icon-how-help-3.svg') }}" alt=""></div>
                                <div class="how-help-item-content">
                                    <h3>educational support</h3>
                                    <p>Providing medical care, health education, and wellness resources.</p>
                                </div>
                            </div>
                            <div class="how-help-item wow fadeInUp" data-wow-delay="0.6s">
                                <div class="icon-box"><img src="{{ asset('images/icon-how-help-4.svg') }}" alt=""></div>
                                <div class="how-help-item-content">
                                    <h3>awareness campaigns</h3>
                                    <p>Providing medical care, health education, and wellness resources.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- How We Help Section End --}}

    {{-- Our Team Section --}}
    @php $teamSection = $sections->get('about.team'); @endphp
    @if ($teamMembers->isNotEmpty())
    <div class="our-team">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">{{ $teamSection?->subtitle ?? 'our team' }}</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $teamSection?->title ?? 'Meet our dedicated team' }}</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">{!! $teamSection?->body ?? 'Our team of passionate individuals works every day to make a difference in the lives of those who need it most.' !!}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($teamMembers as $member)
                    <div class="col-lg-3 col-md-6">
                        <x-team-card :member="$member" />
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    {{-- Our Team Section End --}}

    {{-- Testimonials Section --}}
    @php
        $testimonialsSection = $sections->get('about.testimonials') ?? $sections->get('home.testimonials');
        $reviewCtr = $counters->firstWhere('key', 'customer_reviews') ?? $counters->firstWhere('key', 'helped_count');
    @endphp
    @if ($testimonials->isNotEmpty())
    <div class="our-testimonials">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="testimonials-image">
                        <div class="testimonials-img">
                            <figure class="image-anime reveal">
                                @php $testimImg = $testimonialsSection?->getFirstMediaUrl('image') ?: asset('images/testimonials-image.jpg'); @endphp
                                <img src="{{ $testimImg }}" alt="">
                            </figure>
                        </div>
                        <div class="helthcare-support-circle">
                            <a href="{{ route('contact.index') }}">
                                <img src="{{ asset('images/healthcare-support-circle.svg') }}" alt="">
                            </a>
                        </div>
                        <div class="client-review-box">
                            <h2><span class="counter">{{ $reviewCtr ? number_format($reviewCtr->value / 1000, 0) : '20' }}</span>k</h2>
                            <p>customer review</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="testimonials-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{ $testimonialsSection?->subtitle ?? 'testimonials' }}</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $testimonialsSection?->title ?? 'What people say about us' }}</h2>
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
    @endif
    {{-- Testimonials Section End --}}

    {{-- FAQs Section --}}
    @php $faqsSection = $sections->get('about.faqs'); @endphp
    @if ($faqCategories->isNotEmpty())
    <div class="page-faqs">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">{{ $faqsSection?->subtitle ?? 'faqs' }}</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $faqsSection?->title ?? 'Frequently asked questions' }}</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    @foreach ($faqCategories as $cat)
                        @if ($cat->faqs->isNotEmpty())
                            <div class="page-faqs-accordion mb-5">
                                <div class="section-title">
                                    <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $cat->name }}</h2>
                                </div>
                                <x-faq-accordion :faqs="$cat->faqs" :id="'faq-' . $cat->id" />
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
    {{-- FAQs Section End --}}

</x-layouts.app>
