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
        Edit Profil Toko
     <?php $__env->endSlot(); ?>

    <div class="max-w-3xl">
        <p class="text-slate-500 mb-6">Lengkapi formulir di bawah ini dengan data yang valid.</p>
        
        <?php if(session('success')): ?>
            <div class="mb-4 px-4 py-3 bg-green-100 text-green-800 rounded-xl font-medium">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('seller.shop.update', $shop->id)); ?>" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            
            <div>
                <label class="block mb-2 text-sm font-semibold text-slate-900">Nama Toko</label>
                <input type="text" name="name" value="<?php echo e(old('name', $shop->name)); ?>" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition" required>
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-slate-900">Deskripsi Toko</label>
                <textarea name="description" rows="4" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition"><?php echo e(old('description', $shop->description)); ?></textarea>
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-slate-900">Alamat</label>
                <textarea name="address" rows="3" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition"><?php echo e(old('address', $shop->address)); ?></textarea>
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-slate-900">Logo Toko</label>
                <?php if($shop->logo): ?>
                    <div class="mb-3">
                        <img src="<?php echo e(asset('storage/' . $shop->logo)); ?>" alt="Logo Toko" class="w-32 h-32 object-cover rounded-xl border border-slate-200">
                    </div>
                <?php endif; ?>
                <input type="file" name="logo" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition">
            </div>
            
            <div class="pt-4 flex items-center justify-start gap-3 border-t border-slate-100">
                <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-xl text-sm px-6 py-3 text-center transition shadow-sm">Simpan Perubahan</button>
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
<?php endif; ?><?php /**PATH C:\laragon\www\Toko_Kita\resources\views\seller\shop\edit.blade.php ENDPATH**/ ?>