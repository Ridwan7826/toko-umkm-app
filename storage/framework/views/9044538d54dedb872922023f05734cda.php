<?php $__env->startSection('title', 'Laporan 10 Pelanggan Loyal'); ?>

<?php $__env->startSection('content'); ?>
<div class="summary-box">
    <strong>Daftar Top Spender:</strong> Data berikut menampilkan 10 pembeli teratas yang memiliki total pembelanjaan (termasuk ongkir) tertinggi di toko Anda pada pesanan yang telah selesai.
</div>

<table>
    <thead>
        <tr>
            <th>Peringkat</th>
            <th>Nama Pelanggan</th>
            <th>Email</th>
            <th class="text-center">Total Pesanan</th>
            <th class="text-right">Total Belanja (Spent)</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $topCustomers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td class="text-center">#<?php echo e($index + 1); ?></td>
            <td><strong><?php echo e($customer->user->name); ?></strong></td>
            <td><?php echo e($customer->user->email); ?></td>
            <td class="text-center"><?php echo e($customer->total_orders); ?> x</td>
            <td class="text-right">Rp <?php echo e(number_format($customer->total_spent, 0, ',', '.')); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="5" class="text-center">Belum ada pelanggan dengan pesanan berstatus Selesai.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pdf.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Toko_Kita\resources\views\pdf\reports\pelanggan_loyal.blade.php ENDPATH**/ ?>