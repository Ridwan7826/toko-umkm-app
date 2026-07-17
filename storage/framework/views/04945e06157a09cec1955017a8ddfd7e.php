<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'TokoKita')); ?> - Autentikasi</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts & Tailwind -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <style>
        body { font-family: 'Outfit', sans-serif; }
        .hero-pattern {
            background-color: #0f172a; /* Slate 900 */
            background-image: radial-gradient(circle at 15% 50%, rgba(16, 185, 129, 0.15) 0, transparent 40%),
                              radial-gradient(circle at 85% 30%, rgba(37, 99, 235, 0.15) 0, transparent 40%);
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body class="antialiased text-slate-800 bg-white">
    <div class="min-h-screen flex bg-white">
        
        <!-- Left Side: Form Container -->
        <div class="w-full lg:w-[45%] flex flex-col justify-center px-8 sm:px-16 md:px-24 relative z-10 bg-white">
            <div class="w-full max-w-md mx-auto">
                <!-- Logo -->
                <div class="mb-12 text-center lg:text-left">
                    <a href="/" class="inline-flex items-center gap-3 hover:opacity-80 transition-opacity">
                        <div class="w-12 h-12 bg-slate-900 text-white rounded-xl flex items-center justify-center font-bold text-2xl shadow-lg">T</div>
                        <span class="text-3xl font-black tracking-tighter text-slate-900">Toko<span class="text-emerald-600">Kita</span></span>
                    </a>
                </div>
                
                <!-- Main Slot -->
                <?php echo e($slot); ?>

            </div>
            
            <!-- Footer -->
            <div class="absolute bottom-8 left-0 w-full text-center lg:text-left lg:px-24">
                <p class="text-xs text-slate-400 font-medium">&copy; <?php echo e(date('Y')); ?> TokoKita. Hak Cipta Dilindungi.</p>
            </div>
        </div>

        <!-- Right Side: Visual Image Cover -->
        <div class="hidden lg:flex lg:w-[55%] relative items-center justify-center overflow-hidden bg-slate-900">
            <!-- Background Image -->
            <div class="absolute inset-0 z-0">
                <img src="<?php echo e(asset('images/ecommerce_login_bg.png')); ?>" alt="TokoKita Professional E-Commerce" class="w-full h-full object-cover opacity-60 mix-blend-overlay">
                <!-- Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/60 to-transparent"></div>
            </div>
            
            <!-- Glassmorphism Content -->
            <div class="relative z-10 max-w-xl w-full p-12 bg-white/10 backdrop-blur-xl rounded-3xl border border-white/10 shadow-[0_8px_32px_0_rgba(0,0,0,0.3)] animate-float mx-12">
                <div class="w-16 h-16 bg-emerald-500 rounded-2xl flex items-center justify-center text-white mb-8 shadow-lg shadow-emerald-500/30">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h2 class="text-4xl font-extrabold text-white mb-6 leading-tight">Elevasi Bisnis Anda ke Level Profesional</h2>
                <p class="text-slate-200 leading-relaxed text-lg mb-8 font-light">
                    Sistem manajemen terintegrasi, laporan *real-time*, dan jaringan multi-vendor. TokoKita dirancang untuk pengusaha yang menginginkan lebih.
                </p>
                <div class="flex items-center gap-4 border-t border-white/20 pt-6 mt-6">
                    <div class="flex -space-x-3">
                        <img class="w-10 h-10 rounded-full border-2 border-slate-800 object-cover" src="https://i.pravatar.cc/100?img=11" alt="Avatar">
                        <img class="w-10 h-10 rounded-full border-2 border-slate-800 object-cover" src="https://i.pravatar.cc/100?img=12" alt="Avatar">
                        <img class="w-10 h-10 rounded-full border-2 border-slate-800 object-cover" src="https://i.pravatar.cc/100?img=13" alt="Avatar">
                        <div class="w-10 h-10 rounded-full border-2 border-slate-800 bg-slate-700 flex items-center justify-center text-xs text-white font-bold">+5k</div>
                    </div>
                    <span class="text-sm font-medium text-slate-300">Telah dipercaya oleh 5.000+ pengguna</span>
                </div>
            </div>
        </div>

    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\Toko_Kita\resources\views/layouts/guest.blade.php ENDPATH**/ ?>