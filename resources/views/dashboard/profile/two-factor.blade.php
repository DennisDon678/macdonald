@extends('layouts.dashboardLayout')

@section('title', 'Security Settings')

@section('page-title', 'Security Settings')

@section('content')
<div class="mb-6">
    <a href="{{ route('dashboard.profile') }}" class="flex items-center text-blue-600 dark:text-blue-400 hover:underline">
        <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i>
        <span>Back to Profile</span>
    </a>
</div>

@if(session('success'))
<div class="mb-6 p-4 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-lg">
    {{ session('success') }}
</div>
@endif

<div class="max-w-2xl mx-auto">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden mb-6">
        <div class="p-6">
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Two-Factor Authentication</h2>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">
                        Add an extra layer of security to your account
                    </p>
                </div>
                <div class="flex-shrink-0">
                    @if($twoFactorStatus->enabled)
                        <span class="px-3 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full text-sm">
                            Enabled
                        </span>
                    @else
                        <span class="px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-full text-sm">
                            Disabled
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg mb-6">
                <div class="flex items-start">
                    <div class="flex-shrink-0 mt-0.5">
                        <i data-lucide="info" class="w-5 h-5 text-blue-500"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-gray-800 dark:text-white">What is Two-Factor Authentication?</h3>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Two-factor authentication adds an additional security layer to your account. After enabling, you'll need both your password and a security code from your authenticator app to sign in.
                        </p>
                    </div>
                </div>
            </div>
            
            @if(!$twoFactorStatus->enabled)
            <div class="space-y-6">
                <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                    <h3 class="font-medium text-gray-800 dark:text-white mb-2">Step 1: Install an authenticator app</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                        Install an authenticator app on your mobile device. Recommended apps:
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <a href="https://support.google.com/accounts/answer/1066447" target="_blank" class="px-3 py-2 bg-white dark:bg-gray-700 border dark:border-gray-600 rounded-md flex items-center hover:bg-gray-50 dark:hover:bg-gray-600 transition">
                            <i data-lucide="smartphone" class="w-5 h-5 text-gray-400 mr-2"></i>
                            <span class="text-gray-800 dark:text-gray-200">Google Authenticator</span>
                        </a>
                        <a href="https://authy.com/download/" target="_blank" class="px-3 py-2 bg-white dark:bg-gray-700 border dark:border-gray-600 rounded-md flex items-center hover:bg-gray-50 dark:hover:bg-gray-600 transition">
                            <i data-lucide="smartphone" class="w-5 h-5 text-gray-400 mr-2"></i>
                            <span class="text-gray-800 dark:text-gray-200">Authy</span>
                        </a>
                    </div>
                </div>
                
                <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                    <h3 class="font-medium text-gray-800 dark:text-white mb-2">Step 2: Set up your authenticator</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                        Scan this QR code with your authenticator app:
                    </p>
                    
                    <div class="flex flex-col items-center justify-center mb-4">
                        <!-- Placeholder QR code - in real app, generate this dynamically -->
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=otpauth://totp/MacDonald:user@example.com?secret=JBSWY3DPEHPK3PXP&issuer=MacDonald" alt="QR Code" class="w-40 h-40 mb-2">
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            Can't scan? Use this code instead:
                        </p>
                        <div class="mt-1 font-mono bg-white dark:bg-gray-800 p-2 rounded-md text-sm border dark:border-gray-700">
                            JBSWY3DPEHPK3PXP
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                    <h3 class="font-medium text-gray-800 dark:text-white mb-3">Step 3: Verify setup</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                        Enter the 6-digit code from your authenticator app:
                    </p>
                    
                    <form action="#" method="POST" id="verify-2fa-form">
                        @csrf
                        <div class="flex flex-col sm:flex-row items-center gap-4">
                            <div class="flex-1">
                                <input 
                                    type="text" 
                                    id="code" 
                                    name="code" 
                                    class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Enter 6-digit code"
                                    maxlength="6"
                                    inputmode="numeric"
                                    pattern="[0-9]*"
                                    required
                                >
                            </div>
                            <div>
                                <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md transition duration-200">
                                    Verify & Enable
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            @else
            <div class="space-y-6">
                <div class="p-4 bg-green-50 dark:bg-green-900/20 rounded-lg">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 mt-0.5">
                            <i data-lucide="check-circle" class="w-5 h-5 text-green-500"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-gray-800 dark:text-white">Two-Factor Authentication is enabled</h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                Your account is now protected with two-factor authentication. You'll need both your password and a security code from your authenticator app to sign in.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                    <h3 class="font-medium text-gray-800 dark:text-white mb-2">Recovery Codes</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                        Recovery codes can be used to access your account if you lose your 2FA device. Keep them in a safe place - they're only shown once!
                    </p>
                    
                    @if($twoFactorStatus->recovery_codes)
                    <div class="bg-white dark:bg-gray-800 p-3 rounded-md border dark:border-gray-700 mb-3">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 font-mono text-xs">
                            @foreach($twoFactorStatus->recovery_codes as $code)
                                <div class="px-2 py-1 bg-gray-50 dark:bg-gray-700 rounded">{{ $code }}</div>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex items-center justify-end">
                        <button type="button" class="text-sm text-blue-600 dark:text-blue-400 hover:underline flex items-center">
                            <i data-lucide="download" class="w-4 h-4 mr-1"></i>
                            Download Codes
                        </button>
                    </div>
                    @else
                    <div class="flex justify-center">
                        <button type="button" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 font-medium rounded-md transition duration-200 flex items-center">
                            <i data-lucide="refresh-cw" class="w-4 h-4 mr-1"></i>
                            Generate Recovery Codes
                        </button>
                    </div>
                    @endif
                </div>
                
                <div class="border-t dark:border-gray-700 pt-4 flex justify-end">
                    <button type="button" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-medium rounded-md transition duration-200">
                        Disable Two-Factor Authentication
                    </button>
                </div>
            </div>
            @endif
        </div>
    </div>
    
    <!-- Login Sessions -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-6">Active Sessions</h2>
            
            <div class="space-y-4">
                <div class="p-4 border dark:border-gray-700 rounded-lg">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-full mr-3">
                                <i data-lucide="monitor" class="w-5 h-5 text-green-500"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800 dark:text-white">Current Session</p>
                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    <p>Windows 10 • Chrome Browser</p>
                                    <p>IP: 192.168.1.1 • Last active just now</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <span class="px-2 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full text-xs">
                                Active
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="p-4 border dark:border-gray-700 rounded-lg">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded-full mr-3">
                                <i data-lucide="smartphone" class="w-5 h-5 text-gray-500"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800 dark:text-white">iPhone 13</p>
                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    <p>iOS 15 • Safari Browser</p>
                                    <p>IP: 203.0.113.1 • Last active 2 days ago</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="button" class="text-red-500 hover:text-red-600 transition">
                                Log out
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 flex justify-end">
                <button type="button" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-medium rounded-md transition duration-200 flex items-center">
                    <i data-lucide="log-out" class="w-4 h-4 mr-1"></i>
                    Log Out All Other Sessions
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Lucide icons
        lucide.createIcons();
        
        // Optional: Add input validation for the 2FA code
        const codeInput = document.getElementById('code');
        if (codeInput) {
            codeInput.addEventListener('input', function(e) {
                // Only allow numbers
                this.value = this.value.replace(/[^0-9]/g, '');
                
                // Limit to 6 digits
                if (this.value.length > 6) {
                    this.value = this.value.slice(0, 6);
                }
            });
        }
    });
</script>
@endsection