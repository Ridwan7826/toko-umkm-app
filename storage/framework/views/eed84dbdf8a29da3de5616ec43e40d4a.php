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
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                <?php echo e(__('Tambah Produk Baru')); ?>

            </h2>
            <a href="<?php echo e(route('seller.products.index')); ?>" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg hover:bg-slate-300 transition text-sm font-medium">
                Kembali
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <?php if($errors->any()): ?>
                <div class="mb-4 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg relative" role="alert">
                    <strong class="font-bold">Terjadi Kesalahan!</strong>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('seller.products.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    <!-- Informasi Utama -->
                    <div class="md:col-span-2">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 mb-6">
                            <h3 class="text-lg font-bold text-slate-800 mb-4 border-b pb-2">Informasi Produk</h3>
                            
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Nama Produk <span class="text-red-500">*</span></label>
                                <input type="text" name="name" id="name" value="<?php echo e(old('name')); ?>" required class="w-full border-slate-300 rounded-lg shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                            </div>

                            <div class="mb-4">
                                <label for="description" class="block text-sm font-medium text-slate-700 mb-1">Deskripsi <span class="text-red-500">*</span></label>
                                <textarea name="description" id="description" rows="5" required class="w-full border-slate-300 rounded-lg shadow-sm focus:border-emerald-500 focus:ring-emerald-500"><?php echo e(old('description')); ?></textarea>
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-2 mt-2">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="category_ids[]" value="<?php echo e($category->id); ?>" class="rounded border-slate-300 text-emerald-600 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50" <?php echo e(is_array(old('category_ids')) && in_array($category->id, old('category_ids')) ? 'checked' : ''); ?>>
                                        <span class="ml-2 text-sm text-slate-600"><?php echo e($category->name); ?></span>
                                    </label>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>

                        <!-- Varian Produk -->
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                            <div class="flex justify-between items-center border-b pb-2 mb-4">
                                <h3 class="text-lg font-bold text-slate-800">Varian Produk <span class="text-red-500">*</span></h3>
                                <button type="button" id="add-variant" class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-lg hover:bg-emerald-200 transition text-sm font-medium">
                                    + Tambah Varian
                                </button>
                            </div>
                            
                            <div id="variants-container">
                                <!-- Default Variant Row -->
                                <?php
                                    $oldVariants = old('variants', [
                                        [ 'name' => '', 'sku' => '', 'price' => '', 'weight' => '', 'stock' => '' ]
                                    ]);
                                ?>
                                
                                <?php $__currentLoopData = $oldVariants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="variant-row bg-slate-50 p-4 rounded-lg border border-slate-200 mb-4 relative">
                                    <?php if($index > 0): ?>
                                    <button type="button" class="remove-variant absolute top-2 right-2 text-red-500 hover:text-red-700">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                    <?php endif; ?>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-xs font-medium text-slate-700 mb-1">Nama Varian (Contoh: Warna Merah)</label>
                                            <input type="text" name="variants[<?php echo e($index); ?>][name]" value="<?php echo e($variant['name']); ?>" required class="w-full text-sm border-slate-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-700 mb-1">SKU (Opsional)</label>
                                            <input type="text" name="variants[<?php echo e($index); ?>][sku]" value="<?php echo e($variant['sku']); ?>" class="w-full text-sm border-slate-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-700 mb-1">Harga (Rp)</label>
                                            <input type="number" min="0" name="variants[<?php echo e($index); ?>][price]" value="<?php echo e($variant['price']); ?>" required class="w-full text-sm border-slate-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-700 mb-1">Berat (Gram)</label>
                                            <input type="number" min="1" name="variants[<?php echo e($index); ?>][weight]" value="<?php echo e($variant['weight']); ?>" required class="w-full text-sm border-slate-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-700 mb-1">Stok</label>
                                            <input type="number" min="0" name="variants[<?php echo e($index); ?>][stock]" value="<?php echo e($variant['stock']); ?>" required class="w-full text-sm border-slate-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Info -->
                    <div class="md:col-span-1">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 sticky top-6">
                            <h3 class="text-lg font-bold text-slate-800 mb-4 border-b pb-2">Gambar Utama</h3>
                            
                            <div class="mb-4">
                                <label for="image" class="block text-sm font-medium text-slate-700 mb-2">Unggah Foto (Maks 2MB)</label>
                                <input type="file" name="image" id="image" accept="image/jpeg, image/png, image/jpg" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 border border-slate-300 rounded-lg p-1">
                            </div>
                            
                            <div class="mt-8">
                                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                    Simpan Produk
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('variants-container');
            const addButton = document.getElementById('add-variant');
            let variantIndex = <?php echo e(count($oldVariants)); ?>;

            addButton.addEventListener('click', function() {
                const newRow = document.createElement('div');
                newRow.className = 'variant-row bg-slate-50 p-4 rounded-lg border border-slate-200 mb-4 relative';
                newRow.innerHTML = `
                    <button type="button" class="remove-variant absolute top-2 right-2 text-red-500 hover:text-red-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-slate-700 mb-1">Nama Varian</label>
                            <input type="text" name="variants[${variantIndex}][name]" required class="w-full text-sm border-slate-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-700 mb-1">SKU</label>
                            <input type="text" name="variants[${variantIndex}][sku]" class="w-full text-sm border-slate-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-700 mb-1">Harga (Rp)</label>
                            <input type="number" min="0" name="variants[${variantIndex}][price]" required class="w-full text-sm border-slate-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-700 mb-1">Berat (Gram)</label>
                            <input type="number" min="1" name="variants[${variantIndex}][weight]" required class="w-full text-sm border-slate-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-700 mb-1">Stok</label>
                            <input type="number" min="0" name="variants[${variantIndex}][stock]" required class="w-full text-sm border-slate-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        </div>
                    </div>
                `;
                container.appendChild(newRow);
                variantIndex++;
            });

            container.addEventListener('click', function(e) {
                if (e.target.closest('.remove-variant')) {
                    e.target.closest('.variant-row').remove();
                }
            });
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\Toko_Kita\resources\views\seller\products\create.blade.php ENDPATH**/ ?>