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
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Analisis & Moderasi Ulasan')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <?php if(session('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Chart Distribusi -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Distribusi Rating (Bintang)</h3>
                    <canvas id="ratingChart" height="200"></canvas>
                </div>

                <!-- Tabel Rata-rata per Produk -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Rata-Rata Rating per Produk</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3">Produk</th>
                                    <th class="px-4 py-3">Toko</th>
                                    <th class="px-4 py-3">Rata-rata</th>
                                    <th class="px-4 py-3">Jumlah Ulasan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $averageRatings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr class="border-b">
                                        <td class="px-4 py-3 font-medium text-gray-900"><?php echo e($prod->name); ?></td>
                                        <td class="px-4 py-3"><?php echo e($prod->shop->name ?? '-'); ?></td>
                                        <td class="px-4 py-3 text-yellow-500 font-bold">
                                            <?php echo e(number_format($prod->reviews_avg_rating, 1)); ?> ⭐
                                        </td>
                                        <td class="px-4 py-3"><?php echo e($prod->reviews_count); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="4" class="px-4 py-3 text-center">Belum ada data ulasan.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Moderasi Ulasan Terbaru -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Ulasan Menunggu Moderasi</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-4 py-3">Pembeli</th>
                                <th class="px-4 py-3">Produk</th>
                                <th class="px-4 py-3">Rating</th>
                                <th class="px-4 py-3">Komentar</th>
                                <th class="px-4 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $pendingReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3"><?php echo e($review->user->name); ?></td>
                                    <td class="px-4 py-3"><?php echo e($review->product->name); ?></td>
                                    <td class="px-4 py-3 text-yellow-500"><?php echo e(str_repeat('⭐', $review->rating)); ?></td>
                                    <td class="px-4 py-3 italic">"<?php echo e($review->comment); ?>"</td>
                                    <td class="px-4 py-3 text-right space-x-2">
                                        <form action="<?php echo e(route('admin.reviews.update', $review->id)); ?>" method="POST" class="inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="text-green-600 hover:text-green-900 font-medium">Setujui</button>
                                        </form>
                                        <form action="<?php echo e(route('admin.reviews.update', $review->id)); ?>" method="POST" class="inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Tolak</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                        Hore! Tidak ada ulasan yang perlu dimoderasi.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('ratingChart').getContext('2d');
            const distData = <?php echo json_encode($ratingDistribution, 15, 512) ?>;
            
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['1 Bintang', '2 Bintang', '3 Bintang', '4 Bintang', '5 Bintang'],
                    datasets: [{
                        label: 'Jumlah Ulasan',
                        data: [distData[1], distData[2], distData[3], distData[4], distData[5]],
                        backgroundColor: [
                            'rgba(239, 68, 68, 0.7)', // 1 - Red
                            'rgba(249, 115, 22, 0.7)', // 2 - Orange
                            'rgba(234, 179, 8, 0.7)',  // 3 - Yellow
                            'rgba(132, 204, 22, 0.7)', // 4 - Lime
                            'rgba(34, 197, 94, 0.7)'   // 5 - Green
                        ],
                        borderColor: [
                            'rgb(239, 68, 68)',
                            'rgb(249, 115, 22)',
                            'rgb(234, 179, 8)',
                            'rgb(132, 204, 22)',
                            'rgb(34, 197, 94)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
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
<?php endif; ?>
<?php /**PATH C:\laragon\www\Toko_Kita\resources\views/admin/reviews/index.blade.php ENDPATH**/ ?>