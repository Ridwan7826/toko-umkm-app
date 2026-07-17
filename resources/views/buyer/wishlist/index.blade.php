<x-app-layout>
    <x-slot name="header">
        Daftar Produk Favorit
    </x-slot>

    <div class="mb-6">
        <p class="text-slate-500">Kelola data Daftar Produk Favorit dengan mudah melalui tabel interaktif di bawah ini.</p>
    </div>
    
    @if(session('success'))
        <div class="mb-4 p-4 text-green-700 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto relative shadow-sm rounded-xl border border-slate-200">
        <table class="w-full text-sm text-left text-slate-500">
            <thead class="text-xs text-slate-700 uppercase bg-slate-50">
                <tr>
                    <th scope="col" class="py-4 px-6">ID Produk</th>
                    <th scope="col" class="py-4 px-6">Nama Produk</th>
                    <th scope="col" class="py-4 px-6 text-center">Aksi (Opsi)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($wishlists as $wishlist)
                <tr class="bg-white border-b hover:bg-slate-50 transition">
                    <td class="py-4 px-6 font-semibold">#{{ $wishlist->product->id }}</td>
                    <td class="py-4 px-6 font-medium text-slate-900">{{ $wishlist->product->name }}</td>
                    <td class="py-4 px-6 text-center">
                        <a href="{{ route('public.products.show', $wishlist->product->id) }}" class="font-medium text-blue-600 hover:text-blue-800 hover:underline mr-3">Detail</a>
                        <form action="{{ route('buyer.wishlist.destroy', $wishlist->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-medium text-red-500 hover:text-red-700 hover:underline" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini dari daftar favorit?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr class="bg-white border-b">
                    <td colspan="3" class="py-4 px-6 text-center text-slate-500">Belum ada produk favorit.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>