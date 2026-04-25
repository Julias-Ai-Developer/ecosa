<main>
    <x-site.page-hero
        eyebrow="Latest Updates"
        :title="$update->title"
        current="Updates"
        :image="$update->imageUrl()"
    />

    <section class="site-section">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="grid gap-10 xl:grid-cols-[1.6fr_0.7fr]">

                {{-- Main Content --}}
                <article>
                    <div class="overflow-hidden rounded-[24px] shadow-md">
                        <img
                            src="{{ $update->imageUrl() }}"
                            alt="{{ $update->title }}"
                            class="h-[22rem] w-full object-cover sm:h-[30rem]"
                        >
                    </div>

                    <div class="mt-8">
                        {{-- Meta --}}
                        <div class="flex flex-wrap items-center gap-4 text-xs text-zinc-400">
                            <span class="flex items-center gap-1.5">
                                <i class="fas fa-user-circle text-ecosa-blue/50"></i>
                                ECOSA Admin
                            </span>
                            <span class="flex items-center gap-1.5">
                                <i class="fas fa-calendar-alt text-ecosa-blue/50"></i>
                                {{ optional($update->published_at)->format('M j, Y') ?: $update->created_at->format('M j, Y') }}
                            </span>
                            <span class="site-chip ml-auto">{{ $update->category }}</span>
                        </div>

                        {{-- Title --}}
                        <h1 class="mt-5 font-display text-4xl font-bold leading-tight text-ecosa-blue-deep sm:text-5xl">
                            {{ $update->title }}
                        </h1>

                        {{-- Summary --}}
                        <p class="mt-5 text-lg leading-8 text-zinc-600">
                            {{ $update->summary }}
                        </p>

                        {{-- Body --}}
                        @if(filled($update->body))
                            <div class="mt-6 border-t border-zinc-100 pt-6 text-base leading-9 text-zinc-600 [&>p]:mb-4">
                                {!! nl2br(e($update->body)) !!}
                            </div>
                        @endif

                        {{-- Back link --}}
                        <div class="mt-10 border-t border-zinc-100 pt-6">
                            <a href="{{ route('site.updates') }}" class="inline-flex items-center gap-2 text-sm font-bold text-ecosa-green transition hover:text-ecosa-green-deep">
                                <i class="fas fa-arrow-left text-xs"></i>
                                Back to All Updates
                            </a>
                        </div>
                    </div>
                </article>

                {{-- Sidebar --}}
                <aside class="space-y-6">
                    <div class="site-card p-6">
                        <h3 class="font-display text-xl font-bold text-ecosa-blue-deep">Related Updates</h3>
                        <div class="mt-5 space-y-5">
                            @foreach ($related as $item)
                                @php
                                    $itemImg   = is_object($item) && method_exists($item, 'imageUrl') ? $item->imageUrl() : $item['image'];
                                    $itemTitle = is_object($item) ? $item->title : $item['title'];
                                    $itemDate  = is_object($item) ? optional($item->published_at)->format('M j, Y') : 'Association Update';
                                    $itemUrl   = is_object($item) ? route('site.updates.show', $item) : route('site.updates');
                                @endphp
                                <a href="{{ $itemUrl }}" class="group flex gap-4 transition hover:opacity-80">
                                    <img
                                        src="{{ $itemImg }}"
                                        alt="{{ $itemTitle }}"
                                        class="h-20 w-24 shrink-0 rounded-[10px] object-cover"
                                    >
                                    <div>
                                        <p class="font-accent text-[0.7rem] font-bold uppercase tracking-[0.22em] text-zinc-400">
                                            {{ $itemDate }}
                                        </p>
                                        <h4 class="mt-1 text-sm font-bold leading-6 text-ecosa-blue-deep group-hover:text-ecosa-green">
                                            {{ $itemTitle }}
                                        </h4>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="site-card overflow-hidden">
                        <div class="bg-ecosa-blue-deep p-6 text-white">
                            <p class="font-accent text-[0.72rem] font-bold uppercase tracking-[0.26em] text-white/60">ECOSA Membership</p>
                            <h3 class="mt-4 font-display text-2xl font-bold">Join ECOSA today</h3>
                            <p class="mt-3 text-sm leading-7 text-white/72">
                                Become a verified member and stay connected with the latest association news, events, and programs.
                            </p>
                            <a href="{{ route('site.membership.register') }}" class="mt-5 inline-flex items-center gap-2 rounded-[10px] bg-ecosa-green px-5 py-2.5 text-sm font-bold text-white transition hover:bg-ecosa-green-deep">
                                Register Now
                                <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
</main>
