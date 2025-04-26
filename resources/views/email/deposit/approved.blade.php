<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Deposit Approved - {{ config('app.name') }}</title>
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
            color: #10b981;
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
            background-color: #10b981;
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 5px;
            font-weight: bold;
            margin: 20px 0;
        }
        .transaction-details {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 5px;
            padding: 15px;
            margin: 20px 0;
        }
        .transaction-details p {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
            border-bottom: 1px dashed #e2e8f0;
            padding-bottom: 5px;
        }
        .transaction-details p:last-child {
            border-bottom: none;
        }
        .success-icon {
            text-align: center;
            font-size: 48px;
            margin: 20px 0;
            color: #10b981;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }} Logo">
        </div>
        
        <div class="content">
            <div class="success-icon">✓</div>
            <h1>Deposit Approved</h1>
            
            <p>Dear {{ $deposit->user->name }},</p>
            
            <p>Great news! Your deposit has been approved and your investment has been activated successfully.</p>
            
            <div class="transaction-details">
                <p><span>Amount:</span> <strong>${{ number_format($deposit->amount, 2) }}</strong></p>
                <p><span>Transaction ID:</span> <strong>{{ $deposit->reference }}</strong></p>
                <p><span>Date Approved:</span> <strong>{{ $deposit->updated_at->format('M d, Y H:i') }}</strong></p>
                <p><span>Status:</span> <strong style="color: #10b981;">Approved</strong></p>
            </div>
            
            <p>Your investment is now active and earning returns. You can track your investment progress and earnings in your dashboard.</p>
            
            <div style="text-align: center;">
                <a href="{{ route('dashboard.investments') }}" class="button">View My Investments</a>
            </div>
            
            <p>Thank you for investing with {{ config('app.name') }}. We're committed to helping you grow your wealth.</p>
            
            <p>Best regards,<br>The {{ config('app.name') }} Team</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>If you have any questions, contact us at {{  \App\Models\Setting::get('contact_email', 'support@example.com') }}</p>
        </div>
    </div>
</body>
</html>