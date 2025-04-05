@extends('layouts.adminLayout')

@section('title', 'Plan Details')

@section('page-title', 'Plan Details')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.plans.index') }}" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i>
            Back to Plans
        </a>
    </div>

    <!-- Plan Header -->
    <div class="mb-6 bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <div class="flex items-center mb-2">
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white">{{ $plan['name'] }}</h2>
                        <span class="ml-3 inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                            {{ $plan['status'] == 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                            {{ ucfirst($plan['status']) }}
                        </span>
                    </div>
                    <p class="text-gray-500 dark:text-gray-400">Created on {{ $plan['created_at'] }}</p>
                </div>
                <div class="flex flex-wrap gap-2 mt-4 md:mt-0">
                    <a href="{{ route('admin.plans.edit', $plan['id']) }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 inline-flex items-center">
                        <i data-lucide="edit" class="w-4 h-4 mr-2"></i>
                        Edit Plan
                    </a>
                    <form method="POST" action="{{ route('admin.plans.toggle-status', $plan['id']) }}">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="px-4 py-2 {{ $plan['status'] == 'active' ? 'bg-orange-500 hover:bg-orange-600' : 'bg-green-500 hover:bg-green-600' }} text-white rounded-md inline-flex items-center">
                            <i data-lucide="{{ $plan['status'] == 'active' ? 'toggle-right' : 'toggle-left' }}" class="w-4 h-4 mr-2"></i>
                            {{ $plan['status'] == 'active' ? 'Disable Plan' : 'Enable Plan' }}
                        </button>
                    </form>
                    <form method="POST" action="{{ route('admin.plans.destroy', $plan['id']) }}" onsubmit="return confirm('Are you sure you want to delete this plan? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 inline-flex items-center">
                            <i data-lucide="trash-2" class="w-4 h-4 mr-2"></i>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Plan Details -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <div class="border-b dark:border-gray-700 px-6 py-4">
                <h3 class="text-lg font-medium text-gray-800 dark:text-white">Plan Overview</h3>
            </div>
            <div class="p-6">
                <dl class="space-y-4">
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">ROI</dt>
                        <dd class="text-sm font-bold text-gray-900 dark:text-white">{{ $plan['roi'] }}%</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Duration</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">{{ $plan['duration'] }} days</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Min. Investment</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">${{ number_format($plan['min_amount'], 2) }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Max. Investment</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">${{ number_format($plan['max_amount'], 2) }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Daily Profit (%)</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">{{ number_format($plan['roi'] / $plan['duration'], 2) }}%</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Investments</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">{{ $plan['investments_count'] }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Value</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">${{ number_format($plan['total_invested'], 2) }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Updated</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">{{ $plan['updated_at'] }}</dd>
                    </div>
                </dl>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden md:col-span-2">
            <div class="border-b dark:border-gray-700 px-6 py-4">
                <h3 class="text-lg font-medium text-gray-800 dark:text-white">Description & Features</h3>
            </div>
            <div class="p-6">
                <div class="mb-6">
                    <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</h4>
                    <p class="text-gray-600 dark:text-gray-400">{{ $plan['description'] }}</p>
                </div>
                
                <div>
                    <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Key Features</h4>
                    <ul class="space-y-2 text-gray-600 dark:text-gray-400">
                        @foreach($plan['features'] as $feature)
                            <li class="flex items-start">
                                <i data-lucide="check-circle" class="w-5 h-5 text-green-500 mr-2"></i>
                                <span>{{ $feature }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Investment List -->
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden mb-6">
        <div class="border-b dark:border-gray-700 px-6 py-4 flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-800 dark:text-white">Investments Using This Plan</h3>
            <a href="{{ route('admin.investments.index') }}?plan={{ $plan['id'] }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Reference</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">User</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Amount</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($plan['investments'] as $investment)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $investment['reference'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $investment['user']['name'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">${{ number_format($investment['amount'], 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                    @if($investment['status'] == 'active') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                    @elseif($investment['status'] == 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                    @elseif($investment['status'] == 'completed') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                    @elseif($investment['status'] == 'terminated') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                    @elseif($investment['status'] == 'rejected') bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300
                                    @endif">
                                    {{ ucfirst($investment['status']) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $investment['created_at'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.investments.show', $investment['id']) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 mr-3">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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