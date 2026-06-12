<x-layouts.app :title="$program->title">

    <x-page-header
        :title="$program->title"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Programs', 'url' => route('programs.index')],
            ['label' => $program->title, 'url' => ''],
        ]"
    />

    {{-- Program Single --}}
    <div class="page-service-single">
        <div class="container">
            <div class="row">

                {{-- Sidebar --}}
                <div class="col-lg-4">
                    <div class="page-single-sidebar">

                        {{-- Programs List --}}
                        <div class="page-sidebar-catagery-list wow fadeInUp">
                            <h3>Our Programs</h3>
                            <ul>
                                @foreach ($programs as $p)
                                    <li>
                                        <a href="{{ route('programs.show', $p->slug) }}"
                                           class="{{ $p->id === $program->id ? 'active' : '' }}">
                                            {{ $p->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        {{-- Quick Stats --}}
                        @if($counters->isNotEmpty())
                        <div class="sidebar-stats-box wow fadeInUp" style="background:#f8f4ef; padding:24px; border-radius:8px; margin-top:24px;">
                            <h3 style="margin-bottom:16px; font-size:18px;">Our Impact</h3>
                            @foreach($counters->take(4) as $counter)
                            <div style="display:flex; justify-content:space-between; margin-bottom:10px; padding-bottom:10px; border-bottom:1px solid #e5e5e5;">
                                <span style="color:#666;">{{ $counter->label }}</span>
                                <strong>{{ number_format($counter->value) }}{{ $counter->suffix }}</strong>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        <x-sidebar-cta />
                    </div>
                </div>

                {{-- Main Content --}}
                <div class="col-lg-8">
                    <div class="service-single-contemt">

                        {{-- Feature Image --}}
                        @if ($program->getFirstMediaUrl('banner'))
                            <div class="service-feature-image">
                                <figure class="image-anime reveal">
                                    <img src="{{ $program->getFirstMediaUrl('banner') }}" alt="{{ $program->title }}">
                                </figure>
                            </div>
                        @endif

                        {{-- Program Body --}}
                        <div class="service-entry">
                            @if($program->short_description)
                                <p class="lead" style="font-size:1.1rem; font-weight:500; color:#444; margin-bottom:20px;">
                                    {{ $program->short_description }}
                                </p>
                            @endif

                            {!! $program->body !!}
                        </div>

                        {{-- Get Involved CTA --}}
                        <div class="service-cta-box wow fadeInUp" style="background:#f8f4ef; padding:32px; border-radius:8px; margin-top:40px; text-align:center;">
                            <h3 style="margin-bottom:12px;">Want to Support This Program?</h3>
                            <p style="margin-bottom:20px; color:#666;">Your donation directly funds this program. 100% goes to the people who need it most.</p>
                            <a href="{{ route('donation.index') }}" class="btn-default" style="margin-right:12px;">
                                {{ $siteSettings?->donate_button_text ?? 'Donate Now' }}
                            </a>
                            <a href="{{ route('contact.index') }}" class="btn-default btn-outline" style="background:transparent; border:2px solid currentColor;">
                                Volunteer
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- Program Single End --}}

</x-layouts.app>
