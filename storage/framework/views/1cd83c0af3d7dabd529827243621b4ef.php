<?php $__env->startSection('title', 'Laporan Penjualan Harian'); ?>

<?php $__env->startSection('content'); ?>
<div class="summary-box">
    <strong>Total Pendapatan (Gross):</strong> Rp <?php echo e(number_format($totalRevenue, 0, ',', '.')); ?><br>
    <strong>Total Pesanan Selesai:</strong> <?php echo e(number_format($totalOrders, 0, ',', '.')); ?> pesanan
</div>

<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th class="text-right">Total Pesanan</th>
            <th class="text-right">Pesanan Selesai</th>
            <th class="text-right">Pesanan Batal</th>
            <th class="text-right">Pendapatan Kotor</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $dailySales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e($index + 1); ?></td>
            <td><?php echo e(date('d F Y', strtotime($sale->date))); ?></td>
            <td class="text-right"><?php echo e($sale->total_orders); ?></td>
            <td class="text-right"><?php echo e($sale->completed_orders); ?></td>
            <td class="text-right"><?php echo e($sale->cancelled_orders); ?></td>
            <td class="text-right">Rp <?php echo e(number_format($sale->gross_revenue, 0, ',', '.')); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="6" class="text-center">Belum ada data penjualan harian untuk rentang waktu ini.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pdf.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Toko_Kita\resources\views\pdf\reports\penjualan.blade.php ENDPATH**/ ?>