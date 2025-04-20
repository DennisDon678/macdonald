@extends('layouts.adminLayout')

@section('title', 'Investment Details')

@section('page-title', 'Investment Details')

@section('content')
    <!-- Investment Header -->
    <div class="mb-6 bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <div class="flex items-center mb-2">
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white">Investment #{{ $investment['reference'] }}</h2>
                        <span class="ml-3 inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                            @if($investment['status'] == 'active') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                            @elseif($investment['status'] == 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                            @elseif($investment['status'] == 'completed') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                            @elseif($investment['status'] == 'terminated') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                            @elseif($investment['status'] == 'rejected') bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300
                            @endif">
                            {{ ucfirst($investment['status']) }}
                        </span>
                    </div>
                    <p class="text-gray-500 dark:text-gray-400">Created on {{ $investment['created_at'] }}</p>
                    <div class="mt-2">
                        <a href="{{ route('admin.users.show', $investment['user']['id']) }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline flex items-center">
                            <span class="flex-shrink-0 h-6 w-6 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-300 text-xs mr-2">
                                {{ substr($investment['user']['name'], 0, 1) }}
                            </span>
                            {{ $investment['user']['name'] }} ({{ $investment['user']['email'] }})
                        </a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    <!-- Investment Details -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <div class="border-b dark:border-gray-700 px-6 py-4">
                <h3 class="text-lg font-medium text-gray-800 dark:text-white">Investment Details</h3>
            </div>
            <div class="p-6">
                <dl class="space-y-4">
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Plan</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $investment['plan']['name'] }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Amount</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">${{ number_format($investment['amount'], 2) }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">ROI</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ number_format($investment['plan']['interest_rate']* $investment['duration'],2) }}%</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Expected Return</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">${{ number_format($investment['return_amount'], 2) }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Duration</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $investment['plan']['duration'] }} days</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Start Date</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $investment['start_date'] ?? 'Not started' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">End Date</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $investment['end_date'] ?? 'Not determined' }}</dd>
                    </div>
                    @if($investment['status'] == 'terminated' || $investment['status'] == 'rejected')
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Reason</dt>
                            <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $investment['reason'] ?? 'No reason provided' }}</dd>
                        </div>
                    @endif
                </dl>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <div class="border-b dark:border-gray-700 px-6 py-4">
                <h3 class="text-lg font-medium text-gray-800 dark:text-white">Progress</h3>
            </div>
            <div class="p-6">
                @if($investment['status'] == 'active')
                    <div class="mb-4">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400">{{ $investment['days_passed'] }} days of {{ $investment['plan']['duration'] }} days</span>
                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400">{{ $investment['progress_percentage'] }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $investment['progress_percentage'] }}%"></div>
                        </div>
                    </div>
                @endif
                
                <dl class="space-y-4">
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Days Passed</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $investment['duration'] - $investment['days_remaining'] ?? 0 }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Days Remaining</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $investment['days_remaining'] ?? 0 }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Earned So Far</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">${{ number_format($investment['profit_to_date'] ?? 0, 2) }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Daily Profit</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">${{ number_format($investment['daily_profit'] ?? 0, 2) }}</dd>
                    </div>
                </dl>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <div class="border-b dark:border-gray-700 px-6 py-4">
                <h3 class="text-lg font-medium text-gray-800 dark:text-white">Transactions</h3>
            </div>
            <div class="p-6">
                @if(count($investment['transactions']) > 0)
                    <div class="space-y-4">
                        @foreach($investment['transactions'] as $transaction)
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-8 h-8 rounded-full {{ $transaction['type'] == 'profit' ? 'bg-green-100 dark:bg-green-900' : 'bg-blue-100 dark:bg-blue-900' }} flex items-center justify-center">
                                    <i data-lucide="{{ $transaction['type'] == 'profit' ? 'trending-up' : 'arrow-right' }}" class="w-4 h-4 {{ $transaction['type'] == 'profit' ? 'text-green-500 dark:text-green-400' : 'text-blue-500 dark:text-blue-400' }}"></i>
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ ucfirst($transaction['type']) }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $transaction['date'] }}</p>
                                </div>
                                <div class="text-sm font-medium {{ $transaction['type'] == 'profit' ? 'text-green-600 dark:text-green-400' : 'text-blue-600 dark:text-blue-400' }}">
                                    {{ $transaction['type'] == 'profit' ? '+' : '' }}${{ number_format($transaction['amount'], 2) }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-500 dark:text-gray-400">No transactions yet.</p>
                @endif
            </div>
        </div>
    </div>
    
    {{-- <!-- Activity Log -->
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden mb-6">
        <div class="border-b dark:border-gray-700 px-6 py-4">
            <h3 class="text-lg font-medium text-gray-800 dark:text-white">Activity Log</h3>
        </div>
        <div class="p-6">
            <div class="flow-root">
                <ul role="list" class="-mb-8">
                    @foreach($investment['activities'] as $activity)
                        <li>
                            <div class="relative pb-8">
                                @if(!$loop->last)
                                    <span class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-200 dark:bg-gray-700" aria-hidden="true"></span>
                                @endif
                                <div class="relative flex items-start space-x-3">
                                    <div class="relative">
                                        <div class="h-10 w-10 rounded-full bg-{{ $activity['color'] }}-100 dark:bg-{{ $activity['color'] }}-900 flex items-center justify-center ring-8 ring-white dark:ring-gray-800">
                                            <i data-lucide="{{ $activity['icon'] }}" class="h-5 w-5 text-{{ $activity['color'] }}-500 dark:text-{{ $activity['color'] }}-400"></i>
                                        </div>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $activity['action'] }}</div>
                                            <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">{{ $activity['date'] }}</p>
                                        </div>
                                        <div class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                                            <p>{{ $activity['description'] }}</p>
                                            @if(isset($activity['user']))
                                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">By: {{ $activity['user']['name'] }} ({{ $activity['user']['role'] }})</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div> --}}
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Lucide icons
        lucide.createIcons();
    });
</script>
@endsection