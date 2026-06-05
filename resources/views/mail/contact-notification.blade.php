<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        h2 { color: #2d6a4f; border-bottom: 2px solid #2d6a4f; padding-bottom: 10px; }
        p { margin: 8px 0; }
        strong { color: #555; }
    </style>
</head>
<body>
    <h2>New Contact Form Submission</h2>
    <p><strong>Name:</strong> {{ $submission->full_name }}</p>
    <p><strong>Email:</strong> {{ $submission->email }}</p>
    <p><strong>Phone:</strong> {{ $submission->phone ?? 'N/A' }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $submission->message }}</p>
</body>
</html>
