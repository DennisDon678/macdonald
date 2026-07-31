@extends('theme2.layouts.app')

@section('content')
    <!-- Page Header -->
    <div class="relative bg-navy-900 pt-24 pb-16 overflow-hidden">
        <div class="absolute inset-0 z-0 opacity-30">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-gold-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-blue-900 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 text-center" data-aos="zoom-in">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">About <span class="text-gold-400">Us</span></h1>
            <p class="text-lg text-gray-400 max-w-2xl mx-auto">Discover the team and the vision driving the next generation of global investments.</p>
        </div>
    </div>

    <!-- About Section -->
    <section class="py-20 bg-navy-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-16 items-center">
                <div class="lg:w-1/2" data-aos="fade-right">
                    <span class="text-gold-400 font-semibold tracking-wider uppercase text-sm mb-2 block">Our Story</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">We give investors the better choice.</h2>
                    <p class="text-gray-400 text-lg mb-6 leading-relaxed">
                        With over 153,000 investments under our management and $5 billion+ in assets under our administration, we have made {{ env('APP_NAME') }} Limited the safe haven for investors who want to trust their financial partner.
                    </p>
                    <p class="text-gray-400 text-lg mb-8 leading-relaxed">
                        We set out to give investors better, simpler, and more profitable ways to become financially successful and secure.
                    </p>

                    <div class="grid grid-cols-2 gap-6 mt-8">
                        <div class="bg-navy-900 p-6 rounded-2xl border border-white/5 border-l-4 border-l-gold-400 hover-lift">
                            <h4 class="text-3xl font-bold text-white mb-1">49K+</h4>
                            <p class="text-gray-400 text-sm">Investors</p>
                        </div>
                        <div class="bg-navy-900 p-6 rounded-2xl border border-white/5 border-l-4 border-l-gold-400 hover-lift">
                            <h4 class="text-3xl font-bold text-white mb-1">11+</h4>
                            <p class="text-gray-400 text-sm">Industry Awards</p>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/2" data-aos="fade-left" data-aos-delay="200">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-white/10 group">
                        <div class="absolute inset-0 bg-gold-400/20 mix-blend-overlay z-10 group-hover:bg-transparent transition-all duration-500"></div>
                        <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1000&q=80" alt="Corporate office" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Team Section -->
    <section class="py-20 bg-navy-900 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-gold-400 font-semibold tracking-wider uppercase text-sm mb-2 block">Our People</span>
                <h2 class="text-3xl md:text-4xl font-bold text-white">The Best Team</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Team Member 1 -->
                <div class="bg-navy-800 rounded-2xl border border-white/5 overflow-hidden hover-lift group text-center pb-8" data-aos="fade-up" data-aos-delay="0">
                    <div class="h-64 overflow-hidden mb-6 bg-navy-900">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Jimmy Wong" class="w-full h-full object-cover object-top filter grayscale group-hover:grayscale-0 transition-all duration-500">
                    </div>
                    <h3 class="text-xl font-bold text-white">Jimmy Wong</h3>
                    <p class="text-gold-400 mt-1">CEO</p>
                </div>
                <!-- Team Member 2 -->
                <div class="bg-navy-800 rounded-2xl border border-white/5 overflow-hidden hover-lift group text-center pb-8" data-aos="fade-up" data-aos-delay="100">
                    <div class="h-64 overflow-hidden mb-6 bg-navy-900">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Jane Eberhardt" class="w-full h-full object-cover object-top filter grayscale group-hover:grayscale-0 transition-all duration-500">
                    </div>
                    <h3 class="text-xl font-bold text-white">Jane Eberhardt</h3>
                    <p class="text-gold-400 mt-1">Financial Manager</p>
                </div>
                <!-- Team Member 3 -->
                <div class="bg-navy-800 rounded-2xl border border-white/5 overflow-hidden hover-lift group text-center pb-8" data-aos="fade-up" data-aos-delay="200">
                    <div class="h-64 overflow-hidden mb-6 bg-navy-900">
                        <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Gofrey Lee Hamilton" class="w-full h-full object-cover object-top filter grayscale group-hover:grayscale-0 transition-all duration-500">
                    </div>
                    <h3 class="text-xl font-bold text-white">Gofrey Lee Hamilton</h3>
                    <p class="text-gold-400 mt-1">Associate Division Director</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to action -->
    <section class="py-20 relative overflow-hidden bg-gold-500">
        <div class="absolute inset-0 bg-gradient-to-r from-gold-600 to-gold-400"></div>
        <div class="relative z-10 max-w-4xl mx-auto px-4 text-center" data-aos="zoom-in">
            <h2 class="text-4xl md:text-5xl font-bold text-navy-900 mb-6">Partner With Excellence</h2>
            <p class="text-xl text-navy-800 mb-10 font-medium">Join our global network of successful investors today.</p>
            <a href="{{ route('register') }}" class="inline-block bg-navy-900 hover:bg-navy-800 text-white px-10 py-4 rounded-full text-lg font-semibold transition-all shadow-xl hover-lift">
                Create an Account
            </a>
        </div>
    </section>
@endsection
