<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reset Your Password - FreshMart</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; background-color: #f4f4f4; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 30px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .header { background: linear-gradient(135deg, #16a34a 0%, #059669 100%); padding: 30px; text-align: center; }
        .header h1 { color: #ffffff; margin: 0; font-size: 24px; }
        .header p { color: #e0f2e9; margin: 8px 0 0 0; font-size: 14px; }
        .content { padding: 40px 30px; }
        .greeting { font-size: 18px; color: #16a34a; margin-bottom: 15px; }
        .message { color: #555; line-height: 1.8; margin-bottom: 25px; }
        .button-container { text-align: center; margin: 30px 0; }
        .button { display: inline-block; background: linear-gradient(135deg, #16a34a 0%, #059669 100%); color: #ffffff; text-decoration: none; padding: 14px 40px; border-radius: 8px; font-weight: 600; font-size: 16px; box-shadow: 0 4px 8px rgba(22, 163, 74, 0.3); }
        .button:hover { background: linear-gradient(135deg, #15803d 0%, #047857 100%); }
        .info-box { background: #f0fdf4; border-left: 4px solid #16a34a; padding: 15px; border-radius: 6px; margin: 20px 0; }
        .info-box p { margin: 5px 0; color: #166534; font-size: 14px; }
        .warning-box { background: #fef3c7; border-left: 4px solid #d97706; padding: 15px; border-radius: 6px; margin: 20px 0; }
        .warning-box p { margin: 5px 0; color: #92400e; font-size: 14px; }
        .footer { background: #f9fafb; padding: 25px 30px; text-align: center; border-top: 1px solid #e5e7eb; }
        .footer p { margin: 5px 0; color: #6b7280; font-size: 13px; }
        .social-links { margin-top: 15px; }
        .social-links a { display: inline-block; margin: 0 8px; color: #16a34a; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>🛒 FreshMart</h1>
            <p>Password Reset Request</p>
        </div>

        <!-- Content -->
        <div class="content">
            <p class="greeting">Hello {{ $user->name ?? 'Valued Customer' }},</p>

            <p class="message">
                We received a request to reset your password for your FreshMart account. 
                Click the button below to reset your password and regain access to your account.
            </p>

            <!-- Reset Button -->
            <div class="button-container">
                <a href="{{ $resetUrl }}" class="button">Reset My Password</a>
            </div>

            <!-- Alternative Link -->
            <p class="message" style="text-align: center; font-size: 14px;">
                Or copy and paste this link into your browser:<br>
                <a href="{{ $resetUrl }}" style="color: #16a34a; word-break: break-all;">{{ $resetUrl }}</a>
            </p>

            <!-- Security Info -->
            <div class="info-box">
                <p><strong>🔒 Security Notice:</strong></p>
                <p>• This password reset link will expire in 60 minutes.</p>
                <p>• For your security, do not share this link with anyone.</p>
            </div>

            <!-- Warning -->
            <div class="warning-box">
                <p><strong>⚠️ Didn't request a password reset?</strong></p>
                <p>If you didn't request this password reset, please ignore this email or contact our support team immediately. Your account remains secure.</p>
            </div>

            <p class="message">
                <strong>Request Details:</strong><br>
                Email: {{ $email }}<br>
                Time: {{ now()->format('F j, Y \a\t g:i A') }}<br>
                IP Address: {{ request()->ip() ?? 'N/A' }}
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>FreshMart Grocery Store</strong></p>
            <p>Fresh Groceries, Delivered to Your Doorstep</p>
            <div class="social-links">
                <a href="#">📧 Support</a> •
                <a href="#">📞 Contact Us</a> •
                <a href="#">🌐 Website</a>
            </div>
            <p style="margin-top: 20px; font-size: 12px;">
                © {{ date('Y') }} FreshMart. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
