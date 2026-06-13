@props([
    'faqs',
    'id' => 'faqAccordion',
])

<!-- FAQ Accordion Start -->
<div class="faq-accordion" id="{{ $id }}">
    @foreach ($faqs as $faq)
        <!-- FAQ Item Start -->
        <div class="accordion-item wow fadeInUp" @if(!$loop->first) data-wow-delay="{{ ($loop->index * 0.2) }}s" @endif>
            <h2 class="accordion-header" id="{{ $id }}_heading_{{ $loop->iteration }}">
                <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#{{ $id }}_item_{{ $loop->iteration }}"
                        aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                        aria-controls="{{ $id }}_item_{{ $loop->iteration }}">
                    {{ $faq->question }}
                </button>
            </h2>
            <div id="{{ $id }}_item_{{ $loop->iteration }}"
                 class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                 aria-labelledby="{{ $id }}_heading_{{ $loop->iteration }}"
                 data-bs-parent="#{{ $id }}">
                <div class="accordion-body">
                    <p>{{ $faq->answer }}</p>
                </div>
            </div>
        </div>
        <!-- FAQ Item End -->
    @endforeach
</div>
<!-- FAQ Accordion End -->
