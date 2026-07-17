<x-app-layout>
    <x-slot name="header">
        Detail Pesanan #{{ $order->invoice_number }}
    </x-slot>

    @if(session('success'))
        <div class="mb-4 px-4 py-3 bg-green-100 text-green-800 rounded-xl font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <h3 class="text-lg font-extrabold text-slate-900 mb-4 border-b border-slate-100 pb-2">Informasi Rinci</h3>
            <dl class="space-y-3 text-sm text-slate-600">
                <div class="flex justify-between items-center py-2 border-b border-slate-50"><dt class="font-bold">Pembeli</dt> <dd class="text-slate-900">{{ $order->user->name ?? '-' }}</dd></div>
                <div class="flex justify-between items-center py-2 border-b border-slate-50"><dt class="font-bold">Total Harga Produk</dt> <dd class="text-slate-900">Rp {{ number_format($order->total_product_price, 0, ',', '.') }}</dd></div>
                <div class="flex justify-between items-center py-2 border-b border-slate-50"><dt class="font-bold">Ongkos Kirim</dt> <dd class="text-slate-900">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</dd></div>
                <div class="flex justify-between items-center py-2 border-b border-slate-50"><dt class="font-bold">Kurir</dt> <dd class="text-slate-900">{{ $order->courier_name ?? '-' }}</dd></div>
                <div class="flex justify-between items-center py-2 border-b border-slate-50"><dt class="font-bold">Resi Pengiriman</dt> <dd class="text-slate-900">{{ $order->tracking_number ?? '-' }}</dd></div>
            </dl>

            <h3 class="text-lg font-extrabold text-slate-900 mb-4 border-b border-slate-100 pb-2 mt-8">Produk yang Dipesan</h3>
            <ul class="space-y-3 text-sm">
                @foreach($order->details as $detail)
                <li class="flex justify-between items-center py-2 border-b border-slate-50">
                    <div>
                        <p class="font-bold text-slate-900">{{ $detail->variant->product->name }}</p>
                        @if($detail->variant->name !== 'default')
                            <p class="text-slate-500 text-xs">Varian: {{ $detail->variant->name }}</p>
                        @endif
                    </div>
                    <div class="text-right text-slate-900">
                        {{ $detail->quantity }} x Rp {{ number_format($detail->price, 0, ',', '.') }}
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        
        <div>
            <h3 class="text-lg font-extrabold text-slate-900 mb-4 border-b border-slate-100 pb-2">Update Status Pesanan</h3>
            <form action="{{ route('seller.orders.update', $order->id) }}" method="POST" class="space-y-4 bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-900">Status</label>
                    <select name="status" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-3">
                        <option value="menunggu_pembayaran" {{ $order->status == 'menunggu_pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                        <option value="dibayar" {{ $order->status == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                        <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="dikirim" {{ $order->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                        <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ $order->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>
                
                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-900">Nama Kurir</label>
                    <input type="text" name="courier_name" value="{{ old('courier_name', $order->courier_name) }}" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-3">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-900">Nomor Resi</label>
                    <input type="text" name="tracking_number" value="{{ old('tracking_number', $order->tracking_number) }}" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-3">
                </div>

                <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-xl text-sm px-5 py-2.5 text-center transition">Perbarui Pesanan</button>
            </form>
        </div>
    </div>
    <div class="mt-8 pt-6 border-t border-slate-100 flex justify-between items-center">
        <a href="{{ route('seller.orders.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium hover:underline transition">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar
        </a>
        <a href="{{ route('seller.orders.invoice', $order->id) }}" target="_blank" class="px-5 py-2.5 bg-slate-800 text-white rounded-xl hover:bg-slate-900 transition shadow-sm font-medium flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            Cetak Resi / Invoice (PDF)
        </a>
    </div>
</x-app-layout>