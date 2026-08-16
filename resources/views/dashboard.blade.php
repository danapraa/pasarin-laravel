<x-app-layout>
    <div class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
        <h1 class="font-display text-3xl font-bold text-ink">Akun Saya</h1>
        <p class="mt-1 text-sm text-ink/60">Halo, {{ auth()->user()->name }}</p>

        <div class="mt-8 grid gap-5 sm:grid-cols-3">
            <a href="{{ route('profile.edit') }}" class="card-stall">
                <div class="badge-circle bg-tint-yellow text-ink">PF</div>
                <p class="mt-4 font-display text-base font-bold text-ink">Profil</p>
                <p class="text-sm text-ink/60">Ubah nama, email, dan kata sandi</p>
            </a>

            <div class="card-stall opacity-60">
                <div class="badge-circle bg-tint-teal text-secondary">RW</div>
                <p class="mt-4 font-display text-base font-bold text-ink">Riwayat Pesanan</p>
                <p class="text-sm text-ink/60">Segera hadir</p>
            </div>

            <div class="card-stall opacity-60">
                <div class="badge-circle bg-accent/10 text-accent">WL</div>
                <p class="mt-4 font-display text-base font-bold text-ink">Wishlist</p>
                <p class="text-sm text-ink/60">Segera hadir</p>
            </div>
        </div>
    </div>
</x-app-layout>
