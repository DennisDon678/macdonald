@extends('layouts.dashboardLayout')

@section('title', 'Change Password')

@section('page-title', 'Change Password')

@section('content')
<div class="mb-6">
    <a href="{{ route('dashboard.profile') }}" class="flex items-center text-blue-600 dark:text-blue-400 hover:underline">
        <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i>
        <span>Back to Profile</span>
    </a>
</div>

@if(session('success'))
<div class="mb-6 p-4 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-lg">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="mb-6 p-4 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 rounded-lg">
    {{ session('error') }}
</div>
@endif

<div class="max-w-2xl mx-auto">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-6">Change Your Password</h2>
            
            <form action="{{ route('dashboard.profile.change-password') }}" method="POST">
                @csrf
                
                <div class="mb-6">
                    <label for="current_password" class="block text-gray-700 dark:text-gray-300 mb-2">Current Password</label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="current_password" 
                            name="current_password" 
                            class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required
                        >
                        <button 
                            type="button" 
                            class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-700 dark:hover:text-gray-300"
                            onclick="togglePasswordVisibility('current_password')"
                        >
                            <i data-lucide="eye" class="password-toggle w-5 h-5"></i>
                        </button>
                    </div>
                    @error('current_password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 dark:text-gray-300 mb-2">New Password</label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required
                        >
                        <button 
                            type="button" 
                            class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-700 dark:hover:text-gray-300"
                            onclick="togglePasswordVisibility('password')"
                        >
                            <i data-lucide="eye" class="password-toggle w-5 h-5"></i>
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        Must be at least 8 characters long
                    </p>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-gray-700 dark:text-gray-300 mb-2">Confirm New Password</label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required
                        >
                        <button 
                            type="button" 
                            class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-700 dark:hover:text-gray-300"
                            onclick="togglePasswordVisibility('password_confirmation')"
                        >
                            <i data-lucide="eye" class="password-toggle w-5 h-5"></i>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg mb-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 mt-0.5">
                            <i data-lucide="info" class="w-5 h-5 text-blue-500"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-gray-800 dark:text-white">Password Tips</h3>
                            <ul class="mt-1 text-sm text-gray-600 dark:text-gray-400 space-y-1">
                                <li>Use at least 8 characters</li>
                                <li>Include uppercase and lowercase letters</li>
                                <li>Add numbers and special characters</li>
                                <li>Avoid using easily guessable information</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md transition duration-200">
                        Update Password
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
    
    function togglePasswordVisibility(inputId) {
        const input = document.getElementById(inputId);
        if (input.type === 'password') {
            input.type = 'text';
        } else {
            input.type = 'password';
        }
        
        // Toggle icon between eye and eye-off
        const button = input.nextElementSibling;
        const icon = button.querySelector('i');
        
        if (icon.getAttribute('data-lucide') === 'eye') {
            icon.setAttribute('data-lucide', 'eye-off');
        } else {
            icon.setAttribute('data-lucide', 'eye');
        }
        
        // Re-initialize the icon
        lucide.createIcons({
            icons: {
                'eye': icon.getAttribute('data-lucide') === 'eye',
                'eye-off': icon.getAttribute('data-lucide') === 'eye-off'
            }
        });
    }
</script>
@endsection