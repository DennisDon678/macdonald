@extends('layouts.dashboardLayout')

@section('title', 'Investment Details')

@section('page-title', 'Investment Details')

@section('content')
<div class="mb-6">
    <a href="{{ route('dashboard.investments') }}" class="flex items-center text-blue-600 dark:text-blue-400 hover:underline">
        <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i>
        <span>Back to Investments</span>
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <h2 class="text-lg font-medium text-gray-800 dark:text-white mb-4">Investment Summary</h2>
        <div class="space-y-3">
            <div class="flex justify-between">
                <span class="text-gray-500 dark:text-gray-400">Plan:</span>
                <span class="font-medium text-gray-800 dark:text-white">{{ $investment['plan_name'] }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500 dark:text-gray-400">Amount:</span>
                <span class="font-medium text-gray-800 dark:text-white">${{ number_format($investment['amount'], 2) }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500 dark:text-gray-400">Daily Interest:</span>
                <span class="font-medium text-gray-800 dark:text-white">{{ $investment['interest_rate'] }}%</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500 dark:text-gray-400">Duration:</span>
                <span class="font-medium text-gray-800 dark:text-white">{{ $investment['duration'] }} days</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500 dark:text-gray-400">Status:</span>
                @if($investment['status'] == 'active')
                    <span class="px-2 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full text-xs">Active</span>
                @elseif($investment['status'] == 'completed')
                    <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full text-xs">Completed</span>
                @elseif($investment['status'] == 'pending')
                    <span class="px-2 py-1 bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 rounded-full text-xs">Pending</span>
                @endif
            </div>
            <div class="pt-2 border-t dark:border-gray-700">
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Deposit Reference:</span>
                    <span class="font-medium text-gray-800 dark:text-white">{{ $investment['deposit_reference'] }}</span>
                </div>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500 dark:text-gray-400">Payment Method:</span>
                <span class="font-medium text-gray-800 dark:text-white">{{ $investment['deposit_method'] }}</span>
            </div>
        </div>
    </div>
    
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <h2 class="text-lg font-medium text-gray-800 dark:text-white mb-4">Return Details</h2>
        <div class="space-y-3">
            <div class="flex justify-between">
                <span class="text-gray-500 dark:text-gray-400">Daily Profit:</span>
                <span class="font-medium text-green-600 dark:text-green-400">${{ number_format($investment['daily_profit'], 2) }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500 dark:text-gray-400">Current Profit:</span>
                <span class="font-medium text-green-600 dark:text-green-400">${{ number_format($investment['profit_to_date'], 2) }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500 dark:text-gray-400">Expected Total Return:</span>
                <span class="font-medium text-green-600 dark:text-green-400">${{ number_format($investment['total_expected_return'], 2) }}</span>
            </div>
            @if($investment['status'] == 'active')
            <div class="flex justify-between">
                <span class="text-gray-500 dark:text-gray-400">Next Payout:</span>
                <span class="font-medium text-gray-800 dark:text-white">{{ $investment['next_payout']->format('M d, Y') }}</span>
            </div>
            @endif
        </div>
        
        <!-- Progress Bar -->
        <div class="mt-6">
            <div class="flex justify-between mb-1 text-xs">
                <span class="text-gray-500 dark:text-gray-400">Investment Progress</span>
                @php
                $startDate = $investment['created_at'];
                $endDate = $investment['end_date'];
                $totalDays = $startDate->diffInDays($endDate);
                $daysElapsed = $startDate->diffInDays(now());
                $percentComplete = min(100, round(($daysElapsed / $totalDays) * 100));
                @endphp
                <span class="text-gray-500 dark:text-gray-400">{{ $percentComplete }}%</span>
            </div>
            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $percentComplete }}%"></div>
            </div>
            <div class="flex justify-between mt-1 text-xs">
                <span class="text-gray-500 dark:text-gray-400">{{ $investment['created_at']->format('M d, Y') }}</span>
                <span class="text-gray-500 dark:text-gray-400">{{ $investment['end_date']->format('M d, Y') }}</span>
            </div>
        </div>
    </div>
    
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <h2 class="text-lg font-medium text-gray-800 dark:text-white mb-4">Investment Period</h2>
        <div class="space-y-3">
            <div class="flex justify-between">
                <span class="text-gray-500 dark:text-gray-400">Start Date:</span>
                <span class="font-medium text-gray-800 dark:text-white">{{ $investment['created_at']->format('M d, Y') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500 dark:text-gray-400">End Date:</span>
                <span class="font-medium text-gray-800 dark:text-white">{{ $investment['end_date']->format('M d, Y') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500 dark:text-gray-400">Days Remaining:</span>
                @php
                $daysRemaining = now()->diffInDays($investment['end_date'], false);
                @endphp
                <span class="font-medium text-gray-800 dark:text-white">
                    @if($daysRemaining > 0)
                        {{ $daysRemaining }} days
                    @else
                        Completed
                    @endif
                </span>
            </div>
        </div>
        
        <div class="mt-6">
            @if($investment['status'] == 'active')
            <a href="#" class="block text-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-md transition duration-200 mb-2">
                Request Early Termination
            </a>
            <p class="text-xs text-gray-500 dark:text-gray-400 text-center">
                Early termination may incur penalties.
            </p>
            @elseif($investment['status'] == 'completed')
            <div class="p-3 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-md text-center text-sm">
                This investment has been completed and all profits have been credited to your account.
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Transaction History -->
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
    <div class="p-6">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-6">Transaction History</h2>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-xs uppercase font-medium text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700">
                        <th class="py-2 px-4">Date</th>
                        <th class="py-2 px-4">Description</th>
                        <th class="py-2 px-4">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700 text-sm text-gray-600 dark:text-gray-400">{{ $transaction['created_at']->format('M d, Y') }}</td>
                        <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700 text-sm text-gray-600 dark:text-gray-400">{{ $transaction['description'] }}</td>
                        <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700 text-sm text-gray-600 dark:text-gray-400">${{ number_format($transaction['amount'], 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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