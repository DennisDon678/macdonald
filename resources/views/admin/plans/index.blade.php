@extends('layouts.adminLayout')

@section('title', 'Investment Plans')

@section('page-title', 'Investment Plans')

@section('content')
    <div class="mb-6 flex flex-col md:flex-row items-start md:items-center md:justify-between gap-4">
        <div>
            <p class="text-gray-600 dark:text-gray-400">Manage investment plans and their settings</p>
        </div>
        
    </div>

    <!-- Plans Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        @foreach($plans as $plan)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <div class="p-5 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ $plan['name'] }}</h3>
                </div>
                <div class="p-5">
                    <dl class="space-y-3">
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">ROI:</dt>
                            <dd class="text-sm font-bold text-gray-900 dark:text-white">{{ $plan['interest_rate']*$plan['duration'] }}%</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Duration:</dt>
                            <dd class="text-sm text-gray-900 dark:text-white">{{ $plan['duration'] }} days</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Investment Range:</dt>
                            <dd class="text-sm text-gray-900 dark:text-white">${{ number_format($plan['min_investment']) }} - ${{ number_format($plan['max_investment']) }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Active Investments:</dt>
                            <dd class="text-sm text-gray-900 dark:text-white">{{ $plan['investments']->count() }}</dd>
                        </div>
                    </dl>
                    <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                        {{ $plan['description'] }}
                    </div>
                    <div class="mt-5 flex justify-between">
                        <div>
                            <a href="{{ route('admin.plans.edit', $plan['id']) }}" class="inline-flex items-center text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                                <i data-lucide="edit" class="w-4 h-4 mr-1"></i>
                                Edit
                            </a>
                            
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