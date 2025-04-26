<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Withdrawal Rejected - {{ config('app.name') }}</title>
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
            color: #ef4444;
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
        .reason-box {
            background-color: #fef2f2;
            border: 1px solid #fee2e2;
            border-radius: 5px;
            padding: 15px;
            margin: 20px 0;
            color: #b91c1c;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }} Logo">
        </div>
        
        <div class="content">
            <h1>Withdrawal Rejected</h1>
            
            <p>Dear {{ $withdrawal->user->name }},</p>
            
            <p>We regret to inform you that your withdrawal request has been rejected.</p>
            
            <div class="transaction-details">
                <p><span>Amount:</span> <strong>${{ number_format($withdrawal->amount, 2) }}</strong></p>
                <p><span>Payment Method:</span> <strong>{{ strtoupper($withdrawal->currency) }}</strong></p>
                <p><span>Wallet Address:</span> <strong>{{ $withdrawal->wallet_address }}</strong></p>
                <p><span>Transaction ID:</span> <strong>{{ $withdrawal->reference }}</strong></p>
                <p><span>Requested On:</span> <strong>{{ $withdrawal->created_at->format('M d, Y H:i') }}</strong></p>
                <p><span>Status:</span> <strong style="color: #ef4444;">Rejected</strong></p>
            </div>
            
            <div class="reason-box">
                <strong>Reason for rejection:</strong>
                <p>{{ $withdrawal->rejected_reason ?? 'Your withdrawal request could not be processed. This may be due to security concerns or issues with the provided wallet address.' }}</p>
            </div>
            
            <p>The funds have been returned to your account balance. You can create a new withdrawal request from your dashboard after addressing any issues mentioned above.</p>
            
            <p>If you have any questions or need assistance, please contact our support team.</p>
            
            <div style="text-align: center;">
                <a href="{{ route('dashboard.withdrawals.create') }}" class="button">Create New Withdrawal</a>
            </div>
            
            <p>We apologize for any inconvenience caused.</p>
            
            <p>Best regards,<br>The {{ config('app.name') }} Team</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>If you have any questions, contact us at {{ \App\Models\Setting::get('contact_email', 'support@example.com') }}</p>
        </div>
    </div>
</body>
</html>