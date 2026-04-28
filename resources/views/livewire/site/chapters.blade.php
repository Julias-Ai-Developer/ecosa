<main>
    <x-site.page-hero
        eyebrow="ECOSA Chapters"
        title="Chapters"
        current="Chapters"
        :image="asset('assets/images/school/aerialview.jpeg')"
    />

    <section class="site-section">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <x-site.section-heading
                eyebrow="Find Your Group"
                title="Search by chapter, profession, business, or region."
                text="Approved chapters help members find close friends, professional groups, business networks, class-year groups, and regional support. Members can only belong to one primary chapter."
                align="center"
            />

            <div class="mx-auto mt-8 grid max-w-4xl gap-3 sm:grid-cols-[1fr_220px]">
                <input type="search" wire:model.live.debounce.300ms="search" class="site-input" placeholder="Search chapters, professions, businesses, regions...">
                <select wire:model.live="category" class="site-input">
                    <option value="all">All categories</option>
                    <option value="regional">Regional</option>
                    <option value="professional">Professional</option>
                    <option value="business">Business</option>
                    <option value="class_year">Class Year</option>
                </select>
            </div>

            <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @forelse ($chapters as $chapter)
                    <article class="site-card p-7">
                        <div class="flex items-start justify-between gap-4">
                            <span class="site-chip">{{ $chapter->categoryLabel() }}</span>
                            <span class="rounded-full bg-ecosa-blue/8 px-3 py-1 text-xs font-bold text-ecosa-blue-deep">{{ $chapter->members_count }} members</span>
                        </div>
                        <h2 class="mt-5 font-display text-3xl font-semibold text-ecosa-blue-deep">{{ $chapter->name }}</h2>
                        <p class="mt-3 text-sm leading-7 text-zinc-600">{{ $chapter->description }}</p>
                        <div class="mt-5 grid gap-2 text-xs font-semibold text-zinc-500">
                            @if($chapter->region)<p><i class="fas fa-location-dot mr-2 text-ecosa-green"></i>{{ $chapter->region }}</p>@endif
                            @if($chapter->profession)<p><i class="fas fa-briefcase mr-2 text-ecosa-green"></i>{{ $chapter->profession }}</p>@endif
                            @if($chapter->business_sector)<p><i class="fas fa-store mr-2 text-ecosa-green"></i>{{ $chapter->business_sector }}</p>@endif
                        </div>
                        <a href="{{ route('member.chapters') }}" class="site-btn-primary mt-6 w-full">Join Chapter</a>
                    </article>
                @empty
                    <div class="col-span-full rounded-[24px] border border-zinc-100 bg-white p-10 text-center shadow-sm">
                        <h3 class="font-display text-3xl font-semibold text-ecosa-blue-deep">No approved chapters yet</h3>
                        <p class="mx-auto mt-3 max-w-xl text-sm leading-7 text-zinc-600">Approved chapters will appear here after members request them and admins approve them.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</main>
