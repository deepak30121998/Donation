@props([
    'service',
])

<!-- Services Item Start -->
<div class="service-item wow fadeInUp">
    <div class="service-content">
        <h3>
            <a href="{{ route('services.show', $service->slug) }}">
                {{ $service->title }}
            </a>
        </h3>
        <p>{{ $service->short_description }}</p>
    </div>
    <div class="service-image">
        <figure class="image-anime">
            <img src="{{ $service->getFirstMediaUrl('thumb') ?: asset('images/placeholder.jpg') }}"
                 alt="{{ $service->title }}">
        </figure>
    </div>
    <div class="service-btn">
        <a href="{{ route('services.show', $service->slug) }}" class="readmore-btn">read more</a>
    </div>
</div>
<!-- Services Item End -->
