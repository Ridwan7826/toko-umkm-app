<x-app-layout>
    <x-slot name="header">
        Laporan Keseluruhan Platform
    </x-slot>

    <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="text-sm font-medium text-slate-500 uppercase">Total Pendapatan Platform</h3>
            <p class="text-2xl font-bold text-slate-900 mt-2">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="text-sm font-medium text-slate-500 uppercase">Total Pesanan Selesai</h3>
            <p class="text-2xl font-bold text-slate-900 mt-2">{{ number_format($totalOrders, 0, ',', '.') }}</p>
        </div>
    </div>
    
    <div class="mb-6 bg-white p-6 rounded-xl shadow-sm border border-slate-200 flex flex-col md:flex-row justify-between items-center">
        <div>
            <h3 class="text-md font-bold text-slate-800 mb-2">Laporan & Analitik Tambahan</h3>
            <p class="text-sm text-slate-500 mb-4 md:mb-0">Unduh data atau lihat grafik komparatif performa platform.</p>
        </div>
        <div class="flex gap-4">
            <a href="{{ route('admin.reports.seller-performance') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition text-sm font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                Performa Penjual
            </a>
            <a href="{{ route('admin.reports.excel.transaksi-platform') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition text-sm font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Download Laporan (Excel)
            </a>
        </div>
    </div>
    
    <div class="overflow-x-auto relative shadow-sm rounded-xl border border-slate-200">
        <table class="w-full text-sm text-left text-slate-500">
            <thead class="text-xs text-slate-700 uppercase bg-slate-50">
                <tr>
                    <th scope="col" class="py-4 px-6">Tanggal</th>
                    <th scope="col" class="py-4 px-6">Toko</th>
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
                    <td class="py-4 px-6 font-medium text-slate-900">{{ $sale->shop->name ?? 'Toko Tidak Ditemukan' }}</td>
                    <td class="py-4 px-6 text-right">{{ $sale->total_orders }}</td>
                    <td class="py-4 px-6 text-right">{{ $sale->completed_orders }}</td>
                    <td class="py-4 px-6 text-right">{{ $sale->cancelled_orders }}</td>
                    <td class="py-4 px-6 text-right font-medium text-green-600">Rp {{ number_format($sale->gross_revenue, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr class="bg-white border-b">
                    <td colspan="6" class="py-4 px-6 text-center text-slate-500">Belum ada data laporan harian.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>