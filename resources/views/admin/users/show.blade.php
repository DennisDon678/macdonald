@extends('layouts.adminLayout')

@section('title', 'User Details')

@section('page-title', 'User Details')

@section('content')
    @if (session('success'))
        <div class="mb-6 px-4 py-3 rounded bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-6 px-4 py-3 rounded bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200">
            {{ session('error') }}
        </div>
    @endif
    <!-- User Header -->
    <div class="mb-6 bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="flex items-center mb-4 md:mb-0">
                    <div
                        class="h-16 w-16 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-300 text-2xl font-semibold">
                        {{ strtoupper(substr($user['name'], 0, 1)) }}
                    </div>
                    <div class="ml-4">
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white">{{ ucfirst($user['name']) }}</h2>
                        <p class="text-gray-500 dark:text-gray-400">{{ $user['email'] }}</p>

                    </div>
                </div>
                <div class="flex flex-wrap gap-2">
                    <button x-data @click="$dispatch('open-modal', 'adjust-balance-modal')"
                        class="px-4 py-2 bg-purple-500 text-white rounded-md hover:bg-purple-600 inline-flex items-center">
                        <i data-lucide="wallet" class="w-4 h-4 mr-1"></i>
                        Adjust Balance
                    </button>
                    <a href="{{ route('admin.users.login-as', $user['id']) }}" target="_blank"
                        class="px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600 inline-flex items-center">
                        <i data-lucide="log-in" class="w-4 h-4 mr-1"></i>
                        Login as User
                    </a>
                    <a href="{{ route('admin.users.edit-password', $user) }}"
                        class="px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600 inline-flex items-center">
                        <i data-lucide="log-in" class="w-4 h-4 mr-1"></i>
                        Change Password
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- User Stats -->
    <div class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-full">
                    <i data-lucide="wallet" class="w-6 h-6 text-blue-500"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Account Balance</h3>
                    <p class="text-xl font-semibold text-gray-800 dark:text-white">
                        ${{ number_format($user['balances']->balance, 2) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-full">
                    <i data-lucide="trending-up" class="w-6 h-6 text-green-500"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Active Investments</h3>
                    <p class="text-xl font-semibold text-gray-800 dark:text-white">{{ count($user['investments']) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <div class="flex items-center">
                <div class="p-3 bg-purple-100 dark:bg-purple-900/30 rounded-full">
                    <i data-lucide="users" class="w-6 h-6 text-purple-500"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Referrals</h3>
                    <p class="text-xl font-semibold text-gray-800 dark:text-white">{{ count($user['referrals']) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <div class="flex items-center">
                <div class="p-3 bg-amber-100 dark:bg-amber-900/30 rounded-full">
                    <i data-lucide="calendar" class="w-6 h-6 text-amber-500"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Joined</h3>
                    <p class="text-xl font-semibold text-gray-800 dark:text-white">
                        {{ $user['created_at']->format('M-m-Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Balance Adjustment Modal -->
    <div x-data="{
        show: false,
        type: 'credit',
        amount: 0,
        description: '',
        focusInput() {
            this.$nextTick(() => {
                this.$refs.amountInput.focus();
            });
        }
    }" x-show="show"
        x-on:open-modal.window="$event.detail == 'adjust-balance-modal' ? (show = true, focusInput()) : null"
        x-on:close-modal.window="show = false" x-on:keydown.escape.window="show = false"
        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" @click="show = false"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="show" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                @click.away="show = false">
                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white" id="modal-title">
                                Adjust User Balance
                            </h3>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                You can credit (add) or debit (subtract) from the user's balance.
                                Current balance: ${{ number_format($user['balance'], 2) }}
                            </p>

                            <form action="{{ route('admin.users.adjust-balance', $user['id']) }}" method="POST"
                                class="mt-4">
                                @csrf
                                @method('POST')

                                <div class="mb-4">
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Transaction
                                        Type</label>
                                    <div class="flex space-x-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="transaction_type" value="credit"
                                                class="form-radio text-blue-600" x-model="type" checked>
                                            <span class="ml-2 text-gray-700 dark:text-gray-300">Credit (Add Funds)</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="transaction_type" value="debit"
                                                class="form-radio text-red-600" x-model="type">
                                            <span class="ml-2 text-gray-700 dark:text-gray-300">Debit (Remove Funds)</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="amount"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Amount
                                        ($)</label>
                                    <div class="relative rounded-md shadow-sm">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                            <span class="text-gray-500 sm:text-sm">$</span>
                                        </div>
                                        <input type="number" name="amount" id="amount" x-model="amount"
                                            x-ref="amountInput" step="0.01" min="0.01"
                                            class="block w-full pl-7 pr-12 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                            placeholder="0.00" required>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="description"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description
                                        / Reason</label>
                                    <textarea name="description" id="description" x-model="description" rows="3"
                                        class="block w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                        placeholder="Provide a reason for this transaction" required></textarea>
                                </div>

                                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                    <button type="submit"
                                        :class="type === 'credit' ? 'bg-blue-600 hover:bg-blue-700 focus:ring-blue-500' :
                                            'bg-red-600 hover:bg-red-700 focus:ring-red-500'"
                                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">
                                        <span x-text="type === 'credit' ? 'Credit Account' : 'Debit Account'"></span>
                                    </button>
                                    <button type="button" @click="show = false"
                                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-700 text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:w-auto sm:text-sm">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Details Tabs -->
    <div x-data="{ activeTab: 'general' }">
        <!-- Tab Navigation -->
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px">
                <li class="mr-2">
                    <button @click="activeTab = 'general'"
                        :class="activeTab === 'general' ? 'border-blue-500 text-blue-600 dark:text-blue-500' :
                            'border-transparent hover:border-gray-300 dark:hover:border-gray-600 text-gray-500 dark:text-gray-400 hover:text-gray-600 dark:hover:text-gray-300'"
                        class="inline-block py-4 px-4 font-medium text-center border-b-2 rounded-t-lg">
                        General Information
                    </button>
                </li>
                <li class="mr-2">
                    <button @click="activeTab = 'investments'"
                        :class="activeTab === 'investments' ? 'border-blue-500 text-blue-600 dark:text-blue-500' :
                            'border-transparent hover:border-gray-300 dark:hover:border-gray-600 text-gray-500 dark:text-gray-400 hover:text-gray-600 dark:hover:text-gray-300'"
                        class="inline-block py-4 px-4 font-medium text-center border-b-2 rounded-t-lg">
                        Investments
                    </button>
                </li>
                <li class="mr-2">
                    <button @click="activeTab = 'transactions'"
                        :class="activeTab === 'transactions' ? 'border-blue-500 text-blue-600 dark:text-blue-500' :
                            'border-transparent hover:border-gray-300 dark:hover:border-gray-600 text-gray-500 dark:text-gray-400 hover:text-gray-600 dark:hover:text-gray-300'"
                        class="inline-block py-4 px-4 font-medium text-center border-b-2 rounded-t-lg">
                        Transactions
                    </button>
                </li>
            </ul>
        </div>

        <!-- Tab Content -->
        <div x-show="activeTab === 'general'" class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-4">Account Information</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Full Name</p>
                                <p class="text-gray-800 dark:text-white">{{ $user['name'] }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Email Address</p>
                                <p class="text-gray-800 dark:text-white">{{ $user['email'] }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Registration Date</p>
                                <p class="text-gray-800 dark:text-white">{{ $user['created_at'] }}</p>
                            </div>

                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-4">Referral Information</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Referred By</p>
                                <p class="text-gray-800 dark:text-white">{{ $user['referrer']->referrer_email ?? 'None' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Referral Count</p>
                                <p class="text-gray-800 dark:text-white">{{ count($user['referrals']) }} users</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="activeTab === 'investments'" class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden"
            style="display: none;">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr
                            class="text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider bg-gray-50 dark:bg-gray-700">
                            <th class="px-6 py-3">Plan</th>
                            <th class="px-6 py-3">Amount</th>
                            <th class="px-6 py-3">Expected Return</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Created Date</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($user['investments'] as $investment)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $investment['plan']->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        ${{ number_format($investment['amount'], 2) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        ${{ number_format($investment['total_expected_return'], 2) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        {{ ucfirst($investment['status']) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $investment['created_at'] }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="#"
                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No investments found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div x-show="activeTab === 'transactions'" class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden"
            style="display: none;">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr
                            class="text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider bg-gray-50 dark:bg-gray-700">
                            <th class="px-6 py-3">Type</th>
                            <th class="px-6 py-3">Amount</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Date</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @php
                            $transactions = array_merge(
                                array_map(function ($deposit) {
                                    return array_merge($deposit, ['type' => 'deposit']);
                                }, $user['deposits']->toArray() ?? []),
                                array_map(function ($withdrawal) {
                                    return array_merge($withdrawal, ['type' => 'withdrawal']);
                                }, $user['withdrawals']->toArray() ?? []),
                            );

                            usort($transactions, function ($a, $b) {
                                return strtotime($b['created_at']) - strtotime($a['created_at']);
                            });
                        @endphp

                        @forelse($transactions as $transaction)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center">
                                        @if ($transaction['type'] == 'deposit')
                                            <span class="w-2 h-2 mr-2 bg-green-500 rounded-full"></span>
                                            Deposit
                                        @else
                                            <span class="w-2 h-2 mr-2 bg-red-500 rounded-full"></span>
                                            Withdrawal
                                        @endif
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div
                                        class="text-sm font-medium {{ $transaction['type'] == 'deposit' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                        {{ $transaction['type'] == 'deposit' ? '+' : '-' }}${{ number_format($transaction['amount'], 2) }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $transaction['status'] === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' }}">
                                        {{ ucfirst($transaction['status']) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $transaction['created_at'] }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="#"
                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No transactions found
                                </td>
                            </tr>
                        @endforelse
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
