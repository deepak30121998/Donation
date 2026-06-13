@props([
    'causes'          => null,
    'donationAmounts' => ['500', '1100', '2100', '5100'],
    'defaultAmount'   => '500',
    'razorpayKeyId'   => null,
])

{{-- Hidden form: offline/bank transfer --}}
<form id="donateFormOffline" action="{{ route('donation.store') }}" method="POST" style="display:none;">
    @csrf
    <input type="hidden" name="donor_first_name" id="off_fname">
    <input type="hidden" name="donor_last_name"  id="off_lname">
    <input type="hidden" name="donor_email"      id="off_email">
    <input type="hidden" name="donor_phone"      id="off_phone">
    <input type="hidden" name="donor_pan"        id="off_pan">
    <input type="hidden" name="donor_address"    id="off_address">
    <input type="hidden" name="amount"           id="off_amount">
    <input type="hidden" name="payment_method"   id="off_method">
    <input type="hidden" name="cause_id"         id="off_cause">
    <input type="hidden" name="message"          id="off_message">
</form>

{{-- Hidden form: Razorpay verify --}}
<form id="donateFormVerify" action="{{ route('donation.verify') }}" method="POST" style="display:none;">
    @csrf
    <input type="hidden" name="razorpay_order_id"   id="rzp_order_id">
    <input type="hidden" name="razorpay_payment_id" id="rzp_payment_id">
    <input type="hidden" name="razorpay_signature"  id="rzp_signature">
    <input type="hidden" name="donation_id"         id="rzp_donation_id">
</form>

<!-- Donation Form -->
<div class="donate-form campaign-donate-form" style="padding-top:10px;">

    <div id="donationFormError" class="alert alert-danger mb-4" style="display:none;border-radius:10px;border:none;font-size:0.92rem;"></div>

    {{-- ── Step 1: Amount ── --}}
    <div class="df-section wow fadeInUp" data-wow-delay="0.2s">
        <p class="df-label">Select or enter donation amount</p>

        <div class="df-amount-grid">
            @foreach($donationAmounts as $i => $amt)
                <button type="button"
                        class="df-amt-btn {{ $defaultAmount === $amt ? 'active' : '' }}"
                        data-amount="{{ $amt }}">
                    ₹ {{ number_format((float)$amt) }}
                </button>
            @endforeach
            <button type="button" class="df-amt-btn" data-amount="other">Other</button>
        </div>

        <div id="customAmountWrap" style="display:none;margin-top:14px;">
            <input type="number"
                   id="custom_amount"
                   class="form-control"
                   placeholder="Enter amount in ₹"
                   min="1"
                   inputmode="numeric"
                   style="font-size:1rem;height:50px;">
        </div>
    </div>

    {{-- ── Step 2: Cause (optional) ── --}}
    @if ($causes && $causes->isNotEmpty())
        <div class="df-section wow fadeInUp" data-wow-delay="0.3s">
            <p class="df-label">Select a cause <span style="font-weight:400;color:#aaa;">(optional)</span></p>
            <select id="cause_id" class="form-control" style="height:50px;font-size:0.95rem;">
                <option value="">-- No specific cause --</option>
                @foreach ($causes as $cause)
                    <option value="{{ $cause->id }}" {{ request('cause') == $cause->id ? 'selected' : '' }}>
                        {{ $cause->title }}
                    </option>
                @endforeach
            </select>
        </div>
    @endif

    {{-- ── Step 3: Payment Method ── --}}
    <div class="df-section wow fadeInUp" data-wow-delay="0.4s">
        <p class="df-label">Payment method</p>
        <div class="df-payment-grid">
            <label class="df-pay-option active" for="payment_online">
                <input type="radio" id="payment_online" name="payment_method" value="online" checked style="display:none;">
                <span class="df-pay-icon">💳</span>
                <span class="df-pay-text">
                    <strong>Online</strong>
                    <small>UPI / Card / Net Banking</small>
                </span>
            </label>
            <label class="df-pay-option" for="payment_offline">
                <input type="radio" id="payment_offline" name="payment_method" value="offline" style="display:none;">
                <span class="df-pay-icon">🏦</span>
                <span class="df-pay-text">
                    <strong>Bank Transfer</strong>
                    <small>NEFT / RTGS / IMPS</small>
                </span>
            </label>
        </div>
    </div>

    {{-- ── Step 4: Personal Info ── --}}
    <div class="df-section wow fadeInUp" data-wow-delay="0.5s">
        <p class="df-label">Your details</p>
        <div class="row g-3">
            <div class="col-sm-6">
                <input type="text" id="donor_first_name" class="form-control" placeholder="First name *" style="height:50px;">
            </div>
            <div class="col-sm-6">
                <input type="text" id="donor_last_name" class="form-control" placeholder="Last name *" style="height:50px;">
            </div>
            <div class="col-sm-6">
                <input type="email" id="donor_email" class="form-control" placeholder="Email address *" style="height:50px;">
            </div>
            <div class="col-sm-6">
                <input type="tel" id="donor_phone" class="form-control" placeholder="Phone number" style="height:50px;">
            </div>
            <div class="col-sm-6">
                <input type="text" id="donor_pan" class="form-control"
                       placeholder="PAN number (for 80G)"
                       maxlength="10"
                       style="height:50px;text-transform:uppercase;">
            </div>
            <div class="col-sm-6">
                <input type="text" id="donor_address" class="form-control" placeholder="Address (for receipt)" style="height:50px;">
            </div>
            <div class="col-12">
                <textarea id="donor_message" class="form-control" rows="3"
                          placeholder="Message (optional)"
                          style="resize:vertical;"></textarea>
            </div>
        </div>
    </div>

    {{-- ── Submit ── --}}
    <div class="df-section wow fadeInUp" data-wow-delay="0.6s" style="margin-bottom:0;">
        <button type="button" id="donateBtn" class="btn-default" style="width:100%;justify-content:center;font-size:1rem;padding:16px 30px;">
            Donate Now
        </button>
        <div id="donateBtnSpinner" style="display:none;text-align:center;margin-top:12px;font-size:0.88rem;color:#888;">
            Processing, please wait…
        </div>
    </div>

</div>

<style>
.df-section { margin-bottom: 28px; }
.df-label {
    font-size: 0.78rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: #888;
    margin-bottom: 10px;
}
.df-amount-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}
.df-amt-btn {
    flex: 1 1 calc(25% - 10px);
    min-width: 90px;
    padding: 12px 8px;
    border: 2px solid #e5e5e5;
    border-radius: 10px;
    background: #fff;
    font-size: 0.95rem;
    font-weight: 600;
    color: #333;
    cursor: pointer;
    transition: all 0.2s;
    text-align: center;
}
.df-amt-btn:hover { border-color: var(--accent-color); color: var(--accent-color); }
.df-amt-btn.active {
    background: var(--accent-color);
    border-color: var(--accent-color);
    color: #fff;
}
.df-payment-grid {
    display: flex;
    gap: 12px;
}
.df-pay-option {
    flex: 1;
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 18px;
    border: 2px solid #e5e5e5;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.2s;
    background: #fff;
}
.df-pay-option:hover { border-color: var(--accent-color); }
.df-pay-option.active {
    border-color: var(--accent-color);
    background: #fff8f5;
}
.df-pay-icon { font-size: 1.4rem; line-height: 1; }
.df-pay-text { display: flex; flex-direction: column; gap: 2px; }
.df-pay-text strong { font-size: 0.92rem; color: #222; }
.df-pay-text small { font-size: 0.78rem; color: #888; }
@media (max-width: 480px) {
    .df-amt-btn { flex: 1 1 calc(33% - 10px); }
    .df-payment-grid { flex-direction: column; }
}
</style>

{{-- Razorpay --}}
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
(function () {
    const RZP_KEY = "{{ $razorpayKeyId }}";
    const CREATE_ORDER_URL = "/donation/create-order";

    // ── Amount button toggle ─────────────────────────────────────────────
    let selectedPreset = "{{ $defaultAmount }}";

    document.querySelectorAll('.df-amt-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.df-amt-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const val = btn.dataset.amount;
            if (val === 'other') {
                selectedPreset = null;
                document.getElementById('customAmountWrap').style.display = 'block';
                document.getElementById('custom_amount').focus();
            } else {
                selectedPreset = val;
                document.getElementById('customAmountWrap').style.display = 'none';
                document.getElementById('custom_amount').value = '';
            }
        });
    });

    // ── Payment method toggle ────────────────────────────────────────────
    document.querySelectorAll('input[name="payment_method"]').forEach(function (radio) {
        radio.addEventListener('change', function () {
            document.querySelectorAll('.df-pay-option').forEach(el => el.classList.remove('active'));
            radio.closest('.df-pay-option').classList.add('active');
        });
    });

    // ── Helpers ──────────────────────────────────────────────────────────
    function getCsrfToken() {
        const meta = document.querySelector('meta[name="csrf-token"]');
        if (meta?.content) return meta.content;
        const match = document.cookie.match(/(?:^|;\s*)XSRF-TOKEN=([^;]+)/);
        return match ? decodeURIComponent(match[1]) : '';
    }

    function getAmount() {
        if (selectedPreset === null) {
            const v = parseFloat(document.getElementById('custom_amount')?.value ?? 0);
            return v > 0 ? v : 0;
        }
        return selectedPreset ? parseFloat(selectedPreset) : 0;
    }

    function getField(id) { return document.getElementById(id)?.value?.trim() ?? ''; }

    function showError(msg) {
        const el = document.getElementById('donationFormError');
        el.textContent = msg;
        el.style.display = 'block';
        el.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    function hideError() { document.getElementById('donationFormError').style.display = 'none'; }

    function setLoading(on) {
        const btn = document.getElementById('donateBtn');
        btn.disabled = on;
        btn.textContent = on ? 'Processing…' : 'Donate Now';
        document.getElementById('donateBtnSpinner').style.display = on ? 'block' : 'none';
    }

    function validateForm() {
        if (!getAmount() || getAmount() < 1) { showError('Please select or enter a valid amount (minimum ₹1).'); return false; }
        if (!getField('donor_first_name'))     { showError('Please enter your first name.'); return false; }
        if (!getField('donor_last_name'))      { showError('Please enter your last name.'); return false; }
        const email = getField('donor_email');
        if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { showError('Please enter a valid email address.'); return false; }
        return true;
    }

    function submitOffline(method) {
        document.getElementById('off_fname').value   = getField('donor_first_name');
        document.getElementById('off_lname').value   = getField('donor_last_name');
        document.getElementById('off_email').value   = getField('donor_email');
        document.getElementById('off_phone').value   = getField('donor_phone');
        document.getElementById('off_pan').value     = getField('donor_pan');
        document.getElementById('off_address').value = getField('donor_address');
        document.getElementById('off_amount').value  = getAmount();
        document.getElementById('off_method').value  = method;
        document.getElementById('off_cause').value   = getField('cause_id');
        document.getElementById('off_message').value = getField('donor_message');
        document.getElementById('donateFormOffline').submit();
    }

    // ── Submit ───────────────────────────────────────────────────────────
    document.getElementById('donateBtn').addEventListener('click', async function () {
        hideError();
        if (!validateForm()) return;

        const method = document.querySelector('input[name="payment_method"]:checked')?.value ?? 'online';

        if (method !== 'online') { submitOffline(method); return; }

        setLoading(true);
        let orderData;
        try {
            const resp = await fetch(CREATE_ORDER_URL, {
                method:  'POST',
                headers: {
                    'Content-Type':     'application/json',
                    'X-CSRF-TOKEN':     getCsrfToken(),
                    'Accept':           'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify({
                    donor_first_name: getField('donor_first_name'),
                    donor_last_name:  getField('donor_last_name'),
                    donor_email:      getField('donor_email'),
                    donor_phone:      getField('donor_phone') || null,
                    donor_pan:        getField('donor_pan')   || null,
                    donor_address:    getField('donor_address') || null,
                    amount:           getAmount(),
                    payment_method:   'online',
                    cause_id:         getField('cause_id') || null,
                    message:          getField('donor_message') || null,
                }),
            });

            const ct = resp.headers.get('content-type') ?? '';
            if (!ct.includes('application/json')) {
                const txt = await resp.text();
                console.error('Non-JSON response (' + resp.status + '):', txt.substring(0, 300));
                throw new Error(resp.status === 419
                    ? 'Session expired. Please refresh the page.'
                    : 'Server error. Please refresh and try again.');
            }

            orderData = await resp.json();
            if (!resp.ok) {
                throw new Error(orderData.error
                    ?? (orderData.errors ? Object.values(orderData.errors).flat().join(' ') : null)
                    ?? 'Please check your details and try again.');
            }
        } catch (err) {
            setLoading(false);
            showError(err.message);
            return;
        }

        setLoading(false);

        const rzp = new Razorpay({
            key:         RZP_KEY,
            amount:      orderData.amount,
            currency:    orderData.currency,
            name:        'Ujjawal Unnati Foundation',
            description: orderData.description,
            image:       '/images/logo.png',
            order_id:    orderData.order_id,
            prefill:     { name: orderData.name, email: orderData.email, contact: orderData.phone },
            theme:       { color: '#e8572a' },
            handler: function (response) {
                document.getElementById('rzp_order_id').value    = response.razorpay_order_id;
                document.getElementById('rzp_payment_id').value  = response.razorpay_payment_id;
                document.getElementById('rzp_signature').value   = response.razorpay_signature;
                document.getElementById('rzp_donation_id').value = orderData.donation_id;
                document.getElementById('donateFormVerify').submit();
            },
            modal: {
                ondismiss: function () {
                    showError('Payment cancelled. You have not been charged. Try again anytime.');
                },
            },
        });

        rzp.on('payment.failed', function (r) {
            showError('Payment failed: ' + (r.error?.description ?? 'Unknown error. Please try again.'));
        });

        rzp.open();
    });
})();
</script>
