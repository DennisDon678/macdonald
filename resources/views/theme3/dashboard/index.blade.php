@extends('layouts.dashboardLayout')

@section('title', 'Dashboard Overview')

@section('page-title', 'Overview')

@section('content')
    <!-- Top Account Balance Widget - Theme 3 Navy & Gold Luxury Card -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#0b1220] via-[#111c30] to-[#1a253d] p-6 md:p-8 text-white shadow-2xl shadow-black/40 mb-8 border border-[#d4af37]/30 transition-transform duration-300 hover:scale-[1.003]">
        <!-- Decorative glowing blur elements -->
        <div class="absolute -right-12 -top-12 w-48 h-48 bg-[#d4af37]/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -left-12 -bottom-12 w-48 h-48 bg-[#f5df91]/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <div class="flex items-center space-x-2 text-[#f4d77a] text-xs font-bold tracking-wider uppercase mb-2">
                    <span class="w-2 h-2 rounded-full bg-[#d4af37] animate-pulse"></span>
                    <span>Verified Portfolio Balance</span>
                </div>
                <p class="text-4xl md:text-5xl font-extrabold tracking-tight text-white">${{ number_format($balances->balance, 2) }}</p>
                <p class="text-xs text-gray-400 mt-2 font-medium">Available balance for immediate withdrawals & new investments</p>
            </div>
            
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('dashboard.deposits.create') }}" class="gold-button flex items-center justify-center px-6 py-3.5 rounded-xl text-sm font-bold shadow-lg">
                    <i data-lucide="plus-circle" class="w-4 h-4 mr-2"></i>
                    <span>Quick Deposit</span>
                </a>
                <a href="{{ route('dashboard.withdrawals.create') }}" class="flex items-center justify-center px-6 py-3.5 bg-white/10 hover:bg-white/15 border border-white/20 text-white font-bold rounded-xl shadow-lg transition-all duration-200">
                    <i data-lucide="download" class="w-4 h-4 mr-2"></i>
                    <span>Request Payout</span>
                </a>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-white/10 grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="flex items-center space-x-3 bg-white/5 backdrop-blur-sm border border-white/10 px-5 py-3.5 rounded-2xl">
                <div class="p-2.5 bg-[#d4af37]/15 rounded-xl text-[#f4d77a]">
                    <i data-lucide="clock" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="text-[10px] uppercase text-gray-400 font-bold tracking-widest leading-none">Pending Deposit</p>
                    <p class="text-lg font-bold text-white mt-1.5">${{ number_format($pending->deposit, 2) }}</p>
                </div>
            </div>

            <div class="flex items-center space-x-3 bg-white/5 backdrop-blur-sm border border-white/10 px-5 py-3.5 rounded-2xl">
                <div class="p-2.5 bg-amber-500/15 rounded-xl text-amber-300">
                    <i data-lucide="send" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="text-[10px] uppercase text-gray-400 font-bold tracking-widest leading-none">Pending Withdrawal</p>
                    <p class="text-lg font-bold text-white mt-1.5">${{ number_format($pending->withdrawal, 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Deposit and Total Earnings Columns -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        
        <!-- Active Deposit Card -->
        <div class="glass-card shadow-premium rounded-3xl p-6 sm:p-7 relative overflow-hidden transition-all duration-300 hover:shadow-lg">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-3">
                    <div class="p-3 bg-[#fbf6e7] dark:bg-[#d4af37]/10 rounded-2xl text-[#947312] dark:text-[#f4d77a]">
                        <i data-lucide="trending-up" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Active Deposits</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Total locked in active investment cycles</p>
                    </div>
                </div>
                <span class="flex h-3 w-3 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#d4af37] opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-[#d4af37]"></span>
                </span>
            </div>
            
            <div class="my-4">
                <p class="text-4xl font-extrabold text-gray-900 dark:text-white">${{ number_format($active_deposits, 2) }}</p>
            </div>
            
            <div class="p-4 bg-gray-50 dark:bg-white/[.03] rounded-2xl border border-gray-100 dark:border-white/10 mt-6">
                <h4 class="text-xs font-bold text-[#947312] dark:text-[#f4d77a] uppercase tracking-widest mb-2 flex items-center">
                    <i data-lucide="info" class="w-3.5 h-3.5 mr-1.5"></i>
                    <span>Portfolio Status</span>
                </h4>
                <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300 font-medium">
                    <li class="flex items-center">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-[#d4af37] mr-2 flex-shrink-0"></i>
                        <span>Generates automated daily ROI profit distributions</span>
                    </li>
                    <li class="flex items-center">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-[#d4af37] mr-2 flex-shrink-0"></i>
                        <span>Principal returns automatically upon plan maturity</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Total Earnings Card -->
        <div class="glass-card shadow-premium rounded-3xl p-6 sm:p-7 relative overflow-hidden transition-all duration-300 hover:shadow-lg">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-3">
                    <div class="p-3 bg-emerald-50 dark:bg-emerald-500/10 rounded-2xl text-emerald-600 dark:text-emerald-400">
                        <i data-lucide="award" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Accumulated Earnings</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Total profits generated to date</p>
                    </div>
                </div>
                <div class="p-1 px-3 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 text-xs font-bold rounded-xl flex items-center">
                    <i data-lucide="arrow-up-right" class="w-3.5 h-3.5 mr-1"></i>
                    <span>ROI Live</span>
                </div>
            </div>
            
            <div class="my-4">
                <p class="text-4xl font-extrabold text-gray-900 dark:text-white">${{ number_format($interest + $balances->referral_balance, 2) }}</p>
            </div>
            
            <div class="grid grid-cols-2 gap-4 mt-6">
                <div class="p-4 bg-gray-50 dark:bg-white/[.03] rounded-2xl border border-gray-100 dark:border-white/10">
                    <span class="text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest">Plan Profits</span>
                    <p class="text-xl font-bold text-gray-900 dark:text-white mt-1">${{ number_format($interest, 2) }}</p>
                </div>
                <div class="p-4 bg-gray-50 dark:bg-white/[.03] rounded-2xl border border-gray-100 dark:border-white/10">
                    <span class="text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest">Referral Rewards</span>
                    <p class="text-xl font-bold text-gray-900 dark:text-white mt-1">${{ number_format($balances->referral_balance, 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Transactions Table Card -->
    <div class="glass-card shadow-premium rounded-3xl overflow-hidden mb-8 border border-gray-200/50 dark:border-white/10">
        <div class="p-6 border-b border-gray-100 dark:border-white/10 flex justify-between items-center bg-white/40 dark:bg-white/[.02]">
            <div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Recent Transactions</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400">Your latest platform financial ledger</p>
            </div>
            <i data-lucide="activity" class="w-5 h-5 text-[#d4af37]"></i>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider bg-gray-50/60 dark:bg-white/[.02]">
                        <th class="px-6 py-4">Transaction Reference</th>
                        <th class="px-6 py-4">Execution Date</th>
                        <th class="px-6 py-4">Type</th>
                        <th class="px-6 py-4">Amount</th>
                        <th class="px-6 py-4">Process Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                    @forelse ($transactions as $transaction)
                        <tr class="hover:bg-gray-100/40 dark:hover:bg-white/[.02] transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-800 dark:text-white">
                                <span class="font-mono text-xs bg-gray-100 dark:bg-white/5 px-2 py-1 rounded-md">{{ $transaction->reference }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                                {{ $transaction->created_at->format('M d, Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300 font-medium">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-xl text-xs font-bold uppercase tracking-wider
                                    @if ($transaction->type === 'deposit') bg-emerald-100 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400
                                    @elseif($transaction->type === 'withdrawal') bg-amber-100 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400
                                    @else bg-purple-100 dark:bg-purple-900/20 text-purple-700 dark:text-purple-400 @endif">
                                    <i data-lucide="{{ $transaction->type === 'deposit' ? 'arrow-up-right' : 'arrow-down-left' }}" class="w-3 h-3 mr-1"></i>
                                    <span>{{ $transaction->type }}</span>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold 
                                @if ($transaction->type === 'deposit') text-emerald-600 dark:text-emerald-400
                                @elseif($transaction->type === 'withdrawal') text-amber-600 dark:text-amber-400
                                @else text-[#d4af37] @endif">
                                ${{ number_format($transaction->amount, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-xl text-xs font-semibold
                                    @if ($transaction->status === 'completed') bg-emerald-100 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 
                                    @elseif($transaction->status === 'pending') bg-yellow-100 dark:bg-yellow-950/40 text-yellow-700 dark:text-yellow-300 
                                    @else bg-red-100 dark:bg-red-950/40 text-red-700 dark:text-red-300 @endif">
                                    <span class="w-1.5 h-1.5 rounded-full mr-1.5
                                        @if ($transaction->status === 'completed') bg-emerald-500 
                                        @elseif($transaction->status === 'pending') bg-yellow-500 
                                        @else bg-red-500 @endif"></span>
                                    <span>{{ ucfirst($transaction->status) }}</span>
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <i data-lucide="file-text" class="w-10 h-10 text-gray-300 dark:text-gray-600"></i>
                                    <p class="font-medium">No transactions recorded yet</p>
                                </div>
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
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
@endsection
