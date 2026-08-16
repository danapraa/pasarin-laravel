@props(['color' => 'primary'])

<span {{ $attributes->merge(['class' => "pennant pennant-{$color}"]) }}>
    {{ $slot }}
</span>
