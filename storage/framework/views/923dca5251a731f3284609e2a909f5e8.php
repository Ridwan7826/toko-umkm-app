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
        Laporan Keseluruhan Platform
     <?php $__env->endSlot(); ?>

    <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="text-sm font-medium text-slate-500 uppercase">Total Pendapatan Platform</h3>
            <p class="text-2xl font-bold text-slate-900 mt-2">Rp <?php echo e(number_format($totalRevenue, 0, ',', '.')); ?></p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="text-sm font-medium text-slate-500 uppercase">Total Pesanan Selesai</h3>
            <p class="text-2xl font-bold text-slate-900 mt-2"><?php echo e(number_format($totalOrders, 0, ',', '.')); ?></p>
        </div>
    </div>
    
    <div class="mb-6 bg-white p-6 rounded-xl shadow-sm border border-slate-200 flex flex-col md:flex-row justify-between items-center">
        <div>
            <h3 class="text-md font-bold text-slate-800 mb-2">Laporan & Analitik Tambahan</h3>
            <p class="text-sm text-slate-500 mb-4 md:mb-0">Unduh data atau lihat grafik komparatif performa platform.</p>
        </div>
        <div class="flex gap-4">
            <a href="<?php echo e(route('admin.reports.seller-performance')); ?>" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition text-sm font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                Performa Penjual
            </a>
            <a href="<?php echo e(route('admin.reports.excel.transaksi-platform')); ?>" class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition text-sm font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Download Laporan (Excel)
            </a>
        </div>
    </div>
    
    <div class="overflow-x-auto relative shadow-sm rounded-xl border border-slate-200">
        <table class="w-full text-sm text-left text-slate-500">
            <thead class="text-xs text-slate-700 uppercase bg-slate-50">
                <tr>
                    <th scope="col" class="py-4 px-6">Tanggal</th>
                    <th scope="col" class="py-4 px-6">Toko</th>
                    <th scope="col" class="py-4 px-6 text-right">Pesanan (Semua)</th>
                    <th scope="col" class="py-4 px-6 text-right">Selesai</th>
                    <th scope="col" class="py-4 px-6 text-right">Batal</th>
                    <th scope="col" class="py-4 px-6 text-right">Pendapatan Kotor</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $dailySales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="bg-white border-b hover:bg-slate-50 transition">
                    <td class="py-4 px-6 font-semibold"><?php echo e($sale->date); ?></td>
                    <td class="py-4 px-6 font-medium text-slate-900"><?php echo e($sale->shop->name ?? 'Toko Tidak Ditemukan'); ?></td>
                    <td class="py-4 px-6 text-right"><?php echo e($sale->total_orders); ?></td>
                    <td class="py-4 px-6 text-right"><?php echo e($sale->completed_orders); ?></td>
                    <td class="py-4 px-6 text-right"><?php echo e($sale->cancelled_orders); ?></td>
                    <td class="py-4 px-6 text-right font-medium text-green-600">Rp <?php echo e(number_format($sale->gross_revenue, 0, ',', '.')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr class="bg-white border-b">
                    <td colspan="6" class="py-4 px-6 text-center text-slate-500">Belum ada data laporan harian.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\Toko_Kita\resources\views/admin/reports/index.blade.php ENDPATH**/ ?>