<main>
    <x-site.page-hero
        eyebrow="Community"
        title="Community Programs"
        current="Community"
        :image="asset('assets/images/school/aerialview.jpeg')"
    />

    <section class="site-section">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-3">
                <article class="site-card flex h-full flex-col p-7">
                    <span class="site-chip self-start">Events</span>
                    <h3 class="mt-6 font-display text-2xl font-semibold text-ecosa-blue-deep">Gatherings, forums, and alumni visibility moments.</h3>
                    <div class="mt-5 grid flex-1 gap-4">
                        @foreach ($events as $event)
                            <div class="rounded-[20px] border border-ecosa-blue/8 bg-ecosa-blue/[0.03] p-5">
                                <h4 class="font-display text-xl font-semibold text-ecosa-blue-deep">{{ data_get($event, 'title') }}</h4>
                                <p class="mt-3 text-sm leading-7 text-zinc-600">{{ data_get($event, 'summary') ?: data_get($event, 'text') }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('site.community.events') }}" class="site-btn-ghost w-full">Open Events Page</a>
                    </div>
                </article>

                <article class="site-card flex h-full flex-col p-7">
                    <span class="site-chip self-start">Projects</span>
                    <h3 class="mt-6 font-display text-2xl font-semibold text-ecosa-blue-deep">School-facing and alumni-facing work with clearer presentation.</h3>
                    <div class="mt-5 grid flex-1 gap-4">
                        @foreach ($projects as $project)
                            <div class="rounded-[20px] border border-ecosa-blue/8 bg-ecosa-blue/[0.03] p-5">
                                <h4 class="font-display text-xl font-semibold text-ecosa-blue-deep">{{ data_get($project, 'title') }}</h4>
                                <p class="mt-3 text-sm leading-7 text-zinc-600">{{ data_get($project, 'summary') ?: data_get($project, 'text') }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('site.community.projects') }}" class="site-btn-ghost w-full">Open Projects Page</a>
                    </div>
                </article>

                <article class="site-card flex h-full flex-col p-7">
                    <span class="site-chip self-start">Insurance Group</span>
                    <h3 class="mt-6 font-display text-2xl font-semibold text-ecosa-blue-deep">Member welfare content stands on its own.</h3>
                    <div class="mt-5 grid flex-1 gap-4">
                        @foreach ($insurancePrograms as $program)
                            <div class="rounded-[20px] border border-ecosa-blue/8 bg-ecosa-blue/[0.03] p-5">
                                <h4 class="font-display text-xl font-semibold text-ecosa-blue-deep">{{ data_get($program, 'title') }}</h4>
                                <p class="mt-3 text-sm leading-7 text-zinc-600">{{ data_get($program, 'summary') ?: data_get($program, 'text') }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('site.community.insurance') }}" class="site-btn-ghost w-full">Open Insurance Page</a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="site-section bg-ecosa-mist">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
                <x-site.section-heading
                    eyebrow="Public Updates"
                    title="Community activity supported by a clear update stream."
                    text="Latest updates can be published from the dashboard and presented in a clean, editorial format."
                />
                <a href="{{ route('site.updates') }}" class="site-btn-ghost shrink-0">Open Updates Page</a>
            </div>

            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($updates as $update)
                    <article class="site-card overflow-hidden">
                        <img src="{{ $update->imageUrl() }}" alt="{{ $update->title }}" class="h-56 w-full object-cover">
                        <div class="p-6">
                            <span class="site-chip">{{ $update->category }}</span>
                            <h3 class="mt-5 font-display text-2xl font-semibold text-ecosa-blue-deep">{{ $update->title }}</h3>
                            <p class="mt-4 text-sm leading-7 text-zinc-600">{{ $update->summary }}</p>
                        </div>
                    </article>
                @empty
                    @foreach ($fallbackUpdates as $update)
                        <article class="site-card overflow-hidden">
                            <img src="{{ $update['image'] }}" alt="{{ $update['title'] }}" class="h-56 w-full object-cover">
                            <div class="p-6">
                                <span class="site-chip">{{ $update['category'] }}</span>
                                <h3 class="mt-5 font-display text-2xl font-semibold text-ecosa-blue-deep">{{ $update['title'] }}</h3>
                                <p class="mt-4 text-sm leading-7 text-zinc-600">{{ $update['summary'] }}</p>
                            </div>
                        </article>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>
</main>
