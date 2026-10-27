@props(['size' => 'h-10 w-10', 'text' => 'text-2xl text-ink', 'showText' => true])

<span {{ $attributes->merge(['class' => 'flex items-center gap-2']) }}>
    <img src="{{ asset('images/logo.jpg') }}" alt="Pasarin" class="{{ $size }} rounded-2xl object-contain">
    @if ($showText)
        <span class="font-display font-bold {{ $text }}">Pasarin</span>
    @endif
</span>
