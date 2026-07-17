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
        Tambah Kategori Baru
     <?php $__env->endSlot(); ?>

    <div class="max-w-3xl">
        <p class="text-slate-500 mb-6">Lengkapi formulir di bawah ini dengan data yang valid.</p>
        <form action="<?php echo e(route('admin.categories.store')); ?>" method="POST" class="space-y-6">
            <?php echo csrf_field(); ?>
            <div>
                <label class="block mb-2 text-sm font-semibold text-slate-900">Nama Input</label>
                <input type="text" name="name" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition" placeholder="Masukkan sesuatu di sini..." required>
            </div>
            
            <div class="pt-4 flex items-center justify-start gap-3 border-t border-slate-100">
                <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-xl text-sm px-6 py-3 text-center transition shadow-sm">Simpan Perubahan</button>
                <a href="<?php echo e(route('admin.categories.index')); ?>" class="text-slate-600 bg-white hover:bg-slate-100 focus:ring-4 focus:outline-none focus:ring-slate-200 rounded-xl border border-slate-200 text-sm font-medium px-6 py-3 transition">Batal</a>
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
<?php endif; ?><?php /**PATH C:\laragon\www\Toko_Kita\resources\views/admin/categories/create.blade.php ENDPATH**/ ?>