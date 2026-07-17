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
        Daftar Pesanan Masuk
     <?php $__env->endSlot(); ?>

    <div class="mb-6 flex justify-between items-center">
        <p class="text-slate-500">Kelola data pesanan pelanggan untuk toko Anda di bawah ini.</p>
    </div>
    
    <div class="overflow-x-auto relative shadow-sm rounded-xl border border-slate-200">
        <table class="w-full text-sm text-left text-slate-500">
            <thead class="text-xs text-slate-700 uppercase bg-slate-50">
                <tr>
                    <th scope="col" class="py-4 px-6">Invoice</th>
                    <th scope="col" class="py-4 px-6">Pelanggan</th>
                    <th scope="col" class="py-4 px-6">Tanggal</th>
                    <th scope="col" class="py-4 px-6">Status</th>
                    <th scope="col" class="py-4 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="bg-white border-b hover:bg-slate-50 transition">
                    <td class="py-4 px-6 font-semibold"><?php echo e($order->invoice_number); ?></td>
                    <td class="py-4 px-6 font-medium text-slate-900"><?php echo e($order->user->name ?? '-'); ?></td>
                    <td class="py-4 px-6"><?php echo e($order->created_at->format('d M Y H:i')); ?></td>
                    <td class="py-4 px-6">
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold"><?php echo e(strtoupper(str_replace('_', ' ', $order->status))); ?></span>
                    </td>
                    <td class="py-4 px-6 text-center">
                        <a href="<?php echo e(route('seller.orders.show', $order->id)); ?>" class="font-medium text-blue-600 hover:text-blue-800 hover:underline mr-3">Detail</a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="py-8 px-6 text-center text-slate-500">Belum ada pesanan masuk.</td>
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
<?php endif; ?><?php /**PATH C:\laragon\www\Toko_Kita\resources\views\seller\orders\index.blade.php ENDPATH**/ ?>