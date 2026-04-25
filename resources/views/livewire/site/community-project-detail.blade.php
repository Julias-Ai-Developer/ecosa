<main>
    {{-- Hero with project image --}}
    <section class="relative overflow-hidden bg-ecosa-navy">
        <div class="absolute inset-0">
            <img
                src="{{ $program->imageUrl() }}"
                alt="{{ $program->title }}"
                class="h-full w-full object-cover opacity-40"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-ecosa-navy via-ecosa-navy/70 to-ecosa-navy/30"></div>
        </div>

        <div class="relative mx-auto max-w-4xl px-5 py-20 lg:px-8 lg:py-28">
            {{-- Breadcrumb --}}
            <nav class="mb-6 flex items-center gap-2 text-xs font-bold uppercase tracking-[0.2em] text-white/60">
                <a href="{{ route('site.community.projects') }}" class="transition hover:text-white">Projects</a>
                <span>/</span>
                <span class="text-white/90">{{ str($program->title)->limit(40) }}</span>
            </nav>

            {{-- Status + schedule --}}
            <div class="flex flex-wrap items-center gap-3">
                @php
                    $statusClass = match ($program->status) {
                        'active'    => 'bg-ecosa-green text-white',
                        'completed' => 'bg-ecosa-blue text-white',
                        default     => 'bg-ecosa-gold text-ecosa-ink',
                    };
                @endphp
                <span class="rounded px-3 py-1 text-xs font-bold uppercase tracking-[0.18em] {{ $statusClass }}">
                    {{ ucfirst($program->status ?? 'active') }}
                </span>

                @if ($program->scheduleLabel())
                    <span class="flex items-center gap-1.5 text-xs font-semibold text-white/70">
                        <i class="fas fa-calendar-alt"></i>
                        {{ $program->scheduleLabel() }}
                    </span>
                @endif

                @if (filled($program->location))
                    <span class="flex items-center gap-1.5 text-xs font-semibold text-white/70">
                        <i class="fas fa-location-dot"></i>
                        {{ $program->location }}
                    </span>
                @endif
            </div>

            <h1 class="mt-5 font-display text-4xl font-bold leading-tight text-white sm:text-5xl lg:text-6xl">
                {{ $program->title }}
            </h1>

            @if (filled($program->summary))
                <p class="mt-5 max-w-2xl text-base leading-8 text-white/80">
                    {{ $program->summary }}
                </p>
            @endif
        </div>
    </section>

    {{-- Full content --}}
    <section class="site-section">
        <div class="mx-auto max-w-4xl px-5 lg:px-8">
            <div class="grid gap-10 lg:grid-cols-[1fr_280px]">

                {{-- Main body --}}
                <div>
                    @if (filled($program->body))
                        <div class="prose prose-zinc max-w-none text-sm leading-8 text-zinc-700">
                            {!! nl2br(e($program->body)) !!}
                        </div>
                    @else
                        <p class="text-sm leading-8 text-zinc-500 italic">
                            Full project details will be published soon.
                        </p>
                    @endif

                    <div class="mt-10 flex flex-wrap gap-4">
                        <a href="{{ route('site.membership.register') }}" class="site-btn-primary">
                            Join &amp; Participate
                            <i class="fas fa-arrow-right ml-1 text-xs"></i>
                        </a>
                        <a href="{{ route('site.community.projects') }}" class="site-btn-ghost">
                            <i class="fas fa-arrow-left mr-1 text-xs"></i>
                            All Projects
                        </a>
                    </div>
                </div>

                {{-- Sidebar --}}
                <aside class="space-y-6">
                    <div class="border border-zinc-100 bg-white p-6 shadow-sm">
                        <h3 class="font-display text-lg font-bold text-ecosa-blue-deep">Project Details</h3>
                        <dl class="mt-4 space-y-4 text-sm">
                            <div>
                                <dt class="font-bold uppercase tracking-[0.14em] text-zinc-400 text-[0.68rem]">Status</dt>
                                <dd class="mt-1 font-semibold text-zinc-700">{{ ucfirst($program->status ?? 'Active') }}</dd>
                            </div>
                            @if ($program->scheduleLabel())
                                <div>
                                    <dt class="font-bold uppercase tracking-[0.14em] text-zinc-400 text-[0.68rem]">Schedule</dt>
                                    <dd class="mt-1 font-semibold text-zinc-700">{{ $program->scheduleLabel() }}</dd>
                                </div>
                            @endif
                            @if (filled($program->location))
                                <div>
                                    <dt class="font-bold uppercase tracking-[0.14em] text-zinc-400 text-[0.68rem]">Location</dt>
                                    <dd class="mt-1 font-semibold text-zinc-700">{{ $program->location }}</dd>
                                </div>
                            @endif
                            @if (filled($program->cta_label) && filled($program->cta_url))
                                <div>
                                    <a
                                        href="{{ $program->cta_url }}"
                                        target="_blank"
                                        rel="noopener"
                                        class="site-btn-secondary mt-2 w-full justify-center"
                                    >
                                        {{ $program->cta_label }}
                                        <i class="fas fa-external-link-alt text-xs"></i>
                                    </a>
                                </div>
                            @endif
                        </dl>
                    </div>

                    <div class="border border-ecosa-green/20 bg-ecosa-green/[0.06] p-6">
                        <p class="font-accent text-[0.72rem] font-bold uppercase tracking-[0.24em] text-ecosa-green-deep">Get Involved</p>
                        <p class="mt-3 text-sm leading-7 text-zinc-700">
                            Become a member to participate in ECOSA community projects and school-support initiatives.
                        </p>
                        <a href="{{ route('site.membership.register') }}" class="site-btn-primary mt-4 w-full justify-center">
                            Register Now
                        </a>
                    </div>
                </aside>
            </div>
        </div>
    </section>
</main>
