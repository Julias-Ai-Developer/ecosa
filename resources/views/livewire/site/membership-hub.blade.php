<main>
    <x-site.page-hero
        eyebrow="Membership"
        title="Membership"
        current="Membership"
        :image="asset('assets/images/school/Equatorial-College-School5.jpeg')"
    />

    <section class="site-section">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="site-grid-2 items-start">
                <div>
                    <x-site.section-heading
                        eyebrow="Membership Benefits"
                        title="A stronger public explanation before registration starts."
                        text="This page gives visitors the clarity they need before entering the actual registration form and payment step."
                    />
                    <div class="mt-8 grid gap-4">
                        @foreach ($benefits as $benefit)
                            <div class="site-card flex gap-4 rounded-[24px] p-5">
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-ecosa-blue text-white">
                                    <i class="fas fa-check"></i>
                                </div>
                                <p class="text-sm leading-7 text-zinc-600">{{ $benefit }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="grid gap-5">
                    <article class="site-card p-7">
                        <span class="site-chip">Registration Process</span>
                        <div class="mt-5 grid gap-4">
                            @foreach ($steps as $step)
                                <div class="rounded-[24px] bg-ecosa-blue/[0.03] px-5 py-4 text-sm leading-7 text-zinc-600">
                                    <span class="mr-2 font-bold text-ecosa-blue">{{ $loop->iteration }}.</span>
                                    {{ $step }}
                                </div>
                            @endforeach
                        </div>
                    </article>

                    <article class="site-card p-7">
                        <span class="site-chip">Professional Reach</span>
                        <div class="mt-5 grid gap-3 text-sm font-semibold text-zinc-700 sm:grid-cols-2">
                            @foreach ($sectors as $sector)
                                <div class="rounded-[22px] border border-ecosa-blue/8 px-4 py-3">{{ $sector }}</div>
                            @endforeach
                        </div>
                    </article>

                    <article class="site-card p-7">
                        <span class="site-chip">Payments</span>
                        <div class="mt-5 grid gap-3 sm:grid-cols-3">
                            @foreach ($paymentOptions as $paymentLabel)
                                <div class="rounded-[24px] bg-ecosa-green/[0.08] px-4 py-5 text-center text-sm font-bold text-ecosa-blue-deep">{{ $paymentLabel }}</div>
                            @endforeach
                        </div>
                        <a href="{{ route('site.membership.register') }}" class="site-btn-primary mt-6 w-full">Go to Registration Form</a>
                    </article>
                </div>
            </div>
        </div>
    </section>
</main>
