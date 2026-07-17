<x-app-layout>
    <x-slot name="header">
        Daftar Pesanan Masuk
    </x-slot>

    <div class="mb-6 flex justify-between items-center">
        <p class="text-slate-500">Kelola data pesanan pelanggan untuk toko Anda di bawah ini.</p>
    </div>
    
    <div class="overflow-x-auto relative shadow-sm rounded-xl border border-slate-200">
        <table class="w-full text-sm text-left text-slate-500">
            <thead class="text-xs text-slate-700 uppercase bg-slate-50">
                <tr>
                    <th scope="col" class="py-4 px-6">Invoice</th>
                    <th scope="col" class="py-4 px-6">Pelanggan</th>
                    <th scope="col" class="py-4 px-6">Tanggal</th>
                    <th scope="col" class="py-4 px-6">Status</th>
                    <th scope="col" class="py-4 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr class="bg-white border-b hover:bg-slate-50 transition">
                    <td class="py-4 px-6 font-semibold">{{ $order->invoice_number }}</td>
                    <td class="py-4 px-6 font-medium text-slate-900">{{ $order->user->name ?? '-' }}</td>
                    <td class="py-4 px-6">{{ $order->created_at->format('d M Y H:i') }}</td>
                    <td class="py-4 px-6">
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">{{ strtoupper(str_replace('_', ' ', $order->status)) }}</span>
                    </td>
                    <td class="py-4 px-6 text-center">
                        <a href="{{ route('seller.orders.show', $order->id) }}" class="font-medium text-blue-600 hover:text-blue-800 hover:underline mr-3">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-8 px-6 text-center text-slate-500">Belum ada pesanan masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>