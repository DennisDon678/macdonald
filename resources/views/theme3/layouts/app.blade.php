<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0b1220">

    <title>{{ env('APP_NAME', 'Laravel') }} — Premium Investment Platform</title>
    <meta name="description" content="Build your financial future with {{ env('APP_NAME', 'Laravel') }}. Explore investment opportunities and take control of your financial goals.">

    <!-- Existing font imports -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Existing AOS animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Existing Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Existing Tailwind configuration -->
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
        :root {
            --navy: #0b1220;
            --navy-light: #111c30;
            --gold: #d4af37;
            --gold-light: #f4d77a;
            --muted: #9ca9bd;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 90px;
        }

        body {
            margin: 0;
            background: #ffffff;
            color: #172033;
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        a {
            text-decoration: none;
        }

        button,
        a {
            -webkit-tap-highlight-color: transparent;
        }

        .container-main {
            width: min(1160px, calc(100% - 40px));
            margin-inline: auto;
        }

        .text-gradient {
            background: linear-gradient(110deg, #f5d979, #d4af37 55%, #f8e7a4);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .gold-button {
            background: linear-gradient(135deg, #f1d575, #d4af37);
            color: #111827;
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .gold-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(212, 175, 55, .2);
        }

        .outline-button {
            border: 1px solid rgba(255, 255, 255, .24);
            transition: background .25s ease, border-color .25s ease;
        }

        .outline-button:hover {
            background: rgba(255, 255, 255, .08);
            border-color: rgba(255, 255, 255, .5);
        }

        .navbar {
            transition: background .3s ease, box-shadow .3s ease;
        }

        .navbar.scrolled {
            background: rgba(11, 18, 32, .96);
            box-shadow: 0 10px 35px rgba(0, 0, 0, .15);
            backdrop-filter: blur(16px);
        }

        .hero {
            position: relative;
            isolation: isolate;
            overflow: hidden;
            background: var(--navy);
        }

        .hero::before {
            position: absolute;
            content: "";
            inset: 0;
            z-index: -2;
            background:
                linear-gradient(
                    90deg,
                    rgba(7, 14, 27, .98) 0%,
                    rgba(7, 14, 27, .91) 42%,
                    rgba(7, 14, 27, .45) 100%
                ),
                url("https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=2200&q=85")
                center / cover no-repeat;
        }

        .hero::after {
            position: absolute;
            content: "";
            width: 480px;
            height: 480px;
            top: -240px;
            right: -100px;
            z-index: -1;
            border-radius: 50%;
            background: rgba(212, 175, 55, .10);
            filter: blur(90px);
        }

        .hero-image-card {
            position: relative;
            border: 1px solid rgba(255, 255, 255, .17);
            border-radius: 22px;
            overflow: hidden;
            background: rgba(255, 255, 255, .06);
            box-shadow: 0 35px 90px rgba(0, 0, 0, .35);
        }

        .hero-image-card img {
            width: 100%;
            height: 390px;
            display: block;
            object-fit: cover;
        }

        .image-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to top,
                rgba(5, 12, 25, .9),
                transparent 65%
            );
        }

        .glass-card {
            background: rgba(255, 255, 255, .08);
            border: 1px solid rgba(255, 255, 255, .13);
            backdrop-filter: blur(15px);
        }

        .stat-card {
            background: #fff;
            border: 1px solid #e8edf4;
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 18px 40px rgba(15, 23, 42, .07);
        }

        .feature-card {
            background: #fff;
            border: 1px solid #e8edf4;
            transition: transform .3s ease, box-shadow .3s ease, border-color .3s ease;
        }

        .feature-card:hover {
            transform: translateY(-6px);
            border-color: #e7d38d;
            box-shadow: 0 22px 50px rgba(15, 23, 42, .07);
        }

        .icon-box {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 52px;
            height: 52px;
            border-radius: 15px;
            background: #fbf6e7;
            color: #9d7a13;
            flex-shrink: 0;
        }

        .step-number {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            border-radius: 15px;
            color: #111827;
            font-weight: 700;
            background: linear-gradient(135deg, #f3df95, #d4af37);
            box-shadow: 0 8px 20px rgba(212, 175, 55, .15);
        }

        .section-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #947312;
            background: #fbf6e7;
            border: 1px solid #f0e5bf;
            border-radius: 100px;
            padding: 7px 12px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .section-label::before {
            content: "";
            width: 6px;
            height: 6px;
            background: var(--gold);
            border-radius: 50%;
        }

        .why-image {
            width: 100%;
            height: 100%;
            min-height: 440px;
            object-fit: cover;
        }

        .cta-section {
            position: relative;
            isolation: isolate;
            overflow: hidden;
            background: #0b1220;
        }

        .cta-section::before {
            position: absolute;
            content: "";
            inset: 0;
            z-index: -1;
            background:
                linear-gradient(90deg, rgba(11, 18, 32, .98), rgba(11, 18, 32, .84)),
                url("https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1800&q=80")
                center / cover no-repeat;
        }

        .footer-link {
            color: #a9b3c5;
            transition: color .2s ease;
        }

        .footer-link:hover {
            color: var(--gold-light);
        }

        .mobile-menu {
            border-top: 1px solid rgba(255, 255, 255, .1);
        }

        .mobile-menu a {
            display: block;
            padding: 12px 0;
        }

        @media (max-width: 768px) {
            .container-main {
                width: min(100% - 32px, 600px);
            }

            .hero::before {
                background:
                    linear-gradient(
                        90deg,
                        rgba(7, 14, 27, .96),
                        rgba(7, 14, 27, .82)
                    ),
                    url("https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1000&q=80")
                    center / cover no-repeat;
            }

            .hero-image-card img {
                height: 300px;
            }

            .why-image {
                min-height: 300px;
                max-height: 400px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: .01ms !important;
            }
        }
    </style>
    @stack('styles')
</head>

<body>

    <!-- Navigation -->
    <nav id="navbar" class="navbar fixed top-0 left-0 right-0 z-50 bg-[#0b1220]/90">
        <div class="container-main">
            <div class="flex h-[76px] items-center justify-between">

                <a href="{{ route('home') }}" class="flex items-center gap-3" aria-label="{{ env('APP_NAME', 'Laravel') }} home">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-[#f5df91] to-[#c5a028] text-lg font-bold text-[#111827]">
                        {{ strtoupper(substr(env('APP_NAME', 'L'), 0, 1)) }}
                    </div>
                    <div>
                        <span class="block text-lg font-bold tracking-tight text-white">{{ env('APP_NAME', 'Laravel') }}</span>
                        <span class="block text-[9px] font-medium uppercase tracking-[.22em] text-gray-400">Investment platform</span>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden items-center gap-8 md:flex">
                    <a href="{{ route('home') }}" class="text-sm text-gray-300 transition hover:text-white">Home</a>
                    <a href="{{ route('about') }}" class="text-sm text-gray-300 transition hover:text-white">About Us</a>
                    <a href="{{ route('home') }}#how-it-works" class="text-sm text-gray-300 transition hover:text-white">How It Works</a>
                    <a href="{{ route('faq') }}" class="text-sm text-gray-300 transition hover:text-white">FAQs</a>
                    <a href="{{ route('support') }}" class="text-sm text-gray-300 transition hover:text-white">Support</a>
                </div>

                <div class="hidden items-center gap-3 md:flex">
                    <a href="{{ route('login') }}"
                       class="rounded-lg px-4 py-2.5 text-sm font-medium text-white transition hover:bg-white/10">
                        Log In
                    </a>
                    <a href="{{ route('register') }}"
                       class="gold-button rounded-lg px-5 py-2.5 text-sm font-semibold">
                        Get Started <span aria-hidden="true">↗</span>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn"
                        class="flex h-10 w-10 items-center justify-center rounded-lg border border-white/15 text-white md:hidden"
                        aria-label="Toggle navigation menu"
                        aria-expanded="false"
                        aria-controls="mobile-menu">
                    <svg id="menu-open-icon" xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                         stroke-linecap="round">
                        <path d="M4 7h16M4 12h16M4 17h16"/>
                    </svg>
                    <svg id="menu-close-icon" class="hidden" xmlns="http://www.w3.org/2000/svg"
                         width="22" height="22" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                        <path d="m18 6-12 12M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="mobile-menu hidden pb-5 text-sm text-gray-300 md:hidden">
                <a href="{{ route('home') }}" class="hover:text-white">Home</a>
                <a href="{{ route('about') }}" class="hover:text-white">About Us</a>
                <a href="{{ route('home') }}#how-it-works" class="hover:text-white">How It Works</a>
                <a href="{{ route('faq') }}" class="hover:text-white">FAQs</a>
                <a href="{{ route('support') }}" class="hover:text-white">Contact Support</a>

                <div class="mt-4 flex gap-3">
                    <a href="{{ route('login') }}"
                       class="flex-1 rounded-lg border border-white/20 py-3 text-center text-white">
                        Log In
                    </a>
                    <a href="{{ route('register') }}"
                       class="gold-button flex-1 rounded-lg py-3 text-center font-semibold">
                        Get Started
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#080e19] text-white">
        <div class="container-main py-14 sm:py-16">

            <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-4">

                <div class="lg:col-span-1">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-[#f5df91] to-[#c5a028] text-lg font-bold text-[#111827]">
                            {{ strtoupper(substr(env('APP_NAME', 'L'), 0, 1)) }}
                        </div>
                        <div>
                            <span class="block text-lg font-bold">{{ env('APP_NAME', 'Laravel') }}</span>
                            <span class="block text-[9px] uppercase tracking-[.22em] text-gray-400">Investment platform</span>
                        </div>
                    </a>

                    <p class="mt-5 max-w-xs text-sm leading-7 text-gray-400">
                        A convenient platform for exploring investment opportunities and managing your financial journey.
                    </p>
                </div>

                <div>
                    <h3 class="text-sm font-semibold">Explore</h3>
                    <ul class="mt-5 space-y-3 text-sm">
                        <li><a class="footer-link" href="{{ route('home') }}">Home</a></li>
                        <li><a class="footer-link" href="{{ route('about') }}">About Us</a></li>
                        <li><a class="footer-link" href="{{ route('home') }}#how-it-works">How It Works</a></li>
                        <li><a class="footer-link" href="{{ route('faq') }}">Frequently Asked Questions</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-sm font-semibold">Your Account</h3>
                    <ul class="mt-5 space-y-3 text-sm">
                        <li><a class="footer-link" href="{{ route('login') }}">Log In</a></li>
                        <li><a class="footer-link" href="{{ route('register') }}">Create Account</a></li>
                        <li><a class="footer-link" href="{{ route('support') }}">Contact Support</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-sm font-semibold">Legal & Information</h3>
                    <ul class="mt-5 space-y-3 text-sm">
                        <li><a class="footer-link" href="{{ route('privacy') }}">Privacy Policy</a></li>
                        <li><a class="footer-link" href="{{ asset('cert.pdf') }}" target="_blank" rel="noopener noreferrer">Certificate</a></li>
                    </ul>

                    <div class="mt-6 rounded-xl border border-white/10 bg-white/[.03] p-4">
                        <p class="text-xs leading-6 text-gray-400">
                            Investments involve risk. Review the applicable terms and conditions before investing.
                        </p>
                    </div>
                </div>

            </div>

            <div class="mt-12 flex flex-col gap-4 border-t border-white/10 pt-7 text-center sm:flex-row sm:items-center sm:justify-between sm:text-left">
                <p class="text-xs text-gray-500">
                    &copy; {{ date('Y') }} {{ env('APP_NAME', 'Laravel') }} Limited. All rights reserved.
                </p>

                <p class="text-xs text-gray-500">
                    Invest thoughtfully. Plan for the future.
                </p>
            </div>

        </div>
    </footer>

    <!-- Existing AOS animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        // Initialize AOS animations
        AOS.init({
            duration: 800,
            once: true,
            offset: 50,
            disable: window.matchMedia('(prefers-reduced-motion: reduce)').matches
        });

        // Mobile menu toggle
        const menuButton = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const openIcon = document.getElementById('menu-open-icon');
        const closeIcon = document.getElementById('menu-close-icon');

        if (menuButton && mobileMenu) {
            menuButton.addEventListener('click', function () {
                const isOpening = mobileMenu.classList.contains('hidden');

                mobileMenu.classList.toggle('hidden');
                if (openIcon) openIcon.classList.toggle('hidden');
                if (closeIcon) closeIcon.classList.toggle('hidden');

                menuButton.setAttribute('aria-expanded', String(isOpening));
            });

            // Close mobile menu after selecting a link
            mobileMenu.querySelectorAll('a').forEach(function (link) {
                link.addEventListener('click', function () {
                    mobileMenu.classList.add('hidden');
                    if (openIcon) openIcon.classList.remove('hidden');
                    if (closeIcon) closeIcon.classList.add('hidden');
                    menuButton.setAttribute('aria-expanded', 'false');
                });
            });
        }

        // Navbar scroll effect
        const navbar = document.getElementById('navbar');

        function updateNavbar() {
            if (navbar) {
                navbar.classList.toggle('scrolled', window.scrollY > 20);
            }
        }

        window.addEventListener('scroll', updateNavbar, { passive: true });
        updateNavbar();

        // Close the mobile menu when returning to desktop width
        window.addEventListener('resize', function () {
            if (window.innerWidth >= 768 && mobileMenu && openIcon && closeIcon && menuButton) {
                mobileMenu.classList.add('hidden');
                openIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
                menuButton.setAttribute('aria-expanded', 'false');
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
