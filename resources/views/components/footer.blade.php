@php
    $phone        = $siteSettings?->phone         ?? '';
    $email        = $siteSettings?->email         ?? '';
    $pinterest    = $siteSettings?->pinterest_url ?? '';
    $twitter      = $siteSettings?->twitter_url   ?? '';
    $facebook     = $siteSettings?->facebook_url  ?? '';
    $instagram    = $siteSettings?->instagram_url ?? '';
    $youtube      = $siteSettings?->youtube_url   ?? '';
    $footerAbout  = $siteSettings?->footer_about_text ?? '';
    $footerCopy   = $siteSettings?->footer_copyright  ?? 'All Rights Reserved.';
    $footerSect   = $sections->get('global.footer') ?? null;
@endphp

<!-- Main Footer Section Start -->
<footer class="main-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Main Footer Box Start -->
                <div class="main-footer-box">

                    <!-- Footer About Start -->
                    <div class="footer-about">
                        <!-- Footer Logo Start -->
                        <div class="footer-logo">
                            @if(!empty($siteSettings?->logo_path))
                                <img src="{{ asset('storage/' . $siteSettings->logo_path) }}" alt="{{ $siteSettings->site_name }}">
                            @elseif($footerSect?->getFirstMediaUrl('image'))
                                <img src="{{ $footerSect->getFirstMediaUrl('image') }}" alt="{{ $siteSettings?->site_name ?? 'Logo' }}">
                            @else
                                <img src="{{ asset('images/footer-logo.png') }}" alt="{{ $siteSettings?->site_name ?? 'Ujjawal Unnati Foundation' }}" style="height:45px;width:auto;">
                            @endif
                        </div>
                        <!-- Footer Logo End -->

                        <!-- Footer Contact Detail Start -->
                        <div class="footer-contact-detail">
                            @if($phone)
                            <div class="footer-contact-item">
                                <p>{{ $footerSect?->subtitle ?? 'Toll free customer care' }}</p>
                                <h3><a href="tel:{{ preg_replace('/\s+/', '', $phone) }}">{{ $phone }}</a></h3>
                            </div>
                            @endif

                            @if($email)
                            <div class="footer-contact-item">
                                <p>{{ $footerSect?->button_text ?? 'Need live support!' }}</p>
                                <h3><a href="mailto:{{ $email }}">{{ $email }}</a></h3>
                            </div>
                            @endif
                        </div>
                        <!-- Footer Contact Detail End -->

                        @if($footerAbout)
                        <p class="footer-about-text">{{ $footerAbout }}</p>
                        @endif

                        <!-- Footer Social Links Start -->
                        <div class="footer-social-links">
                            <h3>{{ $footerSect?->title ?? 'Follow Us' }}</h3>
                            <ul>
                                @if($facebook)<li><a href="{{ $facebook }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-facebook-f"></i></a></li>@endif
                                @if($youtube)<li><a href="{{ $youtube }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-youtube"></i></a></li>@endif
                                @if($instagram)<li><a href="{{ $instagram }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-instagram"></i></a></li>@endif
                                @if($twitter)<li><a href="{{ $twitter }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-x-twitter"></i></a></li>@endif
                                @if($pinterest)<li><a href="{{ $pinterest }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-pinterest-p"></i></a></li>@endif
                            </ul>
                        </div>
                        <!-- Footer Social Links End -->
                    </div>
                    <!-- Footer About End -->

                    <!-- Footer Links Box Start -->
                    <div class="footer-links-box">

                        <!-- Newsletter Form Start -->
                        <div class="newsletter-form">
                            <form id="newsletterForm" action="{{ route('newsletter.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" id="footer-mail"
                                        placeholder="Enter Your Email"
                                        value="{{ old('email') }}"
                                        required>
                                    <button type="submit" class="newsletter-btn">
                                        <i class="fa-regular fa-paper-plane"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- Newsletter Form End -->

                        <!-- Quick Links Start -->
                        @php
                            $quickLinks  = $sections->get('global.footer_quick_links') ?? null;
                            $serviceHead = $sections->get('global.footer_services') ?? null;
                            $supportSect = $sections->get('global.footer_support') ?? null;
                            $footerNavItems = ($navItems ?? collect())->filter(fn($i) => $i->children->isEmpty())->take(6);
                        @endphp
                        <div class="footer-links">
                            <h3>{{ $quickLinks?->title ?? 'Quick Links' }}</h3>
                            <ul>
                                @forelse($footerNavItems as $navItem)
                                    <li><a href="{{ $navItem->href }}">{{ $navItem->label }}</a></li>
                                @empty
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="{{ route('about') }}">About Us</a></li>
                                    <li><a href="{{ route('services.index') }}">Services</a></li>
                                    <li><a href="{{ route('contact.index') }}">Contact Us</a></li>
                                @endforelse
                            </ul>
                        </div>
                        <!-- Quick Links End -->

                        <!-- Footer Service Links Start -->
                        <div class="footer-links footer-service-links">
                            <h3>{{ $serviceHead?->title ?? 'services' }}</h3>
                            <ul>
                                @forelse($navServices ?? [] as $service)
                                    <li><a href="{{ route('services.show', $service->slug) }}">{{ $service->title }}</a></li>
                                @empty
                                    <li><a href="{{ route('services.index') }}">Our Services</a></li>
                                @endforelse
                            </ul>
                        </div>
                        <!-- Footer Service Links End -->

                        <!-- Support Links Start -->
                        <div class="footer-links">
                            <h3>{{ $supportSect?->title ?? 'support' }}</h3>
                            <ul>
                                <li><a href="{{ route('contact.index') }}">{{ $supportSect?->subtitle ?? 'help' }}</a></li>
                                <li><a href="{{ $supportSect?->button_url ?? '#' }}">privacy policy</a></li>
                                <li><a href="#">term's &amp; condition</a></li>
                                <li><a href="{{ route('contact.index') }}">support</a></li>
                            </ul>
                        </div>
                        <!-- Support Links End -->

                    </div>
                    <!-- Footer Links Box End -->

                </div>
                <!-- Main Footer Box End -->
            </div>
        </div>
    </div>

    <!-- Footer Copyright Start -->
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright-text">
                        <p>Copyright &copy; {{ date('Y') }} {{ $siteSettings?->site_name ?? config('app.name') }}. {{ $footerCopy }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Copyright End -->
</footer>
<!-- Main Footer Section End -->
