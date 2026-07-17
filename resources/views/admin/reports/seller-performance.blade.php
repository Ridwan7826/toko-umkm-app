<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Performa Penjual (3 Bulan Terakhir)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Back Button -->
            <div class="mb-4">
                <a href="{{ route('admin.reports.index') }}" class="inline-flex items-center text-sm font-medium text-emerald-600 hover:text-emerald-800">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Dasbor Laporan
                </a>
            </div>

            <!-- Bar Chart -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Perbandingan Omzet Antar Penjual</h3>
                <div class="relative h-96 w-full">
                    <canvas id="sellerPerformanceChart"></canvas>
                </div>
            </div>

            <!-- Summary Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Ringkasan Performa</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-4 py-3">Peringkat</th>
                                <th class="px-4 py-3">Nama Toko</th>
                                <th class="px-4 py-3 text-right">Total Transaksi Selesai</th>
                                <th class="px-4 py-3 text-right">Total Omzet (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($performance as $index => $data)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 font-medium text-gray-900">#{{ $index + 1 }}</td>
                                    <td class="px-4 py-3 font-medium text-emerald-600">{{ $data->shop->name ?? 'Toko Tidak Ditemukan' }}</td>
                                    <td class="px-4 py-3 text-right">{{ number_format($data->total_orders) }}</td>
                                    <td class="px-4 py-3 text-right font-bold text-gray-900">Rp {{ number_format($data->total_revenue, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                                        Belum ada data transaksi dalam 3 bulan terakhir.
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
            const ctx = document.getElementById('sellerPerformanceChart').getContext('2d');
            const chartData = @json($chartData);
            
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'Total Omzet (Rp)',
                        data: chartData.data,
                        backgroundColor: 'rgba(16, 185, 129, 0.7)', // Emerald 500
                        borderColor: 'rgb(16, 185, 129)',
                        borderWidth: 1,
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value, index, values) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
