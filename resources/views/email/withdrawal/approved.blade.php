@extends('email.layouts.master')

@section('title', 'Withdrawal Processed - ' . config('app.name'))
@section('preview', 'Your withdrawal of $' . number_format($withdrawal->amount ?? 0, 2) . ' has been approved and sent to your wallet.')

@section('content')
<!-- Header Badge / Icon -->
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 24px;">
    <tr>
        <td align="center">
            <div style="display: inline-block; width: 64px; height: 64px; border-radius: 50%; background-color: #d1fae5; border: 2px solid #a7f3d0; text-align: center; line-height: 60px; font-size: 28px; color: #059669;">
                ✓
            </div>
        </td>
    </tr>
</table>

<!-- Main Heading -->
<h1 style="margin: 0 0 8px 0; color: #0b1220; font-size: 24px; font-weight: 800; text-align: center; letter-spacing: -0.5px;">
    Withdrawal Approved & Sent!
</h1>

<p style="margin: 0 0 24px 0; color: #64748b; font-size: 15px; line-height: 1.6; text-align: center;">
    Your funds have been dispatched from our vault to your external wallet address.
</p>

<!-- Greeting -->
<p style="margin: 0 0 16px 0; color: #1e293b; font-size: 15px; line-height: 1.6;">
    Dear <strong>{{ $withdrawal->user->name ?? 'Valued Investor' }}</strong>,
</p>

<p style="margin: 0 0 20px 0; color: #334155; font-size: 15px; line-height: 1.6;">
    We are pleased to inform you that your withdrawal request has been approved and processed. The requested cryptocurrency funds have been sent to your designated wallet address.
</p>

<!-- Transaction Details Table -->
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; margin: 24px 0; overflow: hidden;">
    <tr>
        <td colspan="2" style="padding: 14px 20px; background-color: #0b1220; color: #ffffff; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td style="color: #ffffff; font-size: 13px; font-weight: 700;">Disbursement Details</td>
                    <td align="right">
                        <span style="display: inline-block; padding: 4px 10px; background-color: #d1fae5; color: #065f46; font-size: 11px; font-weight: 700; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px;">
                            ● Completed
                        </span>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr class="detail-row">
        <td style="padding: 13px 20px; color: #64748b; font-size: 14px; border-bottom: 1px solid #edf2f7;">Withdrawn Amount:</td>
        <td class="detail-value" align="right" style="padding: 13px 20px; color: #059669; font-size: 18px; font-weight: 800; border-bottom: 1px solid #edf2f7;">
            ${{ number_format($withdrawal->amount ?? 0, 2) }}
        </td>
    </tr>
    <tr class="detail-row">
        <td style="padding: 13px 20px; color: #64748b; font-size: 14px; border-bottom: 1px solid #edf2f7;">Asset / Currency:</td>
        <td class="detail-value" align="right" style="padding: 13px 20px; color: #0b1220; font-size: 14px; font-weight: 700; border-bottom: 1px solid #edf2f7;">
            {{ strtoupper($withdrawal->currency ?? '') }}
        </td>
    </tr>
    <tr class="detail-row">
        <td style="padding: 13px 20px; color: #64748b; font-size: 14px; border-bottom: 1px solid #edf2f7;">Destination Wallet:</td>
        <td class="detail-value" align="right" style="padding: 13px 20px; color: #334155; font-size: 12px; font-family: monospace; word-break: break-all; border-bottom: 1px solid #edf2f7;">
            {{ $withdrawal->wallet_address ?? 'N/A' }}
        </td>
    </tr>
    <tr class="detail-row">
        <td style="padding: 13px 20px; color: #64748b; font-size: 14px; border-bottom: 1px solid #edf2f7;">Transaction ID:</td>
        <td class="detail-value" align="right" style="padding: 13px 20px; color: #0b1220; font-size: 13px; font-weight: 600; font-family: monospace; border-bottom: 1px solid #edf2f7;">
            {{ $withdrawal->reference ?? 'N/A' }}
        </td>
    </tr>
    <tr class="detail-row">
        <td style="padding: 13px 20px; color: #64748b; font-size: 14px;">Processed Timestamp:</td>
        <td class="detail-value" align="right" style="padding: 13px 20px; color: #475569; font-size: 13px; font-weight: 500;">
            {{ $withdrawal->processed_at ? \Carbon\Carbon::parse($withdrawal->processed_at)->format('M d, Y H:i') . ' UTC' : ($withdrawal->updated_at ? \Carbon\Carbon::parse($withdrawal->updated_at)->format('M d, Y H:i') . ' UTC' : now()->format('M d, Y H:i') . ' UTC') }}
        </td>
    </tr>
</table>

<!-- Blockchain Confirmation Notice -->
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f0fdf4; border: 1px solid #bbf7d0; border-left: 4px solid #10b981; border-radius: 8px; margin: 20px 0;">
    <tr>
        <td style="padding: 14px 18px; color: #166534; font-size: 13px; line-height: 1.6;">
            <strong>Blockchain Broadcasted:</strong> Depending on the network congestion of the selected asset, confirmations usually take between a few minutes to an hour to appear fully settled in your wallet.
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
                        <a href="{{ route('dashboard.withdrawals.history') }}" target="_blank" class="button-link" style="display: inline-block; padding: 14px 32px; font-size: 14px; font-weight: 700; color: #0b1220; text-decoration: none; border-radius: 8px; letter-spacing: 0.3px; text-transform: uppercase;">
                            View Transaction History &rarr;
                        </a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<p style="margin: 0; color: #1e293b; font-size: 14px; line-height: 1.6;">
    Thank you for investing with {{ config('app.name') }}.<br />
    <strong style="color: #0b1220;">The {{ config('app.name') }} Team</strong>
</p>
@endsection