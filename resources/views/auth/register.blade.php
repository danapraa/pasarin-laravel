<x-guest-layout>
    <h1 class="font-display text-3xl font-bold text-ink">Buat akun baru</h1>
    <p class="mt-2 text-sm text-ink/60">Gratis, dan cuma butuh sebentar.</p>

    <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-5">
        @csrf

        <div>
            <x-input-label for="name" value="Nama Lengkap" />
            <x-text-input id="name" class="mt-1.5 block w-full rounded-2xl border-2 border-ink/10 focus:border-secondary focus:ring-0" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nama kamu" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="mt-1.5 block w-full rounded-2xl border-2 border-ink/10 focus:border-secondary focus:ring-0" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" value="Kata Sandi" />
            <x-text-input id="password" class="mt-1.5 block w-full rounded-2xl border-2 border-ink/10 focus:border-secondary focus:ring-0" type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" value="Konfirmasi Kata Sandi" />
            <x-text-input id="password_confirmation" class="mt-1.5 block w-full rounded-2xl border-2 border-ink/10 focus:border-secondary focus:ring-0" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi kata sandi" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit" class="btn-primary w-full">Daftar</button>

        <p class="rounded-2xl bg-tint-yellow px-4 py-3 text-center text-xs text-ink/70">
            Ingin jualan di Pasarin? Daftar dulu sebagai pembeli, lalu buka toko dari halaman akunmu.
        </p>

        <p class="text-center text-sm text-ink/60">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-semibold text-secondary hover:underline">Masuk di sini</a>
        </p>
    </form>
</x-guest-layout>
