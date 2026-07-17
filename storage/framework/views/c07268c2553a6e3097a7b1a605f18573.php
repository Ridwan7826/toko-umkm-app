<?php $__env->startSection('title', 'Laporan 5 Produk Terlaris'); ?>

<?php $__env->startSection('content'); ?>
<div class="summary-box">
    <strong>Berdasarkan Kuantitas Terjual:</strong> Data berikut mengurutkan produk yang paling sering dibeli oleh pelanggan dan telah berstatus Selesai.
</div>

<table>
    <thead>
        <tr>
            <th>Peringkat</th>
            <th>Nama Produk (Varian)</th>
            <th>Nomor SKU</th>
            <th class="text-center">Total Unit Terjual</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $topProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td class="text-center">#<?php echo e($index + 1); ?></td>
            <td><strong><?php echo e($product['name']); ?></strong></td>
            <td><?php echo e($product['sku'] ?? 'N/A'); ?></td>
            <td class="text-center"><?php echo e($product['total_sold']); ?> Unit</td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="4" class="text-center">Belum ada data transaksi yang selesai untuk memeringkat produk.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pdf.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Toko_Kita\resources\views\pdf\reports\produk_terlaris.blade.php ENDPATH**/ ?>