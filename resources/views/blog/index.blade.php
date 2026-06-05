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
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">latest post</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Stories of impact and hope</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">Explore inspiring stories and updates about our initiatives, successes, and the lives we've touched.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @forelse ($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        <x-post-card :post="$post" />
                    </div>
                @empty
                    <div class="col-lg-12">
                        <p class="text-center">No posts available at the moment.</p>
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

</x-layouts.app>
