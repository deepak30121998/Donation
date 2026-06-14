<x-layouts.app title="Contact Us">

    <x-page-header
        title="{{ $sections->get('contact.hero')?->title ?? 'Contact' }} <span>Us</span>"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Contact Us', 'url' => ''],
        ]"
    />

    {{-- Contact Info Bar --}}
    <div class="page-contact-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-info-box">

                        {{-- Phone --}}
                        <div class="contact-info-item wow fadeInUp">
                            <div class="icon-box">
                                <img src="{{ asset('images/icon-phone-primary.svg') }}" alt="">
                            </div>
                            <div class="contact-info-content">
                                <h3>contact us</h3>
                                <p><a href="tel:{{ $siteSettings?->phone ?? '+91-8130789837' }}">{{ $siteSettings?->phone ?? '+91-8130789837' }}</a></p>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="contact-info-item wow fadeInUp" data-wow-delay="0.2s">
                            <div class="icon-box">
                                <img src="{{ asset('images/icon-mail.svg') }}" alt="">
                            </div>
                            <div class="contact-info-content">
                                <h3>e-mail us</h3>
                                <p><a href="mailto:{{ $siteSettings?->email ?? 'info@ujjawalunnati.com' }}">{{ $siteSettings?->email ?? 'info@ujjawalunnati.com' }}</a></p>
                            </div>
                        </div>

                        {{-- Address --}}
                        <div class="contact-info-item wow fadeInUp" data-wow-delay="0.4s">
                            <div class="icon-box">
                                <img src="{{ asset('images/icon-location.svg') }}" alt="">
                            </div>
                            <div class="contact-info-content">
                                <h3>location</h3>
                                <p>{{ $siteSettings?->address ?? 'Sector 12, Noida, Gautam Budh Nagar 201301, India' }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Contact Info Bar End --}}

    {{-- Map + Form --}}
    <div class="contact-form-section">
        <div class="container-fluid">
            <div class="row no-gutters">

                {{-- Google Map --}}
                <div class="col-lg-6 order-lg-1 order-2">
                    <div class="google-map-iframe">
                        <iframe
                            src="{{ $siteSettings?->maps_embed_url ?: 'https://maps.google.com/maps?q=Sector+12,+Noida,+Gautam+Budh+Nagar+201301,+Uttar+Pradesh,+India&t=&z=15&ie=UTF8&iwloc=&output=embed' }}"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                {{-- Contact Form --}}
                <div class="col-lg-6 order-lg-2 order-1">
                    <div class="contact-form-box">

                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{ $sections->get('contact.intro')?->subtitle ?? 'contact us' }}</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $sections->get('contact.intro')?->title ?? 'Book an Appointment' }}</h2>
                            @if($sections->get('contact.intro')?->body)
                                <p class="wow fadeInUp" data-wow-delay="0.2s">{{ $sections->get('contact.intro')->body }}</p>
                            @endif
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger mb-4">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="contact-form">
                            <form id="contactForm"
                                  action="{{ route('contact.store') }}"
                                  method="POST"
                                  data-toggle="validator"
                                  class="wow fadeInUp"
                                  data-wow-delay="0.2s">
                                @csrf
                                <div class="row">

                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text"
                                               name="first_name"
                                               class="form-control @error('first_name') is-invalid @enderror"
                                               id="fname"
                                               placeholder="First name"
                                               value="{{ old('first_name') }}"
                                               required>
                                        @error('first_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text"
                                               name="last_name"
                                               class="form-control @error('last_name') is-invalid @enderror"
                                               id="lname"
                                               placeholder="Last name"
                                               value="{{ old('last_name') }}"
                                               required>
                                        @error('last_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-12 mb-4">
                                        <input type="email"
                                               name="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               id="email"
                                               placeholder="Enter your e-mail"
                                               value="{{ old('email') }}"
                                               required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-12 mb-4">
                                        <input type="text"
                                               name="phone"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               id="phone"
                                               placeholder="Enter your phone no."
                                               value="{{ old('phone') }}">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-12 mb-5">
                                        <textarea name="message"
                                                  class="form-control @error('message') is-invalid @enderror"
                                                  id="message"
                                                  rows="4"
                                                  placeholder="Write message">{{ old('message') }}</textarea>
                                        @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <button type="submit" class="btn-default"><span>send message</span></button>
                                        <div id="msgSubmit" class="h3 hidden"></div>
                                    </div>

                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                {{-- Contact Form End --}}

            </div>
        </div>
    </div>
    {{-- Map + Form End --}}

</x-layouts.app>
