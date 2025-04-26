@extends('layouts.adminLayout')

@section('title', 'Payment Methods')

@section('page-title', 'Payment Methods')

@section('content')
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
        <div class="p-4 sm:p-6 border-b dark:border-gray-700 flex flex-col sm:flex-row sm:items-center justify-between">
            <h2 class="text-lg font-medium text-gray-900 dark:text-white">
                Payment Methods
            </h2>

            <div class="mt-3 sm:mt-0 flex space-x-3">
                <a href="{{ route('admin.payment-methods.create') }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-plus mr-2"></i> Add New Method
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-50 dark:bg-green-900 border-l-4 border-green-400 dark:border-green-600 p-4 mb-4 mx-4 mt-4">
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

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            ID
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Logo
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Name
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Network
                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($paymentMethods as $method)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $method->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                <i
                                    class="cc {{ strtoupper($method->code) }} text-2xl text-center object-contain rounded-md">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                {{ $method->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                {{ $method->network ?? 'Default' }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    
                                    <a href="{{ route('admin.payment-methods.edit', $method->id) }}"
                                        class="text-green-600 dark:text-green-400 hover:text-green-900 dark:hover:text-green-300">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button"
                                        class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 delete-btn"
                                        data-action="{{ route('admin.payment-methods.destroy', $method->id) }}"
                                        onclick="event.preventDefault(); document.getElementById('delete-form').action = this.getAttribute('data-action'); document.getElementById('delete-modal').classList.remove('hidden');">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6"
                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 text-center">
                                No payment methods found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl max-w-md w-full">
            <div class="px-6 py-4 border-b dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Delete Payment Method</h3>
            </div>
            <form id="delete-form" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="px-6 py-4">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Are you sure you want to delete this payment method? This action cannot be undone.
                    </p>
                </div>
                <div class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-right">
                    <button type="button" id="cancel-btn"
                        class="inline-flex justify-center py-2 px-4 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </button>
                    <button type="submit"
                        class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Delete
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('delete-modal');
            const deleteForm = document.getElementById('delete-form');
            const cancelBtn = document.getElementById('cancel-btn');

            // Show modal when delete button is clicked
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    deleteForm.action = this.getAttribute('data-action');
                    deleteForm.action = `/admin/payment-methods/${methodId}`;
                    modal.classList.remove('hidden');
                });
            });

            // Hide modal when cancel button is clicked
            cancelBtn.addEventListener('click', function() {
                modal.classList.add('hidden');
            });

            // Hide modal when clicking outside
            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>
@endsection
