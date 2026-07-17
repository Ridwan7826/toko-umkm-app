<x-app-layout>
    <x-slot name="header">
        Keranjang Belanja
    </x-slot>

    <div class="mb-6 flex justify-between items-center">
        <p class="text-slate-500">Kelola data Keranjang Belanja dengan mudah melalui tabel interaktif di bawah ini.</p>
        <a href="{{ route('public.products.index') }}" class="px-5 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition shadow-sm font-medium">+ Belanja Lagi</a>
    </div>
    
    <div class="overflow-x-auto relative shadow-sm rounded-xl border border-slate-200 mb-6">
        <table class="w-full text-sm text-left text-slate-500">
            <thead class="text-xs text-slate-700 uppercase bg-slate-50">
                <tr>
                    <th scope="col" class="py-4 px-6">Produk</th>
                    <th scope="col" class="py-4 px-6">Harga</th>
                    <th scope="col" class="py-4 px-6">Kuantitas</th>
                    <th scope="col" class="py-4 px-6">Subtotal</th>
                    <th scope="col" class="py-4 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($carts as $cart)
                    @php 
                        $price = $cart->variant ? $cart->variant->price : $cart->product->price;
                        $subtotal = $price * $cart->quantity;
                    @endphp
                    <tr class="bg-white border-b hover:bg-slate-50 transition">
                        <td class="py-4 px-6 font-medium text-slate-900">
                            {{ $cart->product->name }} 
                            @if($cart->variant)
                                <span class="text-xs text-slate-500 block">Varian: {{ $cart->variant->name }}</span>
                            @endif
                        </td>
                        <td class="py-4 px-6">Rp {{ number_format($price, 0, ',', '.') }}</td>
                        <td class="py-4 px-6">
                            <form action="{{ route('buyer.cart.update', $cart->id) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" value="{{ $cart->quantity }}" min="1" class="w-16 rounded border-slate-300 text-sm">
                                <button type="submit" class="text-blue-600 hover:underline text-xs">Update</button>
                            </form>
                        </td>
                        <td class="py-4 px-6 font-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                        <td class="py-4 px-6 text-center">
                            <form action="{{ route('buyer.cart.destroy', $cart->id) }}" method="POST" onsubmit="return confirm('Hapus item ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-medium text-red-500 hover:text-red-700 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-8 px-6 text-center text-slate-500">Keranjang Anda kosong.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($carts->count() > 0)
    <div class="flex justify-end">
        <a href="{{ route('buyer.checkout.index') }}" class="px-6 py-3 bg-green-600 text-white rounded-xl hover:bg-green-700 transition shadow-sm font-medium">Lanjut ke Checkout</a>
    </div>
    @endif
</x-app-layout>