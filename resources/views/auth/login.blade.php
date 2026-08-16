<x-guest-layout>
    <h1 class="font-display text-3xl font-bold text-ink">Selamat datang kembali</h1>
    <p class="mt-2 text-sm text-ink/60">Masuk untuk lanjut belanja atau kelola tokomu.</p>

    <x-auth-session-status class="mb-4 mt-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-5">
        @csrf

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="mt-1.5 block w-full rounded-2xl border-2 border-ink/10 focus:border-secondary focus:ring-0" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" value="Kata Sandi" />
            <x-text-input id="password" class="mt-1.5 block w-full rounded-2xl border-2 border-ink/10 focus:border-secondary focus:ring-0" type="password" name="password" required autocomplete="current-password" placeholder="Kata sandi" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 text-sm text-ink/70">
                <input type="checkbox" name="remember" class="rounded-md border-ink/20 text-secondary focus:ring-secondary">
                Ingat saya
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-semibold text-secondary hover:underline" href="{{ route('password.request') }}">
                    Lupa sandi?
                </a>
            @endif
        </div>

        <button type="submit" class="btn-primary w-full">Masuk</button>

        <p class="text-center text-sm text-ink/60">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-semibold text-secondary hover:underline">Daftar sekarang</a>
        </p>
    </form>
</x-guest-layout>
