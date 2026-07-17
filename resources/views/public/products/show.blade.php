<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumbs -->
        <nav class="flex mb-8 text-sm font-medium text-slate-500">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="/" class="hover:text-emerald-600 transition-colors">Beranda</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <a href="{{ route('public.categories.show', $product->category->id ?? 1) }}" class="hover:text-emerald-600 transition-colors">{{ $product->category->name ?? 'Kategori' }}</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <span class="text-slate-400">{{ Str::limit($product->name, 20) }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        @if (session('success'))
            <div class="mb-6 bg-emerald-50 text-emerald-800 p-4 rounded-2xl flex items-center gap-3 border border-emerald-200 animate-fade-in-up">
                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden mb-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-0">
                <!-- Product Image Section -->
                <div class="lg:col-span-2 bg-slate-50 p-8 flex items-center justify-center border-b md:border-b-0 md:border-r border-slate-200 relative group overflow-hidden min-h-[400px]">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-blue-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="w-full aspect-square bg-white rounded-2xl shadow-sm border border-slate-100 flex items-center justify-center text-slate-300 relative z-10 group-hover:scale-105 transition-transform duration-500">
                        <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                </div>

                <!-- Product Info Section -->
                <div class="lg:col-span-3 p-8 lg:p-12 flex flex-col">
                    <div class="mb-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                            {{ $product->category->name ?? 'Kategori Umum' }}
                        </span>
                    </div>
                    
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mb-4 leading-tight">{{ $product->name }}</h1>
                    
                    <div class="flex items-center gap-4 mb-8 pb-8 border-b border-slate-100">
                        <div class="flex items-center text-amber-400">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <span class="ml-1 text-slate-700 font-medium">4.8</span>
                            <span class="ml-1 text-slate-400 text-sm">(120 ulasan)</span>
                        </div>
                        <div class="h-5 w-px bg-slate-200"></div>
                        <a href="{{ route('public.shops.show', $product->shop->id) }}" class="flex items-center gap-2 group">
                            <div class="w-6 h-6 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 text-xs font-bold">
                                {{ substr($product->shop->name, 0, 1) }}
                            </div>
                            <span class="font-medium text-slate-600 group-hover:text-indigo-600 transition-colors">{{ $product->shop->name }}</span>
                        </a>
                    </div>
                    
                    <div class="mb-8">
                        <p class="text-sm font-medium text-slate-500 mb-1">Harga Mulai Dari</p>
                        <!-- We use a placeholder price since variants dictate actual price -->
                        <p class="text-4xl font-extrabold text-slate-900">
                            Rp {{ number_format(150000, 0, ',', '.') }}
                        </p>
                    </div>

                    <div class="prose prose-slate prose-emerald max-w-none mb-10 flex-grow">
                        <h4 class="text-lg font-bold text-slate-800 mb-2">Deskripsi Produk</h4>
                        <p class="text-slate-600 leading-relaxed">{{ $product->description }}</p>
                    </div>
                    
                    <div class="mt-auto">
                        <form action="{{ route('buyer.cart.add') }}" method="POST" class="flex flex-col sm:flex-row gap-4">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <!-- Assuming user will select a variant from a modal or page later -->
                            <input type="hidden" name="variant_id" value="{{ $product->variants->first()->id ?? '' }}">
                            <input type="hidden" name="quantity" value="1">
                            
                            <button type="submit" class="flex-1 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-bold py-4 px-8 rounded-xl shadow-lg shadow-emerald-500/30 transition-all transform hover:-translate-y-1 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                Masukkan Keranjang
                            </button>
                            <button type="button" class="w-full sm:w-auto px-6 py-4 bg-white border-2 border-slate-200 text-slate-700 rounded-xl font-bold hover:border-emerald-500 hover:text-emerald-600 transition-all flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="bg-white p-8 lg:p-12 shadow-sm rounded-3xl border border-slate-200">
            <div class="flex items-center justify-between mb-8 border-b border-slate-100 pb-4">
                <h3 class="text-2xl font-extrabold text-slate-900">Ulasan Pembeli</h3>
                <span class="bg-slate-100 text-slate-600 font-semibold px-4 py-1.5 rounded-full text-sm">{{ $product->reviews->count() }} Ulasan</span>
            </div>
            
            @if($product->reviews->isEmpty())
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    </div>
                    <p class="text-slate-500 text-lg font-medium">Belum ada ulasan untuk produk ini.</p>
                    <p class="text-slate-400 mt-1">Jadilah yang pertama memberikan ulasan setelah membeli!</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($product->reviews as $review)
                        <div class="p-6 rounded-2xl bg-slate-50 border border-slate-100 hover:shadow-md transition-shadow">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-emerald-400 to-blue-500 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-sm">
                                        {{ substr($review->user->name, 0, 2) }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-900">{{ $review->user->name }}</div>
                                        <div class="text-xs text-slate-400">{{ $review->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                                <div class="flex text-amber-400 bg-white px-2 py-1 rounded-full shadow-sm border border-slate-100">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg class="w-3.5 h-3.5 {{ $i < $review->rating ? 'fill-current' : 'text-slate-200 fill-current' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    @endfor
                                </div>
                            </div>
                            <p class="text-slate-600 leading-relaxed italic">"{{ $review->comment }}"</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
