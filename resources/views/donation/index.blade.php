<x-layouts.app title="Make a Donation">

    <x-page-header
        title="Make a <span>Donation</span>"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Donation', 'url' => ''],
        ]"
    />

    {{-- Donation Section --}}
    <div class="page-donation">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">

                    @if (session('success'))
                        <div class="alert alert-success mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="donate-box">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{ $sections->get('donation.hero')?->subtitle ?? 'donate now' }}</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $sections->get('donation.hero')?->title ?? 'Make a difference today' }}</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">{!! $sections->get('donation.hero')?->body ?? 'Your generous support enables us to continue our mission of spreading love and serving communities in need around the world.' !!}</p>
                        </div>

                        <x-donation-form :causes="$causes" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Donation Section End --}}

</x-layouts.app>
