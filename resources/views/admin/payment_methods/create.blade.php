@extends('layouts.adminLayout')

@section('title', 'Create Payment Method')
@section('page-title', 'Create Payment Method')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.payment-methods.index') }}" class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Back to Payment Methods
    </a>
</div>

<div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
        <h2 class="text-lg font-medium text-gray-900 dark:text-white">
            Add New Payment Method
        </h2>
    </div>

    <div class="p-6">
        @if ($errors->any())
            <div class="bg-red-50 dark:bg-red-900 border-l-4 border-red-400 dark:border-red-600 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-400 dark:text-red-500"></i>
                    </div>
                    <div class="ml-3">
                        <ul class="list-disc list-inside text-sm text-red-700 dark:text-red-300">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('admin.payment-methods.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="space-y-6">
                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                        class="mt-1 p-2 block w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 rounded-md shadow-sm 
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none
                        transition-all duration-200" placeholder="Bitcoin, Etherium">
                </div>

                <!-- Cryptocurrency Code -->
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Crypto Code
                        <span class="text-xs text-gray-500">(for icon display)</span>
                    </label>
                    <input type="text" id="code" name="code" value="{{ old('code') }}" 
                        placeholder="BTC, ETH, etc."
                        class="mt-1 p-2 block w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 rounded-md shadow-sm
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none
                        transition-all duration-200">
                    
                    <div class="mt-2 flex items-center">
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            Enter the cryptocurrency code for icon display
                        </p>
                        <div id="icon-preview" class="ml-auto"></div>
                    </div>
                </div>

                {{-- Address --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Wallet</label>
                    <input type="text" id="name" name="address" value="{{ old('address') }}" required
                        class="mt-1 block p-2 w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 rounded-md shadow-sm 
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none
                        transition-all duration-200" placeholder="0x1234567890abcdef...">
                </div>

                {{-- Network --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Network <span class="text-xs text-gray-500">(Optional)</span></label>
                    <input type="text" id="name" name="address" value="{{ old('network') }}" required
                        class="mt-1 block p-2 w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 rounded-md shadow-sm 
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none
                        transition-all duration-200" placeholder="TRC20, BEP20, etc.">
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end space-x-3 pt-5 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('admin.payment-methods.index') }}"
                       class="inline-flex justify-center py-2 px-4 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Create Payment Method
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Live preview for cryptocurrency code
        const codeInput = document.getElementById('code');
        const previewContainer = document.getElementById('icon-preview');
        
        if (codeInput) {
            codeInput.addEventListener('input', function() {
                const code = codeInput.value.trim().toUpperCase();
                if (code) {
                    previewContainer.innerHTML = `
                        <div class="flex items-center space-x-2">
                            <span class="text-xs text-gray-500 dark:text-gray-400">Preview:</span>
                            <i class="cc ${code} text-3xl"></i>
                        </div>
                    `;
                } else {
                    previewContainer.innerHTML = '';
                }
            });
        }
        
        // Display selected file name
        const fileInput = document.getElementById('logo');
        const fileNameDisplay = document.getElementById('selectedFileName');
        
        if (fileInput) {
            fileInput.addEventListener('change', function() {
                if (fileInput.files.length > 0) {
                    fileNameDisplay.textContent = fileInput.files[0].name;
                } else {
                    fileNameDisplay.textContent = '';
                }
            });
        }
    });
</script>
@endsection
