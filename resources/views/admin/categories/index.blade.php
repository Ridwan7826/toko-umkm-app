<x-app-layout>
    <x-slot name="header">
        Daftar Kategori Produk
    </x-slot>

    <div class="mb-6 flex justify-between items-center">
        <p class="text-slate-500">Kelola data Daftar Kategori Produk dengan mudah melalui tabel interaktif di bawah ini.</p>
        <a href="{{ route('admin.categories.create') }}" class="px-5 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition shadow-sm font-medium">+ Tambah Data Baru</a>
    </div>
    
    <div class="overflow-x-auto relative shadow-sm rounded-xl border border-slate-200">
        <table class="w-full text-sm text-left text-slate-500">
            <thead class="text-xs text-slate-700 uppercase bg-slate-50">
                <tr>
                    <th scope="col" class="py-4 px-6">ID</th>
                    <th scope="col" class="py-4 px-6">Nama Kategori</th>
                    <th scope="col" class="py-4 px-6 text-center">Aksi (Opsi)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr class="bg-white border-b hover:bg-slate-50 transition">
                    <td class="py-4 px-6 font-semibold">{{ $category->id }}</td>
                    <td class="py-4 px-6 font-medium text-slate-900">{{ $category->name }}</td>
                    <td class="py-4 px-6 text-center">
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="font-medium text-amber-500 hover:text-amber-700 hover:underline mr-3">Ubah</a>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-medium text-red-500 hover:text-red-700 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>