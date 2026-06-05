<x-layouts.app title="Image Gallery">

    <x-page-header
        title="<span>Image</span> Gallery"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Image Gallery', 'url' => ''],
        ]"
    />

    {{-- Photo Gallery Section --}}
    <div class="page-gallery">
        <div class="container">

            {{-- Filter Buttons --}}
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="our-gallery-nav wow fadeInUp" data-wow-delay="0.2s">
                        <ul>
                            <li><a href="#" class="active-btn" data-filter="*">all</a></li>
                            <li><a href="#" data-filter=".health">health</a></li>
                            <li><a href="#" data-filter=".education">education</a></li>
                            <li><a href="#" data-filter=".food">food</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Gallery Items --}}
            <div class="row gallery-items page-gallery-box">
                @forelse ($items as $item)
                    <div class="col-lg-4 col-6 {{ $item->category->value }}">
                        <div class="photo-gallery wow fadeInUp">
                            <a href="{{ $item->getFirstMediaUrl('gallery') ?: asset('images/placeholder.jpg') }}"
                               class="popup-image"
                               data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="{{ $item->getFirstMediaUrl('gallery') ?: asset('images/placeholder.jpg') }}"
                                         alt="{{ $item->title ?? 'Gallery Image' }}">
                                </figure>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-lg-12">
                        <p class="text-center">No gallery items available at the moment.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
    {{-- Photo Gallery Section End --}}

</x-layouts.app>
