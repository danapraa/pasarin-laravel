<x-app-layout>
    <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">
        <nav class="mb-6 text-sm text-ink/50">
            <a href="{{ route('welcome') }}" class="hover:text-secondary">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ route('products.index') }}" class="hover:text-secondary">Produk</a>
            @if ($product->category)
                <span class="mx-2">/</span>
                <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="hover:text-secondary">{{ $product->category->name }}</a>
            @endif
        </nav>

        <div class="grid gap-10 lg:grid-cols-2">
            <div>
                @php $mainImage = $product->images->first(); @endphp
                <div class="aspect-square overflow-hidden rounded-3xl bg-tint-teal">
                    @if ($mainImage)
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($mainImage->path) }}" alt="{{ $product->name }}" class="h-full w-full object-cover" id="main-image">
                    @endif
                </div>

                @if ($product->images->count() > 1)
                    <div class="mt-4 flex gap-3">
                        @foreach ($product->images as $image)
                            <button type="button" onclick="document.getElementById('main-image').src = '{{ \Illuminate\Support\Facades\Storage::url($image->path) }}'"
                                class="h-16 w-16 overflow-hidden rounded-xl border-2 border-ink/5 hover:border-secondary">
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($image->path) }}" class="h-full w-full object-cover">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <div>
                @if ($product->category)
                    <span class="rounded-pill bg-tint-teal px-3 py-1 text-xs font-semibold text-secondary">{{ $product->category->name }}</span>
                @endif

                <h1 class="mt-3 font-display text-3xl font-bold text-ink">{{ $product->name }}</h1>
                <p class="mt-1 text-sm text-ink/50">Terjual oleh {{ $product->store->name }}</p>

                <p class="mt-4 font-display text-4xl font-bold text-secondary">Rp{{ number_format($product->price, 0, ',', '.') }}</p>

                <div class="mt-2">
                    @if ($product->stock > 0)
                        <span class="rounded-pill bg-tint-teal px-3 py-1 text-xs font-semibold text-secondary">Stok: {{ $product->stock }}</span>
                    @else
                        <span class="rounded-pill bg-accent/10 px-3 py-1 text-xs font-semibold text-accent">Stok Habis</span>
                    @endif
                </div>

                <div class="mt-6 flex gap-3">
                    <button type="button" disabled class="btn-primary flex-1 opacity-50" title="Modul Cart menyusul">
                        Tambah ke Keranjang
                    </button>
                    <button type="button" disabled class="btn-ghost opacity-50" title="Modul Wishlist menyusul">
                        Wishlist
                    </button>
                </div>
                <p class="mt-2 text-xs text-ink/40">Tombol belanja aktif setelah modul Cart dan Checkout dibuat.</p>

                <div class="panel mt-8">
                    <p class="font-display text-sm font-bold text-ink">Deskripsi Produk</p>
                    <p class="mt-2 whitespace-pre-line text-sm text-ink/70">{{ $product->description ?? 'Belum ada deskripsi untuk produk ini.' }}</p>
                </div>
            </div>
        </div>

        @if ($relatedProducts->isNotEmpty())
            <div class="mt-16">
                <h2 class="font-display text-2xl font-bold text-ink">Produk Serupa</h2>
                <div class="mt-6 grid grid-cols-2 gap-5 sm:grid-cols-4">
                    @foreach ($relatedProducts as $related)
                        @php $relatedImage = $related->images->firstWhere('is_primary', true) ?? $related->images->first(); @endphp
                        <a href="{{ route('products.show', $related) }}" class="card-stall block">
                            <div class="aspect-square overflow-hidden rounded-2xl bg-tint-teal">
                                @if ($relatedImage)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($relatedImage->path) }}" alt="{{ $related->name }}" class="h-full w-full object-cover">
                                @endif
                            </div>
                            <p class="mt-3 line-clamp-2 font-display text-sm font-bold text-ink">{{ $related->name }}</p>
                            <p class="mt-1 font-display text-sm font-bold text-secondary">Rp{{ number_format($related->price, 0, ',', '.') }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <x-site-footer />
</x-app-layout>
