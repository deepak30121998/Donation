<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Submission — Ujjawal Unnati Foundation</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; color: #333; }
        .wrapper { max-width: 600px; margin: 0 auto; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
        .header { background: #1a7a4a; padding: 28px 32px; text-align: center; }
        .header h1 { color: #fff; font-size: 20px; font-weight: 700; }
        .header p { color: rgba(255,255,255,.8); font-size: 13px; margin-top: 4px; }
        .body { padding: 32px; }
        .field { margin-bottom: 18px; border-bottom: 1px solid #f0f0f0; padding-bottom: 18px; }
        .field:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
        .label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #999; margin-bottom: 4px; }
        .value { font-size: 15px; color: #222; line-height: 1.6; }
        .message-box { background: #f8f9fa; border-left: 3px solid #1a7a4a; padding: 14px 16px; border-radius: 0 4px 4px 0; margin-top: 6px; }
        .actions { background: #f8f9fa; padding: 20px 32px; border-top: 1px solid #eee; text-align: center; }
        .btn { display: inline-block; background: #1a7a4a; color: #fff; padding: 10px 24px; border-radius: 4px; text-decoration: none; font-size: 14px; font-weight: 600; }
        .footer { padding: 20px 32px; text-align: center; font-size: 12px; color: #aaa; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>New Contact Form Submission</h1>
            <p>Ujjawal Unnati Foundation — Admin Notification</p>
        </div>

        <div class="body">
            <div class="field">
                <div class="label">Full Name</div>
                <div class="value">{{ $submission->full_name }}</div>
            </div>

            <div class="field">
                <div class="label">Email Address</div>
                <div class="value"><a href="mailto:{{ $submission->email }}" style="color:#1a7a4a;">{{ $submission->email }}</a></div>
            </div>

            @if($submission->phone)
            <div class="field">
                <div class="label">Phone Number</div>
                <div class="value"><a href="tel:{{ $submission->phone }}" style="color:#1a7a4a;">{{ $submission->phone }}</a></div>
            </div>
            @endif

            <div class="field">
                <div class="label">Message</div>
                <div class="message-box value">{{ $submission->message }}</div>
            </div>

            <div class="field">
                <div class="label">Submitted At</div>
                <div class="value">{{ $submission->created_at->format('d M Y, h:i A') }}</div>
            </div>
        </div>

        <div class="actions">
            <a href="{{ url('/admin/contact-submissions') }}" class="btn">View in Admin Panel</a>
        </div>

        <div class="footer">
            This email was sent from the contact form on<br>
            <strong>Ujjawal Unnati Foundation</strong> — info@ujjawalunnati.com
        </div>
    </div>
</body>
</html>
