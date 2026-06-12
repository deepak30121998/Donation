<x-layouts.app :title="$service->title">

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

                        {{-- Services List --}}
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

                        {{-- Contact Box --}}
                        <div class="sidebar-contact-box wow fadeInUp" style="background:#f8f4ef; padding:24px; border-radius:8px; margin-top:24px;">
                            <h3 style="margin-bottom:12px; font-size:18px;">Need Help?</h3>
                            <p style="color:#666; margin-bottom:16px;">Get in touch with us for more information about this service.</p>
                            @if($siteSettings?->phone)
                            <p style="margin-bottom:8px;">
                                <strong>📞 </strong>
                                <a href="tel:{{ preg_replace('/\s+/', '', $siteSettings->phone) }}">{{ $siteSettings->phone }}</a>
                            </p>
                            @endif
                            @if($siteSettings?->email)
                            <p>
                                <strong>✉️ </strong>
                                <a href="mailto:{{ $siteSettings->email }}">{{ $siteSettings->email }}</a>
                            </p>
                            @endif
                        </div>

                        <x-sidebar-cta />
                    </div>
                </div>

                {{-- Main Content --}}
                <div class="col-lg-8">
                    <div class="service-single-contemt">

                        {{-- Feature Image --}}
                        @if ($service->getFirstMediaUrl('banner'))
                            <div class="service-feature-image">
                                <figure class="image-anime reveal">
                                    <img src="{{ $service->getFirstMediaUrl('banner') }}" alt="{{ $service->title }}">
                                </figure>
                            </div>
                        @endif

                        {{-- Service Body --}}
                        <div class="service-entry">
                            @if($service->short_description)
                                <p class="lead" style="font-size:1.1rem; font-weight:500; color:#444; margin-bottom:20px;">
                                    {{ $service->short_description }}
                                </p>
                            @endif

                            {!! $service->body !!}
                        </div>

                        {{-- Get Involved CTA --}}
                        <div class="service-cta-box wow fadeInUp" style="background:#f8f4ef; padding:32px; border-radius:8px; margin-top:40px; text-align:center;">
                            <h3 style="margin-bottom:12px;">Support This Cause</h3>
                            <p style="margin-bottom:20px; color:#666;">Donate or volunteer to help us deliver this service to more people in need.</p>
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
    {{-- Service Single End --}}

</x-layouts.app>
