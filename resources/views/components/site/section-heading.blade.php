@props([
    'eyebrow' => null,
    'title',
    'text' => null,
    'align' => 'left',
])

@php
    $alignment = $align === 'center' ? 'mx-auto text-center items-center' : 'items-start';
@endphp

<div class="flex max-w-3xl flex-col gap-4 {{ $alignment }}">
    @if (filled($eyebrow))
        <span class="site-chip">{{ $eyebrow }}</span>
    @endif
    <h2 class="site-heading text-balance">{{ $title }}</h2>
    @if (filled($text))
        <p class="site-subheading">{{ $text }}</p>
    @endif
</div>
