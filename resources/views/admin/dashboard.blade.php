<x-admin-layout title="Ringkasan">
    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
        @php
            $stats = [
                ['label' => 'Toko Aktif', 'value' => $activeStores, 'icon' => 'TA', 'bg' => 'bg-tint-teal', 'text' => 'text-secondary'],
                ['label' => 'Toko Menunggu', 'value' => $pendingStoresCount, 'icon' => 'TM', 'bg' => 'bg-accent/10', 'text' => 'text-accent'],
                ['label' => 'Pesanan Hari Ini', 'value' => $todayOrders, 'icon' => 'PH', 'bg' => 'bg-secondary/10', 'text' => 'text-secondary'],
                ['label' => 'Total Pengguna', 'value' => $totalUsers, 'icon' => 'TP', 'bg' => 'bg-tint-yellow', 'text' => 'text-ink'],
            ];
        @endphp

        @foreach ($stats as $stat)
            <div class="card-stall">
                <div class="badge-circle {{ $stat['bg'] }} {{ $stat['text'] }}">{{ $stat['icon'] }}</div>
                <p class="mt-4 font-display text-2xl font-bold text-ink">{{ $stat['value'] }}</p>
                <p class="text-sm text-ink/60">{{ $stat['label'] }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-8 grid gap-6 lg:grid-cols-3">
        <div class="panel lg:col-span-2">
            <p class="font-display text-lg font-bold text-ink">Toko Menunggu Persetujuan</p>
            <p class="mt-1 text-sm text-ink/60">Tinjau toko baru sebelum tampil ke publik.</p>

            <div class="mt-5 space-y-3">
                @forelse ($pendingStores as $store)
                    <div class="flex items-center justify-between rounded-2xl bg-tint-yellow/50 px-4 py-3">
                        <div>
                            <p class="text-sm font-semibold text-ink">{{ $store->name }}</p>
                            <p class="text-xs text-ink/50">Diajukan {{ $store->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="rounded-pill bg-white px-3 py-1 text-xs font-semibold text-accent">Menunggu</span>
                    </div>
                @empty
                    <p class="rounded-2xl bg-ink/5 px-4 py-6 text-center text-sm text-ink/50">Belum ada toko yang menunggu persetujuan.</p>
                @endforelse
            </div>
        </div>

        <div class="panel">
            <p class="font-display text-lg font-bold text-ink">Perlu Diketahui</p>
            <ul class="mt-4 list-disc space-y-2 pl-4 text-sm text-ink/70">
                <li>Modul kategori dan produk siap dikembangkan berikutnya.</li>
                <li>Laporan dan export menyusul setelah modul order selesai.</li>
            </ul>
        </div>
    </div>
</x-admin-layout>
