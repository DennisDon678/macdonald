@extends('layouts.adminLayout')

@section('title', 'Edit Investment')

@section('page-title', 'Edit Investment')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-5">Edit Investment #{{ $investment['reference'] }}</h2>
                
                <form action="{{ route('admin.investments.update', $investment['id']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-5">
                        <!-- User Information (Read-only) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">User</label>
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-300">
                                    {{ substr($investment['user']['name'], 0, 1) }}
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $investment['user']['name'] }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $investment['user']['email'] }}</p>
                                </div>
                                <a href="{{ route('admin.users.show', $investment['user']['id']) }}" class="ml-4 text-sm text-blue-600 dark:text-blue-400 hover:underline">
                                    View Profile
                                </a>
                            </div>
                        </div>
                        
                        <!-- Investment Plan (Read-only) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Investment Plan</label>
                            <p class="text-sm text-gray-900 dark:text-white">{{ $investment['plan']['name'] }} - {{ $investment['plan']['roi'] }}% ROI - {{ $investment['plan']['duration'] }} days</p>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Min: ${{ number_format($investment['plan']['min_amount'], 2) }} - Max: ${{ $investment['plan']['max_amount'] > 0 ? '$'.number_format($investment['plan']['max_amount'], 2) : 'Unlimited' }}</p>
                        </div>
                        
                        <!-- Amount -->
                        <div>
                            <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Investment Amount</label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-gray-500 sm:text-sm">$</span>
                                </div>
                                <input 
                                    type="number" 
                                    name="amount" 
                                    id="amount" 
                                    step="0.01" 
                                    min="{{ $investment['plan']['min_amount'] }}" 
                                    {{ $investment['plan']['max_amount'] > 0 ? 'max='.$investment['plan']['max_amount'] : '' }} 
                                    value="{{ old('amount', $investment['amount']) }}" 
                                    class="w-full pl-7 px-3 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    required
                                    {{ in_array($investment['status'], ['terminated', 'completed', 'rejected']) ? 'disabled' : '' }}
                                >
                            </div>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Expected return: ${{ number_format($investment['amount'] * (1 + $investment['plan']['roi']/100), 2) }}</p>
                            @error('amount')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                            <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required 
                                {{ in_array($investment['status'], ['terminated', 'completed', 'rejected']) ? 'disabled' : '' }}>
                                <option value="active" {{ $investment['status'] == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="pending" {{ $investment['status'] == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ $investment['status'] == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="terminated" {{ $investment['status'] == 'terminated' ? 'selected' : '' }}>Terminated</option>
                                <option value="rejected" {{ $investment['status'] == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        @if(in_array($investment['status'], ['active', 'pending']))
                            <!-- Terminate Reason (shown only for active/pending investments) -->
                            <div id="reason-container" style="{{ old('status', $investment['status']) == 'terminated' || old('status', $investment['status']) == 'rejected' ? '' : 'display: none;' }}">
                                <label for="reason" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Reason for Termination/Rejection</label>
                                <textarea 
                                    name="reason" 
                                    id="reason" 
                                    rows="3" 
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ old('reason', $investment['reason'] ?? '') }}</textarea>
                            </div>
                        @endif
                        
                        <!-- Notes -->
                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Admin Notes</label>
                            <textarea 
                                name="notes" 
                                id="notes" 
                                rows="3" 
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                {{ in_array($investment['status'], ['terminated', 'completed', 'rejected']) ? 'disabled' : '' }}>{{ old('notes', $investment['notes'] ?? '') }}</textarea>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('admin.investments.show', $investment['id']) }}" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white rounded-md">
                                Cancel
                            </a>
                            @if(!in_array($investment['status'], ['terminated', 'completed', 'rejected']))
                                <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md">
                                    Update Investment
                                </button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Lucide icons
        lucide.createIcons();
        
        // Show/hide reason textarea based on status
        const statusSelect = document.getElementById('status');
        const reasonContainer = document.getElementById('reason-container');
        
        if (statusSelect && reasonContainer) {
            statusSelect.addEventListener('change', function() {
                if (this.value === 'terminated' || this.value === 'rejected') {
                    reasonContainer.style.display = 'block';
                } else {
                    reasonContainer.style.display = 'none';
                }
            });
        }
        
        // Update expected return when amount changes
        const amountInput = document.getElementById('amount');
        if (amountInput) {
            amountInput.addEventListener('input', function() {
                const amount = parseFloat(this.value) || 0;
                const roi = {{ $investment['plan']['roi'] }};
                const returnAmount = amount + (amount * (roi / 100));
                const returnElement = this.parentElement.nextElementSibling;
                returnElement.textContent = 'Expected return: $' + returnAmount.toFixed(2);
            });
        }
    });
</script>
@endsection