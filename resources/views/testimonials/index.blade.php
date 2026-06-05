<x-layouts.app title="Testimonials">

    <x-page-header
        title="<span>Testimonials</span>"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Testimonials', 'url' => ''],
        ]"
    />

    {{-- Testimonials Grid --}}
    <div class="page-testimonials">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">{{ $sections->get('testimonials.hero')?->subtitle ?? 'testimonials' }}</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $sections->get('testimonials.hero')?->title ?? 'What people say about us' }}</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">{!! $sections->get('testimonials.hero')?->body ?? 'Hear from the people whose lives have been touched by our work and dedication to making a lasting difference.' !!}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @forelse ($testimonials as $testimonial)
                    <div class="col-lg-4 col-md-6">
                        <x-testimonial-card :testimonial="$testimonial" />
                    </div>
                @empty
                    <div class="col-lg-12">
                        <p class="text-center">No testimonials available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    {{-- Testimonials Grid End --}}

    {{-- FAQs Section --}}
    @if ($faqCategories->isNotEmpty())
    <div class="page-faqs">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">faqs</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Frequently asked questions</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    @foreach ($faqCategories as $cat)
                        @if ($cat->faqs->isNotEmpty())
                            <div class="page-faqs-accordion mb-5">
                                <div class="section-title">
                                    <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $cat->name }}</h2>
                                </div>
                                <x-faq-accordion :faqs="$cat->faqs" :id="'faq-' . $cat->id" />
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
    {{-- FAQs Section End --}}

</x-layouts.app>
