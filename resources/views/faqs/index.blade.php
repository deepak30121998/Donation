<x-layouts.app title="FAQs">

    <x-page-header
        title="<span>Frequently</span> Asked Questions"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'FAQs', 'url' => ''],
        ]"
    />

    {{-- FAQs --}}
    <div class="page-faqs">
        <div class="container">
            <div class="row">
                {{-- Sidebar --}}
                <div class="col-lg-4">
                    <div class="page-single-sidebar">
                        <div class="page-sidebar-catagery-list wow fadeInUp">
                            <ul>
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="#cat-{{ $category->id }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <x-sidebar-cta />
                    </div>
                </div>

                {{-- FAQ Content --}}
                <div class="col-lg-8">
                    <div class="page-faqs-catagery">
                        @forelse ($categories as $category)
                            @if ($category->faqs->isNotEmpty())
                                <div class="page-faqs-accordion" id="cat-{{ $category->id }}">
                                    <div class="section-title">
                                        <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $category->name }}</h2>
                                    </div>

                                    <x-faq-accordion :faqs="$category->faqs" :id="'cat-' . $category->id" />
                                </div>
                            @endif
                        @empty
                            <p>No FAQs available at the moment.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- FAQs End --}}

</x-layouts.app>
