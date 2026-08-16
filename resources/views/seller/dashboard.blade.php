<x-seller-layout title="Ringkasan Toko">
    @if (! $store)
        <div class="panel text-center">
            <div class="badge-circle mx-auto bg-tint-yellow text-ink">TK</div>
            <p class="mt-4 font-display text-xl font-bold text-ink">Kamu belum punya toko</p>
            <p class="mx-auto mt-2 max-w-sm text-sm text-ink/60">Form pembuatan toko akan tersedia begitu modul Toko selesai dibuat. Sabar ya!</p>
        </div>
    @elseif ($store->status->value !== 'approved')
        <div class="rounded-3xl border-2 border-primary/30 bg-tint-yellow px-6 py-8 text-center">
            <p class="font-display text-xl font-bold text-ink">Toko "{{ $store->name }}" sedang ditinjau</p>
            <p class="mt-2 text-sm text-ink/60">Status saat ini: <span class="font-semibold capitalize">{{ $store->status->value }}</span>. Kamu bisa mengelola produk begitu admin menyetujui toko ini.</p>
        </div>
    @else
        <div class="grid gap-5 sm:grid-cols-3">
            <div class="card-stall">
                <div class="badge-circle bg-tint-teal text-secondary">PA</div>
                <p class="mt-4 font-display text-2xl font-bold text-ink">{{ $productCount }}</p>
                <p class="text-sm text-ink/60">Produk Aktif</p>
            </div>
            <div class="card-stall">
                <div class="badge-circle bg-accent/10 text-accent">PM</div>
                <p class="mt-4 font-display text-2xl font-bold text-ink">{{ $pendingOrders }}</p>
                <p class="text-sm text-ink/60">Pesanan Menunggu Diproses</p>
            </div>
            <div class="card-stall">
                <div class="badge-circle bg-tint-yellow text-ink">KM</div>
                <p class="mt-4 font-display text-2xl font-bold text-ink">{{ number_format($store->commission_rate, 1) }}%</p>
                <p class="text-sm text-ink/60">Komisi Platform</p>
            </div>
        </div>

        <div class="panel mt-6">
            <p class="font-display text-lg font-bold text-ink">Pesanan Terbaru</p>

            <div class="mt-5 space-y-3">
                @forelse ($recentOrders as $orderStore)
                    <div class="flex items-center justify-between rounded-2xl bg-tint-teal/30 px-4 py-3">
                        <div>
                            <p class="text-sm font-semibold text-ink">Order #{{ $orderStore->order_id }}</p>
                            <p class="text-xs text-ink/50">{{ $orderStore->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="rounded-pill bg-white px-3 py-1 text-xs font-semibold capitalize text-secondary">{{ $orderStore->status->value }}</span>
                    </div>
                @empty
                    <p class="rounded-2xl bg-ink/5 px-4 py-6 text-center text-sm text-ink/50">Belum ada pesanan masuk.</p>
                @endforelse
            </div>
        </div>
    @endif
</x-seller-layout>
