<x-app-layout>
    <x-slot name="header">
        Riwayat Pembelian
    </x-slot>

    <div class="mb-6 flex justify-between items-center">
        <p class="text-slate-500">Kelola data Riwayat Pembelian dengan mudah melalui tabel interaktif di bawah ini.</p>
    </div>
    
    <div class="overflow-x-auto relative shadow-sm rounded-xl border border-slate-200">
        <table class="w-full text-sm text-left text-slate-500">
            <thead class="text-xs text-slate-700 uppercase bg-slate-50">
                <tr>
                    <th scope="col" class="py-4 px-6">ID Pesanan</th>
                    <th scope="col" class="py-4 px-6">Total Harga</th>
                    <th scope="col" class="py-4 px-6">Status</th>
                    <th scope="col" class="py-4 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr class="bg-white border-b hover:bg-slate-50 transition">
                    <td class="py-4 px-6 font-semibold">{{ $order->invoice_number }}</td>
                    <td class="py-4 px-6 font-medium text-slate-900">Rp {{ number_format($order->total_product_price + $order->shipping_cost, 0, ',', '.') }}</td>
                    <td class="py-4 px-6"><span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold uppercase">{{ $order->status }}</span></td>
                    <td class="py-4 px-6 text-center">
                        <a href="{{ route('buyer.orders.show', $order->id) }}" class="font-medium text-blue-600 hover:text-blue-800 hover:underline">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-4 px-6 text-center">Belum ada pesanan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>