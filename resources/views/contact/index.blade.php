<x-layouts.app title="Contact Us">

    <x-page-header
        title="<span>Contact</span> Us"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Contact Us', 'url' => ''],
        ]"
    />

    {{-- Contact Info --}}
    <div class="page-contact-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-info-box">
                        <div class="contact-info-item wow fadeInUp">
                            <div class="icon-box">
                                <img src="{{ asset('images/icon-phone-primary.svg') }}" alt="">
                            </div>
                            <div class="contact-info-content">
                                <h3>contact us</h3>
                                <p><a href="tel:+123456789">+123 456 789</a></p>
                                <p><a href="tel:+123456789">+123 456 789</a></p>
                            </div>
                        </div>

                        <div class="contact-info-item wow fadeInUp" data-wow-delay="0.2s">
                            <div class="icon-box">
                                <img src="{{ asset('images/icon-mail.svg') }}" alt="">
                            </div>
                            <div class="contact-info-content">
                                <h3>e-mail us</h3>
                                <p><a href="mailto:example@mail.com">example@mail.com</a></p>
                                <p><a href="mailto:domainname@gmail.com">domainname@gmail.com</a></p>
                            </div>
                        </div>

                        <div class="contact-info-item wow fadeInUp" data-wow-delay="0.4s">
                            <div class="icon-box">
                                <img src="{{ asset('images/icon-location.svg') }}" alt="">
                            </div>
                            <div class="contact-info-content">
                                <h3>location</h3>
                                <p>12345 Unity Avenue Suite 100 Springfield, USA 54321</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Contact Info End --}}

    {{-- Contact Form Section --}}
    <div class="contact-form-section">
        <div class="container-fluid">
            <div class="row no-gutters">
                <div class="col-lg-6 order-lg-1 order-2">
                    <div class="google-map-iframe">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96737.10562045308!2d-74.08535042841811!3d40.739265258395164!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sin!4v1703158537552!5m2!1sen!2sin"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                <div class="col-lg-6 order-lg-2 order-1">
                    <div class="contact-form-box">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{ $sections->get('contact.hero')?->subtitle ?? 'contact us' }}</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $sections->get('contact.hero')?->title ?? 'Get in to touch' }}</h2>
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
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Contact Form Section End --}}

</x-layouts.app>
