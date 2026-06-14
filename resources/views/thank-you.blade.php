<x-layouts.app title="Thank You">

    <x-page-header
        title="Thank <span>You</span>"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Thank You', 'url' => ''],
        ]"
    />

    <div class="page-thank-you" style="padding: 100px 0;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="thank-you-box wow fadeInUp"
                         style="text-align:center;background:#fff;border:1px solid #eef0f2;border-radius:20px;padding:55px 40px;box-shadow:0 10px 40px rgba(2,13,25,0.06);">

                        <div style="width:90px;height:90px;margin:0 auto 26px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:#e8f7ee;">
                            <i class="fa-solid {{ $context['icon'] ?? 'fa-circle-check' }}" style="font-size:38px;color:#1a7a3f;"></i>
                        </div>

                        <h2 class="text-anime-style-2" data-cursor="-opaque" style="margin-bottom:16px;">
                            {!! $context['title'] ?? 'Thank You!' !!}
                        </h2>

                        <p style="max-width:560px;margin:0 auto 32px;">
                            {{ $context['message'] ?? 'We appreciate you getting in touch with Ujjawal Unnati Foundation.' }}
                        </p>

                        <div style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap;">
                            <a href="{{ route('home') }}" class="btn-default">Back to Home</a>
                            <a href="{{ route('donation.index') }}" class="btn-default btn-highlighted">Donate Now</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
