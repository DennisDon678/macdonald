@extends('layouts.dashboardLayout')

@section('title', 'Referrals')

@section('page-title', 'Referral Program')

@section('content')
<div class="mb-6">
    <a href="{{ route('dashboard') }}" class="flex items-center text-blue-600 dark:text-blue-400 hover:underline">
        <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i>
        <span>Back to Dashboard</span>
    </a>
</div>

<!-- Referral Link Section -->
<div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg shadow-lg p-6 mb-8">
    <div class="text-white">
        <h2 class="text-xl font-bold mb-2">Your Referral Link</h2>
        <p class="mb-4 text-blue-100">Share this link with friends and earn commission on their investments</p>
        
        <div class="bg-white/20 rounded-lg p-4 flex flex-col sm:flex-row items-center justify-between">
            <div class="w-full sm:w-auto mb-3 sm:mb-0 overflow-hidden">
                <input 
                    type="text" 
                    id="referral-link" 
                    value="{{ route('register',[
                    'ref' => $user->referral_code->code,
                    ]) }}" 
                    class="w-full sm:w-80 lg:w-96 px-4 py-2 rounded-md text-gray-800 text-sm font-mono bg-white/90 border-0 focus:ring-2 focus:ring-blue-300" 
                    readonly
                >
            </div>
            <div class="flex space-x-2">
                <button 
                    onclick="copyToClipboard('referral-link')" 
                    class="px-4 py-2 bg-white text-blue-600 hover:bg-blue-50 rounded-md font-medium text-sm flex items-center"
                >
                    <i data-lucide="copy" class="w-4 h-4 mr-1"></i>
                    Copy Link
                </button>
                <button 
                    onclick="shareReferral()" 
                    class="px-4 py-2 bg-white text-blue-600 hover:bg-blue-50 rounded-md font-medium text-sm flex items-center"
                >
                    <i data-lucide="share-2" class="w-4 h-4 mr-1"></i>
                    Share
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Referrals</p>
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $stats['total_referrals'] }}</h3>
            </div>
            <div class="p-2 bg-blue-50 dark:bg-blue-900/30 rounded-lg">
                <i data-lucide="users" class="w-6 h-6 text-blue-500"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Earnings</p>
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white">${{ number_format($stats['total_earnings'], 2) }}</h3>
            </div>
            <div class="p-2 bg-green-50 dark:bg-green-900/30 rounded-lg">
                <i data-lucide="dollar-sign" class="w-6 h-6 text-green-500"></i>
            </div>
        </div>
        
    </div>
   
</div>

<!-- Recent Referrals -->
<div class="mb-8">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Recent Referrals</h2>
    </div>
    
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
        @if($recentReferrals->isEmpty())
        <div class="py-8 text-center">
            <div class="mb-4 flex justify-center">
                <i data-lucide="users" class="w-16 h-16 text-gray-300 dark:text-gray-600"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">No referrals yet</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-6">Share your referral link to start earning commissions</p>
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-700">
                        <th class="px-6 py-3">User</th>
                        <th class="px-6 py-3">Date</th>
                        <th class="px-6 py-3">Your Earnings</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($recentReferrals as $referral)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                                    <span class="text-gray-600 dark:text-gray-300 font-medium">{{ substr($referral['name'], 0, 1) }}</span>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $referral['name'] }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $referral['email'] }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                            {{ $referral['date']->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-green-600 dark:text-green-400">
                            ${{ number_format($referral['earnings'], 2) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

<!-- How It Works -->
<div class="mb-8">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">How Our Referral Program Works</h2>
    
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center">
                <div class="mx-auto w-12 h-12 bg-blue-100 dark:bg-blue-900/50 rounded-full flex items-center justify-center mb-3">
                    <i data-lucide="link" class="w-6 h-6 text-blue-500"></i>
                </div>
                <h3 class="font-medium text-gray-800 dark:text-white mb-2">1. Share Your Link</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">Share your unique referral link with friends, family, or followers</p>
            </div>
            
            <div class="text-center">
                <div class="mx-auto w-12 h-12 bg-purple-100 dark:bg-purple-900/50 rounded-full flex items-center justify-center mb-3">
                    <i data-lucide="user-plus" class="w-6 h-6 text-purple-500"></i>
                </div>
                <h3 class="font-medium text-gray-800 dark:text-white mb-2">2. They Sign Up</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">When someone uses your link to register and invest</p>
            </div>
            
            <div class="text-center">
                <div class="mx-auto w-12 h-12 bg-green-100 dark:bg-green-900/50 rounded-full flex items-center justify-center mb-3">
                    <i data-lucide="dollar-sign" class="w-6 h-6 text-green-500"></i>
                </div>
                <h3 class="font-medium text-gray-800 dark:text-white mb-2">3. Earn Commission</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">You earn commission on their investments automatically</p>
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
    });
    
    function copyToClipboard(elementId, text = null) {
        let copyText = text;
        if (!copyText) {
            const element = document.getElementById(elementId);
            copyText = element.value || element.textContent;
        }
        
        navigator.clipboard.writeText(copyText).then(function() {
            // Show a temporary tooltip or notification
            alert('Copied to clipboard: ' + copyText);
        }, function(err) {
            console.error('Could not copy text: ', err);
        });
    }
    
    function shareReferral() {
        if (navigator.share) {
            navigator.share({
                title: '{{env('APP_NAME')}}',
                text: 'Check out this investment management platform I\'m using. Sign up with my referral link:',
                url: document.getElementById('referral-link').value
            })
            .then(() => console.log('Share successful'))
            .catch((error) => console.log('Error sharing:', error));
        } else {
            // Fallback for browsers that don't support the Web Share API
            copyToClipboard('referral-link');
        }
    }
</script>
@endsection