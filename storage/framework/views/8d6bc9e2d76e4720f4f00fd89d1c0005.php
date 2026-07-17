<?php $__env->startSection('title', 'Laporan Estimasi Pendapatan'); ?>

<?php $__env->startSection('content'); ?>
<div class="summary-box">
    <strong>Penjelasan Laba Bersih:</strong> Laba Bersih Estimasi dihitung berdasarkan Pendapatan Kotor dikurangi estimasi biaya platform (contoh: 5%). Pendapatan yang sebenarnya ditransfer mungkin memiliki potongan biaya layanan lain dari payment gateway.
</div>

<table>
    <thead>
        <tr>
            <th>Bulan</th>
            <th class="text-right">Total Pesanan</th>
            <th class="text-right">Pendapatan Kotor</th>
            <th class="text-right">Laba Bersih (Estimasi)</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $totalGross = 0;
            $totalNet = 0;
        ?>
        <?php $__empty_1 = true; $__currentLoopData = $monthlyRevenue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php
            $totalGross += $data['gross'];
            $totalNet += $data['estimated_net'];
        ?>
        <tr>
            <td><strong><?php echo e($month); ?></strong></td>
            <td class="text-right"><?php echo e(number_format($data['orders'], 0, ',', '.')); ?></td>
            <td class="text-right text-slate-600">Rp <?php echo e(number_format($data['gross'], 0, ',', '.')); ?></td>
            <td class="text-right font-medium text-green-600">Rp <?php echo e(number_format($data['estimated_net'], 0, ',', '.')); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="4" class="text-center">Belum ada rekapan pendapatan bulanan untuk toko ini.</td>
        </tr>
        <?php endif; ?>
    </tbody>
    <tfoot>
        <tr>
            <th>TOTAL KESELURUHAN</th>
            <th class="text-right">-</th>
            <th class="text-right">Rp <?php echo e(number_format($totalGross, 0, ',', '.')); ?></th>
            <th class="text-right">Rp <?php echo e(number_format($totalNet, 0, ',', '.')); ?></th>
        </tr>
    </tfoot>
</table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pdf.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Toko_Kita\resources\views\pdf\reports\estimasi_pendapatan.blade.php ENDPATH**/ ?>