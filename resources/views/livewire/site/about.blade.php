<main>
    <x-site.page-hero
        eyebrow="About ECOSA"
        title="About"
        current="About"
        :image="asset('assets/images/school/Equatorial-College-School5.jpeg')"
    />

    <section class="site-section">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-3">
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

    <section class="site-section bg-white/80">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="site-grid-2">
                <div>
                    <x-site.section-heading
                        eyebrow="Association Positioning"
                        title="The identity is not casual. The presentation is built for confidence."
                        text="A strong association website should reassure alumni, leadership, partners, and the school community that the organization is active, coordinated, and worth engaging."
                    />
                </div>

                <div class="grid gap-5">
                    @foreach ($storyBlocks as $block)
                        <article class="site-card p-7">
                            <h3 class="font-display text-3xl font-semibold text-ecosa-blue-deep">{{ $block['title'] }}</h3>
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
                title="Every visible layer of ECOSA should communicate order, accountability, and service."
                text="These governance pillars shape how the association communicates, manages people and records, and remains aligned to its long-term purpose."
                align="center"
            />

            <div class="mt-10 grid gap-6 lg:grid-cols-3">
                @foreach ($pillars as $pillar)
                    <article class="site-card p-8">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-ecosa-blue/7 text-ecosa-blue">
                            <i class="fas {{ $pillar['icon'] }} text-lg"></i>
                        </div>
                        <h3 class="mt-6 font-display text-3xl font-semibold text-ecosa-blue-deep">{{ $pillar['title'] }}</h3>
                        <p class="mt-4 text-sm leading-7 text-zinc-600">{{ $pillar['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</main>
