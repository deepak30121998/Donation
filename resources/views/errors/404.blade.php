<x-layouts.app title="Page Not Found" robots="noindex, follow">

    <x-page-header
        title="<span>Page</span> Not Found"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => '404 Error Page', 'url' => ''],
        ]"
    />

    {{-- Error Section --}}
    <div class="error-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="error-page-image wow fadeInUp">
                        <img src="{{ asset('images/404-error-img.png') }}" alt="404 Error">
                    </div>

                    <div class="error-page-content">
                        <div class="section-title">
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Oops! <span>page not found</span></h2>
                        </div>
                        <div class="error-page-content-body">
                            <p class="wow fadeInUp" data-wow-delay="0.25s">Sorry, we can't find the page you're looking for.</p>
                            <a class="btn-default wow fadeInUp" data-wow-delay="0.5s" href="{{ route('home') }}">back to home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Error Section End --}}

</x-layouts.app>
