<x-app-layout>
    <x-slot name="header">
        Detail Kategori
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <h3 class="text-lg font-extrabold text-slate-900 mb-4 border-b border-slate-100 pb-2">Informasi Rinci</h3>
            <dl class="space-y-3 text-sm text-slate-600">
                <div class="flex justify-between items-center py-2 border-b border-slate-50"><dt class="font-bold">Properti A</dt> <dd class="text-slate-900">Penjabaran Nilai A</dd></div>
                <div class="flex justify-between items-center py-2 border-b border-slate-50"><dt class="font-bold">Properti B</dt> <dd class="text-slate-900">Penjabaran Nilai B</dd></div>
            </dl>
        </div>
    </div>
    <div class="mt-8 pt-6 border-t border-slate-100">
        <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium hover:underline transition">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar
        </a>
    </div>
</x-app-layout>