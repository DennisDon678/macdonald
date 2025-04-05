@extends('layouts.adminLayout')

@section('title', 'Create Investment')

@section('page-title', 'Create New Investment')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-5">New Investment Details</h2>
                
                <form action="{{ route('admin.investments.store') }}" method="POST">
                    @csrf
                    
                    <div class="space-y-5">
                        <!-- User Selection -->
                        <div>
                            <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">User</label>
                            <select name="user_id" id="user_id" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                                <option value="">Select User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user['id'] }}" {{ old('user_id') == $user['id'] ? 'selected' : '' }}>
                                        {{ $user['name'] }} ({{ $user['email'] }}) - Balance: ${{ number_format($user['balance'], 2) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Investment Plan -->
                        <div>
                            <label for="plan_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Investment Plan</label>
                            <select name="plan_id" id="plan_id" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                                <option value="">Select Plan</option>
                                @foreach($plans as $plan)
                                    <option value="{{ $plan['id'] }}" 
                                        data-min="{{ $plan['min_amount'] }}" 
                                        data-max="{{ $plan['max_amount'] }}"
                                        data-roi="{{ $plan['roi'] }}"
                                        data-duration="{{ $plan['duration'] }}"
                                        {{ old('plan_id') == $plan['id'] ? 'selected' : '' }}>
                                        {{ $plan['name'] }} - {{ $plan['roi'] }}% ROI - {{ $plan['duration'] }} days
                                    </option>
                                @endforeach
                            </select>
                            <div class="mt-1 text-xs text-gray-500 dark:text-gray-400" id="plan-details">
                                <!-- Plan details will be updated via JavaScript -->
                            </div>
                            @error('plan_id')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
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
                                    min="0" 
                                    value="{{ old('amount', 100) }}" 
                                    class="w-full pl-7 px-3 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    required
                                >
                            </div>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Expected return: <span id="expected-return">$0.00</span></p>
                            @error('amount')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                            <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            </select>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Set to "Active" to start it immediately or "Pending" for approval.</p>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Description / Notes -->
                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Notes (Optional)</label>
                            <textarea 
                                name="notes" 
                                id="notes" 
                                rows="3" 
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ old('notes') }}</textarea>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('admin.investments.index') }}" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white rounded-md">
                                Cancel
                            </a>
                            <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md">
                                Create Investment
                            </button>
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
        
        const planSelect = document.getElementById('plan_id');
        const amountInput = document.getElementById('amount');
        const planDetails = document.getElementById('plan-details');
        const expectedReturn = document.getElementById('expected-return');
        
        // Function to update plan details
        function updatePlanDetails() {
            if (planSelect.selectedIndex > 0) {
                const option = planSelect.options[planSelect.selectedIndex];
                const min = parseFloat(option.dataset.min);
                const max = parseFloat(option.dataset.max);
                const roi = parseFloat(option.dataset.roi);
                const duration = option.dataset.duration;
                
                planDetails.textContent = `Min: $${min.toFixed(2)} - Max: $${max.toFixed(2)} - ROI: ${roi}% - Duration: ${duration} days`;
                
                // Update min and max on the amount input
                amountInput.min = min;
                if (max > 0) {
                    amountInput.max = max;
                } else {
                    amountInput.removeAttribute('max');
                }
                
                // Update expected return
                updateExpectedReturn();
            } else {
                planDetails.textContent = '';
                amountInput.min = 0;
                amountInput.removeAttribute('max');
                expectedReturn.textContent = '$0.00';
            }
        }
        
        // Function to update the expected return
        function updateExpectedReturn() {
            if (planSelect.selectedIndex > 0 && amountInput.value) {
                const option = planSelect.options[planSelect.selectedIndex];
                const roi = parseFloat(option.dataset.roi);
                const amount = parseFloat(amountInput.value);
                
                const returnAmount = amount + (amount * (roi / 100));
                expectedReturn.textContent = '$' + returnAmount.toFixed(2);
            } else {
                expectedReturn.textContent = '$0.00';
            }
        }
        
        // Add event listeners
        planSelect.addEventListener('change', updatePlanDetails);
        amountInput.addEventListener('input', updateExpectedReturn);
        
        // Initialize on page load
        updatePlanDetails();
    });
</script>
@endsection