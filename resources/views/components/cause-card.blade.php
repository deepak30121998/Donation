@props([
    'cause',
])

<!-- Causes Item Start -->
<div class="causes-item wow fadeInUp">
    <div class="causes-image">
        <figure class="image-anime">
            <img src="{{ $cause->getFirstMediaUrl('thumb') ?: asset('images/placeholder.jpg') }}"
                 alt="{{ $cause->title }}">
        </figure>
    </div>
    <div class="causes-body">
        <div class="causes-content">
            <h3>{{ $cause->title }}</h3>
            <p>{{ $cause->short_description }}</p>
        </div>

        <div class="causes-button">
            <a href="{{ route('donation.index') }}?cause={{ $cause->id }}" class="btn-default">donate now</a>
        </div>
    </div>
</div>
<!-- Causes Item End -->
