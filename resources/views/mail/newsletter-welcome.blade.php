<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Ujjawal Unnati Foundation Newsletter</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; color: #333; }
        .wrapper { max-width: 600px; margin: 0 auto; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
        .header { background: #1a7a4a; padding: 40px 32px; text-align: center; }
        .header h1 { color: #fff; font-size: 24px; font-weight: 700; margin-bottom: 8px; }
        .header p { color: rgba(255,255,255,.85); font-size: 14px; }
        .body { padding: 36px 32px; }
        .body h2 { font-size: 20px; margin-bottom: 16px; color: #1a7a4a; }
        .body p { font-size: 15px; line-height: 1.7; color: #555; margin-bottom: 14px; }
        .impact-box { background: #f0f9f4; border: 1px solid #c3e6d4; border-radius: 8px; padding: 20px 24px; margin: 24px 0; }
        .impact-box h3 { font-size: 15px; font-weight: 700; color: #1a7a4a; margin-bottom: 12px; }
        .impact-item { display: flex; align-items: center; margin-bottom: 8px; font-size: 14px; color: #444; }
        .impact-item::before { content: "✓"; color: #1a7a4a; font-weight: 700; margin-right: 10px; }
        .cta { text-align: center; margin: 28px 0; }
        .btn { display: inline-block; background: #1a7a4a; color: #fff; padding: 12px 32px; border-radius: 4px; text-decoration: none; font-size: 15px; font-weight: 600; }
        .social { text-align: center; padding: 20px 32px; background: #f8f9fa; border-top: 1px solid #eee; }
        .social p { font-size: 13px; color: #888; margin-bottom: 10px; }
        .social a { display: inline-block; margin: 0 6px; color: #1a7a4a; text-decoration: none; font-weight: 600; font-size: 13px; }
        .footer { padding: 20px 32px; text-align: center; font-size: 12px; color: #aaa; line-height: 1.6; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>Ujjawal Unnati Foundation</h1>
            <p>Empowering Communities, Protecting Rights!</p>
        </div>

        <div class="body">
            <h2>Welcome to Our Community!</h2>
            <p>Thank you for subscribing to the Ujjawal Unnati Foundation newsletter. You are now part of a growing community of {{ number_format(2500) }}+ supporters who believe in our mission.</p>

            <p>As a subscriber, you will receive:</p>

            <div class="impact-box">
                <h3>What to Expect</h3>
                <div class="impact-item">Stories from our Gau Sewa program</div>
                <div class="impact-item">Updates on women empowerment training batches</div>
                <div class="impact-item">Ration and education drive reports</div>
                <div class="impact-item">Volunteer opportunities and events</div>
                <div class="impact-item">Impact numbers and annual reports</div>
            </div>

            <p>Together, we have served 22,500+ cows, empowered 1,15,000+ women, and transformed 12,000+ lives. Your support — even just sharing our work — helps us do more.</p>

            <div class="cta">
                <a href="{{ url('/donation') }}" class="btn">Make a Donation</a>
            </div>
        </div>

        <div class="social">
            <p>Follow us for daily updates</p>
            <a href="https://www.facebook.com/ujjawalunnati" target="_blank">Facebook</a>
            <a href="https://www.youtube.com/channel/UC2CLzRsHH2pkU_UHz3fjlYA" target="_blank">YouTube</a>
        </div>

        <div class="footer">
            <p>You are receiving this email because you subscribed at ujjawalunnati.com.</p>
            <p style="margin-top:8px;">
                <strong>Ujjawal Unnati Foundation</strong><br>
                Sector 12, Noida, Gautam Budh Nagar 201301, India<br>
                +91-8130789837 &nbsp;|&nbsp; info@ujjawalunnati.com
            </p>
            <p style="margin-top:8px; color:#ccc;">If you did not subscribe, you can safely ignore this email.</p>
        </div>
    </div>
</body>
</html>
