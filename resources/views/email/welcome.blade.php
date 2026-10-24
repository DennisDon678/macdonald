@extends('email.layouts.master')

@section('title', 'Welcome to ' . config('app.name'))
@section('preview', 'Welcome to ' . config('app.name') . '! Your account is active and ready for smart investing.')

@section('content')
<!-- Header Badge / Icon -->
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 24px;">
    <tr>
        <td align="center">
            <div style="display: inline-block; width: 64px; height: 64px; border-radius: 50%; background: linear-gradient(135deg, #f5df91 0%, #d4af37 100%); text-align: center; line-height: 64px; font-size: 28px; box-shadow: 0 8px 20px rgba(212, 175, 55, 0.25);">
                ✨
            </div>
        </td>
    </tr>
</table>

<!-- Main Heading -->
<h1 style="margin: 0 0 14px 0; color: #0b1220; font-size: 24px; font-weight: 800; text-align: center; letter-spacing: -0.5px;">
    Welcome to {{ config('app.name') }}!
</h1>

<p style="margin: 0 0 20px 0; color: #64748b; font-size: 15px; line-height: 1.6; text-align: center;">
    Your premier digital wealth & investment journey begins today.
</p>

<!-- Greeting -->
<p style="margin: 0 0 16px 0; color: #1e293b; font-size: 15px; line-height: 1.6;">
    Dear <strong>{{ $user->name }}</strong>,
</p>

<p style="margin: 0 0 20px 0; color: #334155; font-size: 15px; line-height: 1.6;">
    Thank you for joining <strong>{{ config('app.name') }}</strong>. We are thrilled to welcome you to our community of investors. Our platform is designed to provide you with secure, automated, and high-yield investment opportunities.
</p>

<!-- Next Steps Card -->
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; margin: 24px 0; overflow: hidden;">
    <tr>
        <td style="padding: 16px 20px; background-color: #f1f5f9; border-bottom: 1px solid #e2e8f0;">
            <strong style="color: #0b1220; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">
                🚀 Quick Start Checklist
            </strong>
        </td>
    </tr>
    <tr>
        <td style="padding: 16px 20px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td style="padding: 6px 0; vertical-align: top; width: 24px; color: #d4af37; font-size: 16px;">✦</td>
                    <td style="padding: 6px 0; color: #334155; font-size: 14px; line-height: 1.5;">
                        <strong>Explore Investment Plans:</strong> Choose a plan tailored to your target returns and duration.
                    </td>
                </tr>
                <tr>
                    <td style="padding: 6px 0; vertical-align: top; width: 24px; color: #d4af37; font-size: 16px;">✦</td>
                    <td style="padding: 6px 0; color: #334155; font-size: 14px; line-height: 1.5;">
                        <strong>Make Your First Deposit:</strong> Fund your balance effortlessly using supported crypto gateways.
                    </td>
                </tr>
                <tr>
                    <td style="padding: 6px 0; vertical-align: top; width: 24px; color: #d4af37; font-size: 16px;">✦</td>
                    <td style="padding: 6px 0; color: #334155; font-size: 14px; line-height: 1.5;">
                        <strong>Track Your Daily Yield:</strong> Watch your profit accumulate and manage your portfolio 24/7.
                    </td>
                </tr>
                <tr>
                    <td style="padding: 6px 0; vertical-align: top; width: 24px; color: #d4af37; font-size: 16px;">✦</td>
                    <td style="padding: 6px 0; color: #334155; font-size: 14px; line-height: 1.5;">
                        <strong>Secure Your Account:</strong> Review your profile credentials and security settings.
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<!-- CTA Button -->
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 30px 0 26px 0;">
    <tr>
        <td align="center">
            <table border="0" cellpadding="0" cellspacing="0" class="button-wrapper">
                <tr>
                    <td align="center" style="border-radius: 8px; background: linear-gradient(135deg, #f5df91 0%, #d4af37 100%);">
                        <a href="{{ route('dashboard') }}" target="_blank" class="button-link" style="display: inline-block; padding: 14px 32px; font-size: 14px; font-weight: 700; color: #0b1220; text-decoration: none; border-radius: 8px; letter-spacing: 0.3px; text-transform: uppercase;">
                            Access Your Dashboard &rarr;
                        </a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<p style="margin: 0 0 16px 0; color: #475569; font-size: 14px; line-height: 1.6;">
    If you have any questions or require assistance setting up your account, our dedicated support team is available around the clock to assist you.
</p>

<p style="margin: 0; color: #1e293b; font-size: 14px; line-height: 1.6;">
    Best regards,<br />
    <strong style="color: #0b1220;">The {{ config('app.name') }} Team</strong>
</p>
@endsection