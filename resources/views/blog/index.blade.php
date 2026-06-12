<x-layouts.app title="Our Blog">

    <x-page-header
        title="Our <span>Blog</span>"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Our Blog', 'url' => ''],
        ]"
    />

    {{-- Blog Grid --}}
    <div class="our-blog page-blog">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-8">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">{{ $sections->get('blog.hero')?->subtitle ?? 'Latest Posts' }}</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $sections->get('blog.hero')?->title ?? 'Stories of Impact and Hope' }}</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">{!! $sections->get('blog.hero')?->body ?? "Explore inspiring stories about our Gau Sewa drives, women empowerment programs, education camps, and hunger-free initiatives." !!}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @forelse ($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        <x-post-card :post="$post" />
                    </div>
                @empty
                    <div class="col-lg-12 text-center py-5">
                        <h3>No posts yet</h3>
                        <p>Check back soon for stories from our community.</p>
                        <a href="{{ route('home') }}" class="btn-default mt-3">Back to Home</a>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if ($posts->hasPages())
                <div class="row mt-5">
                    <div class="col-lg-12 d-flex justify-content-center">
                        {{ $posts->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
    {{-- Blog Grid End --}}

    {{-- Newsletter CTA --}}
    <div class="donate-now" style="background:#f8f4ef; padding:60px 0;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">{{ $sections->get('home.newsletter')?->subtitle ?? 'Stay Connected' }}</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $sections->get('home.newsletter')?->title ?? 'Get Our Stories in Your Inbox' }}</h2>
                        <p class="wow fadeInUp">{!! $sections->get('home.newsletter')?->body ?? 'Subscribe to receive updates on our programs, events, and impact stories.' !!}</p>
                    </div>
                </div>
                <div class="col-lg-5 wow fadeInUp">
                    <form id="blogNewsletterForm" action="{{ route('newsletter.store') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="email" name="email" class="form-control" placeholder="Enter your email address" required>
                            <button type="submit" class="btn-default" style="border-radius:0 6px 6px 0;">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Newsletter CTA End --}}

</x-layouts.app>
