@extends('theme2.layouts.app')

@section('content')
    <!-- Page Header -->
    <div class="relative bg-navy-900 pt-24 pb-16 overflow-hidden">
        <div class="absolute inset-0 z-0 opacity-30">
            <div class="absolute -top-24 left-1/2 w-96 h-96 bg-gold-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -translate-x-1/2"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 text-center" data-aos="zoom-in">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Frequently Asked <span class="text-gold-400">Questions</span></h1>
            <p class="text-lg text-gray-400 max-w-2xl mx-auto">Find answers to the most common questions about our premium investment platform.</p>
        </div>
    </div>

    <!-- FAQ Section -->
    <section class="py-20 bg-navy-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8" data-aos="fade-up">
                <!-- FAQ Item 1 -->
                <div class="bg-navy-900 border border-white/10 rounded-2xl p-6 transition-all hover:border-gold-400/50">
                    <h3 class="text-xl font-bold text-white mb-3 flex items-center">
                        <span class="text-gold-400 mr-3">Q.</span> What is {{ env('APP_NAME') }} Limited?
                    </h3>
                    <p class="text-gray-400 pl-8">
                        {{ env('APP_NAME') }} Limited is a premier investment service focused on the global financial market. We provide top-tier platforms to invest and grow your wealth across diverse asset classes safely and efficiently.
                    </p>
                </div>

                <!-- FAQ Item 2 -->
                <div class="bg-navy-900 border border-white/10 rounded-2xl p-6 transition-all hover:border-gold-400/50">
                    <h3 class="text-xl font-bold text-white mb-3 flex items-center">
                        <span class="text-gold-400 mr-3">Q.</span> How do I create my account?
                    </h3>
                    <p class="text-gray-400 pl-8">
                        Registration is incredibly straightforward. Simply click the "Get Started" or "Register" button, fill in your required details securely, and you'll have access to our dashboard in moments.
                    </p>
                </div>

                <!-- FAQ Item 3 -->
                <div class="bg-navy-900 border border-white/10 rounded-2xl p-6 transition-all hover:border-gold-400/50">
                    <h3 class="text-xl font-bold text-white mb-3 flex items-center">
                        <span class="text-gold-400 mr-3">Q.</span> How do I make a deposit?
                    </h3>
                    <p class="text-gray-400 pl-8">
                        Once logged in, navigate to the Deposits section. Select your preferred investment plan, choose your deposit method, and follow the on-screen instructions. Deposits are typically reflected on your dashboard quickly.
                    </p>
                </div>

                <!-- FAQ Item 4 -->
                <div class="bg-navy-900 border border-white/10 rounded-2xl p-6 transition-all hover:border-gold-400/50">
                    <h3 class="text-xl font-bold text-white mb-3 flex items-center">
                        <span class="text-gold-400 mr-3">Q.</span> How do I make a withdrawal?
                    </h3>
                    <p class="text-gray-400 pl-8">
                        To withdraw funds, click the Withdraw button within your account dashboard. Input the required details and amount. Once we receive your request, it is processed immediately and sent to your designated account.
                    </p>
                </div>
                
                <!-- FAQ Item 5 -->
                <div class="bg-navy-900 border border-white/10 rounded-2xl p-6 transition-all hover:border-gold-400/50">
                    <h3 class="text-xl font-bold text-white mb-3 flex items-center">
                        <span class="text-gold-400 mr-3">Q.</span> Is this company properly registered?
                    </h3>
                    <p class="text-gray-400 pl-8">
                        Yes, we are officially and properly registered with the UK company house. Our company registration number is #11694133.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-20 relative overflow-hidden bg-gold-500">
        <div class="absolute inset-0 bg-gradient-to-r from-gold-600 to-gold-400"></div>
        <div class="relative z-10 max-w-4xl mx-auto px-4 text-center" data-aos="zoom-in">
            <h2 class="text-4xl md:text-5xl font-bold text-navy-900 mb-6">Still have questions?</h2>
            <p class="text-xl text-navy-800 mb-10 font-medium">Our support team is available 24/7 to assist you.</p>
            <a href="{{ route('support') }}" class="inline-block bg-navy-900 hover:bg-navy-800 text-white px-10 py-4 rounded-full text-lg font-semibold transition-all shadow-xl hover-lift">
                Contact Support
            </a>
        </div>
    </section>
@endsection
