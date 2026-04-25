<main>
    <x-site.page-hero
        eyebrow="Latest Updates"
        title="Updates"
        current="Updates"
        :image="asset('assets/images/school/Equatorial-College-School5.jpeg')"
    />

    <section class="site-section">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            @php
                $updateFeed = $updates->isNotEmpty()
                    ? $updates->map(fn ($update) => [
                        'title' => $update->title,
                        'summary' => $update->summary,
                        'body' => $update->body,
                        'category' => $update->category,
                        'image' => $update->imageUrl(),
                        'date' => optional($update->published_at)->format('M j, Y') ?: $update->created_at->format('M j, Y'),
                    ])->values()
                    : collect($fallbackUpdates)->map(fn ($update) => [
                        'title' => $update['title'],
                        'summary' => $update['summary'],
                        'body' => $update['body'],
                        'category' => $update['category'],
                        'image' => $update['image'],
                        'date' => 'Association Update',
                    ])->values();

                $featuredPost = $updateFeed->first();
                $gridPosts = $updateFeed->slice(1)->values();
                $popularPosts = $updateFeed->take(4);
            @endphp

            <div class="grid gap-8 xl:grid-cols-[1.55fr_0.78fr]">
                <div>
                    @if ($featuredPost)
                        <article class="site-card overflow-hidden">
                            <img src="{{ $featuredPost['image'] }}" alt="{{ $featuredPost['title'] }}" class="h-[22rem] w-full object-cover sm:h-[28rem]">
                            <div class="p-7 sm:p-9">
                                <div class="flex flex-wrap items-center justify-between gap-4">
                                    <span class="site-chip">{{ $featuredPost['category'] }}</span>
                                    <span class="font-accent text-xs font-bold uppercase tracking-[0.22em] text-zinc-400">{{ $featuredPost['date'] }}</span>
                                </div>
                                <h2 class="mt-6 font-display text-4xl font-bold text-ecosa-blue-deep sm:text-5xl">{{ $featuredPost['title'] }}</h2>
                                <p class="mt-5 text-base leading-8 text-zinc-600">{{ $featuredPost['summary'] }}</p>
                                @if (filled($featuredPost['body']))
                                    <p class="mt-4 text-sm leading-7 text-zinc-500">{{ str($featuredPost['body'])->limit(220) }}</p>
                                @endif
                            </div>
                        </article>
                    @endif

                    @if ($gridPosts->isNotEmpty())
                        <div class="mt-8 grid gap-6 md:grid-cols-2">
                            @foreach ($gridPosts as $update)
                                <article class="site-card overflow-hidden">
                                    <img src="{{ $update['image'] }}" alt="{{ $update['title'] }}" class="h-56 w-full object-cover">
                                    <div class="p-6">
                                        <div class="flex flex-wrap items-center justify-between gap-3">
                                            <span class="site-chip">{{ $update['category'] }}</span>
                                            <span class="font-accent text-xs font-bold uppercase tracking-[0.2em] text-zinc-400">{{ $update['date'] }}</span>
                                        </div>
                                        <h3 class="mt-5 font-display text-3xl font-bold text-ecosa-blue-deep">{{ $update['title'] }}</h3>
                                        <p class="mt-4 text-sm leading-7 text-zinc-600">{{ $update['summary'] }}</p>
                                        <p class="mt-4 text-sm leading-7 text-zinc-500">{{ str($update['body'])->limit(150) }}</p>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @endif
                </div>

                <aside class="space-y-6">
                    <div class="site-card p-6">
                        <h3 class="font-display text-3xl font-bold text-ecosa-blue-deep">Popular Posts</h3>

                        <div class="mt-6 space-y-5">
                            @foreach ($popularPosts as $post)
                                <article class="flex gap-4">
                                    <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}" class="h-20 w-24 rounded-2xl object-cover">
                                    <div>
                                        <p class="font-accent text-[0.72rem] font-bold uppercase tracking-[0.22em] text-zinc-400">{{ $post['date'] }}</p>
                                        <h4 class="mt-2 text-sm font-bold leading-6 text-ecosa-blue-deep">{{ $post['title'] }}</h4>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>

                    <div class="site-card overflow-hidden">
                        <div class="bg-[linear-gradient(135deg,#102b47,#173a60)] p-7 text-white">
                            <p class="font-accent text-[0.72rem] font-bold uppercase tracking-[0.26em] text-white/68">ECOSA Bulletin</p>
                            <h3 class="mt-4 font-display text-4xl font-bold">Member portal, updates, and public credibility in one place.</h3>
                            <p class="mt-4 text-sm leading-7 text-white/78">
                                Publish association updates, direct members to registration, and keep the leadership story visible through a stronger editorial page.
                            </p>
                            <div class="mt-6 flex flex-wrap gap-3">
                                <a href="{{ route('site.membership.register') }}" class="site-btn-secondary">Register</a>
                                <a href="{{ route('login') }}" class="site-btn-ghost border-white/18 bg-white/10 text-white hover:bg-white/18">Member Login</a>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
</main>
