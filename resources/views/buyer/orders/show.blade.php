<x-app-layout>
    <x-slot name="header">
        Detail Transaksi & Invoice #{{ $order->invoice_number }}
    </x-slot>

    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('buyer.orders.index') }}" class="text-blue-600 hover:underline flex items-center">
            &larr; Kembali ke Daftar Pesanan
        </a>
        <a href="{{ route('buyer.orders.invoice', $order->id) }}" target="_blank" class="px-5 py-2.5 bg-slate-800 text-white rounded-xl hover:bg-slate-900 transition shadow-sm font-medium flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            Cetak Invoice (PDF)
        </a>
    </div>

    <div class="bg-white p-6 shadow-sm rounded-xl mb-6">
        <h3 class="text-lg font-extrabold text-slate-900 mb-4 border-b pb-2">Status Pesanan: <span class="uppercase text-blue-600">{{ $order->status }}</span></h3>
        <p>Total: Rp {{ number_format($order->total_product_price + $order->shipping_cost, 0, ',', '.') }}</p>
    </div>

    <div class="bg-white p-6 shadow-sm rounded-xl">
        <h3 class="text-lg font-extrabold text-slate-900 mb-4 border-b pb-2">Produk yang Dipesan</h3>
        <ul class="space-y-4">
            @foreach($order->details as $detail)
                <li class="flex justify-between items-center border-b pb-4">
                    <div>
                        <p class="font-bold">{{ $detail->variant->product->name }} ({{ $detail->variant->name }})</p>
                        <p class="text-sm text-slate-500">{{ $detail->quantity }} x Rp {{ number_format($detail->price_per_unit, 0, ',', '.') }}</p>
                    </div>
                    @if($order->status === 'selesai')
                        <a href="{{ route('buyer.reviews.create', ['order_id' => $order->id, 'product_id' => $detail->variant->product_id]) }}" class="px-4 py-2 bg-amber-500 text-white font-semibold rounded-lg hover:bg-amber-600 transition">Beri Ulasan</a>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>