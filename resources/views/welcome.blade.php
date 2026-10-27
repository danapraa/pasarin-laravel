<x-app-layout>
    <section class="relative overflow-hidden bg-tint-yellow"
         style="background-image: url('{{ asset('images/background.jpg') }}'); background-size: cover; background-position: center;">
    <div class="absolute inset-0 bg-gradient-to-r from-cream via-cream/90 to-cream/20"></div>

    <div class="relative mx-auto grid max-w-7xl items-center gap-12 px-4 py-16 sm:px-6 lg:grid-cols-2 lg:py-24 lg:px-8">
            <div>
                <span class="inline-flex items-center gap-2 rounded-pill bg-white px-4 py-1.5 text-sm font-semibold text-secondary shadow-sm">
                    Marketplace lokal, ramai tiap hari
                </span>

                <h1 class="mt-6 font-display text-5xl font-bold leading-[1.1] text-ink lg:text-6xl">
                    Semua yang kamu cari,<br>
                    <span class="text-secondary">dari toko sebelah rumah.</span>
                </h1>

                <p class="mt-6 max-w-md text-lg text-ink/70">
                    Pasarin menghubungkan kamu dengan ribuan penjual lokal, dari jajanan pasar sampai fesyen, semuanya dalam satu genggaman.
                </p>

                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="#kategori" class="btn-primary">Mulai Belanja</a>
                    <a href="{{ route('register') }}" class="btn-ghost">Buka Toko Gratis</a>
                </div>

                <div class="mt-10 flex gap-8">
                    <div>
                        <p class="font-display text-3xl font-bold text-ink">2</p>
                        <p class="text-sm text-ink/60">Penjual aktif</p>
                    </div>
                    <div>
                        <p class="font-display text-3xl font-bold text-ink">3</p>
                        <p class="text-sm text-ink/60">Produk tersedia</p>
                    </div>
                    <div>
                        <p class="font-display text-3xl font-bold text-ink">98%</p>
                        <p class="text-sm text-ink/60">Pesanan tepat waktu</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="pointer-events-none absolute -bottom-16 -left-16 h-64 w-64 rounded-full bg-secondary/10"></div>
        <div class="pointer-events-none absolute -right-10 top-10 h-40 w-40 rounded-full bg-accent/10"></div>
    </section>

    <section id="kategori" class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <p class="font-display text-sm font-bold uppercase tracking-wide text-secondary">Jelajahi</p>
        <h2 class="mt-1 font-display text-3xl font-bold text-ink">Kategori Pilihan</h2>

        <div class="mt-8 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6">
            @forelse ($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="group rounded-3xl border-2 border-ink/5 bg-white p-5 text-center transition hover:-translate-y-1 hover:border-secondary hover:shadow-lg">
                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-tint-yellow font-display text-sm font-bold text-ink">
                        {{ strtoupper(substr($category->name, 0, 2)) }}
                    </div>
                    <p class="mt-3 text-sm font-semibold text-ink group-hover:text-secondary">{{ $category->name }}</p>
                    <p class="text-xs text-ink/40">{{ $category->products_count }} produk</p>
                </a>
            @empty
                <p class="col-span-full rounded-2xl bg-white px-4 py-8 text-center text-sm text-ink/50">Kategori belum tersedia. Tambahkan lewat dashboard admin.</p>
            @endforelse
        </div>
    </section>

    <section class="bg-tint-teal/40 py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between">
                <div>
                    <p class="font-display text-sm font-bold uppercase tracking-wide text-accent">Lagi Ramai</p>
                    <h2 class="mt-1 font-display text-3xl font-bold text-ink">Produk Terbaru</h2>
                </div>
                <a href="{{ route('products.index') }}" class="hidden text-sm font-semibold text-secondary hover:underline sm:block">Lihat Semua &rarr;</a>
            </div>

            <div class="mt-8 grid grid-cols-2 gap-5 sm:grid-cols-3 lg:grid-cols-4">
                @forelse ($products as $product)
                    @php $primaryImage = $product->images->firstWhere('is_primary', true) ?? $product->images->first(); @endphp
                    <a href="{{ route('products.show', $product) }}" class="card-stall relative block">
                        @if ($product->created_at->gt(now()->subDays(7)))
                            <div class="absolute -left-3 -top-3 z-10 rotate-[-4deg]">
                                <x-pennant color="primary">Baru</x-pennant>
                            </div>
                        @endif
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
                    <div class="col-span-full rounded-3xl bg-white px-6 py-12 text-center">
                        <p class="font-display text-lg font-bold text-ink">Belum ada produk</p>
                        <p class="mt-2 text-sm text-ink/60">Jadilah penjual pertama di Pasarin.</p>
                        <a href="{{ route('register') }}" class="btn-primary mt-4 inline-flex">Daftar Jadi Penjual</a>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="relative overflow-hidden rounded-[2.5rem] bg-secondary px-8 py-14 text-center sm:px-16">
            <h2 class="font-display text-3xl font-bold text-white lg:text-4xl">Punya usaha? Buka tokomu di Pasarin.</h2>
            <p class="mx-auto mt-3 max-w-xl text-white/80">Tanpa biaya pendaftaran. Kamu atur sendiri produk, harga, dan pengiriman dari dashboard toko.</p>
            <a href="{{ route('register') }}" class="btn-primary mt-8 inline-flex">Daftar Jadi Penjual</a>

            <div class="pointer-events-none absolute -bottom-10 -left-10 h-40 w-40 rounded-full bg-white/10"></div>
            <div class="pointer-events-none absolute -right-6 -top-6 h-28 w-28 rounded-full bg-white/10"></div>
        </div>
    </section>

    <x-site-footer />
</x-app-layout>
