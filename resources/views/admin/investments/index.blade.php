@extends('layouts.adminLayout')

@section('title', 'Investments Management')

@section('page-title', 'Investments Management')

@section('content')
    <!-- Top Bar with Actions and Search -->
    <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div class="flex flex-col">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Investments</h1>
            <p class="text-gray-600 dark:text-gray-400">Manage user investment portfolios</p>
        </div>
    </div>
    
    
    <!-- Investments Table -->
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr class="text-xs font-medium tracking-wider text-left text-gray-500 dark:text-gray-400 uppercase">
                        <th class="px-6 py-3">Reference</th>
                        <th class="px-6 py-3">User</th>
                        <th class="px-6 py-3">Plan</th>
                        <th class="px-6 py-3">Amount</th>
                        <th class="px-6 py-3">Return</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Date</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($investments as $investment)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                {{ $investment['reference'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-300">
                                        {{ substr($investment['user']['name'], 0, 1) }}
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $investment['user']['name'] }}
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $investment['user']['email'] }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">{{ $investment['plan']['name'] }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $investment['plan']['duration'] }} days</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                ${{ number_format($investment['amount'], 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">${{ number_format($investment['return_amount'], 2) }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $investment['plan']['interest_rate'] }}% ROI</div>
                            </td>
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
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $investment['created_at'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.investments.show', $investment['id']) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                        <i data-lucide="eye" class="w-5 h-5"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                No investments found
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
                    Showing <span class="font-medium">{{ count($investments) }}</span> investments
                </div>
                
                <div>
                    {{ $investments->links('vendor.pagination.tailwind') }}
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