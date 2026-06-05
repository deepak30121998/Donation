@props([
    'member',
])

<!-- Team Item Start -->
<div class="team-item wow fadeInUp">
    <!-- Team Image Start -->
    <div class="team-image">
        <a href="{{ route('team') }}" data-cursor-text="View">
            <figure class="image-anime">
                <img src="{{ $member->getFirstMediaUrl('photo') ?: asset('images/placeholder.jpg') }}"
                     alt="{{ $member->name }}">
            </figure>
        </a>
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
            @if (!empty($member->social_twitter))
                <li><a href="{{ $member->social_twitter }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-x-twitter"></i></a></li>
            @endif
            @if (!empty($member->social_facebook))
                <li><a href="{{ $member->social_facebook }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a></li>
            @endif
            @if (!empty($member->social_instagram))
                <li><a href="{{ $member->social_instagram }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-instagram"></i></a></li>
            @endif
            @if (!empty($member->social_linkedin))
                <li><a href="{{ $member->social_linkedin }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-linkedin-in"></i></a></li>
            @endif
        </ul>
    </div>
    <!-- Team Social Icon End -->
</div>
<!-- Team Item End -->
