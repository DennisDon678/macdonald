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
    <!-- Profile Summary Card -->
    <div class="md:col-span-1">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 h-24 flex items-center justify-center">
                @if($user->profile_photo)
                    <img src="{{ $user->profile_photo }}" alt="{{ $user->name }}" class="w-24 h-24 rounded-full border-4 border-white dark:border-gray-800 object-cover mt-8">
                @else
                    <div class="w-24 h-24 rounded-full bg-gray-200 dark:bg-gray-700 border-4 border-white dark:border-gray-800 flex items-center justify-center mt-8">
                        <span class="text-3xl font-bold text-gray-600 dark:text-gray-300">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                    </div>
                @endif
            </div>
            
            <div class="p-6 pt-16 text-center">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white">{{ ucfirst($user->name) }}</h3>
                <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $user->email }}</p>
                
                <div class="mt-4 pt-4 border-t dark:border-gray-700">
                    <div class="grid grid-cols-2 gap-4 text-center">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Member Since</p>
                            <p class="font-medium text-gray-800 dark:text-white">{{ $user->created_at->format('M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Country</p>
                            <p class="font-medium text-gray-800 dark:text-white">{{ $user->country ?? 'Not set' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="p-6 bg-gray-50 dark:bg-gray-700/50">
                <div class="space-y-2">
                    <a href="{{ route('dashboard.profile.change-password') }}" class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-200 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i data-lucide="lock" class="w-5 h-5 mr-3"></i>
                        <span>Change Password</span>
                    </a>
                    {{-- <a href="{{ route('dashboard.profile.two-factor') }}" class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-200 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i data-lucide="shield" class="w-5 h-5 mr-3"></i>
                        <span>Security Settings</span>
                    </a> --}}
                </div>
            </div>
        </div>
    </div>
    
    <!-- Edit Profile -->
    <div class="md:col-span-2">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-6">Edit Profile</h2>
                
                <form action="{{ route('dashboard.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-6">
                        <label for="name" class="block text-gray-700 dark:text-gray-300 mb-2">Full Name</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ old('name', $user->name) }}"
                            required
                        >
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-6">
                        <label for="email" class="block text-gray-700 dark:text-gray-300 mb-2">Email Address</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ old('email', $user->email) }}"
                            required
                        >
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md transition duration-200">
                            Save Changes
                        </button>
                    </div>
                </form>
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
    });
</script>
@endsection