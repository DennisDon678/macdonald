@extends('theme3.layouts.app')

@section('content')
    <div class="hero min-h-screen flex items-center justify-center pt-28 pb-16 px-4">
        <div class="max-w-md w-full relative z-10" data-aos="zoom-in">

            <div class="glass-card rounded-3xl p-8 sm:p-10 border border-white/20 shadow-2xl backdrop-blur-2xl">
                
                <div class="text-center mb-8">
                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-[#f5df91] to-[#c5a028] text-xl font-bold text-[#111827] mb-4 shadow-lg shadow-[#d4af37]/20">
                        {{ strtoupper(substr(env('APP_NAME', 'L'), 0, 1)) }}
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-white tracking-tight">
                        Reset Password
                    </h2>
                    <p class="text-sm text-gray-400 mt-2">
                        Enter your registered email to receive recovery instructions.
                    </p>
                </div>

                @if(session('error'))
                    <div class="mb-5 rounded-xl border border-red-500/40 bg-red-500/10 p-4 text-center text-sm font-medium text-red-300">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="mb-5 rounded-xl border border-emerald-500/40 bg-emerald-500/10 p-4 text-center text-sm font-medium text-emerald-300">
                        {{ session('success') }}
                    </div>
                @endif

                <form class="space-y-5" action="{{ route('forgot-password.post') }}" method="POST">
                    @csrf
                    
                    <div>
                        <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-gray-300 mb-2">Registered Email Address</label>
                        <input id="email" name="email" type="email" required autofocus
                               class="w-full rounded-xl border border-white/15 bg-white/5 px-4 py-3.5 text-sm text-white placeholder-gray-500 transition focus:border-[#d4af37] focus:bg-white/10 focus:outline-none focus:ring-1 focus:ring-[#d4af37]"
                               placeholder="name@example.com">
                    </div>

                    <button type="submit" class="gold-button w-full rounded-xl py-3.5 text-sm font-bold text-[#111827] mt-2">
                        Send Reset Instructions
                    </button>
                </form>

                <div class="mt-7 text-center border-t border-white/10 pt-5 text-sm text-gray-400">
                    Remember your credentials? 
                    <a href="{{ route('login') }}" class="font-semibold text-[#f4d77a] hover:underline">
                        Return to sign in
                    </a>
                </div>

            </div>

        </div>
    </div>
@endsection
