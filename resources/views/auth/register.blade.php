<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-slate-900 mb-2">Buat Akun Baru ✨</h2>
        <p class="text-slate-500">Bergabunglah bersama kami dan mulai perjalanan Anda.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <input id="name" class="block w-full pl-10 px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-slate-50 focus:bg-white transition-colors" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Alamat Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <input id="email" class="block w-full pl-10 px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-slate-50 focus:bg-white transition-colors" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="nama@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Role -->
        <div>
            <label for="role" class="block text-sm font-medium text-slate-700 mb-1">Mendaftar Sebagai</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <select id="role" name="role" class="block w-full pl-10 px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-slate-50 focus:bg-white transition-colors" required>
                    <option value="pembeli" {{ old('role') == 'pembeli' ? 'selected' : '' }}>Pembeli - Saya ingin berbelanja</option>
                    <option value="penjual" {{ old('role') == 'penjual' ? 'selected' : '' }}>Penjual - Saya ingin buka toko</option>
                </select>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Kata Sandi</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <input id="password" class="block w-full pl-10 px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-slate-50 focus:bg-white transition-colors" type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1">Konfirmasi Kata Sandi</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <input id="password_confirmation" class="block w-full pl-10 px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-slate-50 focus:bg-white transition-colors" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi kata sandi" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg shadow-emerald-500/30 text-sm font-bold text-white bg-gradient-to-r from-emerald-500 to-blue-600 hover:from-emerald-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all transform hover:-translate-y-0.5">
                {{ __('Daftar Sekarang') }}
            </button>
        </div>

        <p class="text-center text-sm text-slate-600 mt-6">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="font-bold text-emerald-600 hover:text-emerald-500 transition-colors">Masuk di sini</a>
        </p>
    </form>
</x-guest-layout>
