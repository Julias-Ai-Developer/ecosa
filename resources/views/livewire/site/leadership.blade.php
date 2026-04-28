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

            <div class="mt-12 text-center">
                <h2 class="font-display text-3xl font-bold text-ecosa-blue-deep sm:text-4xl">Management Team</h2>
            </div>

            <div class="mt-6 grid gap-x-6 gap-y-8 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($leaders as $leader)
                    @php
                        $displayPhoto = ! empty($leader['photo'])
                            ? $leader['photo']
                            : asset('assets/images/placeholders/leader-placeholder.svg');
                        $displayName = ! empty($leader['name']) ? $leader['name'] : $leader['title'];
                        $displayRole = ! empty($leader['name']) ? $leader['title'] : $leader['portfolio'];
                    @endphp
                    <article class="overflow-hidden rounded-[3px] bg-white shadow-sm ring-1 ring-zinc-100">
                        <div class="aspect-[4/4.45] overflow-hidden bg-zinc-100">
                            <img
                                src="{{ $displayPhoto }}"
                                alt="{{ $displayName }}"
                                class="h-full w-full object-cover"
                            >
                        </div>

                        <div class="min-h-[74px] px-4 py-4 text-center">
                            <h3 class="text-sm font-extrabold leading-snug text-zinc-950">{{ $displayName }}</h3>
                            <p class="mt-1 text-[0.68rem] font-medium leading-5 text-blue-600">{{ $displayRole }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="site-section bg-white">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <x-site.section-heading
                eyebrow="Leadership Structure"
                title="Different levels exist for different guidance needs."
                text="The association can show photos and contact direction for executive leaders, patrons, pioneers, chapter leaders, and class representatives."
                align="center"
            />

            <div class="mt-10 grid gap-5 md:grid-cols-2 xl:grid-cols-4">
                @foreach($leadershipGroups as $group)
                    <article class="site-card p-6">
                        <h3 class="font-display text-2xl font-semibold text-ecosa-blue-deep">{{ $group['title'] }}</h3>
                        <p class="mt-3 text-sm leading-7 text-zinc-600">{{ $group['text'] }}</p>
                        <div class="mt-5 flex flex-wrap gap-2">
                            @foreach($group['roles'] as $role)
                                <span class="rounded-full bg-ecosa-blue/8 px-3 py-1 text-xs font-bold text-ecosa-blue-deep">{{ $role }}</span>
                            @endforeach
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="site-section bg-ecosa-mist">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <x-site.section-heading
                eyebrow="Whom To Contact"
                title="Leadership is organized by guidance level."
                text="Members can seek help from the right level depending on the issue, from patron-level guidance to elders, executive leaders, and chapter contacts."
                align="center"
            />

            <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($contactLevels as $contactLevel)
                    <article class="site-card p-6">
                        <span class="site-chip">{{ $loop->iteration }}</span>
                        <h3 class="mt-5 font-display text-2xl font-semibold text-ecosa-blue-deep">{{ $contactLevel['level'] }}</h3>
                        <p class="mt-3 text-sm leading-7 text-zinc-600">{{ $contactLevel['purpose'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</main>
