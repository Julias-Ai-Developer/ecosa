<main>
    <x-site.page-hero
        eyebrow="Community Projects"
        title="Our Projects"
        current="Projects"
        :image="asset('assets/images/school/Equatorial-College-School5.jpeg')"
    />

    <section class="site-section">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">

            <div class="mb-12 text-center">
                <x-site.section-heading
                    eyebrow="ECOSA Projects"
                    title="Community projects that create lasting impact."
                    text="From campus improvements to mentorship networks, ECOSA projects connect alumni effort with real school and community outcomes."
                    align="center"
                />
            </div>

            @if (count($projects) > 0)
                {{-- Featured first project --}}
                @php
                    $first = $projects[0];
                    $firstTitle   = data_get($first, 'title');
                    $firstSummary = data_get($first, 'summary') ?: data_get($first, 'text');
                    $firstBody    = data_get($first, 'body');
                    $firstLoc     = data_get($first, 'location') ?: data_get($first, 'meta');
                    $firstStatus  = data_get($first, 'status', 'active');
                    $firstImage   = is_object($first) && method_exists($first, 'imageUrl') ? $first->imageUrl() : asset('assets/images/school/Equatorial-College-School5.jpeg');
                @endphp
                <article class="site-card mb-10 overflow-hidden lg:grid lg:grid-cols-2">
                    <div class="relative h-72 lg:h-auto">
                        <img src="{{ $firstImage }}" alt="{{ $firstTitle }}" class="h-full w-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent lg:bg-gradient-to-r"></div>
                        <span class="absolute left-5 top-5 rounded-full bg-ecosa-green px-4 py-1.5 text-xs font-bold uppercase tracking-[0.2em] text-white shadow">
                            {{ ucfirst($firstStatus) }}
                        </span>
                    </div>
                    <div class="flex flex-col justify-center p-8 lg:p-10">
                        <span class="site-chip">Featured Project</span>
                        <h2 class="mt-5 font-display text-4xl font-semibold leading-tight text-ecosa-blue-deep sm:text-5xl">{{ $firstTitle }}</h2>
                        <p class="mt-5 text-base leading-8 text-zinc-600">{{ $firstSummary }}</p>
                        @if ($firstBody)
                            <p class="mt-3 text-sm leading-7 text-zinc-500">{{ str($firstBody)->limit(200) }}</p>
                        @endif
                        @if (filled($firstLoc))
                            <div class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-ecosa-green-deep">
                                <i class="fas fa-location-dot text-ecosa-green"></i>
                                {{ $firstLoc }}
                            </div>
                        @endif
                        <a href="{{ route('site.membership.register') }}" class="site-btn-primary mt-6 w-fit">
                            Join &amp; Participate <i class="fas fa-arrow-right ml-1 text-xs"></i>
                        </a>
                    </div>
                </article>

                {{-- Remaining projects grid --}}
                @if (count($projects) > 1)
                    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                        @foreach ($projects as $i => $project)
                            @if ($i === 0) @continue @endif
                            @php
                                $title   = data_get($project, 'title');
                                $summary = data_get($project, 'summary') ?: data_get($project, 'text');
                                $loc     = data_get($project, 'location') ?: data_get($project, 'meta');
                                $status  = data_get($project, 'status', 'active');
                                $image   = is_object($project) && method_exists($project, 'imageUrl') ? $project->imageUrl() : asset('assets/images/school/Equatorial-College-School5.jpeg');
                            @endphp
                            <article class="site-card group overflow-hidden">
                                <div class="relative h-52 overflow-hidden">
                                    <img src="{{ $image }}" alt="{{ $title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                    <span class="absolute left-4 top-4 rounded-full px-3 py-1 text-xs font-bold uppercase tracking-[0.18em] {{ $status === 'active' ? 'bg-ecosa-green text-white' : ($status === 'completed' ? 'bg-ecosa-blue text-white' : 'bg-ecosa-gold text-ecosa-ink') }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </div>
                                <div class="p-6">
                                    <span class="site-chip">Community Project</span>
                                    <h3 class="mt-4 font-display text-3xl font-semibold leading-tight text-ecosa-blue-deep">{{ $title }}</h3>
                                    <p class="mt-3 text-sm leading-7 text-zinc-600">{{ str($summary)->limit(160) }}</p>
                                    @if (filled($loc))
                                        <div class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-ecosa-green-deep">
                                            <i class="fas fa-location-dot text-ecosa-green text-xs"></i>
                                            {{ $loc }}
                                        </div>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            @else
                {{-- Empty state --}}
                <div class="py-20 text-center">
                    <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-ecosa-blue/8">
                        <i class="fas fa-briefcase text-3xl text-ecosa-blue/40"></i>
                    </div>
                    <h3 class="mt-6 font-display text-3xl font-semibold text-ecosa-blue-deep">Projects Coming Soon</h3>
                    <p class="mx-auto mt-4 max-w-md text-sm leading-7 text-zinc-500">ECOSA community projects are being prepared. Check back soon or contact the team for details.</p>
                    <a href="{{ route('site.contact') }}" class="site-btn-primary mt-6 inline-flex">Contact the Team</a>
                </div>
            @endif
        </div>
    </section>

    {{-- CTA Banner --}}
    <div class="bg-ecosa-blue-deep py-14 text-center text-white">
        <div class="mx-auto max-w-2xl px-5">
            <p class="font-accent text-xs font-bold uppercase tracking-[0.3em] text-ecosa-gold">Get Involved</p>
            <h2 class="mt-4 font-display text-4xl font-semibold sm:text-5xl">Be part of the projects that matter.</h2>
            <p class="mx-auto mt-5 max-w-xl text-base leading-8 text-white/72">
                Register as a member to contribute to ECOSA community projects, school-support initiatives, and mentorship programs.
            </p>
            <div class="mt-8 flex flex-wrap justify-center gap-4">
                <a href="{{ route('site.membership.register') }}" class="site-btn-primary">Register as Member</a>
                <a href="{{ route('site.community') }}" class="site-btn-ghost border-white/20 bg-transparent text-white hover:bg-white/10">View Community</a>
            </div>
        </div>
    </div>
</main>
