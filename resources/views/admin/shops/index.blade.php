<x-app-layout>
    <x-slot name="header">
        Daftar Toko UMKM
    </x-slot>

    <div class="mb-6 flex justify-between items-center">
        <p class="text-slate-500">Kelola data Daftar Toko UMKM dengan mudah melalui tabel interaktif di bawah ini.</p>
        <a href="#" class="px-5 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition shadow-sm font-medium">+ Tambah Data Baru</a>
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
                <!-- Dummy Row -->
                <tr class="bg-white border-b hover:bg-slate-50 transition">
                    <td class="py-4 px-6 font-semibold">#1029</td>
                    <td class="py-4 px-6 font-medium text-slate-900">Data Contoh Placeholder</td>
                    <td class="py-4 px-6"><span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Aktif</span></td>
                    <td class="py-4 px-6 text-center">
                        <a href="#" class="font-medium text-blue-600 hover:text-blue-800 hover:underline mr-3">Detail</a>
                        <a href="#" class="font-medium text-amber-500 hover:text-amber-700 hover:underline">Ubah</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</x-app-layout>