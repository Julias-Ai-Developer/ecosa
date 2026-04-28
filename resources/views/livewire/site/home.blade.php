<main>
    {{-- ===== HERO SLIDER ===== --}}
    <section class="relative overflow-hidden bg-[#081b2c]" x-data="{ current: 0, total: {{ count($heroSlides) }}, timer: null, start() { this.stop(); this.timer = setInterval(() => this.next(), 6500); }, stop() { if (this.timer) clearInterval(this.timer); }, next() { this.current = (this.current + 1) % this.total; }, prev() { this.current = (this.current - 1 + this.total) % this.total; } }" x-init="start()" @mouseenter="stop()" @mouseleave="start()">
        <div class="relative min-h-[420px] sm:min-h-[520px] lg:min-h-[560px]">
            @foreach ($heroSlides as $slide)
                <div x-show="current === {{ $loop->index }}" x-transition.opacity.duration.700ms class="absolute inset-0" @if(!$loop->first) x-cloak @endif>
                    <img src="{{ $slide['image'] }}" alt="{{ $slide['title'] }}" class="h-full w-full object-cover">
                    <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(8,27,44,0.16),rgba(8,27,44,0.84))]"></div>
                </div>
            @endforeach
            <button type="button" class="absolute left-4 top-1/2 z-20 flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full border border-white/15 bg-black/20 text-white backdrop-blur transition hover:bg-black/35 sm:left-6" @click="prev()" aria-label="Previous slide"><i class="fas fa-chevron-left"></i></button>
            <button type="button" class="absolute right-4 top-1/2 z-20 flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full border border-white/15 bg-black/20 text-white backdrop-blur transition hover:bg-black/35 sm:right-6" @click="next()" aria-label="Next slide"><i class="fas fa-chevron-right"></i></button>
            <div class="absolute inset-0 z-10">
                <div class="mx-auto flex h-full max-w-7xl items-end px-5 pb-12 pt-20 lg:px-8 lg:pb-20">
                    <div class="max-w-4xl text-white">
                        @foreach ($heroSlides as $slide)
                            <div x-show="current === {{ $loop->index }}" x-transition.opacity.duration.500ms @if(!$loop->first) x-cloak @endif>
                                <span class="inline-flex items-center gap-2 rounded-full border border-white/12 bg-white/10 px-4 py-2 text-[0.72rem] font-bold uppercase tracking-[0.24em] text-white/82">{{ $slide['eyebrow'] }}</span>
                                <h1 class="mt-5 max-w-4xl font-display text-4xl font-semibold leading-[0.95] text-white sm:text-5xl lg:text-6xl">{{ $slide['title'] }}</h1>
                                <p class="mt-4 max-w-3xl text-base leading-8 text-white/82 sm:text-lg">{{ $slide['text'] }}</p>
                                <div class="mt-8 flex flex-wrap gap-4">
                                    <a href="{{ route($slide['primary_cta_route']) }}" class="site-btn-primary min-w-[10rem]"><span>{{ $slide['primary_cta_label'] }}</span><i class="fas fa-arrow-right text-xs"></i></a>
                                    <a href="{{ route($slide['secondary_cta_route']) }}" class="inline-flex min-w-[10rem] items-center justify-center rounded-[10px] border border-white/30 bg-transparent px-6 py-3 text-sm font-bold text-white transition hover:bg-white hover:text-ecosa-blue-deep">{{ $slide['secondary_cta_label'] }}</a>
                                </div>
                            </div>
                        @endforeach
                        <div class="mt-8 flex items-center gap-3">
                            @foreach ($heroSlides as $slide)
                                <button type="button" class="h-3 rounded-full transition" :class="current === {{ $loop->index }} ? 'w-12 bg-white' : 'w-3 bg-white/35'" @click="current = {{ $loop->index }}; start()" aria-label="Slide {{ $loop->iteration }}"></button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="site-torn-edge"></div>
        </div>
    </section>

    {{-- ===== ABOUT ECOSA ===== --}}
    <section class="site-section pt-14 sm:pt-16">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            @php $homeHighlights = ['Structured alumni registration with a verified ECOSA membership ID and digital member portal.', 'Organized leadership, updates, events, projects, and welfare programs — each with a clear public page.', 'A growing alumni network built on transparency, community service, and school-impact programs.']; @endphp
            <div class="grid gap-10 xl:grid-cols-[0.84fr_1.16fr] xl:items-center">
                <div class="animate-fade-up">
                    <p class="font-accent text-sm font-bold uppercase tracking-[0.24em] text-zinc-500">Association Overview</p>
                    <h2 class="mt-4 max-w-xl font-sans text-4xl font-[800] leading-[0.95] text-balance text-ecosa-blue-deep sm:text-5xl lg:text-6xl"><span class="text-ecosa-blue-deep">About </span><span class="text-ecosa-green">ECOSA</span></h2>
                    <p class="mt-5 max-w-xl text-lg leading-8 text-zinc-600">ECOSA is the organized alumni association of Equatorial College School. We bring together alumni through structured registration, community programs, welfare support, and school-impact initiatives.</p>
                    <div class="mt-8 flex flex-wrap gap-4">
                        <a href="{{ route('site.about') }}" class="site-btn-primary"><span>Discover More</span><i class="fas fa-angle-right text-xs"></i></a>
                        <a href="{{ route('site.membership.register') }}" class="site-btn-secondary">Register Now</a>
                    </div>
                    <div class="mt-8 grid gap-3">
                        @foreach ($homeHighlights as $highlight)
                            <div class="flex gap-3 border-l-4 border-ecosa-green bg-ecosa-green/[0.06] px-4 py-3">
                                <div class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-ecosa-green text-white"><i class="fas fa-check text-xs"></i></div>
                                <p class="text-sm leading-7 text-zinc-600">{{ $highlight }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="relative min-h-[400px] w-full overflow-hidden rounded-[24px] shadow-lg">
                    <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=900&q=80" alt="ECOSA Alumni" class="absolute inset-0 h-full w-full object-cover transition duration-500 hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/10 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6 text-white">
                        <p class="text-base font-bold tracking-wide">ECOSA Community</p>
                        <p class="mt-1 text-sm opacity-80">Building strong alumni connections across Uganda and the diaspora</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== WHY CHOOSE ECOSA ===== --}}
    <section class="site-section relative overflow-hidden bg-ecosa-blue-deep">
        <img src="{{ asset('assets/images/school/aerialview.jpeg') }}" alt="" class="absolute inset-0 h-full w-full object-cover opacity-20" aria-hidden="true">
        <div class="relative mx-auto max-w-7xl px-5 lg:px-8">
            <div class="mb-12 text-center">
                <span class="inline-flex items-center gap-2 rounded-full border border-white/12 bg-white/8 px-4 py-2 text-[0.72rem] font-bold uppercase tracking-[0.28em] text-ecosa-gold">Why Choose ECOSA</span>
                <h2 class="mt-5 font-display text-4xl font-semibold leading-tight text-white sm:text-5xl lg:text-6xl">Why Choose <span class="text-ecosa-gold">ECOSA?</span></h2>
                <p class="mx-auto mt-5 max-w-2xl text-base leading-8 text-white/72">Join a structured alumni association built on transparency, community impact, and real benefits for every member.</p>
            </div>
            <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
                @foreach ([['icon'=>'fa-users','title'=>'Verified Alumni Network','text'=>'Connect with 500+ verified alumni across Uganda and the global diaspora — professionals, business owners, and class leaders.'],['icon'=>'fa-id-card','title'=>'Membership ID & Portal','text'=>'Get a unique ECOSA membership number with secure access to your member portal — track payment status and profile details.'],['icon'=>'fa-handshake','title'=>'Professional Networking','text'=>'Access a curated network of seasoned professionals, entrepreneurs, and class coordinators ready to support your career.'],['icon'=>'fa-calendar-check','title'=>'Community Programs','text'=>'Participate in alumni events, school-support projects, and community engagements designed to create real impact.'],['icon'=>'fa-shield-heart','title'=>'Welfare & Insurance','text'=>'Benefit from the ECOSA insurance group — a member-led welfare structure providing solidarity support when you need it.'],['icon'=>'fa-school','title'=>'School Impact Programs','text'=>'Contribute to campus improvements, student mentorship, and strategic giving programs that directly support Equatorial College School.']] as $feature)
                    <article class="rounded-[28px] border border-white/10 bg-white/8 p-7 backdrop-blur transition hover:bg-white/14">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-ecosa-green text-white shadow-[0_8px_24px_rgba(23,146,75,0.4)]"><i class="fas {{ $feature['icon'] }} text-xl"></i></div>
                        <h3 class="mt-5 font-display text-xl font-semibold text-white">{{ $feature['title'] }}</h3>
                        <p class="mt-3 text-sm leading-7 text-white/72">{{ $feature['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== WHY JOIN / GUIDING PRINCIPLES ===== --}}
    <section class="site-section">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="grid gap-10 lg:grid-cols-[0.9fr_1.1fr] lg:items-start">
                <div>
                    <x-site.section-heading
                        eyebrow="Why Join ECOSA"
                        title="Membership should connect people, guidance, business, and service."
                        text="ECOSA gives old students a structured way to know one another, support fellow alumni, find chapter contacts, advertise businesses, and contribute willingly to association work."
                    />
                    <div class="mt-8 grid gap-4">
                        @foreach ($benefits as $benefit)
                            <div class="flex gap-3 rounded-[18px] border border-ecosa-blue/8 bg-white p-4 shadow-sm">
                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-ecosa-green text-white">
                                    <i class="fas fa-check text-xs"></i>
                                </div>
                                <p class="text-sm leading-7 text-zinc-600">{{ $benefit }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div>
                    <span class="site-chip">Ground Rules</span>
                    <h3 class="mt-5 font-display text-4xl font-semibold text-ecosa-blue-deep">Guiding principles for a trusted alumni network.</h3>
                    <div class="mt-6 grid gap-4 sm:grid-cols-2">
                        @foreach ($guidingPrinciples as $principle)
                            <article class="site-card p-6">
                                <h4 class="font-display text-xl font-semibold text-ecosa-blue-deep">{{ $principle['title'] }}</h4>
                                <p class="mt-3 text-sm leading-7 text-zinc-600">{{ $principle['text'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== PROGRAMS SHOWCASE ===== --}}
    <section class="site-section bg-ecosa-mist">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <x-site.section-heading eyebrow="Programs & Member Services" title="Every ECOSA service is easier to discover." text="Focused destinations for the areas that matter most — membership, leadership, community, and updates." align="center"/>
            <div class="mt-10 grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
                @foreach ($showcaseCards as $card)
                    <a href="{{ route($card['route']) }}" class="group relative flex min-h-[240px] flex-col overflow-hidden rounded-[28px] shadow-[var(--shadow-card)]">
                        <img src="{{ $card['image'] }}" alt="{{ $card['title'] }}" class="absolute inset-0 h-full w-full object-cover transition duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(8,27,44,0.08),rgba(8,27,44,0.88))]"></div>
                        <div class="absolute inset-x-0 bottom-0 p-6 text-white">
                            <h3 class="font-display text-xl font-bold text-white">{{ $card['title'] }}</h3>
                            <p class="mt-2 text-sm leading-6 text-white/82">{{ $card['summary'] }}</p>
                            <span class="mt-3 inline-flex items-center gap-1.5 text-xs font-bold text-ecosa-gold">Explore <i class="fas fa-arrow-right text-[0.6rem]"></i></span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== PROGRAMS IN FOCUS (green band) ===== --}}
    <section class="site-section bg-ecosa-green">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="grid gap-10 lg:grid-cols-[0.94fr_1.06fr] lg:items-center">
                <div>
                    <p class="font-accent text-sm font-bold uppercase tracking-[0.22em] text-white/74">Programs in Focus</p>
                    <h2 class="mt-4 font-sans text-4xl font-[800] leading-[0.94] text-white sm:text-5xl">Alumni &amp; Student Empowerment Programs</h2>
                    <div class="mt-8 space-y-7">
                        <article>
                            <p class="font-accent text-xl font-bold uppercase text-ecosa-gold">Mentorship Network</p>
                            <p class="mt-2 text-base leading-8 text-white/88">Senior alumni guide current learners and recent graduates through practical advice, exposure sessions, and disciplined peer support.</p>
                        </article>
                        <article>
                            <p class="font-accent text-xl font-bold uppercase text-ecosa-gold">Community Action</p>
                            <p class="mt-2 text-base leading-8 text-white/88">ECOSA programs have clear pages for events, projects, and the insurance group so members can follow real activity with confidence.</p>
                        </article>
                    </div>
                    <div class="mt-8">
                        <a href="{{ route('site.community') }}" class="inline-flex items-center justify-center gap-2 rounded-[10px] border border-white/30 bg-white/10 px-6 py-3 text-sm font-bold text-white transition hover:bg-white hover:text-ecosa-green-deep"><span>Explore Programs</span><i class="fas fa-arrow-right text-xs"></i></a>
                    </div>
                </div>
                <div>
                    <div class="overflow-hidden rounded-[30px] border-[4px] border-white/30 shadow-[0_20px_60px_rgba(0,0,0,0.3)]">
                        <img src="{{ asset('assets/images/school/Equatorial-College-School5.jpeg') }}" alt="Equatorial College School" class="h-[22rem] w-full object-cover sm:h-[28rem]">
                    </div>
                    <p class="mt-4 text-sm font-semibold leading-7 text-ecosa-gold">Equatorial College School gatherings anchor ECOSA participation, mentorship, and alumni-led coordination.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== MEMBERSHIP PATHWAYS ===== --}}
    <section class="site-section">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
                <x-site.section-heading eyebrow="Membership Pathways" title="Membership — guided, structured, and clear." text="The registration experience is cleaned up for individual members, diaspora alumni, and class leaders."/>
                <a href="{{ route('site.membership.register') }}" class="site-btn-secondary shrink-0">Open Registration</a>
            </div>
            <div class="mt-10 grid gap-6 lg:grid-cols-[1fr_1fr] lg:items-start">
                {{-- Left: tracks --}}
                <div class="flex flex-col gap-4">
                    @foreach ($membershipTracks as $track)
                        <article class="site-card flex items-start gap-5 p-6">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-ecosa-blue text-white"><i class="fas {{ $track['icon'] }} text-lg"></i></div>
                            <div>
                                <h3 class="font-display text-xl font-bold text-ecosa-blue-deep">{{ $track['title'] }}</h3>
                                <p class="mt-2 text-sm leading-7 text-zinc-600">{{ $track['summary'] }}</p>
                                <a href="{{ route($track['route']) }}" class="mt-3 inline-flex items-center gap-2 text-sm font-bold text-ecosa-blue transition hover:text-ecosa-green-deep">Open Page <i class="fas fa-arrow-right text-xs"></i></a>
                            </div>
                        </article>
                    @endforeach
                </div>
                {{-- Right: info card --}}
                <div class="site-card overflow-hidden">
                    <img src="{{ asset('assets/images/school/Equatorial-College-School5.jpeg') }}" alt="ECOSA members" class="h-56 w-full object-cover">
                    <div class="grid gap-3 p-5 sm:grid-cols-2">
                        <div class="rounded-[16px] bg-ecosa-blue/[0.04] p-4">
                            <p class="font-accent text-xs font-bold uppercase tracking-[0.22em] text-zinc-500">Payment Options</p>
                            <p class="mt-2 text-sm font-bold text-ecosa-blue-deep">MTN MoMo &amp; Airtel Money</p>
                        </div>
                        <div class="rounded-[16px] bg-ecosa-green/[0.08] p-4">
                            <p class="font-accent text-xs font-bold uppercase tracking-[0.22em] text-zinc-500">Portal Benefit</p>
                            <p class="mt-2 text-sm font-bold text-ecosa-blue-deep">View payment &amp; profile details</p>
                        </div>
                    </div>
                    <div class="grid gap-3 px-5 pb-2">
                        @foreach ($benefits as $benefit)
                            <div class="flex items-start gap-3 rounded-[14px] border border-ecosa-blue/8 bg-ecosa-blue/[0.02] p-3">
                                <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-ecosa-green text-white"><i class="fas fa-check text-xs"></i></div>
                                <p class="text-sm leading-6 text-zinc-600">{{ $benefit }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="p-5">
                        <div class="rounded-[16px] bg-ecosa-gold/[0.14] p-4">
                            <p class="font-accent text-xs font-bold uppercase tracking-[0.22em] text-zinc-600">Payments & Contributions</p>
                            <p class="mt-2 font-display text-3xl font-bold text-ecosa-blue-deep">Choose your purpose</p>
                            <p class="mt-2 text-xs leading-6 text-zinc-600">Members can submit membership payments, donations, chapter support, project support, or welfare contributions for verification.</p>
                        </div>
                        <a href="{{ route('site.membership.register') }}" class="site-btn-primary mt-4 w-full">Go to Registration Page</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== COMMUNITY SECTION (image + description + link) ===== --}}
    <section class="site-section bg-ecosa-mist">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <x-site.section-heading eyebrow="Community Structure" title="Events, projects, and welfare — each with their own page." text="Every major community program now has a dedicated public destination." align="center"/>
            <div class="mt-10 grid gap-6 sm:grid-cols-3">
                @foreach ([['image'=>asset('assets/images/school/aerialview.jpeg'),'chip'=>'Events','icon'=>'fa-calendar-days','title'=>'Community Events','desc'=>'Flagship reunions, alumni forums, and networking gatherings designed to reconnect old students and celebrate shared heritage.','route'=>'site.community.events','color'=>'ecosa-blue'],['image'=>asset('assets/images/school/Equatorial-College-School5.jpeg'),'chip'=>'Projects','icon'=>'fa-briefcase','title'=>'Community Projects','desc'=>'School-support drives, campus improvement partnerships, and mentorship programs that create lasting community impact.','route'=>'site.community.projects','color'=>'ecosa-green'],['image'=>asset('assets/images/school/aerialview.jpeg'),'chip'=>'Insurance Group','icon'=>'fa-shield-heart','title'=>'Welfare & Insurance','desc'=>'A member-led welfare structure providing practical solidarity support, household protection, and group coordination.','route'=>'site.community.insurance','color'=>'ecosa-blue']] as $item)
                    <article class="group flex flex-col overflow-hidden rounded-[24px] border border-zinc-100 bg-white shadow-sm transition hover:shadow-md">
                        <div class="relative overflow-hidden">
                            <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="h-48 w-full object-cover transition duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                        </div>
                        <div class="flex flex-1 flex-col p-6">
                            <span class="site-chip self-start">{{ $item['chip'] }}</span>
                            <h3 class="mt-4 font-display text-xl font-bold text-ecosa-blue-deep">{{ $item['title'] }}</h3>
                            <p class="mt-3 flex-grow text-sm leading-7 text-zinc-600">{{ $item['desc'] }}</p>
                            <a href="{{ route($item['route']) }}" class="mt-5 inline-flex items-center gap-2 text-sm font-bold text-ecosa-green transition hover:text-ecosa-green-deep">Explore Page <i class="fas fa-arrow-right text-xs"></i></a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== LATEST UPDATES (blog card style) ===== --}}
    <section class="site-section">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
                <x-site.section-heading eyebrow="Latest Updates" title="Fresh news from ECOSA." text="Stay informed with the latest association updates, events, and announcements."/>
                <a href="{{ route('site.updates') }}" class="site-btn-ghost shrink-0">View All Updates</a>
            </div>
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($updates as $update)
                    <article class="group flex flex-col overflow-hidden rounded-[20px] border border-zinc-100 bg-white shadow-sm">
                        <a href="{{ route('site.updates.show', $update) }}" class="block overflow-hidden">
                            <img src="{{ $update->imageUrl() }}" alt="{{ $update->title }}" class="h-48 w-full object-cover transition duration-500 group-hover:scale-105">
                        </a>
                        <div class="flex flex-1 flex-col p-6">
                            <div class="flex flex-wrap items-center gap-2 text-xs text-zinc-400">
                                <span class="flex items-center gap-1"><i class="fas fa-user-circle text-ecosa-blue/50"></i> ECOSA Admin</span>
                                <span class="flex items-center gap-1"><i class="fas fa-calendar-alt text-ecosa-blue/50"></i> {{ optional($update->published_at)->format('M j, Y') }}</span>
                            </div>
                            <h3 class="mt-3 font-display text-lg font-bold leading-snug text-ecosa-blue-deep">
                                <a href="{{ route('site.updates.show', $update) }}" class="transition group-hover:text-ecosa-green">{{ $update->title }}</a>
                            </h3>
                            <p class="mt-2 flex-grow text-sm leading-7 text-zinc-600">{{ str($update->summary)->limit(110) }}</p>
                            <a href="{{ route('site.updates.show', $update) }}" class="mt-4 inline-flex items-center gap-2 text-sm font-bold text-ecosa-green transition hover:text-ecosa-green-deep">Continue Reading <i class="fas fa-arrow-right text-xs"></i></a>
                        </div>
                    </article>
                @empty
                    @foreach ($fallbackUpdates as $update)
                        <article class="group flex flex-col overflow-hidden rounded-[20px] border border-zinc-100 bg-white shadow-sm">
                            <img src="{{ $update['image'] }}" alt="{{ $update['title'] }}" class="h-48 w-full object-cover">
                            <div class="flex flex-1 flex-col p-6">
                                <span class="site-chip self-start">{{ $update['category'] }}</span>
                                <h3 class="mt-3 font-display text-lg font-bold text-ecosa-blue-deep">{{ $update['title'] }}</h3>
                                <p class="mt-2 flex-grow text-sm leading-7 text-zinc-600">{{ $update['summary'] }}</p>
                                <a href="{{ route('site.updates') }}" class="mt-4 inline-flex items-center gap-2 text-sm font-bold text-ecosa-green">Continue Reading <i class="fas fa-arrow-right text-xs"></i></a>
                            </div>
                        </article>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    {{-- ===== SPONSORS ===== --}}
    @if(!empty($sponsors))
    <section class="border-t border-zinc-100 bg-white py-16">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <p class="mb-10 text-center font-accent text-xs font-bold uppercase tracking-[0.28em] text-zinc-400">Our Partners &amp; Supporters</p>
            <div class="flex flex-wrap items-center justify-center gap-x-16 gap-y-10">
                @foreach ($sponsors as $sponsor)
                    @if(!empty($sponsor['url']))
                        <a href="{{ $sponsor['url'] }}" target="_blank" rel="noopener noreferrer"
                           class="group flex flex-col items-center gap-3 shrink-0 px-6 py-4 rounded-xl transition duration-300 hover:bg-zinc-50">
                            <img src="{{ $sponsor['logo'] }}" alt="{{ $sponsor['name'] }}"
                                 class="h-20 w-auto max-w-[180px] object-contain opacity-40 grayscale transition duration-300 group-hover:opacity-100 group-hover:grayscale-0 group-hover:scale-105">
                            <span class="text-[11px] font-semibold tracking-wide text-zinc-400 opacity-0 transition duration-300 group-hover:opacity-100 group-hover:text-zinc-500 whitespace-nowrap">
                                {{ parse_url($sponsor['url'], PHP_URL_HOST) ?: $sponsor['url'] }}
                            </span>
                        </a>
                    @else
                        <div class="flex flex-col items-center gap-3 shrink-0 px-6 py-4">
                            <img src="{{ $sponsor['logo'] }}" alt="{{ $sponsor['name'] }}"
                                 class="h-20 w-auto max-w-[180px] object-contain opacity-40 grayscale">
                            <span class="text-[11px] font-semibold text-transparent whitespace-nowrap">{{ $sponsor['name'] }}</span>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    @endif

</main>
