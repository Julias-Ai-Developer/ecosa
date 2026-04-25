<main>
    <x-site.page-hero
        eyebrow="About ECOSA"
        title="About ECOSA"
        current="About"
        :image="asset('assets/images/school/Equatorial-College-School5.jpeg')"
    />

    <section class="site-section">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="grid gap-6 sm:grid-cols-3">
                @foreach ($highlights as $highlight)
                    <article class="site-card p-8">
                        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">{{ $highlight['label'] }}</p>
                        <p class="mt-4 font-display text-5xl font-semibold text-ecosa-blue-deep">{{ $highlight['value'] }}</p>
                        <p class="mt-4 text-sm leading-7 text-zinc-600">{{ $highlight['detail'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="site-section bg-ecosa-mist">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="grid gap-10 lg:grid-cols-2 lg:items-start">
                <div class="lg:sticky lg:top-28">
                    <x-site.section-heading
                        eyebrow="Association Positioning"
                        title="The identity is built for confidence."
                        text="A strong association website reassures alumni, leadership, partners, and the school community that the organization is active, coordinated, and worth engaging."
                    />
                    <div class="mt-8">
                        <a href="{{ route('site.membership.register') }}" class="site-btn-primary">
                            <span>Join ECOSA</span>
                            <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>

                <div class="grid gap-5">
                    @foreach ($storyBlocks as $block)
                        <article class="site-card p-7">
                            <h3 class="font-display text-2xl font-semibold text-ecosa-blue-deep">{{ $block['title'] }}</h3>
                            <p class="mt-4 text-sm leading-7 text-zinc-600">{{ $block['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <x-site.section-heading
                eyebrow="What anchors the organization"
                title="Order, accountability, and service."
                text="These governance pillars shape how the association communicates, manages people and records, and remains aligned to its long-term purpose."
                align="center"
            />

            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($pillars as $pillar)
                    <article class="site-card p-8">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-ecosa-blue/[0.08] text-ecosa-blue">
                            <i class="fas {{ $pillar['icon'] }} text-lg"></i>
                        </div>
                        <h3 class="mt-6 font-display text-2xl font-semibold text-ecosa-blue-deep">{{ $pillar['title'] }}</h3>
                        <p class="mt-4 text-sm leading-7 text-zinc-600">{{ $pillar['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</main>
