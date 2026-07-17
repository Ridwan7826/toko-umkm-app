<x-guest-layout>
    <div class="mb-10">
        <h2 class="text-3xl lg:text-4xl font-extrabold text-slate-900 mb-3 tracking-tight">Selamat Datang 👋</h2>
        <p class="text-slate-500 text-lg">Masuk ke akun Anda untuk mengelola toko.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Alamat Email</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400 group-focus-within:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <input id="email" class="block w-full pl-12 px-4 py-3.5 border border-slate-300 rounded-xl text-slate-900 focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-500 bg-white transition-all shadow-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="nama@perusahaan.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-2">
                <label for="password" class="block text-sm font-semibold text-slate-700">Kata Sandi</label>
                @if (Route::has('password.request'))
                    <a class="text-sm font-bold text-emerald-600 hover:text-emerald-500 transition-colors" href="{{ route('password.request') }}">
                        Lupa sandi?
                    </a>
                @endif
            </div>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400 group-focus-within:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <input id="password" class="block w-full pl-12 px-4 py-3.5 border border-slate-300 rounded-xl text-slate-900 focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-500 bg-white transition-all shadow-sm" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center pt-2">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox" class="w-5 h-5 rounded border-slate-300 text-emerald-600 shadow-sm focus:ring-emerald-500 cursor-pointer transition-colors" name="remember">
                <span class="ml-3 text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">{{ __('Ingat sesi saya') }}</span>
            </label>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full flex justify-center py-4 px-4 border border-transparent rounded-xl shadow-lg shadow-emerald-500/30 text-base font-bold text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all transform hover:-translate-y-0.5">
                Masuk ke Dasbor
            </button>
        </div>
        
        @if (Route::has('register'))
            <p class="text-center text-sm font-medium text-slate-500 mt-8 pt-6 border-t border-slate-100">
                Belum memiliki akun? 
                <a href="{{ route('register') }}" class="font-bold text-emerald-600 hover:text-emerald-700 transition-colors">Daftar sebagai Penjual</a>
            </p>
        @endif
    </form>
</x-guest-layout>
