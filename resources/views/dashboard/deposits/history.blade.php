@extends('layouts.dashboardLayout')

@section('title', 'Deposit History')

@section('page-title', 'Deposit History')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Your Deposits</h2>
            <a href="{{ route('dashboard.deposits.create') }}" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md transition duration-200 flex items-center">
                <i data-lucide="plus" class="w-4 h-4 mr-1"></i>
                <span>New Deposit</span>
            </a>
        </div>
        
        @if($transactions->isEmpty())
        <div class="py-8 text-center">
            <div class="mb-4 flex justify-center">
                <i data-lucide="inbox" class="w-16 h-16 text-gray-300 dark:text-gray-600"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">No deposits yet</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-6">Make your first deposit to start investing</p>
            <a href="{{ route('dashboard.deposits.create') }}" class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md transition duration-200">
                Create Deposit
            </a>
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-700">
                        <th class="px-4 py-3">Reference</th>
                        <th class="px-4 py-3">Date</th>
                        <th class="px-4 py-3">Amount</th>
                        <th class="px-4 py-3">Currency</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($transactions as $transaction)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-4 py-3 text-sm font-medium text-gray-800 dark:text-gray-200">{{ $transaction['reference'] }}</td>
                        <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-400">{{ $transaction['created_at']->format('M d, Y H:i') }}</td>
                        <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">${{ number_format($transaction['amount'], 2) }}</td>
                        <td class="px-4 py-3 text-sm">
                            <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-full text-xs uppercase">{{ $transaction['currency'] }}</span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            @if($transaction['status'] == 'pending')
                                <span class="px-2 py-1 bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 rounded-full text-xs">Pending</span>
                            @elseif($transaction['status'] == 'completed')
                                <span class="px-2 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full text-xs">Completed</span>
                            @elseif($transaction['status'] == 'failed')
                                <span class="px-2 py-1 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 rounded-full text-xs">Failed</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm">
                            @if($transaction['status'] == 'pending')
                                <a href="{{ route('dashboard.deposits.confirm', $transaction['reference']) }}" class="text-blue-600 dark:text-blue-400 hover:underline">Complete Payment</a>
                            @else
                                <a href="{{ route('dashboard.deposits.show', $transaction['id']) }}" class="text-blue-600 dark:text-blue-400 hover:underline">View Details</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-6">
            {{ $transactions->links() }}
        </div>
        @endif
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