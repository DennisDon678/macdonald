@extends('layouts.dashboardLayout')

@section('title', 'Create Deposit')

@section('page-title', 'Create Deposit')

@section('content')
<div class="mb-6">
    <a href="{{ route('dashboard') }}" class="flex items-center text-blue-600 dark:text-blue-400 hover:underline">
        <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i>
        <span>Back to Dashboard</span>
    </a>
</div>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
    <div class="p-6">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-6">Create a New Investment</h2>
        
        @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 rounded-lg">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <form action="{{ route('dashboard.deposits.store') }}" method="POST" id="deposit-form">
            @csrf
            
            <!-- Step 1: Select Plan -->
            <div class="mb-8" id="step-1">
                <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-4">Step 1: Select an Investment Plan</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($plans as $plan)
                    <div class="plan-option border dark:border-gray-700 rounded-lg overflow-hidden hover:shadow-md transition-shadow cursor-pointer">
                        <div class="bg-{{ $loop->index == 0 ? 'blue' : ($loop->index == 1 ? 'purple' : 'amber') }}-500 p-4">
                            <h3 class="text-lg font-bold text-white text-center">{{ $plan->name }}</h3>
                        </div>
                        <div class="p-4">
                            <div class="text-center">
                                <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $plan->interest_rate }}% <span class="text-sm font-normal">/ daily</span></p>
                                <p class="text-gray-600 dark:text-gray-300 mt-1">For {{ $plan->duration }} days</p>
                            </div>
                            <div class="mt-4 space-y-2">
                                <div class="flex items-center">
                                    <i data-lucide="check-circle" class="w-4 h-4 text-green-500 mr-2"></i>
                                    <span class="text-sm text-gray-700 dark:text-gray-200">Min: ${{ number_format($plan->min_deposit, 2) }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i data-lucide="check-circle" class="w-4 h-4 text-green-500 mr-2"></i>
                                    <span class="text-sm text-gray-700 dark:text-gray-200">Max: ${{ number_format($plan->max_deposit, 2) }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i data-lucide="check-circle" class="w-4 h-4 text-green-500 mr-2"></i>
                                    <span class="text-sm text-gray-700 dark:text-gray-200">Total Return: {{ $plan->interest_rate * $plan->duration }}%</span>
                                </div>
                            </div>
                            <div class="mt-4 flex justify-center">
                                <input type="radio" name="plan_id" value="{{ $plan->id }}" class="plan-radio h-5 w-5 text-blue-600" {{ $loop->first ? 'checked' : '' }}/>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="mt-6 flex justify-end">
                    <button type="button" id="to-step-2" class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md transition duration-200">Continue</button>
                </div>
            </div>
            
            <!-- Step 2: Enter Amount -->
            <div class="mb-8 hidden" id="step-2">
                <div class="flex items-center mb-4">
                    <button type="button" id="back-to-step-1" class="text-blue-600 dark:text-blue-400 hover:underline flex items-center">
                        <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i>
                        <span>Back to Plans</span>
                    </button>
                </div>
                
                <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-4">Step 2: Enter Investment Amount</h3>
                
                <div class="mb-6">
                    <label for="amount" class="block text-gray-700 dark:text-gray-300 mb-2">Amount to Invest ($)</label>
                    <input 
                        type="number" 
                        id="amount" 
                        name="amount" 
                        step="0.01" 
                        min="100" 
                        class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('amount') ?? 100 }}"
                        required
                    >
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        <span id="min-amount">Min: $100.00</span> | <span id="max-amount">Max: $1,000.00</span>
                    </p>
                </div>
                
                <!-- Return Calculator -->
                <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg mb-6">
                    <h4 class="text-md font-medium text-gray-800 dark:text-white mb-3">Estimated Returns</h4>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="p-3 bg-gray-100 dark:bg-gray-600 rounded-md">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Daily Profit</p>
                            <p class="font-medium text-gray-800 dark:text-white" id="daily-profit">$0.00</p>
                        </div>
                        <div class="p-3 bg-gray-100 dark:bg-gray-600 rounded-md">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Weekly Profit</p>
                            <p class="font-medium text-gray-800 dark:text-white" id="weekly-profit">$0.00</p>
                        </div>
                        <div class="p-3 bg-gray-100 dark:bg-gray-600 rounded-md">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Total Profit</p>
                            <p class="font-medium text-gray-800 dark:text-white" id="total-profit">$0.00</p>
                        </div>
                        <div class="p-3 bg-gray-100 dark:bg-gray-600 rounded-md">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Total Return</p>
                            <p class="font-medium text-gray-800 dark:text-white" id="total-return">$0.00</p>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end">
                    <button type="button" id="to-step-3" class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md transition duration-200">Continue</button>
                </div>
            </div>
            
            <!-- Step 3: Select Payment Method -->
            <div class="mb-8 hidden" id="step-3">
                <div class="flex items-center mb-4">
                    <button type="button" id="back-to-step-2" class="text-blue-600 dark:text-blue-400 hover:underline flex items-center">
                        <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i>
                        <span>Back to Amount</span>
                    </button>
                </div>
                
                <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-4">Step 3: Select Payment Method</h3>
                
                <div class="space-y-4">
                    @foreach($cryptocurrencies as $code => $crypto)
                    <div class="border dark:border-gray-700 rounded-lg p-4 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer crypto-option">
                        <input type="radio" name="crypto" value="{{ $code }}" id="crypto-{{ $code }}" class="hidden" {{ $loop->first ? 'checked' : '' }}>
                        <label for="crypto-{{ $code }}" class="flex items-center cursor-pointer">
                            <div class="flex-shrink-0 mr-4">
                                <img src="{{ $crypto['icon'] }}" alt="{{ $crypto['name'] }}" class="w-10 h-10">
                            </div>
                            <div>
                                <p class="font-medium text-gray-800 dark:text-white">{{ $crypto['name'] }} ({{ $crypto['code'] }})</p>
                                @if(isset($crypto['network']))
                                <p class="text-xs text-gray-500 dark:text-gray-400">Network: {{ $crypto['network'] }}</p>
                                @endif
                            </div>
                        </label>
                    </div>
                    @endforeach
                </div>
                
                <div class="mt-6">
                    <div class="flex items-center mb-4">
                        <input type="checkbox" id="terms" name="terms" required class="mr-3 h-4 w-4 text-blue-600">
                        <label for="terms" class="text-gray-700 dark:text-gray-300">
                            I agree to the <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">Terms & Conditions</a>
                        </label>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md transition duration-200">
                            Proceed to Payment
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Lucide icons
        lucide.createIcons();
        
        // Get elements
        const step1 = document.getElementById('step-1');
        const step2 = document.getElementById('step-2');
        const step3 = document.getElementById('step-3');
        
        const toStep2Btn = document.getElementById('to-step-2');
        const toStep3Btn = document.getElementById('to-step-3');
        const backToStep1Btn = document.getElementById('back-to-step-1');
        const backToStep2Btn = document.getElementById('back-to-step-2');
        
        const planOptions = document.querySelectorAll('.plan-option');
        const cryptoOptions = document.querySelectorAll('.crypto-option');
        const amountInput = document.getElementById('amount');
        const minAmountText = document.getElementById('min-amount');
        const maxAmountText = document.getElementById('max-amount');
        
        const dailyProfitEl = document.getElementById('daily-profit');
        const weeklyProfitEl = document.getElementById('weekly-profit');
        const totalProfitEl = document.getElementById('total-profit');
        const totalReturnEl = document.getElementById('total-return');
        
        // Plans data (should match backend data)
        const plansData = {
            @foreach($plans as $plan)
            {{ $plan->id }}: {
                name: "{{ $plan->name }}",
                interest_rate: {{ $plan->interest_rate / 100 }},
                duration: {{ $plan->duration }},
                min_deposit: {{ $plan->min_deposit }},
                max_deposit: {{ $plan->max_deposit }}
            },
            @endforeach
        };
        
        // Navigation between steps
        toStep2Btn.addEventListener('click', function() {
            step1.classList.add('hidden');
            step2.classList.remove('hidden');
            
            // Update min/max amounts based on selected plan
            const selectedPlanId = document.querySelector('input[name="plan_id"]:checked').value;
            updateAmountLimits(selectedPlanId);
            calculateReturns();
        });
        
        toStep3Btn.addEventListener('click', function() {
            // Validate amount
            const amount = parseFloat(amountInput.value);
            const selectedPlanId = document.querySelector('input[name="plan_id"]:checked').value;
            const plan = plansData[selectedPlanId];
            
            if (isNaN(amount) || amount < plan.min_deposit || amount > plan.max_deposit) {
                alert(`Please enter an amount between $${plan.min_deposit.toFixed(2)} and $${plan.max_deposit.toFixed(2)}`);
                return;
            }
            
            step2.classList.add('hidden');
            step3.classList.remove('hidden');
        });
        
        backToStep1Btn.addEventListener('click', function() {
            step2.classList.add('hidden');
            step1.classList.remove('hidden');
        });
        
        backToStep2Btn.addEventListener('click', function() {
            step3.classList.add('hidden');
            step2.classList.remove('hidden');
        });
        
        // Plan selection
        planOptions.forEach(option => {
            option.addEventListener('click', function() {
                // Uncheck all radios
                document.querySelectorAll('.plan-radio').forEach(radio => radio.checked = false);
                
                // Check the clicked one
                this.querySelector('.plan-radio').checked = true;
            });
        });
        
        // Crypto selection
        cryptoOptions.forEach(option => {
            option.addEventListener('click', function() {
                // Uncheck all radios
                document.querySelectorAll('input[name="crypto"]').forEach(radio => radio.checked = false);
                
                // Check the clicked one
                this.querySelector('input[name="crypto"]').checked = true;
                
                // Add selected styling
                cryptoOptions.forEach(opt => opt.classList.remove('ring-2', 'ring-blue-500'));
                this.classList.add('ring-2', 'ring-blue-500');
            });
        });
        
        // Handle amount changes
        amountInput.addEventListener('input', calculateReturns);
        
        // Update min/max amount display and limits
        function updateAmountLimits(planId) {
            const plan = plansData[planId];
            minAmountText.textContent = `Min: $${plan.min_deposit.toFixed(2)}`;
            maxAmountText.textContent = `Max: $${plan.max_deposit.toFixed(2)}`;
            
            amountInput.min = plan.min_deposit;
            amountInput.max = plan.max_deposit;
            
            if (parseFloat(amountInput.value) < plan.min_deposit) {
                amountInput.value = plan.min_deposit;
            } else if (parseFloat(amountInput.value) > plan.max_deposit) {
                amountInput.value = plan.max_deposit;
            }
        }
        
        // Calculate investment returns
        function calculateReturns() {
            const amount = parseFloat(amountInput.value);
            const selectedPlanId = document.querySelector('input[name="plan_id"]:checked').value;
            const plan = plansData[selectedPlanId];
            
            if (isNaN(amount) || amount <= 0) {
                resetCalculations();
                return;
            }
            
            const dailyProfit = amount * plan.interest_rate;
            const weeklyProfit = dailyProfit * 7;
            const totalProfit = dailyProfit * plan.duration;
            const totalReturn = amount + totalProfit;
            
            dailyProfitEl.textContent = '$' + dailyProfit.toFixed(2);
            weeklyProfitEl.textContent = '$' + weeklyProfit.toFixed(2);
            totalProfitEl.textContent = '$' + totalProfit.toFixed(2);
            totalReturnEl.textContent = '$' + totalReturn.toFixed(2);
        }
        
        function resetCalculations() {
            dailyProfitEl.textContent = '$0.00';
            weeklyProfitEl.textContent = '$0.00';
            totalProfitEl.textContent = '$0.00';
            totalReturnEl.textContent = '$0.00';
        }
    });
</script>
@endsection