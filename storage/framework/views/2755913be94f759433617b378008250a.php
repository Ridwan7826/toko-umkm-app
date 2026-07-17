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
        Daftar Produk Favorit
     <?php $__env->endSlot(); ?>

    <div class="mb-6">
        <p class="text-slate-500">Kelola data Daftar Produk Favorit dengan mudah melalui tabel interaktif di bawah ini.</p>
    </div>
    
    <?php if(session('success')): ?>
        <div class="mb-4 p-4 text-green-700 bg-green-100 rounded-lg">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="overflow-x-auto relative shadow-sm rounded-xl border border-slate-200">
        <table class="w-full text-sm text-left text-slate-500">
            <thead class="text-xs text-slate-700 uppercase bg-slate-50">
                <tr>
                    <th scope="col" class="py-4 px-6">ID Produk</th>
                    <th scope="col" class="py-4 px-6">Nama Produk</th>
                    <th scope="col" class="py-4 px-6 text-center">Aksi (Opsi)</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $wishlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wishlist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="bg-white border-b hover:bg-slate-50 transition">
                    <td class="py-4 px-6 font-semibold">#<?php echo e($wishlist->product->id); ?></td>
                    <td class="py-4 px-6 font-medium text-slate-900"><?php echo e($wishlist->product->name); ?></td>
                    <td class="py-4 px-6 text-center">
                        <a href="<?php echo e(route('public.products.show', $wishlist->product->id)); ?>" class="font-medium text-blue-600 hover:text-blue-800 hover:underline mr-3">Detail</a>
                        <form action="<?php echo e(route('buyer.wishlist.destroy', $wishlist->id)); ?>" method="POST" class="inline-block">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="font-medium text-red-500 hover:text-red-700 hover:underline" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini dari daftar favorit?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr class="bg-white border-b">
                    <td colspan="3" class="py-4 px-6 text-center text-slate-500">Belum ada produk favorit.</td>
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
<?php endif; ?><?php /**PATH C:\laragon\www\Toko_Kita\resources\views\buyer\wishlist\index.blade.php ENDPATH**/ ?>