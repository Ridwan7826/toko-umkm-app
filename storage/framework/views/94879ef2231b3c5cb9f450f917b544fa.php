<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e(config('app.name', 'TokoKita')); ?> - Pusat Belanja UMKM</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Scripts & Tailwind -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .hero-pattern {
            background-color: #f8fafc;
            background-image: radial-gradient(circle at 100% 100%, rgba(16, 185, 129, 0.1) 0, transparent 50%), 
                              radial-gradient(circle at 0% 0%, rgba(37, 99, 235, 0.1) 0, transparent 50%);
        }
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body class="antialiased bg-slate-50 text-slate-800">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 glass transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-2 transition-transform hover:scale-105">
                    <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-blue-600 text-white rounded-xl flex items-center justify-center font-bold text-2xl shadow-lg shadow-emerald-500/30">T</div>
                    <span class="text-3xl font-extrabold tracking-tight text-slate-900">Toko<span class="text-emerald-600">Kita</span></span>
                </div>
                
                <div class="hidden md:flex space-x-8 items-center font-medium">
                    <a href="#fitur" class="text-slate-600 hover:text-emerald-600 transition">Fitur</a>
                    <a href="#tentang" class="text-slate-600 hover:text-emerald-600 transition">Tentang Kami</a>
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(url('/dashboard')); ?>" class="px-6 py-2.5 rounded-full bg-gradient-to-r from-emerald-500 to-blue-600 text-white font-semibold hover:shadow-lg hover:shadow-emerald-500/30 transition-all transform hover:-translate-y-0.5">
                            Dashboard
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="text-slate-700 hover:text-emerald-600 font-semibold transition">Masuk</a>
                        <?php if(Route::has('register')): ?>
                            <a href="<?php echo e(route('register')); ?>" class="px-6 py-2.5 rounded-full bg-gradient-to-r from-emerald-500 to-blue-600 text-white font-semibold hover:shadow-lg hover:shadow-emerald-500/30 transition-all transform hover:-translate-y-0.5">
                                Daftar Sekarang
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden hero-pattern min-h-screen flex items-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="text-center lg:text-left">
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-600 font-medium text-sm mb-6 animate-pulse">
                        <span class="flex w-2.5 h-2.5 bg-emerald-500 rounded-full mr-2"></span>
                        Platform E-Commerce Inovatif
                    </div>
                    <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight text-slate-900 leading-[1.1] mb-6">
                        Pusat Belanja & Pemberdayaan <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 to-blue-600">UMKM Nusantara</span>
                    </h1>
                    <p class="mt-4 text-lg md:text-xl text-slate-600 mb-8 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                        TokoKita membantu UMKM lokal berjualan secara online dengan mudah, profesional, dan jangkauan pasar yang lebih luas. Mari majukan ekonomi bangsa!
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(url('/dashboard')); ?>" class="px-8 py-4 rounded-full bg-gradient-to-r from-emerald-500 to-blue-600 text-white font-bold text-lg hover:shadow-xl hover:shadow-emerald-500/30 transition-all transform hover:-translate-y-1">
                                Masuk ke Dashboard
                            </a>
                        <?php else: ?>
                            <a href="<?php echo e(route('register')); ?>" class="px-8 py-4 rounded-full bg-gradient-to-r from-emerald-500 to-blue-600 text-white font-bold text-lg hover:shadow-xl hover:shadow-emerald-500/30 transition-all transform hover:-translate-y-1">
                                Mulai Berjualan
                            </a>
                            <a href="#fitur" class="px-8 py-4 rounded-full bg-white text-slate-700 font-bold text-lg border border-slate-200 hover:border-emerald-300 hover:bg-emerald-50 transition-all">
                                Pelajari Lebih Lanjut
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="hidden lg:block relative">
                    <!-- Abstract Hero Image / Composition -->
                    <div class="relative w-full aspect-square max-w-lg mx-auto animate-float">
                        <div class="absolute inset-0 bg-gradient-to-tr from-emerald-400 to-blue-500 rounded-[3rem] rotate-6 opacity-20 blur-2xl"></div>
                        <div class="absolute inset-0 bg-white rounded-[3rem] shadow-2xl overflow-hidden border border-white/50 flex flex-col p-6">
                            <!-- Mockup Header -->
                            <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-4">
                                <div class="w-24 h-4 bg-slate-200 rounded-full"></div>
                                <div class="flex gap-2">
                                    <div class="w-8 h-8 rounded-full bg-emerald-100"></div>
                                    <div class="w-8 h-8 rounded-full bg-blue-100"></div>
                                </div>
                            </div>
                            <!-- Mockup Grid -->
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div class="h-32 bg-slate-100 rounded-2xl p-4 flex flex-col justify-end">
                                    <div class="w-16 h-3 bg-slate-300 rounded-full mb-2"></div>
                                    <div class="w-24 h-4 bg-emerald-400 rounded-full"></div>
                                </div>
                                <div class="h-32 bg-slate-100 rounded-2xl p-4 flex flex-col justify-end">
                                    <div class="w-16 h-3 bg-slate-300 rounded-full mb-2"></div>
                                    <div class="w-24 h-4 bg-blue-400 rounded-full"></div>
                                </div>
                            </div>
                            <!-- Mockup Chart -->
                            <div class="flex-1 bg-gradient-to-t from-emerald-50 to-white rounded-2xl border border-emerald-100 relative overflow-hidden">
                                <svg class="absolute bottom-0 w-full h-24 text-emerald-500" preserveAspectRatio="none" viewBox="0 0 1440 320" fill="currentColor">
                                    <path d="M0,192L48,197.3C96,203,192,213,288,229.3C384,245,480,267,576,250.7C672,235,768,181,864,181.3C960,181,1056,235,1152,234.7C1248,235,1344,181,1392,154.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <section id="fitur" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-emerald-600 font-bold uppercase tracking-wider text-sm mb-2">Mengapa TokoKita?</h2>
                <h3 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">Fitur Unggulan untuk Kebutuhan Anda</h3>
                <p class="text-slate-500 text-lg">Platform kami dirancang khusus dengan memperhatikan kebutuhan UMKM dan kemudahan pengguna saat berbelanja.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-slate-50 rounded-3xl p-8 border border-slate-100 hover:shadow-xl hover:border-emerald-200 transition-all group">
                    <div class="w-14 h-14 bg-white rounded-2xl shadow-sm border border-emerald-100 flex items-center justify-center text-emerald-500 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Transaksi Cepat & Aman</h4>
                    <p class="text-slate-500 leading-relaxed">Sistem checkout dan pemrosesan pesanan yang mudah dengan standar keamanan terbaik.</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-slate-50 rounded-3xl p-8 border border-slate-100 hover:shadow-xl hover:border-blue-200 transition-all group">
                    <div class="w-14 h-14 bg-white rounded-2xl shadow-sm border border-blue-100 flex items-center justify-center text-blue-500 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Pelaporan Komprehensif</h4>
                    <p class="text-slate-500 leading-relaxed">Pantau perkembangan bisnis Anda dengan laporan analitik lengkap yang dapat diekspor ke PDF/Excel.</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-slate-50 rounded-3xl p-8 border border-slate-100 hover:shadow-xl hover:border-emerald-200 transition-all group">
                    <div class="w-14 h-14 bg-white rounded-2xl shadow-sm border border-emerald-100 flex items-center justify-center text-emerald-500 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Manajemen Pelanggan</h4>
                    <p class="text-slate-500 leading-relaxed">Pahami demografi pembeli Anda dan berikan apresiasi kepada pelanggan paling loyal.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 py-12 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center border-b border-slate-800 pb-8 mb-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-blue-600 text-white rounded-lg flex items-center justify-center font-bold text-lg shadow-lg">T</div>
                        <span class="text-2xl font-extrabold tracking-tight text-white">Toko<span class="text-emerald-500">Kita</span></span>
                    </div>
                    <p class="text-sm">Platform andalan untuk pertumbuhan UMKM di era digital.</p>
                </div>
                <div class="flex justify-center md:justify-end gap-6 md:col-span-2">
                    <a href="#" class="hover:text-emerald-400 transition">Tentang Kami</a>
                    <a href="#" class="hover:text-emerald-400 transition">Syarat & Ketentuan</a>
                    <a href="#" class="hover:text-emerald-400 transition">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-emerald-400 transition">Bantuan</a>
                </div>
            </div>
            <div class="text-center text-sm">
                &copy; <?php echo e(date('Y')); ?> TokoKita E-Commerce. All rights reserved. <br>
                Dibuat dengan ❤️ untuk UMKM Indonesia.
            </div>
        </div>
    </footer>
</body>
</html>
<?php /**PATH C:\laragon\www\Toko_Kita\resources\views/welcome.blade.php ENDPATH**/ ?>