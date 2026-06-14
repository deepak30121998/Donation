<x-layouts.app
    :title="$sections->get('donation.hero')?->title ?? 'Make a Donation'"
    description="Donate to Ujjawal Unnati Foundation and support women empowerment, cow protection, child education, and hunger relief. 80G tax-exempt — every rupee reaches those who need it most.">

    <x-page-header
        title="Make a <span>Donation</span>"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Donation', 'url' => ''],
        ]"
    />

    <div class="page-donation">
        <div class="container">
            <div class="row">

                {{-- Left: Donation Form --}}
                <div class="col-lg-8">
                    <div class="donation-box" style="padding: 50px 60px;">

                        @if (session('success'))
                            <div class="alert alert-success mb-4 wow fadeInUp" style="border-radius:12px;border:none;background:#e8f7ee;">
                                <strong style="color:#1a7a3f;">{{ session('success') }}</strong>
                                <p class="mb-0 mt-1" style="font-size:0.9rem;color:#2d6a4f;">For 80G certificate, share your PAN at <a href="mailto:{{ $siteSettings?->email ?? 'info@ujjawalunnati.com' }}">{{ $siteSettings?->email ?? 'info@ujjawalunnati.com' }}</a>.</p>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger mb-4" style="border-radius:12px;border:none;">
                                <strong>{{ session('error') }}</strong>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger mb-4" style="border-radius:12px;border:none;">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{ $sections->get('donation.intro')?->subtitle ?? 'Donate Now' }}</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">{{ $sections->get('donation.intro')?->title ?? 'Your Generosity Changes Lives' }}</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">{!! $sections->get('donation.intro')?->body ?? 'Your generous support enables us to care for abandoned cows, empower women, educate children, and feed families in need.' !!}</p>
                        </div>

                        <x-donation-form
                            :causes="$causes"
                            :donationAmounts="$donationAmounts"
                            :defaultAmount="$defaultAmount"
                            :razorpayKeyId="$razorpayKeyId"
                        />

                    </div>
                </div>

                {{-- Right: Donation Info Sidebar --}}
                <div class="col-lg-4">
                    <div class="page-single-sidebar">

                        {{-- Card 1: How Your Donation Helps --}}
                        <div class="page-sidebar-catagery-list wow fadeInUp">
                            <h3>How Your Donation Helps</h3>
                            <ul style="padding: 25px 30px; margin:0; list-style:none;">
                                <li>
                                    <div style="display:flex;align-items:center;gap:12px;">
                                        <span style="background:var(--accent-color);color:#fff;font-weight:700;font-size:0.85rem;padding:4px 10px;border-radius:20px;white-space:nowrap;">₹500</span>
                                        <span>Feeds a cow for one month</span>
                                    </div>
                                </li>
                                <li>
                                    <div style="display:flex;align-items:center;gap:12px;">
                                        <span style="background:var(--accent-color);color:#fff;font-weight:700;font-size:0.85rem;padding:4px 10px;border-radius:20px;white-space:nowrap;">₹1,100</span>
                                        <span>School kit for one child</span>
                                    </div>
                                </li>
                                <li>
                                    <div style="display:flex;align-items:center;gap:12px;">
                                        <span style="background:var(--accent-color);color:#fff;font-weight:700;font-size:0.85rem;padding:4px 10px;border-radius:20px;white-space:nowrap;">₹2,100</span>
                                        <span>Skill training for one woman</span>
                                    </div>
                                </li>
                                <li>
                                    <div style="display:flex;align-items:center;gap:12px;">
                                        <span style="background:var(--accent-color);color:#fff;font-weight:700;font-size:0.85rem;padding:4px 10px;border-radius:20px;white-space:nowrap;">₹5,100</span>
                                        <span>Monthly ration for one family</span>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        {{-- Card 2: Active Causes with Progress --}}
                        @if ($causes && $causes->isNotEmpty())
                            <div class="page-sidebar-catagery-list wow fadeInUp" data-wow-delay="0.15s">
                                <h3>Our Active Causes</h3>
                                <div style="padding:25px 30px;">
                                    @foreach ($causes as $cause)
                                        <div class="skills-progress-bar" style="{{ !$loop->last ? 'margin-bottom:20px;padding-bottom:20px;border-bottom:1px solid var(--divider-color);' : '' }}">
                                            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
                                                <span style="font-weight:600;font-size:0.9rem;">{{ $cause->title }}</span>
                                                <span style="background:var(--accent-color);color:#fff;font-size:0.78rem;font-weight:700;padding:2px 9px;border-radius:20px;">{{ $cause->progress_percent }}%</span>
                                            </div>
                                            <div class="skill-progress" style="height:7px;">
                                                <div class="count-bar" style="width:{{ $cause->progress_percent }}%;"></div>
                                            </div>
                                            <div style="display:flex;justify-content:space-between;font-size:0.8rem;color:#888;margin-top:6px;">
                                                <span>Raised: ₹{{ number_format($cause->raised_amount) }}</span>
                                                <span>Goal: ₹{{ number_format($cause->goal_amount) }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Card 3: Bank Transfer Details --}}
                        <div class="page-sidebar-catagery-list wow fadeInUp" data-wow-delay="0.25s">
                            <h3>Bank Transfer Details</h3>
                            <ul style="padding:25px 30px;margin:0;list-style:none;">
                                <li>
                                    <div style="display:flex;justify-content:space-between;align-items:center;">
                                        <span style="color:#888;font-size:0.88rem;">Bank</span>
                                        <span style="font-weight:600;font-size:0.9rem;">{{ $siteSettings?->bank_name ?? 'HDFC Bank' }}</span>
                                    </div>
                                </li>
                                <li>
                                    <div style="display:flex;justify-content:space-between;align-items:center;">
                                        <span style="color:#888;font-size:0.88rem;">Account No.</span>
                                        <span style="font-weight:600;font-size:0.9rem;letter-spacing:0.5px;">{{ $siteSettings?->bank_account_no ?? '50100321876635' }}</span>
                                    </div>
                                </li>
                                <li>
                                    <div style="display:flex;justify-content:space-between;align-items:center;">
                                        <span style="color:#888;font-size:0.88rem;">IFSC Code</span>
                                        <span style="font-weight:600;font-size:0.9rem;">{{ $siteSettings?->bank_ifsc ?? 'HDFC0001897' }}</span>
                                    </div>
                                </li>
                                <li>
                                    <div style="display:flex;justify-content:space-between;align-items:center;">
                                        <span style="color:#888;font-size:0.88rem;">Name</span>
                                        <span style="font-weight:600;font-size:0.88rem;text-align:right;max-width:60%;">{{ $siteSettings?->bank_account_name ?? 'Ujjawal Unnati Foundation' }}</span>
                                    </div>
                                </li>
                                <li style="border-bottom:none;margin-bottom:0;padding-bottom:0;">
                                    <p style="font-size:0.82rem;color:#aaa;margin:0;line-height:1.6;">Share transaction + PAN at <a href="mailto:{{ $siteSettings?->email ?? 'info@ujjawalunnati.com' }}" style="color:var(--accent-color);">{{ $siteSettings?->email ?? 'info@ujjawalunnati.com' }}</a> for receipt.</p>
                                </li>
                            </ul>
                        </div>

                        {{-- Card 4: 80G Tax Certificate --}}
                        <div class="sidebar-cta-box wow fadeInUp" data-wow-delay="0.35s">
                            <div class="icon-box">
                                <img src="{{ asset('images/icon-cta.svg') }}" alt="">
                            </div>
                            <div class="sidebar-cta-content">
                                <p>Tax Exemption Under 80G</p>
                                <h3>Donation is Tax Free</h3>
                            </div>
                            <p style="position:relative;z-index:1;font-size:0.83rem;color:rgba(255,255,255,0.8);margin:0 0 20px;line-height:1.7;">
                                Certificate Ref:<br>
                                <strong style="color:#fff;font-size:0.9rem;">AABTU3201CF20241</strong><br>
                                Income Tax Act 1961
                            </p>
                            <div class="sidebar-cta-btn">
                                <a href="{{ route('contact.index') }}" class="btn-default">Get Receipt</a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

</x-layouts.app>
