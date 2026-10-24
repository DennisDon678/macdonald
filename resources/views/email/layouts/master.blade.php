<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="x-apple-disable-message-reformatting" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title', config('app.name'))</title>
    <style type="text/css">
        /* Client-specific Resets */
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; border: 0; outline: none; text-decoration: none; }
        body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; background-color: #0b1220; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; }
        
        /* Mobile Responsive */
        @media screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
                margin: auto !important;
            }
            .content-padding {
                padding: 24px 18px !important;
            }
            .header-padding {
                padding: 20px 16px !important;
            }
            .detail-row td {
                display: block !important;
                width: 100% !important;
                box-sizing: border-box !important;
                text-align: left !important;
            }
            .detail-row td.detail-value {
                padding-top: 2px !important;
                padding-bottom: 10px !important;
            }
            .button-wrapper {
                width: 100% !important;
                text-align: center !important;
            }
            .button-link {
                display: block !important;
                width: auto !important;
                margin: 6px 0 !important;
            }
            .button-stack {
                display: block !important;
                width: 100% !important;
            }
            .button-stack td {
                display: block !important;
                width: 100% !important;
                padding: 4px 0 !important;
            }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #070c17; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased;">
    <!-- Preheader preview text -->
    <div style="display: none; font-size: 1px; color: #070c17; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
        @yield('preview')
        &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;
    </div>

    <!-- Outer Table -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #070c17; min-height: 100%;">
        <tr>
            <td align="center" style="padding: 28px 12px 40px 12px;">
                <!-- Main Wrapper (600px max) -->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="email-container" style="max-width: 600px; background-color: #0b1220; border-radius: 16px; overflow: hidden; border: 1px solid #1a2235; box-shadow: 0 18px 40px rgba(0, 0, 0, 0.45);">
                    
                    <!-- Top Accent Gold Line -->
                    <tr>
                        <td height="4" style="background: linear-gradient(90deg, #f5df91 0%, #d4af37 50%, #c5a028 100%); line-height: 4px; font-size: 4px;">&nbsp;</td>
                    </tr>

                    <!-- Header -->
                    <tr>
                        <td align="center" class="header-padding" style="padding: 28px 30px 22px 30px; background-color: #0b1220; border-bottom: 1px solid #162032;">
                            <table border="0" cellpadding="0" cellspacing="0" align="center">
                                <tr>
                                    <td align="center">
                                        <a href="{{ url('/') }}" target="_blank" style="text-decoration: none; display: inline-flex; align-items: center;">
                                            @php
                                                $logoPath = public_path('img/logo.png');
                                                $hasImageLogo = file_exists($logoPath);
                                            @endphp
                                            @if($hasImageLogo)
                                                <img src="{{ asset('img/logo.png') }}" alt="{{ config('app.name') }}" height="42" style="height: 42px; max-height: 42px; width: auto; display: block; border: 0;" />
                                            @else
                                                <!-- Premium Brand Typography Logo -->
                                                <table border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td style="background: linear-gradient(135deg, #f5df91 0%, #d4af37 100%); width: 38px; height: 38px; border-radius: 10px; text-align: center; vertical-align: middle; color: #0b1220; font-weight: 800; font-size: 18px; font-family: 'Inter', sans-serif;">
                                                            {{ strtoupper(substr(config('app.name', 'L'), 0, 1)) }}
                                                        </td>
                                                        <td style="padding-left: 12px; vertical-align: middle;">
                                                            <div style="color: #ffffff; font-size: 18px; font-weight: 700; letter-spacing: -0.3px; line-height: 20px;">
                                                                {{ config('app.name', 'Laravel') }}
                                                            </div>
                                                            <div style="color: #d4af37; font-size: 9px; font-weight: 600; text-transform: uppercase; letter-spacing: 1.5px; line-height: 12px;">
                                                                Investment Platform
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            @endif
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Main White Content Card -->
                    <tr>
                        <td class="content-padding" style="padding: 36px 34px; background-color: #ffffff;">
                            @yield('content')
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding: 28px 30px; background-color: #0b1220; border-top: 1px solid #162032; text-align: center;">
                            <!-- Navigation Links -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 16px;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ url('/') }}" target="_blank" style="color: #94a3b8; font-size: 12px; text-decoration: none; font-weight: 500; margin: 0 10px;">Home</a>
                                        <span style="color: #334155;">&bull;</span>
                                        <a href="{{ route('dashboard') }}" target="_blank" style="color: #94a3b8; font-size: 12px; text-decoration: none; font-weight: 500; margin: 0 10px;">Dashboard</a>
                                        <span style="color: #334155;">&bull;</span>
                                        <a href="{{ route('support') }}" target="_blank" style="color: #94a3b8; font-size: 12px; text-decoration: none; font-weight: 500; margin: 0 10px;">Support</a>
                                        <span style="color: #334155;">&bull;</span>
                                        <a href="{{ route('faq') }}" target="_blank" style="color: #94a3b8; font-size: 12px; text-decoration: none; font-weight: 500; margin: 0 10px;">FAQ</a>
                                    </td>
                                </tr>
                            </table>

                            <!-- Social Links if configured -->
                            @php
                                $fb = \App\Models\Setting::get('facebook_url');
                                $tw = \App\Models\Setting::get('twitter_url');
                                $ig = \App\Models\Setting::get('instagram_url');
                            @endphp
                            @if($fb || $tw || $ig)
                                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 14px;">
                                    <tr>
                                        <td align="center">
                                            @if($fb)
                                                <a href="{{ $fb }}" target="_blank" style="color: #d4af37; font-size: 12px; text-decoration: none; font-weight: 600; margin: 0 8px;">Facebook</a>
                                            @endif
                                            @if($tw)
                                                <a href="{{ $tw }}" target="_blank" style="color: #d4af37; font-size: 12px; text-decoration: none; font-weight: 600; margin: 0 8px;">Twitter (X)</a>
                                            @endif
                                            @if($ig)
                                                <a href="{{ $ig }}" target="_blank" style="color: #d4af37; font-size: 12px; text-decoration: none; font-weight: 600; margin: 0 8px;">Instagram</a>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            @endif

                            <!-- Contact Support -->
                            <p style="margin: 0 0 12px 0; font-size: 12px; line-height: 18px; color: #94a3b8;">
                                Need help? Contact us at 
                                <a href="mailto:{{ \App\Models\Setting::get('contact_email', 'support@' . request()->getHost()) }}" style="color: #d4af37; text-decoration: none; font-weight: 500;">
                                    {{ \App\Models\Setting::get('contact_email', 'support@' . request()->getHost()) }}
                                </a>
                            </p>

                            <!-- Automated Notice & Copyright -->
                            <p style="margin: 0; font-size: 11px; line-height: 16px; color: #64748b;">
                                &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.<br />
                                This is an automated notification, please do not reply directly to this email.
                            </p>
                        </td>
                    </tr>
                </table>
                <!-- /Main Wrapper -->
            </td>
        </tr>
    </table>
</body>
</html>
