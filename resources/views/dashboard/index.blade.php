@extends('layouts.dashboardLayout')

@section('title', 'Dashboard')

@section('page-title', 'Welcome to Your Dashboard')

@section('content')
    <!-- Account Balance - Full Width -->
    <div class="mb-6 bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Account Balance</h3>
            <div class="flex space-x-1">
                <span class="block w-3 h-3 bg-blue-500 rounded-full animate-pulse"></span>
                <span class="block w-3 h-3 bg-green-500 rounded-full animate-pulse" style="animation-delay: 0.2s"></span>
                <span class="block w-3 h-3 bg-purple-500 rounded-full animate-pulse" style="animation-delay: 0.4s"></span>
            </div>
        </div>
        <div class="mt-4 flex flex-col md:flex-row justify-between">
            <div>
                <p class="text-3xl font-bold text-gray-800 dark:text-white">${{ number_format($balances->balance, 2) }}</p>
                {{-- <div class="flex items-center text-green-500 mt-2">
                    <i data-lucide="trending-up" class="w-4 h-4"></i>
                    <span class="ml-1 text-sm">+5.2% from last week</span>
                </div> --}}
            </div>
            <div class="mt-4 md:mt-0 grid grid-cols-2 gap-4">
                <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <p class="text-xs text-gray-500 dark:text-gray-400">Pending Withdrawal</p>
                    <p class="font-medium text-gray-800 dark:text-white">${{ number_format($pending->withdrawal, 2) }}</p>
                </div>

                <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <p class="text-xs text-gray-500 dark:text-gray-400">Pending Deposit</p>
                    <p class="font-medium text-gray-800 dark:text-white">${{ number_format($pending->deposit, 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Deposit and Total Earnings - Half Width Each -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Active Deposit -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Active Deposit</h3>
                <div class="flex space-x-1">
                    <span class="block w-3 h-3 bg-yellow-500 rounded-full animate-pulse"></span>
                    <span class="block w-3 h-3 bg-orange-500 rounded-full animate-pulse"
                        style="animation-delay: 0.2s"></span>
                    <span class="block w-3 h-3 bg-red-500 rounded-full animate-pulse" style="animation-delay: 0.4s"></span>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-3xl font-bold text-gray-800 dark:text-white">${{ number_format($active_deposits,2) }}</p>
            </div>
            <hr class="my-4 border-gray-300 dark:border-gray-600">
            <div class="mt-4">
                {{-- list of how it was gotten --}}
                <ol class="list-decimal list-inside text-gray-600 dark:text-gray-400">
                    <li>Current active investments</li>
                    <li>Pending and completed investments are not shown here</li>
                </ol>
            </div>
        </div>

        <!-- Total Earnings -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Total Earnings</h3>
                <div class="flex space-x-1">
                    <span class="block w-3 h-3 bg-emerald-500 rounded-full animate-pulse"></span>
                    <span class="block w-3 h-3 bg-teal-500 rounded-full animate-pulse" style="animation-delay: 0.2s"></span>
                    <span class="block w-3 h-3 bg-cyan-500 rounded-full animate-pulse" style="animation-delay: 0.4s"></span>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-3xl font-bold text-gray-800 dark:text-white">
                    ${{ number_format($interest + $balances->referal_balances, 2) }}</p>
                <div class="flex items-center text-green-500 mt-2">
                    
                </div>
            </div>
            <div class="mt-4 grid grid-cols-2 gap-3">
                <div class="px-3 py-2 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <p class="text-xs text-gray-500 dark:text-gray-400">Interest</p>
                    <p class="font-medium text-gray-800 dark:text-white">${{ number_format($interest, 2) }}</p>
                </div>
                <div class="px-3 py-2 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <p class="text-xs text-gray-500 dark:text-gray-400">Referrals</p>
                    <p class="font-medium text-gray-800 dark:text-white">
                        ${{ number_format($balances->referal_balances, 2) }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Recent Transactions</h3>
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="text-left text-gray-500 dark:text-gray-400 text-sm uppercase">
                        <th class="pb-3">Transaction ID</th>
                        <th class="pb-3">Date</th>
                        <th class="pb-3">Type</th>
                        <th class="pb-3">Amount</th>
                        <th class="pb-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">

                    @forelse ($transactions as $transaction)
                        <tr>
                            <td class="py-3 text-gray-700 dark:text-gray-300">{{ $transaction->reference }}</td>
                            <td class="py-3 text-gray-700 dark:text-gray-300">
                                {{ $transaction->created_at->format('M d, Y') }}</td>
                            <td class="py-3 text-gray-700 dark:text-gray-300">{{ $transaction->type }}</td>
                            <td class="py-3 text-red-600 dark:text-red-400">{{ $transaction->amount }}</td>
                            <td class="py-3">
                                <span
                                    class="px-2 py-1 rounded-full text-xs 
                                    @if ($transaction->status === 'completed') bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 
                                    @elseif($transaction->status === 'pending') 
                                        bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 
                                    @elseif($transaction->status === 'failed') 
                                        bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 @endif">
                                    {{ $transaction->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-3 text-center text-gray-500 dark:text-gray-400">
                                No transactions found.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Initialize Lucide icons for the dashboard content
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
        });
    </script>
@endsection
