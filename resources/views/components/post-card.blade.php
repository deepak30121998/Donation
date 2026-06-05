@props([
    'post',
])

<!-- Post Item Start -->
<div class="post-item wow fadeInUp">
    <!-- Post Item Header Start -->
    <div class="post-item-header">
        <!-- Post Item Meta Start -->
        <div class="post-item-meta">
            <ul>
                <li>{{ $post->published_at ? $post->published_at->format('d M, Y') : $post->created_at->format('d M, Y') }}</li>
            </ul>
        </div>
        <!-- Post Item Meta End -->

        <!-- Post Item Content Start -->
        <div class="post-item-content">
            <h2>
                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
            </h2>
        </div>
        <!-- Post Item Content End -->
    </div>
    <!-- Post Item Header End -->

    <!-- Post Featured Image Start -->
    <div class="post-featured-image">
        <a href="{{ route('blog.show', $post->slug) }}" data-cursor-text="View">
            <figure class="image-anime">
                <img src="{{ $post->getFirstMediaUrl('featured') ?: asset('images/placeholder.jpg') }}"
                     alt="{{ $post->title }}">
            </figure>
        </a>
    </div>
    <!-- Post Featured Image End -->

    <!-- Blog Item Button Start -->
    <div class="blog-item-btn">
        <a href="{{ route('blog.show', $post->slug) }}" class="readmore-btn">read more</a>
    </div>
    <!-- Blog Item Button End -->
</div>
<!-- Post Item End -->
