<x-layouts.app :title="$service->title">

    <x-page-header
        :title="$service->title"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Services', 'url' => route('services.index')],
            ['label' => $service->title, 'url' => ''],
        ]"
    />

    {{-- Service Single --}}
    <div class="page-service-single">
        <div class="container">
            <div class="row">
                {{-- Sidebar --}}
                <div class="col-lg-4">
                    <div class="page-single-sidebar">
                        <div class="page-sidebar-catagery-list wow fadeInUp">
                            <h3>services category</h3>
                            <ul>
                                @foreach ($services as $s)
                                    <li>
                                        <a href="{{ route('services.show', $s->slug) }}"
                                           class="{{ $s->id === $service->id ? 'active' : '' }}">
                                            {{ $s->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <x-sidebar-cta />
                    </div>
                </div>

                {{-- Main Content --}}
                <div class="col-lg-8">
                    <div class="service-single-contemt">
                        @if ($service->getFirstMediaUrl('banner'))
                            <div class="service-feature-image">
                                <figure class="image-anime reveal">
                                    <img src="{{ $service->getFirstMediaUrl('banner') }}" alt="{{ $service->title }}">
                                </figure>
                            </div>
                        @endif

                        <div class="service-entry">
                            {!! $service->body !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Service Single End --}}

</x-layouts.app>
