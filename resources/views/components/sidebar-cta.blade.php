@php $ctaSection = $sections->get('global.sidebar_cta') ?? null; @endphp
<!-- Sidebar CTA Box Start -->
<div class="sidebar-cta-box wow fadeInUp" data-wow-delay="0.2s">
    <!-- Icon Box Start -->
    <div class="icon-box">
        <img src="{{ asset('images/icon-cta.svg') }}" alt="">
    </div>
    <!-- Icon Box End -->

    <!-- Sidebar CTA Content Start -->
    <div class="sidebar-cta-content">
        <p>{{ $ctaSection?->subtitle ?? 'small gifts, big changes' }}</p>
        <h3>{{ $ctaSection?->title ?? 'empowering every child through education' }}</h3>
    </div>
    <!-- Sidebar CTA Content End -->

    <!-- Sidebar CTA Button Start -->
    <div class="sidebar-cta-btn">
        <a href="{{ $ctaSection?->button_url ?? route('contact.index') }}" class="btn-default">
            {{ $ctaSection?->button_text ?? 'Get a quote' }}
        </a>
    </div>
    <!-- Sidebar CTA Button End -->
</div>
<!-- Sidebar CTA Box End -->
