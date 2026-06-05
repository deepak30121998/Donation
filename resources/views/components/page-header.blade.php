@props([
    'title'       => '',
    'breadcrumbs' => [],
])

<!-- Page Header Start -->
<div class="page-header parallaxie" style="background-image: url('{{ asset('images/page-header-bg.jpg') }}');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-2" data-cursor="-opaque">{!! $title !!}</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            @foreach ($breadcrumbs as $crumb)
                                @if ($loop->last)
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ $crumb['label'] }}
                                    </li>
                                @else
                                    <li class="breadcrumb-item">
                                        <a href="{{ $crumb['url'] }}">{{ $crumb['label'] }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ol>
                    </nav>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->
