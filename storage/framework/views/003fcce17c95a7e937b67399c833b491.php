<?php $__env->startSection('title', 'Invoice Pembelian'); ?>

<?php $__env->startSection('content'); ?>
<div style="margin-bottom: 20px;">
    <strong>Invoice:</strong> <?php echo e($order->invoice_number); ?><br>
    <strong>Status:</strong> <?php echo e(strtoupper(str_replace('_', ' ', $order->status))); ?><br>
    <strong>Metode Pembayaran:</strong> <?php echo e($order->payment ? $order->payment->payment_type : 'Belum tersedia'); ?>

</div>

<div style="margin-bottom: 20px;">
    <div style="float: left; width: 48%;">
        <strong>Informasi Pembeli:</strong>
        <p style="margin: 5px 0;">
            <?php echo e($order->user->name); ?><br>
            <?php echo e($order->user->email); ?><br>
            <?php echo e($order->user->phone ?? 'Telepon belum diatur'); ?>

        </p>
    </div>
    <div style="float: right; width: 48%;">
        <strong>Informasi Pengiriman:</strong>
        <p style="margin: 5px 0;">
            Kurir: <?php echo e($order->courier_name ?? 'Belum ditentukan'); ?><br>
            Resi: <?php echo e($order->tracking_number ?? 'Belum ada resi'); ?><br>
        </p>
    </div>
    <div class="clear"></div>
</div>

<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Item Produk</th>
            <th class="text-center">Kuantitas</th>
            <th class="text-right">Harga Satuan</th>
            <th class="text-right">Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $order->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($index + 1); ?></td>
            <td>
                <strong><?php echo e($detail->variant->product->name); ?></strong><br>
                <span style="font-size: 11px; color: #666;">Varian: <?php echo e($detail->variant->name); ?> (SKU: <?php echo e($detail->variant->sku); ?>)</span>
            </td>
            <td class="text-center"><?php echo e($detail->quantity); ?></td>
            <td class="text-right">Rp <?php echo e(number_format($detail->price_per_unit, 0, ',', '.')); ?></td>
            <td class="text-right">Rp <?php echo e(number_format($detail->price_per_unit * $detail->quantity, 0, ',', '.')); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<div style="float: right; width: 40%;">
    <table style="border: none;">
        <tr>
            <td style="border: none; text-align: right; padding: 5px;">Total Harga Produk:</td>
            <td style="border: none; text-align: right; padding: 5px;">Rp <?php echo e(number_format($order->total_product_price, 0, ',', '.')); ?></td>
        </tr>
        <tr>
            <td style="border: none; text-align: right; padding: 5px;">Ongkos Kirim:</td>
            <td style="border: none; text-align: right; padding: 5px;">Rp <?php echo e(number_format($order->shipping_cost, 0, ',', '.')); ?></td>
        </tr>
        <tr>
            <td style="border: none; text-align: right; padding: 5px;"><strong>Total Tagihan:</strong></td>
            <td style="border: none; text-align: right; padding: 5px;"><strong>Rp <?php echo e(number_format($order->total_product_price + $order->shipping_cost, 0, ',', '.')); ?></strong></td>
        </tr>
    </table>
</div>
<div class="clear"></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pdf.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Toko_Kita\resources\views\pdf\invoice.blade.php ENDPATH**/ ?>