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

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Sidebar -->
    <div class="md:col-span-1">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="p-6 text-center border-b dark:border-gray-700">
                <div class="flex justify-center mb-4">
                    <div class="h-20 w-20 rounded-full bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center text-blue-600 dark:text-blue-400 text-2xl font-bold">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                </div>
                <h2 class="text-xl font-bold text-gray-800 dark:text-white">{{ $user->name }}</h2>
                <p class="text-gray-500 dark:text-gray-400 text-sm">Member since {{ $user->created_at->format('M Y') }}</p>
            </div>
            
            <ul class="p-2">
                <li>
                    <a href="#profile-section" class="profile-nav-link flex items-center px-4 py-2 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i data-lucide="user" class="w-5 h-5 mr-3 text-gray-500 dark:text-gray-400"></i>
                        <span>Personal Information</span>
                    </a>
                </li>
                <li>
                    <a href="#security-section" class="profile-nav-link flex items-center px-4 py-2 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i data-lucide="shield" class="w-5 h-5 mr-3 text-gray-500 dark:text-gray-400"></i>
                        <span>Security</span>
                    </a>
                </li>
                <li>
                    <a href="#verification-section" class="profile-nav-link flex items-center px-4 py-2 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i data-lucide="check-circle" class="w-5 h-5 mr-3 text-gray-500 dark:text-gray-400"></i>
                        <span>Identity Verification</span>
                    </a>
                </li>
               
            </ul>
            
            <div class="p-6 border-t dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-medium text-gray-800 dark:text-white">Account Status</h3>
                    <span class="px-2 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-xs rounded-full">
                        Active
                    </span>
                </div>
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Email Verification</span>
                        @if($user->email_verified)
                            <span class="text-green-500 flex items-center">
                                <i data-lucide="check-circle" class="w-4 h-4 mr-1"></i>
                                Verified
                            </span>
                        @else
                            <span class="text-yellow-500 flex items-center">
                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                Pending
                            </span>
                        @endif
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Phone Verification</span>
                        @if($user->phone_verified)
                            <span class="text-green-500 flex items-center">
                                <i data-lucide="check-circle" class="w-4 h-4 mr-1"></i>
                                Verified
                            </span>
                        @else
                            <span class="text-yellow-500 flex items-center">
                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                Pending
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="md:col-span-2 space-y-6">
        <!-- Personal Information -->
        <div id="profile-section" class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="p-6 border-b dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-1">Personal Information</h2>
                <p class="text-gray-500 dark:text-gray-400 text-sm">Update your personal details</p>
            </div>
            
            <div class="p-6">
                <form action="{{ route('dashboard.profile.update') }}" method="POST">
                    @csrf
                    
                    <div class="space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Full Name</label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    value="{{ old('name', $user->name) }}" 
                                    class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required
                                >
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email Address</label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    value="{{ old('email', $user->email) }}" 
                                    class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required
                                >
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Phone Number</label>
                                <input 
                                    type="tel" 
                                    id="phone" 
                                    name="phone" 
                                    value="{{ old('phone', $user->phone) }}" 
                                    class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                >
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="country" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Country</label>
                                <select 
                                    id="country" 
                                    name="country" 
                                    class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                >
                                    <option value="">Select a country</option>
                                    @foreach($countries as $code => $name)
                                        <option value="{{ $code }}" {{ old('country', $user->country) == $code ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('country')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">City</label>
                                <input 
                                    type="text" 
                                    id="city" 
                                    name="city" 
                                    value="{{ old('city', $user->city) }}" 
                                    class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                >
                                @error('city')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="postal_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Postal Code</label>
                                <input 
                                    type="text" 
                                    id="postal_code" 
                                    name="postal_code" 
                                    value="{{ old('postal_code', $user->postal_code) }}" 
                                    class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                >
                                @error('postal_code')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Address</label>
                            <input 
                                type="text" 
                                id="address" 
                                name="address" 
                                value="{{ old('address', $user->address) }}" 
                                class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                            @error('address')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <button type="submit" class="px-5 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md transition duration-200">
                                Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Security -->
        <div id="security-section" class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="p-6 border-b dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-1">Security Settings</h2>
                <p class="text-gray-500 dark:text-gray-400 text-sm">Manage your account security and authentication</p>
            </div>
            
            <div class="p-6">
                <!-- Change Password -->
                <div class="mb-8">
                    <h3 class="text-md font-medium text-gray-800 dark:text-white mb-4">Change Password</h3>
                    <form action="{{ route('dashboard.profile.password') }}" method="POST">
                        @csrf
                        
                        <div class="space-y-4">
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Current Password</label>
                                <input 
                                    type="password" 
                                    id="current_password" 
                                    name="current_password" 
                                    class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required
                                >
                                @error('current_password')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">New Password</label>
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required
                                >
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Confirm New Password</label>
                                <input 
                                    type="password" 
                                    id="password_confirmation" 
                                    name="password_confirmation" 
                                    class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required
                                >
                            </div>
                            
                            <div>
                                <button type="submit" class="px-5 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md transition duration-200">
                                    Update Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-- Two-Factor Authentication -->
                <div class="mb-8">
                    <h3 class="text-md font-medium text-gray-800 dark:text-white mb-4">Two-Factor Authentication</h3>
                    <form action="{{ route('dashboard.profile.security') }}" method="POST">
                        @csrf
                        
                        <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="flex items-center">
                                <input 
                                    type="checkbox" 
                                    id="two_factor_auth" 
                                    name="two_factor_auth" 
                                    value="1"
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                    {{ $user->two_factor_enabled ? 'checked' : '' }}
                                >
                                <label for="two_factor_auth" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                    Enable two-factor authentication
                                </label>
                            </div>
                            
                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $user->two_factor_enabled ? 'Enabled' : 'Disabled' }}
                            </span>
                        </div>
                        
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Two-factor authentication adds an additional layer of security to your account by requiring more than just a password to sign in.
                        </p>
                        
                        <div class="mt-4">
                            <button type="submit" class="px-5 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md transition duration-200">
                                Save Security Settings
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Login Notifications -->
                <div>
                    <h3 class="text-md font-medium text-gray-800 dark:text-white mb-4">Login Notifications</h3>
                    <form action="{{ route('dashboard.profile.security') }}" method="POST">
                        @csrf
                        
                        <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="flex items-center">
                                <input 
                                    type="checkbox" 
                                    id="login_notifications" 
                                    name="login_notifications" 
                                    value="1"
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                    checked
                                >
                                <label for="login_notifications" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                    Receive email notifications for new login activity
                                </label>
                            </div>
                            
                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                Enabled
                            </span>
                        </div>
                        
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            You'll receive an email notification whenever a new device logs into your account.
                        </p>
                        
                        <div class="mt-4">
                            <button type="submit" class="px-5 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md transition duration-200">
                                Save Notification Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Lucide icons
        lucide.createIcons();
        
        // Smooth scroll to sections
        const navLinks = document.querySelectorAll('.profile-nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    // Remove active class from all links
                    navLinks.forEach(innerLink => {
                        innerLink.classList.remove('bg-gray-100', 'dark:bg-gray-700', 'text-blue-600', 'dark:text-blue-400');
                    });
                    
                    // Add active class to clicked link
                    this.classList.add('bg-gray-100', 'dark:bg-gray-700', 'text-blue-600', 'dark:text-blue-400');
                    
                    // Scroll to target section
                    targetElement.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
        
        // Set active section based on scroll position
        function setActiveSection() {
            const sections = ['profile-section', 'security-section', 'verification-section'];
            let currentActiveSection = null;
            
            sections.forEach(sectionId => {
                const section = document.getElementById(sectionId);
                if (section) {
                    const rect = section.getBoundingClientRect();
                    if (rect.top <= 100 && rect.bottom >= 100) {
                        currentActiveSection = sectionId;
                    }
                }
            });
            
            if (currentActiveSection) {
                navLinks.forEach(link => {
                    link.classList.remove('bg-gray-100', 'dark:bg-gray-700', 'text-blue-600', 'dark:text-blue-400');
                    if (link.getAttribute('href') === '#' + currentActiveSection) {
                        link.classList.add('bg-gray-100', 'dark:bg-gray-700', 'text-blue-600', 'dark:text-blue-400');
                    }
                });
            }
        }
        
        // Listen for scroll events
        window.addEventListener('scroll', setActiveSection);
        
        // Initial check
        setActiveSection();
    });
</script>
@endsection