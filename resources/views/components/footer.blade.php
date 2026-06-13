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
                            @elseif($sections->get('global.footer')?->getFirstMediaUrl('image'))
                                <img src="{{ $sections->get('global.footer')->getFirstMediaUrl('image') }}" alt="{{ $siteSettings?->site_name ?? 'Logo' }}">
                            @else
                                <img src="{{ asset('images/footer-logo.png') }}" alt="{{ $siteSettings?->site_name ?? 'Ujjawal Unnati Foundation' }}" style="height:45px;width:auto;">
                            @endif
                        </div>
                        <!-- Footer Logo End -->

                        <!-- Footer Contact Detail Start -->
                        <div class="footer-contact-detail">
                            @if($siteSettings?->phone)
                            <div class="footer-contact-item">
                                <p>{{ $sections->get('global.footer')?->subtitle ?? 'Toll free customer care' }}</p>
                                <h3><a href="tel:{{ preg_replace('/\s+/', '', $siteSettings->phone) }}">{{ $siteSettings->phone }}</a></h3>
                            </div>
                            @endif

                            @if($siteSettings?->email)
                            <div class="footer-contact-item">
                                <p>{{ $sections->get('global.footer')?->button_text ?? 'Need live support!' }}</p>
                                <h3><a href="mailto:{{ $siteSettings->email }}">{{ $siteSettings->email }}</a></h3>
                            </div>
                            @endif
                        </div>
                        <!-- Footer Contact Detail End -->

                        @if($siteSettings?->footer_about_text)
                        <p class="footer-about-text">{{ $siteSettings->footer_about_text }}</p>
                        @endif

                        <!-- Footer Social Links Start -->
                        <div class="footer-social-links">
                            <h3>{{ $sections->get('global.footer')?->title ?? 'Follow Us' }}</h3>
                            <ul>
                                @if($siteSettings?->facebook_url)<li><a href="{{ $siteSettings->facebook_url }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-facebook-f"></i></a></li>@endif
                                @if($siteSettings?->youtube_url)<li><a href="{{ $siteSettings->youtube_url }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-youtube"></i></a></li>@endif
                                @if($siteSettings?->instagram_url)<li><a href="{{ $siteSettings->instagram_url }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-instagram"></i></a></li>@endif
                                @if($siteSettings?->twitter_url)<li><a href="{{ $siteSettings->twitter_url }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-x-twitter"></i></a></li>@endif
                                @if($siteSettings?->pinterest_url)<li><a href="{{ $siteSettings->pinterest_url }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-pinterest-p"></i></a></li>@endif
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
                        <div class="footer-links">
                            <h3>{{ $sections->get('global.footer_quick_links')?->title ?? 'Quick Links' }}</h3>
                            <ul>
                                @forelse($footerNavItems ?? collect() as $navItem)
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
                            <h3>{{ $sections->get('global.footer_services')?->title ?? 'services' }}</h3>
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
                            <h3>{{ $sections->get('global.footer_support')?->title ?? 'support' }}</h3>
                            <ul>
                                <li><a href="{{ route('contact.index') }}">{{ $sections->get('global.footer_support')?->subtitle ?? 'help' }}</a></li>
                                <li><a href="{{ $sections->get('global.footer_support')?->button_url ?? '#' }}">privacy policy</a></li>
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
                        <p>Copyright &copy; {{ date('Y') }} {{ $siteSettings?->site_name ?? config('app.name') }}. {{ $siteSettings?->footer_copyright ?? 'All Rights Reserved.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Copyright End -->
</footer>
<!-- Main Footer Section End -->
