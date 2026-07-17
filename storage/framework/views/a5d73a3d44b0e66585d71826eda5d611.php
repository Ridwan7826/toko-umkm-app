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
        Keranjang Belanja
     <?php $__env->endSlot(); ?>

    <div class="mb-6 flex justify-between items-center">
        <p class="text-slate-500">Kelola data Keranjang Belanja dengan mudah melalui tabel interaktif di bawah ini.</p>
        <a href="<?php echo e(route('public.products.index')); ?>" class="px-5 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition shadow-sm font-medium">+ Belanja Lagi</a>
    </div>
    
    <div class="overflow-x-auto relative shadow-sm rounded-xl border border-slate-200 mb-6">
        <table class="w-full text-sm text-left text-slate-500">
            <thead class="text-xs text-slate-700 uppercase bg-slate-50">
                <tr>
                    <th scope="col" class="py-4 px-6">Produk</th>
                    <th scope="col" class="py-4 px-6">Harga</th>
                    <th scope="col" class="py-4 px-6">Kuantitas</th>
                    <th scope="col" class="py-4 px-6">Subtotal</th>
                    <th scope="col" class="py-4 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php 
                        $price = $cart->variant ? $cart->variant->price : $cart->product->price;
                        $subtotal = $price * $cart->quantity;
                    ?>
                    <tr class="bg-white border-b hover:bg-slate-50 transition">
                        <td class="py-4 px-6 font-medium text-slate-900">
                            <?php echo e($cart->product->name); ?> 
                            <?php if($cart->variant): ?>
                                <span class="text-xs text-slate-500 block">Varian: <?php echo e($cart->variant->name); ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="py-4 px-6">Rp <?php echo e(number_format($price, 0, ',', '.')); ?></td>
                        <td class="py-4 px-6">
                            <form action="<?php echo e(route('buyer.cart.update', $cart->id)); ?>" method="POST" class="flex items-center gap-2">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <input type="number" name="quantity" value="<?php echo e($cart->quantity); ?>" min="1" class="w-16 rounded border-slate-300 text-sm">
                                <button type="submit" class="text-blue-600 hover:underline text-xs">Update</button>
                            </form>
                        </td>
                        <td class="py-4 px-6 font-semibold">Rp <?php echo e(number_format($subtotal, 0, ',', '.')); ?></td>
                        <td class="py-4 px-6 text-center">
                            <form action="<?php echo e(route('buyer.cart.destroy', $cart->id)); ?>" method="POST" onsubmit="return confirm('Hapus item ini?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="font-medium text-red-500 hover:text-red-700 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="py-8 px-6 text-center text-slate-500">Keranjang Anda kosong.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if($carts->count() > 0): ?>
    <div class="flex justify-end">
        <a href="<?php echo e(route('buyer.checkout.index')); ?>" class="px-6 py-3 bg-green-600 text-white rounded-xl hover:bg-green-700 transition shadow-sm font-medium">Lanjut ke Checkout</a>
    </div>
    <?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\Toko_Kita\resources\views\buyer\cart\index.blade.php ENDPATH**/ ?>