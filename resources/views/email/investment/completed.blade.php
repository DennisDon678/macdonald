<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Investment Completed - {{ config('app.name') }}</title>
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
            color: #8b5cf6;
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
            background-color: #8b5cf6;
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
        .celebration {
            text-align: center;
            font-size: 40px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }} Logo">
        </div>
        
        <div class="content">
            <div class="celebration">🎉</div>
            <h1>Investment Completed Successfully!</h1>
            
            <p>Dear {{ $investment->user->name }},</p>
            
            <p>Congratulations! Your investment has successfully completed its term. The principal and profits have been added to your account balance.</p>
            
            <div class="transaction-details">
                <p><span>Investment Plan:</span> <strong>{{ $investment->plan->name }}</strong></p>
                <p><span>Principal Amount:</span> <strong>${{ number_format($investment->amount, 2) }}</strong></p>
                <p><span>Total Profit Earned:</span> <strong>${{ number_format($investment->total_profit, 2) }}</strong></p>
                <p><span>Total Return:</span> <strong>${{ number_format($investment->amount + $investment->total_profit, 2) }}</strong></p>
                <p><span>Start Date:</span> <strong>{{ $investment->created_at->format('M d, Y') }}</strong></p>
                <p><span>Completion Date:</span> <strong>{{ $investment->completed_at->format('M d, Y') }}</strong></p>
                <p><span>Duration:</span> <strong>{{ $investment->plan->duration }} days</strong></p>
                <p><span>Status:</span> <strong style="color: #8b5cf6;">Completed</strong></p>
            </div>
            
            <p>Your funds are now available in your account balance. You can either withdraw them or reinvest to continue growing your portfolio.</p>
            
            <div style="display: flex; justify-content: space-between; margin-top: 20px; gap: 10px;">
                <div style="flex: 1; text-align: center;">
                    <a href="{{ route('dashboard.withdrawals.create') }}" class="button" style="background-color: #2563eb; display: block;">Withdraw Funds</a>
                </div>
                <div style="flex: 1; text-align: center;">
                    <a href="{{ route('dashboard.deposits.create') }}" class="button" style="display: block;">Reinvest Now</a>
                </div>
            </div>
            
            <p>Thank you for investing with {{ config('app.name') }}. We look forward to your continued success on our platform.</p>
            
            <p>Best regards,<br>The {{ config('app.name') }} Team</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>If you have any questions, contact us at {{ \App\Helpers\SettingsHelper::get('contact_email', 'support@example.com') }}</p>
        </div>
    </div>
</body>
</html>