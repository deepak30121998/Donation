@props([
    'member',
    'delay' => null,
])

<!-- Team Item Start -->
<div class="team-item wow fadeInUp" @if($delay) data-wow-delay="{{ $delay }}" @endif>
    <!-- Team Image Start -->
    <div class="team-image">
        <figure class="image-anime">
            <img src="{{ $member->getFirstMediaUrl('card') ?: ($member->getFirstMediaUrl('photo') ?: asset('images/placeholder.jpg')) }}"
                 alt="{{ $member->name }}">
        </figure>
    </div>
    <!-- Team Image End -->

    <!-- Team Content Start -->
    <div class="team-content">
        <h3>{{ $member->name }}</h3>
        <p>{{ $member->position }}</p>
    </div>
    <!-- Team Content End -->

    <!-- Team Social Icon Start -->
    <div class="team-social-icon">
        <ul>
            @if (!empty($member->twitter_url))
                <li><a href="{{ $member->twitter_url }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-x-twitter"></i></a></li>
            @endif
            @if (!empty($member->facebook_url))
                <li><a href="{{ $member->facebook_url }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a></li>
            @endif
            @if (!empty($member->instagram_url))
                <li><a href="{{ $member->instagram_url }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-instagram"></i></a></li>
            @endif
        </ul>
    </div>
    <!-- Team Social Icon End -->
</div>
<!-- Team Item End -->
