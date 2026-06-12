<header class="main-header">
    <div class="header-sticky">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <!-- Logo Start -->
                <a class="navbar-brand" href="{{ route('home') }}">
                    @if(!empty($siteSettings?->logo_path))
                        <img src="{{ asset('storage/' . $siteSettings->logo_path) }}" alt="{{ $siteSettings->site_name }}">
                    @else
                        <img src="{{ asset('images/logo.png') }}" alt="{{ $siteSettings?->site_name ?? 'Ujjawal Unnati Foundation' }}" style="height:50px;width:auto;">
                    @endif
                </a>
                <!-- Logo End -->

                <!-- Main Menu Start -->
                <div class="collapse navbar-collapse main-menu">
                    <div class="nav-menu-wrapper">
                        <ul class="navbar-nav mr-auto" id="menu">
                            @foreach($navItems ?? [] as $item)
                                @if($item->children->isNotEmpty())
                                    <li class="nav-item submenu">
                                        <a class="nav-link" href="#">{{ $item->label }}</a>
                                        <ul>
                                            @foreach($item->children as $child)
                                                <li class="nav-item">
                                                    <a class="nav-link"
                                                       href="{{ $child->href }}"
                                                       @if($child->target === '_blank') target="_blank" rel="noopener noreferrer" @endif>
                                                        {{ $child->label }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li class="nav-item {{ request()->url() === $item->href ? 'active' : '' }}">
                                        <a class="nav-link"
                                           href="{{ $item->href }}"
                                           @if($item->target === '_blank') target="_blank" rel="noopener noreferrer" @endif>
                                            {{ $item->label }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>

                    <!-- Contact Now Box Start -->
                    @php $headerSect = $sections->get('global.header') ?? null; @endphp
                    <div class="contact-now-box">
                        <div class="icon-box">
                            <img src="{{ asset('images/icon-phone.svg') }}" alt="">
                        </div>
                        <div class="contact-now-box-content">
                            <p>{{ $headerSect?->subtitle ?? 'need help !' }}</p>
                            <h3><a href="tel:{{ preg_replace('/\s+/', '', $siteSettings?->phone ?? '') }}">{{ $siteSettings?->phone ?? '' }}</a></h3>
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
