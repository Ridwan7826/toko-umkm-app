<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TokoKita') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts & Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased font-sans" x-data="{ sidebarOpen: false }">

    @php
        $user = auth()->user();
        $role = $user->role ?? 'pembeli';
        $hasSidebar = in_array($role, ['admin', 'penjual']);
    @endphp

    <!-- 1. Top Navigation (Navbar) -->
    <nav class="fixed top-0 z-50 w-full bg-white/80 backdrop-blur-lg border-b border-slate-200 shadow-sm transition-all">
        <div class="px-4 py-3 lg:px-6">
            <div class="flex items-center justify-between">
                
                <!-- Left: Logo & Sidebar Toggle -->
                <div class="flex items-center justify-start">
                    @if($hasSidebar)
                    <button @click="sidebarOpen = !sidebarOpen" class="inline-flex items-center p-2 text-sm text-slate-500 rounded-lg sm:hidden hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-slate-200">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                           <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                        </svg>
                    </button>
                    @endif
                    <a href="/" class="flex ml-2 md:mr-24 items-center gap-2 transition-transform hover:scale-105">
                        <div class="w-9 h-9 bg-gradient-to-br from-emerald-500 to-blue-600 text-white rounded-xl flex items-center justify-center font-bold text-xl shadow-md">T</div>
                        <span class="self-center text-2xl font-extrabold whitespace-nowrap text-slate-900 tracking-tight">Toko<span class="text-emerald-600">Kita</span></span>
                    </a>
                </div>
                
                <!-- Right: Nav Menus & Profile -->
                <div class="flex items-center gap-4 lg:gap-6">
                    
                    <!-- Menus for Pembeli (No Sidebar) -->
                    @if(!$hasSidebar && $user)
                        <div class="hidden md:flex items-center gap-4">
                            <a href="{{ route('buyer.cart.index') }}" class="text-slate-600 hover:text-emerald-600 font-medium">Keranjang</a>
                            <a href="{{ route('buyer.orders.index') }}" class="text-slate-600 hover:text-emerald-600 font-medium">Pesanan Saya</a>
                            <a href="{{ route('buyer.reviews.index') }}" class="text-slate-600 hover:text-emerald-600 font-medium">Ulasan Saya</a>
                        </div>
                    @endif

                    <!-- Role Badge -->
                    @if($user)
                        <span class="hidden lg:inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700 capitalize border border-blue-200 shadow-inner">
                            Role: {{ $role }}
                        </span>
                    @endif
                    
                    <!-- Profile Dropdown (Alpine) -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-2 text-sm bg-white rounded-full focus:ring-4 focus:ring-slate-200 p-1 border border-slate-200 shadow-sm hover:shadow-md transition">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-slate-700 bg-slate-200">
                                {{ substr($user->name ?? 'G', 0, 1) }}
                            </div>
                            <span class="hidden md:block font-medium text-slate-700 mr-2">{{ explode(' ', $user->name ?? 'Guest')[0] }}</span>
                        </button>
                        
                        <!-- Dropdown menu -->
                        <div x-show="open" @click.away="open = false" x-transition class="z-50 absolute right-0 mt-2 w-52 text-base list-none bg-white divide-y divide-slate-100 rounded-xl shadow-xl ring-1 ring-black ring-opacity-5" style="display: none;">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm font-bold text-slate-900" role="none">
                                    {{ $user->name ?? 'Guest User' }}
                                </p>
                                <p class="text-xs font-medium text-slate-500 truncate" role="none">
                                    {{ $user->email ?? '' }}
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                @if($user)
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 font-medium" role="menuitem">Sign out</button>
                                    </form>
                                </li>
                                @else
                                <li><a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Log in</a></li>
                                <li><a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Register</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- 2. Sidebar (For Admin & Penjual) -->
    @if($hasSidebar)
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform bg-white border-r border-slate-200 sm:translate-x-0 shadow-sm" aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
            <ul class="space-y-2 font-medium">
                @if($role === 'admin')
                    <li>
                        <a href="{{ route('dashboard') }}" class="flex items-center p-3 text-slate-700 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 group transition">
                            <span class="ml-3">Dashboard Admin</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.index') }}" class="flex items-center p-3 text-slate-700 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 group transition">
                            <span class="ml-3">Kategori Produk</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.shops.index') }}" class="flex items-center p-3 text-slate-700 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 group transition">
                            <span class="ml-3">Manajemen Toko UMKM</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.reports.index') }}" class="flex items-center p-3 text-slate-700 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 group transition">
                            <span class="ml-3">Laporan Platform</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.reviews.index') }}" class="flex items-center p-3 text-slate-700 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 group transition">
                            <span class="ml-3">Analisis Ulasan</span>
                        </a>
                    </li>
                @elseif($role === 'penjual')
                    <li>
                        <a href="{{ route('dashboard') }}" class="flex items-center p-3 text-slate-700 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 group transition">
                            <span class="ml-3">Dashboard Toko</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('seller.products.index') }}" class="flex items-center p-3 text-slate-700 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 group transition">
                            <span class="ml-3">Katalog Produk</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('seller.orders.index') }}" class="flex items-center p-3 text-slate-700 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 group transition">
                            <span class="ml-3">Pesanan Masuk</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('seller.shop.index') }}" class="flex items-center p-3 text-slate-700 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 group transition">
                            <span class="ml-3">Pengaturan Toko</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('seller.reports.index') }}" class="flex items-center p-3 text-slate-700 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 group transition">
                            <span class="ml-3">Laporan Penjualan</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </aside>
    @endif

    <!-- 3. Main Content Area -->
    <div class="p-4 {{ $hasSidebar ? 'sm:ml-64' : 'max-w-7xl mx-auto' }} mt-16 min-h-[calc(100vh-8rem)]">
        
        <!-- 4. Flash Message Notifications -->
        @if(session('success'))
            <div class="p-4 mb-6 text-sm text-green-800 rounded-xl bg-green-50 border border-green-200 shadow-sm" role="alert">
                <span class="font-bold">Berhasil!</span> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="p-4 mb-6 text-sm text-red-800 rounded-xl bg-red-50 border border-red-200 shadow-sm" role="alert">
                <span class="font-bold">Gagal!</span> {{ session('error') }}
            </div>
        @endif

        <!-- Page Heading (Passed from views) -->
        @if (isset($header))
            <header class="mb-8">
                <div class="text-3xl font-extrabold text-slate-900 tracking-tight">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Main Yield/Slot -->
        <main class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            {{ $slot }}
        </main>
    </div>

    <!-- 5. Footer -->
    <footer class="bg-white border-t border-slate-200 mt-auto {{ $hasSidebar ? 'sm:ml-64' : '' }}">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-sm text-slate-500 font-medium">
                &copy; {{ date('Y') }} TokoKita E-Commerce. All rights reserved. <br>
                <span class="text-xs text-slate-400 font-normal">Sistem Pemberdayaan UMKM Indonesia</span>
            </p>
        </div>
    </footer>

</body>
</html>
