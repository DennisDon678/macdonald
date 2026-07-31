@extends('theme2.layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="relative min-h-[90vh] flex items-center justify-center overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/theme2/hero.png') }}" alt="Premium Investment" class="w-full h-full object-cover opacity-60">
            <div class="absolute inset-0 bg-gradient-to-b from-navy-900/50 via-navy-900/80 to-navy-900"></div>
        </div>

        <div class="relative z-10 text-center px-4 max-w-5xl mx-auto pt-20">
            <span class="text-gold-400 font-semibold tracking-wider uppercase text-sm mb-4 block" data-aos="fade-down">Welcome to {{ env('APP_NAME') }} Limited</span>
            <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 tracking-tight leading-tight" data-aos="fade-up" data-aos-delay="100">
                Secure Your <br/>
                <span class="text-gradient-gold">Financial Legacy</span>
            </h1>
            <p class="text-xl text-gray-300 mb-10 max-w-2xl mx-auto font-light leading-relaxed" data-aos="fade-up" data-aos-delay="300">
                Experience unparalleled growth with our modern, globally diversified investment portfolios curated by expert traders.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center" data-aos="fade-up" data-aos-delay="500">
                <a href="{{ route('register') }}" class="bg-gold-400 hover:bg-gold-500 text-navy-900 px-8 py-4 rounded-full text-lg font-semibold transition-all hover-lift shadow-lg shadow-gold-400/20">
                    Open an Account
                </a>
                <a href="{{ route('about') }}" class="bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/20 text-white px-8 py-4 rounded-full text-lg font-medium transition-all hover-lift">
                    Discover More
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <section class="py-12 bg-navy-900 border-b border-white/5 relative z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-x divide-white/10">
                <div class="px-4" data-aos="fade-up" data-aos-delay="0">
                    <p class="text-3xl md:text-4xl font-bold text-white mb-2">49K+</p>
                    <p class="text-gray-400 text-sm uppercase tracking-wider">Active Investors</p>
                </div>
                <div class="px-4" data-aos="fade-up" data-aos-delay="100">
                    <p class="text-3xl md:text-4xl font-bold text-white mb-2">$5B+</p>
                    <p class="text-gray-400 text-sm uppercase tracking-wider">Assets Under Mgmt</p>
                </div>
                <div class="px-4" data-aos="fade-up" data-aos-delay="200">
                    <p class="text-3xl md:text-4xl font-bold text-white mb-2">7.2M+</p>
                    <p class="text-gray-400 text-sm uppercase tracking-wider">Transactions</p>
                </div>
                <div class="px-4" data-aos="fade-up" data-aos-delay="300">
                    <p class="text-3xl md:text-4xl font-bold text-white mb-2">32+</p>
                    <p class="text-gray-400 text-sm uppercase tracking-wider">Global Partners</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-24 bg-navy-900 relative">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-gold-400 font-semibold tracking-wider uppercase text-sm mb-2 block">The Process</span>
                <h2 class="text-3xl md:text-5xl font-bold text-white">How We Build Wealth</h2>
                <div class="w-24 h-1 bg-gold-400 mx-auto mt-6 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative">
                <!-- Connecting Line for Desktop -->
                <div class="hidden md:block absolute top-1/2 left-0 w-full h-0.5 bg-gradient-to-r from-transparent via-gold-400/30 to-transparent -translate-y-1/2 z-0" data-aos="fade-in" data-aos-delay="300"></div>

                <!-- Step 1 -->
                <div class="relative z-10 bg-navy-800 rounded-2xl p-8 border border-white/5 hover:border-gold-400/30 transition-all hover-lift text-center group" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-20 h-20 mx-auto bg-navy-900 rounded-full border-2 border-gold-400/50 flex items-center justify-center mb-6 group-hover:bg-gold-400 group-hover:text-navy-900 transition-colors shadow-[0_0_15px_rgba(212,175,55,0.2)]">
                        <span class="text-2xl font-bold text-gold-400 group-hover:text-navy-900 transition-colors">1</span>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Create Account</h3>
                    <p class="text-gray-400 leading-relaxed">
                        Sign up in minutes. Our onboarding process is fast, secure, and fully compliant with global financial regulations to protect your identity.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="relative z-10 bg-navy-800 rounded-2xl p-8 border border-white/5 hover:border-gold-400/30 transition-all hover-lift text-center group" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-20 h-20 mx-auto bg-navy-900 rounded-full border-2 border-gold-400/50 flex items-center justify-center mb-6 group-hover:bg-gold-400 group-hover:text-navy-900 transition-colors shadow-[0_0_15px_rgba(212,175,55,0.2)]">
                        <span class="text-2xl font-bold text-gold-400 group-hover:text-navy-900 transition-colors">2</span>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Fund Portfolio</h3>
                    <p class="text-gray-400 leading-relaxed">
                        Deposit capital seamlessly using our diverse payment gateways. Your funds are instantly credited and ready for immediate deployment.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="relative z-10 bg-navy-800 rounded-2xl p-8 border border-white/5 hover:border-gold-400/30 transition-all hover-lift text-center group" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-20 h-20 mx-auto bg-navy-900 rounded-full border-2 border-gold-400/50 flex items-center justify-center mb-6 group-hover:bg-gold-400 group-hover:text-navy-900 transition-colors shadow-[0_0_15px_rgba(212,175,55,0.2)]">
                        <span class="text-2xl font-bold text-gold-400 group-hover:text-navy-900 transition-colors">3</span>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Generate Yield</h3>
                    <p class="text-gray-400 leading-relaxed">
                        Our expert trading algorithms and quantitative strategies go to work, securing daily yields that you can withdraw at any time.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-24 bg-navy-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-16 items-center">
                <div class="md:w-1/2" data-aos="fade-right">
                    <span class="text-gold-400 font-semibold tracking-wider uppercase text-sm mb-2 block">Our Expertise</span>
                    <h2 class="text-3xl md:text-5xl font-bold text-white mb-6 leading-tight">We set the standard in modern finance.</h2>
                    <p class="text-gray-400 text-lg mb-8 leading-relaxed">
                        We are everything a traditional financial institution is not. We provide a streamlined, premium experience designed to grow your portfolio across diverse global assets including stocks, forex, and commodities.
                    </p>
                    
                    <div class="space-y-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-gold-400/10 text-gold-400">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-white">Global Assets</h4>
                                <p class="mt-1 text-gray-400">Trade indices, forex, stocks, and modern ETFs seamlessly.</p>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-gold-400/10 text-gold-400">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-white">Unmatched Security</h4>
                                <p class="mt-1 text-gray-400">Bank-grade encryption protecting your wealth 24/7.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/2" data-aos="fade-left" data-aos-delay="200">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gold-400 rounded-3xl transform rotate-3 scale-105 opacity-20 blur-sm"></div>
                        <img class="relative rounded-3xl shadow-2xl border border-white/10 object-cover h-[500px] w-full" src="https://images.unsplash.com/photo-1579532537598-459ecdaf39cc?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Financial graphs">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-20 relative overflow-hidden bg-gold-500">
        <div class="absolute inset-0 bg-gradient-to-r from-gold-600 to-gold-400"></div>
        <div class="relative z-10 max-w-4xl mx-auto px-4 text-center" data-aos="zoom-in">
            <h2 class="text-4xl md:text-5xl font-bold text-navy-900 mb-6">Ready to Build Your Portfolio?</h2>
            <p class="text-xl text-navy-800 mb-10 font-medium">Join over 49,000 investors currently growing their wealth with {{ env('APP_NAME') }}.</p>
            <a href="{{ route('register') }}" class="inline-block bg-navy-900 hover:bg-navy-800 text-white px-10 py-4 rounded-full text-lg font-semibold transition-all shadow-xl hover-lift">
                Open Your Account Today
            </a>
        </div>
    </section>
@endsection
