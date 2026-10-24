@extends('email.layouts.master')

@section('title', 'Withdrawal Request Update - ' . config('app.name'))
@section('preview', 'Important update regarding your withdrawal request of $' . number_format($withdrawal->amount, 2) . '.')

@section('content')
<!-- Header Badge / Icon -->
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 24px;">
    <tr>
        <td align="center">
            <div style="display: inline-block; width: 64px; height: 64px; border-radius: 50%; background-color: #fee2e2; border: 2px solid #fecaca; text-align: center; line-height: 60px; font-size: 26px; color: #dc2626;">
                ✕
            </div>
        </td>
    </tr>
</table>

<!-- Main Heading -->
<h1 style="margin: 0 0 8px 0; color: #0b1220; font-size: 24px; font-weight: 800; text-align: center; letter-spacing: -0.5px;">
    Withdrawal Request Declined
</h1>

<p style="margin: 0 0 24px 0; color: #64748b; font-size: 15px; line-height: 1.6; text-align: center;">
    Your funds have been safely returned to your available account balance.
</p>

<!-- Greeting -->
<p style="margin: 0 0 16px 0; color: #1e293b; font-size: 15px; line-height: 1.6;">
    Dear <strong>{{ $withdrawal->user->name ?? 'Valued Investor' }}</strong>,
</p>

<p style="margin: 0 0 20px 0; color: #334155; font-size: 15px; line-height: 1.6;">
    We regret to inform you that your withdrawal request could not be processed at this time. Your funds remain safe and have been restored to your wallet balance.
</p>

<!-- Transaction Details Table -->
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; margin: 24px 0; overflow: hidden;">
    <tr>
        <td colspan="2" style="padding: 14px 20px; background-color: #0b1220; color: #ffffff; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td style="color: #ffffff; font-size: 13px; font-weight: 700;">Order Reference</td>
                    <td align="right">
                        <span style="display: inline-block; padding: 4px 10px; background-color: #fee2e2; color: #991b1b; font-size: 11px; font-weight: 700; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px;">
                            ● Declined
                        </span>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr class="detail-row">
        <td style="padding: 13px 20px; color: #64748b; font-size: 14px; border-bottom: 1px solid #edf2f7;">Requested Amount:</td>
        <td class="detail-value" align="right" style="padding: 13px 20px; color: #0b1220; font-size: 16px; font-weight: 700; border-bottom: 1px solid #edf2f7;">
            ${{ number_format($withdrawal->amount, 2) }}
        </td>
    </tr>
    <tr class="detail-row">
        <td style="padding: 13px 20px; color: #64748b; font-size: 14px; border-bottom: 1px solid #edf2f7;">Asset / Currency:</td>
        <td class="detail-value" align="right" style="padding: 13px 20px; color: #0b1220; font-size: 14px; font-weight: 600; border-bottom: 1px solid #edf2f7;">
            {{ strtoupper($withdrawal->currency) }}
        </td>
    </tr>
    <tr class="detail-row">
        <td style="padding: 13px 20px; color: #64748b; font-size: 14px; border-bottom: 1px solid #edf2f7;">Destination Address:</td>
        <td class="detail-value" align="right" style="padding: 13px 20px; color: #334155; font-size: 12px; font-family: monospace; word-break: break-all; border-bottom: 1px solid #edf2f7;">
            {{ $withdrawal->wallet_address }}
        </td>
    </tr>
    <tr class="detail-row">
        <td style="padding: 13px 20px; color: #64748b; font-size: 14px; border-bottom: 1px solid #edf2f7;">Transaction ID:</td>
        <td class="detail-value" align="right" style="padding: 13px 20px; color: #0b1220; font-size: 13px; font-weight: 600; font-family: monospace; border-bottom: 1px solid #edf2f7;">
            {{ $withdrawal->reference }}
        </td>
    </tr>
    <tr class="detail-row">
        <td style="padding: 13px 20px; color: #64748b; font-size: 14px;">Requested On:</td>
        <td class="detail-value" align="right" style="padding: 13px 20px; color: #475569; font-size: 13px; font-weight: 500;">
            {{ $withdrawal->created_at ? \Carbon\Carbon::parse($withdrawal->created_at)->format('M d, Y H:i') . ' UTC' : now()->format('M d, Y H:i') . ' UTC' }}
        </td>
    </tr>
</table>

<!-- Rejection Reason Alert -->
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #fef2f2; border: 1px solid #fee2e2; border-left: 4px solid #ef4444; border-radius: 8px; margin: 20px 0;">
    <tr>
        <td style="padding: 16px 18px;">
            <div style="font-size: 13px; font-weight: 700; color: #991b1b; margin-bottom: 4px;">
                Reason for decline:
            </div>
            <div style="color: #b91c1c; font-size: 13px; line-height: 1.5;">
                {{ $withdrawal->rejected_reason ?? 'Your withdrawal request could not be processed due to a wallet address mismatch or security verification requirements. Please review your payout address and retry.' }}
            </div>
        </td>
    </tr>
</table>

<p style="margin: 0 0 20px 0; color: #475569; font-size: 14px; line-height: 1.6;">
    No funds have been lost. You may submit a new withdrawal request whenever you are ready. If you need any assistance, our security team is available to help.
</p>

<!-- CTA Button -->
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 30px 0 26px 0;">
    <tr>
        <td align="center">
            <table border="0" cellpadding="0" cellspacing="0" class="button-wrapper">
                <tr>
                    <td align="center" style="border-radius: 8px; background: linear-gradient(135deg, #f5df91 0%, #d4af37 100%);">
                        <a href="{{ route('dashboard.withdrawals.create') }}" target="_blank" class="button-link" style="display: inline-block; padding: 14px 32px; font-size: 14px; font-weight: 700; color: #0b1220; text-decoration: none; border-radius: 8px; letter-spacing: 0.3px; text-transform: uppercase;">
                            Request New Withdrawal &rarr;
                        </a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<p style="margin: 0; color: #1e293b; font-size: 14px; line-height: 1.6;">
    Best regards,<br />
    <strong style="color: #0b1220;">The {{ config('app.name') }} Team</strong>
</p>
@endsection