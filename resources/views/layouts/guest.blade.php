<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Pasarin') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-cream font-sans text-ink antialiased">
    <div class="flex min-h-screen">
        <div class="relative hidden w-1/2 flex-col justify-between overflow-hidden bg-secondary p-12 lg:flex">
            <a href="{{ route('welcome') }}" class="relative z-10 flex items-center gap-2">
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-primary font-display text-2xl font-bold text-ink">P</span>
                <span class="font-display text-2xl font-bold text-white">Pasarin</span>
            </a>

            <div class="relative z-10 max-w-sm">
                <h2 class="font-display text-4xl font-bold leading-tight text-white">
                    Belanja dan jualan jadi lebih dekat.
                </h2>
                <p class="mt-4 text-white/80">
                    Ribuan toko lokal, satu tempat belanja. Gabung dan mulai transaksi hari ini.
                </p>
            </div>

            <div class="pointer-events-none absolute -right-6 top-16 rotate-6">
                <x-pennant color="primary">Gratis Ongkir</x-pennant>
            </div>
            <div class="pointer-events-none absolute right-24 top-48 -rotate-3">
                <x-pennant color="ink">Toko Terverifikasi</x-pennant>
            </div>
            <div class="pointer-events-none absolute bottom-24 right-10 rotate-3">
                <x-pennant color="primary">1000+ Penjual</x-pennant>
            </div>

            <div class="pointer-events-none absolute -bottom-24 -left-24 h-72 w-72 rounded-full bg-white/5"></div>
            <div class="pointer-events-none absolute -top-16 right-1/3 h-40 w-40 rounded-full bg-white/5"></div>
        </div>

        <div class="flex w-full flex-col items-center justify-center px-6 py-12 lg:w-1/2">
            <div class="w-full max-w-sm">
                <a href="{{ route('welcome') }}" class="mb-8 flex items-center gap-2 lg:hidden">
                    <span class="flex h-10 w-10 items-center justify-center rounded-2xl bg-primary font-display text-xl font-bold text-ink">P</span>
                    <span class="font-display text-2xl font-bold text-ink">Pasarin</span>
                </a>

                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>
