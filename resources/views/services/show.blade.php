<x-layouts.app
    :title="$service->meta_title ?: $service->title"
    :description="$service->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($service->short_description ?: $service->body), 160, '')"
    :ogImage="$bannerUrl ?? null">

    @push('jsonld')
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'name' => $service->title,
        'description' => $service->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($service->short_description ?: $service->body), 200, ''),
        'url' => url()->current(),
        'provider' => ['@type' => 'NGO', 'name' => $siteSettings?->site_name ?? 'Ujjawal Unnati Foundation'],
        'areaServed' => ['@type' => 'Country', 'name' => 'India'],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => route('home')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => route('services.index')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => $service->title, 'item' => url()->current()],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
    @endpush

    <x-page-header
        :title="$service->title"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Services', 'url' => route('services.index')],
            ['label' => $service->title, 'url' => ''],
        ]"
    />

    {{-- Service Single --}}
    <div class="page-service-single">
        <div class="container">
            <div class="row">

                {{-- Sidebar --}}
                <div class="col-lg-4">
                    <div class="page-single-sidebar">

                        {{-- Services Category List --}}
                        <div class="page-sidebar-catagery-list wow fadeInUp">
                            <h3>Our Services</h3>
                            <ul>
                                @foreach ($services as $s)
                                    <li>
                                        <a href="{{ route('services.show', $s->slug) }}"
                                           class="{{ $s->id === $service->id ? 'active' : '' }}">
                                            {{ $s->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <x-sidebar-cta />
                    </div>
                </div>

                {{-- Main Content --}}
                <div class="col-lg-8">
                    <div class="service-single-contemt">

                        {{-- Feature Image --}}
                        <div class="service-feature-image">
                            <figure class="image-anime reveal">
                                <img src="{{ $bannerUrl }}" alt="{{ $service->title }}">
                            </figure>
                        </div>

                        {{-- Service Entry --}}
                        <div class="service-entry">

                            {{-- Opening description --}}
                            @if ($service->short_description)
                                <p class="wow fadeInUp">{{ $service->short_description }}</p>
                            @endif

                            @if ($service->body)
                                <div class="wow fadeInUp" data-wow-delay="0.2s">
                                    {!! $service->body !!}
                                </div>
                            @endif

                            {{-- Bringing Quality Box --}}
                            <div class="bringing-quality-box">
                                <h2 class="text-anime-style-2" data-cursor="-opaque">
                                    {{ $qualitySection?->title ?? 'How we make a difference' }}
                                </h2>
                                <p class="wow fadeInUp">
                                    {{ $qualitySection?->subtitle ?? 'Our approach is hands-on, community-driven, and built for lasting impact across Noida and UP.' }}
                                </p>
                                @if ($qualitySection?->body)
                                    <ul class="wow fadeInUp" data-wow-delay="0.2s">
                                        @foreach (array_filter(array_map('trim', explode("\n", strip_tags((string)$qualitySection->body)))) as $point)
                                            <li>{{ $point }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <ul class="wow fadeInUp" data-wow-delay="0.2s">
                                        <li>community awareness drives</li>
                                        <li>on-ground field support</li>
                                        <li>legal aid &amp; counselling</li>
                                        <li>skill training programs</li>
                                        <li>monthly distribution drives</li>
                                        <li>volunteer mobilisation</li>
                                        <li>women self-help groups</li>
                                        <li>child rehabilitation</li>
                                        <li>gau sewa &amp; cow care</li>
                                    </ul>
                                @endif
                            </div>

                            {{-- Service Entry Content List --}}
                            <div class="service-entry-content-list">

                                {{-- Item 1: Main service image --}}
                                <div class="service-entry-content-item">
                                    <div class="service-entry-image">
                                        <figure class="image-anime reveal">
                                            <img src="{{ $thumbUrl }}" alt="{{ $service->title }}">
                                        </figure>
                                    </div>
                                    <div class="service-entry-content-box wow fadeInUp">
                                        <div class="icon-box">
                                            <img src="{{ asset('images/icon-service-entry-content-1.svg') }}" alt="">
                                        </div>
                                        <div class="service-entry-content">
                                            <h3>{{ $service->title }}</h3>
                                            <p>{{ $service->short_description ?? 'We work directly with communities to deliver this service through trained volunteers and field staff across Noida and UP.' }}</p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Item 2: Our commitment --}}
                                <div class="service-entry-content-item">
                                    <div class="service-entry-image">
                                        <figure class="image-anime reveal">
                                            <img src="{{ asset('images/about-img-1.jpg') }}" alt="Our Commitment">
                                        </figure>
                                    </div>
                                    <div class="service-entry-content-box wow fadeInUp" data-wow-delay="0.2s">
                                        <div class="icon-box">
                                            <img src="{{ asset('images/icon-service-entry-content-2.svg') }}" alt="">
                                        </div>
                                        <div class="service-entry-content">
                                            <h3>Our Commitment</h3>
                                            <p>{{ $commitmentBody ?? 'Ujjawal Unnati Foundation is committed to transparency, accountability, and direct community impact — 100% of funds go to the people who need it most.' }}</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            {{-- Service Entry Content List End --}}

                            {{-- Process Steps --}}
                            <div class="service-entry-steps">
                                <h2 class="text-anime-style-2" data-cursor="-opaque">
                                    {{ $stepsHeading?->title ?? 'How we work with you' }}
                                </h2>
                                <p class="wow fadeInUp">
                                    {{ $stepsHeading?->subtitle ?? 'A simple, transparent process — from first contact to measurable community impact.' }}
                                </p>
                                <div class="service-entry-step-list">
                                    @foreach ($steps as $i => $step)
                                        <div class="service-entry-step-item {{ $i === 0 ? 'active' : '' }} wow fadeInUp"
                                             @if($i > 0) data-wow-delay="{{ $i * 0.2 }}s" @endif>
                                            <div class="service-entry-step-box">
                                                <div class="service-entry-step-no">
                                                    <h2>{{ $step['no'] }}</h2>
                                                </div>
                                                <div class="service-entry-step-content">
                                                    <h3>{{ $step['title'] }}</h3>
                                                    <p>{{ $step['desc'] }}</p>
                                                </div>
                                            </div>
                                            <div class="icon-box">
                                                <img src="{{ asset('images/' . $step['icon']) }}" alt="">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Page Single FAQs --}}
                            @if ($faqCategories->isNotEmpty())
                                <div class="page-single-faqs">
                                    <div class="section-title">
                                        <h2 class="text-anime-style-2" data-cursor="-opaque">
                                            Frequently asked <span>questions</span>
                                        </h2>
                                    </div>
                                    @foreach ($faqCategories as $cat)
                                        @if ($cat->faqs->isNotEmpty())
                                            <x-faq-accordion :faqs="$cat->faqs" :id="'faq-service-' . $cat->id" />
                                        @endif
                                    @endforeach
                                </div>
                            @endif

                        </div>
                        {{-- Service Entry End --}}

                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- Service Single End --}}

    {{-- Prev / Next Navigation --}}
    @if ($prevService || $nextService)
        <div class="related-posts-navigation">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="post-navigation-links">
                            @if ($prevService)
                                <div class="prev-post">
                                    <a href="{{ route('services.show', $prevService->slug) }}">
                                        <span>← Previous Service</span>
                                        <h3>{{ $prevService->title }}</h3>
                                    </a>
                                </div>
                            @endif
                            @if ($nextService)
                                <div class="next-post">
                                    <a href="{{ route('services.show', $nextService->slug) }}">
                                        <span>Next Service →</span>
                                        <h3>{{ $nextService->title }}</h3>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</x-layouts.app>
