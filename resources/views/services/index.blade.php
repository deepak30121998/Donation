<x-layouts.app title="Our Services">

    <x-page-header
        title="Our <span>Services</span>"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Our Services', 'url' => ''],
        ]"
    />

    {{-- Services Grid --}}
    <div class="our-services page-services">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">{{ $sections->get('services.hero')?->subtitle ?? 'services' }}</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $sections->get('services.hero')?->title ?? 'Our comprehensive services' }}</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">{!! $sections->get('services.hero')?->body ?? 'Our services are focused on creating lasting change through community development, healthcare access, educational support, and emergency relief.' !!}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @forelse ($services as $service)
                    <div class="col-lg-4 col-md-6">
                        <x-service-card :service="$service" />
                    </div>
                @empty
                    <div class="col-lg-12">
                        <p class="text-center">No services available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    {{-- Services Grid End --}}

    {{-- Testimonials Section --}}
    @php
        $testSection = $sections->get('services.testimonials') ?? $sections->get('home.testimonials');
        $reviewCtr = $counters->firstWhere('key', 'lives_transformed');
    @endphp
    @if ($testimonials->isNotEmpty())
    <div class="our-testimonials">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="testimonials-image">
                        <div class="testimonials-img">
                            <figure class="image-anime reveal">
                                <img src="{{ $testSection?->getFirstMediaUrl('image') ?: asset('images/testimonials-image.jpg') }}" alt="">
                            </figure>
                        </div>
                        <div class="helthcare-support-circle">
                            <a href="{{ route('contact.index') }}">
                                <img src="{{ asset('images/healthcare-support-circle.svg') }}" alt="">
                            </a>
                        </div>
                        <div class="client-review-box">
                            <h2><span class="counter">{{ $reviewCtr ? number_format($reviewCtr->value / 1000, 0) : '12' }}</span>k+</h2>
                            <p>lives transformed</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="testimonials-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{ $testSection?->subtitle ?? 'testimonials' }}</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $testSection?->title ?? 'What people say about us' }}</h2>
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
    @php $faqsSect = $sections->get('services.faqs') ?? $sections->get('about.faqs'); @endphp
    @if ($faqCategories->isNotEmpty())
    <div class="page-faqs">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">{{ $faqsSect?->subtitle ?? 'faqs' }}</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $faqsSect?->title ?? 'Frequently asked questions' }}</h2>
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
