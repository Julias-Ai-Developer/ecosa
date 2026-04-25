<main>
    <x-site.page-hero
        eyebrow="Leadership"
        title="Leadership"
        current="Leadership"
        :image="asset('assets/images/school/aerialview.jpeg')"
    />

    <section class="site-section">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="grid gap-6 md:grid-cols-3">
                @foreach ($metrics as $metric)
                    <article class="site-card p-7">
                        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">{{ $metric['label'] }}</p>
                        <p class="mt-4 font-display text-5xl font-semibold text-ecosa-blue-deep">{{ $metric['value'] }}</p>
                    </article>
                @endforeach
            </div>

            <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($leaders as $leader)
                    @php
                        $displayPhoto = ! empty($leader['photo'])
                            ? $leader['photo']
                            : asset('assets/images/placeholders/leader-placeholder.svg');
                    @endphp
                    <article class="site-card overflow-hidden">
                        <div class="relative p-4">
                            <img src="{{ $displayPhoto }}" alt="{{ $leader['title'] }}" class="h-72 w-full rounded-[26px] object-cover">

                            <div class="absolute left-8 top-8 rounded-full border border-white/16 bg-white/88 px-4 py-2 text-xs font-bold uppercase tracking-[0.22em] text-ecosa-blue-deep shadow-lg">
                                {{ $leader['portfolio'] }}
                            </div>
                        </div>

                        <div class="px-6 pb-7">
                            <h2 class="font-display text-4xl font-semibold text-ecosa-blue-deep">{{ $leader['title'] }}</h2>
                            @if (! empty($leader['name']))
                                <p class="mt-2 text-sm font-semibold text-zinc-500">{{ $leader['name'] }}</p>
                            @endif
                            <p class="mt-4 text-sm leading-7 text-zinc-600">{{ $leader['focus'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</main>
