<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0b1220">
    <title>@yield('title', 'Dashboard') — {{ env('APP_NAME', 'Laravel') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Cryptocoins Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cryptocoins-icons@2.9.0/webfont/cryptocoins.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cryptocoins-icons@2.9.0/webfont/cryptocoins-colors.css">

    @if(\App\Models\Setting::get("tawk_to_embed_url"))
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='{{\App\Models\Setting::get("tawk_to_embed_url")}}';
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
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        navy: {
                            800: '#111c30',
                            900: '#0b1220',
                            950: '#070c17',
                        },
                        gold: {
                            300: '#f5df91',
                            400: '#d4af37',
                            500: '#c5a028',
                            600: '#a38116',
                        },
                        brand: {
                            50: '#fbf6e7',
                            100: '#f5df91',
                            500: '#d4af37',
                            600: '#c5a028',
                            700: '#a38116',
                        },
                        darkbg: '#070c17',
                        darkcard: 'rgba(11, 18, 32, 0.75)',
                    },
                    boxShadow: {
                        premium: '0 10px 35px -5px rgba(0, 0, 0, 0.25)',
                        gold: '0 10px 30px -5px rgba(212, 175, 55, 0.25)',
                    }
                }
            }
        }
    </script>
    
    <style>
        :root {
            --navy: #0b1220;
            --navy-dark: #070c17;
            --gold: #d4af37;
            --gold-light: #f4d77a;
        }

        /* Glass Cards */
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid #e8edf4;
        }
        
        .dark .glass-card {
            background: rgba(11, 18, 32, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .gold-button {
            background: linear-gradient(135deg, #f1d575, #d4af37);
            color: #111827;
            font-weight: 700;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .gold-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(212, 175, 55, .3);
        }

        .text-gradient-gold {
            background: linear-gradient(110deg, #f5d979, #d4af37 55%, #f8e7a4);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        /* Ambient mesh background */
        .mesh-gradient-bg {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            z-index: -1;
            overflow: hidden;
            background-color: #f7f8fb;
        }
        
        .dark .mesh-gradient-bg {
            background-color: #070c17;
        }

        .mesh-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
            opacity: 0.22;
            animation: floatOrb 22s infinite alternate ease-in-out;
        }
        
        .dark .mesh-orb {
            opacity: 0.15;
            mix-blend-mode: screen;
        }
        
        @keyframes floatOrb {
            0% { transform: translate(0px, 0px) scale(1); }
            50% { transform: translate(45px, 55px) scale(1.15); }
            100% { transform: translate(-35px, -35px) scale(0.9); }
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
            background: rgba(212, 175, 55, 0.25);
            border-radius: 99px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(212, 175, 55, 0.5);
        }
    </style>
    @yield('head')
</head>

<body class="h-full bg-[#f7f8fb] dark:bg-darkbg text-gray-900 dark:text-gray-100 transition-colors duration-300 font-sans">
    
    <!-- Premium background elements -->
    <div class="mesh-gradient-bg">
        <div class="mesh-orb bg-[#d4af37] w-96 h-96 -top-16 -left-16"></div>
        <div class="mesh-orb bg-[#0f244a] w-[500px] h-[500px] bottom-10 right-10" style="animation-delay: 2.5s;"></div>
        <div class="mesh-orb bg-[#f5df91] w-72 h-72 top-1/2 left-1/3" style="animation-delay: 5s;"></div>
    </div>

    <div class="min-h-screen flex flex-col md:flex-row relative">
        
        <!-- Mobile Header -->
        <header class="bg-white/90 dark:bg-navy-900/90 backdrop-blur-md md:hidden flex items-center justify-between p-4 shadow-sm border-b border-gray-200/60 dark:border-white/10 z-30">
            <div class="flex items-center">
                <button id="sidebar-toggle" class="focus:outline-none mr-3 p-2 rounded-xl bg-gray-100 dark:bg-white/10">
                    <i data-lucide="menu" class="w-5 h-5 text-gray-700 dark:text-gray-200"></i>
                </button>
                <div class="flex items-center space-x-2.5">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-[#f5df91] to-[#c5a028] text-sm font-bold text-[#111827] shadow-sm">
                        {{ strtoupper(substr(env('APP_NAME', 'L'), 0, 1)) }}
                    </div>
                    <span class="text-lg font-bold tracking-tight text-gray-900 dark:text-white uppercase">{{ env('APP_NAME', 'Laravel') }}</span>
                </div>
            </div>
            <!-- Dark mode toggle button for mobile -->
            <button id="mobile-theme-toggle" class="p-2 rounded-xl bg-gray-100 dark:bg-white/10">
                <i data-lucide="sun" id="mobile-theme-toggle-dark-icon" class="hidden w-5 h-5 text-[#d4af37]"></i>
                <i data-lucide="moon" id="mobile-theme-toggle-light-icon" class="hidden w-5 h-5 text-gray-400"></i>
            </button>
        </header>

        <!-- Sidebar -->
        <aside id="sidebar"
            class="hidden md:flex flex-col w-72 bg-white/95 dark:bg-navy-900/95 backdrop-blur-xl border-r border-gray-200/70 dark:border-white/10 fixed md:sticky md:top-0 md:h-screen md:flex-shrink-0 inset-y-0 left-0 z-40 transform transition-transform duration-300 ease-in-out">
            
            <!-- Sidebar Brand Header -->
            <div class="p-6 flex items-center space-x-3 border-b border-gray-100 dark:border-white/10">
                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-[#f5df91] to-[#c5a028] text-lg font-bold text-[#111827] shadow-lg shadow-[#d4af37]/20 flex-shrink-0">
                    {{ strtoupper(substr(env('APP_NAME', 'L'), 0, 1)) }}
                </div>
                <div class="flex flex-col">
                    <span class="text-lg font-bold tracking-tight text-gray-900 dark:text-white leading-none">{{ env('APP_NAME', 'Laravel') }}</span>
                    <span class="text-[9px] text-[#c5a028] font-bold tracking-[.22em] uppercase mt-1">Theme 3 Portal</span>
                </div>
            </div>
            
            <!-- Sidebar Navigation -->
            <nav class="flex-1 px-4 py-6 overflow-y-auto space-y-6">
                <!-- Dashboard main item -->
                <div class="space-y-1">
                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ Route::currentRouteName() == 'dashboard' ? 'bg-gradient-to-r from-[#d4af37]/20 via-[#d4af37]/10 to-transparent border-l-4 border-[#d4af37] text-[#111827] dark:text-white font-bold shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-gray-900 dark:hover:text-white' }}">
                        <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3 {{ Route::currentRouteName() == 'dashboard' ? 'text-[#c5a028]' : '' }}"></i>
                        <span>Dashboard Overview</span>
                    </a>
                </div>

                <!-- Investments Section -->
                <div class="space-y-1">
                    <span class="px-4 text-[10px] uppercase font-bold text-gray-400 dark:text-gray-500 tracking-widest block mb-2">Portfolio</span>
                    <a href="{{ route('dashboard.investments') }}" 
                       class="flex items-center px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ Route::currentRouteName() == 'dashboard.investments' ? 'bg-gradient-to-r from-[#d4af37]/20 via-[#d4af37]/10 to-transparent border-l-4 border-[#d4af37] text-[#111827] dark:text-white font-bold shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-gray-900 dark:hover:text-white' }}">
                        <i data-lucide="trending-up" class="w-5 h-5 mr-3 {{ Route::currentRouteName() == 'dashboard.investments' ? 'text-[#c5a028]' : '' }}"></i>
                        <span>My Investments</span>
                    </a>
                </div>

                <!-- Deposits Section -->
                <div class="space-y-1">
                    <span class="px-4 text-[10px] uppercase font-bold text-gray-400 dark:text-gray-500 tracking-widest block mb-2">Funding</span>
                    <a href="{{ route('dashboard.deposits.create') }}" 
                       class="flex items-center px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ Route::currentRouteName() == 'dashboard.deposits.create' ? 'bg-gradient-to-r from-[#d4af37]/20 via-[#d4af37]/10 to-transparent border-l-4 border-[#d4af37] text-[#111827] dark:text-white font-bold shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-gray-900 dark:hover:text-white' }}">
                        <i data-lucide="plus-circle" class="w-5 h-5 mr-3 {{ Route::currentRouteName() == 'dashboard.deposits.create' ? 'text-[#c5a028]' : '' }}"></i>
                        <span>Add Deposit</span>
                    </a>
                    <a href="{{ route('dashboard.deposits.history') }}" 
                       class="flex items-center px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ Route::currentRouteName() == 'dashboard.deposits.history' ? 'bg-gradient-to-r from-[#d4af37]/20 via-[#d4af37]/10 to-transparent border-l-4 border-[#d4af37] text-[#111827] dark:text-white font-bold shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-gray-900 dark:hover:text-white' }}">
                        <i data-lucide="clock" class="w-5 h-5 mr-3 {{ Route::currentRouteName() == 'dashboard.deposits.history' ? 'text-[#c5a028]' : '' }}"></i>
                        <span>Deposit History</span>
                    </a>
                </div>

                <!-- Withdrawals Section -->
                <div class="space-y-1">
                    <span class="px-4 text-[10px] uppercase font-bold text-gray-400 dark:text-gray-500 tracking-widest block mb-2">Withdraw</span>
                    <a href="{{ route('dashboard.withdrawals.create') }}" 
                       class="flex items-center px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ Route::currentRouteName() == 'dashboard.withdrawals.create' ? 'bg-gradient-to-r from-[#d4af37]/20 via-[#d4af37]/10 to-transparent border-l-4 border-[#d4af37] text-[#111827] dark:text-white font-bold shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-gray-900 dark:hover:text-white' }}">
                        <i data-lucide="download" class="w-5 h-5 mr-3 {{ Route::currentRouteName() == 'dashboard.withdrawals.create' ? 'text-[#c5a028]' : '' }}"></i>
                        <span>Request Payout</span>
                    </a>
                    <a href="{{ route('dashboard.withdrawals.history') }}" 
                       class="flex items-center px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ Route::currentRouteName() == 'dashboard.withdrawals.history' ? 'bg-gradient-to-r from-[#d4af37]/20 via-[#d4af37]/10 to-transparent border-l-4 border-[#d4af37] text-[#111827] dark:text-white font-bold shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-gray-900 dark:hover:text-white' }}">
                        <i data-lucide="file-text" class="w-5 h-5 mr-3 {{ Route::currentRouteName() == 'dashboard.withdrawals.history' ? 'text-[#c5a028]' : '' }}"></i>
                        <span>Payout History</span>
                    </a>
                </div>

                <!-- User Account Area -->
                <div class="space-y-1">
                    <span class="px-4 text-[10px] uppercase font-bold text-gray-400 dark:text-gray-500 tracking-widest block mb-2">Account</span>
                    <a href="{{ route('dashboard.referrals') }}" 
                       class="flex items-center px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ Route::currentRouteName() == 'dashboard.referrals' ? 'bg-gradient-to-r from-[#d4af37]/20 via-[#d4af37]/10 to-transparent border-l-4 border-[#d4af37] text-[#111827] dark:text-white font-bold shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-gray-900 dark:hover:text-white' }}">
                        <i data-lucide="users" class="w-5 h-5 mr-3 {{ Route::currentRouteName() == 'dashboard.referrals' ? 'text-[#c5a028]' : '' }}"></i>
                        <span>Referrals Program</span>
                    </a>
                    <a href="{{ route('dashboard.profile') }}" 
                       class="flex items-center px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ Route::currentRouteName() == 'dashboard.profile' ? 'bg-gradient-to-r from-[#d4af37]/20 via-[#d4af37]/10 to-transparent border-l-4 border-[#d4af37] text-[#111827] dark:text-white font-bold shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-gray-900 dark:hover:text-white' }}">
                        <i data-lucide="user" class="w-5 h-5 mr-3 {{ Route::currentRouteName() == 'dashboard.profile' ? 'text-[#c5a028]' : '' }}"></i>
                        <span>Profile Settings</span>
                    </a>
                </div>

                <!-- Back to Main Site -->
                <div class="pt-2 border-t border-gray-100 dark:border-white/5">
                    <a href="{{ route('home') }}" 
                       class="flex items-center px-4 py-2.5 rounded-xl text-xs font-semibold text-gray-500 dark:text-gray-400 hover:text-[#c5a028] transition duration-150">
                        <i data-lucide="external-link" class="w-4 h-4 mr-2"></i>
                        <span>Back to Public Website</span>
                    </a>
                </div>
            </nav>

            <!-- Bottom profile / theme section -->
            <div class="p-4 border-t border-gray-100 dark:border-white/10 flex flex-col space-y-4 bg-gray-50/60 dark:bg-white/[.02]">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#f5df91] to-[#c5a028] flex items-center justify-center text-[#111827] font-bold shadow-md shadow-[#d4af37]/20">
                            {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-semibold text-gray-800 dark:text-white truncate max-w-[120px]">{{ Auth::user()->name }}</span>
                            <span class="text-xs text-gray-500 truncate max-w-[120px]">{{ Auth::user()->email }}</span>
                        </div>
                    </div>
                    
                    <!-- Dark mode toggle button for desktop -->
                    <button id="theme-toggle" class="p-2 rounded-xl bg-gray-200/60 hover:bg-gray-200 dark:bg-white/10 dark:hover:bg-white/20 transition duration-200" title="Toggle theme">
                        <i data-lucide="sun" id="theme-toggle-dark-icon" class="hidden w-4 h-4 text-[#d4af37]"></i>
                        <i data-lucide="moon" id="theme-toggle-light-icon" class="hidden w-4 h-4 text-gray-400"></i>
                    </button>
                </div>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center justify-center px-4 py-2.5 bg-rose-50 hover:bg-rose-100 dark:bg-rose-950/20 dark:hover:bg-rose-950/40 text-rose-600 dark:text-rose-400 text-xs font-semibold rounded-xl transition duration-200">
                        <i data-lucide="log-out" class="w-4 h-4 mr-2"></i>
                        <span>Sign Out</span>
                    </button>
                </form>
            </div>
            
            <!-- Mobile Close button inside sidebar footer -->
            <div class="p-4 md:hidden border-t dark:border-white/10">
                <button id="close-sidebar" class="flex items-center justify-center px-4 py-2 bg-gray-100 dark:bg-white/10 text-sm font-semibold rounded-xl text-gray-700 dark:text-gray-300 w-full">
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
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">@yield('page-title', 'Overview')</h2>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Welcome back, {{ Auth::user()->name }}. Monitor your portfolio performance.</p>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard.deposits.create') }}" class="gold-button flex items-center px-4 py-2 rounded-xl text-xs font-bold">
                        <i data-lucide="plus" class="w-4 h-4 mr-1.5"></i>
                        <span>Deposit Capital</span>
                    </a>
                    <div class="flex items-center space-x-2 bg-white/80 dark:bg-navy-900/80 backdrop-blur-sm border border-gray-200/50 dark:border-white/10 px-4 py-2 rounded-xl text-xs font-semibold text-gray-600 dark:text-gray-300">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full animate-ping"></span>
                        <span>API System Live</span>
                    </div>
                </div>
            </header>

            <main class="flex-1 p-6 md:p-8 md:pt-2 overflow-y-auto">
                <!-- Notifications / Flash Messages -->
                @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-100/90 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 rounded-2xl flex items-center shadow-lg shadow-emerald-500/5">
                    <i data-lucide="check-circle" class="w-5 h-5 mr-3 text-emerald-600 flex-shrink-0"></i>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
                @endif
                
                @if(session('error'))
                <div class="mb-6 p-4 bg-red-100/90 dark:bg-red-950/40 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 rounded-2xl flex items-center shadow-lg shadow-red-500/5">
                    <i data-lucide="alert-triangle" class="w-5 h-5 mr-3 text-red-600 flex-shrink-0"></i>
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                </div>
                @endif

                @yield('content')
            </main>
        </div>

        <!-- Overlay for mobile sidebar -->
        <div id="sidebar-overlay" class="md:hidden fixed inset-0 bg-black/70 backdrop-blur-sm z-30 hidden"></div>
    </div>

    <!-- Scripts -->
    <script>
        // Initialize Lucide icons
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

        // Dark mode toggle functionality
        const setupThemeToggle = (toggleBtn, darkIcon, lightIcon) => {
            if (!toggleBtn || !darkIcon || !lightIcon) return;

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

        const themeToggleBtn = document.getElementById('theme-toggle');
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
        setupThemeToggle(themeToggleBtn, themeToggleDarkIcon, themeToggleLightIcon);

        const mobileThemeToggleBtn = document.getElementById('mobile-theme-toggle');
        const mobileThemeToggleDarkIcon = document.getElementById('mobile-theme-toggle-dark-icon');
        const mobileThemeToggleLightIcon = document.getElementById('mobile-theme-toggle-light-icon');
        setupThemeToggle(mobileThemeToggleBtn, mobileThemeToggleDarkIcon, mobileThemeToggleLightIcon);

        // Sidebar drawer for mobile
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const closeSidebar = document.getElementById('close-sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');

        function toggleSidebar() {
            if (sidebar && sidebarOverlay) {
                sidebar.classList.toggle('hidden');
                sidebarOverlay.classList.toggle('hidden');
            }
        }

        if (sidebarToggle) sidebarToggle.addEventListener('click', toggleSidebar);
        if (closeSidebar) closeSidebar.addEventListener('click', toggleSidebar);
        if (sidebarOverlay) sidebarOverlay.addEventListener('click', toggleSidebar);
    </script>
    @yield('scripts')
    @stack('scripts')
</body>
</html>
