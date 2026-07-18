<x-app-layout>
    <x-slot name="header">
        Tambah Kategori Baru
    </x-slot>

    <div class="max-w-3xl">
        <p class="text-slate-500 mb-6">Lengkapi formulir di bawah ini dengan data yang valid.</p>
        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
            @csrf
            <div>
                <label class="block mb-2 text-sm font-semibold text-slate-900">Nama Input</label>
                <input type="text" name="name" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition" placeholder="Masukkan sesuatu di sini..." required>
            </div>
            
            <div>
                <label class="block mb-2 text-sm font-semibold text-slate-900">Gambar Kategori</label>
                <input type="file" name="image" class="block w-full text-sm text-slate-900 border border-slate-300 rounded-xl cursor-pointer bg-slate-50 focus:outline-none file:mr-4 file:py-3 file:px-4 file:rounded-l-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*">
            </div>
            
            <div class="pt-4 flex items-center justify-start gap-3 border-t border-slate-100">
                <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-xl text-sm px-6 py-3 text-center transition shadow-sm">Simpan Perubahan</button>
                <a href="{{ route('admin.categories.index') }}" class="text-slate-600 bg-white hover:bg-slate-100 focus:ring-4 focus:outline-none focus:ring-slate-200 rounded-xl border border-slate-200 text-sm font-medium px-6 py-3 transition">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>