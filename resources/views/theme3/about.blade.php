@extends('theme3.layouts.app')

@section('content')
    <!-- Page Header -->
    <div class="hero pt-32 pb-20 text-white">
        <div class="container-main text-center relative z-10" data-aos="zoom-in">
            <span class="section-label mb-4">About Our Platform</span>
            <h1 class="text-4xl md:text-5xl font-semibold tracking-tight text-white mb-4">
                Empowering your <span class="text-gradient">financial growth</span>
            </h1>
            <p class="text-gray-300 max-w-2xl mx-auto text-base sm:text-lg">
                Discover the vision, technology, and team committed to securing your financial journey.
            </p>
        </div>
    </div>

    <!-- About Story Section -->
    <section class="py-20 sm:py-28 bg-white">
        <div class="container-main">
            <div class="grid items-center gap-12 lg:grid-cols-2 lg:gap-16">
                <div data-aos="fade-right">
                    <span class="section-label">Our Mission</span>
                    <h2 class="mt-5 text-3xl font-semibold leading-tight text-[#172033] sm:text-4xl">
                        A disciplined, transparent path to wealth creation
                    </h2>
                    <p class="mt-5 text-gray-500 leading-relaxed">
                        With over 150,000 investments managed and billions in transactional volume, {{ env('APP_NAME', 'Laravel') }} Limited is built to be a reliable partner in your financial journey.
                    </p>
                    <p class="mt-4 text-gray-500 leading-relaxed">
                        We blend institutional-grade security with modern investment strategies, giving everyday investors the tools and confidence to grow their portfolios efficiently.
                    </p>

                    <div class="grid grid-cols-2 gap-6 mt-8">
                        <div class="stat-card rounded-2xl p-6 border border-[#e8edf4]">
                            <p class="text-3xl font-bold text-[#172033]">49K+</p>
                            <p class="text-sm text-gray-500 mt-1 font-medium">Active Investors</p>
                        </div>
                        <div class="stat-card rounded-2xl p-6 border border-[#e8edf4]">
                            <p class="text-3xl font-bold text-[#172033]">99.9%</p>
                            <p class="text-sm text-gray-500 mt-1 font-medium">Platform Uptime</p>
                        </div>
                    </div>
                </div>

                <div class="relative" data-aos="fade-left">
                    <div class="overflow-hidden rounded-3xl border border-[#e8edf4] shadow-xl">
                        <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1000&q=80"
                             alt="Corporate office team collaboration"
                             class="w-full h-[420px] object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values -->
    <section class="bg-[#f7f8fb] py-20 sm:py-28">
        <div class="container-main">
            <div class="mx-auto max-w-2xl text-center" data-aos="fade-up">
                <span class="section-label">Principles</span>
                <h2 class="mt-5 text-3xl font-semibold tracking-tight text-[#172033] sm:text-4xl">
                    Built on trust and security
                </h2>
                <p class="mt-4 text-gray-500">
                    We adhere to the highest international financial compliance and risk management protocols.
                </p>
            </div>

            <div class="mt-14 grid gap-8 md:grid-cols-3">
                <div class="feature-card rounded-2xl p-8" data-aos="fade-up">
                    <div class="icon-box mb-6">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/>
                            <path d="m9 12 2 2 4-4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-[#172033]">Bank-Grade Security</h3>
                    <p class="mt-3 text-sm leading-6 text-gray-500">
                        Multi-tier encryption and cold-storage asset vaults keep your funds safeguarded 24/7.
                    </p>
                </div>

                <div class="feature-card rounded-2xl p-8" data-aos="fade-up" data-aos-delay="100">
                    <div class="icon-box mb-6">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 3v18h18"/>
                            <path d="m19 9-5 5-4-4-4 4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-[#172033]">Consistent Performance</h3>
                    <p class="mt-3 text-sm leading-6 text-gray-500">
                        Our quantitative strategies and diversified portfolios are built for sustainable returns.
                    </p>
                </div>

                <div class="feature-card rounded-2xl p-8" data-aos="fade-up" data-aos-delay="200">
                    <div class="icon-box mb-6">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M12 6v6l4 2"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-[#172033]">Dedicated Support</h3>
                    <p class="mt-3 text-sm leading-6 text-gray-500">
                        Our experienced support specialists are on standby around the clock to assist you.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
