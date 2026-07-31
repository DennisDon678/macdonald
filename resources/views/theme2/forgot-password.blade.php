@extends('theme2.layouts.app')

@section('content')
    <div class="min-h-screen bg-navy-900 flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        
        <!-- Abstract Background -->
        <div class="absolute inset-0 z-0">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-gold-400 rounded-full mix-blend-multiply filter blur-[128px] opacity-10"></div>
        </div>

        <div class="max-w-md w-full space-y-8 relative z-10 bg-navy-800/80 backdrop-blur-xl p-10 rounded-3xl border border-white/10 shadow-2xl">
            <div>
                <h2 class="mt-2 text-center text-3xl font-extrabold text-white">
                    Reset Password
                </h2>
                <p class="mt-2 text-center text-sm text-gray-400">
                    Enter your email to receive a password reset link.
                </p>
            </div>

            @if(session('error'))
                <div class="bg-red-500/10 border border-red-500/50 text-red-500 rounded-lg p-4 text-sm text-center">
                    {{ session('error') }}
                </div>
            @endif
            @if(session('success'))
                <div class="bg-green-500/10 border border-green-500/50 text-green-500 rounded-lg p-4 text-sm text-center">
                    {{ session('success') }}
                </div>
            @endif

            <form class="mt-8 space-y-6" action="{{ route('forgot-password.post') }}" method="POST">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-400 mb-1">Email address</label>
                    <input id="email" name="email" type="email" required class="appearance-none rounded-xl relative block w-full px-4 py-3 border border-white/10 bg-navy-900/50 placeholder-gray-500 text-white focus:outline-none focus:ring-1 focus:ring-gold-400 focus:border-gold-400 focus:z-10 sm:text-sm transition-colors" placeholder="Email address">
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-xl text-navy-900 bg-gold-400 hover:bg-gold-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold-400 focus:ring-offset-navy-900 transition-colors shadow-lg shadow-gold-400/20">
                        Send Reset Link
                    </button>
                </div>
            </form>
            
            <div class="text-center mt-6">
                <p class="text-sm text-gray-400">
                    Remembered your password? 
                    <a href="{{ route('login') }}" class="font-medium text-gold-400 hover:text-gold-300 transition-colors">Sign in</a>
                </p>
            </div>
        </div>
    </div>
@endsection
