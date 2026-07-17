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
        Katalog Produk Saya
     <?php $__env->endSlot(); ?>

    <div class="mb-6 flex justify-between items-center">
        <p class="text-slate-500">Kelola data Katalog Produk Saya dengan mudah melalui tabel interaktif di bawah ini.</p>
        <a href="<?php echo e(route('seller.products.create')); ?>" class="px-5 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition shadow-sm font-medium">+ Tambah Data Baru</a>
    </div>

    <div class="mb-6 bg-white p-4 rounded-xl shadow-sm border border-slate-200">
        <form action="<?php echo e(route('seller.products.index')); ?>" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <label for="search" class="block text-sm font-medium text-slate-700">Cari Produk</label>
                <input type="text" name="search" id="search" value="<?php echo e(request('search')); ?>" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="Nama produk...">
            </div>
            <div class="w-full md:w-48">
                <label for="category_id" class="block text-sm font-medium text-slate-700">Kategori</label>
                <select name="category_id" id="category_id" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    <option value="">Semua Kategori</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>" <?php echo e(request('category_id') == $category->id ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="w-full md:w-32">
                <label for="min_price" class="block text-sm font-medium text-slate-700">Harga Min</label>
                <input type="number" name="min_price" id="min_price" value="<?php echo e(request('min_price')); ?>" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="0">
            </div>
            <div class="w-full md:w-32">
                <label for="max_price" class="block text-sm font-medium text-slate-700">Harga Max</label>
                <input type="number" name="max_price" id="max_price" value="<?php echo e(request('max_price')); ?>" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="100000">
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full md:w-auto px-4 py-2 bg-slate-800 text-white rounded-md hover:bg-slate-700 transition">Filter</button>
                <a href="<?php echo e(route('seller.products.index')); ?>" class="ml-2 w-full md:w-auto px-4 py-2 bg-slate-200 text-slate-700 rounded-md hover:bg-slate-300 transition text-center">Reset</a>
            </div>
        </form>
    </div>
    
    <div class="overflow-x-auto relative shadow-sm rounded-xl border border-slate-200">
        <table class="w-full text-sm text-left text-slate-500">
            <thead class="text-xs text-slate-700 uppercase bg-slate-50">
                <tr>
                    <th scope="col" class="py-4 px-6">ID</th>
                    <th scope="col" class="py-4 px-6">Nama / Identitas</th>
                    <th scope="col" class="py-4 px-6">Status / Keterangan</th>
                    <th scope="col" class="py-4 px-6 text-center">Aksi (Opsi)</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="bg-white border-b hover:bg-slate-50 transition">
                    <td class="py-4 px-6 font-semibold">#<?php echo e($product->id); ?></td>
                    <td class="py-4 px-6 font-medium text-slate-900"><?php echo e($product->name); ?></td>
                    <td class="py-4 px-6">
                        <?php if($product->deleted_at): ?>
                            <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">Non-Aktif</span>
                        <?php else: ?>
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Aktif</span>
                        <?php endif; ?>
                    </td>
                    <td class="py-4 px-6 text-center">
                        <a href="<?php echo e(route('seller.products.show', $product->id)); ?>" class="font-medium text-blue-600 hover:text-blue-800 hover:underline mr-3">Detail</a>
                        <a href="<?php echo e(route('seller.products.edit', $product->id)); ?>" class="font-medium text-amber-500 hover:text-amber-700 hover:underline mr-3">Ubah</a>
                        <form action="<?php echo e(route('seller.products.destroy', $product->id)); ?>" method="POST" class="inline-block" x-data @submit.prevent="if(confirm('Apakah Anda yakin ingin menghapus produk ini?')) $el.submit()">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="font-medium text-red-600 hover:text-red-800 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="4" class="py-4 px-6 text-center text-slate-500">Tidak ada produk yang ditemukan.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
        <?php echo e($products->links()); ?>

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
<?php endif; ?><?php /**PATH C:\laragon\www\Toko_Kita\resources\views\seller\products\index.blade.php ENDPATH**/ ?>