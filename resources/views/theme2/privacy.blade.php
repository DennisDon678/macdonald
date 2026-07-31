@extends('theme2.layouts.app')

@section('content')
    <div class="relative bg-navy-900 pt-24 pb-16 overflow-hidden">
        <div class="relative z-10 max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Privacy <span class="text-gold-400">Policy</span></h1>
            <p class="text-lg text-gray-400 max-w-2xl mx-auto">Your privacy and data security are our top priorities.</p>
        </div>
    </div>

    <section class="py-20 bg-navy-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-navy-900 border border-white/10 rounded-3xl p-8 md:p-12 text-gray-300 prose prose-invert prose-gold max-w-none">
                <h2 class="text-2xl font-bold text-white mb-4">1. Information Collection</h2>
                <p class="mb-6">
                    We collect information to provide better services to our users. This includes basic information like your name and email address, as well as more complex information necessary for financial compliance and transaction processing.
                </p>

                <h2 class="text-2xl font-bold text-white mb-4">2. Use of Information</h2>
                <p class="mb-6">
                    The information we collect is used to maintain, protect, and improve our services, as well as develop new ones. We also use this information to offer you tailored investment advice and content.
                </p>

                <h2 class="text-2xl font-bold text-white mb-4">3. Data Security</h2>
                <p class="mb-6">
                    We work hard to protect {{ env('APP_NAME') }} Limited and our users from unauthorized access to or unauthorized alteration, disclosure, or destruction of information we hold. In particular:
                </p>
                <ul class="list-disc pl-6 mb-6 space-y-2">
                    <li>We encrypt many of our services using SSL/TLS.</li>
                    <li>We review our information collection, storage, and processing practices.</li>
                    <li>We restrict access to personal information to employees, contractors, and agents who need that information.</li>
                </ul>

                <h2 class="text-2xl font-bold text-white mb-4">4. Sharing of Information</h2>
                <p class="mb-6">
                    We do not share personal information with companies, organizations, and individuals outside of {{ env('APP_NAME') }} Limited unless one of the following circumstances applies: with your consent, for external processing, or for legal reasons.
                </p>
            </div>
        </div>
    </section>
@endsection
