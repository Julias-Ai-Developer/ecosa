<main>
    <x-site.page-hero
        eyebrow="Community Events"
        title="Events & Gatherings"
        current="Events"
        :image="asset('assets/images/school/aerialview.jpeg')"
    />

    <section class="site-section">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($events as $event)
                    @php
                        $title    = data_get($event, 'title');
                        $summary  = data_get($event, 'summary') ?: data_get($event, 'text');
                        $location = data_get($event, 'location') ?: data_get($event, 'meta');
                        $image    = is_object($event) && method_exists($event, 'imageUrl') ? $event->imageUrl() : asset('assets/images/school/aerialview.jpeg');
                        $schedule = is_object($event) && method_exists($event, 'scheduleLabel') ? $event->scheduleLabel() : null;
                        $status   = data_get($event, 'status', 'upcoming');
                    @endphp
                    <article class="group flex flex-col overflow-hidden rounded-[20px] border border-zinc-100 bg-white shadow-sm">
                        {{-- Image --}}
                        <div class="relative overflow-hidden">
                            <img
                                src="{{ $image }}"
                                alt="{{ $title }}"
                                class="h-52 w-full object-cover transition duration-500 group-hover:scale-105"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                            @if($schedule)
                                <span class="absolute left-4 top-4 rounded-full bg-ecosa-gold px-3 py-1 text-[0.7rem] font-bold uppercase tracking-[0.18em] text-ecosa-ink">
                                    {{ $schedule }}
                                </span>
                            @endif
                        </div>
                        {{-- Content --}}
                        <div class="flex flex-1 flex-col p-6">
                            <div class="flex flex-wrap items-center gap-3 text-xs text-zinc-400">
                                <span class="flex items-center gap-1.5">
                                    <i class="fas fa-user-circle text-ecosa-blue/50"></i>
                                    ECOSA Admin
                                </span>
                                @if(filled($location))
                                    <span class="flex items-center gap-1.5">
                                        <i class="fas fa-location-dot text-ecosa-blue/50"></i>
                                        {{ $location }}
                                    </span>
                                @endif
                            </div>
                            <h3 class="mt-4 font-display text-xl font-bold leading-snug text-ecosa-blue-deep">
                                {{ $title }}
                            </h3>
                            <p class="mt-3 flex-grow text-sm leading-7 text-zinc-600">
                                {{ str($summary)->limit(140) }}
                            </p>
                            <a href="{{ route('site.community.events') }}" class="mt-4 inline-flex items-center gap-2 text-sm font-bold text-ecosa-green transition hover:text-ecosa-green-deep">
                                Learn More
                                <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</main>
