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
                <div class="col-lg-8">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">{{ $sections->get('team.intro')?->subtitle ?? $sections->get('team.hero')?->subtitle ?? 'Our Team' }}</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $sections->get('team.intro')?->title ?? $sections->get('team.hero')?->title ?? 'Driven by Passion, Guided by Purpose' }}</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">{!! $sections->get('team.intro')?->body ?? $sections->get('team.hero')?->body ?? 'Meet the dedicated individuals who work tirelessly every day to empower communities, protect cows, educate children, and feed the hungry across India.' !!}</p>
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
                        <p class="text-center">No team members found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    {{-- Team Grid End --}}

    {{-- Join Team CTA --}}
    <div class="donate-now" style="background:#f8f4ef; padding:60px 0;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Volunteer</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Join Our Mission</h2>
                        <p class="wow fadeInUp">We are always looking for passionate volunteers to help us expand our work. Whether you can give an hour a week or a full-time commitment, every contribution matters.</p>
                    </div>
                </div>
                <div class="col-lg-4 text-center wow fadeInUp">
                    <a href="{{ route('contact.index') }}" class="btn-default">Get In Touch</a>
                </div>
            </div>
        </div>
    </div>
    {{-- CTA End --}}

</x-layouts.app>
