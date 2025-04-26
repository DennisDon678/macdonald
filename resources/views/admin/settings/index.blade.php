@extends('layouts.adminLayout')

@section('title', 'Website Settings')
@section('page-title', 'Website Settings')

@section('content')
<div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
        <h2 class="text-lg font-medium text-gray-900 dark:text-white">
            Settings
        </h2>
    </div>

    <div class="p-6">
        @if (session('success'))
            <div class="bg-green-50 dark:bg-green-900 border-l-4 border-green-400 dark:border-green-600 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-400 dark:text-green-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700 dark:text-green-200">
                            {{ session('success') }}
                        </p>
                    </div>
                    <div class="ml-auto pl-3">
                        <div class="-mx-1.5 -my-1.5">
                            <button type="button"
                                class="inline-flex bg-green-50 dark:bg-green-900 rounded-md p-1.5 text-green-500 dark:text-green-400 hover:bg-green-100 dark:hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                onclick="this.parentElement.parentElement.parentElement.remove()">
                                <span class="sr-only">Dismiss</span>
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="space-y-8">
                <!-- General Settings -->
                <div>
                    <h3 class="text-md font-medium text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-2 mb-4">
                        General Settings
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="site_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Site Name
                            </label>
                            <input type="text" id="site_name" name="site_name" 
                                value="{{ old('site_name', $settings['site_name']) }}" required
                                class="mt-1 block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 rounded-md shadow-sm 
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none
                                transition-all duration-200">
                        </div>
                    </div>
                </div>
                
                <!-- Contact Information -->
                <div>
                    <h3 class="text-md font-medium text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-2 mb-4">
                        Contact Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="contact_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Contact Email
                            </label>
                            <input type="email" id="contact_email" name="contact_email" 
                                value="{{ old('contact_email', $settings['contact_email']) }}"
                                class="mt-1 block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 rounded-md shadow-sm 
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none
                                transition-all duration-200">
                        </div>
                        
                        <div>
                            <label for="contact_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Contact Phone
                            </label>
                            <input type="text" id="contact_phone" name="contact_phone" 
                                value="{{ old('contact_phone', $settings['contact_phone']) }}"
                                class="mt-1 block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 rounded-md shadow-sm 
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none
                                transition-all duration-200">
                        </div>
                        
                        <div class="md:col-span-2">
                            <label for="contact_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Contact Address
                            </label>
                            <textarea id="contact_address" name="contact_address" rows="3"
                                class="mt-1 block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 rounded-md shadow-sm 
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none
                                transition-all duration-200">{{ old('contact_address', $settings['contact_address']) }}</textarea>
                        </div>
                    </div>
                </div>
                
                <!-- API Keys -->
                <div>
                    <h3 class="text-md font-medium text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-2 mb-4">
                        API Keys
                    </h3>
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="smartsup_api_key" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                SmartSup API Key
                            </label>
                            <input type="text" id="smartsup_api_key" name="smartsup_api_key" 
                                value="{{ old('smartsup_api_key', $settings['smartsup_api_key']) }}"
                                class="mt-1 block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 rounded-md shadow-sm 
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none
                                transition-all duration-200">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                Your SmartSup API key for customer support chat functionality.
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Social Media Links -->
                <div>
                    <h3 class="text-md font-medium text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-2 mb-4">
                        Social Media Links
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="facebook_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Facebook URL
                            </label>
                            <input type="url" id="facebook_url" name="facebook_url" 
                                value="{{ old('facebook_url', $settings['facebook_url']) }}"
                                class="mt-1 block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 rounded-md shadow-sm 
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none
                                transition-all duration-200">
                        </div>
                        
                        <div>
                            <label for="twitter_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Twitter URL
                            </label>
                            <input type="url" id="twitter_url" name="twitter_url" 
                                value="{{ old('twitter_url', $settings['twitter_url']) }}"
                                class="mt-1 block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 rounded-md shadow-sm 
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none
                                transition-all duration-200">
                        </div>
                        
                        <div>
                            <label for="instagram_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Instagram URL
                            </label>
                            <input type="url" id="instagram_url" name="instagram_url" 
                                value="{{ old('instagram_url', $settings['instagram_url']) }}"
                                class="mt-1 block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 rounded-md shadow-sm 
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none
                                transition-all duration-200">
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="flex items-center justify-end pt-5 border-t border-gray-200 dark:border-gray-700">
                    <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Save Settings
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection