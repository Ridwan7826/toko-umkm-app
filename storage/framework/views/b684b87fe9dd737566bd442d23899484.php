<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-bold text-2xl text-blue-900 leading-tight border-l-4 border-yellow-500 pl-4">
            <?php echo e(__('Dashboard Administrator')); ?>

        </h2>
        <meta http-equiv="refresh" content="300">
     <?php $__env->endSlot(); ?>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Top Action Bar -->
            <div class="flex justify-between items-center bg-white p-4 rounded-lg shadow-sm border border-slate-200">
                <div class="text-sm text-slate-500 font-medium">
                    Ringkasan performa platform secara real-time.
                </div>
                <a href="<?php echo e(route('dashboard', ['refresh' => 1])); ?>" class="inline-flex items-center px-4 py-2 bg-blue-900 text-white rounded hover:bg-blue-800 transition text-sm font-semibold shadow-md border-b-2 border-blue-950">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    Segarkan Data
                </a>
            </div>

            <!-- Corporate KPI Cards -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- KPI 1 -->
                <div class="bg-gradient-to-br from-blue-900 to-blue-800 p-6 rounded-xl shadow-lg relative overflow-hidden group">
                    <div class="absolute right-0 top-0 w-32 h-32 bg-white opacity-5 rounded-full -mr-10 -mt-10 transform group-hover:scale-110 transition-transform"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-blue-100 text-sm font-semibold uppercase tracking-wider">Total Pendapatan</h3>
                            <div class="w-10 h-10 bg-blue-800/50 rounded-lg flex items-center justify-center text-yellow-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        </div>
                        <p class="text-3xl font-extrabold text-white">Rp <?php echo e(number_format($totalRevenue, 0, ',', '.')); ?></p>
                    </div>
                    <div class="absolute bottom-0 left-0 w-full h-1 bg-yellow-500"></div>
                </div>

                <!-- KPI 2 -->
                <div class="bg-white p-6 rounded-xl shadow-md border border-slate-200 relative overflow-hidden">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-slate-500 text-sm font-semibold uppercase tracking-wider">Pesanan Sukses</h3>
                        <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center text-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <p class="text-3xl font-extrabold text-slate-800"><?php echo e(number_format($totalOrders, 0, ',', '.')); ?></p>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-emerald-600 font-semibold flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                            Selesai diproses
                        </span>
                    </div>
                    <div class="absolute bottom-0 left-0 w-full h-1 bg-blue-600"></div>
                </div>

                <!-- KPI 3 -->
                <div class="bg-white p-6 rounded-xl shadow-md border border-slate-200 relative overflow-hidden">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-slate-500 text-sm font-semibold uppercase tracking-wider">Toko Terdaftar</h3>
                        <div class="w-10 h-10 bg-yellow-50 rounded-lg flex items-center justify-center text-yellow-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                    </div>
                    <p class="text-3xl font-extrabold text-slate-800"><?php echo e(number_format($totalShops, 0, ',', '.')); ?></p>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-blue-600 font-semibold flex items-center">
                            Terverifikasi & Aktif
                        </span>
                    </div>
                    <div class="absolute bottom-0 left-0 w-full h-1 bg-yellow-400"></div>
                </div>
            </div>

            <!-- Secondary KPI Cards -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- KPI 4: AOV -->
                <div class="bg-white p-6 rounded-xl shadow-md border border-slate-200 relative overflow-hidden">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-slate-500 text-sm font-semibold uppercase tracking-wider">Rata-rata Nilai Pesanan</h3>
                    </div>
                    <p class="text-3xl font-extrabold text-blue-600">Rp <?php echo e(number_format($aov, 0, ',', '.')); ?></p>
                    <div class="absolute bottom-0 left-0 w-full h-1 bg-blue-400"></div>
                </div>

                <!-- KPI 5: Cancel Rate -->
                <div class="bg-white p-6 rounded-xl shadow-md border border-slate-200 relative overflow-hidden">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-slate-500 text-sm font-semibold uppercase tracking-wider">Tingkat Pembatalan</h3>
                    </div>
                    <p class="text-3xl font-extrabold text-red-600"><?php echo e(number_format($cancelRate, 1, ',', '.')); ?>%</p>
                    <div class="absolute bottom-0 left-0 w-full h-1 bg-red-400"></div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- GMV Chart -->
                <div class="bg-white rounded-xl shadow-md border border-slate-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50 flex items-center justify-between">
                        <h3 class="font-bold text-blue-900">Tren Transaksi (GMV)</h3>
                        <span class="text-xs font-semibold bg-blue-100 text-blue-800 px-2 py-1 rounded">6 Bulan Terakhir</span>
                    </div>
                    <div class="p-6">
                        <canvas id="gmvChart" height="250"></canvas>
                    </div>
                </div>

                <!-- New Shops Chart -->
                <div class="bg-white rounded-xl shadow-md border border-slate-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50 flex items-center justify-between">
                        <h3 class="font-bold text-blue-900">Pertumbuhan Toko Baru</h3>
                        <span class="text-xs font-semibold bg-yellow-100 text-yellow-800 px-2 py-1 rounded">6 Bulan Terakhir</span>
                    </div>
                    <div class="p-6">
                        <canvas id="newShopsChart" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Corporate Colors
            const bankBlue = 'rgba(30, 58, 138, 0.8)'; // blue-900
            const bankBlueBorder = 'rgb(30, 58, 138)';
            const bankYellow = 'rgba(234, 179, 8, 0.2)'; // yellow-500
            const bankYellowBorder = 'rgb(234, 179, 8)';

            // GMV Bar Chart
            const gmvData = <?php echo json_encode($gmvTrend, 15, 512) ?>;
            const gmvLabels = Object.keys(gmvData);
            const gmvValues = Object.values(gmvData);
            
            new Chart(document.getElementById('gmvChart'), {
                type: 'bar',
                data: {
                    labels: gmvLabels,
                    datasets: [{
                        label: 'GMV (Rp)',
                        data: gmvValues,
                        backgroundColor: bankBlue,
                        borderColor: bankBlueBorder,
                        borderWidth: 1,
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });

            // New Shops Area Chart
            const newShopsData = <?php echo json_encode($newShopsTrend, 15, 512) ?>;
            const shopsLabels = Object.keys(newShopsData);
            const shopsValues = Object.values(newShopsData);

            new Chart(document.getElementById('newShopsChart'), {
                type: 'line',
                data: {
                    labels: shopsLabels,
                    datasets: [{
                        label: 'Toko Baru',
                        data: shopsValues,
                        backgroundColor: bankYellow,
                        borderColor: bankYellowBorder,
                        borderWidth: 2,
                        fill: true,
                        tension: 0.3,
                        pointBackgroundColor: bankYellowBorder
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: { beginAtZero: true, ticks: { stepSize: 1 } }
                    }
                }
            });
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\Toko_Kita\resources\views\admin\dashboard.blade.php ENDPATH**/ ?>