<main>
    <x-site.page-hero
        eyebrow="Governance"
        title="Governance"
        current="Governance"
        :image="asset('assets/images/school/Equatorial-College-School5.jpeg')"
    />

    <section class="site-section">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <x-site.section-heading
                eyebrow="Core Pillars"
                title="The governance story is built on more than titles."
                text="What matters is the clarity of structure, the reliability of records, the visibility of programs, and the discipline behind administrative decisions."
                align="center"
            />

            <div class="mt-10 grid gap-6 lg:grid-cols-3">
                @foreach ($pillars as $pillar)
                    <article class="site-card p-8">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-ecosa-blue/8 text-ecosa-blue">
                            <i class="fas {{ $pillar['icon'] }} text-lg"></i>
                        </div>
                        <h3 class="mt-6 font-display text-3xl font-semibold text-ecosa-blue-deep">{{ $pillar['title'] }}</h3>
                        <p class="mt-4 text-sm leading-7 text-zinc-600">{{ $pillar['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="site-section bg-white/80">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="site-grid-2">
                <div class="site-card overflow-hidden rounded-[32px] p-3">
                    <img src="{{ asset('assets/images/school/aerialview.jpeg') }}" alt="Equatorial College School" class="h-full min-h-[340px] w-full rounded-[26px] object-cover">
                </div>

                <div class="grid gap-5">
                    @foreach ($frameworks as $framework)
                        <article class="site-card p-7">
                            <h3 class="font-display text-3xl font-semibold text-ecosa-blue-deep">{{ $framework['title'] }}</h3>
                            <p class="mt-4 text-sm leading-7 text-zinc-600">{{ $framework['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</main>
