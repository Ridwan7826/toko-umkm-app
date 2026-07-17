<x-app-layout>
    <x-slot name="header">
        Ulasan Saya
    </x-slot>

    <div class="bg-white p-6 shadow-sm rounded-xl mb-6">
        <p class="text-slate-500 mb-6">Kelola dan lihat ulasan yang pernah Anda berikan pada produk yang telah Anda pesan.</p>
        
        <div class="space-y-6">
            @forelse($reviews as $review)
                <div class="border border-slate-200 rounded-xl p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h4 class="font-bold text-slate-900">{{ $review->product->name }}</h4>
                            <p class="text-sm text-slate-500">Diberikan pada: {{ $review->created_at->format('d M Y') }}</p>
                        </div>
                        <div class="flex text-amber-400">
                            @for($i = 0; $i < $review->rating; $i++)
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                    </div>
                    <p class="text-slate-700 bg-slate-50 p-4 rounded-lg">{{ $review->comment }}</p>
                </div>
            @empty
                <div class="text-center py-8">
                    <p class="text-slate-500">Anda belum memberikan ulasan apa pun.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
