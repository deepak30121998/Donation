<x-layouts.app title="Our Programs">

    <x-page-header
        title="Our <span>Programs</span>"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Our Programs', 'url' => ''],
        ]"
    />

    {{-- Programs Grid --}}
    <div class="our-program page-programs">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">our program</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Empowering our programs</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">Our programs are designed to create sustainable change by addressing community needs, empowering individuals, and promoting long-term development through education.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @forelse ($programs as $program)
                    <div class="col-lg-4 col-md-6">
                        <x-program-card :program="$program" />
                    </div>
                @empty
                    <div class="col-lg-12">
                        <p class="text-center">No programs available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    {{-- Programs Grid End --}}

</x-layouts.app>
