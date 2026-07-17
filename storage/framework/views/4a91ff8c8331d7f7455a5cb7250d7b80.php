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
        Daftar Toko UMKM
     <?php $__env->endSlot(); ?>

    <div class="mb-6 flex justify-between items-center">
        <p class="text-slate-500">Kelola data Daftar Toko UMKM dengan mudah melalui tabel interaktif di bawah ini.</p>
        <a href="#" class="px-5 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition shadow-sm font-medium">+ Tambah Data Baru</a>
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
                <!-- Dummy Row -->
                <tr class="bg-white border-b hover:bg-slate-50 transition">
                    <td class="py-4 px-6 font-semibold">#1029</td>
                    <td class="py-4 px-6 font-medium text-slate-900">Data Contoh Placeholder</td>
                    <td class="py-4 px-6"><span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Aktif</span></td>
                    <td class="py-4 px-6 text-center">
                        <a href="#" class="font-medium text-blue-600 hover:text-blue-800 hover:underline mr-3">Detail</a>
                        <a href="#" class="font-medium text-amber-500 hover:text-amber-700 hover:underline">Ubah</a>
                    </td>
                </tr>
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
<?php endif; ?><?php /**PATH C:\laragon\www\Toko_Kita\resources\views\admin\shops\index.blade.php ENDPATH**/ ?>