@extends('email.layouts.master')

@section('title', 'Deposit Initiated - ' . config('app.name'))
@section('preview', 'Deposit of $' . number_format($deposit->amount, 2) . ' initiated. Please complete your payment.')

@section('content')
<!-- Header Badge / Icon -->
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 24px;">
    <tr>
        <td align="center">
            <div style="display: inline-block; width: 64px; height: 64px; border-radius: 50%; background-color: #fef3c7; border: 2px solid #fde68a; text-align: center; line-height: 60px; font-size: 28px;">
                ⏳
            </div>
        </td>
    </tr>
</table>

<!-- Main Heading -->
<h1 style="margin: 0 0 8px 0; color: #0b1220; font-size: 24px; font-weight: 800; text-align: center; letter-spacing: -0.5px;">
    Deposit Request Initiated
</h1>

<p style="margin: 0 0 24px 0; color: #64748b; font-size: 15px; line-height: 1.6; text-align: center;">
    Your deposit request has been registered and is awaiting transfer confirmation.
</p>

<!-- Greeting -->
<p style="margin: 0 0 16px 0; color: #1e293b; font-size: 15px; line-height: 1.6;">
    Dear <strong>{{ $deposit->user->name ?? 'Valued Investor' }}</strong>,
</p>

<p style="margin: 0 0 20px 0; color: #334155; font-size: 15px; line-height: 1.6;">
    We have received your deposit request. Please review the transaction details below and send the specified payment to activate your deposit.
</p>

<!-- Transaction Details Table -->
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; margin: 24px 0; overflow: hidden;">
    <tr>
        <td colspan="2" style="padding: 14px 20px; background-color: #0b1220; color: #ffffff; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td style="color: #ffffff; font-size: 13px; font-weight: 700;">Deposit Summary</td>
                    <td align="right">
                        <span style="display: inline-block; padding: 4px 10px; background-color: #fef3c7; color: #92400e; font-size: 11px; font-weight: 700; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px;">
                            ● Pending Payment
                        </span>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr class="detail-row">
        <td style="padding: 13px 20px; color: #64748b; font-size: 14px; border-bottom: 1px solid #edf2f7;">Amount to Deposit:</td>
        <td class="detail-value" align="right" style="padding: 13px 20px; color: #0b1220; font-size: 17px; font-weight: 800; border-bottom: 1px solid #edf2f7;">
            ${{ number_format($deposit->amount, 2) }}
        </td>
    </tr>
    <tr class="detail-row">
        <td style="padding: 13px 20px; color: #64748b; font-size: 14px; border-bottom: 1px solid #edf2f7;">Payment Method:</td>
        <td class="detail-value" align="right" style="padding: 13px 20px; color: #0b1220; font-size: 14px; font-weight: 600; border-bottom: 1px solid #edf2f7;">
            {{ $deposit->cryptoWallet->first()?->name ?? $deposit->currency ?? 'Cryptocurrency' }}
        </td>
    </tr>
    <tr class="detail-row">
        <td style="padding: 13px 20px; color: #64748b; font-size: 14px; border-bottom: 1px solid #edf2f7;">Transaction Reference:</td>
        <td class="detail-value" align="right" style="padding: 13px 20px; color: #0b1220; font-size: 13px; font-weight: 600; font-family: monospace; border-bottom: 1px solid #edf2f7;">
            {{ $deposit->reference }}
        </td>
    </tr>
    <tr class="detail-row">
        <td style="padding: 13px 20px; color: #64748b; font-size: 14px; border-bottom: 1px solid #edf2f7;">Date Initiated:</td>
        <td class="detail-value" align="right" style="padding: 13px 20px; color: #475569; font-size: 13px; font-weight: 500; border-bottom: 1px solid #edf2f7;">
            {{ $deposit->created_at ? \Carbon\Carbon::parse($deposit->created_at)->format('M d, Y H:i') . ' UTC' : now()->format('M d, Y H:i') . ' UTC' }}
        </td>
    </tr>
    @php
        $walletAddr = $deposit->cryptoWallet->first()?->address ?? $deposit->wallet_address;
    @endphp
    @if($walletAddr)
    <tr>
        <td colspan="2" style="padding: 16px 20px; background-color: #f1f5f9;">
            <div style="font-size: 12px; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">
                Destination Wallet Address:
            </div>
            <div style="background-color: #0b1220; color: #f5df91; padding: 12px 14px; border-radius: 8px; font-family: monospace; font-size: 13px; word-break: break-all; border: 1px solid #1a2235;">
                {{ $walletAddr }}
            </div>
        </td>
    </tr>
    @endif
</table>

<!-- Payment Instructions Alert -->
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #fefce8; border: 1px solid #fef08a; border-left: 4px solid #d4af37; border-radius: 8px; margin: 20px 0;">
    <tr>
        <td style="padding: 14px 18px; color: #713f12; font-size: 13px; line-height: 1.6;">
            <strong>Important:</strong> Please ensure you send the exact equivalent amount to the address above. Once your transaction has broadcasted, please upload your proof of payment on your dashboard to expedite confirmation.
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
                        <a href="{{ route('dashboard.deposits.confirm', $deposit->reference) }}" target="_blank" class="button-link" style="display: inline-block; padding: 14px 32px; font-size: 14px; font-weight: 700; color: #0b1220; text-decoration: none; border-radius: 8px; letter-spacing: 0.3px; text-transform: uppercase;">
                            View Deposit & Confirm Payment &rarr;
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