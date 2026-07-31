@extends('theme2.layouts.app')

@section('content')
    <!-- Page Header -->
    <div class="relative bg-navy-900 pt-24 pb-16 overflow-hidden">
        <div class="relative z-10 max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Contact <span class="text-gold-400">Support</span></h1>
            <p class="text-lg text-gray-400 max-w-2xl mx-auto">We're here to help you navigate your financial journey.</p>
        </div>
    </div>

    <section class="py-20 bg-navy-800">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                
                <!-- Contact Info -->
                <div>
                    <h2 class="text-3xl font-bold text-white mb-6">Get In Touch</h2>
                    <p class="text-gray-400 mb-8 leading-relaxed">
                        Whether you have a question about our investment plans, need assistance with your account, or require technical support, our team is ready to provide premium assistance.
                    </p>
                    
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1 bg-gold-400/10 p-3 rounded-lg text-gold-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-white">Email Support</h4>
                                <p class="text-gray-400 mt-1">support@{{ request()->getHost() }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1 bg-gold-400/10 p-3 rounded-lg text-gold-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-white">Office Location</h4>
                                <p class="text-gray-400 mt-1">London, United Kingdom<br/>(Registration #11694133)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form (Visual representation) -->
                <div class="bg-navy-900 border border-white/10 rounded-3xl p-8">
                    <h3 class="text-2xl font-bold text-white mb-6">Send a Message</h3>
                    <form class="space-y-4" action="#" method="POST">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Your Name</label>
                            <input type="text" class="w-full bg-navy-800 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-gold-400 focus:ring-1 focus:ring-gold-400 transition-colors" placeholder="John Doe">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Email Address</label>
                            <input type="email" class="w-full bg-navy-800 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-gold-400 focus:ring-1 focus:ring-gold-400 transition-colors" placeholder="john@example.com">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Message</label>
                            <textarea rows="4" class="w-full bg-navy-800 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-gold-400 focus:ring-1 focus:ring-gold-400 transition-colors" placeholder="How can we help you?"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-gold-400 hover:bg-gold-500 text-navy-900 font-bold py-3 px-4 rounded-xl transition-colors mt-4">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
