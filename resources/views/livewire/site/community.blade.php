<main>
    <x-site.page-hero
        eyebrow="Community"
        title="Community"
        current="Community"
        :image="asset('assets/images/school/aerialview.jpeg')"
    />

    <section id="community-overview" class="site-section scroll-mt-32">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <x-site.section-heading
                eyebrow="Community Overview"
                title="Events, projects, business, professional networks, and chapters."
                text="This page summarizes the main community areas. Insurance, SACCOs, and circles sit under Projects, while Business Network and Professional Network remain separate so members can find the right kind of connection quickly."
                align="center"
            />

            <div class="mt-10 grid gap-5 md:grid-cols-2 xl:grid-cols-5">
                @foreach ([
                    ['chip' => 'Events', 'icon' => 'fa-calendar-days', 'title' => 'Welfare & Events', 'text' => 'Reunions, sports, social gatherings, welfare conversations, and member support.', 'route' => 'site.community.events'],
                    ['chip' => 'Projects', 'icon' => 'fa-diagram-project', 'title' => 'Shared Projects', 'text' => 'SACCOs, circles, investment groups, insurance groups, and school support activities.', 'route' => 'site.community.projects'],
                    ['chip' => 'Business', 'icon' => 'fa-briefcase', 'title' => 'Business Network', 'text' => 'Alumni-owned businesses, services, products, and referral opportunities.', 'route' => 'site.community.business'],
                    ['chip' => 'Professional', 'icon' => 'fa-user-tie', 'title' => 'Professional Network', 'text' => 'Profiles for hiring, collaboration, mentorship, and career connections.', 'route' => 'site.community.professional'],
                    ['chip' => 'Chapters', 'icon' => 'fa-map-location-dot', 'title' => 'Chapters', 'text' => 'Regional, diaspora, professional, business, and class-year groups for closer coordination.', 'route' => 'site.chapters'],
                ] as $item)
                    @php $itemHref = route($item['route']) . (filled($item['fragment'] ?? null) ? '#' . $item['fragment'] : ''); @endphp
                    <article class="site-card flex h-full flex-col p-7">
                        <div class="flex items-center justify-between gap-4">
                            <span class="site-chip">{{ $item['chip'] }}</span>
                            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-ecosa-green text-white">
                                <i class="fas {{ $item['icon'] }}"></i>
                            </div>
                        </div>
                        <h3 class="mt-6 font-display text-2xl font-semibold text-ecosa-blue-deep">{{ $item['title'] }}</h3>
                        <p class="mt-3 flex-1 text-sm leading-7 text-zinc-600">{{ $item['text'] }}</p>
                        <a href="{{ $itemHref }}" class="mt-6 inline-flex items-center gap-2 text-sm font-bold text-ecosa-green">
                            Open <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="site-section bg-ecosa-mist">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="grid gap-8 lg:grid-cols-2">
                <article id="business-network" class="site-card scroll-mt-32 overflow-hidden">
                    <img src="{{ asset('assets/images/school/aerialview.jpeg') }}" alt="Business network" class="h-64 w-full object-cover">
                    <div class="p-7">
                        <span class="site-chip">Business Network</span>
                        <h2 class="mt-5 font-display text-3xl font-semibold text-ecosa-blue-deep">Alumni businesses should be easy to find.</h2>
                        <p class="mt-4 text-sm leading-7 text-zinc-600">Members can add their business details during registration so alumni can discover business names, services, products, and referral opportunities.</p>
                        <div class="mt-6 grid gap-4">
                            @foreach ($businesses as $business)
                                <div class="rounded-[20px] border border-ecosa-blue/8 bg-ecosa-blue/[0.03] p-5">
                                    <h3 class="font-display text-xl font-semibold text-ecosa-blue-deep">{{ $business['name'] }}</h3>
                                    <p class="mt-2 text-sm leading-7 text-zinc-600">{{ $business['services'] }}</p>
                                </div>
                            @endforeach
                        </div>
                        <a href="{{ route('site.community.business') }}" class="site-btn-primary mt-6 w-full">Open Business Network</a>
                    </div>
                </article>

                <article id="professional-network" class="site-card scroll-mt-32 overflow-hidden">
                    <img src="{{ asset('assets/images/school/Equatorial-College-School5.jpeg') }}" alt="Professional network" class="h-64 w-full object-cover">
                    <div class="p-7">
                        <span class="site-chip">Professional Network</span>
                        <h2 class="mt-5 font-display text-3xl font-semibold text-ecosa-blue-deep">Profiles for hiring, collaboration, and connections.</h2>
                        <div class="mt-6 grid gap-4">
                            @foreach ($professionals as $profile)
                                <div class="rounded-[20px] border border-ecosa-blue/8 bg-white p-5">
                                    <h3 class="font-display text-xl font-semibold text-ecosa-blue-deep">{{ $profile['name'] }}</h3>
                                    <dl class="mt-3 grid gap-2 text-sm leading-6 text-zinc-600">
                                        <div><dt class="inline font-bold text-ecosa-blue-deep">Profession:</dt> <dd class="inline">{{ $profile['profession'] }}</dd></div>
                                        <div><dt class="inline font-bold text-ecosa-blue-deep">Experience:</dt> <dd class="inline">{{ $profile['experience'] }}</dd></div>
                                        <div><dt class="inline font-bold text-ecosa-blue-deep">Skills:</dt> <dd class="inline">{{ $profile['skills'] }}</dd></div>
                                    </dl>
                                </div>
                            @endforeach
                        </div>
                        <a href="{{ route('site.community.professional') }}" class="site-btn-secondary mt-6 w-full">Open Professional Network</a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="site-section bg-white">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <x-site.section-heading
                eyebrow="Shared Opportunities"
                title="Projects, welfare, and chapters are practical entry points."
                text="Community projects include SACCOs, investment groups, alumni initiatives, insurance conversations, and school support activities."
                align="center"
            />

            <div class="mt-10 grid gap-6 lg:grid-cols-3">
                <article class="site-card p-7">
                    <span class="site-chip">Projects</span>
                    <div class="mt-5 grid gap-4">
                        @foreach ($projects as $project)
                            <div class="rounded-[20px] border border-ecosa-blue/8 bg-ecosa-blue/[0.03] p-5">
                                <h3 class="font-display text-xl font-semibold text-ecosa-blue-deep">{{ data_get($project, 'title') }}</h3>
                                <p class="mt-3 text-sm leading-7 text-zinc-600">{{ data_get($project, 'summary') ?: data_get($project, 'text') }}</p>
                            </div>
                        @endforeach
                    </div>
                    <a href="{{ route('site.community.projects') }}" class="site-btn-primary mt-6 w-full">View Projects</a>
                </article>

                <article class="site-card p-7">
                    <span class="site-chip">Welfare & Events</span>
                    <div class="mt-5 grid gap-4">
                        @foreach ($events as $event)
                            <div class="rounded-[20px] border border-ecosa-blue/8 bg-ecosa-blue/[0.03] p-5">
                                <h3 class="font-display text-xl font-semibold text-ecosa-blue-deep">{{ data_get($event, 'title') }}</h3>
                                <p class="mt-3 text-sm leading-7 text-zinc-600">{{ data_get($event, 'summary') ?: data_get($event, 'text') }}</p>
                            </div>
                        @endforeach
                    </div>
                    <a href="{{ route('site.community.events') }}" class="site-btn-primary mt-6 w-full">View Events</a>
                </article>

                <article class="site-card p-7">
                    <span class="site-chip">Chapters</span>
                    <div class="mt-5 grid gap-4">
                        @foreach ($chapters as $chapter)
                            <div class="rounded-[20px] border border-ecosa-blue/8 bg-ecosa-blue/[0.03] p-5">
                                <h3 class="font-display text-xl font-semibold text-ecosa-blue-deep">{{ $chapter['name'] }}</h3>
                                <p class="mt-1 text-xs font-bold uppercase tracking-[0.2em] text-zinc-400">{{ $chapter['region'] }}</p>
                                <p class="mt-3 text-sm leading-7 text-zinc-600">{{ $chapter['focus'] }}</p>
                            </div>
                        @endforeach
                    </div>
                    <a href="{{ route('site.chapters') }}" class="site-btn-primary mt-6 w-full">Open Chapters Page</a>
                </article>
            </div>
        </div>
    </section>

    <section class="site-section bg-ecosa-mist">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <x-site.section-heading
                eyebrow="Community Updates"
                title="Related updates for events, projects, and programs."
                text="Updates remain available inside relevant pages rather than taking a top-level navigation slot."
                align="center"
            />

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
