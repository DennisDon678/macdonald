@extends('layouts.dashboardLayout')

@section('title', 'Identity Verification (KYC)')

@section('page-title', 'Identity Verification (KYC)')

@section('content')
<div class="mb-6">
    <a href="{{ route('dashboard.profile') }}" class="flex items-center text-blue-600 dark:text-blue-400 hover:underline">
        <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i>
        <span>Back to Profile</span>
    </a>
</div>

@if(session('success'))
<div class="mb-6 p-4 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-lg">
    {{ session('success') }}
</div>
@endif

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
    <div class="p-6 border-b dark:border-gray-700">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-1">Complete Your KYC Verification</h2>
        <p class="text-gray-500 dark:text-gray-400 text-sm">Please provide the required information and documents to verify your identity</p>
    </div>
    
    <div class="p-6">
        @if($user->kyc_status === 'verified')
        <!-- KYC Already Verified -->
        <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg flex items-start">
            <div class="flex-shrink-0">
                <i data-lucide="check-circle" class="h-5 w-5 text-green-500"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-green-800 dark:text-green-200">Verification Complete</h3>
                <div class="mt-2 text-sm text-green-700 dark:text-green-300">
                    <p>Your identity has been successfully verified. You have full access to all platform features.</p>
                </div>
                <div class="mt-4">
                    <a href="{{ route('dashboard.profile') }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-md transition duration-200">
                        Return to Profile
                    </a>
                </div>
            </div>
        </div>
        
        @elseif($user->kyc_status === 'pending')
        <!-- KYC Pending -->
        <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg flex items-start">
            <div class="flex-shrink-0">
                <i data-lucide="clock" class="h-5 w-5 text-yellow-500"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-200">Verification in Progress</h3>
                <div class="mt-2 text-sm text-yellow-700 dark:text-yellow-300">
                    <p>Your verification is currently under review. This process typically takes 1-3 business days.</p>
                    <p class="mt-1">We'll notify you by email once your verification is complete or if we need additional information.</p>
                </div>
                <div class="mt-4">
                    <a href="{{ route('dashboard.profile') }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white font-medium rounded-md transition duration-200">
                        Return to Profile
                    </a>
                </div>
            </div>
        </div>
        
        @elseif($user->kyc_status === 'rejected')
        <!-- KYC Rejected -->
        <div class="bg-red-50 dark:bg-red-900/20 p-4 rounded-lg flex items-start mb-6">
            <div class="flex-shrink-0">
                <i data-lucide="alert-circle" class="h-5 w-5 text-red-500"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800 dark:text-red-200">Verification Failed</h3>
                <div class="mt-2 text-sm text-red-700 dark:text-red-300">
                    <p>Unfortunately, your verification was not successful due to the following reasons:</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1">
                        <li>{{ $user->kyc_rejected_reason ?? 'Document image was unclear or unreadable' }}</li>
                    </ul>
                    <p class="mt-2">Please submit your documents again ensuring that:</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1">
                        <li>All document edges are clearly visible</li>
                        <li>The image is not blurry</li>
                        <li>All information is clearly legible</li>
                        <li>Your face is clearly visible in the selfie</li>
                    </ul>
                </div>
            </div>
        </div>
        @endif
        
        @if($user->kyc_status !== 'verified' && $user->kyc_status !== 'pending')
        <!-- KYC Form -->
        <form action="{{ route('dashboard.profile.kyc.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- KYC Form Content -->
            <div class="space-y-6">
                <!-- Document type -->
                <div>
                    <label for="document_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Document Type</label>
                    <select 
                        id="document_type" 
                        name="document_type" 
                        class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    >
                        <option value="">Select a document type</option>
                        @foreach($documentTypes as $value => $label)
                        <option value="{{ $value }}" {{ old('document_type') == $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('document_type')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Document number -->
                <div>
                    <label for="id_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ID Number/Document Number</label>
                    <input 
                        type="text" 
                        id="id_number" 
                        name="id_number" 
                        value="{{ old('id_number') }}" 
                        class="w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter the number shown on your document"
                        required
                    >
                    @error('id_number')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Document front -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ID Document Front Side</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-md">
                        <div class="space-y-1 text-center">
                            <div class="flex justify-center">
                                <i data-lucide="upload" class="mx-auto h-12 w-12 text-gray-400"></i>
                            </div>
                            <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                <label for="id_front" class="relative cursor-pointer bg-white dark:bg-gray-700 rounded-md font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500 focus-within:outline-none">
                                    <span>Upload a file</span>
                                    <input id="id_front" name="id_front" type="file" class="sr-only" accept="image/*" required>
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                PNG, JPG, GIF up to 5MB
                            </p>
                        </div>
                    </div>
                    <div id="id_front_preview" class="mt-2 hidden">
                        <img src="" alt="ID Front Preview" class="h-32 object-cover rounded-md">
                        <button type="button" onclick="removeImage('id_front')" class="mt-1 text-xs text-red-600 dark:text-red-400 hover:underline">
                            Remove
                        </button>
                    </div>
                    @error('id_front')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Document back -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ID Document Back Side</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-md">
                        <div class="space-y-1 text-center">
                            <div class="flex justify-center">
                                <i data-lucide="upload" class="mx-auto h-12 w-12 text-gray-400"></i>
                            </div>
                            <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                <label for="id_back" class="relative cursor-pointer bg-white dark:bg-gray-700 rounded-md font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500 focus-within:outline-none">
                                    <span>Upload a file</span>
                                    <input id="id_back" name="id_back" type="file" class="sr-only" accept="image/*" required>
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                PNG, JPG, GIF up to 5MB
                            </p>
                        </div>
                    </div>
                    <div id="id_back_preview" class="mt-2 hidden">
                        <img src="" alt="ID Back Preview" class="h-32 object-cover rounded-md">
                        <button type="button" onclick="removeImage('id_back')" class="mt-1 text-xs text-red-600 dark:text-red-400 hover:underline">
                            Remove
                        </button>
                    </div>
                    @error('id_back')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Selfie with ID -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Selfie with ID Document</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-md">
                        <div class="space-y-1 text-center">
                            <div class="flex justify-center">
                                <i data-lucide="camera" class="mx-auto h-12 w-12 text-gray-400"></i>
                            </div>
                            <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                <label for="selfie" class="relative cursor-pointer bg-white dark:bg-gray-700 rounded-md font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500 focus-within:outline-none">
                                    <span>Upload a file</span>
                                    <input id="selfie" name="selfie" type="file" class="sr-only" accept="image/*" required>
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Take a selfie while holding your ID document
                            </p>
                        </div>
                    </div>
                    <div id="selfie_preview" class="mt-2 hidden">
                        <img src="" alt="Selfie Preview" class="h-32 object-cover rounded-md">
                        <button type="button" onclick="removeImage('selfie')" class="mt-1 text-xs text-red-600 dark:text-red-400 hover:underline">
                            Remove
                        </button>
                    </div>
                    @error('selfie')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Terms and conditions -->
                <div class="mt-4">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input 
                                id="terms" 
                                name="terms" 
                                type="checkbox" 
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                required
                            >
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="text-gray-700 dark:text-gray-300">
                                I confirm that all information and documents provided are genuine and accurate. I agree to the <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">Terms of Service</a> and <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">Privacy Policy</a>.
                            </label>
                            @error('terms')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="pt-5">
                    <div class="flex justify-end">
                        <a href="{{ route('dashboard.profile') }}" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </a>
                        <button type="submit" class="ml-3 px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Submit Verification
                        </button>
                    </div>
                </div>
            </div>
        </form>
        @endif
        
        <!-- KYC Guidelines -->
        <div class="mt-8 pt-6 border-t dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-3">Document Guidelines</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <div class="flex items-center mb-3">
                        <i data-lucide="file-text" class="w-5 h-5 text-blue-500 mr-2"></i>
                        <h4 class="font-medium text-gray-800 dark:text-white">Document Quality</h4>
                    </div>
                    <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
                        <li>• Must be valid and not expired</li>
                        <li>• All edges must be visible</li>
                        <li>• No glare or reflections</li>
                        <li>• Clear, readable text</li>
                        <li>• Color images (not black/white)</li>
                    </ul>
                </div>
                
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <div class="flex items-center mb-3">
                        <i data-lucide="camera" class="w-5 h-5 text-blue-500 mr-2"></i>
                        <h4 class="font-medium text-gray-800 dark:text-white">Selfie Requirements</h4>
                    </div>
                    <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
                        <li>• Hold your ID next to your face</li>
                        <li>• Face must be clearly visible</li>
                        <li>• Good lighting conditions</li>
                        <li>• Neutral facial expression</li>
                        <li>• No sunglasses or head coverings</li>
                    </ul>
                </div>
                
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <div class="flex items-center mb-3">
                        <i data-lucide="shield" class="w-5 h-5 text-blue-500 mr-2"></i>
                        <h4 class="font-medium text-gray-800 dark:text-white">Data Protection</h4>
                    </div>
                    <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
                        <li>• Your data is encrypted</li>
                        <li>• Used only for verification</li>
                        <li>• Not shared with third parties</li>
                        <li>• Stored securely</li>
                        <li>• Can request data deletion</li>
                    </ul>
                </div>
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
        
        // Image preview functionality
        const fileInputs = ['id_front', 'id_back', 'selfie'];
        
        fileInputs.forEach(inputId => {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(inputId + '_preview');
            const previewImg = preview.querySelector('img');
            
            input.addEventListener('change', function() {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        preview.classList.remove('hidden');
                    }
                    
                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
    });
    
    function removeImage(inputId) {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(inputId + '_preview');
        
        input.value = '';
        preview.classList.add('hidden');
    }
</script>
@endsection