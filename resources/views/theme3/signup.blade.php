@extends('theme3.layouts.app')

@section('content')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const refCode = urlParams.get('ref');
            if (refCode) {
                localStorage.setItem('referralCode', refCode);
            }
        });
    </script>

    <div class="hero min-h-screen flex items-center justify-center pt-28 pb-16 px-4">
        <div class="max-w-2xl w-full relative z-10" data-aos="zoom-in">

            <div class="glass-card rounded-3xl p-8 sm:p-10 border border-white/20 shadow-2xl backdrop-blur-2xl">
                
                <div class="text-center mb-8">
                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-[#f5df91] to-[#c5a028] text-xl font-bold text-[#111827] mb-4 shadow-lg shadow-[#d4af37]/20">
                        {{ strtoupper(substr(env('APP_NAME', 'L'), 0, 1)) }}
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-white tracking-tight">
                        Create an Account
                    </h2>
                    <p class="text-sm text-gray-400 mt-2">
                        Start your investment journey with {{ env('APP_NAME', 'Laravel') }}
                    </p>
                </div>

                @if(session('error'))
                    <div class="mb-5 rounded-xl border border-red-500/40 bg-red-500/10 p-4 text-center text-sm font-medium text-red-300">
                        {{ session('error') }}
                    </div>
                @endif

                <form class="space-y-5" action="{{ route('register.post') }}" method="POST" name="signupForm">
                    @csrf
                    <input type="hidden" name="ref" id="refInput" value="">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Full Name -->
                        <div>
                            <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-gray-300 mb-2">Full Name</label>
                            <input id="name" name="name" type="text" value="{{ old('name') }}" required
                                   class="w-full rounded-xl border border-white/15 bg-white/5 px-4 py-3 text-sm text-white placeholder-gray-500 transition focus:border-[#d4af37] focus:bg-white/10 focus:outline-none focus:ring-1 focus:ring-[#d4af37]"
                                   placeholder="Full Name">
                            @error('name')
                                <div class="mt-1 text-xs text-rose-400">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Username -->
                        <div>
                            <label for="username" class="block text-xs font-semibold uppercase tracking-wider text-gray-300 mb-2">Username</label>
                            <input id="username" name="username" type="text" value="{{ old('username') }}" required
                                   class="w-full rounded-xl border border-white/15 bg-white/5 px-4 py-3 text-sm text-white placeholder-gray-500 transition focus:border-[#d4af37] focus:bg-white/10 focus:outline-none focus:ring-1 focus:ring-[#d4af37]"
                                   placeholder="Username">
                            @error('username')
                                <div class="mt-1 text-xs text-rose-400">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-gray-300 mb-2">Email Address</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required
                                   class="w-full rounded-xl border border-white/15 bg-white/5 px-4 py-3 text-sm text-white placeholder-gray-500 transition focus:border-[#d4af37] focus:bg-white/10 focus:outline-none focus:ring-1 focus:ring-[#d4af37]"
                                   placeholder="Email address">
                            @error('email')
                                <div class="mt-1 text-xs text-rose-400">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Retype Email -->
                        <div>
                            <label for="email1" class="block text-xs font-semibold uppercase tracking-wider text-gray-300 mb-2">Confirm Email</label>
                            <input id="email1" name="email1" type="email" value="{{ old('email1') }}" required
                                   class="w-full rounded-xl border border-white/15 bg-white/5 px-4 py-3 text-sm text-white placeholder-gray-500 transition focus:border-[#d4af37] focus:bg-white/10 focus:outline-none focus:ring-1 focus:ring-[#d4af37]"
                                   placeholder="Confirm Email">
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <label for="phone" class="block text-xs font-semibold uppercase tracking-wider text-gray-300 mb-2">Phone Number</label>
                            <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" required
                                   class="w-full rounded-xl border border-white/15 bg-white/5 px-4 py-3 text-sm text-white placeholder-gray-500 transition focus:border-[#d4af37] focus:bg-white/10 focus:outline-none focus:ring-1 focus:ring-[#d4af37]"
                                   placeholder="+1 (555) 000-0000">
                            @error('phone')
                                <div class="mt-1 text-xs text-rose-400">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Country -->
                        <div>
                            <label for="country" class="block text-xs font-semibold uppercase tracking-wider text-gray-300 mb-2">Country</label>
                            <select id="country" name="country" required
                                    class="w-full rounded-xl border border-white/15 bg-[#0b1220] px-4 py-3 text-sm text-white focus:border-[#d4af37] focus:outline-none focus:ring-1 focus:ring-[#d4af37]">
                                <option value="">Select Country</option>
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
                                <div class="mt-1 text-xs text-rose-400">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-gray-300 mb-2">Password</label>
                            <input id="password" name="password" type="password" required
                                   class="w-full rounded-xl border border-white/15 bg-white/5 px-4 py-3 text-sm text-white placeholder-gray-500 transition focus:border-[#d4af37] focus:bg-white/10 focus:outline-none focus:ring-1 focus:ring-[#d4af37]"
                                   placeholder="Create password">
                            @error('password')
                                <div class="mt-1 text-xs text-rose-400">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-xs font-semibold uppercase tracking-wider text-gray-300 mb-2">Confirm Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                   class="w-full rounded-xl border border-white/15 bg-white/5 px-4 py-3 text-sm text-white placeholder-gray-500 transition focus:border-[#d4af37] focus:bg-white/10 focus:outline-none focus:ring-1 focus:ring-[#d4af37]"
                                   placeholder="Confirm password">
                        </div>
                    </div>

                    <div class="flex items-center pt-2">
                        <input id="terms" name="agree" type="checkbox" value="1" required class="h-4 w-4 rounded border-white/20 bg-white/10 text-[#d4af37] focus:ring-[#d4af37]">
                        <label for="terms" class="ml-2.5 block text-xs text-gray-300">
                            I agree to the <a href="{{ route('privacy') }}" class="text-[#f4d77a] hover:underline">Terms of Service & Privacy Policy</a>
                        </label>
                    </div>

                    <button type="submit" name="create" class="gold-button w-full rounded-xl py-3.5 text-sm font-bold text-[#111827] mt-3">
                        Create Account
                    </button>
                </form>

                <div class="mt-7 text-center border-t border-white/10 pt-5 text-sm text-gray-400">
                    Already registered? 
                    <a href="{{ route('login') }}" class="font-semibold text-[#f4d77a] hover:underline">
                        Sign in here
                    </a>
                </div>

            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const refInput = document.getElementById('refInput');
            const referralCode = localStorage.getItem('referralCode');
            if (referralCode && refInput) {
                refInput.value = referralCode;
            }
        });
    </script>
@endsection
