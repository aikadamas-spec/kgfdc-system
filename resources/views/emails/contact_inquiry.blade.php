<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; color: #333; font-size: 14px; }
        .header { background: #4ca8cd; color: #fff; padding: 20px 30px; }
        .body   { padding: 30px; }
        .field  { margin-bottom: 14px; }
        .label  { font-weight: bold; color: #555; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; }
        .value  { margin-top: 4px; font-size: 14px; }
        .message-box { background: #f5f5f5; border-left: 4px solid #4ca8cd; padding: 14px 18px; border-radius: 4px; }
        .footer { padding: 20px 30px; font-size: 12px; color: #999; border-top: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="header">
        <h2 style="margin:0;">New Contact Inquiry — Kigamboni FDC</h2>
    </div>
    <div class="body">
        <div class="field">
            <div class="label">From</div>
            <div class="value">{{ $inquiry->name }}</div>
        </div>
        @if($inquiry->email)
        <div class="field">
            <div class="label">Email</div>
            <div class="value"><a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a></div>
        </div>
        @endif
        @if($inquiry->phone)
        <div class="field">
            <div class="label">Phone</div>
            <div class="value">{{ $inquiry->phone }}</div>
        </div>
        @endif
        <div class="field">
            <div class="label">Subject</div>
            <div class="value">{{ $inquiry->subject }}</div>
        </div>
        <div class="field">
            <div class="label">Message</div>
            <div class="message-box">{{ $inquiry->message }}</div>
        </div>
        <p style="margin-top:24px; font-size:12px; color:#888;">
            Received: {{ $inquiry->created_at->format('d M Y, H:i') }}
        </p>
    </div>
    <div class="footer">
        This email was sent automatically from the Kigamboni FDC website contact form.
        Log in to the dashboard to view and manage all inquiries.
    </div>
</body>
</html>
