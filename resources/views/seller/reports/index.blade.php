<x-app-layout>
    <x-slot name="header">
        Laporan Penjualan Toko
    </x-slot>

    <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="text-sm font-medium text-slate-500 uppercase">Total Pendapatan Anda</h3>
            <p class="text-2xl font-bold text-slate-900 mt-2">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="text-sm font-medium text-slate-500 uppercase">Total Pesanan Selesai</h3>
            <p class="text-2xl font-bold text-slate-900 mt-2">{{ number_format($totalOrders, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Chart Produk Terlaris -->
    <div class="mb-6 bg-white p-6 rounded-xl shadow-sm border border-slate-200">
        <h3 class="text-md font-bold text-slate-800 mb-4">Laporan Produk Terlaris (Top 5)</h3>
        <div class="w-full relative" style="height: 300px;">
            <canvas id="topProductsChart"></canvas>
        </div>
    </div>

    <div class="mb-6 bg-white p-6 rounded-xl shadow-sm border border-slate-200">
        <h3 class="text-md font-bold text-slate-800 mb-4">Filter Laporan</h3>
        <form action="{{ route('seller.reports.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4 items-end">
            <div class="w-full sm:w-auto flex-1">
                <label for="start_date" class="block text-sm font-medium text-slate-700 mb-1">Tanggal Mulai</label>
                <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" class="w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
            </div>
            <div class="w-full sm:w-auto flex-1">
                <label for="end_date" class="block text-sm font-medium text-slate-700 mb-1">Tanggal Akhir</label>
                <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" class="w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
            </div>
            <div class="w-full sm:w-auto flex gap-2">
                <button type="submit" class="px-4 py-2 bg-slate-800 text-white rounded-lg hover:bg-slate-700 transition">Terapkan</button>
                <a href="{{ route('seller.reports.index') }}" class="px-4 py-2 bg-white border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition">Reset</a>
            </div>
        </form>
    </div>

    <div class="mb-6 bg-white p-6 rounded-xl shadow-sm border border-slate-200">
        <h3 class="text-md font-bold text-slate-800 mb-4">Cetak Laporan (PDF)</h3>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('seller.reports.pdf.penjualan', request()->query()) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Laporan Penjualan
            </a>
            <a href="{{ route('seller.reports.pdf.produk-terlaris', request()->query()) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition text-sm font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Produk Terlaris
            </a>
            <a href="{{ route('seller.reports.pdf.estimasi-pendapatan', request()->query()) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition text-sm font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Estimasi Pendapatan
            </a>
            <a href="{{ route('seller.reports.pdf.pelanggan-loyal', request()->query()) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition text-sm font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Pelanggan Loyal
            </a>
        </div>
    </div>
    
    <div class="mb-6 bg-white p-6 rounded-xl shadow-sm border border-slate-200">
        <h3 class="text-md font-bold text-slate-800 mb-4">Ekspor Laporan (Excel)</h3>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('seller.reports.excel.penjualan', request()->query()) }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition text-sm font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Laporan Penjualan Keseluruhan
            </a>
            <a href="{{ route('seller.reports.excel.stok-menipis', request()->query()) }}" class="inline-flex items-center px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition text-sm font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Stok Produk Menipis
            </a>
            <a href="{{ route('seller.reports.excel.pembatalan', request()->query()) }}" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Pembatalan Pesanan
            </a>
        </div>
    </div>
    
    <div class="overflow-x-auto relative shadow-sm rounded-xl border border-slate-200">
        <table class="w-full text-sm text-left text-slate-500">
            <thead class="text-xs text-slate-700 uppercase bg-slate-50">
                <tr>
                    <th scope="col" class="py-4 px-6">Tanggal</th>
                    <th scope="col" class="py-4 px-6 text-right">Pesanan (Semua)</th>
                    <th scope="col" class="py-4 px-6 text-right">Selesai</th>
                    <th scope="col" class="py-4 px-6 text-right">Batal</th>
                    <th scope="col" class="py-4 px-6 text-right">Pendapatan Kotor</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dailySales as $sale)
                <tr class="bg-white border-b hover:bg-slate-50 transition">
                    <td class="py-4 px-6 font-semibold">{{ $sale->date }}</td>
                    <td class="py-4 px-6 text-right">{{ $sale->total_orders }}</td>
                    <td class="py-4 px-6 text-right">{{ $sale->completed_orders }}</td>
                    <td class="py-4 px-6 text-right">{{ $sale->cancelled_orders }}</td>
                    <td class="py-4 px-6 text-right font-medium text-green-600">Rp {{ number_format($sale->gross_revenue, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr class="bg-white border-b">
                    <td colspan="5" class="py-4 px-6 text-center text-slate-500">Belum ada data laporan harian toko Anda.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const topProductsData = @json($topProducts);
            
            const labels = topProductsData.map(item => item.name);
            const data = topProductsData.map(item => item.total_sold);
            
            new Chart(document.getElementById('topProductsChart'), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Terjual (Kuantitas)',
                        data: data,
                        backgroundColor: 'rgba(59, 130, 246, 0.7)',
                        borderColor: 'rgb(59, 130, 246)',
                        borderWidth: 1,
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    indexAxis: 'y', // Horizontal Bar Chart
                    scales: {
                        x: { beginAtZero: true, ticks: { stepSize: 1 } }
                    },
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        });
    </script>
</x-app-layout>