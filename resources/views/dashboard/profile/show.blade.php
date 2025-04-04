@extends('layouts.dashboardLayout')

@section('title', 'My Profile')

@section('page-title', 'My Profile')

@section('content')
<div class="mb-6">
    <a href="{{ route('dashboard') }}" class="flex items-center text-blue-600 dark:text-blue-400 hover:underline">
        <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i>
        <span>Back to Dashboard</span>
    </a>
</div>

@if(session('success'))
<div class="mb-6 p-4 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-lg">
    {{ session('success') }}
</div>
@endif

<!-- Profile Information -->
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden mb-8">
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Personal Information</h2>
            <div>
                <button id="edit-profile-btn" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md transition duration-200 flex items-center">
                    <i data-lucide="edit" class="w-4 h-4 mr-1"></i>
                    <span>Edit Profile</span>
                </button>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-1">
                <div class="flex flex-col items-center">
                    <div class="h-32 w-32 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center overflow-hidden mb-3">
                        @if($user->avatar)
                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                        @else
                            <i data-lucide="user" class="w-16 h-16 text-gray-400"></i>
                        @endif
                    </div>
                    <h3 class="text-lg font-medium text-gray-800 dark:text-white">{{ $user->name }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Member since {{ $user->created_at->format('M Y') }}</p>
                </div>
            </div>
            
            <div class="md:col-span-2">
                <!-- View Profile Information -->
                <div id="profile-info" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Full Name</label>
                        <p class="text-gray-800 dark:text-white font-medium">{{ $user->name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Email Address</label>
                        <p class="text-gray-800 dark:text-white font-medium">{{ $user->email }}</p>
                        @if($user->email_verified)
                            <span class="text-xs px-2 py-0.5 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full">Verified</span>
                        @else
                            <span class="text-xs px-2 py-0.5 bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 rounded-full">Unverified</span>
                        @endif
                    </div>
                    <div>
                        <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Phone Number</label>
                        <p class="text-gray-800 dark:text-white font-medium">{{ $user->phone ?? 'Not set' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Country</label>
                        <p class="text-gray-800 dark:text-white font-medium">{{ $user->country ?? 'Not set' }}</p>
                    </div>
                </div>
                
                <!-- Edit Profile Form -->
                <form id="edit-profile-form" action="{{ route('dashboard.profile.update') }}" method="POST" enctype="multipart/form-data" class="hidden">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="name" class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Full Name</label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                value="{{ $user->name }}" 
                                class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required
                            >
                        </div>
                        <div>
                            <label for="email" class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Email Address</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ $user->email }}" 
                                class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required
                            >
                        </div>
                        <div>
                            <label for="phone" class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Phone Number</label>
                            <input 
                                type="tel" 
                                id="phone" 
                                name="phone" 
                                value="{{ $user->phone }}" 
                                class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                        </div>
                        <div>
                            <label for="country" class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Country</label>
                            <input 
                                type="text" 
                                id="country" 
                                name="country" 
                                value="{{ $user->country }}" 
                                class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="avatar" class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Profile Picture</label>
                        <input 
                            type="file" 
                            id="avatar" 
                            name="avatar" 
                            accept="image/jpeg,image/png,image/jpg" 
                            class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Maximum file size: 2MB. Supported formats: JPG, PNG</p>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button type="button" id="cancel-edit" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 font-medium rounded-md transition duration-200">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md transition duration-200">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Security Settings -->
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden mb-8">
    <div class="p-6">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Security Settings</h2>
        
        <div class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                <div class="md:col-span-2">
                    <h3 class="font-medium text-gray-800 dark:text-white">Password</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Change your account password regularly to maintain security.</p>
                </div>
                <div class="md:text-right">
                    <a href="{{ route('dashboard.profile.password') }}" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md transition duration-200 inline-block">
                        Change Password
                    </a>
                </div>
            </div>
            
            <div class="border-t dark:border-gray-700 pt-4"></div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                <div class="md:col-span-2">
                    <h3 class="font-medium text-gray-800 dark:text-white">Two-Factor Authentication</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Add an extra layer of security to your account.</p>
                </div>
                <div class="md:text-right">
                    @if($user->two_factor_enabled)
                        <button class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-medium rounded-md transition duration-200">
                            Disable 2FA
                        </button>
                    @else
                        <a href="{{ route('dashboard.profile.two-factor') }}" class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white font-medium rounded-md transition duration-200 inline-block">
                            Enable 2FA
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Saved Wallets -->
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden mb-8">
    <div class="p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Saved Wallets</h2>
            <button id="add-wallet-btn" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md transition duration-200 flex items-center">
                <i data-lucide="plus" class="w-4 h-4 mr-1"></i>
                <span>Add Wallet</span>
            </button>
        </div>
        
        <!-- Add Wallet Form -->
        <div id="add-wallet-form" class="mb-6 hidden">
            <form action="{{ route('dashboard.profile.wallets.store') }}" method="POST" class="border dark:border-gray-700 rounded-lg p-4">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="wallet_name" class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Wallet Name</label>
                        <input 
                            type="text" 
                            id="wallet_name" 
                            name="name" 
                            placeholder="e.g. My Bitcoin Wallet" 
                            class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required
                        >
                    </div>
                    <div>
                        <label for="currency" class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Currency</label>
                        <select 
                            id="currency" 
                            name="currency" 
                            class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required
                        >
                            <option value="">Select Currency</option>
                            <option value="btc">Bitcoin (BTC)</option>
                            <option value="eth">Ethereum (ETH)</option>
                            <option value="usdt">Tether (USDT)</option>
                            <option value="usdc">USD Coin (USDC)</option>
                        </select>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="address" class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Wallet Address</label>
                    <input 
                        type="text" 
                        id="address" 
                        name="address" 
                        placeholder="Enter your wallet address" 
                        class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 font-mono text-sm"
                        required
                    >
                </div>
                
                <div class="mb-4">
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            id="is_default" 
                            name="is_default" 
                            value="1" 
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                        >
                        <label for="is_default" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                            Set as default wallet for this currency
                        </label>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" id="cancel-add-wallet" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 font-medium rounded-md transition duration-200">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md transition duration-200">
                        Save Wallet
                    </button>
                </div>
            </form>
        </div>
        
        @if(count($wallets) > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-700">
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Currency</th>
                            <th class="px-4 py-3">Address</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($wallets as $wallet)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-4 py-3 text-sm font-medium text-gray-800 dark:text-gray-200">{{ $wallet['name'] }}</td>
                            <td class="px-4 py-3 text-sm">
                                <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-full text-xs uppercase">{{ $wallet['currency'] }}</span>
                            </td>
                            <td class="px-4 py-3 text-xs font-mono text-gray-600 dark:text-gray-400 truncate max-w-xs">{{ $wallet['address'] }}</td>
                            <td class="px-4 py-3 text-sm">
                                @if($wallet['is_default'])
                                <span class="px-2 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full text-xs">Default</span>
                                @else
                                <span class="text-gray-500 dark:text-gray-400 text-xs">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <div class="flex items-center space-x-3">
                                    <button onclick="copyToClipboard('{{ $wallet['address'] }}')" class="text-blue-600 dark:text-blue-400 hover:text-blue-800">
                                        <i data-lucide="copy" class="w-4 h-4"></i>
                                    </button>
                                    <form action="{{ route('dashboard.profile.wallets.delete', $wallet['id']) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this wallet?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-800">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="py-8 text-center">
                <div class="mb-4 flex justify-center">
                    <i data-lucide="wallet" class="w-16 h-16 text-gray-300 dark:text-gray-600"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">No wallets saved yet</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-4">Add wallet addresses for faster withdrawals</p>
            </div>
        @endif
    </div>
</div>

<!-- Account Activity -->
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
    <div class="p-6">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Recent Account Activity</h2>
        
        @if(count($activities) > 0)
            <div class="space-y-4">
                @foreach($activities as $activity)
                <div class="flex items-start border-b dark:border-gray-700 pb-3 last:border-0 last:pb-0">
                    <div class="flex-shrink-0 mr-3">
                        @if($activity['type'] == 'login')
                            <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                                <i data-lucide="log-in" class="w-5 h-5 text-blue-500"></i>
                            </div>
                        @elseif($activity['type'] == 'profile_update')
                            <div class="w-10 h-10 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                                <i data-lucide="user-check" class="w-5 h-5 text-green-500"></i>
                            </div>
                        @elseif($activity['type'] == 'withdrawal')
                            <div class="w-10 h-10 rounded-full bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center">
                                <i data-lucide="arrow-up-right" class="w-5 h-5 text-yellow-500"></i>
                            </div>
                        @elseif($activity['type'] == 'deposit')
                            <div class="w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                                <i data-lucide="arrow-down-left" class="w-5 h-5 text-purple-500"></i>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-800 dark:text-white">{{ $activity['description'] }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">IP: {{ $activity['ip_address'] }}</p>
                            </div>
                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $activity['created_at']->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="py-8 text-center">
                <p class="text-gray-500 dark:text-gray-400">No recent activity found.</p>
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
        
        // Profile edit functionality
        const profileInfoDiv = document.getElementById('profile-info');
        const editProfileForm = document.getElementById('edit-profile-form');
        const editProfileBtn = document.getElementById('edit-profile-btn');
        const cancelEditBtn = document.getElementById('cancel-edit');
        
        editProfileBtn.addEventListener('click', function() {
            profileInfoDiv.classList.add('hidden');
            editProfileForm.classList.remove('hidden');
        });
        
        cancelEditBtn.addEventListener('click', function() {
            profileInfoDiv.classList.remove('hidden');
            editProfileForm.classList.add('hidden');
        });
        
        // Add wallet functionality
        const addWalletBtn = document.getElementById('add-wallet-btn');
        const addWalletForm = document.getElementById('add-wallet-form');
        const cancelAddWalletBtn = document.getElementById('cancel-add-wallet');
        
        addWalletBtn.addEventListener('click', function() {
            addWalletForm.classList.remove('hidden');
            addWalletBtn.classList.add('hidden');
        });
        
        cancelAddWalletBtn.addEventListener('click', function() {
            addWalletForm.classList.add('hidden');
            addWalletBtn.classList.remove('hidden');
        });
    });
    
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            alert('Address copied to clipboard');
        }, function(err) {
            console.error('Could not copy text: ', err);
        });
    }
</script>
@endsection