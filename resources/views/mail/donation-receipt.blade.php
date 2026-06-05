<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Receipt</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        h2 { color: #2d6a4f; border-bottom: 2px solid #2d6a4f; padding-bottom: 10px; }
        p { margin: 8px 0; }
        .amount { font-size: 1.2em; color: #2d6a4f; }
        .footer { margin-top: 30px; font-size: 0.9em; color: #777; border-top: 1px solid #eee; padding-top: 15px; }
    </style>
</head>
<body>
    <h2>Thank You for Your Donation!</h2>
    <p>Dear {{ $donation->donor_first_name }},</p>
    <p>We have received your donation of <strong class="amount">${{ number_format($donation->amount, 2) }}</strong>.</p>
    <p>Your generosity makes a real difference in the lives of those we serve.</p>
    <p>This email serves as your official donation receipt. Please retain it for your tax records.</p>
    <div class="footer">
        <p>Thank you for your continued support,</p>
        <p><strong>The Ujjawal Unnati Foundation Team</strong></p>
    </div>
</body>
</html>
