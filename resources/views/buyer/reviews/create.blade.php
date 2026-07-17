<x-app-layout>
    <x-slot name="header">
        Beri Ulasan Produk
    </x-slot>

    <div class="bg-white p-6 shadow-sm rounded-xl max-w-2xl">
        <div class="mb-6 pb-6 border-b border-slate-100 flex items-center">
            <div>
                <h3 class="text-xl font-bold">{{ $product->name }}</h3>
                <p class="text-slate-500">Invoice: {{ $order->invoice_number }}</p>
            </div>
        </div>

        <form action="{{ route('buyer.reviews.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="order_id" value="{{ $order->id }}">

            <div class="mb-4">
                <label class="block font-medium text-slate-700 mb-2">Rating (1-5)</label>
                <select name="rating" class="w-full border-slate-300 rounded-xl shadow-sm focus:ring focus:ring-blue-200">
                    <option value="5">5 Bintang - Sangat Baik</option>
                    <option value="4">4 Bintang - Baik</option>
                    <option value="3">3 Bintang - Cukup</option>
                    <option value="2">2 Bintang - Buruk</option>
                    <option value="1">1 Bintang - Sangat Buruk</option>
                </select>
                @error('rating')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-6">
                <label class="block font-medium text-slate-700 mb-2">Komentar</label>
                <textarea name="comment" rows="4" class="w-full border-slate-300 rounded-xl shadow-sm focus:ring focus:ring-blue-200" placeholder="Tuliskan pengalaman Anda..."></textarea>
                @error('comment')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition font-medium">Kirim Ulasan</button>
                <a href="{{ route('buyer.orders.show', $order->id) }}" class="px-5 py-2.5 bg-slate-200 text-slate-700 rounded-xl hover:bg-slate-300 transition font-medium">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
