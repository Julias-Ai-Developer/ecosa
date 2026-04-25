<main>
    <section
        class="relative overflow-hidden bg-[#081b2c]"
        x-data="{
            current: 0,
            total: {{ count($heroSlides) }},
            timer: null,
            start() {
                this.stop();
                this.timer = setInterval(() => this.next(), 6500);
            },
            stop() {
                if (this.timer) {
                    clearInterval(this.timer);
                }
            },
            next() {
                this.current = (this.current + 1) % this.total;
            },
            prev() {
                this.current = (this.current - 1 + this.total) % this.total;
            }
        }"
        x-init="start()"
        @mouseenter="stop()"
        @mouseleave="start()"
    >
        <div class="relative min-h-[420px] sm:min-h-[520px] lg:min-h-[560px]">
            @foreach ($heroSlides as $slide)
                <div
                    x-show="current === {{ $loop->index }}"
                    x-transition.opacity.duration.700ms
                    class="absolute inset-0"
                    @if (! $loop->first)
                        x-cloak
                    @endif
                >
                    <img src="{{ $slide['image'] }}" alt="{{ $slide['title'] }}" class="h-full w-full object-cover">
                    <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(8,27,44,0.16),rgba(8,27,44,0.84))]"></div>
                </div>
            @endforeach

            <button
                type="button"
                class="absolute left-4 top-1/2 z-20 flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full border border-white/15 bg-black/20 text-white backdrop-blur transition hover:bg-black/35 sm:left-6"
                @click="prev()"
                aria-label="Previous slide"
            >
                <i class="fas fa-chevron-left"></i>
            </button>

            <button
                type="button"
                class="absolute right-4 top-1/2 z-20 flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full border border-white/15 bg-black/20 text-white backdrop-blur transition hover:bg-black/35 sm:right-6"
                @click="next()"
                aria-label="Next slide"
            >
                <i class="fas fa-chevron-right"></i>
            </button>

            <div class="absolute inset-0 z-10">
                <div class="mx-auto flex h-full max-w-7xl items-end px-5 pb-12 pt-20 lg:px-8 lg:pb-20">
                    <div class="max-w-4xl text-white">
                        @foreach ($heroSlides as $slide)
                            <div
                                x-show="current === {{ $loop->index }}"
                                x-transition.opacity.duration.500ms
                                @if (! $loop->first)
                                    x-cloak
                                @endif
                            >
                                <span class="inline-flex items-center gap-2 rounded-full border border-white/12 bg-white/10 px-4 py-2 text-[0.72rem] font-bold uppercase tracking-[0.24em] text-white/82">
                                    {{ $slide['eyebrow'] }}
                                </span>
                                <h1 class="mt-5 max-w-4xl font-display text-4xl font-semibold leading-[0.95] text-white sm:text-5xl lg:text-6xl">
                                    {{ $slide['title'] }}
                                </h1>
                                <p class="mt-4 max-w-3xl text-base leading-8 text-white/82 sm:text-lg">
                                    {{ $slide['text'] }}
                                </p>

                                <div class="mt-8 flex flex-wrap gap-4">
                                    <a
                                        href="{{ route($slide['primary_cta_route']) }}"
                                        class="site-btn-primary min-w-[10rem]"
                                    >
                                        <span>{{ $slide['primary_cta_label'] }}</span>
                                        <i class="fas fa-arrow-right text-xs"></i>
                                    </a>
                                    <a
                                        href="{{ route($slide['secondary_cta_route']) }}"
                                        class="inline-flex min-w-[10rem] items-center justify-center rounded-[10px] border border-white/30 bg-transparent px-6 py-3 text-sm font-bold text-white transition hover:border-white hover:bg-white hover:text-ecosa-blue-deep"
                                    >
                                        {{ $slide['secondary_cta_label'] }}
                                    </a>
                                </div>
                            </div>
                        @endforeach

                        <div class="mt-8 flex items-center gap-3">
                            @foreach ($heroSlides as $slide)
                                <button
                                    type="button"
                                    class="h-3 rounded-full transition"
                                    :class="current === {{ $loop->index }} ? 'w-12 bg-white' : 'w-3 bg-white/35'"
                                    @click="current = {{ $loop->index }}; start()"
                                    aria-label="Go to slide {{ $loop->iteration }}"
                                ></button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="site-torn-edge"></div>
        </div>
    </section>

    <section class="site-section pt-14 sm:pt-16">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            @php
                $homeHighlights = [
                    'A route-based website structure now gives each ECOSA area a proper public page instead of one mixed landing section.',
                    'Registration, payment selection, member login, and membership ID generation now read as one clear process.',
                    'Leadership, updates, projects, and welfare communication are now easier for alumni, parents, and partners to trust.',
                ];
            @endphp

            <div class="grid gap-10 xl:grid-cols-[0.84fr_1.16fr] xl:items-center">
                <div class="animate-fade-up">
                    <p class="font-accent text-sm font-bold uppercase tracking-[0.24em] text-zinc-500">Association Overview</p>
                    <h2 class="mt-4 max-w-xl font-sans text-4xl font-[800] leading-[0.95] text-balance text-ecosa-blue-deep sm:text-5xl lg:text-6xl">
                        <span class="text-ecosa-blue-deep">About </span>
                        <span class="text-ecosa-green">ECOSA</span>
                    </h2>
                    <p class="mt-5 max-w-xl text-lg leading-8 text-zinc-600">
                        ECOSA is the organized alumni association of Equatorial College School. The platform now presents the association with clearer structure, stronger public trust, and a more disciplined path for registration, leadership visibility, updates, and community engagement.
                    </p>

                    <div class="mt-8 flex flex-wrap gap-4">
                        <a href="{{ route('site.about') }}" class="site-btn-primary">
                            <span>Discover More</span>
                            <i class="fas fa-angle-right text-xs"></i>
                        </a>
                        <a href="{{ route('site.membership.register') }}" class="site-btn-secondary">Register Now</a>
                    </div>

                    <div class="mt-8 grid gap-3">
                        @foreach ($homeHighlights as $highlight)
                            <div class="border-l-4 border-ecosa-green bg-ecosa-green/[0.06] px-4 py-4">
                                <div class="flex gap-3">
                                    <div class="mt-1 flex h-9 w-9 shrink-0 items-center justify-center rounded-[10px] bg-ecosa-green text-white">
                                        <i class="fas fa-check text-xs"></i>
                                    </div>
                                    <p class="text-sm leading-7 text-zinc-600">{{ $highlight }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

               <div class="relative h-full w-full overflow-hidden rounded-[24px] shadow-lg">
    <img
        src="{{ !empty($aboutImage)
            ? asset('storage/' . $aboutImage)
            : 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=900&q=80'
        }}"
        alt="ECOSA Alumni"
        class="h-full w-full object-cover transition duration-500 hover:scale-105"
    >

    <!-- Overlay -->
    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/10 to-transparent"></div>

    <!-- Caption -->
    <div class="absolute bottom-4 left-4 right-4 text-white">
        <p class="text-sm font-semibold tracking-wide">ECOSA Community</p>
        <p class="text-xs opacity-80">Building strong alumni connections</p>
    </div>
</div>
            </div>
        </div>
    </section>

    {{-- ===== WHY CHOOSE ECOSA ===== --}}
    <section class="site-section relative overflow-hidden bg-ecosa-blue-deep">
        <img src="{{ asset('assets/images/school/aerialview.jpeg') }}" alt="Equatorial College School" class="absolute inset-0 h-full w-full object-cover opacity-20">
        <div class="relative mx-auto max-w-7xl px-5 lg:px-8">
            <div class="mb-12 text-center">
                <span class="inline-flex items-center gap-2 rounded-full border border-white/12 bg-white/8 px-4 py-2 text-[0.72rem] font-bold uppercase tracking-[0.28em] text-ecosa-gold">Why Choose ECOSA</span>
                <h2 class="mt-5 font-display text-4xl font-semibold leading-tight text-white sm:text-5xl lg:text-6xl">
                    Why Choose <span class="text-ecosa-gold">ECOSA?</span>
                </h2>
                <p class="mx-auto mt-5 max-w-2xl text-base leading-8 text-white/72">
                    Join a structured alumni association built on transparency, community impact, and real benefits for every member.
                </p>
            </div>

            <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
                @foreach ([
                    ['icon' => 'fa-users', 'title' => 'Verified Alumni Network', 'text' => 'Connect with 500+ verified alumni across Uganda and the global diaspora — professionals, business owners, and class leaders all in one place.'],
                    ['icon' => 'fa-id-card', 'title' => 'Membership ID & Portal', 'text' => 'Get a unique ECOSA membership number with secure access to your member portal — track payment status and profile details anytime.'],
                    ['icon' => 'fa-handshake', 'title' => 'Professional Networking', 'text' => 'Access a curated network of seasoned professionals, entrepreneurs, and class coordinators ready to support your career and business growth.'],
                    ['icon' => 'fa-calendar-check', 'title' => 'Community Programs', 'text' => 'Participate in alumni events, school-support projects, and community engagements designed to create real impact and lasting connection.'],
                    ['icon' => 'fa-shield-heart', 'title' => 'Welfare & Insurance', 'text' => 'Benefit from the ECOSA insurance group — a member-led welfare structure providing solidarity support when you need it most.'],
                    ['icon' => 'fa-school', 'title' => 'School Impact Programs', 'text' => 'Contribute to campus improvements, student mentorship, and strategic giving programs that directly support Equatorial College School.'],
                ] as $feature)
                    <article class="rounded-[28px] border border-white/10 bg-white/8 p-7 backdrop-blur transition hover:bg-white/14">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-ecosa-green text-white shadow-[0_8px_24px_rgba(23,146,75,0.4)]">
                            <i class="fas {{ $feature['icon'] }} text-xl"></i>
                        </div>
                        <h3 class="mt-5 font-display text-2xl font-semibold text-white">{{ $feature['title'] }}</h3>
                        <p class="mt-3 text-sm leading-7 text-white/72">{{ $feature['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="site-section bg-white/75">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <x-site.section-heading
                eyebrow="Programs & Member Services"
                title="Every visible ECOSA service is easier to discover and understand."
                text="A polished institutional website with focused destinations for the areas that matter most — membership, leadership, community, and updates."
                align="center"
            />

            <div class="mt-10 grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
                @foreach ($showcaseCards as $card)
                    <a href="{{ route($card['route']) }}" class="group relative min-h-[240px] overflow-hidden rounded-[28px] shadow-[var(--shadow-card)]">
                        <img src="{{ $card['image'] }}" alt="{{ $card['title'] }}" class="absolute inset-0 h-full w-full object-cover transition duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(8,27,44,0.08),rgba(8,27,44,0.88))]"></div>
                        <div class="absolute inset-x-0 bottom-0 p-6 text-white">
                            <p class="font-accent text-[0.7rem] font-bold uppercase tracking-[0.24em] text-white/72">Program {{ $loop->iteration }}</p>
                            <h3 class="mt-3 font-display text-2xl font-bold text-white">{{ $card['title'] }}</h3>
                            <p class="mt-3 text-sm leading-7 text-white/82">{{ $card['summary'] }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <div class="overflow-hidden bg-ecosa-green px-6 py-7 text-white shadow-[0_26px_50px_rgba(23,146,75,0.24)] sm:px-8 sm:py-9">
                    <div class="grid gap-8 lg:grid-cols-[0.94fr_1.06fr] lg:items-start">
                        <div>
                            <p class="font-accent text-sm font-bold uppercase tracking-[0.22em] text-white/74">Programs in Focus</p>
                            <h3 class="mt-4 font-sans text-4xl font-[800] leading-[0.94] text-white sm:text-5xl">
                                Alumni & Student Empowerment Programs
                            </h3>

                            <div class="mt-8 space-y-7">
                                <article>
                                    <p class="font-accent text-2xl font-bold uppercase text-ecosa-gold">Mentorship Network</p>
                                    <p class="mt-2 text-base leading-8 text-white/88">
                                        Senior alumni can guide current learners and recent graduates through practical advice, exposure sessions, and disciplined peer support.
                                    </p>
                                </article>

                                <article>
                                    <p class="font-accent text-2xl font-bold uppercase text-ecosa-gold">Community Action</p>
                                    <p class="mt-2 text-base leading-8 text-white/88">
                                        ECOSA programs now have clearer pages for events, projects, and the insurance group so members can follow real activity with confidence.
                                    </p>
                                </article>
                            </div>
                        </div>

                        <div>
                            <div class="overflow-hidden rounded-[30px] border-[4px] border-white/85 bg-white/10">
                                <img src="{{ asset('assets/images/school/Equatorial-College-School5.jpeg') }}" alt="Equatorial College School students gathered together" class="h-[20rem] w-full object-cover sm:h-[25rem]">
                            </div>
                            <p class="mt-4 text-sm font-semibold leading-7 text-ecosa-gold">
                                Equatorial College School gatherings continue to anchor ECOSA participation, mentorship, and alumni-led coordination.
                            </p>
                        </div>
                    </div>
                </div>

    <section class="site-section">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
                <x-site.section-heading
                    eyebrow="Membership Pathways"
                    title="Membership now feels guided, structured, and ready for public-facing use."
                    text="The registration experience has been cleaned up for individual members, diaspora alumni, and class leaders who need a clear place to start."
                />
                <a href="{{ route('site.membership.register') }}" class="site-btn-secondary">Open Registration</a>
            </div>

          <div class="mt-10 grid gap-6 lg:grid-cols-[1.05fr_0.95fr] lg:items-stretch">

    <!-- LEFT SIDE: 3 cards stacked vertically, each filling equal share -->
    <div class="flex flex-col gap-4">
        @foreach ($membershipTracks as $track)
            <article class="site-card flex flex-1 items-start gap-5 p-6">
                <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-ecosa-blue text-white">
                    <i class="fas {{ $track['icon'] }} text-xl"></i>
                </div>

                <div class="flex flex-1 flex-col">
                    <h3 class="font-display text-2xl font-bold text-ecosa-blue-deep">
                        {{ $track['title'] }}
                    </h3>

                    <p class="mt-2 flex-grow text-sm leading-7 text-zinc-600">
                        {{ $track['summary'] }}
                    </p>

                    <a href="{{ route($track['route']) }}"
                       class="mt-4 inline-flex items-center gap-2 text-sm font-bold uppercase tracking-[0.12em] text-ecosa-blue hover:text-ecosa-blue-deep">
                        <span>Open Page</span>
                        <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </article>
        @endforeach
    </div>

    <!-- RIGHT SIDE -->
    <div class="site-card flex h-full flex-col overflow-hidden rounded-[32px] p-3">
        
        <img src="{{ asset('assets/images/school/Equatorial-College-School5.jpeg') }}"
             alt="Equatorial College School students"
             class="h-72 w-full rounded-[26px] object-cover sm:h-80">

        <!-- INFO BOXES -->
        <div class="grid gap-4 p-5 sm:grid-cols-2">
            <div class="h-full rounded-[24px] bg-ecosa-blue/[0.04] p-5">
                <p class="font-accent text-xs font-bold uppercase tracking-[0.24em] text-zinc-500">
                    Payment options
                </p>
                <p class="mt-3 font-display text-3xl font-bold text-ecosa-blue-deep">
                    MTN Mobile Money &amp; Airtel Money
                </p>
            </div>

            <div class="h-full rounded-[24px] bg-ecosa-green/[0.08] p-5">
                <p class="font-accent text-xs font-bold uppercase tracking-[0.24em] text-zinc-500">
                    Portal benefit
                </p>
                <p class="mt-3 font-display text-3xl font-bold text-ecosa-blue-deep">
                    View payment and profile details
                </p>
            </div>
        </div>

        <!-- BENEFITS -->
        <div class="grid gap-4 px-5 pb-5 flex-grow">
            @foreach ($benefits as $benefit)
                <div class="flex items-start gap-4 rounded-[24px] border border-ecosa-blue/8 bg-ecosa-blue/[0.03] p-4">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-ecosa-green text-white">
                        <i class="fas fa-check text-xs"></i>
                    </div>
                    <p class="text-sm leading-7 text-zinc-600">
                        {{ $benefit }}
                    </p>
                </div>
            @endforeach

            <!-- PRICE -->
            <div class="rounded-[24px] bg-ecosa-gold/16 p-5">
                <p class="font-accent text-xs font-bold uppercase tracking-[0.24em] text-zinc-600">
                    Registration Fee
                </p>
                <p class="mt-3 font-display text-4xl font-bold text-ecosa-blue-deep">
                    UGX 20,000
                </p>
                <p class="mt-3 text-sm leading-7 text-zinc-600">
                    After registration, the system emails the membership ID and links the record to the member portal account that uses the submitted email address.
                </p>
            </div>

            <!-- BUTTON ALWAYS AT BOTTOM -->
            <a href="{{ route('site.membership.register') }}"
               class="site-btn-primary w-full mt-auto">
                Go to Registration Page
            </a>
        </div>
    </div>
</div>
        </div>
    </section>

    <section class="site-section">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <x-site.section-heading
                eyebrow="Community Structure"
                title="Events, projects, and the insurance group each have their own page."
                text="The community area is no longer a single mixed section. Each major program category now has its own destination and can be managed as a clear public-facing page."
                align="center"
            />

            <div class="mt-10 grid gap-6 lg:grid-cols-3">
                <article class="site-card flex h-full flex-col overflow-hidden">
                    <div class="border-b border-ecosa-blue/8 bg-ecosa-blue/[0.04] p-7">
                        <div class="flex items-center justify-between gap-4">
                            <span class="site-chip">Events</span>
                            <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-ecosa-blue shadow-sm">
                                <i class="fas fa-calendar-days"></i>
                            </span>
                        </div>
                        <h3 class="mt-5 font-display text-4xl font-semibold leading-tight text-ecosa-blue-deep">Community events</h3>
                    </div>

                    <div class="grid flex-1 gap-4 p-7">
                        @foreach ($events as $event)
                            @php
                                $title = data_get($event, 'title');
                                $summary = data_get($event, 'summary') ?: data_get($event, 'text');
                                $location = data_get($event, 'location') ?: data_get($event, 'meta');
                                $schedule = is_object($event) && method_exists($event, 'scheduleLabel') ? $event->scheduleLabel() : null;
                            @endphp
                            <div class="rounded-[22px] border border-ecosa-blue/8 bg-white p-5 shadow-sm">
                                <p class="text-xs font-bold uppercase tracking-[0.22em] text-zinc-500">{{ $schedule ?: 'Community Event' }}</p>
                                <h4 class="mt-3 font-display text-3xl font-semibold leading-tight text-ecosa-blue-deep">{{ $title }}</h4>
                                <p class="mt-3 text-sm leading-7 text-zinc-600">{{ $summary }}</p>
                                @if (filled($location))
                                    <p class="mt-3 text-sm font-semibold text-ecosa-green-deep">{{ $location }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="px-7 pb-7">
                        <a href="{{ route('site.community.events') }}" class="site-btn-ghost w-full">Open Events Page</a>
                    </div>
                </article>

                <article class="site-card flex h-full flex-col overflow-hidden">
                    <div class="border-b border-ecosa-blue/8 bg-ecosa-green/[0.06] p-7">
                        <div class="flex items-center justify-between gap-4">
                            <span class="site-chip">Projects</span>
                            <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-ecosa-green-deep shadow-sm">
                                <i class="fas fa-briefcase"></i>
                            </span>
                        </div>
                        <h3 class="mt-5 font-display text-4xl font-semibold leading-tight text-ecosa-blue-deep">Community projects</h3>
                    </div>

                    <div class="grid flex-1 gap-4 p-7">
                        @foreach ($projects as $project)
                            @php
                                $title = data_get($project, 'title');
                                $summary = data_get($project, 'summary') ?: data_get($project, 'text');
                                $location = data_get($project, 'location') ?: data_get($project, 'meta');
                            @endphp
                            <div class="rounded-[22px] border border-ecosa-blue/8 bg-white p-5 shadow-sm">
                                <p class="text-xs font-bold uppercase tracking-[0.22em] text-zinc-500">Community Project</p>
                                <h4 class="mt-3 font-display text-3xl font-semibold leading-tight text-ecosa-blue-deep">{{ $title }}</h4>
                                <p class="mt-3 text-sm leading-7 text-zinc-600">{{ $summary }}</p>
                                @if (filled($location))
                                    <p class="mt-3 text-sm font-semibold text-ecosa-green-deep">{{ $location }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="px-7 pb-7">
                        <a href="{{ route('site.community.projects') }}" class="site-btn-ghost w-full">Open Projects Page</a>
                    </div>
                </article>

                <article class="site-card flex h-full flex-col overflow-hidden">
                    <div class="border-b border-ecosa-blue/8 bg-ecosa-gold/16 p-7">
                        <div class="flex items-center justify-between gap-4">
                            <span class="site-chip">Insurance Group</span>
                            <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-ecosa-blue shadow-sm">
                                <i class="fas fa-shield-heart"></i>
                            </span>
                        </div>
                        <h3 class="mt-5 font-display text-4xl font-semibold leading-tight text-ecosa-blue-deep">Welfare support</h3>
                    </div>

                    <div class="grid flex-1 gap-4 p-7">
                        <div class="rounded-[22px] border border-ecosa-blue/8 bg-white p-5 shadow-sm">
                            <p class="text-xs font-bold uppercase tracking-[0.22em] text-zinc-500">Member Welfare</p>
                            <h4 class="mt-3 font-display text-3xl font-semibold leading-tight text-ecosa-blue-deep">Welfare support with better visibility</h4>
                            <p class="mt-3 text-sm leading-7 text-zinc-600">
                                The insurance group now has a dedicated page that explains how welfare coordination fits into the wider ECOSA community structure.
                            </p>
                            <p class="mt-3 text-sm font-semibold text-ecosa-green-deep">Designed for member reassurance and practical information.</p>
                        </div>
                    </div>

                    <div class="px-7 pb-7">
                        <a href="{{ route('site.community.insurance') }}" class="site-btn-ghost w-full">Open Insurance Page</a>
                    </div>
                </article>
            </div>
        </div>
    </section>



    <section class="site-section">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
                <x-site.section-heading
                    eyebrow="Latest Updates"
                    title="Fresh public content remains easy to publish and easy to read."
                    text="News and updates are now presented in a more editorial, more polished format while still remaining admin-manageable."
                />
                <a href="{{ route('site.updates') }}" class="site-btn-ghost">View All Updates</a>
            </div>

            <div class="mt-10 grid gap-6 lg:grid-cols-3">
                @forelse ($updates as $update)
                    <article class="site-card overflow-hidden">
                        <img src="{{ $update->imageUrl() }}" alt="{{ $update->title }}" class="h-56 w-full object-cover">
                        <div class="p-6">
                            <span class="site-chip">{{ $update->category }}</span>
                            <h3 class="mt-5 font-display text-3xl font-semibold text-ecosa-blue-deep">{{ $update->title }}</h3>
                            <p class="mt-4 text-sm leading-7 text-zinc-600">{{ $update->summary }}</p>
                        </div>
                    </article>
                @empty
                    @foreach ($fallbackUpdates as $update)
                        <article class="site-card overflow-hidden">
                            <img src="{{ $update['image'] }}" alt="{{ $update['title'] }}" class="h-56 w-full object-cover">
                            <div class="p-6">
                                <span class="site-chip">{{ $update['category'] }}</span>
                                <h3 class="mt-5 font-display text-3xl font-semibold text-ecosa-blue-deep">{{ $update['title'] }}</h3>
                                <p class="mt-4 text-sm leading-7 text-zinc-600">{{ $update['summary'] }}</p>
                            </div>
                        </article>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>


</main>
