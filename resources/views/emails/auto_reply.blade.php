<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Message Received - FreshMart</title>
    <style>
        body { font-family: Arial, sans-serif; color: #333; line-height: 1.6; background: #f9f9f9; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; border: 1px solid #eee; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .logo { text-align: center; margin-bottom: 20px; }
        .logo-text { color: #16a34a; font-size: 24px; font-weight: bold; }
        h2 { color: #16a34a; margin-top: 0; }
        .message-box { background: #f0fdf4; padding: 20px; border-radius: 8px; border-left: 4px solid #16a34a; margin: 20px 0; }
        .footer { margin-top: 30px; border-top: 1px solid #eee; pt: 20px; text-align: center; }
        .footer p { font-size: 12px; color: #777; margin: 5px 0; }
        .btn { display: inline-block; background: #16a34a; color: white; padding: 12px 30px; text-decoration: none; border-radius: 8px; font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <div class="logo-text">🛒 FreshMart</div>
        </div>

        <h2>Hello, {{ $name }}! 🌱</h2>

        <div class="message-box">
            <p style="margin-top: 0;"><strong>Thank you for reaching out to FreshMart!</strong></p>
            <p>We have successfully received your message. Our customer support team is currently reviewing your inquiry and we will get back to you as soon as possible.</p>
            <p><strong>Response Time:</strong> Usually within 24 hours (during business hours)</p>
        </div>

        <p>In the meantime, feel free to keep shopping for the freshest produce in Phnom Penh!</p>

        <div style="text-align: center;">
            <a href="{{ url('/shop') }}" class="btn">Continue Shopping →</a>
        </div>

        <div style="margin-top: 30px; background: #f9f9f9; padding: 20px; border-radius: 8px;">
            <p style="margin: 5px 0; font-size: 14px;"><strong>📞 Need urgent assistance?</strong></p>
            <p style="margin: 5px 0; font-size: 14px;">Call us: <strong>+855 12 345 678</strong></p>
            <p style="margin: 5px 0; font-size: 14px;">Email: <strong>support@freshmart.com</strong></p>
            <p style="margin: 5px 0; font-size: 14px;">Hours: Mon-Sun, 8:00 AM - 10:00 PM</p>
        </div>

        <div class="footer">
            <p style="font-size: 12px; color: #777;">This is an automated reply. Please do not reply to this email.</p>
            <p style="font-size: 12px; color: #777;">© {{ date('Y') }} FreshMart. All rights reserved.</p>
            <p style="font-size: 12px; color: #777;">123 Fresh Blvd, Khan Daun Penh, Phnom Penh, Cambodia</p>
        </div>
    </div>
</body>
</html>
