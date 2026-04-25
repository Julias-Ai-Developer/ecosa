<main>
    <x-site.page-hero
        eyebrow="Latest Updates"
        title="Association Updates"
        current="Updates"
        :image="asset('assets/images/school/Equatorial-College-School5.jpeg')"
    />

    <section class="site-section">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            @php
                $updateFeed = $updates->isNotEmpty()
                    ? $updates
                    : collect($fallbackUpdates)->map(fn ($u) => (object) $u);

                $featured   = $updateFeed->first();
                $gridPosts  = $updateFeed->slice(1)->values();
            @endphp

            <div class="grid gap-10 xl:grid-cols-[1.6fr_0.7fr]">
                {{-- ── MAIN COLUMN ── --}}
                <div>
                    {{-- Featured post --}}
                    @if ($featured)
                        @php
                            $fImg     = is_object($featured) && method_exists($featured, 'imageUrl') ? $featured->imageUrl() : ($featured->image ?? '');
                            $fTitle   = is_object($featured) ? $featured->title : $featured['title'];
                            $fSummary = is_object($featured) ? $featured->summary : $featured['summary'];
                            $fBody    = is_object($featured) ? $featured->body : ($featured['body'] ?? '');
                            $fCat     = is_object($featured) ? $featured->category : $featured['category'];
                            $fDate    = is_object($featured) && isset($featured->published_at) ? optional($featured->published_at)->format('M j, Y') : 'Association Update';
                            $fUrl     = is_object($featured) && isset($featured->id) ? route('site.updates.show', $featured) : route('site.updates');
                        @endphp
                        <article class="overflow-hidden rounded-[24px] border border-zinc-100 bg-white shadow-sm">
                            <a href="{{ $fUrl }}" class="group block overflow-hidden">
                                <img
                                    src="{{ $fImg }}"
                                    alt="{{ $fTitle }}"
                                    class="h-[22rem] w-full object-cover transition duration-700 group-hover:scale-105 sm:h-[28rem]"
                                >
                            </a>
                            <div class="p-7 sm:p-9">
                                <div class="flex flex-wrap items-center gap-3 text-xs text-zinc-400">
                                    <span class="flex items-center gap-1.5">
                                        <i class="fas fa-user-circle text-ecosa-blue/50"></i>
                                        ECOSA Admin
                                    </span>
                                    <span class="flex items-center gap-1.5">
                                        <i class="fas fa-calendar-alt text-ecosa-blue/50"></i>
                                        {{ $fDate }}
                                    </span>
                                    <span class="site-chip ml-auto">{{ $fCat }}</span>
                                </div>
                                <h2 class="mt-5 font-display text-3xl font-bold leading-snug text-ecosa-blue-deep sm:text-4xl">
                                    <a href="{{ $fUrl }}" class="transition hover:text-ecosa-green">{{ $fTitle }}</a>
                                </h2>
                                <p class="mt-4 text-base leading-8 text-zinc-600">
                                    {{ $fSummary }}
                                </p>
                                @if (filled($fBody))
                                    <p class="mt-3 text-sm leading-7 text-zinc-500">
                                        {{ str($fBody)->limit(200) }}
                                    </p>
                                @endif
                                <a href="{{ $fUrl }}" class="mt-6 inline-flex items-center gap-2 text-sm font-bold text-ecosa-green transition hover:text-ecosa-green-deep">
                                    Continue Reading
                                    <i class="fas fa-arrow-right text-xs"></i>
                                </a>
                            </div>
                        </article>
                    @endif

                    {{-- Grid posts --}}
                    @if ($gridPosts->isNotEmpty())
                        <div class="mt-8 grid gap-6 sm:grid-cols-2">
                            @foreach ($gridPosts as $post)
                                @php
                                    $pImg     = is_object($post) && method_exists($post, 'imageUrl') ? $post->imageUrl() : ($post->image ?? '');
                                    $pTitle   = is_object($post) ? $post->title : $post['title'];
                                    $pSummary = is_object($post) ? $post->summary : $post['summary'];
                                    $pCat     = is_object($post) ? $post->category : $post['category'];
                                    $pDate    = is_object($post) && isset($post->published_at) ? optional($post->published_at)->format('M j, Y') : 'Association Update';
                                    $pUrl     = is_object($post) && isset($post->id) ? route('site.updates.show', $post) : route('site.updates');
                                @endphp
                                <article class="group flex flex-col overflow-hidden rounded-[20px] border border-zinc-100 bg-white shadow-sm">
                                    <a href="{{ $pUrl }}" class="block overflow-hidden">
                                        <img
                                            src="{{ $pImg }}"
                                            alt="{{ $pTitle }}"
                                            class="h-52 w-full object-cover transition duration-500 group-hover:scale-105"
                                        >
                                    </a>
                                    <div class="flex flex-1 flex-col p-6">
                                        <div class="flex flex-wrap items-center gap-3 text-xs text-zinc-400">
                                            <span class="flex items-center gap-1.5">
                                                <i class="fas fa-user-circle text-ecosa-blue/50"></i>
                                                ECOSA Admin
                                            </span>
                                            <span class="flex items-center gap-1.5">
                                                <i class="fas fa-calendar-alt text-ecosa-blue/50"></i>
                                                {{ $pDate }}
                                            </span>
                                        </div>
                                        <h3 class="mt-4 font-display text-xl font-bold leading-snug text-ecosa-blue-deep">
                                            <a href="{{ $pUrl }}" class="transition group-hover:text-ecosa-green">{{ $pTitle }}</a>
                                        </h3>
                                        <p class="mt-3 flex-grow text-sm leading-7 text-zinc-600">
                                            {{ str($pSummary)->limit(130) }}
                                        </p>
                                        <a href="{{ $pUrl }}" class="mt-4 inline-flex items-center gap-2 text-sm font-bold text-ecosa-green transition hover:text-ecosa-green-deep">
                                            Continue Reading
                                            <i class="fas fa-arrow-right text-xs"></i>
                                        </a>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @endif

                    @if ($updateFeed->isEmpty())
                        <div class="py-20 text-center">
                            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-ecosa-blue/[0.08]">
                                <i class="fas fa-newspaper text-3xl text-ecosa-blue/40"></i>
                            </div>
                            <h3 class="mt-6 font-display text-3xl font-semibold text-ecosa-blue-deep">Updates Coming Soon</h3>
                            <p class="mx-auto mt-4 max-w-md text-sm leading-7 text-zinc-500">
                                Association updates are being prepared. Check back soon for the latest news from ECOSA.
                            </p>
                        </div>
                    @endif
                </div>

                {{-- ── SIDEBAR ── --}}
                <aside class="space-y-6">
                    <div class="site-card p-6">
                        <h3 class="font-display text-xl font-bold text-ecosa-blue-deep">Recent Posts</h3>
                        <div class="mt-5 space-y-5">
                            @foreach ($updateFeed->take(4) as $post)
                                @php
                                    $sImg   = is_object($post) && method_exists($post, 'imageUrl') ? $post->imageUrl() : ($post->image ?? '');
                                    $sTitle = is_object($post) ? $post->title : $post['title'];
                                    $sDate  = is_object($post) && isset($post->published_at) ? optional($post->published_at)->format('M j, Y') : 'Association Update';
                                    $sUrl   = is_object($post) && isset($post->id) ? route('site.updates.show', $post) : route('site.updates');
                                @endphp
                                <a href="{{ $sUrl }}" class="group flex gap-4 transition hover:opacity-80">
                                    <img src="{{ $sImg }}" alt="{{ $sTitle }}" class="h-16 w-20 shrink-0 rounded-[10px] object-cover">
                                    <div>
                                        <p class="font-accent text-[0.7rem] font-bold uppercase tracking-[0.22em] text-zinc-400">{{ $sDate }}</p>
                                        <h4 class="mt-1 text-sm font-bold leading-6 text-ecosa-blue-deep group-hover:text-ecosa-green">{{ str($sTitle)->limit(60) }}</h4>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="site-card overflow-hidden">
                        <div class="bg-ecosa-blue-deep p-6 text-white">
                            <p class="font-accent text-[0.72rem] font-bold uppercase tracking-[0.26em] text-white/60">ECOSA Bulletin</p>
                            <h3 class="mt-4 font-display text-2xl font-bold">Member portal, updates, and public credibility.</h3>
                            <p class="mt-3 text-sm leading-7 text-white/72">
                                Publish association updates, direct members to registration, and keep the leadership story visible.
                            </p>
                            <div class="mt-5 flex flex-wrap gap-3">
                                <a href="{{ route('site.membership.register') }}" class="site-btn-primary text-xs">Register</a>
                                <a href="{{ route('login') }}" class="rounded-[10px] border border-white/20 bg-white/10 px-4 py-2 text-xs font-bold text-white transition hover:bg-white/20">
                                    Member Login
                                </a>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
</main>
