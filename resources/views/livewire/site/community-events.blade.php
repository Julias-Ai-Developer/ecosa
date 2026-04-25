<main>
    <x-site.page-hero
        eyebrow="Community Events"
        title="Events"
        current="Events"
        :image="asset('assets/images/school/aerialview.jpeg')"
    />

    <section class="site-section">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-2">
                @foreach ($events as $event)
                    @php
                        $title = data_get($event, 'title');
                        $summary = data_get($event, 'summary') ?: data_get($event, 'text');
                        $location = data_get($event, 'location') ?: data_get($event, 'meta');
                        $image = is_object($event) && method_exists($event, 'imageUrl') ? $event->imageUrl() : asset('assets/images/school/aerialview.jpeg');
                        $schedule = is_object($event) && method_exists($event, 'scheduleLabel') ? $event->scheduleLabel() : null;
                    @endphp
                    <article class="site-card overflow-hidden">
                        <img src="{{ $image }}" alt="{{ $title }}" class="h-64 w-full object-cover">
                        <div class="p-7">
                            <div class="flex flex-wrap items-center gap-3">
                                <span class="site-chip">Event</span>
                                @if (filled($schedule))
                                    <span class="text-xs font-bold uppercase tracking-[0.22em] text-zinc-400">{{ $schedule }}</span>
                                @endif
                            </div>
                            <h2 class="mt-5 font-display text-4xl font-semibold text-ecosa-blue-deep">{{ $title }}</h2>
                            <p class="mt-4 text-sm leading-7 text-zinc-600">{{ $summary }}</p>
                            @if (filled($location))
                                <p class="mt-4 text-sm font-semibold text-ecosa-green-deep">{{ $location }}</p>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</main>
