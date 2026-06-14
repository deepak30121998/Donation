<x-layouts.app title="Thank You">

    <x-page-header
        title="Thank <span>You</span>"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Donation', 'url' => route('donation.index')],
            ['label' => 'Thank You', 'url' => ''],
        ]"
    />

    <div class="page-thank-you" style="padding: 100px 0;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="thank-you-box wow fadeInUp"
                         style="text-align:center;background:#fff;border:1px solid #eef0f2;border-radius:20px;padding:50px 40px;box-shadow:0 10px 40px rgba(2,13,25,0.06);">

                        {{-- Icon --}}
                        <div style="width:90px;height:90px;margin:0 auto 24px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:#e8f7ee;">
                            <i class="fa-solid fa-heart" style="font-size:38px;color:#1a7a3f;"></i>
                        </div>

                        @if ($donation->status->value === 'completed')
                            <h2 class="text-anime-style-2" data-cursor="-opaque" style="margin-bottom:14px;">
                                Thank You for Your <span>Generous Donation!</span>
                            </h2>
                            <p style="max-width:560px;margin:0 auto 30px;">
                                Your contribution of <strong>₹{{ number_format((float) $donation->amount) }}</strong>
                                has been received successfully. Your support helps us empower communities,
                                protect cows, educate children, and fight hunger across India.
                            </p>
                        @else
                            <h2 class="text-anime-style-2" data-cursor="-opaque" style="margin-bottom:14px;">
                                Thank You — Your Donation is <span>Almost There!</span>
                            </h2>
                            <p style="max-width:560px;margin:0 auto 30px;">
                                We have recorded your donation request of
                                <strong>₹{{ number_format((float) $donation->amount) }}</strong>.
                                Please complete the bank transfer using the details on the donation page.
                                Once we receive the payment, we will confirm it and email your receipt.
                            </p>
                        @endif

                        {{-- Details --}}
                        <div style="max-width:480px;margin:0 auto 32px;text-align:left;border-top:1px dashed #e2e6ea;border-bottom:1px dashed #e2e6ea;padding:22px 0;">
                            <div style="display:flex;justify-content:space-between;padding:7px 0;">
                                <span style="color:#6b7280;">Donor</span>
                                <strong>{{ $donation->donor_full_name }}</strong>
                            </div>
                            <div style="display:flex;justify-content:space-between;padding:7px 0;">
                                <span style="color:#6b7280;">Amount</span>
                                <strong>₹{{ number_format((float) $donation->amount) }}</strong>
                            </div>
                            @if ($donation->cause)
                                <div style="display:flex;justify-content:space-between;padding:7px 0;">
                                    <span style="color:#6b7280;">Cause</span>
                                    <strong>{{ $donation->cause->title }}</strong>
                                </div>
                            @endif
                            <div style="display:flex;justify-content:space-between;padding:7px 0;">
                                <span style="color:#6b7280;">Payment Method</span>
                                <strong>{{ $donation->payment_method->label() }}</strong>
                            </div>
                            <div style="display:flex;justify-content:space-between;padding:7px 0;">
                                <span style="color:#6b7280;">Status</span>
                                <strong style="color:{{ $donation->status->value === 'completed' ? '#1a7a3f' : '#b8860b' }};">
                                    {{ $donation->status->label() }}
                                </strong>
                            </div>
                            @if ($donation->transaction_id)
                                <div style="display:flex;justify-content:space-between;padding:7px 0;">
                                    <span style="color:#6b7280;">Payment ID</span>
                                    <strong style="font-family:monospace;">{{ $donation->transaction_id }}</strong>
                                </div>
                            @endif
                        </div>

                        {{-- Actions --}}
                        <div style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap;">
                            <a href="{{ route('home') }}" class="btn-default">Back to Home</a>
                            <a href="{{ route('donation.index') }}" class="btn-default btn-highlighted">Donate Again</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
