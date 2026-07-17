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
        Detail Transaksi & Invoice #<?php echo e($order->invoice_number); ?>

     <?php $__env->endSlot(); ?>

    <div class="mb-6 flex justify-between items-center">
        <a href="<?php echo e(route('buyer.orders.index')); ?>" class="text-blue-600 hover:underline flex items-center">
            &larr; Kembali ke Daftar Pesanan
        </a>
        <a href="<?php echo e(route('buyer.orders.invoice', $order->id)); ?>" target="_blank" class="px-5 py-2.5 bg-slate-800 text-white rounded-xl hover:bg-slate-900 transition shadow-sm font-medium flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            Cetak Invoice (PDF)
        </a>
    </div>

    <div class="bg-white p-6 shadow-sm rounded-xl mb-6">
        <h3 class="text-lg font-extrabold text-slate-900 mb-4 border-b pb-2">Status Pesanan: <span class="uppercase text-blue-600"><?php echo e($order->status); ?></span></h3>
        <p>Total: Rp <?php echo e(number_format($order->total_product_price + $order->shipping_cost, 0, ',', '.')); ?></p>
    </div>

    <div class="bg-white p-6 shadow-sm rounded-xl">
        <h3 class="text-lg font-extrabold text-slate-900 mb-4 border-b pb-2">Produk yang Dipesan</h3>
        <ul class="space-y-4">
            <?php $__currentLoopData = $order->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="flex justify-between items-center border-b pb-4">
                    <div>
                        <p class="font-bold"><?php echo e($detail->variant->product->name); ?> (<?php echo e($detail->variant->name); ?>)</p>
                        <p class="text-sm text-slate-500"><?php echo e($detail->quantity); ?> x Rp <?php echo e(number_format($detail->price_per_unit, 0, ',', '.')); ?></p>
                    </div>
                    <?php if($order->status === 'selesai'): ?>
                        <a href="<?php echo e(route('buyer.reviews.create', ['order_id' => $order->id, 'product_id' => $detail->variant->product_id])); ?>" class="px-4 py-2 bg-amber-500 text-white font-semibold rounded-lg hover:bg-amber-600 transition">Beri Ulasan</a>
                    <?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
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
<?php endif; ?><?php /**PATH C:\laragon\www\Toko_Kita\resources\views\buyer\orders\show.blade.php ENDPATH**/ ?>