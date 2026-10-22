@extends('theme3.layouts.app')

@section('content')
    <!-- Page Header -->
    <div class="hero pt-32 pb-20 text-white">
        <div class="container-main text-center relative z-10" data-aos="zoom-in">
            <span class="section-label mb-4">Help Center</span>
            <h1 class="text-4xl md:text-5xl font-semibold tracking-tight text-white mb-4">
                Frequently Asked <span class="text-gradient">Questions</span>
            </h1>
            <p class="text-gray-300 max-w-2xl mx-auto text-base sm:text-lg">
                Find clear answers to questions about account setup, investments, deposits, and security.
            </p>
        </div>
    </div>

    <!-- FAQ Section -->
    <section class="py-20 sm:py-28 bg-[#f7f8fb]">
        <div class="container-main max-w-4xl">
            <div class="grid gap-6" data-aos="fade-up">
                
                <div class="feature-card rounded-2xl p-7 bg-white">
                    <h3 class="text-lg font-semibold text-[#172033] flex items-center gap-3">
                        <span class="step-number !w-8 !h-8 !rounded-lg text-sm">Q</span>
                        What is {{ env('APP_NAME', 'Laravel') }} Limited?
                    </h3>
                    <p class="mt-4 text-sm leading-7 text-gray-500 pl-11">
                        {{ env('APP_NAME', 'Laravel') }} Limited is an institutional-grade investment management platform providing access to diversified portfolios, algorithmic yield generation, and wealth planning tools.
                    </p>
                </div>

                <div class="feature-card rounded-2xl p-7 bg-white">
                    <h3 class="text-lg font-semibold text-[#172033] flex items-center gap-3">
                        <span class="step-number !w-8 !h-8 !rounded-lg text-sm">Q</span>
                        How do I start investing?
                    </h3>
                    <p class="mt-4 text-sm leading-7 text-gray-500 pl-11">
                        Getting started is fast and seamless. Simply sign up for an account, complete your profile verification, make your initial deposit through our supported options, and choose your preferred investment plan.
                    </p>
                </div>

                <div class="feature-card rounded-2xl p-7 bg-white">
                    <h3 class="text-lg font-semibold text-[#172033] flex items-center gap-3">
                        <span class="step-number !w-8 !h-8 !rounded-lg text-sm">Q</span>
                        How are returns calculated and credited?
                    </h3>
                    <p class="mt-4 text-sm leading-7 text-gray-500 pl-11">
                        Returns are calculated based on your active plan's interest schedule. Profits are credited directly to your account balance and can be monitored in real-time from your member dashboard.
                    </p>
                </div>

                <div class="feature-card rounded-2xl p-7 bg-white">
                    <h3 class="text-lg font-semibold text-[#172033] flex items-center gap-3">
                        <span class="step-number !w-8 !h-8 !rounded-lg text-sm">Q</span>
                        How do I withdraw my funds?
                    </h3>
                    <p class="mt-4 text-sm leading-7 text-gray-500 pl-11">
                        Navigate to the "Withdrawal" section inside your dashboard, enter the amount you wish to withdraw, and confirm your destination wallet/account. Withdrawals are processed promptly following security verification.
                    </p>
                </div>

                <div class="feature-card rounded-2xl p-7 bg-white">
                    <h3 class="text-lg font-semibold text-[#172033] flex items-center gap-3">
                        <span class="step-number !w-8 !h-8 !rounded-lg text-sm">Q</span>
                        Are my funds and personal details safe?
                    </h3>
                    <p class="mt-4 text-sm leading-7 text-gray-500 pl-11">
                        Yes. We implement military-grade SSL/TLS encryption, segmented database access, and cold storage for digital assets to guarantee maximum security for every user.
                    </p>
                </div>

            </div>

            <!-- Still Have Questions CTA -->
            <div class="mt-14 text-center p-8 rounded-2xl border border-[#e8edf4] bg-white">
                <h4 class="text-lg font-semibold text-[#172033]">Still have questions?</h4>
                <p class="text-sm text-gray-500 mt-2">Our support team is available 24/7 to provide personalized assistance.</p>
                <a href="{{ route('support') }}" class="gold-button inline-flex items-center gap-2 rounded-xl px-6 py-3 text-sm font-semibold mt-5">
                    Contact Our Support Team <span aria-hidden="true">→</span>
                </a>
            </div>
        </div>
    </section>
@endsection
