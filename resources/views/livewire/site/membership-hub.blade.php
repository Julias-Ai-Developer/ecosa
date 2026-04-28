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

                    <div class="mt-8">
                        <span class="site-chip">Ground Rules</span>
                        <div class="mt-4 grid gap-4">
                            @foreach ($guidingPrinciples as $principle)
                                <article class="rounded-[22px] border border-ecosa-blue/8 bg-ecosa-blue/[0.03] p-5">
                                    <h3 class="font-display text-xl font-semibold text-ecosa-blue-deep">{{ $principle['title'] }}</h3>
                                    <p class="mt-2 text-sm leading-7 text-zinc-600">{{ $principle['text'] }}</p>
                                </article>
                            @endforeach
                        </div>
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
                        <p class="mt-4 text-sm leading-7 text-zinc-600">Members choose what they are paying for, confirm payment details, and ECOSA verifies before activation or reporting.</p>
                        <div class="mt-5 grid gap-3 sm:grid-cols-2">
                            @foreach ($paymentPurposeOptions as $paymentPurpose)
                                <div class="rounded-[20px] border border-ecosa-blue/8 px-4 py-3 text-sm font-bold text-ecosa-blue-deep">{{ $paymentPurpose }}</div>
                            @endforeach
                        </div>
                        <div class="mt-5 grid gap-3 sm:grid-cols-2">
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

    <section class="site-section bg-ecosa-mist">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <x-site.section-heading
                eyebrow="Chapters & Business Support"
                title="Help members find close friends, professionals, and alumni businesses."
                text="Chapters keep members connected by location or coordination group. A member should belong to one primary chapter at a time, while the directory can still help everyone search by chapter, profession, or business."
                align="center"
            />

            <div class="mt-10 grid gap-5 md:grid-cols-3">
                @foreach ($chapters as $chapter)
                    <article class="site-card p-7">
                        <span class="site-chip">{{ $chapter['region'] }}</span>
                        <h3 class="mt-5 font-display text-2xl font-semibold text-ecosa-blue-deep">{{ $chapter['name'] }}</h3>
                        <p class="mt-3 text-sm leading-7 text-zinc-600">{{ $chapter['focus'] }}</p>
                        <a href="{{ route('site.membership.register', ['payment_purpose' => 'chapter_support']) }}" class="mt-5 inline-flex items-center gap-2 text-sm font-bold text-ecosa-green">
                            Join or support this chapter <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</main>
