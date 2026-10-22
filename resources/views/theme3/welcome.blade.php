@extends('theme3.layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="hero min-h-[680px] pt-28 pb-16 text-white lg:pt-36 lg:pb-24">
        <div class="container-main">
            <div class="grid items-center gap-14 lg:grid-cols-[1.02fr_.98fr]">

                <div data-aos="fade-up">
                    <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-[#d4af37]/30 bg-[#d4af37]/10 px-4 py-2 text-xs font-medium text-[#f4d77a]">
                        <span class="h-2 w-2 rounded-full bg-[#d4af37]"></span>
                        A smarter approach to investing
                    </div>

                    <h1 class="max-w-2xl text-4xl font-semibold leading-[1.12] tracking-tight sm:text-5xl lg:text-[60px]">
                        Build your future with
                        <span class="text-gradient">smarter investments.</span>
                    </h1>

                    <p class="mt-6 max-w-xl text-base leading-8 text-gray-300 sm:text-lg">
                        Take a more intentional approach to your financial goals.
                        Discover investment opportunities, monitor your progress,
                        and manage your portfolio from one place.
                    </p>

                    <div class="mt-9 flex flex-col gap-3 sm:flex-row">
                        <a href="{{ route('register') }}"
                           class="gold-button inline-flex items-center justify-center gap-3 rounded-xl px-7 py-4 text-sm font-bold">
                            Start Your Journey
                            <span aria-hidden="true">↗</span>
                        </a>

                        <a href="#how-it-works"
                           class="outline-button inline-flex items-center justify-center gap-3 rounded-xl px-7 py-4 text-sm font-medium text-white">
                            Discover How It Works
                            <span aria-hidden="true">↓</span>
                        </a>
                    </div>

                    <div class="mt-9 flex flex-wrap items-center gap-x-6 gap-y-3 text-xs text-gray-400">
                        <span class="flex items-center gap-2">
                            <svg class="text-[#d4af37]" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/>
                                <path d="m9 12 2 2 4-4"/>
                            </svg>
                            Account security
                        </span>

                        <span class="flex items-center gap-2">
                            <svg class="text-[#d4af37]" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M12 6v6l4 2"/>
                            </svg>
                            Convenient access
                        </span>
                    </div>
                </div>

                <!-- Hero Image -->
                <div class="relative" data-aos="fade-left" data-aos-delay="150">
                    <div class="absolute -inset-5 rounded-[30px] bg-[#d4af37]/10 blur-3xl"></div>

                    <div class="hero-image-card">
                        <img
                            src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1200&q=85"
                            alt="Modern commercial buildings representing business and investment"
                            fetchpriority="high"
                        >

                        <div class="image-overlay"></div>

                        <div class="absolute inset-x-0 bottom-0 p-6 sm:p-8">
                            <div class="mb-4 flex items-center justify-between gap-4">
                                <div>
                                    <p class="text-xs text-gray-300">Your financial journey</p>
                                    <h2 class="mt-1 text-xl font-semibold sm:text-2xl">Start with a plan.</h2>
                                </div>

                                <div class="flex h-12 w-12 items-center justify-center rounded-2xl border border-white/20 bg-white/10 text-[#f4d77a] backdrop-blur">
                                    <svg width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                        <path d="M3 17 9 11l4 4 8-9"/>
                                        <path d="M15 6h6v6"/>
                                    </svg>
                                </div>
                            </div>

                            <div class="glass-card rounded-xl p-4">
                                <div class="flex items-center justify-between gap-4">
                                    <div>
                                        <p class="text-xs text-gray-300">Investment overview</p>
                                        <p class="mt-1 text-sm font-medium text-white">Monitor your progress</p>
                                    </div>
                                    <span class="rounded-full bg-emerald-400/15 px-3 py-1.5 text-xs font-medium text-emerald-300">
                                        Stay informed
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="glass-card absolute -bottom-6 -left-3 hidden rounded-2xl p-4 shadow-xl sm:block lg:-left-8">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#d4af37]/15 text-[#f4d77a]">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                    <path d="M12 3v18M17 8H9.5a3.5 3.5 0 0 0 0 7H14a3.5 3.5 0 0 1 0 7H6"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-300">Your goals, your plan</p>
                                <p class="mt-1 text-sm font-semibold text-white">Plan with confidence</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="relative z-10 -mt-1 bg-white py-10 sm:py-14">
        <div class="container-main">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                <div class="stat-card rounded-2xl p-6 sm:p-7" data-aos="fade-up">
                    <div class="flex items-center gap-4">
                        <div class="icon-box">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M3 3v18h18"/>
                                <path d="m19 9-5 5-4-4-4 4"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Investment planning</p>
                            <p class="mt-1 text-lg font-semibold text-[#172033]">Clearer financial goals</p>
                        </div>
                    </div>
                </div>

                <div class="stat-card rounded-2xl p-6 sm:p-7" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center gap-4">
                        <div class="icon-box">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                <rect x="3" y="5" width="18" height="14" rx="2"/>
                                <path d="M3 10h18M7 15h3"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Portfolio management</p>
                            <p class="mt-1 text-lg font-semibold text-[#172033]">One convenient place</p>
                        </div>
                    </div>
                </div>

                <div class="stat-card rounded-2xl p-6 sm:p-7" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-center gap-4">
                        <div class="icon-box">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/>
                                <path d="m9 12 2 2 4-4"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Account experience</p>
                            <p class="mt-1 text-lg font-semibold text-[#172033]">Built around your needs</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="bg-[#f7f8fb] py-20 sm:py-28">
        <div class="container-main">

            <div class="mx-auto max-w-2xl text-center" data-aos="fade-up">
                <span class="section-label">Simple process</span>

                <h2 class="mt-5 text-3xl font-semibold tracking-tight text-[#172033] sm:text-4xl lg:text-5xl">
                    Investing made easier
                </h2>

                <p class="mt-5 text-base leading-7 text-gray-500">
                    Getting started doesn't need to be complicated.
                    Follow a straightforward process to begin managing your financial goals.
                </p>
            </div>

            <div class="mt-14 grid gap-6 md:grid-cols-3">

                <article class="feature-card rounded-2xl p-7 sm:p-8" data-aos="fade-up">
                    <div class="flex items-center justify-between">
                        <div class="step-number">01</div>
                        <span class="text-sm font-medium text-gray-300">Step one</span>
                    </div>

                    <div class="mt-7">
                        <img
                            src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=700&q=80"
                            alt="Person using a laptop to get started online"
                            class="h-40 w-full rounded-xl object-cover"
                            loading="lazy"
                        >
                    </div>

                    <h3 class="mt-6 text-xl font-semibold text-[#172033]">Create your account</h3>

                    <p class="mt-3 text-sm leading-7 text-gray-500">
                        Register for an account and complete the required setup to access your dashboard.
                    </p>

                    <a href="{{ route('register') }}"
                       class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-[#947312] hover:text-[#c5a028]">
                        Get started <span aria-hidden="true">→</span>
                    </a>
                </article>

                <article class="feature-card rounded-2xl p-7 sm:p-8" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center justify-between">
                        <div class="step-number">02</div>
                        <span class="text-sm font-medium text-gray-300">Step two</span>
                    </div>

                    <div class="mt-7">
                        <img
                            src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=700&q=80"
                            alt="Financial charts and analytics displayed on a computer"
                            class="h-40 w-full rounded-xl object-cover"
                            loading="lazy"
                        >
                    </div>

                    <h3 class="mt-6 text-xl font-semibold text-[#172033]">Explore your options</h3>

                    <p class="mt-3 text-sm leading-7 text-gray-500">
                        Review the available investment options and understand their terms before making a decision.
                    </p>

                    <a href="{{ route('about') }}"
                       class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-[#947312] hover:text-[#c5a028]">
                        Learn about us <span aria-hidden="true">→</span>
                    </a>
                </article>

                <article class="feature-card rounded-2xl p-7 sm:p-8" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-center justify-between">
                        <div class="step-number">03</div>
                        <span class="text-sm font-medium text-gray-300">Step three</span>
                    </div>

                    <div class="mt-7">
                        <img
                            src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&w=700&q=80"
                            alt="Financial documents and calculator on a desk"
                            class="h-40 w-full rounded-xl object-cover"
                            loading="lazy"
                        >
                    </div>

                    <h3 class="mt-6 text-xl font-semibold text-[#172033]">Manage your progress</h3>

                    <p class="mt-3 text-sm leading-7 text-gray-500">
                        Use your account to review your investment activity and keep track of your financial plans.
                    </p>

                    <a href="{{ route('login') }}"
                       class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-[#947312] hover:text-[#c5a028]">
                        Access your account <span aria-hidden="true">→</span>
                    </a>
                </article>

            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="overflow-hidden bg-white py-20 sm:py-28">
        <div class="container-main">
            <div class="grid items-center gap-12 lg:grid-cols-2 lg:gap-16">

                <div class="relative" data-aos="fade-right">
                    <div class="absolute -left-5 -top-5 h-32 w-32 rounded-full bg-[#d4af37]/10 blur-2xl"></div>

                    <div class="relative overflow-hidden rounded-3xl">
                        <img
                            src="https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=1200&q=85"
                            alt="Bright, modern professional workspace"
                            class="why-image"
                            loading="lazy"
                        >
                    </div>

                    <div class="absolute bottom-5 left-5 right-5 rounded-2xl border border-white/30 bg-white/95 p-5 shadow-xl backdrop-blur sm:bottom-7 sm:left-7 sm:right-auto sm:min-w-[260px]">
                        <div class="flex items-center gap-3">
                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#fbf6e7] text-[#947312]">
                                <svg width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                    <path d="M12 3v18M17 8H9.5a3.5 3.5 0 0 0 0 7H14a3.5 3.5 0 0 1 0 7H6"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Your financial future</p>
                                <p class="mt-1 font-semibold text-[#172033]">Make informed decisions</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div data-aos="fade-left">
                    <span class="section-label">Why {{ env('APP_NAME', 'Laravel') }}</span>

                    <h2 class="mt-5 text-3xl font-semibold leading-tight tracking-tight text-[#172033] sm:text-4xl lg:text-[44px]">
                        A more organised way to manage your investments
                    </h2>

                    <p class="mt-5 leading-8 text-gray-500">
                        Your financial goals deserve careful planning. {{ env('APP_NAME', 'Laravel') }} brings your investment experience
                        together in one place, helping you review your options and manage your account more conveniently.
                    </p>

                    <div class="mt-8 space-y-6">

                        <div class="flex gap-4">
                            <div class="icon-box">
                                <svg width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                    <rect x="3" y="5" width="18" height="14" rx="2"/>
                                    <path d="M3 10h18M7 15h3"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-[#172033]">Convenient account management</h3>
                                <p class="mt-2 text-sm leading-6 text-gray-500">
                                    Access your account and review your investment activity in one place.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="icon-box">
                                <svg width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                    <path d="M12 3v18M17 8H9.5a3.5 3.5 0 0 0 0 7H14a3.5 3.5 0 0 1 0 7H6"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-[#172033]">Investment information</h3>
                                <p class="mt-2 text-sm leading-6 text-gray-500">
                                    Review available options and their terms before deciding where your money goes.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="icon-box">
                                <svg width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                    <path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/>
                                    <path d="m9 12 2 2 4-4"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-[#172033]">Account-focused experience</h3>
                                <p class="mt-2 text-sm leading-6 text-gray-500">
                                    Navigate a clear interface designed to make your investment activity easier to follow.
                                </p>
                            </div>
                        </div>

                    </div>

                    <a href="{{ route('about') }}"
                       class="mt-9 inline-flex items-center gap-3 rounded-xl bg-[#0b1220] px-6 py-4 text-sm font-semibold text-white transition hover:bg-[#1a2235]">
                        Discover {{ env('APP_NAME', 'Laravel') }}
                        <span aria-hidden="true">→</span>
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section py-20 text-white sm:py-24">
        <div class="container-main">
            <div class="mx-auto max-w-3xl text-center" data-aos="fade-up">

                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl border border-[#d4af37]/30 bg-[#d4af37]/10 text-[#f4d77a]">
                    <svg width="27" height="27" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M3 17 9 11l4 4 8-9"/>
                        <path d="M15 6h6v6"/>
                    </svg>
                </div>

                <h2 class="mt-7 text-3xl font-semibold leading-tight tracking-tight sm:text-4xl lg:text-5xl">
                    Your next financial chapter
                    <span class="text-gradient">starts here.</span>
                </h2>

                <p class="mx-auto mt-5 max-w-xl text-base leading-8 text-gray-300">
                    Take the first step toward a more organised financial future.
                    Create your account and explore the options available to you.
                </p>

                <div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row">
                    <a href="{{ route('register') }}"
                       class="gold-button inline-flex items-center justify-center gap-3 rounded-xl px-7 py-4 text-sm font-bold">
                        Create Your Account
                        <span aria-hidden="true">↗</span>
                    </a>

                    <a href="{{ route('support') }}"
                       class="outline-button inline-flex items-center justify-center rounded-xl px-7 py-4 text-sm font-medium text-white">
                        Contact Support
                    </a>
                </div>

                <p class="mt-5 text-xs leading-6 text-gray-400">
                    Please review the terms and risks associated with any investment before committing funds.
                </p>
            </div>
        </div>
    </section>
@endsection
