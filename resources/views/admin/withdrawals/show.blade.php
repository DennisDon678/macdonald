@extends('layouts.adminLayout')

@section('title', 'View Withdrawal')

@section('page-title', 'Withdrawal Details')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
        <div class="px-4 py-5 sm:px-6 border-b dark:border-gray-700 flex justify-between items-center">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                    Withdrawal #{{ $withdrawal->reference }}
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                    Created on {{ $withdrawal->created_at->format('M d, Y H:i') }}
                </p>
            </div>
            <div>
                @if($withdrawal->status === 'pending')
                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                        Pending
                    </span>
                @elseif($withdrawal->status === 'completed')
                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                        Completed
                    </span>
                @elseif($withdrawal->status === 'failed')
                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                        Rejected
                    </span>
                @endif
            </div>
        </div>
        <div class="px-4 py-5 sm:px-6">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        User
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                        {{ $withdrawal->user->name }} ({{ $withdrawal->user->email }})
                    </dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Amount
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white font-semibold">
                        ${{ number_format($withdrawal->amount, 2) }}
                    </dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Cryptocurrency
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                        {{ strtoupper($withdrawal->currency) ?? 'N/A' }}
                    </dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Wallet Address
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white break-all">
                        {{ $withdrawal->wallet_address ?? 'N/A' }}
                    </dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Reference
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                        {{ $withdrawal->reference ?? 'N/A' }}
                    </dd>
                </div>
            </dl>
        </div>
        
        @if($withdrawal->status === 'pending')
        <div class="px-4 py-4 sm:px-6 bg-gray-50 dark:bg-gray-700 flex justify-between">
            <a href="{{ route('admin.withdrawals.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                Back to List
            </a>
            
            <div class="flex space-x-3">
                <form action="{{ route('admin.withdrawals.approve', $withdrawal->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" onclick="return confirm('Are you sure you want to approve this withdrawal?')">
                        Approve
                    </button>
                </form>
                
                <button type="button" id="reject-btn" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Reject
                </button>
            </div>
        </div>
        @else
        <div class="px-4 py-4 sm:px-6 bg-gray-50 dark:bg-gray-700">
            <a href="{{ route('admin.withdrawals.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                Back to List
            </a>
        </div>
        @endif
    </div>
</div>

<!-- Rejection Modal -->
<div id="rejection-modal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl max-w-md w-full">
        <div class="px-6 py-4 border-b dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Reject Withdrawal</h3>
        </div>
        <form method="POST" action="{{ route('admin.withdrawals.reject', $withdrawal->id) }}">
            @csrf
            
            <div class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-right">
                <button type="button" id="cancel-btn" class="inline-flex justify-center py-2 px-4 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </button>
                <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Reject
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('rejection-modal');
        const rejectBtn = document.getElementById('reject-btn');
        const cancelBtn = document.getElementById('cancel-btn');
        
        if (rejectBtn) {
            // Show modal when reject button is clicked
            rejectBtn.addEventListener('click', function() {
                modal.classList.remove('hidden');
            });
        }
        
        if (cancelBtn) {
            // Hide modal when cancel button is clicked
            cancelBtn.addEventListener('click', function() {
                modal.classList.add('hidden');
            });
        }
        
        // Hide modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });
    });
</script>
@endsection
