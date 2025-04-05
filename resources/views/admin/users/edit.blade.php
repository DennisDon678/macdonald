@extends('layouts.adminLayout')

@section('title', 'Edit User')

@section('page-title', 'Edit User')

@section('content')
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
        <div class="p-6 border-b dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-800 dark:text-white">Edit User: {{ $user['name'] }}</h3>
        </div>

        <form action="{{ route('admin.users.update', $user['id']) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            
            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="mb-6">
                    <div class="bg-red-100 dark:bg-red-900 border-l-4 border-red-500 text-red-700 dark:text-red-300 p-4 rounded">
                        <p class="font-bold">Validation Error</p>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Full Name</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        value="{{ old('name', $user['name']) }}" 
                        required
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white"
                    >
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email Address</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email', $user['email']) }}" 
                        required
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white"
                    >
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password <span class="text-xs text-gray-500">(leave blank to keep current)</span></label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white"
                    >
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Confirm Password</label>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        id="password_confirmation" 
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white"
                    >
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Account Status</label>
                    <select 
                        name="status" 
                        id="status" 
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white"
                    >
                        <option value="active" {{ $user['status'] === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $user['status'] === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="flex items-center mt-6">
                    <input 
                        type="checkbox" 
                        name="verified" 
                        id="verified" 
                        value="1"
                        {{ $user['verified'] ? 'checked' : '' }}
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                    >
                    <label for="verified" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                        Account Verified
                    </label>
                </div>
            </div>

            <div class="flex items-center justify-end">
                <a 
                    href="{{ route('admin.users.index') }}" 
                    class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-white rounded-md hover:bg-gray-400 dark:hover:bg-gray-600 mr-2"
                >
                    Cancel
                </a>
                <button 
                    type="submit" 
                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600"
                >
                    Update User
                </button>
            </div>
        </form>
    </div>
@endsection