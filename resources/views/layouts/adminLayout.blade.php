<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - MacDonald Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <!-- Scripts -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        [x-cloak] { display: none !important; }
        
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
    </style>

    @yield('head-scripts')
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true', sidebarOpen: window.innerWidth > 768 }" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))" :class="{ 'dark': darkMode }">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div 
            class="fixed inset-y-0 left-0 z-30 w-64 bg-white dark:bg-gray-800 shadow-lg transition-transform duration-300 transform" 
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
        >
            <!-- Logo -->
            <div class="flex items-center justify-between h-16 px-4 border-b dark:border-gray-700">
                <div class="flex items-center">
                    <span class="text-xl font-bold text-gray-800 dark:text-white">MacDonald</span>
                    <span class="ml-1 px-2 py-0.5 text-xs font-semibold bg-blue-500 text-white rounded-md">Admin</span>
                </div>
                <button class="p-1 rounded-md md:hidden text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white" @click="sidebarOpen = false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <!-- Navigation Links -->
            <div class="px-2 py-4">
                <div class="space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2.5 text-base font-medium rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-blue-500 text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3"></i>
                        <span>Dashboard</span>
                    </a>

                    <div x-data="{ open: {{ request()->routeIs('admin.users.*') ? 'true' : 'false' }} }">
                        <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-2.5 text-base font-medium text-left text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                            <div class="flex items-center">
                                <i data-lucide="users" class="w-5 h-5 mr-3"></i>
                                <span>Users</span>
                            </div>
                            <svg :class="open ? 'rotate-90' : ''" class="w-5 h-5 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                        <div x-show="open" class="pl-10 mt-1 space-y-1" style="display: none;">
                            <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.users.index') ? 'bg-blue-500 text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                All Users
                            </a>
                            <a href="{{ route('admin.users.create') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.users.create') ? 'bg-blue-500 text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                Add New
                            </a>
                            
                        </div>
                    </div>

                    <div x-data="{ open: {{ request()->routeIs('admin.investments.*') || request()->routeIs('admin.plans.*') ? 'true' : 'false' }} }">
                        <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-2.5 text-base font-medium text-left text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                            <div class="flex items-center">
                                <i data-lucide="trending-up" class="w-5 h-5 mr-3"></i>
                                <span>Investments</span>
                            </div>
                            <svg :class="open ? 'rotate-90' : ''" class="w-5 h-5 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                        <div x-show="open" class="pl-10 mt-1 space-y-1" style="display: none;">
                            <a href="{{ route('admin.investments.index') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.investments.index') ? 'bg-blue-500 text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                All Investments
                            </a>
                            <a href="{{ route('admin.plans.index') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.plans.index') ? 'bg-blue-500 text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                Investment Plans
                            </a>
                            <a href="{{ route('admin.investments.index') }}?status=pending" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.investments.index') && request()->query('status') == 'pending' ? 'bg-blue-500 text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                Pending Investments
                            </a>
                        </div>
                    </div>
                    <div x-data="{ open: {{ request()->routeIs('admin.deposits.*') || request()->routeIs('admin.withdrawals.*') ? 'true' : 'false' }} }">
                        <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-2.5 text-base font-medium text-left text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                            <div class="flex items-center">
                                <i data-lucide="banknote" class="w-5 h-5 mr-3"></i>
                                <span>Transactions</span>
                            </div>
                            <svg :class="open ? 'rotate-90' : ''" class="w-5 h-5 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                        <div x-show="open" class="pl-10 mt-1 space-y-1" style="display: none;">
                            <a href="{{ route('admin.deposits.index') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.deposits.index') && !request()->query('status') ? 'bg-blue-500 text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                Deposits
                            </a>
                            <a href="{{ route('admin.deposits.index') }}?status=pending" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.deposits.index') && request()->query('status') == 'pending' ? 'bg-blue-500 text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                <span>Pending Deposits</span>
                                <span class="ml-2 px-2 py-0.5 text-xs font-medium bg-red-500 text-white rounded-full">5</span>
                            </a>
                            <a href="{{ route('admin.withdrawals.index') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.withdrawals.index') && !request()->query('status') ? 'bg-blue-500 text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                Withdrawals
                            </a>
                            <a href="{{ route('admin.withdrawals.index') }}?status=pending" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.withdrawals.index') && request()->query('status') == 'pending' ? 'bg-blue-500 text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                <span>Pending Withdrawals</span>
                                <span class="ml-2 px-2 py-0.5 text-xs font-medium bg-red-500 text-white rounded-full">3</span>
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('admin.payment-methods.index') }}" class="flex items-center px-4 py-2.5 text-base font-medium rounded-lg {{ request()->routeIs('admin.payment-methods.*') ? 'bg-blue-500 text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        <i data-lucide="wallet" class="w-5 h-5 mr-3"></i>
                        <span>Payment Methods</span>
                    </a>

                    <a href="{{ route('admin.settings.index') }}" class="flex items-center px-4 py-2.5 text-base font-medium rounded-lg {{ request()->routeIs('admin.settings.*') ? 'bg-blue-500 text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        <i data-lucide="settings" class="w-5 h-5 mr-3"></i>
                        <span>Settings</span>
                    </a>

                    <div class="pt-4 mt-4 border-t dark:border-gray-700">
                        <a href="{{ route('admin.profile') }}" class="flex items-center px-4 py-2.5 text-base font-medium rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i data-lucide="user" class="w-5 h-5 mr-3"></i>
                            <span>My Profile</span>
                        </a>
                        
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="flex w-full items-center px-4 py-2.5 text-base font-medium rounded-lg text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">
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
                        @click="sidebarOpen = !sidebarOpen"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <!-- Page title -->
                    <h1 class="text-lg font-medium text-gray-800 dark:text-white md:ml-0 md:block">
                        @yield('page-title', 'Admin Dashboard')
                    </h1>

                    <div class="flex items-center space-x-4">
                        <!-- Dark mode toggle -->
                        <button 
                            class="p-1 rounded-md text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white"
                            @click="darkMode = !darkMode"
                        >
                            <svg 
                                x-show="!darkMode" 
                                xmlns="http://www.w3.org/2000/svg" 
                                class="h-6 w-6" 
                                fill="none" 
                                viewBox="0 0 24 24" 
                                stroke="currentColor"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                            <svg 
                                x-show="darkMode" 
                                xmlns="http://www.w3.org/2000/svg" 
                                class="h-6 w-6" 
                                fill="none" 
                                viewBox="0 0 24 24" 
                                stroke="currentColor"
                                style="display: none;"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </button>

                        <!-- Notifications -->
                        <div x-data="{ open: false }" class="relative">
                            <button 
                                class="p-1 rounded-md text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white relative"
                                @click="open = !open"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                            </button>

                            <div 
                                x-show="open" 
                                x-transition:enter="transition ease-out duration-100" 
                                x-transition:enter-start="transform opacity-0 scale-95" 
                                x-transition:enter-end="transform opacity-100 scale-100" 
                                x-transition:leave="transition ease-in duration-75" 
                                x-transition:leave-start="transform opacity-100 scale-100" 
                                x-transition:leave-end="transform opacity-0 scale-95" 
                                @click.outside="open = false"
                                class="origin-top-right absolute right-0 mt-2 w-80 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 dark:divide-gray-700"
                                style="display: none;"
                            >
                                <div class="px-4 py-3">
                                    <h3 class="text-sm font-medium text-gray-800 dark:text-white">Notifications</h3>
                                </div>
                                <div class="py-1 max-h-60 overflow-y-auto">
                                    <a href="#" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <div class="flex-shrink-0">
                                            <span class="flex h-8 w-8 rounded-full bg-blue-100 dark:bg-blue-900 items-center justify-center">
                                                <i data-lucide="user-plus" class="h-4 w-4 text-blue-600 dark:text-blue-400"></i>
                                            </span>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-800 dark:text-white">New user registration</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">A new user has registered to the platform</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">10 minutes ago</p>
                                        </div>
                                    </a>
                                    <a href="#" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <div class="flex-shrink-0">
                                            <span class="flex h-8 w-8 rounded-full bg-green-100 dark:bg-green-900 items-center justify-center">
                                                <i data-lucide="dollar-sign" class="h-4 w-4 text-green-600 dark:text-green-400"></i>
                                            </span>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-800 dark:text-white">New deposit received</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">$1,000.00 deposit requires approval</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">1 hour ago</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="py-1">
                                    <a href="#" class="flex justify-center items-center px-4 py-2 text-sm text-blue-600 dark:text-blue-400 hover:underline">
                                        View all notifications
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- User menu -->
                        <div x-data="{ open: false }" class="relative">
                            <button 
                                class="flex items-center text-sm rounded-full focus:outline-none"
                                @click="open = !open"
                            >
                                <div class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-200">
                                    A
                                </div>
                            </button>

                            <div 
                                x-show="open" 
                                x-transition:enter="transition ease-out duration-100" 
                                x-transition:enter-start="transform opacity-0 scale-95" 
                                x-transition:enter-end="transform opacity-100 scale-100" 
                                x-transition:leave="transition ease-in duration-75" 
                                x-transition:leave-start="transform opacity-100 scale-100" 
                                x-transition:leave-end="transform opacity-0 scale-95" 
                                @click.outside="open = false"
                                class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 dark:divide-gray-700"
                                style="display: none;"
                            >
                                <div class="px-4 py-3">
                                    <p class="text-sm text-gray-800 dark:text-white">Logged in as</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-gray-200 truncate">admin@macdonald.com</p>
                                </div>
                                <div class="py-1">
                                    <a href="{{ route('admin.profile') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        Profile
                                    </a>
                                    <a href="{{ route('admin.settings.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        Settings
                                    </a>
                                </div>
                                <div class="py-1">
                                    <form method="POST" action="{{ route('admin.logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
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
                <!-- Dynamic content -->
                @yield('content')
            </main>
        </div>
    </div>

    @yield('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Lucide icons
            lucide.createIcons();
        });
    </script>
</body>
</html>