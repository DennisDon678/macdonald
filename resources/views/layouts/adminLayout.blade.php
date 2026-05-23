<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name') }} Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<!-- Cryptocoins Icons CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cryptocoins-icons@2.9.0/webfont/cryptocoins.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cryptocoins-icons@2.9.0/webfont/cryptocoins-colors.css">

<!-- Scripts -->
<script src="https://unpkg.com/lucide@latest"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
    [x-cloak] {
        display: none !important;
    }

    /* Custom styles can be added here */
    .dark .dark\:bg-gray-800 {
        background-color: #1f2937;
    }

    .dark .dark\:bg-gray-900 {
        background-color: #111827;
    }

    .dark .dark\:text-white {
        color: #ffffff;
    }

    .dark .dark\:text-gray-200 {
        color: #e5e7eb;
    }

    .dark .dark\:border-gray-700 {
        border-color: #374151;
    }

    /* Add to existing styles */
    
    /* Fix for mobile scrolling and content display */
    @media (max-width: 768px) {
        body {
            max-width: 100%;
            overflow-x: hidden;
            position: relative;
        }
        
        .flex-1 {
            width: 100%;
            min-width: 100%;
        }
        
        main {
            width: 100%;
            max-width: 100%;
            padding-left: 1rem !important;
            padding-right: 1rem !important;
            overflow-x: hidden;
        }
        
        main > div {
            width: 100%;
            max-width: 100%;
        }
        
        /* Fixed right margin issue on mobile */
        .md\:ml-64 {
            margin-left: 0 !important;
        }
        
        /* Better table handling */
        .overflow-x-auto {
            max-width: 100%;
            margin-left: 0;
            margin-right: 0;
            -webkit-overflow-scrolling: touch;
        }
        
        /* Fix for any fixed-width elements */
        .w-full {
            max-width: 100%;
            overflow-x: hidden;
        }
        
        /* Fix padding on mobile */
        .p-4, .px-4, .py-4, .p-6, .px-6, .py-6 {
            padding-left: 0.75rem !important;
            padding-right: 0.75rem !important;
        }
    }
</style>

@yield('head-scripts')
</head>

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true', sidebarOpen: window.innerWidth > 768 }" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))"
    :class="{ 'dark': darkMode }">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 z-30 w-64 bg-white dark:bg-gray-800 shadow-lg transition-transform duration-300 transform"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">
            <!-- Logo -->
            <div class="flex items-center justify-between h-16 px-4 border-b dark:border-gray-700">
                <div class="flex items-center">
                    <span class="text-xl font-bold text-gray-800 dark:text-white">{{ config('app.name') }}</span>
                    <span class="ml-1 px-2 py-0.5 text-xs font-semibold bg-blue-500 text-white rounded-md">Admin</span>
                </div>
                <button
                    class="p-1 rounded-md md:hidden text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white"
                    @click="sidebarOpen = false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Navigation Links -->
            <div class="px-2 py-4">
                <div class="space-y-1">
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center px-4 py-2.5 text-base font-medium rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-blue-500 text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3"></i>
                        <span>Dashboard</span>
                    </a>

                    <div x-data="{ open: {{ request()->routeIs('admin.users.*') ? 'true' : 'false' }} }">
                        <button @click="open = !open"
                            class="flex items-center justify-between w-full px-4 py-2.5 text-base font-medium text-left text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                            <div class="flex items-center">
                                <i data-lucide="users" class="w-5 h-5 mr-3"></i>
                                <span>Users</span>
                            </div>
                            <svg :class="open ? 'rotate-90' : ''" class="w-5 h-5 transition-transform"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                        <div x-show="open" class="pl-10 mt-1 space-y-1" style="display: none;">
                            <a href="{{ route('admin.users.index') }}"
                                class="flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.users.index') ? 'bg-blue-500 text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                All Users
                            </a>
                            {{-- <a href="{{ route('admin.users.create') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.users.create') ? 'bg-blue-500 text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                Add New
                            </a> --}}

                        </div>
                    </div>

                    <div x-data="{ open: {{ request()->routeIs('admin.investments.*') || request()->routeIs('admin.plans.*') ? 'true' : 'false' }} }">
                        <button @click="open = !open"
                            class="flex items-center justify-between w-full px-4 py-2.5 text-base font-medium text-left text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                            <div class="flex items-center">
                                <i data-lucide="trending-up" class="w-5 h-5 mr-3"></i>
                                <span>Investments</span>
                            </div>
                            <svg :class="open ? 'rotate-90' : ''" class="w-5 h-5 transition-transform"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                        <div x-show="open" class="pl-10 mt-1 space-y-1" style="display: none;">
                            <a href="{{ route('admin.investments.index') }}"
                                class="flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.investments.index') ? 'bg-blue-500 text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                All Investments
                            </a>
                            <a href="{{ route('admin.plans.index') }}"
                                class="flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.plans.index') ? 'bg-blue-500 text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                Investment Plans
                            </a>

                        </div>
                    </div>
                    <div x-data="{ open: {{ request()->routeIs('admin.deposits.*') || request()->routeIs('admin.withdrawals.*') ? 'true' : 'false' }} }">
                        <button @click="open = !open"
                            class="flex items-center justify-between w-full px-4 py-2.5 text-base font-medium text-left text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                            <div class="flex items-center">
                                <i data-lucide="banknote" class="w-5 h-5 mr-3"></i>
                                <span>Transactions</span>
                            </div>
                            <svg :class="open ? 'rotate-90' : ''" class="w-5 h-5 transition-transform"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                        <div x-show="open" class="pl-10 mt-1 space-y-1" style="display: none;">
                            @php
                                $pendingDepositsCount = \App\Models\Transaction::where('status', 'pending')
                                    ->where('type', 'deposit')
                                    ->count();
                                $pendingWithdrawalsCount = \App\Models\Transaction::where('status', 'pending')
                                    ->where('type', 'withdrawal')
                                    ->count();
                            @endphp
                            <a href="{{ route('admin.deposits.index') }}"
                                class="flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.deposits.index') && !request()->query('status') ? 'bg-blue-500 text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                Deposits
                            </a>
                            <a href="{{ route('admin.deposits.index') }}?status=pending"
                                class="flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.deposits.index') && request()->query('status') == 'pending' ? 'bg-blue-500 text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                <span>Pending Deposits</span>
                                <span
                                    class="ml-2 px-2 py-0.5 text-xs font-medium bg-red-500 text-white rounded-full">{{ $pendingDepositsCount }}</span>
                            </a>
                            <a href="{{ route('admin.withdrawals.index') }}"
                                class="flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.withdrawals.index') && !request()->query('status') ? 'bg-blue-500 text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                Withdrawals
                            </a>
                            <a href="{{ route('admin.withdrawals.index') }}?status=pending"
                                class="flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.withdrawals.index') && request()->query('status') == 'pending' ? 'bg-blue-500 text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                <span>Pending Withdrawals</span>
                                <span
                                    class="ml-2 px-2 py-0.5 text-xs font-medium bg-red-500 text-white rounded-full">{{ $pendingWithdrawalsCount }}</span>
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('admin.payment-methods.index') }}"
                        class="flex items-center px-4 py-2.5 text-base font-medium rounded-lg {{ request()->routeIs('admin.payment-methods.*') ? 'bg-blue-500 text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        <i data-lucide="wallet" class="w-5 h-5 mr-3"></i>
                        <span>Payment Methods</span>
                    </a>

                    <a href="{{ route('admin.settings.index') }}"
                        class="flex items-center px-4 py-2.5 text-base font-medium rounded-lg {{ request()->routeIs('admin.settings.*') ? 'bg-blue-500 text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        <i data-lucide="settings" class="w-5 h-5 mr-3"></i>
                        <span>Settings</span>
                    </a>

                    <div class="pt-4 mt-4 border-t dark:border-gray-700">
                        <a href="{{ route('admin.profile') }}"
                            class="flex items-center px-4 py-2.5 text-base font-medium rounded-lg {{ request()->routeIs('admin.profile') ? 'bg-blue-500 text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                            <i data-lucide="user" class="w-5 h-5 mr-3"></i>
                            <span>My Profile</span>
                        </a>

                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit"
                                class="flex w-full items-center px-4 py-2.5 text-base font-medium rounded-lg text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">
                                <i data-lucide="log-out" class="w-5 h-5 mr-3"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1 flex flex-col md:ml-64">
            <!-- Top bar -->
            <header class="sticky top-0 z-20 bg-white dark:bg-gray-800 border-b dark:border-gray-700 shadow-sm">
                <div class="px-4 sm:px-6 h-16 flex items-center justify-between">
                    <!-- Mobile menu button -->
                    <button
                        class="md:hidden p-2 rounded-md text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white"
                        @click="sidebarOpen = !sidebarOpen">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <!-- Page title -->
                    <h1 class="text-lg font-medium text-gray-800 dark:text-white md:ml-0 md:block">
                        @yield('page-title', 'Admin Dashboard')
                    </h1>

                    <div class="flex items-center space-x-4">

                        <!-- User menu -->
                        <div x-data="{ open: false }" class="relative">
                            <button class="flex items-center text-sm rounded-full focus:outline-none"
                                @click="open = !open">
                                <div
                                    class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-200">
                                    A
                                </div>
                            </button>

                            <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95" @click.outside="open = false"
                                class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 dark:divide-gray-700"
                                style="display: none;">
                                <div class="px-4 py-3">
                                    <p class="text-sm text-gray-800 dark:text-white">Logged in as</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-gray-200 truncate">
                                        admin@{{ strtolower(config('app.name')) }}.com</p>
                                </div>
                                <div class="py-1">
                                    <a href="{{ route('admin.profile') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        Profile
                                    </a>
                                    <a href="{{ route('admin.settings.index') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        Settings
                                    </a>
                                </div>
                                <div class="py-1">
                                    <form method="POST" action="{{ route('admin.logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                            Sign out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main content -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6">
                <div class="w-full max-w-full overflow-hidden">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @yield('scripts')
    <script>
        // Add to existing scripts
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Lucide icons
            lucide.createIcons();
            
            // Make tables scrollable on mobile
            const tables = document.querySelectorAll('table.min-w-full');
            tables.forEach(table => {
                // Make sure parent has overflow-x-auto
                if (!table.parentElement.classList.contains('overflow-x-auto')) {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'overflow-x-auto w-full';
                    wrapper.style.scrollbarWidth = 'thin';
                    table.parentNode.insertBefore(wrapper, table);
                    wrapper.appendChild(table);
                }
                
                // Ensure all table headers don't wrap
                const headers = table.querySelectorAll('th');
                headers.forEach(header => {
                    if (!header.classList.contains('whitespace-nowrap')) {
                        header.classList.add('whitespace-nowrap');
                    }
                });
            });
            
            // Fix for any overflowing elements on mobile
            function fixOverflow() {
                if (window.innerWidth <= 768) {
                    const main = document.querySelector('main');
                    const contentWrappers = document.querySelectorAll('.bg-white, .dark\\:bg-gray-800');
                    
                    contentWrappers.forEach(wrapper => {
                        if (wrapper.offsetWidth > main.offsetWidth) {
                            wrapper.style.maxWidth = '100%';
                            wrapper.style.width = '100%';
                            wrapper.style.overflowX = 'hidden';
                        }
                    });
                }
            }
            
            // Run on load and resize
            fixOverflow();
            window.addEventListener('resize', fixOverflow);
        });
    </script>
</body>

</html>
