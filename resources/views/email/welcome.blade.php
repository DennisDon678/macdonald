<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to {{ config('app.name') }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f7fa;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }
        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #eaeaea;
        }
        .header img {
            max-height: 50px;
        }
        .content {
            padding: 30px 20px;
        }
        h1 {
            color: #2563eb;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #718096;
            border-top: 1px solid #eaeaea;
        }
        .button {
            display: inline-block;
            background-color: #2563eb;
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 5px;
            font-weight: bold;
            margin: 20px 0;
        }
        .social-icons {
            margin-top: 15px;
        }
        .social-icons a {
            display: inline-block;
            margin: 0 5px;
            color: #718096;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }} Logo">
        </div>
        
        <div class="content">
            <h1>Welcome to {{ config('app.name') }}!</h1>
            
            <p>Dear {{ $user->name }},</p>
            
            <p>Thank you for joining {{ config('app.name') }}! We're excited to have you on board and help you achieve your financial goals through our investment platform.</p>
            
            <p>Your account has been created successfully. Here's what you can do next:</p>
            
            <ul>
                <li>Complete your profile information</li>
                <li>Explore our investment plans</li>
                <li>Make your first deposit</li>
                <li>Set up your security preferences</li>
            </ul>
            
            <p>If you have any questions or need assistance, our support team is always available to help.</p>
            
            <div style="text-align: center;">
                <a href="{{ route('dashboard') }}" class="button">Go to My Dashboard</a>
            </div>
            
            <p>Welcome aboard!</p>
            
            <p>Best regards,<br>The {{ config('app.name') }} Team</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            
            <div class="social-icons">
                <a href="{{ \App\Models\Setting::get('facebook_url', '#') }}">Facebook</a> |
                <a href="{{ \App\Models\Setting::get('twitter_url', '#') }}">Twitter</a> |
                <a href="{{ \App\Models\Setting::get('instagram_url', '#') }}">Instagram</a>
            </div>
            
            <p>If you have any questions, contact us at {{ \App\Models\Setting::get('contact_email', 'support@example.com') }}</p>
        </div>
    </div>
</body>
</html>