<x-layouts.app
    title="Our Programs"
    description="Discover Ujjawal Unnati Foundation's programs — Gau Sewa, Women Entrepreneur training, Child Education, and Ration Distribution — creating sustainable change across Uttar Pradesh and Delhi NCR.">

    <x-page-header
        title="Our <span>Programs</span>"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Our Programs', 'url' => ''],
        ]"
    />

    <!-- Page Programs Start -->
    <div class="page-programs">
        <div class="container">
            <div class="row">
                @forelse ($programs as $index => $program)
                    <div class="col-lg-4 col-md-6">
                        <!-- Program Item Start -->
                        <div class="program-item wow fadeInUp"
                             @if($index > 0) data-wow-delay="{{ ($index * 0.2) }}s" @endif>
                            <div class="program-image">
                                <a href="{{ route('programs.show', $program->slug) }}" data-cursor-text="View">
                                    <figure class="image-anime">
                                        <img src="{{ $program->getFirstMediaUrl('thumb') ?: asset('images/placeholder.jpg') }}"
                                             alt="{{ $program->title }}">
                                    </figure>
                                </a>
                            </div>
                            <div class="program-body">
                                <div class="program-content">
                                    <h3>
                                        <a href="{{ route('programs.show', $program->slug) }}">{{ $program->title }}</a>
                                    </h3>
                                    <p>{{ $program->short_description }}</p>
                                </div>
                                <div class="program-button">
                                    <a href="{{ route('programs.show', $program->slug) }}" class="readmore-btn">read more</a>
                                </div>
                            </div>
                        </div>
                        <!-- Program Item End -->
                    </div>
                @empty
                    <div class="col-lg-12">
                        <p class="text-center py-5">No programs available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Page Programs End -->

</x-layouts.app>
