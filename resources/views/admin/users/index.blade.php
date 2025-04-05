@extends('layouts.adminLayout')

@section('title', 'Users Management')

@section('page-title', 'Users Management')

@section('content')
    <!-- Top Bar with Actions and Search -->
    <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div class="flex flex-col">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Users</h1>
            <p class="text-gray-600 dark:text-gray-400">Manage your platform users</p>
        </div>
        
        <div class="flex flex-col md:flex-row gap-3">
            <a href="{{ route('admin.users.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg px-4 py-2 inline-flex items-center">
                <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                Add User
            </a>
            <a href="#" class="bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-lg px-4 py-2 inline-flex items-center">
                <i data-lucide="download" class="w-4 h-4 mr-2"></i>
                Export
            </a>
        </div>
    </div>
    
    <!-- Filter and Search -->
    <div class="mb-6 bg-white dark:bg-gray-800 rounded-lg shadow-md p-4">
        <form action="{{ route('admin.users.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Search</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Name, email or ID" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="">All Statuses</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            
            <div>
                <label for="verified" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Verification</label>
                <select name="verified" id="verified" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="">All Users</option>
                    <option value="1" {{ request('verified') == '1' ? 'selected' : '' }}>Verified</option>
                    <option value="0" {{ request('verified') == '0' ? 'selected' : '' }}>Not Verified</option>
                </select>
            </div>
            
            <div>
                <label for="sort" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sort By</label>
                <select name="sort" id="sort" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="created_at_desc" {{ request('sort') == 'created_at_desc' ? 'selected' : '' }}>Newest First</option>
                    <option value="created_at_asc" {{ request('sort') == 'created_at_asc' ? 'selected' : '' }}>Oldest First</option>
                    <option value="balance_desc" {{ request('sort') == 'balance_desc' ? 'selected' : '' }}>Balance (High to Low)</option>
                    <option value="balance_asc" {{ request('sort') == 'balance_asc' ? 'selected' : '' }}>Balance (Low to High)</option>
                </select>
            </div>
            
            <div class="flex items-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg px-4 py-2 inline-flex items-center">
                    <i data-lucide="filter" class="w-4 h-4 mr-2"></i>
                    Filter
                </button>
                <a href="{{ route('admin.users.index') }}" class="ml-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                    Clear
                </a>
            </div>
        </form>
    </div>
    
    <!-- Users Table -->
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr class="text-xs font-medium tracking-wider text-left text-gray-500 dark:text-gray-400 uppercase">
                        <th class="px-6 py-3">User</th>
                        <th class="px-6 py-3">Balance</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Registered</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-300">
                                        {{ substr($user['name'], 0, 1) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $user['name'] }}
                                            @if($user['verified'])
                                                <span class="ml-1 inline-flex items-center">
                                                    <i data-lucide="badge-check" class="w-4 h-4 text-blue-500"></i>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $user['email'] }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">${{ number_format($user['balance'], 2) }}</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ count($user['investments']) }} active investments</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $user['status'] == 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                    {{ ucfirst($user['status']) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $user['created_at'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.users.show', $user['id']) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                        <i data-lucide="eye" class="w-5 h-5"></i>
                                    </a>
                                    <a href="{{ route('admin.users.edit', $user['id']) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                        <i data-lucide="edit" class="w-5 h-5"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.users.toggle-status', $user['id']) }}" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-{{ $user['status'] == 'active' ? 'red' : 'green' }}-600 hover:text-{{ $user['status'] == 'active' ? 'red' : 'green' }}-900 dark:text-{{ $user['status'] == 'active' ? 'red' : 'green' }}-400 dark:hover:text-{{ $user['status'] == 'active' ? 'red' : 'green' }}-300">
                                            <i data-lucide="{{ $user['status'] == 'active' ? 'lock' : 'unlock' }}" class="w-5 h-5"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                No users found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="bg-white dark:bg-gray-800 px-4 py-3 border-t border-gray-200 dark:border-gray-700 sm:px-6">
            <div class="flex justify-between items-center">
                <div class="text-sm text-gray-700 dark:text-gray-400">
                    Showing <span class="font-medium">{{ count($users) }}</span> users
                </div>
                
                <div>
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <i data-lucide="chevron-left" class="w-5 h-5"></i>
                        </a>
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">1</a>
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 bg-blue-50 dark:bg-blue-900 text-sm font-medium text-blue-700 dark:text-blue-200">2</a>
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">3</a>
                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-400">...</span>
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">8</a>
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <i data-lucide="chevron-right" class="w-5 h-5"></i>
                        </a>
                    </nav>
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