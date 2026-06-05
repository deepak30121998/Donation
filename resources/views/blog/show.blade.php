<x-layouts.app :title="$post->title">

    <x-page-header
        :title="$post->title"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Blog', 'url' => route('blog.index')],
            ['label' => $post->title, 'url' => ''],
        ]"
    />

    {{-- Single Post --}}
    <div class="page-single-post">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    {{-- Post Featured Image --}}
                    @if ($post->getFirstMediaUrl('featured'))
                        <div class="post-image">
                            <figure class="image-anime reveal">
                                <img src="{{ $post->getFirstMediaUrl('featured') }}" alt="{{ $post->title }}">
                            </figure>
                        </div>
                    @endif

                    {{-- Post Content --}}
                    <div class="post-content">
                        <div class="post-item-meta mb-3">
                            <ul class="list-unstyled d-flex gap-3">
                                <li>
                                    <i class="fa-regular fa-calendar"></i>
                                    {{ $post->published_at ? $post->published_at->format('d M, Y') : $post->created_at->format('d M, Y') }}
                                </li>
                                @if ($post->category)
                                    <li>
                                        <i class="fa-regular fa-folder"></i>
                                        {{ $post->category->name }}
                                    </li>
                                @endif
                            </ul>
                        </div>

                        <div class="post-entry">
                            {!! $post->body !!}
                        </div>

                        {{-- Tags & Sharing --}}
                        <div class="post-tag-links">
                            <div class="row align-items-center">
                                <div class="col-lg-8">
                                    @if ($post->tags && $post->tags->isNotEmpty())
                                        <div class="post-tags wow fadeInUp" data-wow-delay="0.5s">
                                            <span class="tag-links">
                                                Tags:
                                                @foreach ($post->tags as $tag)
                                                    <a href="#">{{ $tag->name }}</a>
                                                @endforeach
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-lg-4">
                                    <div class="post-social-sharing wow fadeInUp" data-wow-delay="0.5s">
                                        <ul>
                                            <li>
                                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                                   target="_blank" rel="noopener noreferrer">
                                                    <i class="fa-brands fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}"
                                                   target="_blank" rel="noopener noreferrer">
                                                    <i class="fa-brands fa-linkedin-in"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($post->title) }}"
                                                   target="_blank" rel="noopener noreferrer">
                                                    <i class="fa-brands fa-x-twitter"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="col-lg-4">
                    <div class="page-single-sidebar">
                        {{-- Recent Posts --}}
                        @if ($recentPosts->isNotEmpty())
                            <div class="sidebar-recent-posts wow fadeInUp mb-4">
                                <h3 class="sidebar-title">Recent Posts</h3>
                                <ul class="list-unstyled">
                                    @foreach ($recentPosts as $recent)
                                        <li class="mb-3">
                                            <a href="{{ route('blog.show', $recent->slug) }}">
                                                {{ $recent->title }}
                                            </a>
                                            <small class="d-block text-muted">
                                                {{ $recent->published_at ? $recent->published_at->format('d M, Y') : $recent->created_at->format('d M, Y') }}
                                            </small>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <x-sidebar-cta />
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Single Post End --}}

</x-layouts.app>
