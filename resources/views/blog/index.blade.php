<x-layouts.app
    :title="$sections->get('blog.hero')?->title ?? 'Our Blog'"
    description="Read inspiring stories, updates, and impact reports from Ujjawal Unnati Foundation's work in women empowerment, cow protection, education, and hunger relief across India.">

    <x-page-header
        title="<span>Our</span> Blog"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Blog', 'url' => ''],
        ]"
    />

    {{-- Page Blog --}}
    <div class="page-blog">
        <div class="container">
            <div class="row">

                @forelse ($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        <x-post-card
                            :post="$post"
                            :delay="$loop->index > 0 ? ($loop->index * 0.2) . 's' : null"
                        />
                    </div>
                @empty
                    <div class="col-lg-12 text-center py-5">
                        <p>No posts yet — check back soon.</p>
                    </div>
                @endforelse

                {{-- Pagination --}}
                @if ($posts->hasPages())
                    <div class="col-lg-12">
                        <div class="page-pagination wow fadeInUp" data-wow-delay="1.2s">
                            <ul class="pagination">
                                {{-- Previous --}}
                                @if ($posts->onFirstPage())
                                    <li class="disabled"><span><i class="fa-solid fa-angle-left"></i></span></li>
                                @else
                                    <li><a href="{{ $posts->previousPageUrl() }}"><i class="fa-solid fa-angle-left"></i></a></li>
                                @endif

                                {{-- Page numbers --}}
                                @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                                    <li class="{{ $page == $posts->currentPage() ? 'active' : '' }}">
                                        <a href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                {{-- Next --}}
                                @if ($posts->hasMorePages())
                                    <li><a href="{{ $posts->nextPageUrl() }}"><i class="fa-solid fa-angle-right"></i></a></li>
                                @else
                                    <li class="disabled"><span><i class="fa-solid fa-angle-right"></i></span></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
    {{-- Page Blog End --}}

</x-layouts.app>
