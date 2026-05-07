<main>
    <x-site.page-hero
        eyebrow="Membership"
        title="Who Qualifies"
        current="Who Qualifies"
        :image="asset('assets/images/school/Equatorial-College-School5.jpeg')"
    />

    <section class="site-section">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="site-grid-2 items-start">
                <div>
                    <x-site.section-heading
                        eyebrow="Membership Eligibility"
                        title="ECOSA membership starts with a clear relationship to Equatorial College School."
                        text="This page separates eligibility from the registration form so visitors can first understand whether they qualify before creating a member record."
                    />

                    <div class="mt-8 grid gap-4">
                        @foreach ($qualifiers as $qualifier)
                            <article class="site-card flex gap-4 p-5">
                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-ecosa-green text-white">
                                    <i class="fas fa-user-check"></i>
                                </div>
                                <p class="text-sm leading-7 text-zinc-600">{{ $qualifier }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>

                <div class="site-card p-7">
                    <span class="site-chip">Next Steps</span>
                    <div class="mt-6 grid gap-4">
                        @foreach ($steps as $step)
                            <div class="rounded-[22px] border border-ecosa-blue/8 bg-ecosa-blue/[0.03] px-5 py-4 text-sm leading-7 text-zinc-600">
                                <span class="mr-2 font-bold text-ecosa-blue">{{ $loop->iteration }}.</span>
                                {{ $step }}
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-7 grid gap-3 sm:grid-cols-2">
                        <a href="{{ route('site.membership.register') }}" class="site-btn-primary">Open Registration</a>
                        <a href="{{ route('site.membership') }}" class="site-btn-secondary">Membership Hub</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
