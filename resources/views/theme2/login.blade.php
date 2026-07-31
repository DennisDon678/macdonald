@extends('theme2.layouts.app')

@section('content')
    <div class="min-h-screen bg-navy-900 flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        
        <!-- Abstract Background -->
        <div class="absolute inset-0 z-0">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-gold-400 rounded-full mix-blend-multiply filter blur-[128px] opacity-20"></div>
            <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-blue-900 rounded-full mix-blend-multiply filter blur-[128px] opacity-30"></div>
        </div>

        <div class="max-w-md w-full space-y-8 relative z-10 bg-navy-800/80 backdrop-blur-xl p-10 rounded-3xl border border-white/10 shadow-2xl">
            <div>
                <h2 class="mt-2 text-center text-3xl font-extrabold text-white">
                    Welcome Back
                </h2>
                <p class="mt-2 text-center text-sm text-gray-400">
                    Access your investment portfolio
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

            <form class="mt-8 space-y-6" action="{{ route('login.post') }}" method="POST" name="loginForm">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-400 mb-1">Email address</label>
                        <input id="email" name="email" type="email" value="{{old('email')}}" required class="appearance-none rounded-xl relative block w-full px-4 py-3 border border-white/10 bg-navy-900/50 placeholder-gray-500 text-white focus:outline-none focus:ring-1 focus:ring-gold-400 focus:border-gold-400 focus:z-10 sm:text-sm transition-colors" placeholder="Email address">
                        @error('email')
                            <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <label for="password" class="block text-sm font-medium text-gray-400">Password</label>
                            <a href="{{ route('forgot-password') }}" class="text-sm font-medium text-gold-400 hover:text-gold-300">Forgot password?</a>
                        </div>
                        <input id="password" name="password" type="password" required class="appearance-none rounded-xl relative block w-full px-4 py-3 border border-white/10 bg-navy-900/50 placeholder-gray-500 text-white focus:outline-none focus:ring-1 focus:ring-gold-400 focus:border-gold-400 focus:z-10 sm:text-sm transition-colors" placeholder="Password">
                        @error('password')
                            <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div>
                    <button type="submit" name="login" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-xl text-navy-900 bg-gold-400 hover:bg-gold-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold-400 focus:ring-offset-navy-900 transition-colors shadow-lg shadow-gold-400/20">
                        Sign In
                    </button>
                </div>
            </form>
            
            <div class="text-center mt-6">
                <p class="text-sm text-gray-400">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="font-medium text-gold-400 hover:text-gold-300 transition-colors">Register now</a>
                </p>
            </div>
        </div>
    </div>
@endsection
