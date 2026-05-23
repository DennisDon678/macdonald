@extends('layouts.dashboardLayout')

@section('title', 'My Investments')

@section('page-title', 'Investment Portfolio')

@section('content')
<div class="mb-6">
    <a href="{{ route('dashboard') }}" class="flex items-center text-blue-600 dark:text-blue-400 hover:underline">
        <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i>
        <span>Back to Dashboard</span>
    </a>
</div>

<!-- Stats Summary -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Invested</p>
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white">${{ number_format($stats['total_invested'], 2) }}</h3>
            </div>
            <div class="p-2 bg-blue-50 dark:bg-blue-900/30 rounded-lg">
                <i data-lucide="trending-up" class="w-6 h-6 text-blue-500"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Profit Earned</p>
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white">${{ number_format($stats['total_earned'], 2) }}</h3>
            </div>
            <div class="p-2 bg-green-50 dark:bg-green-900/30 rounded-lg">
                <i data-lucide="dollar-sign" class="w-6 h-6 text-green-500"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Daily Earnings</p>
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white">${{ number_format($stats['daily_earnings'], 2) }}</h3>
            </div>
            <div class="p-2 bg-yellow-50 dark:bg-yellow-900/30 rounded-lg">
                <i data-lucide="calendar" class="w-6 h-6 text-yellow-500"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Active Investments</p>
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $stats['active_investments'] }}</h3>
            </div>
            <div class="p-2 bg-purple-50 dark:bg-purple-900/30 rounded-lg">
                <i data-lucide="pie-chart" class="w-6 h-6 text-purple-500"></i>
            </div>
        </div>
    </div>
</div>

<!-- Active Investments -->
<div class="mb-8">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Active Investments</h2>
    
    @if($activeInvestments->isEmpty())
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
        <div class="py-8 text-center">
            <div class="mb-4 flex justify-center">
                <i data-lucide="pie-chart" class="w-16 h-16 text-gray-300 dark:text-gray-600"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">No active investments</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-6">Start investing to see your investments here</p>
            <a href="{{ route('dashboard.deposits.create') }}" class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md transition duration-200">
                Make Your First Investment
            </a>
        </div>
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($activeInvestments as $investment)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-lg font-medium text-gray-800 dark:text-white">{{ $investment['plan_name'] }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Started {{ $investment['created_at']->diffForHumans() }}</p>
                    </div>
                    <span class="px-2 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full text-xs">Active</span>
                </div>
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Principal</p>
                        <p class="text-lg font-semibold text-gray-800 dark:text-white">${{ number_format($investment['amount'], 2) }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Profit Earned</p>
                        <p class="text-lg font-semibold text-green-600 dark:text-green-400">${{ number_format($investment['total_profit'], 2) }}</p>
                    </div>
                </div>
                
                <div class="mb-4">
                    <div class="flex justify-between mb-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-300">Progress</span>
                        <span class="text-gray-700 dark:text-gray-300">{{ (($investment['duration'] - $investment['days_remaining'])/$investment['duration'])*100 }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                        <div class="bg-blue-500 h-2.5 rounded-full" style="width: {{ (($investment['duration'] - $investment['days_remaining'])/$investment['duration'])*100 }}%"></div>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-3 gap-2 text-center text-xs mb-4">
                    <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded">
                        <p class="text-gray-500 dark:text-gray-400">Daily Profit</p>
                        <p class="text-blue-600 dark:text-blue-400 font-medium">${{ number_format($investment['daily_profit'], 2) }}</p>
                    </div>
                    <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded">
                        <p class="text-gray-500 dark:text-gray-400">Next Payout</p>
                        <p class="text-blue-600 dark:text-blue-400 font-medium">{{$investment['next_payout'] ? $investment['next_payout']->format('M d, Y'): "Unkown"  }}</p>
                    </div>
                    <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded col-span-2 md:col-span-1">
                        <p class="text-gray-500 dark:text-gray-400">Days Remaining</p>
                        <p class="text-blue-600 dark:text-blue-400 font-medium">{{ $investment['days_remaining'] }}</p>
                    </div>
                </div>
                
                <div class="flex justify-end">
                    <a href="{{ route('dashboard.investments.show', $investment['reference']) }}" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md transition duration-200">
                        View Details
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>

<!-- Completed Investments -->
<div>
    <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Completed Investments</h2>
    
    @if($completedInvestments->isEmpty())
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
        <div class="py-8 text-center">
            <p class="text-gray-500 dark:text-gray-400">No completed investments yet.</p>
        </div>
    </div>
    @else
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-700">
                        <th class="px-6 py-3">Plan</th>
                        <th class="px-6 py-3">Principal</th>
                        <th class="px-6 py-3">Total Profit</th>
                        <th class="px-6 py-3">Duration</th>
                        <th class="px-6 py-3">Completed</th>
                        <th class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($completedInvestments as $investment)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div>
                                <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $investment['plan_name'] }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $investment['created_at']->format('M d, Y') }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                            ${{ number_format($investment['amount'], 2) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 dark:text-green-400 font-medium">
                            ${{ number_format($investment['total_profit'], 2) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                            {{ $investment['duration'] }} days
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                            {{ $investment['completed_at']->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <a href="{{ route('dashboard.investments.show', $investment['reference']) }}" class="text-blue-600 dark:text-blue-400 hover:underline">View Details</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
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