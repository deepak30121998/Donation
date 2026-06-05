<x-layouts.app title="About Us">

    <x-page-header
        title="<span>About</span> Us"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'About Us', 'url' => ''],
        ]"
    />

    {{-- About Us Section --}}
    <div class="about-us">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-us-images">
                        <div class="about-img-1">
                            <figure class="image-anime">
                                <img src="{{ asset('images/about-img-1.jpg') }}" alt="About Us">
                            </figure>
                        </div>
                        <div class="about-img-2">
                            <figure class="image-anime">
                                <img src="{{ asset('images/about-img-2.jpg') }}" alt="About Us">
                            </figure>
                        </div>
                        <div class="need-fund-box">
                            <img src="{{ asset('images/icon-funded-dollar.svg') }}" alt="">
                            <p>We've funded <span class="counter">75</span>k Dollars</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="about-us-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{ $sections->get('about.facts')?->subtitle ?? 'about us' }}</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $sections->get('about.facts')?->title ?? 'United in compassion, changing lives' }}</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">{{ $sections->get('about.facts')?->body ?? 'Driven by compassion and a shared vision, we work hand-in-hand with communities to create meaningful change.' }}</p>
                        </div>

                        <div class="about-us-body">
                            <div class="about-us-body-content">
                                <div class="about-support-box wow fadeInUp" data-wow-delay="0.4s">
                                    <div class="icon-box">
                                        <img src="{{ asset('images/icon-about-support.svg') }}" alt="">
                                    </div>
                                    <div class="about-support-content">
                                        <h3>Healthcare Support</h3>
                                        <p>Providing essential healthcare services and resources to communities.</p>
                                    </div>
                                </div>
                                <div class="about-btn wow fadeInUp" data-wow-delay="0.6s">
                                    <a href="{{ route('donation.index') }}" class="btn-default">donate now</a>
                                </div>
                            </div>

                            <div class="helped-fund-item">
                                <div class="helped-fund-img">
                                    <figure class="image-anime">
                                        <img src="{{ asset('images/helped-fund-img.jpg') }}" alt="">
                                    </figure>
                                </div>
                                <div class="helped-fund-content">
                                    <h2><span class="counter">75,958</span></h2>
                                    <h3>helped fund</h3>
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
    <div class="our-approach">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="our-approach-box-content">
                        <div class="our-approach-content">
                            <div class="section-title">
                                <h3 class="wow fadeInUp">{{ $sections->get('about.approach')?->subtitle ?? 'our approach' }}</h3>
                                <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $sections->get('about.approach')?->title ?? 'Compassionate solutions for lasting impact' }}</h2>
                                <p class="wow fadeInUp" data-wow-delay="0.2s">{{ $sections->get('about.approach')?->body ?? 'Our approach focuses on creating sustainable change by addressing root causes, empowering communities, and delivering compassionate solutions.' }}</p>
                            </div>

                            <div class="our-approach-btn wow fadeInUp" data-wow-delay="0.4s">
                                <a href="{{ route('contact.index') }}" class="btn-default">contact now</a>
                            </div>

                            <div class="mission-vision-box wow fadeInUp" data-wow-delay="0.6s">
                                <div class="mission-vision-item">
                                    <div class="icon-box">
                                        <img src="{{ asset('images/icon-our-mission.svg') }}" alt="">
                                    </div>
                                    <div class="mission-vision-content">
                                        <h3>{{ $sections->get('about.mission')?->title ?? 'our mission' }}</h3>
                                        <p>{{ $sections->get('about.mission')?->body ?? 'We strive to create positive change, empower communities, and build a better world.' }}</p>
                                    </div>
                                </div>

                                <div class="mission-vision-item">
                                    <div class="icon-box">
                                        <img src="{{ asset('images/icon-our-vision.svg') }}" alt="">
                                    </div>
                                    <div class="mission-vision-content">
                                        <h3>{{ $sections->get('about.vision')?->title ?? 'our vision' }}</h3>
                                        <p>{{ $sections->get('about.vision')?->body ?? 'A world where every individual has access to equal opportunities and resources.' }}</p>
                                    </div>
                                </div>

                                <div class="mission-vision-item">
                                    <div class="icon-box">
                                        <img src="{{ asset('images/icon-our-value.svg') }}" alt="">
                                    </div>
                                    <div class="mission-vision-content">
                                        <h3>{{ $sections->get('about.values')?->title ?? 'our value' }}</h3>
                                        <p>{{ $sections->get('about.values')?->body ?? 'Integrity, compassion, and accountability guide everything we do.' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="our-approach-image">
                            <figure class="image-anime">
                                <img src="{{ asset('images/our-approach-image.jpg') }}" alt="Our Approach">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Our Approach Section End --}}

    {{-- Why Choose Us Section --}}
    <div class="why-choose-us">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="why-choose-images">
                        <div class="why-choose-image-1">
                            <figure class="image-anime">
                                <img src="{{ asset('images/why-choose-img-1.jpg') }}" alt="">
                            </figure>
                        </div>
                        <div class="why-choose-image-2">
                            <figure class="image-anime">
                                <img src="{{ asset('images/why-choose-img-2.jpg') }}" alt="">
                            </figure>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="why-choose-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">why choose us</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Why we stand out together</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">Our dedication, transparency, and community-driven approach set us apart. Partnering with us means supporting programs that create meaningful change.</p>
                        </div>

                        <div class="why-choose-list wow fadeInUp" data-wow-delay="0.4s">
                            <ul>
                                <li>community-centered approach</li>
                                <li>transparency and accountability</li>
                                <li>empowerment through partnership</li>
                                <li>volunteer and donor engagement</li>
                            </ul>
                        </div>

                        <div class="why-choose-counters">
                            <div class="why-choose-counter-item">
                                <h2><span class="counter">25</span>+</h2>
                                <p>Years of experience</p>
                            </div>
                            <div class="why-choose-counter-item">
                                <h2><span class="counter">230</span>+</h2>
                                <p>Thousands volunteers</p>
                            </div>
                            <div class="why-choose-counter-item">
                                <h2><span class="counter">400</span>+</h2>
                                <p>World wide office</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Why Choose Us Section End --}}

    {{-- How We Help Section --}}
    <div class="how-we-help">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="how-we-help-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">how we help</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Bringing hope to every community</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">We work tirelessly to uplift communities by providing resources, support, and sustainable solutions, fostering hope and creating brighter futures.</p>
                        </div>

                        <div class="how-we-help-body wow fadeInUp" data-wow-delay="0.4s">
                            <ul>
                                <li>Community Development Programs</li>
                                <li>Women and Youth Empowerment</li>
                                <li>Advocacy and Awareness Campaigns</li>
                            </ul>
                        </div>

                        <div class="how-we-help-btn wow fadeInUp" data-wow-delay="0.6s">
                            <a href="{{ route('contact.index') }}" class="btn-default">contact now</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="how-help-list">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- How We Help Section End --}}

    {{-- Our Team Section --}}
    @if ($teamMembers->isNotEmpty())
    <div class="our-team">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">our team</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Meet our dedicated team</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">Our team of passionate individuals works every day to make a difference in the lives of those who need it most.</p>
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
    @if ($testimonials->isNotEmpty())
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
                            <h2><span class="counter">20</span>k</h2>
                            <p>customer review</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="testimonials-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">testimonials</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">What people say about us</h2>
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
    @if ($faqCategories->isNotEmpty())
    <div class="page-faqs">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">faqs</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Frequently asked questions</h2>
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
