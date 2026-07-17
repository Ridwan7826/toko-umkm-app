<x-app-layout>
    <x-slot name="header">
        Katalog Produk Saya
    </x-slot>

    <div class="mb-6 flex justify-between items-center">
        <p class="text-slate-500">Kelola data Katalog Produk Saya dengan mudah melalui tabel interaktif di bawah ini.</p>
        <a href="{{ route('seller.products.create') }}" class="px-5 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition shadow-sm font-medium">+ Tambah Data Baru</a>
    </div>

    <div class="mb-6 bg-white p-4 rounded-xl shadow-sm border border-slate-200">
        <form action="{{ route('seller.products.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <label for="search" class="block text-sm font-medium text-slate-700">Cari Produk</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="Nama produk...">
            </div>
            <div class="w-full md:w-48">
                <label for="category_id" class="block text-sm font-medium text-slate-700">Kategori</label>
                <select name="category_id" id="category_id" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full md:w-32">
                <label for="min_price" class="block text-sm font-medium text-slate-700">Harga Min</label>
                <input type="number" name="min_price" id="min_price" value="{{ request('min_price') }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="0">
            </div>
            <div class="w-full md:w-32">
                <label for="max_price" class="block text-sm font-medium text-slate-700">Harga Max</label>
                <input type="number" name="max_price" id="max_price" value="{{ request('max_price') }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="100000">
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full md:w-auto px-4 py-2 bg-slate-800 text-white rounded-md hover:bg-slate-700 transition">Filter</button>
                <a href="{{ route('seller.products.index') }}" class="ml-2 w-full md:w-auto px-4 py-2 bg-slate-200 text-slate-700 rounded-md hover:bg-slate-300 transition text-center">Reset</a>
            </div>
        </form>
    </div>
    
    <div class="overflow-x-auto relative shadow-sm rounded-xl border border-slate-200">
        <table class="w-full text-sm text-left text-slate-500">
            <thead class="text-xs text-slate-700 uppercase bg-slate-50">
                <tr>
                    <th scope="col" class="py-4 px-6">ID</th>
                    <th scope="col" class="py-4 px-6">Nama / Identitas</th>
                    <th scope="col" class="py-4 px-6">Status / Keterangan</th>
                    <th scope="col" class="py-4 px-6 text-center">Aksi (Opsi)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr class="bg-white border-b hover:bg-slate-50 transition">
                    <td class="py-4 px-6 font-semibold">#{{ $product->id }}</td>
                    <td class="py-4 px-6 font-medium text-slate-900">{{ $product->name }}</td>
                    <td class="py-4 px-6">
                        @if($product->deleted_at)
                            <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">Non-Aktif</span>
                        @else
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Aktif</span>
                        @endif
                    </td>
                    <td class="py-4 px-6 text-center">
                        <a href="{{ route('seller.products.show', $product->id) }}" class="font-medium text-blue-600 hover:text-blue-800 hover:underline mr-3">Detail</a>
                        <a href="{{ route('seller.products.edit', $product->id) }}" class="font-medium text-amber-500 hover:text-amber-700 hover:underline mr-3">Ubah</a>
                        <form action="{{ route('seller.products.destroy', $product->id) }}" method="POST" class="inline-block" x-data @submit.prevent="if(confirm('Apakah Anda yakin ingin menghapus produk ini?')) $el.submit()">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-medium text-red-600 hover:text-red-800 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-4 px-6 text-center text-slate-500">Tidak ada produk yang ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
        {{ $products->links() }}
    </div>
</x-app-layout>