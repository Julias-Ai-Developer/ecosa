@props([
    'eyebrow' => 'ECOSA',
    'title',
    'text',
    'image' => null,
    'align' => 'left',
    'current' => null,
])

@php
    $hasText = filled($text ?? null);
    $centered = $align === 'center';
    $currentPage = filled($current) ? $current : $eyebrow;
@endphp

<section class="relative overflow-hidden bg-[linear-gradient(135deg,#173a60_0%,#214c78_55%,#193d63_100%)] text-white">
    @if (filled($image))
        <img src="{{ $image }}" alt="" class="absolute inset-0 h-full w-full object-cover opacity-16" aria-hidden="true">
    @endif

    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(255,255,255,0.08),transparent_24%),radial-gradient(circle_at_bottom_right,rgba(23,146,75,0.14),transparent_24%)]"></div>
    <div class="absolute inset-0 bg-[linear-gradient(90deg,rgba(16,43,71,0.88),rgba(23,58,96,0.82),rgba(16,43,71,0.88))]"></div>

    <div class="relative mx-auto max-w-7xl px-5 py-7 lg:px-8 lg:py-9">
        <div class="{{ $centered ? 'mx-auto max-w-4xl text-center' : 'max-w-5xl' }} animate-fade-up">
            @if (filled($eyebrow))
                <p class="font-accent text-sm font-medium leading-6 text-white/86 {{ $centered ? 'mx-auto max-w-3xl' : 'max-w-3xl' }}">
                    {{ $eyebrow }}
                </p>
            @endif

            <h1 class="mt-1 font-display text-2xl font-bold leading-tight text-white sm:text-3xl lg:text-4xl {{ $centered ? 'mx-auto max-w-3xl' : 'max-w-4xl' }}">
                {{ $title }}
            </h1>

            <div class="font-accent mt-3 flex flex-wrap items-center gap-2 text-xs font-semibold text-white/88 sm:text-sm {{ $centered ? 'justify-center' : '' }}">
                <a href="{{ route('home') }}" class="hover:text-white">Home</a>
                <span class="text-white/52">/</span>
                <span class="text-white">{{ $currentPage }}</span>
            </div>

            @if ($hasText)
                <p class="mt-3 text-sm leading-7 text-white/72 {{ $centered ? 'mx-auto max-w-3xl' : 'max-w-3xl' }}">
                    {{ $text }}
                </p>
            @endif
        </div>
    </div>
</section>
