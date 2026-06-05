@props([
    'testimonial',
])

<!-- Testimonial Item Start -->
<div class="testimonial-item wow fadeInUp">
    <!-- Testimonial Header Start -->
    <div class="testimonial-header">
        <!-- Author Info Start -->
        <div class="author-info">
            <!-- Author Image Start -->
            <div class="author-image">
                <figure class="image-anime">
                    <img src="{{ $testimonial->getFirstMediaUrl('photo') ?: asset('images/placeholder.jpg') }}"
                         alt="{{ $testimonial->author_name }}">
                </figure>
            </div>
            <!-- Author Image End -->

            <!-- Author Content Start -->
            <div class="author-content">
                <h3>{{ $testimonial->author_name }}</h3>
                <p>{{ $testimonial->author_position }}</p>
            </div>
            <!-- Author Content End -->
        </div>
        <!-- Author Info End -->

        <!-- Testimonial Rating Start -->
        <div class="testimonial-rating">
            @for ($i = 1; $i <= 5; $i++)
                @if ($i <= ($testimonial->rating ?? 5))
                    <i class="fa-solid fa-star"></i>
                @else
                    <i class="fa-regular fa-star"></i>
                @endif
            @endfor
        </div>
        <!-- Testimonial Rating End -->
    </div>
    <!-- Testimonial Header End -->

    <!-- Testimonial Content Start -->
    <div class="testimonial-content">
        <p>{{ $testimonial->quote }}</p>
    </div>
    <!-- Testimonial Content End -->
</div>
<!-- Testimonial Item End -->
