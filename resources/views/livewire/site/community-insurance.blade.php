<main>
    <x-site.page-hero
        eyebrow="Insurance Group"
        title="Insurance Group"
        current="Insurance Group"
        :image="asset('assets/images/school/aerialview.jpeg')"
    />

    <section class="site-section">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="site-grid-2 items-start">
                <div>
                    <x-site.section-heading
                        eyebrow="Member Welfare"
                        title="Support should be visible enough for members to understand it."
                        text="This page helps explain the association’s welfare orientation in a way that feels deliberate, readable, and easy to revisit from the public navigation."
                    />

                    <div class="mt-8 grid gap-4">
                        <div class="site-card p-6">
                            <h3 class="font-display text-3xl font-semibold text-ecosa-blue-deep">What the page communicates</h3>
                            <p class="mt-4 text-sm leading-7 text-zinc-600">
                                The insurance group can be used to explain solidarity support, household protection conversations, emergency response coordination, and the association’s welfare mindset.
                            </p>
                        </div>
                        <div class="site-card p-6">
                            <h3 class="font-display text-3xl font-semibold text-ecosa-blue-deep">Why this matters</h3>
                            <p class="mt-4 text-sm leading-7 text-zinc-600">
                                Senior alumni and prospective members often judge the seriousness of an association by how clearly it presents member support structures.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid gap-5">
                    @foreach ($programs as $program)
                        @php
                            $title = data_get($program, 'title');
                            $summary = data_get($program, 'summary') ?: data_get($program, 'text');
                            $location = data_get($program, 'location') ?: data_get($program, 'meta');
                        @endphp
                        <article class="site-card p-7">
                            <span class="site-chip">Insurance Group</span>
                            <h2 class="mt-5 font-display text-4xl font-semibold text-ecosa-blue-deep">{{ $title }}</h2>
                            <p class="mt-4 text-sm leading-7 text-zinc-600">{{ $summary }}</p>
                            @if (filled($location))
                                <p class="mt-4 text-sm font-semibold text-ecosa-green-deep">{{ $location }}</p>
                            @endif
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</main>
