@extends('email.layouts.master')

@section('title', 'Investment Completed - ' . config('app.name'))
@section('preview', 'Congratulations! Your investment term is complete and profits have been credited to your account.')

@section('content')
<!-- Header Badge / Icon -->
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 24px;">
    <tr>
        <td align="center">
            <div style="display: inline-block; width: 68px; height: 68px; border-radius: 50%; background: linear-gradient(135deg, #f5df91 0%, #d4af37 100%); text-align: center; line-height: 68px; font-size: 32px; box-shadow: 0 8px 24px rgba(212, 175, 55, 0.3);">
                🏆
            </div>
        </td>
    </tr>
</table>

<!-- Main Heading -->
<h1 style="margin: 0 0 8px 0; color: #0b1220; font-size: 24px; font-weight: 800; text-align: center; letter-spacing: -0.5px;">
    Investment Term Completed!
</h1>

<p style="margin: 0 0 24px 0; color: #64748b; font-size: 15px; line-height: 1.6; text-align: center;">
    Your capital principal and accumulated returns have been successfully unlocked.
</p>

<!-- Greeting -->
<p style="margin: 0 0 16px 0; color: #1e293b; font-size: 15px; line-height: 1.6;">
    Dear <strong>{{ $investment->user->name ?? 'Valued Investor' }}</strong>,
</p>

<p style="margin: 0 0 20px 0; color: #334155; font-size: 15px; line-height: 1.6;">
    Congratulations! Your investment with <strong>{{ config('app.name') }}</strong> has successfully reached the end of its maturity term. Both your initial capital and earned profits have been added to your accessible account balance.
</p>

<!-- Performance Summary Card -->
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; margin: 24px 0; overflow: hidden;">
    <tr>
        <td colspan="2" style="padding: 14px 20px; background-color: #0b1220; color: #ffffff; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td style="color: #ffffff; font-size: 13px; font-weight: 700;">Performance Summary</td>
                    <td align="right">
                        <span style="display: inline-block; padding: 4px 10px; background-color: #d1fae5; color: #065f46; font-size: 11px; font-weight: 700; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px;">
                            ● Matured
                        </span>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr class="detail-row">
        <td style="padding: 13px 20px; color: #64748b; font-size: 14px; border-bottom: 1px solid #edf2f7;">Investment Plan:</td>
        <td class="detail-value" align="right" style="padding: 13px 20px; color: #0b1220; font-size: 14px; font-weight: 700; border-bottom: 1px solid #edf2f7;">
            {{ $investment->plan->name ?? 'Investment Plan' }}
        </td>
    </tr>
    <tr class="detail-row">
        <td style="padding: 13px 20px; color: #64748b; font-size: 14px; border-bottom: 1px solid #edf2f7;">Principal Invested:</td>
        <td class="detail-value" align="right" style="padding: 13px 20px; color: #0b1220; font-size: 15px; font-weight: 600; border-bottom: 1px solid #edf2f7;">
            ${{ number_format($investment->amount, 2) }}
        </td>
    </tr>
    <tr class="detail-row">
        <td style="padding: 13px 20px; color: #64748b; font-size: 14px; border-bottom: 1px solid #edf2f7;">Net Profit Generated:</td>
        <td class="detail-value" align="right" style="padding: 13px 20px; color: #059669; font-size: 16px; font-weight: 700; border-bottom: 1px solid #edf2f7;">
            +${{ number_format($investment->total_profit, 2) }}
        </td>
    </tr>
    <tr class="detail-row" style="background-color: #f1f5f9;">
        <td style="padding: 14px 20px; color: #0b1220; font-size: 14px; font-weight: 700; border-bottom: 1px solid #e2e8f0;">Total Payout (Capital + Profit):</td>
        <td class="detail-value" align="right" style="padding: 14px 20px; color: #b45309; font-size: 19px; font-weight: 800; border-bottom: 1px solid #e2e8f0;">
            ${{ number_format($investment->amount + $investment->total_profit, 2) }}
        </td>
    </tr>
    <tr class="detail-row">
        <td style="padding: 12px 20px; color: #64748b; font-size: 13px; border-bottom: 1px solid #edf2f7;">Investment Duration:</td>
        <td class="detail-value" align="right" style="padding: 12px 20px; color: #475569; font-size: 13px; font-weight: 500; border-bottom: 1px solid #edf2f7;">
            {{ $investment->duration }} Days
        </td>
    </tr>
    <tr class="detail-row">
        <td style="padding: 12px 20px; color: #64748b; font-size: 13px;">Completion Date:</td>
        <td class="detail-value" align="right" style="padding: 12px 20px; color: #475569; font-size: 13px; font-weight: 500;">
            {{ $investment->end_date ? \Carbon\Carbon::parse($investment->end_date)->format('M d, Y') : now()->format('M d, Y') }}
        </td>
    </tr>
</table>

<p style="margin: 0 0 20px 0; color: #334155; font-size: 14px; line-height: 1.6;">
    Your balance is ready for you to either withdraw securely or roll over into our higher-tier investment plans to compound your returns.
</p>

<!-- Dual CTA Buttons -->
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="button-stack" style="margin: 28px 0 24px 0;">
    <tr>
        <td align="center" style="padding: 6px;">
            <table border="0" cellpadding="0" cellspacing="0" style="display: inline-block;">
                <tr>
                    <td align="center" style="border-radius: 8px; background: linear-gradient(135deg, #f5df91 0%, #d4af37 100%);">
                        <a href="{{ route('dashboard.deposits.create') }}" target="_blank" class="button-link" style="display: inline-block; padding: 13px 26px; font-size: 13px; font-weight: 700; color: #0b1220; text-decoration: none; border-radius: 8px; letter-spacing: 0.3px; text-transform: uppercase;">
                            Reinvest for Growth &rarr;
                        </a>
                    </td>
                </tr>
            </table>
        </td>
        <td align="center" style="padding: 6px;">
            <table border="0" cellpadding="0" cellspacing="0" style="display: inline-block;">
                <tr>
                    <td align="center" style="border-radius: 8px; background-color: #0b1220; border: 1px solid #1e293b;">
                        <a href="{{ route('dashboard.withdrawals.create') }}" target="_blank" class="button-link" style="display: inline-block; padding: 13px 26px; font-size: 13px; font-weight: 600; color: #ffffff; text-decoration: none; border-radius: 8px; letter-spacing: 0.3px; text-transform: uppercase;">
                            Withdraw Funds
                        </a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<p style="margin: 0; color: #1e293b; font-size: 14px; line-height: 1.6;">
    Thank you for choosing {{ config('app.name') }}.<br />
    <strong style="color: #0b1220;">The {{ config('app.name') }} Team</strong>
</p>
@endsection