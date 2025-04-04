@extends('layouts.dashboardLayout')

@section('title', 'Complete Your Deposit')

@section('page-title', 'Complete Your Deposit')

@section('content')
<div class="mb-6">
    <a href="{{ route('dashboard') }}" class="flex items-center text-blue-600 dark:text-blue-400 hover:underline">
        <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i>
        <span>Back to Dashboard</span>
    </a>
</div>

@if(session('success'))
<div class="mb-6 p-4 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-lg">
    {{ session('success') }}
</div>
@endif

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
    <div class="p-6">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-6">Complete Your Deposit</h2>
        
        <!-- Transaction Details -->
        <div class="mb-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-4">Transaction Details</h3>
                
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-400">Reference ID:</span>
                        <span class="font-medium text-gray-800 dark:text-white">{{ $transaction['reference'] }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-400">Amount:</span>
                        <span class="font-medium text-gray-800 dark:text-white">${{ number_format($transaction['amount'], 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-400">Plan:</span>
                        <span class="font-medium text-gray-800 dark:text-white">{{ $plan['name'] }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-400">Daily Interest Rate:</span>
                        <span class="font-medium text-gray-800 dark:text-white">{{ $plan['interest_rate'] }}%</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-400">Duration:</span>
                        <span class="font-medium text-gray-800 dark:text-white">{{ $plan['duration'] }} days</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-400">Status:</span>
                        <span class="px-2 py-1 bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 rounded-full text-xs">Pending</span>
                    </div>
                </div>
            </div>
            
            <div>
                <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-4">Payment Details</h3>
                
                <div class="p-4 border dark:border-gray-700 rounded-lg text-center">
                    <div class="flex items-center justify-center mb-3">
                        <img src="{{ $crypto['icon'] }}" alt="{{ $crypto['name'] }}" class="h-8 w-8 mr-2">
                        <span class="font-medium text-gray-800 dark:text-white">{{ $crypto['name'] }}</span>
                    </div>
                    
                    <!-- QR Code (replace with actual QR code generation) -->
                    <div class="mb-4 flex justify-center">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $crypto['address'] }}" alt="QR Code" class="w-32 h-32">
                    </div>
                    
                    <div class="mb-4">
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">Send exactly this amount:</div>
                        <div class="text-lg font-bold text-gray-800 dark:text-white">${{ number_format($transaction['amount'], 2) }} worth of {{ $crypto['code'] }}</div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">To this address:</div>
                        <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded-md font-mono text-sm break-all">
                            {{ $crypto['address'] }}
                        </div>
                        <button class="mt-2 text-blue-500 hover:text-blue-600 text-sm flex items-center justify-center w-full" onclick="copyToClipboard('{{ $crypto['address'] }}')">
                            <i data-lucide="copy" class="w-4 h-4 mr-1"></i> Copy Address
                        </button>
                    </div>
                    
                    @if(isset($crypto['network']))
                    <div class="text-sm text-red-500 font-medium mb-4">
                        Important: Send only on {{ $crypto['network'] }} network
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Instructions -->
        <div class="mb-6">
            <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-3">Instructions</h3>
            <ol class="list-decimal pl-5 space-y-2 text-gray-600 dark:text-gray-300">
                <li>Send the exact amount to the provided address.</li>
                <li>Make sure you're using the correct network (if specified).</li>
                <li>After sending, please allow up to 30 minutes for the transaction to be confirmed on the blockchain.</li>
                <li>Once confirmed, your investment will be automatically activated.</li>
                <li>You'll receive an email notification when your investment is active.</li>
            </ol>
        </div>
        
        <!-- Actions -->
        <div class="flex justify-between items-center pt-4 border-t dark:border-gray-700">
            <div class="text-gray-500 dark:text-gray-400">
                <p>Having issues? <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">Contact support</a></p>
            </div>
            
            <div>
                <a href="{{ route('dashboard.deposits.history') }}" class="px-6 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 font-medium rounded-md transition duration-200">
                    View Deposit History
                </a>
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
    
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            alert('Address copied to clipboard');
        }, function(err) {
            console.error('Could not copy text: ', err);
        });
    }
</script>
@endsection