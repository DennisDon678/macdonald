@extends('layouts.dashboardLayout')

@section('title', 'Security Settings')

@section('page-title', 'Security Settings')

@section('content')
    <div class="mb-6">
        <a href="{{ route('dashboard.profile') }}" class="flex items-center text-blue-600 dark:text-blue-400 hover:underline">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i>
            <span>Back to Profile</span>
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-lg">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-6 p-4 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <div class="max-w-2xl mx-auto">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-6">Change Your Withdrawal Wallets</h2>

                <form action="{{ route('dashboard.profile.wallet.update') }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <label for="btc_address" class="block text-gray-700 dark:text-gray-300 mb-2">BTC Address</label>
                        <div class="relative">
                            <input type="text" id="btc_address" name="btc_address"
                                class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ $wallets->btc_address ?? '' }}" >
                        </div>
                        @error('btc_address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="eth_address" class="block text-gray-700 dark:text-gray-300 mb-2">ETH Address</label>
                        <div class="relative">
                            <input type="text" id="eth_address" name="eth_address"
                                class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ $wallets->eth_address ?? '' }}" >
                        </div>
                        @error('eth_address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="usdt_address" class="block text-gray-700 dark:text-gray-300 mb-2">USDT (TRC20) Address</label>
                        <div class="relative">
                            <input type="text" id="usdt_address" name="usdt_address"
                                class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ $wallets->usdt_address ?? '' }}" >
                        </div>
                        @error('usdt_address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md transition duration-200">
                            Update Wallets
                        </button>
                    </div>
                </form>
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
