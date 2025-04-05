@extends('layouts.adminLayout')

@section('title', 'Investment Plans')

@section('page-title', 'Investment Plans')

@section('content')
    <div class="mb-6 flex flex-col md:flex-row items-start md:items-center md:justify-between gap-4">
        <div>
            <p class="text-gray-600 dark:text-gray-400">Manage investment plans and their settings</p>
        </div>
        <a href="{{ route('admin.plans.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md inline-flex items-center">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
            Add New Plan
        </a>
    </div>

    <!-- Filter and Search -->
    <div class="mb-6 bg-white dark:bg-gray-800 rounded-lg shadow p-4">
        <form action="{{ route('admin.plans.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Search</label>
                <input type="text" name="search" id="search" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Search plans..." value="{{ request('search') }}">
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
                <label for="sort" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sort By</label>
                <select name="sort" id="sort" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                    <option value="roi_asc" {{ request('sort') == 'roi_asc' ? 'selected' : '' }}>ROI (Low to High)</option>
                    <option value="roi_desc" {{ request('sort') == 'roi_desc' ? 'selected' : '' }}>ROI (High to Low)</option>
                    <option value="popularity" {{ request('sort') == 'popularity' ? 'selected' : '' }}>Most Popular</option>
                </select>
            </div>
            
            <div class="flex items-end md:col-span-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md mr-2">
                    <i data-lucide="filter" class="w-4 h-4 inline-block mr-1"></i>
                    Filter
                </button>
                <a href="{{ route('admin.plans.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-md">
                    <i data-lucide="x" class="w-4 h-4 inline-block mr-1"></i>
                    Clear
                </a>
            </div>
        </form>
    </div>

    <!-- Plans Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        @foreach($plans as $plan)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <div class="p-5 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ $plan['name'] }}</h3>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $plan['status'] == 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                        {{ ucfirst($plan['status']) }}
                    </span>
                </div>
                <div class="p-5">
                    <dl class="space-y-3">
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">ROI:</dt>
                            <dd class="text-sm font-bold text-gray-900 dark:text-white">{{ $plan['roi'] }}%</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Duration:</dt>
                            <dd class="text-sm text-gray-900 dark:text-white">{{ $plan['duration'] }} days</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Investment Range:</dt>
                            <dd class="text-sm text-gray-900 dark:text-white">${{ number_format($plan['min_amount']) }} - ${{ number_format($plan['max_amount']) }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Active Investments:</dt>
                            <dd class="text-sm text-gray-900 dark:text-white">{{ $plan['investments_count'] }}</dd>
                        </div>
                    </dl>
                    <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                        {{ $plan['description'] }}
                    </div>
                    <div class="mt-5 flex justify-between">
                        <a href="{{ route('admin.plans.show', $plan['id']) }}" class="inline-flex items-center text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                            <i data-lucide="eye" class="w-4 h-4 mr-1"></i>
                            View Details
                        </a>
                        <div>
                            <a href="{{ route('admin.plans.edit', $plan['id']) }}" class="inline-flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 mr-3">
                                <i data-lucide="edit" class="w-4 h-4 mr-1"></i>
                                Edit
                            </a>
                            <form action="{{ route('admin.plans.toggle-status', $plan['id']) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="inline-flex items-center text-sm font-medium {{ $plan['status'] == 'active' ? 'text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300' : 'text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300' }}">
                                    <i data-lucide="{{ $plan['status'] == 'active' ? 'toggle-right' : 'toggle-left' }}" class="w-4 h-4 mr-1"></i>
                                    {{ $plan['status'] == 'active' ? 'Disable' : 'Enable' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
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