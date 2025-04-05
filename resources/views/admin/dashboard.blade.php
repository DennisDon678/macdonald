@extends('layouts.adminLayout')

@section('title', 'Dashboard')

@section('page-title', 'Admin Dashboard')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Users</p>
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $stats['total_users'] }}</h3>
                <p class="text-sm text-green-500">+{{ $stats['new_users_today'] }} today</p>
            </div>
            <div class="p-3 bg-blue-50 dark:bg-blue-900/30 rounded-lg">
                <i data-lucide="users" class="w-6 h-6 text-blue-500"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Investments</p>
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white">${{ number_format($stats['total_invested'], 2) }}</h3>
                <p class="text-sm text-green-500">+${{ number_format($stats['invested_today'], 2) }} today</p>
            </div>
            <div class="p-3 bg-green-50 dark:bg-green-900/30 rounded-lg">
                <i data-lucide="trending-up" class="w-6 h-6 text-green-500"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Deposits</p>
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white">${{ number_format($stats['total_deposits'], 2) }}</h3>
                <p class="text-sm text-green-500">+${{ number_format($stats['deposited_today'], 2) }} today</p>
            </div>
            <div class="p-3 bg-purple-50 dark:bg-purple-900/30 rounded-lg">
                <i data-lucide="arrow-down-circle" class="w-6 h-6 text-purple-500"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Withdrawals</p>
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white">${{ number_format($stats['total_withdrawals'], 2) }}</h3>
                <p class="text-sm text-red-500">+${{ number_format($stats['withdrawn_today'], 2) }} today</p>
            </div>
            <div class="p-3 bg-orange-50 dark:bg-orange-900/30 rounded-lg">
                <i data-lucide="arrow-up-circle" class="w-6 h-6 text-orange-500"></i>
            </div>
        </div>
    </div>
</div>

<!-- Pending Items Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
        <div class="p-4 bg-blue-50 dark:bg-blue-900/20">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-gray-800 dark:text-white">Pending Deposits</h3>
                <span class="px-2 py-1 bg-blue-100 dark:bg-blue-800 text-blue-800 dark:text-blue-200 text-xs font-medium rounded-full">{{ $pendingDeposits }}</span>
            </div>
        </div>
        <div class="p-4">
            @if($pendingDeposits > 0)
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">There are {{ $pendingDeposits }} pending deposits that require your approval.</p>
                <a href="{{ route('admin.deposits.index') }}?status=pending" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-blue-600">
                    View All
                </a>
            @else
                <p class="text-sm text-gray-600 dark:text-gray-400">No pending deposits at this time.</p>
            @endif
        </div>
    </div>
    
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
        <div class="p-4 bg-green-50 dark:bg-green-900/20">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-gray-800 dark:text-white">Pending Withdrawals</h3>
                <span class="px-2 py-1 bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-200 text-xs font-medium rounded-full">{{ $pendingWithdrawals }}</span>
            </div>
        </div>
        <div class="p-4">
            @if($pendingWithdrawals > 0)
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">There are {{ $pendingWithdrawals }} pending withdrawals that require your approval.</p>
                <a href="{{ route('admin.withdrawals.index') }}?status=pending" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-green-600">
                    View All
                </a>
            @else
                <p class="text-sm text-gray-600 dark:text-gray-400">No pending withdrawals at this time.</p>
            @endif
        </div>
    </div>
    
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
        <div class="p-4 bg-purple-50 dark:bg-purple-900/20">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-gray-800 dark:text-white">Pending Investments</h3>
                <span class="px-2 py-1 bg-purple-100 dark:bg-purple-800 text-purple-800 dark:text-purple-200 text-xs font-medium rounded-full">{{ $pendingInvestments }}</span>
            </div>
        </div>
        <div class="p-4">
            @if($pendingInvestments > 0)
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">There are {{ $pendingInvestments }} pending investments that require your approval.</p>
                <a href="{{ route('admin.investments.index') }}?status=pending" class="inline-flex items-center px-4 py-2 bg-purple-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-purple-600">
                    View All
                </a>
            @else
                <p class="text-sm text-gray-600 dark:text-gray-400">No pending investments at this time.</p>
            @endif
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden mb-8">
    <div class="p-6 border-b dark:border-gray-700">
        <h3 class="text-lg font-medium text-gray-800 dark:text-white">Recent Activity</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider bg-gray-50 dark:bg-gray-700">
                    <th class="px-6 py-3">Action</th>
                    <th class="px-6 py-3">User</th>
                    <th class="px-6 py-3">Details</th>
                    <th class="px-6 py-3">Time</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($recentActivities as $activity)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center">
                            @if($activity['type'] == 'deposit')
                                <span class="w-2 h-2 mr-2 bg-green-500 rounded-full"></span>
                                New Deposit
                            @elseif($activity['type'] == 'withdrawal')
                                <span class="w-2 h-2 mr-2 bg-red-500 rounded-full"></span>
                                New Withdrawal
                            @elseif($activity['type'] == 'investment')
                                <span class="w-2 h-2 mr-2 bg-blue-500 rounded-full"></span>
                                New Investment
                            @elseif($activity['type'] == 'registration')
                                <span class="w-2 h-2 mr-2 bg-purple-500 rounded-full"></span>
                                New Registration
                            @endif
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $activity['user'] }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $activity['details'] }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                        {{ $activity['time'] }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize any dashboard-specific JS here
    });
</script>
@endsection