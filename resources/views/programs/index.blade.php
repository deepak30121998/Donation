<x-layouts.app title="Our Programs">

    <x-page-header
        :title="($sections->get('programs.hero')?->subtitle ?? 'Our') . ' <span>' . ($sections->get('programs.hero')?->title ?? 'Programs') . '</span>'"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Our Programs', 'url' => ''],
        ]"
    />

    {{-- Programs Intro Section --}}
    @php $introSect = $sections->get('programs.intro'); @endphp
    <div class="our-program page-programs">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-8">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">{{ $sections->get('programs.hero')?->subtitle ?? 'Our Program' }}</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $introSect?->title ?? $sections->get('programs.hero')?->title ?? 'Programs That Transform Lives' }}</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">{!! $introSect?->body ?? $sections->get('programs.hero')?->body ?? 'Our programs are designed to create sustainable change by addressing community needs, empowering individuals, and promoting long-term development.' !!}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @forelse ($programs as $program)
                    <div class="col-lg-4 col-md-6">
                        <x-program-card :program="$program" />
                    </div>
                @empty
                    <div class="col-lg-12">
                        <p class="text-center">No programs available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    {{-- Programs Grid End --}}

    {{-- Stats / Impact Section --}}
    @if($counters->isNotEmpty())
    <div class="our-achievement">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h3 class="wow fadeInUp">{{ $sections->get('home.counters')?->subtitle ?? 'Impact' }}</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $sections->get('home.counters')?->title ?? 'Our Impact in Numbers' }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($counters->take(4) as $counter)
                <div class="col-lg-3 col-md-6">
                    <div class="achievement-item wow fadeInUp text-center">
                        <h2><span class="counter">{{ $counter->value }}</span>{{ $counter->suffix }}</h2>
                        <p>{{ $counter->label }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    {{-- Stats End --}}

    {{-- CTA Section --}}
    @php $cta = $sections->get('home.donate_cta'); @endphp
    <div class="donate-now" style="background-color: #f8f4ef; padding: 60px 0;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">{{ $cta?->subtitle ?? 'Support Us' }}</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $cta?->title ?? 'Your Donation Powers Our Programs' }}</h2>
                        <p class="wow fadeInUp">{!! $cta?->body ?? 'Every rupee donated goes directly to Gau Sewa, education, women empowerment, and ration drives.' !!}</p>
                    </div>
                </div>
                <div class="col-lg-4 text-center wow fadeInUp">
                    <a href="{{ route('donation.index') }}" class="btn-default">
                        {{ $siteSettings?->donate_button_text ?? 'Donate Now' }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{-- CTA End --}}

</x-layouts.app>
