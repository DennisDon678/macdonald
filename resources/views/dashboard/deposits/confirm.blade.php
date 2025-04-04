@extends('layouts.dashboardLayout')

@section('title', 'Complete Your Deposit')

@section('page-title', 'Complete Your Deposit')

@section('content')
<div class="mb-6">
    <a href="{{ route('dashboard') }}" class="flex items-center text-blue-600 dark:text-blue-400 hover:underline">
        <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i>
        <span>Back to Dashboard</span>
    </a>
</div>

@if(session('success'))
<div class="mb-6 p-4 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-lg">
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="mb-6 p-4 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 rounded-lg">
    <ul class="list-disc pl-5">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
    <div class="p-6">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-6">Complete Your Deposit</h2>
        
        <!-- Transaction Details -->
        <div class="mb-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-4">Transaction Details</h3>
                
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-400">Reference ID:</span>
                        <span class="font-medium text-gray-800 dark:text-white">{{ $transaction['reference'] }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-400">Amount:</span>
                        <span class="font-medium text-gray-800 dark:text-white">${{ number_format($transaction['amount'], 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-400">Plan:</span>
                        <span class="font-medium text-gray-800 dark:text-white">{{ $plan['name'] }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-400">Daily Interest Rate:</span>
                        <span class="font-medium text-gray-800 dark:text-white">{{ $plan['interest_rate'] }}%</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-400">Duration:</span>
                        <span class="font-medium text-gray-800 dark:text-white">{{ $plan['duration'] }} days</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-400">Status:</span>
                        <span class="px-2 py-1 bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 rounded-full text-xs">Pending</span>
                    </div>
                </div>
            </div>
            
            <div>
                <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-4">Payment Details</h3>
                
                <div class="p-4 border dark:border-gray-700 rounded-lg text-center">
                    <div class="flex items-center justify-center mb-3">
                        <img src="{{ $crypto['icon'] }}" alt="{{ $crypto['name'] }}" class="h-8 w-8 mr-2">
                        <span class="font-medium text-gray-800 dark:text-white">{{ $crypto['name'] }}</span>
                    </div>
                    
                    <!-- QR Code (replace with actual QR code generation) -->
                    <div class="mb-4 flex justify-center">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $crypto['address'] }}" alt="QR Code" class="w-32 h-32">
                    </div>
                    
                    <div class="mb-4">
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">Send exactly this amount:</div>
                        <div class="text-lg font-bold text-gray-800 dark:text-white">${{ number_format($transaction['amount'], 2) }} worth of {{ $crypto['code'] }}</div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">To this address:</div>
                        <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded-md font-mono text-sm break-all">
                            {{ $crypto['address'] }}
                        </div>
                        <button class="mt-2 text-blue-500 hover:text-blue-600 text-sm flex items-center justify-center w-full" onclick="copyToClipboard('{{ $crypto['address'] }}')">
                            <i data-lucide="copy" class="w-4 h-4 mr-1"></i> Copy Address
                        </button>
                    </div>
                    
                    @if(isset($crypto['network']))
                    <div class="text-sm text-red-500 font-medium mb-4">
                        Important: Send only on {{ $crypto['network'] }} network
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Transaction Receipt Upload -->
        <div class="mb-8 border dark:border-gray-700 rounded-lg p-6 bg-gray-50 dark:bg-gray-700/50">
            <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-4">Upload Transaction Receipt</h3>
            
            <p class="text-gray-600 dark:text-gray-400 mb-4">
                After sending the payment, please upload a screenshot of your transaction receipt to expedite the verification process.
            </p>
            
            <form action="{{ route('dashboard.deposits.upload-receipt', $transaction['reference']) }}" method="POST" enctype="multipart/form-data" id="receipt-form">
                @csrf
                
                <div class="mb-4">
                    <div class="border-2 border-dashed dark:border-gray-600 rounded-lg p-6 text-center" id="drop-area">
                        <input type="file" name="receipt" id="receipt-file" class="hidden" accept="image/*"/>
                        
                        <div id="upload-prompt" class="mb-4">
                            <i data-lucide="upload-cloud" class="w-12 h-12 mx-auto text-gray-400 dark:text-gray-500 mb-2"></i>
                            <p class="text-gray-700 dark:text-gray-300 font-medium">Drag & drop your screenshot here</p>
                            <p class="text-gray-500 dark:text-gray-400 text-sm">or</p>
                        </div>
                        
                        <div id="preview-container" class="hidden mb-4">
                            <img id="receipt-preview" src="#" alt="Receipt preview" class="max-h-48 mx-auto mb-2">
                            <p id="file-name" class="text-sm text-gray-600 dark:text-gray-400"></p>
                        </div>
                        
                        <button type="button" id="browse-button" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md transition duration-200">
                            Browse Files
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                        Supported formats: JPG, PNG, GIF. Maximum file size: 5MB
                    </p>
                </div>
                
                <div class="mb-4">
                    <label for="tx-id" class="block text-gray-700 dark:text-gray-300 mb-1">Transaction ID/Hash (Optional)</label>
                    <input 
                        type="text" 
                        id="tx-id" 
                        name="transaction_id" 
                        class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter your transaction ID or hash"
                    >
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        If available, please provide the transaction ID from your wallet
                    </p>
                </div>
                
                <div class="mb-4">
                    <label for="comments" class="block text-gray-700 dark:text-gray-300 mb-1">Additional Comments (Optional)</label>
                    <textarea 
                        id="comments" 
                        name="comments" 
                        rows="2" 
                        class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Any additional information about your payment"
                    ></textarea>
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-green-500 hover:bg-green-600 text-white font-medium rounded-md transition duration-200 flex items-center">
                        <i data-lucide="upload" class="w-4 h-4 mr-1"></i>
                        Submit Receipt
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Instructions -->
        <div class="mb-6">
            <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-3">Instructions</h3>
            <ol class="list-decimal pl-5 space-y-2 text-gray-600 dark:text-gray-300">
                <li>Send the exact amount to the provided address.</li>
                <li>Make sure you're using the correct network (if specified).</li>
                <li>Take a screenshot or save the transaction receipt from your wallet.</li>
                <li>Upload the receipt using the form above to expedite verification.</li>
                <li>Once verified, your investment will be activated automatically.</li>
                <li>You'll receive an email notification when your investment is active.</li>
            </ol>
        </div>
        
        <!-- Actions -->
        <div class="flex justify-between items-center pt-4 border-t dark:border-gray-700">
            <div class="text-gray-500 dark:text-gray-400">
                <p>Having issues? <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">Contact support</a></p>
            </div>
            
            <div>
                <a href="{{ route('dashboard.deposits.history') }}" class="px-6 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 font-medium rounded-md transition duration-200">
                    View Deposit History
                </a>
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
        
        // File upload handling
        const dropArea = document.getElementById('drop-area');
        const fileInput = document.getElementById('receipt-file');
        const browseButton = document.getElementById('browse-button');
        const uploadPrompt = document.getElementById('upload-prompt');
        const previewContainer = document.getElementById('preview-container');
        const receiptPreview = document.getElementById('receipt-preview');
        const fileName = document.getElementById('file-name');
        
        // Click the hidden file input when the browse button is clicked
        browseButton.addEventListener('click', function() {
            fileInput.click();
        });
        
        // Handle drag and drop events
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight() {
            dropArea.classList.add('bg-blue-50', 'dark:bg-blue-900/20', 'border-blue-300', 'dark:border-blue-700');
        }
        
        function unhighlight() {
            dropArea.classList.remove('bg-blue-50', 'dark:bg-blue-900/20', 'border-blue-300', 'dark:border-blue-700');
        }
        
        // Handle dropped files
        dropArea.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files.length > 0) {
                handleFiles(files[0]);
            }
        }
        
        // Handle file input change
        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                handleFiles(this.files[0]);
            }
        });
        
        function handleFiles(file) {
            validateFile(file);
            updateFilePreview(file);
        }
        
        function validateFile(file) {
            // Check file type
            const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!validTypes.includes(file.type)) {
                alert('Please upload a valid image file (JPG, PNG, GIF)');
                resetFileInput();
                return false;
            }
            
            // Check file size (5MB max)
            const maxSize = 5 * 1024 * 1024; // 5MB in bytes
            if (file.size > maxSize) {
                alert('File is too large. Maximum file size is 5MB.');
                resetFileInput();
                return false;
            }
            
            return true;
        }
        
        function updateFilePreview(file) {
            // Create object URL for the file
            const url = URL.createObjectURL(file);
            
            // Update preview image
            receiptPreview.src = url;
            
            // Update file name display
            fileName.textContent = file.name;
            
            // Show preview, hide upload prompt
            uploadPrompt.classList.add('hidden');
            previewContainer.classList.remove('hidden');
            
            // Add remove button functionality
            addRemoveButton();
        }
        
        function addRemoveButton() {
            // Remove existing button if it exists
            const existingButton = document.getElementById('remove-file');
            if (existingButton) {
                existingButton.remove();
            }
            
            // Create new remove button
            const removeBtn = document.createElement('button');
            removeBtn.id = 'remove-file';
            removeBtn.type = 'button';
            removeBtn.className = 'mt-2 text-red-500 hover:text-red-600 text-sm flex items-center mx-auto';
            removeBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg> Remove File';
            
            // Add event listener to remove file
            removeBtn.addEventListener('click', resetFileInput);
            
            // Append button to preview container
            previewContainer.appendChild(removeBtn);
        }
        
        function resetFileInput() {
            // Clear file input
            fileInput.value = '';
            
            // Hide preview, show upload prompt
            uploadPrompt.classList.remove('hidden');
            previewContainer.classList.add('hidden');
            
            // Clear preview image
            receiptPreview.src = '#';
            fileName.textContent = '';
            
            // Remove object URL to prevent memory leaks
            URL.revokeObjectURL(receiptPreview.src);
        }
        
        // Form submission handling
        const form = document.getElementById('receipt-form');
        form.addEventListener('submit', function(e) {
            if (!fileInput.files || fileInput.files.length === 0) {
                e.preventDefault();
                alert('Please upload a transaction receipt');
            }
        });
    });
    
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            alert('Address copied to clipboard');
        }, function(err) {
            console.error('Could not copy text: ', err);
        });
    }
</script>
@endsection