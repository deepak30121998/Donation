<x-layouts.app title="Our Team">

    <x-page-header
        title="Our <span>Team</span>"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Our Team', 'url' => ''],
        ]"
    />

    {{-- Team Grid --}}
    <div class="our-team page-team">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">{{ $sections->get('team.hero')?->subtitle ?? 'our team' }}</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $sections->get('team.hero')?->title ?? 'Meet our dedicated team' }}</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">{!! $sections->get('team.hero')?->body ?? 'Our team of passionate individuals works every day to make a difference in the lives of those who need it most.' !!}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @forelse ($members as $member)
                    <div class="col-lg-3 col-md-6">
                        <x-team-card :member="$member" />
                    </div>
                @empty
                    <div class="col-lg-12">
                        <p class="text-center">No team members available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    {{-- Team Grid End --}}

</x-layouts.app>
