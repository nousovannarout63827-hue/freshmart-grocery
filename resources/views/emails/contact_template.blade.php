<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Contact Message</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        h2 { color: #16a34a; }
        .message-box { background: #f9f9f9; padding: 15px; border-radius: 5px; border-left: 4px solid #16a34a; }
        hr { border: none; border-top: 1px solid #eee; margin: 20px 0; }
    </style>
</head>
<body style="padding: 20px;">
    <h2 style="margin-top: 0;">🛒 New Message from FreshMart Contact Form</h2>
    
    <div style="background: #f0fdf4; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
        <p style="margin: 5px 0;"><strong>👤 Name:</strong> {{ $formData['first_name'] }} {{ $formData['last_name'] }}</p>
        <p style="margin: 5px 0;"><strong>📧 Email:</strong> <a href="mailto:{{ $formData['email'] }}">{{ $formData['email'] }}</a></p>
        <p style="margin: 5px 0;"><strong>📞 Phone:</strong> {{ $formData['phone'] }}</p>
    </div>
    
    <hr>
    
    <h3 style="color: #16a34a;">Message:</h3>
    <div class="message-box">
        {!! nl2br(e($formData['message'])) !!}
    </div>
    
    <hr>
    
    <p style="color: #666; font-size: 12px; margin-top: 20px;">
        This message was sent from the FreshMart website contact form.<br>
        Sent at: {{ now()->format('Y-m-d H:i:s') }}
    </p>
</body>
</html>
