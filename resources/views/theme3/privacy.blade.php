@extends('theme3.layouts.app')

@section('content')
    <!-- Page Header -->
    <div class="hero pt-32 pb-20 text-white">
        <div class="container-main text-center relative z-10" data-aos="zoom-in">
            <span class="section-label mb-4">Legal Compliance</span>
            <h1 class="text-4xl md:text-5xl font-semibold tracking-tight text-white mb-4">
                Privacy <span class="text-gradient">Policy</span>
            </h1>
            <p class="text-gray-300 max-w-2xl mx-auto text-base sm:text-lg">
                Your data protection, financial privacy, and account security are our highest priority.
            </p>
        </div>
    </div>

    <section class="py-20 sm:py-28 bg-[#f7f8fb]">
        <div class="container-main max-w-4xl">
            <div class="bg-white rounded-3xl p-8 sm:p-12 border border-[#e8edf4] shadow-sm leading-relaxed text-[#172033]" data-aos="fade-up">
                
                <h2 class="text-2xl font-bold text-[#172033] mb-3">1. Information We Collect</h2>
                <p class="text-gray-600 mb-8 leading-7">
                    We collect personal information necessary to deliver compliant financial services, verify your identity, process transactions, and maintain account integrity. This may include your full name, email address, contact information, cryptographic transaction addresses, and KYC identity documents.
                </p>

                <h2 class="text-2xl font-bold text-[#172033] mb-3">2. How We Use Your Information</h2>
                <p class="text-gray-600 mb-8 leading-7">
                    Information gathered is utilized strictly to provide investment management services, execute authorized financial transactions, generate accurate portfolio reporting, and safeguard against fraudulent or unauthorized activity.
                </p>

                <h2 class="text-2xl font-bold text-[#172033] mb-3">3. Data Protection and Encryption</h2>
                <p class="text-gray-600 mb-8 leading-7">
                    All communications and stored user information are secured via 256-bit SSL/TLS encryption. We enforce stringent role-based access control, periodic vulnerability assessments, and multi-signature authorization on fund management layers.
                </p>

                <h2 class="text-2xl font-bold text-[#172033] mb-3">4. Disclosure of Personal Information</h2>
                <p class="text-gray-600 mb-8 leading-7">
                    {{ env('APP_NAME', 'Laravel') }} Limited does not sell, trade, or rent user data to third parties. We only share information with licensed payment processors or when required by governing law enforcement and regulatory authorities.
                </p>

                <h2 class="text-2xl font-bold text-[#172033] mb-3">5. Contacting the Data Protection Officer</h2>
                <p class="text-gray-600 leading-7">
                    For questions or data deletion requests, contact our compliance office at 
                    <a href="mailto:privacy@{{ request()->getHost() }}" class="font-semibold text-[#947312] hover:underline">privacy@{{ request()->getHost() }}</a>.
                </p>

            </div>
        </div>
    </section>
@endsection
