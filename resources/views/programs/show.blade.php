<x-layouts.app :title="$program->title">

    <x-page-header
        :title="$program->title"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Programs', 'url' => route('programs.index')],
            ['label' => $program->title, 'url' => ''],
        ]"
    />

    {{-- Program Single --}}
    <div class="page-service-single">
        <div class="container">
            <div class="row">
                {{-- Sidebar --}}
                <div class="col-lg-4">
                    <div class="page-single-sidebar">
                        <div class="page-sidebar-catagery-list wow fadeInUp">
                            <h3>programs</h3>
                            <ul>
                                @foreach ($programs as $p)
                                    <li>
                                        <a href="{{ route('programs.show', $p->slug) }}"
                                           class="{{ $p->id === $program->id ? 'active' : '' }}">
                                            {{ $p->title }}
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
                        @if ($program->getFirstMediaUrl('banner'))
                            <div class="service-feature-image">
                                <figure class="image-anime reveal">
                                    <img src="{{ $program->getFirstMediaUrl('banner') }}" alt="{{ $program->title }}">
                                </figure>
                            </div>
                        @endif

                        <div class="service-entry">
                            {!! $program->body !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Program Single End --}}

</x-layouts.app>
