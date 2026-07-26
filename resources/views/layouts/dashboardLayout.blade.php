<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | {{ config('app.name') }}</title>
    
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lucide Icons via CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Cryptocoins Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cryptocoins-icons@2.9.0/webfont/cryptocoins.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cryptocoins-icons@2.9.0/webfont/cryptocoins-colors.css">

    @if(App\Models\Setting::get("tawk_to_embed_url"))
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='{{App\Models\Setting::get("tawk_to_embed_url")}}';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
    @endif

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f5f3ff',
                            100: '#eedeff',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                        },
                        darkbg: '#090d16',
                        darkcard: 'rgba(17, 24, 39, 0.7)',
                    },
                    boxShadow: {
                        premium: '0 10px 30px -10px rgba(0, 0, 0, 0.1)',
                        glow: '0 0 20px -5px rgba(99, 102, 241, 0.5)',
                    }
                }
            }
        }
    </script>
    
    <style>
        /* Immersive custom styles and animations */
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }
        
        .dark .glass-card {
            background: rgba(17, 24, 39, 0.55);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.06);
        }
        
        /* Premium mesh background animation */
        .mesh-gradient-bg {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -1;
            overflow: hidden;
            background-color: #f8fafc;
        }
        
        .dark .mesh-gradient-bg {
            background-color: #070a13;
        }

        .mesh-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.35;
            mix-blend-mode: multiply;
            animation: floatOrb 20s infinite alternate;
        }
        
        .dark .mesh-orb {
            opacity: 0.18;
            mix-blend-mode: screen;
        }
        
        @keyframes floatOrb {
            0% { transform: translate(0px, 0px) scale(1); }
            50% { transform: translate(40px, 60px) scale(1.2); }
            100% { transform: translate(-30px, -40px) scale(0.9); }
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(156, 163, 175, 0.25);
            border-radius: 99px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(156, 163, 175, 0.45);
        }
    </style>
    @yield('head')
</head>

<body class="h-full bg-gray-50 dark:bg-darkbg text-gray-900 dark:text-gray-100 transition-colors duration-300 font-sans">
    
    <!-- Premium background elements -->
    <div class="mesh-gradient-bg">
        <div class="mesh-orb bg-indigo-400 dark:bg-indigo-900 w-96 h-96 -top-12 -left-12"></div>
        <div class="mesh-orb bg-teal-300 dark:bg-emerald-950 w-[450px] h-[450px] bottom-10 right-10" style="animation-delay: 2s;"></div>
        <div class="mesh-orb bg-purple-300 dark:bg-violet-950 w-80 h-80 top-1/2 left-1/3" style="animation-delay: 4s;"></div>
    </div>

    <div class="min-h-screen flex flex-col md:flex-row relative">
        
        <!-- Mobile Header with Hamburger -->
        <header class="bg-white/80 dark:bg-[#111827]/80 backdrop-blur-md md:hidden flex items-center justify-between p-4 shadow-sm border-b border-gray-200/50 dark:border-gray-800/50 z-30">
            <div class="flex items-center">
                <button id="sidebar-toggle" class="focus:outline-none mr-3 p-2 rounded-lg bg-gray-100 dark:bg-gray-800">
                    <i data-lucide="menu" class="w-5 h-5 text-gray-700 dark:text-gray-300"></i>
                </button>
                <div class="flex items-center space-x-2">
                    <div class="bg-indigo-600 p-2 rounded-lg text-white shadow-md shadow-indigo-600/30">
                        <i data-lucide="wallet" class="w-5 h-5"></i>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-gray-900 dark:text-white uppercase">{{ env('APP_NAME') }}</span>
                </div>
            </div>
            <!-- Dark mode toggle button for mobile -->
            <button id="mobile-theme-toggle" class="p-2 rounded-lg bg-gray-100 dark:bg-gray-800">
                <i data-lucide="sun" id="mobile-theme-toggle-dark-icon" class="hidden w-5 h-5 text-yellow-500"></i>
                <i data-lucide="moon" id="mobile-theme-toggle-light-icon" class="hidden w-5 h-5 text-gray-500"></i>
            </button>
        </header>

        <!-- Sidebar (Hidden by default on mobile) -->
        <aside id="sidebar"
            class="hidden md:flex flex-col w-72 bg-white/95 dark:bg-[#0f172a]/95 backdrop-blur-md border-r border-gray-200/50 dark:border-gray-800/50 fixed md:sticky md:top-0 md:h-screen md:flex-shrink-0 inset-y-0 left-0 z-40 transform transition-transform duration-300 ease-in-out">
            
            <div class="p-6 flex items-center space-x-3 border-b border-gray-100 dark:border-gray-800/80">
                <div class="bg-indigo-600 p-2.5 rounded-xl text-white shadow-lg shadow-indigo-600/30">
                    <i data-lucide="wallet" class="w-6 h-6"></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-xl font-bold tracking-wider text-gray-900 dark:text-white uppercase leading-none">{{ env('APP_NAME') }}</span>
                    <span class="text-[10px] text-indigo-500 font-medium tracking-widest mt-1 uppercase">Invest Portal</span>
                </div>
            </div>
            
            <nav class="flex-1 px-4 py-6 overflow-y-auto space-y-7">
                <!-- Dashboard main item -->
                <div class="space-y-1">
                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ Route::currentRouteName() == 'dashboard' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' }}">
                        <i data-lucide="home" class="w-5 h-5 mr-3"></i>
                        <span>Dashboard Overview</span>
                    </a>
                </div>

                <!-- Investments Section -->
                <div class="space-y-1">
                    <span class="px-4 text-[10px] uppercase font-bold text-gray-400 dark:text-gray-500 tracking-widest block mb-2">Portfolio</span>
                    <a href="{{ route('dashboard.investments') }}" 
                       class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ Route::currentRouteName() == 'dashboard.investments' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' }}">
                        <i data-lucide="trending-up" class="w-5 h-5 mr-3"></i>
                        <span>My Investments</span>
                    </a>
                </div>

                <!-- Deposits Section -->
                <div class="space-y-1">
                    <span class="px-4 text-[10px] uppercase font-bold text-gray-400 dark:text-gray-500 tracking-widest block mb-2">Funding</span>
                    <a href="{{ route('dashboard.deposits.create') }}" 
                       class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ Route::currentRouteName() == 'dashboard.deposits.create' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' }}">
                        <i data-lucide="plus-circle" class="w-5 h-5 mr-3"></i>
                        <span>Add Deposit</span>
                    </a>
                    <a href="{{ route('dashboard.deposits.history') }}" 
                       class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ Route::currentRouteName() == 'dashboard.deposits.history' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' }}">
                        <i data-lucide="clock" class="w-5 h-5 mr-3"></i>
                        <span>Deposit History</span>
                    </a>
                </div>

                <!-- Withdrawals Section -->
                <div class="space-y-1">
                    <span class="px-4 text-[10px] uppercase font-bold text-gray-400 dark:text-gray-500 tracking-widest block mb-2">Withdraw</span>
                    <a href="{{ route('dashboard.withdrawals.create') }}" 
                       class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ Route::currentRouteName() == 'dashboard.withdrawals.create' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' }}">
                        <i data-lucide="download" class="w-5 h-5 mr-3"></i>
                        <span>Request Payout</span>
                    </a>
                    <a href="{{ route('dashboard.withdrawals.history') }}" 
                       class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ Route::currentRouteName() == 'dashboard.withdrawals.history' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' }}">
                        <i data-lucide="file-text" class="w-5 h-5 mr-3"></i>
                        <span>Payout History</span>
                    </a>
                </div>

                <!-- User Account Area -->
                <div class="space-y-1">
                    <span class="px-4 text-[10px] uppercase font-bold text-gray-400 dark:text-gray-500 tracking-widest block mb-2">Account</span>
                    <a href="{{ route('dashboard.referrals') }}" 
                       class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ Route::currentRouteName() == 'dashboard.referrals' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' }}">
                        <i data-lucide="users" class="w-5 h-5 mr-3"></i>
                        <span>Referrals Program</span>
                    </a>
                    <a href="{{ route('dashboard.profile') }}" 
                       class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ Route::currentRouteName() == 'dashboard.profile' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' }}">
                        <i data-lucide="user" class="w-5 h-5 mr-3"></i>
                        <span>Profile Settings</span>
                    </a>
                </div>
            </nav>

            <!-- Bottom profile / theme section -->
            <div class="p-4 border-t border-gray-100 dark:border-gray-800 flex flex-col space-y-4 bg-gray-50/50 dark:bg-gray-950/20">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-500 to-purple-600 flex items-center justify-center text-white font-semibold shadow-md">
                            {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-semibold text-gray-800 dark:text-white truncate max-w-[120px]">{{ Auth::user()->name }}</span>
                            <span class="text-xs text-gray-500 truncate max-w-[120px]">{{ Auth::user()->email }}</span>
                        </div>
                    </div>
                    
                    <!-- Dark mode toggle button for desktop -->
                    <button id="theme-toggle" class="p-2 rounded-xl bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 transition duration-200">
                        <i data-lucide="sun" id="theme-toggle-dark-icon" class="hidden w-4 h-4 text-yellow-500 animate-spin-slow"></i>
                        <i data-lucide="moon" id="theme-toggle-light-icon" class="hidden w-4 h-4 text-indigo-400"></i>
                    </button>
                </div>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center justify-center px-4 py-2.5 bg-red-50 hover:bg-red-100 dark:bg-red-950/20 dark:hover:bg-red-950/40 text-red-600 dark:text-red-400 text-xs font-semibold rounded-xl transition duration-200">
                        <i data-lucide="log-out" class="w-4 h-4 mr-2"></i>
                        <span>Logout Account</span>
                    </button>
                </form>
            </div>
            
            <!-- Mobile Close button inside sidebar footer -->
            <div class="p-4 md:hidden border-t dark:border-gray-800">
                <button id="close-sidebar" class="flex items-center justify-center px-4 py-2 bg-gray-100 dark:bg-gray-800 text-sm font-semibold rounded-xl text-gray-700 dark:text-gray-300 w-full">
                    <i data-lucide="x" class="w-4 h-4 mr-2"></i>
                    <span>Close Menu</span>
                </button>
            </div>
        </aside>

        <!-- Main Content Panel -->
        <div class="flex-1 flex flex-col min-w-0 md:pl-0 z-10">
            <!-- Desktop Header -->
            <header class="hidden md:flex items-center justify-between py-6 px-8 bg-transparent">
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">@yield('page-title', 'Welcome Back')</h2>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2 bg-white/80 dark:bg-[#1e293b]/50 backdrop-blur-sm border border-gray-200/50 dark:border-gray-800/50 px-4 py-2 rounded-xl text-xs font-semibold text-gray-600 dark:text-gray-300">
                        <span class="w-2 h-2 bg-green-500 rounded-full animate-ping"></span>
                        <span>API Server Live</span>
                    </div>
                </div>
            </header>

            <main class="flex-1 p-6 md:p-8 md:pt-2 overflow-y-auto">
                <!-- Notifications / Flash Messages -->
                @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-100/90 dark:bg-emerald-950/30 border border-emerald-200 dark:border-emerald-900 text-emerald-800 dark:text-emerald-200 rounded-2xl flex items-center shadow-lg shadow-emerald-500/5">
                    <i data-lucide="check-circle" class="w-5 h-5 mr-3 text-emerald-600"></i>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
                @endif
                
                @if(session('error'))
                <div class="mb-6 p-4 bg-red-100/90 dark:bg-red-950/30 border border-red-200 dark:border-red-900 text-red-800 dark:text-red-200 rounded-2xl flex items-center shadow-lg shadow-red-500/5">
                    <i data-lucide="alert-triangle" class="w-5 h-5 mr-3 text-red-600"></i>
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                </div>
                @endif

                @yield('content')
            </main>
        </div>

        <!-- Overlay for mobile sidebar -->
        <div id="sidebar-overlay" class="md:hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-30 hidden"></div>
    </div>

    <!-- Scripts -->
    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Dark mode toggle functionality
        const setupThemeToggle = (toggleBtn, darkIcon, lightIcon) => {
            if (localStorage.getItem('color-theme') === 'dark' ||
                (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                lightIcon.classList.remove('hidden');
                document.documentElement.classList.add('dark');
            } else {
                darkIcon.classList.remove('hidden');
                document.documentElement.classList.remove('dark');
            }

            toggleBtn.addEventListener('click', function() {
                darkIcon.classList.toggle('hidden');
                lightIcon.classList.toggle('hidden');

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

        const themeToggle = document.getElementById('theme-toggle');
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        const mobileThemeToggle = document.getElementById('mobile-theme-toggle');
        const mobileThemeToggleDarkIcon = document.getElementById('mobile-theme-toggle-dark-icon');
        const mobileThemeToggleLightIcon = document.getElementById('mobile-theme-toggle-light-icon');

        if (themeToggle) setupThemeToggle(themeToggle, themeToggleDarkIcon, themeToggleLightIcon);
        if (mobileThemeToggle) setupThemeToggle(mobileThemeToggle, mobileThemeToggleDarkIcon, mobileThemeToggleLightIcon);

        // Mobile sidebar toggle functionality
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('sidebar');
        const closeSidebar = document.getElementById('close-sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.remove('hidden');
                sidebarOverlay.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            });
        }

        const hideSidebar = () => {
            sidebar.classList.add('hidden');
            sidebarOverlay.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        };

        if (closeSidebar) closeSidebar.addEventListener('click', hideSidebar);
        if (sidebarOverlay) sidebarOverlay.addEventListener('click', hideSidebar);
    </script>
    @yield('scripts')
</body>

</html>
