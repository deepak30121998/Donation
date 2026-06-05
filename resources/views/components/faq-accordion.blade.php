@props([
    'faqs',
    'id' => 'faqAccordion',
])

<!-- FAQ Accordion Start -->
<div class="faq-accordion" id="{{ $id }}">
    @foreach ($faqs as $index => $faq)
        @php
            $itemId    = $id . '_item_' . ($index + 1);
            $headingId = $id . '_heading_' . ($index + 1);
            $isFirst   = $loop->first;
        @endphp

        <!-- FAQ Item Start -->
        <div class="accordion-item wow fadeInUp" @if(!$isFirst) data-wow-delay="{{ ($index * 0.2) }}s" @endif>
            <h2 class="accordion-header" id="{{ $headingId }}">
                <button class="accordion-button {{ $isFirst ? '' : 'collapsed' }}"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#{{ $itemId }}"
                        aria-expanded="{{ $isFirst ? 'true' : 'false' }}"
                        aria-controls="{{ $itemId }}">
                    {{ $faq->question }}
                </button>
            </h2>
            <div id="{{ $itemId }}"
                 class="accordion-collapse collapse {{ $isFirst ? 'show' : '' }}"
                 aria-labelledby="{{ $headingId }}"
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
