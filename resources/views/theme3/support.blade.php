@extends('theme3.layouts.app')

@section('content')
    <!-- Page Header -->
    <div class="hero pt-32 pb-20 text-white">
        <div class="container-main text-center relative z-10" data-aos="zoom-in">
            <span class="section-label mb-4">Customer Care</span>
            <h1 class="text-4xl md:text-5xl font-semibold tracking-tight text-white mb-4">
                We're here to <span class="text-gradient">assist you</span>
            </h1>
            <p class="text-gray-300 max-w-2xl mx-auto text-base sm:text-lg">
                Have questions or need technical support? Get in touch with our expert financial advisory and support team.
            </p>
        </div>
    </div>

    <!-- Contact Section -->
    <section class="py-20 sm:py-28 bg-[#f7f8fb]">
        <div class="container-main">
            <div class="grid items-start gap-12 lg:grid-cols-2 lg:gap-16">
                
                <!-- Contact Info -->
                <div data-aos="fade-right">
                    <span class="section-label">Connect With Us</span>
                    <h2 class="mt-5 text-3xl font-semibold leading-tight text-[#172033] sm:text-4xl">
                        Direct assistance whenever you need it
                    </h2>
                    <p class="mt-5 text-gray-500 leading-relaxed">
                        Whether you need guidance regarding investment plans, deposit assistance, or account security inquiries, our advisors are here for you.
                    </p>

                    <div class="mt-8 space-y-6">
                        <div class="flex items-start gap-4 stat-card rounded-2xl p-6">
                            <div class="icon-box">
                                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-[#172033]">Email Support</h4>
                                <p class="text-sm text-gray-500 mt-1">support@{{ request()->getHost() }}</p>
                                <span class="inline-block mt-2 text-xs font-semibold text-[#947312]">Average response: under 2 hours</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 stat-card rounded-2xl p-6">
                            <div class="icon-box">
                                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-[#172033]">Registered Corporate Office</h4>
                                <p class="text-sm text-gray-500 mt-1">London, United Kingdom</p>
                                <span class="inline-block mt-2 text-xs font-semibold text-[#947312]">Registration #11694133</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Support Form -->
                <div class="feature-card rounded-3xl p-8 sm:p-10 bg-white" data-aos="fade-left">
                    <h3 class="text-2xl font-semibold text-[#172033] mb-2">Send a Message</h3>
                    <p class="text-sm text-gray-500 mb-6">Fill in the form below and an advisor will contact you shortly.</p>

                    <form class="space-y-4" action="#" method="POST" onsubmit="event.preventDefault(); alert('Thank you! Your message has been sent. Our team will contact you shortly.');">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-1">Your Full Name</label>
                            <input type="text" required class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm text-[#172033] focus:border-[#d4af37] focus:outline-none focus:ring-1 focus:ring-[#d4af37]" placeholder="e.g. John Doe">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-1">Email Address</label>
                            <input type="email" required class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm text-[#172033] focus:border-[#d4af37] focus:outline-none focus:ring-1 focus:ring-[#d4af37]" placeholder="e.g. john@example.com">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-1">Subject</label>
                            <input type="text" required class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm text-[#172033] focus:border-[#d4af37] focus:outline-none focus:ring-1 focus:ring-[#d4af37]" placeholder="Investment Plan Inquiry">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-1">Message</label>
                            <textarea rows="4" required class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm text-[#172033] focus:border-[#d4af37] focus:outline-none focus:ring-1 focus:ring-[#d4af37]" placeholder="How can we help you?"></textarea>
                        </div>

                        <button type="submit" class="gold-button w-full rounded-xl py-3.5 text-sm font-bold text-[#111827]">
                            Submit Inquiry
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </section>
@endsection
