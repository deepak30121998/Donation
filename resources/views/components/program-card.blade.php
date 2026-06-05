@props([
    'program',
])

<!-- Program Item Start -->
<div class="program-item wow fadeInUp">
    <div class="program-image">
        <a href="{{ route('programs.show', $program->slug) }}" data-cursor-text="View">
            <figure class="image-anime">
                <img src="{{ $program->getFirstMediaUrl('thumb') ?: asset('images/placeholder.jpg') }}"
                     alt="{{ $program->title }}">
            </figure>
        </a>
    </div>
    <div class="program-body">
        <div class="program-content">
            <h3>
                <a href="{{ route('programs.show', $program->slug) }}">{{ $program->title }}</a>
            </h3>
            <p>{{ $program->short_description }}</p>
        </div>
        <div class="program-button">
            <a href="{{ route('programs.show', $program->slug) }}" class="readmore-btn">read more</a>
        </div>
    </div>
</div>
<!-- Program Item End -->
