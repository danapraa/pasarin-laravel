<footer class="border-t-2 border-ink/5 bg-white">
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
            <div>
                <div class="flex items-center gap-2">
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-primary font-display text-lg font-bold text-ink">P</span>
                    <span class="font-display text-xl font-bold text-ink">Pasarin</span>
                </div>
                <p class="mt-3 text-sm text-ink/60">Marketplace yang menghubungkan penjual lokal dengan pembeli, di mana saja.</p>
            </div>

            <div>
                <p class="font-display text-sm font-bold text-ink">Belanja</p>
                <ul class="mt-3 space-y-2 text-sm text-ink/60">
                    <li><a href="#kategori" class="hover:text-secondary">Kategori</a></li>
                    <li><a href="#" class="hover:text-secondary">Promo</a></li>
                    <li><a href="#" class="hover:text-secondary">Lacak Pesanan</a></li>
                </ul>
            </div>

            <div>
                <p class="font-display text-sm font-bold text-ink">Jualan</p>
                <ul class="mt-3 space-y-2 text-sm text-ink/60">
                    <li><a href="{{ route('register') }}" class="hover:text-secondary">Buka Toko</a></li>
                    <li><a href="#" class="hover:text-secondary">Pusat Bantuan Seller</a></li>
                </ul>
            </div>

            <div>
                <p class="font-display text-sm font-bold text-ink">Perusahaan</p>
                <ul class="mt-3 space-y-2 text-sm text-ink/60">
                    <li><a href="#" class="hover:text-secondary">Tentang Kami</a></li>
                    <li><a href="#" class="hover:text-secondary">Syarat dan Ketentuan</a></li>
                </ul>
            </div>
        </div>

        <div class="mt-10 border-t border-ink/5 pt-6 text-center text-xs text-ink/50">
            &copy; {{ date('Y') }} Pasarin. Dibuat sebagai proyek portofolio.
        </div>
    </div>
</footer>
