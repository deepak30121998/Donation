@props([
    'cause',
])

@php
    $goal   = $cause->goal_amount  ?? 0;
    $raised = $cause->raised_amount ?? 0;
    $percent = $goal > 0 ? min(100, round(($raised / $goal) * 100)) : 0;
@endphp

<!-- Causes Item Start -->
<div class="causes-item wow fadeInUp">
    <div class="causes-image">
        <figure class="image-anime">
            <img src="{{ $cause->getFirstMediaUrl('thumb') ?: asset('images/placeholder.jpg') }}"
                 alt="{{ $cause->title }}">
        </figure>
    </div>
    <div class="causes-body">
        <div class="causes-content">
            <h3>{{ $cause->title }}</h3>
            <p>{{ $cause->short_description }}</p>
        </div>

        @if ($goal > 0)
            <!-- Causes Progress Start -->
            <div class="causes-progress">
                <div class="progress">
                    <div class="progress-bar" role="progressbar"
                         style="width: {{ $percent }}%"
                         aria-valuenow="{{ $percent }}"
                         aria-valuemin="0"
                         aria-valuemax="100">
                    </div>
                </div>
                <div class="causes-progress-info">
                    <span>Raised: ${{ number_format($raised) }}</span>
                    <span>Goal: ${{ number_format($goal) }}</span>
                </div>
            </div>
            <!-- Causes Progress End -->
        @endif

        <div class="causes-button">
            <a href="{{ route('donation.index') }}?cause={{ $cause->id }}" class="btn-default">donate now</a>
        </div>
    </div>
</div>
<!-- Causes Item End -->
