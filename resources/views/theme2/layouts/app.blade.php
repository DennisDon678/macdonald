<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }} - Premium Investment Platform</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        navy: {
                            800: '#1a2235',
                            900: '#0f172a',
                        },
                        gold: {
                            400: '#d4af37',
                            500: '#c5a028',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* Smooth scrolling and base resets */
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; background-color: #0f172a; color: #f8fafc; overflow-x: hidden; }
        
        /* Subtle micro-animations for premium feel */
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px -5px rgba(212, 175, 55, 0.15);
        }
        
        /* Premium Gradient Text */
        .text-gradient-gold {
            background: linear-gradient(135deg, #fcd34d 0%, #d4af37 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="antialiased flex flex-col min-h-screen">
    
    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-navy-900/90 backdrop-blur-md border-b border-white/10 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold tracking-tighter text-white">
                        {{ env('APP_NAME') }}<span class="text-gold-400">.</span>
                    </a>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition-colors text-sm font-medium">Home</a>
                    <a href="{{ route('about') }}" class="text-gray-300 hover:text-white transition-colors text-sm font-medium">About Us</a>
                    <a href="{{ route('faq') }}" class="text-gray-300 hover:text-white transition-colors text-sm font-medium">FAQ</a>
                    <a href="{{ route('support') }}" class="text-gray-300 hover:text-white transition-colors text-sm font-medium">Contact</a>
                </div>

                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-gray-300 hover:text-white transition-colors text-sm font-medium">Log In</a>
                    <a href="{{ route('register') }}" class="bg-gold-400 hover:bg-gold-500 text-navy-900 px-6 py-2.5 rounded-full text-sm font-semibold transition-all shadow-lg shadow-gold-400/20">Get Started</a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-btn" class="text-gray-300 hover:text-white focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu (Hidden by default) -->
        <div id="mobile-menu" class="hidden md:hidden bg-navy-800 border-t border-white/10">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-white/5">Home</a>
                <a href="{{ route('about') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-white/5">About Us</a>
                <a href="{{ route('faq') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-white/5">FAQ</a>
                <a href="{{ route('support') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-white/5">Contact</a>
                <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-white/5">Log In</a>
                <a href="{{ route('register') }}" class="block px-3 py-2 mt-4 text-center rounded-md text-base font-medium bg-gold-400 text-navy-900">Get Started</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-navy-900 border-t border-white/10 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <div class="col-span-1 md:col-span-2">
                    <a href="{{ route('home') }}" class="text-2xl font-bold tracking-tighter text-white mb-4 block">
                        {{ env('APP_NAME') }}<span class="text-gold-400">.</span>
                    </a>
                    <p class="text-gray-400 text-sm leading-relaxed max-w-sm">
                        Elevate your financial future with our premium investment strategies. We offer secure, transparent, and intelligent pathways to building wealth.
                    </p>
                </div>
                
                <div>
                    <h4 class="text-white font-semibold mb-4">Company</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-gold-400 text-sm transition-colors">About Us</a></li>
                        <li><a href="{{ route('support') }}" class="text-gray-400 hover:text-gold-400 text-sm transition-colors">Contact</a></li>
                        <li><a href="{{ route('faq') }}" class="text-gray-400 hover:text-gold-400 text-sm transition-colors">FAQ</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-white font-semibold mb-4">Legal</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('privacy') }}" class="text-gray-400 hover:text-gold-400 text-sm transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-gold-400 text-sm transition-colors">Terms of Service</a></li>
                        <li><a href="/cert.pdf" class="text-gray-400 hover:text-gold-400 text-sm transition-colors">Legal Documents</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-white/10 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-500 text-sm">
                    &copy; {{ date('Y') }} {{ env('APP_NAME') }} Limited. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 50,
        });

        // Mobile menu toggle
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            var menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            var nav = document.getElementById('navbar');
            if (window.scrollY > 20) {
                nav.classList.add('shadow-lg', 'shadow-black/20');
            } else {
                nav.classList.remove('shadow-lg', 'shadow-black/20');
            }
        });
    </script>
</body>
</html>
