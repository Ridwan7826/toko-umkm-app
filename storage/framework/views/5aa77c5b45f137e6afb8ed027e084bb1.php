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
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Dashboard Penjual')); ?>

        </h2>
        <!-- Meta refresh for real-time KPI 5 minutes -->
        <meta http-equiv="refresh" content="300">
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-4">
                <a href="<?php echo e(route('dashboard', ['refresh' => 1])); ?>" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition text-sm font-medium shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    Refresh Data
                </a>
            </div>
            <!-- KPI Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                    <h3 class="text-sm font-medium text-slate-500 uppercase">Total Pendapatan (30 Hari Terakhir)</h3>
                    <p class="text-2xl font-bold text-emerald-600 mt-2">Rp <?php echo e(number_format($totalRevenue30Days, 0, ',', '.')); ?></p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                    <h3 class="text-sm font-medium text-slate-500 uppercase">Rata-rata Nilai Pesanan</h3>
                    <p class="text-2xl font-bold text-blue-600 mt-2">Rp <?php echo e(number_format($aov, 0, ',', '.')); ?></p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                    <h3 class="text-sm font-medium text-slate-500 uppercase">Tingkat Pembatalan</h3>
                    <p class="text-2xl font-bold text-red-600 mt-2"><?php echo e(number_format($cancelRate, 1, ',', '.')); ?>%</p>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Line Chart: Revenue Trend -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                    <h3 class="text-md font-bold text-slate-800 mb-4">Tren Pendapatan - 30 Hari Terakhir</h3>
                    <canvas id="revenueChart" height="250"></canvas>
                </div>

                <!-- Pie Chart: Order Status -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                    <h3 class="text-md font-bold text-slate-800 mb-4">Komposisi Status Pesanan</h3>
                    <canvas id="orderStatusChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Line Chart: Revenue
            const revenueData = <?php echo json_encode($revenueTrend, 15, 512) ?>;
            const revenueLabels = Object.keys(revenueData);
            const revenueValues = Object.values(revenueData);
            
            new Chart(document.getElementById('revenueChart'), {
                type: 'line',
                data: {
                    labels: revenueLabels,
                    datasets: [{
                        label: 'Pendapatan Harian (Rp)',
                        data: revenueValues,
                        backgroundColor: 'rgba(16, 185, 129, 0.2)',
                        borderColor: 'rgb(16, 185, 129)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });

            // Pie Chart: Order Status
            const orderStatusData = <?php echo json_encode($orderStatusComposition, 15, 512) ?>;
            const statusLabels = Object.keys(orderStatusData).map(s => s.replace('_', ' ').toUpperCase());
            const statusValues = Object.values(orderStatusData);

            // Colorful palette
            const bgColors = [
                'rgba(245, 158, 11, 0.7)',  // Orange
                'rgba(59, 130, 246, 0.7)',  // Blue
                'rgba(139, 92, 246, 0.7)',  // Purple
                'rgba(16, 185, 129, 0.7)',  // Green
                'rgba(239, 68, 68, 0.7)',   // Red
                'rgba(107, 114, 128, 0.7)'  // Gray
            ];

            new Chart(document.getElementById('orderStatusChart'), {
                type: 'pie',
                data: {
                    labels: statusLabels,
                    datasets: [{
                        label: 'Jumlah Pesanan',
                        data: statusValues,
                        backgroundColor: bgColors.slice(0, statusValues.length),
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'bottom' }
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
<?php /**PATH C:\laragon\www\Toko_Kita\resources\views/seller/dashboard.blade.php ENDPATH**/ ?>