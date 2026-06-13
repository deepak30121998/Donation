<x-layouts.app title="{{ $sections->get('team.hero')?->title ?? 'Our Team' }}">

    <x-page-header
        title="<span>Our</span> Team"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Our Team', 'url' => ''],
        ]"
    />

    {{-- Team Grid --}}
    <div class="page-team">
        <div class="container">
            <div class="row">
                @forelse ($members as $index => $member)
                    <div class="col-lg-3 col-md-6">
                        <x-team-card
                            :member="$member"
                            :delay="$index > 0 ? ($index * 0.2) . 's' : null"
                        />
                    </div>
                @empty
                    <div class="col-lg-12">
                        <p class="text-center py-5">No team members found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    {{-- Team Grid End --}}

</x-layouts.app>
