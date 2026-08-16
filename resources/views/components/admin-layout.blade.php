@props(['title' => 'Dashboard Admin'])

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} - Pasarin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-tint-yellow/40 font-sans text-ink antialiased" x-data="{ sidebarOpen: false }">
    <div class="flex min-h-screen">
        <aside class="fixed inset-y-0 left-0 z-40 w-64 -translate-x-full border-r-2 border-ink/5 bg-white transition-transform lg:static lg:translate-x-0"
               :class="sidebarOpen && '!translate-x-0'">
            <div class="flex h-20 items-center gap-2 px-6">
                <span class="flex h-10 w-10 items-center justify-center rounded-2xl bg-primary font-display text-xl font-bold text-ink">P</span>
                <div>
                    <p class="font-display text-lg font-bold leading-none text-ink">Pasarin</p>
                    <p class="text-xs font-semibold text-secondary">Admin</p>
                </div>
            </div>

            <nav class="mt-4 space-y-1 px-4">
                @php
                    $adminLinks = [
                        ['label' => 'Ringkasan', 'route' => 'admin.dashboard', 'match' => 'admin.dashboard', 'icon' => 'RK'],
                        ['label' => 'Toko & Seller', 'route' => 'admin.dashboard', 'match' => 'admin.stores.*', 'icon' => 'TK'],
                        ['label' => 'Kategori', 'route' => 'admin.categories.index', 'match' => 'admin.categories.*', 'icon' => 'KT'],
                        ['label' => 'Produk', 'route' => 'admin.products.index', 'match' => 'admin.products.*', 'icon' => 'PR'],
                        ['label' => 'Pesanan', 'route' => 'admin.dashboard', 'match' => 'admin.orders.*', 'icon' => 'PS'],
                        ['label' => 'Pencairan Dana', 'route' => 'admin.dashboard', 'match' => 'admin.withdrawals.*', 'icon' => 'RP'],
                        ['label' => 'Banner', 'route' => 'admin.dashboard', 'match' => 'admin.banners.*', 'icon' => 'BN'],
                    ];
                @endphp

                @foreach ($adminLinks as $link)
                    <a href="{{ route($link['route']) }}"
                       class="flex items-center gap-3 rounded-2xl px-4 py-2.5 text-sm font-semibold transition
                       {{ request()->routeIs($link['match']) ? 'bg-tint-yellow text-ink' : 'text-ink/60 hover:bg-tint-yellow/60 hover:text-ink' }}">
                        <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-ink/5 font-display text-[10px] font-bold">{{ $link['icon'] }}</span>
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </nav>
        </aside>

        <div class="flex flex-1 flex-col">
            <header class="flex h-20 items-center justify-between border-b-2 border-ink/5 bg-white px-6">
                <button @click="sidebarOpen = !sidebarOpen" class="rounded-xl p-2 hover:bg-tint-yellow lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" /></svg>
                </button>

                <h1 class="font-display text-xl font-bold text-ink">{{ $title }}</h1>

                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center gap-2 rounded-2xl border-2 border-ink/10 py-1.5 pl-1.5 pr-3 hover:border-secondary">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-tint-teal font-display font-bold text-secondary">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </span>
                        <span class="text-sm font-semibold">{{ auth()->user()->name }}</span>
                    </button>

                    <div x-show="open" @click.outside="open = false" x-cloak class="absolute right-0 mt-2 w-48 rounded-2xl border-2 border-ink/5 bg-white p-2 shadow-xl">
                        <a href="{{ route('welcome') }}" class="block rounded-xl px-3 py-2 text-sm hover:bg-tint-yellow">Lihat Situs Publik</a>
                        <a href="{{ route('profile.edit') }}" class="block rounded-xl px-3 py-2 text-sm hover:bg-tint-yellow">Pengaturan Profil</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full rounded-xl px-3 py-2 text-left text-sm text-accent hover:bg-tint-yellow">Keluar</button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="flex-1 p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
