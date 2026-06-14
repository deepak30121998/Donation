<x-layouts.app
    :title="$post->meta_title ?: $post->title"
    :description="$post->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($post->excerpt ?: $post->body), 160, '')"
    ogType="article"
    :ogImage="$post->getFirstMediaUrl('featured', 'hero') ?: ($post->getFirstMediaUrl('featured') ?: null)">

    @push('jsonld')
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'headline' => $post->title,
        'description' => $post->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($post->excerpt ?: $post->body), 200, ''),
        'image' => $post->getFirstMediaUrl('featured', 'hero') ?: ($post->getFirstMediaUrl('featured') ?: asset('images/logo.png')),
        'datePublished' => optional($post->published_at)->toAtomString(),
        'dateModified' => optional($post->updated_at)->toAtomString(),
        'author' => ['@type' => 'Organization', 'name' => $siteSettings?->site_name ?? 'Ujjawal Unnati Foundation'],
        'publisher' => [
            '@type' => 'Organization',
            'name' => $siteSettings?->site_name ?? 'Ujjawal Unnati Foundation',
            'logo' => ['@type' => 'ImageObject', 'url' => $siteSettings?->logo_path ? asset('storage/'.$siteSettings->logo_path) : asset('images/logo.png')],
        ],
        'mainEntityOfPage' => url()->current(),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => route('home')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => route('blog.index')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => $post->title, 'item' => url()->current()],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
    @endpush

    <x-page-header
        :title="$post->title"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Blog', 'url' => route('blog.index')],
            ['label' => $post->title, 'url' => ''],
        ]"
    />

    {{-- Page Single Post --}}
    <div class="page-single-post">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    {{-- Post Featured Image --}}
                    @if ($post->getFirstMediaUrl('featured', 'hero') ?: $post->getFirstMediaUrl('featured'))
                        <div class="post-image">
                            <figure class="image-anime reveal">
                                <img src="{{ $post->getFirstMediaUrl('featured', 'hero') ?: $post->getFirstMediaUrl('featured') }}"
                                     alt="{{ $post->title }}">
                            </figure>
                        </div>
                    @endif

                    {{-- Post Content --}}
                    <div class="post-content">

                        {{-- Post Body --}}
                        <div class="post-entry">
                            {!! $post->body !!}
                        </div>

                        {{-- Tags & Social Sharing --}}
                        <div class="post-tag-links">
                            <div class="row align-items-center">

                                <div class="col-lg-8">
                                    {{-- Tags --}}
                                    @if ($post->tags && $post->tags->isNotEmpty())
                                        <div class="post-tags wow fadeInUp" data-wow-delay="0.5s">
                                            <span class="tag-links">
                                                Tags:
                                                @foreach ($post->tags as $tag)
                                                    <a href="#">{{ $tag->name }}</a>
                                                @endforeach
                                            </span>
                                        </div>
                                    @else
                                        <div class="post-tags wow fadeInUp" data-wow-delay="0.5s">
                                            <span class="tag-links">
                                                Tags:
                                                @if ($post->category)
                                                    <a href="#">{{ $post->category->name }}</a>
                                                @endif
                                                <a href="#">ujjawal unnati</a>
                                                <a href="#">community</a>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-lg-4">
                                    {{-- Social Sharing --}}
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
                                                <a href="https://www.instagram.com/"
                                                   target="_blank" rel="noopener noreferrer">
                                                    <i class="fa-brands fa-instagram"></i>
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
                        {{-- Tags & Social Sharing End --}}

                    </div>
                    {{-- Post Content End --}}

                </div>
            </div>
        </div>
    </div>
    {{-- Page Single Post End --}}

</x-layouts.app>
