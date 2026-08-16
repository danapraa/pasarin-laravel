<x-app-layout>
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-8 lg:flex-row">
            <aside class="lg:w-64 lg:flex-shrink-0">
                <div class="panel">
                    <p class="font-display text-sm font-bold text-ink">Kategori</p>
                    <div class="mt-4 space-y-1">
                        <a href="{{ route('products.index') }}" class="block rounded-xl px-3 py-2 text-sm font-semibold {{ !$activeCategory ? 'bg-tint-yellow text-ink' : 'text-ink/60 hover:bg-tint-yellow/50' }}">
                            Semua Produk
                        </a>
                        @foreach ($categories as $category)
                            <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="block rounded-xl px-3 py-2 text-sm font-semibold {{ $activeCategory?->id === $category->id ? 'bg-tint-yellow text-ink' : 'text-ink/60 hover:bg-tint-yellow/50' }}">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </aside>

            <div class="flex-1">
                <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <h1 class="font-display text-2xl font-bold text-ink">
                            {{ $activeCategory ? $activeCategory->name : 'Semua Produk' }}
                        </h1>
                        <p class="text-sm text-ink/60">{{ $products->total() }} produk ditemukan</p>
                    </div>

                    <form action="{{ route('products.index') }}" method="GET" class="relative w-full sm:w-72">
                        @if ($activeCategory)
                            <input type="hidden" name="category" value="{{ $activeCategory->slug }}">
                        @endif
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari produk..."
                            class="w-full rounded-pill border-2 border-ink/10 bg-white py-2.5 pl-5 pr-12 text-sm focus:border-secondary focus:ring-0" />
                        <button type="submit" class="absolute right-1.5 top-1/2 -translate-y-1/2 rounded-full bg-secondary p-2 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" /></svg>
                        </button>
                    </form>
                </div>

                <div class="grid grid-cols-2 gap-5 sm:grid-cols-3">
                    @forelse ($products as $product)
                        @php $primaryImage = $product->images->firstWhere('is_primary', true) ?? $product->images->first(); @endphp
                        <a href="{{ route('products.show', $product) }}" class="card-stall block">
                            <div class="aspect-square overflow-hidden rounded-2xl bg-tint-teal">
                                @if ($primaryImage)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($primaryImage->path) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                                @endif
                            </div>
                            <p class="mt-3 line-clamp-2 font-display text-sm font-bold text-ink">{{ $product->name }}</p>
                            <p class="text-xs text-ink/50">{{ $product->store->name }}</p>
                            <div class="mt-2 flex items-center justify-between">
                                <p class="font-display text-base font-bold text-secondary">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                @if ($product->stock <= 0)
                                    <span class="rounded-pill bg-accent/10 px-2 py-0.5 text-[10px] font-semibold text-accent">Habis</span>
                                @endif
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full rounded-3xl bg-white px-6 py-12 text-center text-sm text-ink/50">
                            Tidak ada produk yang cocok.
                        </div>
                    @endforelse
                </div>

                <div class="mt-8">{{ $products->links() }}</div>
            </div>
        </div>
    </div>

    <x-site-footer />
</x-app-layout>
