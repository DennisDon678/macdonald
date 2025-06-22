@extends('layouts.adminLayout')

@section('content')
<div class="max-w-lg mx-auto mt-10">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Change Password</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    for <span class="font-medium">{{ $user->name }}</span> ({{ $user->email }})
                </p>
            </div>
            <a href="{{ route('admin.users.show',$user->id) }}"
               class="inline-flex items-center px-3 py-1.5 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-md hover:bg-gray-200 dark:hover:bg-gray-600 transition text-sm font-medium ml-4">
                <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i>
                Back
            </a>
        </div>
        <form method="POST" action="{{ route('admin.users.update-password', $user) }}" class="px-6 py-6 space-y-6">
            @csrf
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">New Password</label>
                <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @error('password')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Confirm Password</label>
                <input type="password" name="password_confirmation" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md shadow transition duration-150">
                    <i data-lucide="key" class="w-4 h-4 mr-2"></i>
                    Update Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endsection