<x-layouts.app title="Image Gallery">

    <x-page-header
        title="Our <span>Gallery</span>"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Gallery', 'url' => ''],
        ]"
    />

    {{-- Photo Gallery Section --}}
    <div class="page-gallery">
        <div class="container">

            {{-- Filter Tabs --}}
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="our-gallery-nav wow fadeInUp" data-wow-delay="0.2s">
                        <ul>
                            <li><a href="#" class="active-btn" data-filter="*">All</a></li>
                            <li><a href="#" data-filter=".health">Gau Sewa</a></li>
                            <li><a href="#" data-filter=".education">Education</a></li>
                            <li><a href="#" data-filter=".food">Ration & Food</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Gallery Items — class names match JS: gallery-item-boxes + gallery-items (popup) --}}
            <div class="gallery-item-boxes gallery-items">
                @forelse ($items as $item)
                    @php
                        $catClass = $item->category->value === 'all'
                            ? 'health education food'
                            : $item->category->value;
                        $imgUrl = $item->getFirstMediaUrl('gallery') ?: asset('images/placeholder.jpg');
                    @endphp
                    <div class="gallery-item-box {{ $catClass }}">
                        <a href="{{ $imgUrl }}" data-cursor-text="View">
                            <figure class="image-anime">
                                <img src="{{ $imgUrl }}" alt="{{ $item->title ?? 'Gallery Image' }}">
                            </figure>
                        </a>
                    </div>
                @empty
                    <p class="text-center py-5 w-100">No gallery items available.</p>
                @endforelse
            </div>

        </div>
    </div>
    {{-- Photo Gallery Section End --}}

</x-layouts.app>
