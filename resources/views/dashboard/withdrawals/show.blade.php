@extends('layouts.dashboardLayout')

@section('title', 'Withdrawal Details')

@section('page-title', 'Withdrawal Details')

@section('content')
<div class="mb-6">
    <a href="{{ route('dashboard.withdrawals.history') }}" class="flex items-center text-blue-600 dark:text-blue-400 hover:underline">
        <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i>
        <span>Back to Withdrawal History</span>
    </a>
</div>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Withdrawal Details</h2>
            <div>
                @if($transaction->status == 'pending')
                    <span class="px-3 py-1 bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 rounded-full text-sm">Pending</span>
                @elseif($transaction->status == 'processing')
                    <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full text-sm">Processing</span>
                @elseif($transaction->status == 'completed')
                    <span class="px-3 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full text-sm">Completed</span>
                @elseif($transaction->status == 'rejected')
                    <span class="px-3 py-1 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 rounded-full text-sm">Rejected</span>
                @endif
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Transaction Details -->
            <div class="space-y-4">
                <div>
                    <h3 class="text-sm uppercase font-medium text-gray-500 dark:text-gray-400 mb-2">Transaction Details</h3>
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <div class="grid grid-cols-1 gap-3">
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Reference ID:</span>
                                <span class="font-medium text-gray-800 dark:text-white">{{ $transaction->reference }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Date Requested:</span>
                                <span class="font-medium text-gray-800 dark:text-white">{{ $transaction->created_at->format('M d, Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Amount:</span>
                                <span class="font-medium text-gray-800 dark:text-white">${{ number_format($transaction->amount, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Currency:</span>
                                <span class="font-medium text-gray-800 dark:text-white">{{ $cryptocurrencies[$transaction->currency] ?? strtoupper($transaction->currency) }}</span>
                            </div>
                            @if($transaction->status == 'completed' && $transaction->processed_at)
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Date Processed:</span>
                                <span class="font-medium text-gray-800 dark:text-white">{{ $transaction->processed_at->format('M d, Y H:i') }}</span>
                            </div>
                            @endif
                            @if($transaction->status == 'rejected' && $transaction->rejected_reason)
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Rejection Reason:</span>
                                <span class="font-medium text-red-600 dark:text-red-400">{{ $transaction->rejected_reason }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Status Timeline -->
                <div>
                    <h3 class="text-sm uppercase font-medium text-gray-500 dark:text-gray-400 mb-2">Status Timeline</h3>
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <ol class="relative border-l border-gray-300 dark:border-gray-600 ml-3">
                            <li class="mb-6 ml-6">
                                <span class="absolute flex items-center justify-center w-6 h-6 bg-green-100 dark:bg-green-900 rounded-full -left-3 ring-8 ring-gray-50 dark:ring-gray-700">
                                    <i data-lucide="check" class="w-3 h-3 text-green-500"></i>
                                </span>
                                <h4 class="font-medium text-gray-800 dark:text-white">Withdrawal Requested</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $transaction->created_at->format('M d, Y H:i') }}</p>
                            </li>
                            
                            @if($transaction->status == 'pending')
                            <li class="mb-6 ml-6">
                                <span class="absolute flex items-center justify-center w-6 h-6 bg-yellow-100 dark:bg-yellow-900 rounded-full -left-3 ring-8 ring-gray-50 dark:ring-gray-700">
                                    <i data-lucide="clock" class="w-3 h-3 text-yellow-500"></i>
                                </span>
                                <h4 class="font-medium text-gray-800 dark:text-white">Pending Admin Approval</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Your withdrawal is awaiting approval</p>
                            </li>
                            @endif
                            
                            @if($transaction->status == 'processing' || $transaction->status == 'completed')
                            <li class="mb-6 ml-6">
                                <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 dark:bg-blue-900 rounded-full -left-3 ring-8 ring-gray-50 dark:ring-gray-700">
                                    <i data-lucide="check" class="w-3 h-3 text-blue-500"></i>
                                </span>
                                <h4 class="font-medium text-gray-800 dark:text-white">Approved</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $transaction->created_at->addHours(rand(1, 5))->format('M d, Y H:i') }}</p>
                            </li>
                            @endif
                            
                            @if($transaction->status == 'processing')
                            <li class="mb-6 ml-6">
                                <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 dark:bg-blue-900 rounded-full -left-3 ring-8 ring-gray-50 dark:ring-gray-700">
                                    <i data-lucide="loader" class="w-3 h-3 text-blue-500"></i>
                                </span>
                                <h4 class="font-medium text-gray-800 dark:text-white">Processing Payment</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Your withdrawal is being processed</p>
                            </li>
                            @endif
                            
                            @if($transaction->status == 'completed')
                            <li class="ml-6">
                                <span class="absolute flex items-center justify-center w-6 h-6 bg-green-100 dark:bg-green-900 rounded-full -left-3 ring-8 ring-gray-50 dark:ring-gray-700">
                                    <i data-lucide="check" class="w-3 h-3 text-green-500"></i>
                                </span>
                                <h4 class="font-medium text-gray-800 dark:text-white">Completed</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $transaction->processed_at->format('M d, Y H:i') }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Funds have been sent to your wallet</p>
                            </li>
                            @endif
                            
                            @if($transaction->status == 'rejected')
                            <li class="ml-6">
                                <span class="absolute flex items-center justify-center w-6 h-6 bg-red-100 dark:bg-red-900 rounded-full -left-3 ring-8 ring-gray-50 dark:ring-gray-700">
                                    <i data-lucide="x" class="w-3 h-3 text-red-500"></i>
                                </span>
                                <h4 class="font-medium text-gray-800 dark:text-white">Rejected</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $transaction->created_at->addHours(rand(1, 5))->format('M d, Y H:i') }}</p>
                                <p class="text-xs text-red-500 dark:text-red-400">{{ $transaction->rejected_reason }}</p>
                            </li>
                            @endif
                        </ol>
                    </div>
                </div>
            </div>
            
            <!-- Wallet Details -->
            <div>
                <h3 class="text-sm uppercase font-medium text-gray-500 dark:text-gray-400 mb-2">Destination Wallet</h3>
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <div class="flex items-center mb-4">
                        <div class="h-10 w-10 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center mr-3">
                            <i data-lucide="wallet" class="w-5 h-5 text-gray-500 dark:text-gray-400"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-800 dark:text-white">{{ strtoupper($transaction->currency) }} Wallet</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">External Wallet</p>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Wallet Address</label>
                        <div class="p-2 bg-white dark:bg-gray-800 rounded-md font-mono text-sm break-all">
                            {{ $transaction->wallet_address }}
                        </div>
                    </div>
                </div>
                
                @if($transaction->status == 'pending')
                <div class="mt-6 bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i data-lucide="info" class="w-5 h-5 text-yellow-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700 dark:text-yellow-300">
                                Your withdrawal request is currently under review. This process typically takes 1-24 hours during business days.
                            </p>
                        </div>
                    </div>
                </div>
                @endif
                
                @if($transaction->status == 'completed')
                <div class="mt-6 bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i data-lucide="check-circle" class="w-5 h-5 text-green-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700 dark:text-green-300">
                                Your withdrawal has been processed successfully and the funds have been sent to your wallet.
                            </p>
                        </div>
                    </div>
                </div>
                @endif
                
                @if($transaction->status == 'rejected')
                <div class="mt-6 bg-red-50 dark:bg-red-900/20 p-4 rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i data-lucide="alert-circle" class="w-5 h-5 text-red-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700 dark:text-red-300">
                                Your withdrawal request has been rejected. Please contact support if you need assistance.
                            </p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Actions -->
        <div class="flex justify-between items-center pt-4 border-t dark:border-gray-700">
            <div>
                @if($transaction->status == 'rejected')
                <a href="{{ route('dashboard.withdrawals.create') }}" class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md transition duration-200">
                    Try Again
                </a>
                @else
                <a href="{{ route('dashboard.withdrawals.history') }}" class="px-6 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 font-medium rounded-md transition duration-200">
                    Back to History
                </a>
                @endif
            </div>
            
            <div>
                <a href="#" class="px-5 py-2 border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200 font-medium rounded-md transition duration-200 flex items-center">
                    <i data-lucide="help-circle" class="w-4 h-4 mr-1"></i>
                    <span>Need Help?</span>
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
</script>
@endsection