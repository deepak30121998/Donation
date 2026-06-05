@props([
    'tag'         => '',
    'title'       => '',
    'description' => null,
])

<!-- Section Title Start -->
<div class="section-title">
    @if ($tag)
        <h3 class="wow fadeInUp">{{ $tag }}</h3>
    @endif

    <h2 class="text-anime-style-2" data-cursor="-opaque">{!! $title !!}</h2>

    @if ($description)
        <p class="wow fadeInUp" data-wow-delay="0.2s">{{ $description }}</p>
    @endif
</div>
<!-- Section Title End -->
