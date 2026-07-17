<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Analisis & Moderasi Ulasan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

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
                                @forelse($averageRatings as $prod)
                                    <tr class="border-b">
                                        <td class="px-4 py-3 font-medium text-gray-900">{{ $prod->name }}</td>
                                        <td class="px-4 py-3">{{ $prod->shop->name ?? '-' }}</td>
                                        <td class="px-4 py-3 text-yellow-500 font-bold">
                                            {{ number_format($prod->reviews_avg_rating, 1) }} ⭐
                                        </td>
                                        <td class="px-4 py-3">{{ $prod->reviews_count }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-3 text-center">Belum ada data ulasan.</td>
                                    </tr>
                                @endforelse
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
                            @forelse($pendingReviews as $review)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3">{{ $review->user->name }}</td>
                                    <td class="px-4 py-3">{{ $review->product->name }}</td>
                                    <td class="px-4 py-3 text-yellow-500">{{ str_repeat('⭐', $review->rating) }}</td>
                                    <td class="px-4 py-3 italic">"{{ $review->comment }}"</td>
                                    <td class="px-4 py-3 text-right space-x-2">
                                        <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="text-green-600 hover:text-green-900 font-medium">Setujui</button>
                                        </form>
                                        <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Tolak</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                        Hore! Tidak ada ulasan yang perlu dimoderasi.
                                    </td>
                                </tr>
                            @endforelse
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
            const distData = @json($ratingDistribution);
            
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
</x-app-layout>
