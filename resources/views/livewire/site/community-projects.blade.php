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
                <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($projects as $project)
                        @php
                            $title    = data_get($project, 'title');
                            $summary  = data_get($project, 'summary') ?: data_get($project, 'text', '');
                            $loc      = data_get($project, 'location') ?: data_get($project, 'meta', '');
                            $status   = data_get($project, 'status', 'active');
                            $image    = is_object($project) && method_exists($project, 'imageUrl')
                                            ? $project->imageUrl()
                                            : asset('assets/images/school/Equatorial-College-School5.jpeg');
                            $schedule = is_object($project) && method_exists($project, 'scheduleLabel')
                                            ? $project->scheduleLabel()
                                            : null;
                            $detailUrl = is_object($project) && isset($project->id)
                                            ? route('site.community.projects.show', $project)
                                            : null;

                            $statusClass = match ($status) {
                                'active'    => 'bg-ecosa-green text-white',
                                'completed' => 'bg-ecosa-blue text-white',
                                default     => 'bg-ecosa-gold text-ecosa-ink',
                            };
                        @endphp

                        <article class="group flex flex-col overflow-hidden rounded-[20px] border border-zinc-100 bg-white shadow-sm">
                            {{-- Image --}}
                            <div class="relative h-52 overflow-hidden">
                                <img
                                    src="{{ $image }}"
                                    alt="{{ $title }}"
                                    class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                <span class="absolute left-4 top-4 rounded px-3 py-1 text-[0.7rem] font-bold uppercase tracking-[0.18em] {{ $statusClass }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </div>

                            {{-- Content --}}
                            <div class="flex flex-1 flex-col p-6">
                                {{-- Meta row --}}
                                <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-xs text-zinc-400">
                                    <span class="flex items-center gap-1.5">
                                        <i class="fas fa-user-circle"></i>
                                        ECOSA Team
                                    </span>
                                    @if ($schedule)
                                        <span class="flex items-center gap-1.5">
                                            <i class="fas fa-calendar-alt"></i>
                                            {{ $schedule }}
                                        </span>
                                    @endif
                                    @if (filled($loc))
                                        <span class="flex items-center gap-1.5">
                                            <i class="fas fa-location-dot"></i>
                                            {{ $loc }}
                                        </span>
                                    @endif
                                </div>

                                {{-- Title --}}
                                <h3 class="mt-3 font-display text-xl font-bold leading-snug text-zinc-900">
                                    @if ($detailUrl)
                                        <a href="{{ $detailUrl }}" class="transition hover:text-ecosa-green-deep">{{ $title }}</a>
                                    @else
                                        {{ $title }}
                                    @endif
                                </h3>

                                {{-- Excerpt --}}
                                <p class="mt-2 flex-grow text-sm leading-7 text-zinc-600">
                                    {{ str($summary)->limit(130) }}
                                </p>

                                {{-- Read More link --}}
                                @if ($detailUrl)
                                    <a
                                        href="{{ $detailUrl }}"
                                        class="mt-4 inline-flex items-center gap-1.5 text-sm font-bold text-ecosa-green transition hover:text-ecosa-green-deep"
                                    >
                                        Read More
                                        <i class="fas fa-arrow-right text-xs"></i>
                                    </a>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="py-20 text-center">
                    <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-ecosa-blue/8">
                        <i class="fas fa-briefcase text-3xl text-ecosa-blue/40"></i>
                    </div>
                    <h3 class="mt-6 font-display text-3xl font-semibold text-ecosa-blue-deep">Projects Coming Soon</h3>
                    <p class="mx-auto mt-4 max-w-md text-sm leading-7 text-zinc-500">
                        ECOSA community projects are being prepared. Check back soon or contact the team for details.
                    </p>
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
                <a href="{{ route('site.community') }}" class="site-btn-ghost border-white/20 bg-transparent text-white hover:bg-white/10">
                    View Community
                </a>
            </div>
        </div>
    </div>
</main>
