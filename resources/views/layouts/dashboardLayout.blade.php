<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | MacDonald</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lucide Icons via CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Configure Tailwind with dark mode -->

    <!-- Cryptocoins Icons CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cryptocoins-icons@2.9.0/webfont/cryptocoins.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cryptocoins-icons@2.9.0/webfont/cryptocoins-colors.css">

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#1e40af',
                        secondary: '#10b981',
                    }
                }
            }
        }
    </script>
    <!-- Dark mode toggle script -->
    <script>
        // Check for dark mode preference on page load
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    @yield('head')
</head>
<body class="h-full bg-gray-100 dark:bg-gray-900 transition-colors duration-200">
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Mobile Header with Hamburger -->
        <div class="bg-white dark:bg-gray-800 md:hidden flex items-center justify-between p-4 shadow-md">
            <div class="flex items-center">
                <button id="sidebar-toggle" class="focus:outline-none mr-3">
                    <i data-lucide="menu" class="w-6 h-6 text-gray-700 dark:text-white"></i>
                </button>
                <h1 class="text-xl font-bold text-gray-800 dark:text-white">MacDonald</h1>
            </div>
            <!-- Dark mode toggle button for mobile -->
            <button id="mobile-theme-toggle" class="p-2 rounded-md bg-gray-200 dark:bg-gray-700">
                <i data-lucide="sun" id="mobile-theme-toggle-dark-icon" class="hidden w-5 h-5 text-yellow-500"></i>
                <i data-lucide="moon" id="mobile-theme-toggle-light-icon" class="hidden w-5 h-5 text-gray-500"></i>
            </button>
        </div>

        <!-- Sidebar (hidden by default on mobile) -->
        <aside id="sidebar" class="hidden md:block w-64 bg-white dark:bg-gray-800 shadow-md fixed md:static inset-y-0 left-0 z-30 transform transition-transform duration-300 ease-in-out">
            <div class="p-6 hidden md:block">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">MacDonald</h1>
            </div>
            <nav class="mt-6">
                <ul>
                    <li class="px-6 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <a href="{{ route('dashboard') }}" class="flex items-center text-gray-700 dark:text-gray-200">
                            <i data-lucide="home" class="w-5 h-5 mr-3"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    
                    <!-- Investments -->
                    <li class="px-6 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <a href="{{ route('dashboard.investments') ?? '#' }}" class="flex items-center text-gray-700 dark:text-gray-200">
                            <i data-lucide="trending-up" class="w-5 h-5 mr-3"></i>
                            <span>Investments</span>
                        </a>
                    </li>
                    
                    <!-- Deposits Section -->
                    <li class="px-6 py-2 mt-2">
                        <span class="text-xs uppercase font-medium text-gray-500 dark:text-gray-400">Deposits</span>
                    </li>
                    <li class="px-6 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <a href="{{ route('dashboard.deposits.create') ?? '#' }}" class="flex items-center text-gray-700 dark:text-gray-200">
                            <i data-lucide="plus-circle" class="w-5 h-5 mr-3"></i>
                            <span>Create Deposit</span>
                        </a>
                    </li>
                    <li class="px-6 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <a href="{{ route('dashboard.deposits.history') ?? '#' }}" class="flex items-center text-gray-700 dark:text-gray-200">
                            <i data-lucide="clock" class="w-5 h-5 mr-3"></i>
                            <span>Deposit History</span>
                        </a>
                    </li>
                    
                    <!-- Withdrawals Section -->
                    <li class="px-6 py-2 mt-2">
                        <span class="text-xs uppercase font-medium text-gray-500 dark:text-gray-400">Withdrawals</span>
                    </li>
                    <li class="px-6 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <a href="{{ route('dashboard.withdrawals.create') ?? '#' }}" class="flex items-center text-gray-700 dark:text-gray-200">
                            <i data-lucide="download" class="w-5 h-5 mr-3"></i>
                            <span>Make Withdrawal</span>
                        </a>
                    </li>
                    <li class="px-6 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <a href="{{ route('dashboard.withdrawals.history') ?? '#' }}" class="flex items-center text-gray-700 dark:text-gray-200">
                            <i data-lucide="file-text" class="w-5 h-5 mr-3"></i>
                            <span>Withdrawal History</span>
                        </a>
                    </li>
                    
                    <!-- Other Menu Items -->
                    <li class="px-6 py-2 mt-2">
                        <span class="text-xs uppercase font-medium text-gray-500 dark:text-gray-400">Account</span>
                    </li>
                    
                    
                    <li class="px-6 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <a href="{{ route('dashboard.referrals') ?? '#' }}" class="flex items-center text-gray-700 dark:text-gray-200">
                            <i data-lucide="users" class="w-5 h-5 mr-3"></i>
                            <span>Referrals</span>
                        </a>
                    </li>
                    <li class="px-6 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <a href="{{ route('dashboard.profile') ?? '#' }}" class="flex items-center text-gray-700 dark:text-gray-200">
                            <i data-lucide="user" class="w-5 h-5 mr-3"></i>
                            <span>Profile</span>
                        </a>
                    </li>
                    
                    <li class="px-6 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <form method="POST" action="{{ route('logout') ?? '#' }}">
                            @csrf
                            <button type="submit" class="flex items-center text-gray-700 dark:text-gray-200 w-full text-left">
                                <i data-lucide="log-out" class="w-5 h-5 mr-3"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>

            <!-- Mobile Only: Close button at the bottom -->
            <div class="mt-6 p-4 md:hidden">
                <button id="close-sidebar" class="flex items-center text-gray-700 dark:text-gray-200">
                    <i data-lucide="x" class="w-5 h-5 mr-3"></i>
                    <span>Close Menu</span>
                </button>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-4 md:p-6 overflow-hidden">
            <div class=" justify-between items-center mb-6 hidden md:flex">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">@yield('page-title', 'Welcome Back')</h2>
                <!-- Dark mode toggle button for desktop -->
                <button id="theme-toggle" class="p-2 rounded-md bg-gray-200 dark:bg-gray-700">
                    <i data-lucide="sun" id="theme-toggle-dark-icon" class="hidden w-5 h-5 text-yellow-500"></i>
                    <i data-lucide="moon" id="theme-toggle-light-icon" class="hidden w-5 h-5 text-gray-500"></i>
                </button>
            </div>
            
            <div class="mt-4">
                @yield('content')
            </div>
        </main>

        <!-- Overlay for mobile sidebar -->
        <div id="sidebar-overlay" class="md:hidden fixed inset-0 bg-black bg-opacity-50 z-20 hidden"></div>
    </div>

    <!-- Scripts -->
    <script>
        // Initialize Lucide icons
        lucide.createIcons();
        
        // Dark mode toggle functionality
        const setupThemeToggle = (toggleBtn, darkIcon, lightIcon) => {
            // Change the icons inside the button based on previous settings
            if (localStorage.getItem('color-theme') === 'dark' || 
                (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                lightIcon.classList.remove('hidden');
            } else {
                darkIcon.classList.remove('hidden');
            }

            toggleBtn.addEventListener('click', function() {
                // Toggle icons
                darkIcon.classList.toggle('hidden');
                lightIcon.classList.toggle('hidden');

                // If set in localStorage
                if (localStorage.getItem('color-theme')) {
                    if (localStorage.getItem('color-theme') === 'light') {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    }
                } else {
                    if (document.documentElement.classList.contains('dark')) {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    } else {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    }
                }
            });
        };

        // Setup theme toggles for both desktop and mobile
        const themeToggle = document.getElementById('theme-toggle');
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
        
        const mobileThemeToggle = document.getElementById('mobile-theme-toggle');
        const mobileThemeToggleDarkIcon = document.getElementById('mobile-theme-toggle-dark-icon');
        const mobileThemeToggleLightIcon = document.getElementById('mobile-theme-toggle-light-icon');

        setupThemeToggle(themeToggle, themeToggleDarkIcon, themeToggleLightIcon);
        setupThemeToggle(mobileThemeToggle, mobileThemeToggleDarkIcon, mobileThemeToggleLightIcon);

        // Mobile sidebar toggle functionality
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('sidebar');
        const closeSidebar = document.getElementById('close-sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.remove('hidden', '-translate-x-full');
            sidebar.classList.add('translate-x-0');
            sidebarOverlay.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        });

        const hideSidebar = () => {
            sidebar.classList.add('-translate-x-full');
            setTimeout(() => {
                sidebar.classList.add('hidden');
            }, 300);
            sidebarOverlay.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        };

        closeSidebar.addEventListener('click', hideSidebar);
        sidebarOverlay.addEventListener('click', hideSidebar);
    </script>
    @yield('scripts')
</body>
</html>