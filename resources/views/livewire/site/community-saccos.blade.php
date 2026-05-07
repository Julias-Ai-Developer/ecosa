<main>
    <x-site.page-hero
        eyebrow="Shared Projects"
        title="SACCOs & Circles"
        current="SACCOs & Circles"
        :image="asset('assets/images/school/Equatorial-College-School5.jpeg')"
    />

    <section class="site-section">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <x-site.section-heading
                eyebrow="Savings & Shared Opportunity"
                title="Members can organize around savings circles, investment groups, and SACCO conversations."
                text="This page gives SACCOs and circles their own destination while keeping them logically under Community Projects."
                align="center"
            />

            <div class="mt-10 grid gap-5 md:grid-cols-3">
                @foreach ($opportunities as $opportunity)
                    <article class="site-card p-7">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-ecosa-green text-white">
                            <i class="fas fa-piggy-bank"></i>
                        </div>
                        <h2 class="mt-5 font-display text-2xl font-semibold text-ecosa-blue-deep">{{ $opportunity['title'] }}</h2>
                        <p class="mt-3 text-sm leading-7 text-zinc-600">{{ $opportunity['text'] }}</p>
                    </article>
                @endforeach
            </div>

            <div class="mt-10 rounded-[24px] bg-ecosa-blue-deep p-8 text-white">
                <div class="grid gap-6 lg:grid-cols-[1fr_auto] lg:items-center">
                    <div>
                        <p class="font-accent text-xs font-bold uppercase tracking-[0.28em] text-ecosa-gold">Project Support</p>
                        <h2 class="mt-3 font-display text-3xl font-semibold">Register to participate or support a shared project.</h2>
                        <p class="mt-3 max-w-2xl text-sm leading-7 text-white/72">Members can use registration and contribution options to support chapter projects, SACCO discussions, circles, and other shared opportunities.</p>
                    </div>
                    <a href="{{ route('site.membership.register', ['payment_purpose' => 'project_support']) }}" class="site-btn-primary bg-white text-ecosa-blue-deep hover:bg-ecosa-gold">Support a Project</a>
                </div>
            </div>
        </div>
    </section>
</main>
