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
        Beri Ulasan Produk
     <?php $__env->endSlot(); ?>

    <div class="bg-white p-6 shadow-sm rounded-xl max-w-2xl">
        <div class="mb-6 pb-6 border-b border-slate-100 flex items-center">
            <div>
                <h3 class="text-xl font-bold"><?php echo e($product->name); ?></h3>
                <p class="text-slate-500">Invoice: <?php echo e($order->invoice_number); ?></p>
            </div>
        </div>

        <form action="<?php echo e(route('buyer.reviews.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
            <input type="hidden" name="order_id" value="<?php echo e($order->id); ?>">

            <div class="mb-4">
                <label class="block font-medium text-slate-700 mb-2">Rating (1-5)</label>
                <select name="rating" class="w-full border-slate-300 rounded-xl shadow-sm focus:ring focus:ring-blue-200">
                    <option value="5">5 Bintang - Sangat Baik</option>
                    <option value="4">4 Bintang - Baik</option>
                    <option value="3">3 Bintang - Cukup</option>
                    <option value="2">2 Bintang - Buruk</option>
                    <option value="1">1 Bintang - Sangat Buruk</option>
                </select>
                <?php $__errorArgs = ['rating'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-6">
                <label class="block font-medium text-slate-700 mb-2">Komentar</label>
                <textarea name="comment" rows="4" class="w-full border-slate-300 rounded-xl shadow-sm focus:ring focus:ring-blue-200" placeholder="Tuliskan pengalaman Anda..."></textarea>
                <?php $__errorArgs = ['comment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition font-medium">Kirim Ulasan</button>
                <a href="<?php echo e(route('buyer.orders.show', $order->id)); ?>" class="px-5 py-2.5 bg-slate-200 text-slate-700 rounded-xl hover:bg-slate-300 transition font-medium">Batal</a>
            </div>
        </form>
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
<?php endif; ?>
<?php /**PATH C:\laragon\www\Toko_Kita\resources\views\buyer\reviews\create.blade.php ENDPATH**/ ?>