@extends('layouts.dashboardLayout')

@section('title', 'Make Withdrawal')

@section('page-title', 'Make Withdrawal')

@section('content')
<div class="mb-6">
    <a href="{{ route('dashboard') }}" class="flex items-center text-blue-600 dark:text-blue-400 hover:underline">
        <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i>
        <span>Back to Dashboard</span>
    </a>
</div>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
    <div class="p-6">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-6">Withdraw Funds</h2>
        
        @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 rounded-lg">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <!-- Balance Information -->
        <div class="mb-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="p-4 bg-blue-50 dark:bg-blue-900/30 rounded-lg">
                <div class="text-sm text-blue-600 dark:text-blue-400 mb-1">Available Balance</div>
                <div class="text-2xl font-bold text-gray-800 dark:text-white">${{ number_format($availableBalance, 2) }}</div>
            </div>
            <div class="p-4 bg-yellow-50 dark:bg-yellow-900/30 rounded-lg">
                <div class="text-sm text-yellow-600 dark:text-yellow-400 mb-1">Pending Withdrawals</div>
                <div class="text-2xl font-bold text-gray-800 dark:text-white">${{ number_format($pendingWithdrawals, 2) }}</div>
            </div>
        </div>
        
        <form action="{{ route('dashboard.withdrawals.store') }}" method="POST" id="withdrawal-form">
            @csrf
            
            <div class="mb-6">
                <label for="amount" class="block text-gray-700 dark:text-gray-300 mb-2">Withdrawal Amount ($)</label>
                <input 
                    type="number" 
                    id="amount" 
                    name="amount" 
                    step="0.01" 
                    min="20" 
                    max="{{ $availableBalance }}"
                    class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('amount') ?? 100 }}"
                    required
                >
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    Minimum withdrawal: $20.00
                </p>
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 dark:text-gray-300 mb-2">Select Cryptocurrency</label>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach($cryptocurrencies as $code => $crypto)
                    <div class="border dark:border-gray-700 rounded-lg p-4 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer crypto-option {{ old('crypto') == $code ? 'ring-2 ring-blue-500' : '' }}">
                        <input type="radio" name="crypto" value="{{ $code }}" id="crypto-{{ $code }}" class="hidden" {{ (old('crypto') == $code || ($loop->first && old('crypto') == null)) ? 'checked' : '' }}>
                        <label for="crypto-{{ $code }}" class="flex items-center cursor-pointer">
                            <div class="flex-shrink-0 mr-3">
                                <img src="{{ $crypto['icon'] }}" alt="{{ $crypto['name'] }}" class="w-8 h-8">
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-800 dark:text-white">{{ $crypto['name'] }} ({{ $crypto['code'] }})</p>
                                @if(isset($crypto['network']))
                                <p class="text-xs text-gray-500 dark:text-gray-400">Network: {{ $crypto['network'] }}</p>
                                @endif
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    Min: {{ $crypto['min_withdrawal'] }} {{ $crypto['code'] }} | Fee: {{ $crypto['withdrawal_fee'] }} {{ $crypto['code'] }}
                                </p>
                            </div>
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 dark:text-gray-300 mb-2">Withdrawal Address</label>
                
                @if(count($savedWallets) > 0)
                <div class="mb-3">
                    <label class="text-sm text-gray-600 dark:text-gray-400 mb-2">Select from saved wallets</label>
                    <select id="saved-wallets" class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Select a saved wallet --</option>
                        @foreach($savedWallets as $wallet)
                        <option value="{{ $wallet['address'] }}" data-currency="{{ $wallet['currency'] }}" data-name="{{ $wallet['name'] }}">
                            {{ $wallet['name'] }} ({{ strtoupper($wallet['currency']) }})
                        </option>
                        @endforeach
                    </select>
                </div>
                @endif
                
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <label for="wallet_address" class="block text-sm text-gray-600 dark:text-gray-400 mb-1">Wallet Address</label>
                        <input 
                            type="text" 
                            id="wallet_address" 
                            name="wallet_address" 
                            class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 font-mono text-sm"
                            value="{{ old('wallet_address') }}"
                            placeholder="Enter your wallet address"
                            required
                        >
                    </div>
                    <div class="md:w-1/3">
                        <label for="wallet_name" class="block text-sm text-gray-600 dark:text-gray-400 mb-1">Wallet Name (Optional)</label>
                        <input 
                            type="text" 
                            id="wallet_name" 
                            name="wallet_name" 
                            class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ old('wallet_name') }}"
                            placeholder="e.g. My Binance Wallet"
                        >
                    </div>
                </div>
                
                <div class="mt-3">
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            id="save_wallet" 
                            name="save_wallet" 
                            value="1" 
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                            {{ old('save_wallet') ? 'checked' : '' }}
                        >
                        <label for="save_wallet" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                            Save this wallet for future withdrawals
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="mb-6 p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <i data-lucide="alert-triangle" class="w-5 h-5 text-yellow-500"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-200">Important</h3>
                        <div class="mt-2 text-sm text-yellow-700 dark:text-yellow-300">
                            <ul class="list-disc pl-5 space-y-1">
                                <li>Please ensure you have entered the correct wallet address.</li>
                                <li>Withdrawals are processed within 24 hours during business days.</li>
                                <li>A small network fee may be charged for processing your withdrawal.</li>
                                <li>Make sure you are sending to an address on the correct network.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('dashboard') }}" class="px-6 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 font-medium rounded-md transition duration-200">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md transition duration-200">
                    Submit Withdrawal
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Lucide icons
        lucide.createIcons();
        
        // Crypto selection
        const cryptoOptions = document.querySelectorAll('.crypto-option');
        cryptoOptions.forEach(option => {
            option.addEventListener('click', function() {
                // Uncheck all radios
                document.querySelectorAll('input[name="crypto"]').forEach(radio => radio.checked = false);
                
                // Check the clicked one
                this.querySelector('input[name="crypto"]').checked = true;
                
                // Add selected styling
                cryptoOptions.forEach(opt => opt.classList.remove('ring-2', 'ring-blue-500'));
                this.classList.add('ring-2', 'ring-blue-500');
            });
        });
        
        // Saved wallets handling
        const savedWalletsSelect = document.getElementById('saved-wallets');
        if (savedWalletsSelect) {
            savedWalletsSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                
                if (selectedOption.value) {
                    const walletAddress = selectedOption.value;
                    const walletName = selectedOption.dataset.name;
                    const walletCurrency = selectedOption.dataset.currency;
                    
                    // Fill in the form fields
                    document.getElementById('wallet_address').value = walletAddress;
                    document.getElementById('wallet_name').value = walletName;
                    
                    // Select the corresponding crypto
                    const cryptoRadio = document.getElementById('crypto-' + walletCurrency);
                    if (cryptoRadio) {
                        cryptoRadio.checked = true;
                        
                        // Update styling
                        cryptoOptions.forEach(opt => opt.classList.remove('ring-2', 'ring-blue-500'));
                        cryptoRadio.closest('.crypto-option').classList.add('ring-2', 'ring-blue-500');
                    }
                }
            });
        }
    });
</script>
@endsection