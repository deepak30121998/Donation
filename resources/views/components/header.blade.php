<header class="main-header">
    <div class="header-sticky">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <!-- Logo Start -->
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.svg') }}" alt="Logo">
                </a>
                <!-- Logo End -->

                <!-- Main Menu Start -->
                <div class="collapse navbar-collapse main-menu">
                    <div class="nav-menu-wrapper">
                        <ul class="navbar-nav mr-auto" id="menu">

                            <!-- Home -->
                            <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('home') }}">Home</a>
                            </li>

                            <!-- About Us -->
                            <li class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('about') }}">About Us</a>
                            </li>

                            <!-- Services -->
                            <li class="nav-item {{ request()->routeIs('services.*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('services.index') }}">Services</a>
                            </li>

                            <!-- Blog -->
                            <li class="nav-item {{ request()->routeIs('blog.*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('blog.index') }}">Blog</a>
                            </li>

                            <!-- Pages Dropdown -->
                            <li class="nav-item submenu {{ request()->routeIs('programs.*', 'team.*', 'testimonials', 'gallery.*', 'donation.*', 'faqs') ? 'active' : '' }}">
                                <a class="nav-link" href="#">Pages</a>
                                <ul>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('services.index') }}">Service Details</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('blog.index') }}">Blog Details</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('programs.index') }}">Our Programmes</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('programs.index') }}">Program Details</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('team') }}">Our Team</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('team') }}">Team Details</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('testimonials') }}">Testimonials</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('gallery') }}">Image Gallery</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('gallery') }}">Video Gallery</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('donation.index') }}">Donation</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('faqs') }}">FAQs</a></li>
                                </ul>
                            </li>

                            <!-- Contact Us -->
                            <li class="nav-item {{ request()->routeIs('contact.*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('contact.index') }}">Contact Us</a>
                            </li>

                        </ul>
                    </div>

                    <!-- Contact Now Box Start -->
                    <div class="contact-now-box">
                        <div class="icon-box">
                            <img src="{{ asset('images/icon-phone.svg') }}" alt="">
                        </div>
                        <div class="contact-now-box-content">
                            <p>need help !</p>
                            <h3><a href="tel:+01789987645">(+01) 789 987 645</a></h3>
                        </div>
                    </div>
                    <!-- Contact Now Box End -->
                </div>
                <!-- Main Menu End -->

                <div class="navbar-toggle"></div>
            </div>
        </nav>
        <div class="responsive-menu"></div>
    </div>
</header>
