<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Receipt — Ujjawal Unnati Foundation</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; color: #333; }
        .wrapper { max-width: 600px; margin: 0 auto; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
        .header { background: #1a7a4a; padding: 36px 32px; text-align: center; }
        .header h1 { color: #fff; font-size: 22px; font-weight: 700; margin-bottom: 6px; }
        .header p { color: rgba(255,255,255,.85); font-size: 13px; }
        .thank-you { background: #f0f9f4; padding: 24px 32px; text-align: center; border-bottom: 1px solid #c3e6d4; }
        .thank-you h2 { font-size: 20px; color: #1a7a4a; margin-bottom: 8px; }
        .thank-you p { font-size: 14px; color: #555; }
        .amount-box { background: #1a7a4a; color: #fff; padding: 20px 32px; text-align: center; }
        .amount-box .amount { font-size: 36px; font-weight: 700; }
        .amount-box p { font-size: 13px; opacity: 0.85; margin-top: 4px; }
        .receipt { padding: 28px 32px; }
        .receipt h3 { font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; color: #999; margin-bottom: 16px; }
        .field { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #f0f0f0; font-size: 14px; }
        .field:last-child { border-bottom: none; }
        .field .label { color: #888; }
        .field .value { font-weight: 600; color: #222; }
        .impact { padding: 24px 32px; background: #f8f9fa; }
        .impact h3 { font-size: 15px; font-weight: 700; color: #1a7a4a; margin-bottom: 10px; }
        .impact p { font-size: 14px; color: #555; line-height: 1.6; }
        .footer { padding: 20px 32px; text-align: center; font-size: 12px; color: #aaa; line-height: 1.6; border-top: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>Ujjawal Unnati Foundation</h1>
            <p>Donation Receipt — Tax Exempt under Section 80G</p>
        </div>

        <div class="thank-you">
            <h2>Thank You, {{ $donation->donor_first_name }}!</h2>
            <p>Your generous donation has been received. This receipt is valid for tax exemption under Section 80G of the Income Tax Act.</p>
        </div>

        <div class="amount-box">
            <div class="amount">₹{{ number_format($donation->amount, 2) }}</div>
            <p>Donation Amount</p>
        </div>

        <div class="receipt">
            <h3>Transaction Details</h3>
            <div class="field">
                <span class="label">Donor Name</span>
                <span class="value">{{ $donation->donor_first_name }} {{ $donation->donor_last_name }}</span>
            </div>
            <div class="field">
                <span class="label">Email</span>
                <span class="value">{{ $donation->donor_email }}</span>
            </div>
            @if($donation->donor_phone)
            <div class="field">
                <span class="label">Phone</span>
                <span class="value">{{ $donation->donor_phone }}</span>
            </div>
            @endif
            @if($donation->cause)
            <div class="field">
                <span class="label">Cause</span>
                <span class="value">{{ $donation->cause->title }}</span>
            </div>
            @endif
            <div class="field">
                <span class="label">Payment Method</span>
                <span class="value">{{ $donation->payment_method?->label() ?? '' }}</span>
            </div>
            @if($donation->transaction_id)
            <div class="field">
                <span class="label">Transaction ID</span>
                <span class="value">{{ $donation->transaction_id }}</span>
            </div>
            @endif
            <div class="field">
                <span class="label">Date</span>
                <span class="value">{{ $donation->donated_at?->format('d M Y, h:i A') ?? $donation->created_at->format('d M Y, h:i A') }}</span>
            </div>
            <div class="field">
                <span class="label">Status</span>
                <span class="value" style="color:#1a7a4a;">{{ $donation->status?->label() ?? '' }}</span>
            </div>
        </div>

        <div class="impact">
            <h3>Your Impact</h3>
            <p>Your donation goes directly to our programs — Gau Sewa, free education, women empowerment training, and monthly ration drives. We maintain 100% transparency. Thank you for making a difference.</p>
        </div>

        <div class="footer">
            <p><strong>Ujjawal Unnati Foundation</strong></p>
            <p>Sector 12, Noida, Gautam Budh Nagar 201301, India</p>
            <p>+91-8130789837 &nbsp;|&nbsp; info@ujjawalunnati.com</p>
            <p style="margin-top:10px; color:#ccc;">Auto-generated receipt. For queries contact info@ujjawalunnati.com</p>
        </div>
    </div>
</body>
</html>
