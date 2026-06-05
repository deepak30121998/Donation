@php
    $phone    = $settings['phone']    ?? '+123 456 789';
    $email    = $settings['email']    ?? 'info@domainname.com';
    $social   = $settings['social']   ?? [];
    $pinterest = $social['pinterest'] ?? '#';
    $twitter   = $social['twitter']   ?? '#';
    $facebook  = $social['facebook']  ?? '#';
    $instagram = $social['instagram'] ?? '#';
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
                            <img src="{{ asset('images/footer-logo.svg') }}" alt="Logo">
                        </div>
                        <!-- Footer Logo End -->

                        <!-- Footer Contact Detail Start -->
                        <div class="footer-contact-detail">
                            <div class="footer-contact-item">
                                <p>Toll free customer care</p>
                                <h3><a href="tel:{{ preg_replace('/\s+/', '', $phone) }}">{{ $phone }}</a></h3>
                            </div>

                            <div class="footer-contact-item">
                                <p>Need live support!</p>
                                <h3><a href="mailto:{{ $email }}">{{ $email }}</a></h3>
                            </div>
                        </div>
                        <!-- Footer Contact Detail End -->

                        <!-- Footer Social Links Start -->
                        <div class="footer-social-links">
                            <h3>Follow on</h3>
                            <ul>
                                @if($pinterest !== '#')
                                    <li><a href="{{ $pinterest }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-pinterest-p"></i></a></li>
                                @else
                                    <li><a href="#"><i class="fa-brands fa-pinterest-p"></i></a></li>
                                @endif

                                @if($twitter !== '#')
                                    <li><a href="{{ $twitter }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-x-twitter"></i></a></li>
                                @else
                                    <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                                @endif

                                @if($facebook !== '#')
                                    <li><a href="{{ $facebook }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-facebook-f"></i></a></li>
                                @else
                                    <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                @endif

                                @if($instagram !== '#')
                                    <li><a href="{{ $instagram }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-instagram"></i></a></li>
                                @else
                                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                @endif
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
                            <h3>Quick link</h3>
                            <ul>
                                <li><a href="{{ route('home') }}">home</a></li>
                                <li><a href="{{ route('about') }}">about us</a></li>
                                <li><a href="{{ route('services.index') }}">services</a></li>
                                <li><a href="{{ route('blog.index') }}">blog</a></li>
                            </ul>
                        </div>
                        <!-- Quick Links End -->

                        <!-- Footer Service Links Start -->
                        <div class="footer-links footer-service-links">
                            <h3>services</h3>
                            <ul>
                                <li><a href="{{ route('services.index') }}">food security initiatives</a></li>
                                <li><a href="{{ route('services.index') }}">healthcare access</a></li>
                                <li><a href="{{ route('services.index') }}">educational support</a></li>
                                <li><a href="{{ route('services.index') }}">youth development</a></li>
                            </ul>
                        </div>
                        <!-- Footer Service Links End -->

                        <!-- Support Links Start -->
                        <div class="footer-links">
                            <h3>support</h3>
                            <ul>
                                <li><a href="{{ route('contact.index') }}">help</a></li>
                                <li><a href="#">privacy policy</a></li>
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
                        <p>Copyright &copy; {{ date('Y') }} All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Copyright End -->
</footer>
<!-- Main Footer Section End -->
