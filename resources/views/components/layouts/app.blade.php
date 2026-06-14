@props([
    'title' => null,
    'description' => '',
    'keywords' => '',
    'ogImage' => null,
    'ogType' => 'website',
    'robots' => 'index, follow',
    'canonical' => null,
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">

    <!-- Page Title & SEO -->
    <title>{{ $title ? $title . ' — ' . ($siteSettings?->site_name ?? config('app.name', 'Ujjawal Unnati Foundation')) : (($siteSettings?->site_name ?? config('app.name', 'Ujjawal Unnati Foundation')) . ' — ' . ($siteSettings?->site_tagline ?: 'Charity & Donation NGO')) }}</title>
    <meta name="description" content="{{ \Illuminate\Support\Str::limit(trim(strip_tags($description ?: ($siteSettings?->footer_about_text ?: ($siteSettings?->site_tagline ?? '')))), 160, '') }}">
    <meta name="keywords" content="{{ $keywords ?: 'Ujjawal Unnati Foundation, NGO India, women empowerment, gau sewa, cow protection, child education, child labour, hunger relief, donate, charity Noida' }}">
    <meta name="robots" content="{{ $robots }}">
    <meta name="author" content="{{ $siteSettings?->site_name ?? config('app.name', 'Ujjawal Unnati Foundation') }}">
    <link rel="canonical" href="{{ $canonical ?? url()->current() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Open Graph -->
    <meta property="og:type" content="{{ $ogType }}">
    <meta property="og:site_name" content="{{ $siteSettings?->site_name ?? config('app.name') }}">
    <meta property="og:title" content="{{ $title ? $title . ' — ' . ($siteSettings?->site_name ?? config('app.name')) : ($siteSettings?->site_name ?? config('app.name')) }}">
    <meta property="og:description" content="{{ \Illuminate\Support\Str::limit(trim(strip_tags($description ?: ($siteSettings?->footer_about_text ?: ($siteSettings?->site_tagline ?? '')))), 200, '') }}">
    <meta property="og:url" content="{{ $canonical ?? url()->current() }}">
    <meta property="og:image" content="{{ $ogImage ?: ($siteSettings?->logo_path ? asset('storage/'.$siteSettings->logo_path) : asset('images/logo.png')) }}">
    <meta property="og:locale" content="en_IN">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? ($siteSettings?->site_name ?? config('app.name')) }}">
    <meta name="twitter:description" content="{{ \Illuminate\Support\Str::limit(trim(strip_tags($description ?: ($siteSettings?->footer_about_text ?: ($siteSettings?->site_tagline ?? '')))), 200, '') }}">
    <meta name="twitter:image" content="{{ $ogImage ?: ($siteSettings?->logo_path ? asset('storage/'.$siteSettings->logo_path) : asset('images/logo.png')) }}">

    <!-- Structured Data: Organization + WebSite -->
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'NGO',
        'name' => $siteSettings?->site_name ?? 'Ujjawal Unnati Foundation',
        'alternateName' => 'UUF',
        'url' => url('/'),
        'logo' => $siteSettings?->logo_path ? asset('storage/'.$siteSettings->logo_path) : asset('images/logo.png'),
        'description' => strip_tags($siteSettings?->footer_about_text ?? ''),
        'email' => $siteSettings?->email ?: null,
        'telephone' => $siteSettings?->phone ?: null,
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => $siteSettings?->address ?? '',
            'addressLocality' => 'Noida',
            'addressRegion' => 'Uttar Pradesh',
            'postalCode' => '201301',
            'addressCountry' => 'IN',
        ],
        'sameAs' => array_values(array_filter([
            $siteSettings?->facebook_url, $siteSettings?->youtube_url,
            $siteSettings?->instagram_url, $siteSettings?->twitter_url, $siteSettings?->pinterest_url,
        ])),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => $siteSettings?->site_name ?? 'Ujjawal Unnati Foundation',
        'url' => url('/'),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>

    @stack('jsonld')

    <!-- Favicon Icon -->
    <link rel="shortcut icon" href="{{ !empty($siteSettings?->favicon_path) ? asset('storage/' . $siteSettings->favicon_path) : asset('images/favicon.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Onest:wght@100..900&display=swap" rel="stylesheet">

    <!-- Bootstrap Css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" media="screen">
    <!-- SlickNav Css -->
    <link href="{{ asset('css/slicknav.min.css') }}" rel="stylesheet">
    <!-- Swiper Css -->
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <!-- Font Awesome Icon Css -->
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet" media="screen">
    <!-- Animated Css -->
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <!-- Magnific Popup Core Css File -->
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <!-- Mouse Cursor Css File -->
    <link rel="stylesheet" href="{{ asset('css/mousecursor.css') }}">
    <!-- Main Custom Css -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" media="screen">

    @stack('styles')
</head>
<body>

    <!-- Preloader Start -->
    <div class="preloader">
        <div class="loading-container">
            <div class="loading"></div>
            <div id="loading-icon"><img src="{{ asset('images/loader.svg') }}" alt=""></div>
        </div>
    </div>
    <!-- Preloader End -->

    <!-- Header Start -->
    <x-header />
    <!-- Header End -->

    <!-- Main Content -->
    {{ $slot }}
    <!-- Main Content End -->

    <!-- Footer Start -->
    <x-footer />
    <!-- Footer End -->

    <!-- jQuery Library File -->
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <!-- Bootstrap js file -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Validator js file -->
    <script src="{{ asset('js/validator.min.js') }}"></script>
    <!-- SlickNav js file -->
    <script src="{{ asset('js/jquery.slicknav.js') }}"></script>
    <!-- Swiper js file -->
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
    <!-- Counter js file -->
    <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <!-- Isotope js file -->
    <script src="{{ asset('js/isotope.min.js') }}"></script>
    <!-- Magnific js file -->
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <!-- SmoothScroll -->
    <script src="{{ asset('js/SmoothScroll.js') }}"></script>
    <!-- Parallax js -->
    <script src="{{ asset('js/parallaxie.js') }}"></script>
    <!-- MagicCursor js file -->
    <script src="{{ asset('js/gsap.min.js') }}"></script>
    <script src="{{ asset('js/magiccursor.js') }}"></script>
    <!-- Text Effect js file -->
    <script src="{{ asset('js/SplitText.js') }}"></script>
    <script src="{{ asset('js/ScrollTrigger.min.js') }}"></script>
    <!-- YTPlayer js File -->
    <script src="{{ asset('js/jquery.mb.YTPlayer.min.js') }}"></script>
    <!-- Wow js file -->
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <!-- Main Custom js file -->
    <script src="{{ asset('js/function.js') }}"></script>

    @stack('scripts')
</body>
</html>
