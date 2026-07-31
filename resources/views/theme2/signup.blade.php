@extends('theme2.layouts.app')

@section('content')
    <script language="javascript">
        // Store referral code from URL to localStorage when page loads
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const refCode = urlParams.get('ref');
            if (refCode) {
                localStorage.setItem('referralCode', refCode);
            }
        });
    </script>

    <div class="min-h-screen bg-navy-900 flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        
        <!-- Abstract Background -->
        <div class="absolute inset-0 z-0">
            <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-gold-400 rounded-full mix-blend-multiply filter blur-[128px] opacity-20"></div>
            <div class="absolute bottom-1/4 left-1/4 w-96 h-96 bg-blue-900 rounded-full mix-blend-multiply filter blur-[128px] opacity-30"></div>
        </div>

        <div class="max-w-2xl w-full space-y-8 relative z-10 bg-navy-800/80 backdrop-blur-xl p-10 rounded-3xl border border-white/10 shadow-2xl mt-12">
            <div>
                <h2 class="mt-2 text-center text-3xl font-extrabold text-white">
                    Create an Account
                </h2>
                <p class="mt-2 text-center text-sm text-gray-400">
                    Start your investment journey with {{ env('APP_NAME') }}
                </p>
            </div>

            @if(session('error'))
                <div class="bg-red-500/10 border border-red-500/50 text-red-500 rounded-lg p-4 text-sm text-center">
                    {{ session('error') }}
                </div>
            @endif

            <form class="mt-8 space-y-6" action="{{ route('register.post') }}" method="POST" name="signupForm">
                @csrf
                <input type="hidden" name="ref" id="refInput" value="">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Full Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-400 mb-1">Full Name</label>
                        <input id="name" name="name" type="text" value="{{old('name')}}" required class="appearance-none rounded-xl relative block w-full px-4 py-3 border border-white/10 bg-navy-900/50 placeholder-gray-500 text-white focus:outline-none focus:ring-1 focus:ring-gold-400 focus:border-gold-400 focus:z-10 sm:text-sm transition-colors" placeholder="Enter your Fullname">
                        @error('name')
                            <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-400 mb-1">Username</label>
                        <input id="username" name="username" type="text" value="{{old('username')}}" required class="appearance-none rounded-xl relative block w-full px-4 py-3 border border-white/10 bg-navy-900/50 placeholder-gray-500 text-white focus:outline-none focus:ring-1 focus:ring-gold-400 focus:border-gold-400 focus:z-10 sm:text-sm transition-colors" placeholder="Enter your username">
                        @error('username')
                            <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-400 mb-1">Email address</label>
                        <input id="email" name="email" type="email" value="{{old('email')}}" required class="appearance-none rounded-xl relative block w-full px-4 py-3 border border-white/10 bg-navy-900/50 placeholder-gray-500 text-white focus:outline-none focus:ring-1 focus:ring-gold-400 focus:border-gold-400 focus:z-10 sm:text-sm transition-colors" placeholder="Enter your E-mail">
                        @error('email')
                            <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Retype Email -->
                    <div>
                        <label for="email1" class="block text-sm font-medium text-gray-400 mb-1">Retype Email</label>
                        <input id="email1" name="email1" type="email" value="{{old('email1')}}" required class="appearance-none rounded-xl relative block w-full px-4 py-3 border border-white/10 bg-navy-900/50 placeholder-gray-500 text-white focus:outline-none focus:ring-1 focus:ring-gold-400 focus:border-gold-400 focus:z-10 sm:text-sm transition-colors" placeholder="Retype E-mail">
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-400 mb-1">Phone Number</label>
                        <input id="phone" name="phone" type="tel" value="{{old('phone')}}" required class="appearance-none rounded-xl relative block w-full px-4 py-3 border border-white/10 bg-navy-900/50 placeholder-gray-500 text-white focus:outline-none focus:ring-1 focus:ring-gold-400 focus:border-gold-400 focus:z-10 sm:text-sm transition-colors" placeholder="E.g., +1234567890">
                        @error('phone')
                            <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Country -->
                    <div>
                        <label for="country" class="block text-sm font-medium text-gray-400 mb-1">Country</label>
                        <select id="country" name="country" required class="appearance-none rounded-xl relative block w-full px-4 py-3 border border-white/10 bg-navy-900/50 placeholder-gray-500 text-white focus:outline-none focus:ring-1 focus:ring-gold-400 focus:border-gold-400 focus:z-10 sm:text-sm transition-colors [&>option]:bg-navy-800">
                            <option value="">Select Your Country</option>
                            <option value="AF" {{ old('country') == 'AF' ? 'selected' : '' }}>Afghanistan</option>
                            <option value="AL" {{ old('country') == 'AL' ? 'selected' : '' }}>Albania</option>
                            <option value="DZ" {{ old('country') == 'DZ' ? 'selected' : '' }}>Algeria</option>
                            <option value="AR" {{ old('country') == 'AR' ? 'selected' : '' }}>Argentina</option>
                            <option value="AU" {{ old('country') == 'AU' ? 'selected' : '' }}>Australia</option>
                            <option value="AT" {{ old('country') == 'AT' ? 'selected' : '' }}>Austria</option>
                            <option value="BE" {{ old('country') == 'BE' ? 'selected' : '' }}>Belgium</option>
                            <option value="BR" {{ old('country') == 'BR' ? 'selected' : '' }}>Brazil</option>
                            <option value="CA" {{ old('country') == 'CA' ? 'selected' : '' }}>Canada</option>
                            <option value="CN" {{ old('country') == 'CN' ? 'selected' : '' }}>China</option>
                            <option value="FR" {{ old('country') == 'FR' ? 'selected' : '' }}>France</option>
                            <option value="DE" {{ old('country') == 'DE' ? 'selected' : '' }}>Germany</option>
                            <option value="IN" {{ old('country') == 'IN' ? 'selected' : '' }}>India</option>
                            <option value="IT" {{ old('country') == 'IT' ? 'selected' : '' }}>Italy</option>
                            <option value="JP" {{ old('country') == 'JP' ? 'selected' : '' }}>Japan</option>
                            <option value="MX" {{ old('country') == 'MX' ? 'selected' : '' }}>Mexico</option>
                            <option value="NL" {{ old('country') == 'NL' ? 'selected' : '' }}>Netherlands</option>
                            <option value="NZ" {{ old('country') == 'NZ' ? 'selected' : '' }}>New Zealand</option>
                            <option value="NG" {{ old('country') == 'NG' ? 'selected' : '' }}>Nigeria</option>
                            <option value="ZA" {{ old('country') == 'ZA' ? 'selected' : '' }}>South Africa</option>
                            <option value="ES" {{ old('country') == 'ES' ? 'selected' : '' }}>Spain</option>
                            <option value="SE" {{ old('country') == 'SE' ? 'selected' : '' }}>Sweden</option>
                            <option value="CH" {{ old('country') == 'CH' ? 'selected' : '' }}>Switzerland</option>
                            <option value="GB" {{ old('country') == 'GB' ? 'selected' : '' }}>United Kingdom</option>
                            <option value="US" {{ old('country') == 'US' ? 'selected' : '' }}>United States</option>
                            <option value="OTHER">Other</option>
                        </select>
                        @error('country')
                            <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-400 mb-1">Password</label>
                        <input id="password" name="password" type="password" required class="appearance-none rounded-xl relative block w-full px-4 py-3 border border-white/10 bg-navy-900/50 placeholder-gray-500 text-white focus:outline-none focus:ring-1 focus:ring-gold-400 focus:border-gold-400 focus:z-10 sm:text-sm transition-colors" placeholder="Enter your Password">
                        @error('password')
                            <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-400 mb-1">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required class="appearance-none rounded-xl relative block w-full px-4 py-3 border border-white/10 bg-navy-900/50 placeholder-gray-500 text-white focus:outline-none focus:ring-1 focus:ring-gold-400 focus:border-gold-400 focus:z-10 sm:text-sm transition-colors" placeholder="Retype Password">
                    </div>
                </div>

                <div class="flex items-center">
                    <input id="terms" name="agree" type="checkbox" value="1" required class="h-4 w-4 text-gold-400 focus:ring-gold-400 border-gray-300 rounded bg-navy-900">
                    <label for="terms" class="ml-2 block text-sm text-gray-400">
                        I agree to the <a href="{{ route('about') }}" class="text-gold-400 hover:text-gold-300">terms and conditions</a>
                    </label>
                </div>

                <div>
                    <button type="submit" name="create" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-xl text-navy-900 bg-gold-400 hover:bg-gold-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold-400 focus:ring-offset-navy-900 transition-colors shadow-lg shadow-gold-400/20">
                        Create Account
                    </button>
                </div>
            </form>
            
            <div class="text-center mt-6">
                <p class="text-sm text-gray-400">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="font-medium text-gold-400 hover:text-gold-300 transition-colors">Sign in</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        // Set the value of the hidden input from localStorage
        document.addEventListener('DOMContentLoaded', function() {
            const refInput = document.getElementById('refInput');
            const referralCode = localStorage.getItem('referralCode');
            if (referralCode) {
                refInput.value = referralCode;
            }
        });
    </script>
@endsection
