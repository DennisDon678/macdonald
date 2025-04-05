@extends('layouts.adminLayout')

@section('title', 'Edit Investment Plan')

@section('page-title', 'Edit Investment Plan')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.plans.index') }}" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i>
            Back to Plans
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-medium text-gray-900 dark:text-white">Edit Plan: {{ $plan['name'] }}</h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Update the investment plan details</p>
        </div>
        <form action="{{ route('admin.plans.update', $plan['id']) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Plan Name</label>
                    <input type="text" name="name" id="name" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $plan['name'] }}" required>
                </div>
                
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                    <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="active" {{ $plan['status'] == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $plan['status'] == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                
                <div>
                    <label for="roi" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ROI Percentage</label>
                    <div class="relative mt-1 rounded-md shadow-sm">
                        <input type="number" name="roi" id="roi" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $plan['roi'] }}" step="0.1" min="0" required>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <span class="text-gray-500 dark:text-gray-400 sm:text-sm">%</span>
                        </div>
                    </div>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">The percentage return on investment</p>
                </div>
                
                <div>
                    <label for="duration" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Duration (Days)</label>
                    <input type="number" name="duration" id="duration" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $plan['duration'] }}" min="1" required>
                </div>
                
                <div>
                    <label for="min_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Minimum Investment</label>
                    <div class="relative mt-1 rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <span class="text-gray-500 dark:text-gray-400 sm:text-sm">$</span>
                        </div>
                        <input type="number" name="min_amount" id="min_amount" class="w-full pl-7 px-3 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $plan['min_amount'] }}" min="1" required>
                    </div>
                </div>
                
                <div>
                    <label for="max_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Maximum Investment</label>
                    <div class="relative mt-1 rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <span class="text-gray-500 dark:text-gray-400 sm:text-sm">$</span>
                        </div>
                        <input type="number" name="max_amount" id="max_amount" class="w-full pl-7 px-3 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $plan['max_amount'] }}" min="1" required>
                    </div>
                </div>
            </div>
            
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                <textarea name="description" id="description" rows="4" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ $plan['description'] }}</textarea>
            </div>
            
            <div class="mb-6">
                <label for="features" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Features (one per line)</label>
                <textarea name="features" id="features" rows="4" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ implode("\n", $plan['features']) }}</textarea>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Enter each feature on a new line</p>
            </div>
            
            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.plans.index') }}" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-md">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md">Update Plan</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Lucide icons
        lucide.createIcons();
        
        // Simple validation
        const form = document.querySelector('form');
        form.addEventListener('submit', function(event) {
            const minAmount = parseInt(document.getElementById('min_amount').value);
            const maxAmount = parseInt(document.getElementById('max_amount').value);
            
            if (maxAmount < minAmount) {
                event.preventDefault();
                alert('Maximum investment amount cannot be less than minimum investment amount.');
            }
        });
    });
</script>
@endsection