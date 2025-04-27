<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Deposit Initiated - {{ config('app.name') }}</title>
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
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }} Logo">
        </div>
        
        <div class="content">
            <h1>Deposit Initiated</h1>
            
            <p>Dear {{ $deposit->user->name }},</p>
            
            <p>We've received your deposit request. Please complete the payment using the provided cryptocurrency address below:</p>
            
            <div class="transaction-details">
                <p><span>Amount:</span> <strong>${{ number_format($deposit->amount, 2) }}</strong></p>
                <p><span>Payment Method:</span> <strong>{{ $deposit->cryptoWallet[0]->name }}</strong></p>
                <p><span>Transaction ID:</span> <strong>{{ $deposit->reference }}</strong></p>
                <p><span>Date:</span> <strong>{{ $deposit->created_at->format('M d, Y H:i') }}</strong></p>
                
                @if($deposit->cryptoWallet[0]->address)
                <p style="flex-direction: column; align-items: start;">
                    <span style="margin-bottom: 5px;">Send Payment To:</span>
                    <code style="background: #edf2f7; padding: 10px; display: block; word-break: break-all; margin-top: 5px;">{{ $deposit->cryptoWallet[0]->address }}</code>
                </p>
                @endif
                
                <p><span>Status:</span> <strong style="color: #f59e0b;">Pending</strong></p>
            </div>
            
            <p><strong>Important:</strong> Please ensure you send the exact amount from your wallet. After completing the payment, you can upload proof of payment from your dashboard.</p>

            <p>Your investment will be activated once the payment is confirmed.</p>
            
            <div style="text-align: center;">
                <a href="{{ route('dashboard.deposits.confirm', $deposit->reference) }}" class="button">View Deposit Details</a>
            </div>
            
            <p>Thank you for choosing {{ config('app.name') }} for your investment needs.</p>
            
            <p>Best regards,<br>The {{ config('app.name') }} Team</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>If you have any questions, contact us at {{ \App\Models\Setting::get('contact_email', 'support@example.com') }}</p>
            <p>This is an automated message, please do not reply directly to this email.</p>
        </div>
    </div>
</body>
</html>