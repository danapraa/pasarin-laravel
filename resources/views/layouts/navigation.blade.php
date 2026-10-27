<nav class="sticky top-0 z-50 border-b-2 border-ink/5 bg-cream/90 backdrop-blur">
    <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
        <a href="{{ route('welcome') }}">
    <x-logo />
</a>
        <div class="hidden flex-1 max-w-md items-center md:flex mx-8">
            <form action="{{ route('welcome') }}" method="GET" class="relative w-full">
                <input type="text" name="q" placeholder="Cari produk favoritmu..." value="{{ request('q') }}"
                    class="w-full rounded-pill border-2 border-ink/10 bg-white py-2.5 pl-5 pr-12 text-sm focus:border-secondary focus:ring-0" />
                <button type="submit" class="absolute right-1.5 top-1/2 -translate-y-1/2 rounded-full bg-secondary p-2 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" /></svg>
                </button>
            </form>
        </div>

        <div class="flex items-center gap-3">
            @auth
                <a href="#" class="relative rounded-2xl p-2.5 hover:bg-tint-yellow" title="Keranjang">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l3-8H6.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                </a>

                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center gap-2 rounded-2xl border-2 border-ink/10 bg-white py-2 pl-2 pr-4 hover:border-secondary">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-tint-teal font-display font-bold text-secondary">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </span>
                        <span class="text-sm font-semibold">{{ Str::of(Auth::user()->name)->before(' ') }}</span>
                    </button>

                    <div x-show="open" @click.outside="open = false" x-cloak
                        class="absolute right-0 mt-2 w-52 rounded-2xl border-2 border-ink/5 bg-white p-2 shadow-xl">
                        @if (Auth::user()->hasRole('admin'))
                            <a href="{{ route('admin.dashboard') }}" class="block rounded-xl px-3 py-2 text-sm hover:bg-tint-yellow">Dashboard Admin</a>
                        @elseif (Auth::user()->hasRole('seller'))
                            <a href="{{ route('seller.dashboard') }}" class="block rounded-xl px-3 py-2 text-sm hover:bg-tint-yellow">Dashboard Toko</a>
                        @else
                            <a href="{{ route('dashboard') }}" class="block rounded-xl px-3 py-2 text-sm hover:bg-tint-yellow">Akun Saya</a>
                        @endif
                        <a href="{{ route('profile.edit') }}" class="block rounded-xl px-3 py-2 text-sm hover:bg-tint-yellow">Pengaturan Profil</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full rounded-xl px-3 py-2 text-left text-sm text-accent hover:bg-tint-yellow">Keluar</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn-ghost !px-5 !py-2 text-sm">Masuk</a>
                <a href="{{ route('register') }}" class="btn-primary !px-5 !py-2 text-sm">Daftar Gratis</a>
            @endauth
        </div>
    </div>
</nav>
