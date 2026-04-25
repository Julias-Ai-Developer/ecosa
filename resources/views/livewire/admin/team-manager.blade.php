<div class="mx-auto grid max-w-7xl gap-6 xl:grid-cols-[0.95fr_1.05fr]">
    <section class="admin-panel p-6 sm:p-7">
        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Team Manager</p>
        <h1 class="mt-3 font-display text-5xl font-semibold text-ecosa-blue-deep">Manage leadership and team presentation.</h1>
        <p class="mt-4 text-sm leading-7 text-zinc-600">
            This page controls the leadership profiles shown on the public website. Each entry can include a photo, title, portfolio, focus statement, and sort order.
        </p>

        @if ($leaderSaved)
            <div class="site-success mt-6">Leadership profile published successfully.</div>
        @endif

        <form wire:submit.prevent="saveLeader" class="mt-6 grid gap-5">
            <div class="grid gap-5 sm:grid-cols-2">
                <label>
                    <span class="site-label">Leader Name</span>
                    <input type="text" wire:model.blur="leaderName" class="site-input" placeholder="Optional full name">
                    @error('leaderName') <p class="site-error">{{ $message }}</p> @enderror
                </label>
                <label>
                    <span class="site-label">Initials</span>
                    <input type="text" wire:model.blur="leaderInitials" class="site-input" placeholder="EC">
                    @error('leaderInitials') <p class="site-error">{{ $message }}</p> @enderror
                </label>
            </div>

            <div class="grid gap-5 sm:grid-cols-2">
                <label>
                    <span class="site-label">Title</span>
                    <input type="text" wire:model.blur="leaderTitle" class="site-input" placeholder="Chairperson">
                    @error('leaderTitle') <p class="site-error">{{ $message }}</p> @enderror
                </label>
                <label>
                    <span class="site-label">Portfolio</span>
                    <input type="text" wire:model.blur="leaderPortfolio" class="site-input" placeholder="Strategic Leadership">
                    @error('leaderPortfolio') <p class="site-error">{{ $message }}</p> @enderror
                </label>
            </div>

            <label>
                <span class="site-label">Focus Statement</span>
                <textarea wire:model.blur="leaderFocus" rows="4" class="site-input" placeholder="What this leadership role delivers"></textarea>
                @error('leaderFocus') <p class="site-error">{{ $message }}</p> @enderror
            </label>

            <div class="grid gap-5 sm:grid-cols-4">
                <label>
                    <span class="site-label">Icon</span>
                    <input type="text" wire:model.blur="leaderIcon" class="site-input" placeholder="fa-user-tie">
                </label>
                <label>
                    <span class="site-label">Tone</span>
                    <select wire:model.blur="leaderTone" class="site-input">
                        <option value="blue">Blue</option>
                        <option value="green">Green</option>
                        <option value="gold">Gold</option>
                        <option value="rose">Rose</option>
                    </select>
                </label>
                <label>
                    <span class="site-label">Sort Order</span>
                    <input type="number" wire:model.blur="leaderSortOrder" class="site-input">
                    @error('leaderSortOrder') <p class="site-error">{{ $message }}</p> @enderror
                </label>
                <label>
                    <span class="site-label">Photo</span>
                    <input type="file" wire:model="leaderPhoto" accept="image/*" class="site-input">
                    @error('leaderPhoto') <p class="site-error">{{ $message }}</p> @enderror
                </label>
            </div>

            <button type="submit" class="site-btn-primary" wire:loading.attr="disabled" wire:target="saveLeader,leaderPhoto">
                <span wire:loading.remove wire:target="saveLeader,leaderPhoto">Publish Team Profile</span>
                <span wire:loading wire:target="saveLeader,leaderPhoto">Publishing...</span>
            </button>
        </form>
    </section>

    <section class="admin-panel p-6 sm:p-7">
        <div class="flex items-end justify-between gap-4">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Leadership Records</p>
                <h2 class="mt-2 font-display text-4xl font-semibold text-ecosa-blue-deep">Current public profiles</h2>
            </div>
            <span class="rounded-full bg-ecosa-blue/[0.04] px-4 py-2 text-xs font-bold uppercase tracking-[0.2em] text-ecosa-blue">{{ $leaders->count() }} total</span>
        </div>

        <div class="mt-6 grid gap-4">
            @forelse ($leaders as $leader)
                <article class="rounded-[24px] border border-ecosa-blue/8 bg-ecosa-blue/[0.03] p-5">
                    <div class="flex items-center gap-4">
                        @if ($leader->photoUrl())
                            <img src="{{ $leader->photoUrl() }}" alt="{{ $leader->title }}" class="h-16 w-16 rounded-2xl object-cover">
                        @else
                            <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-ecosa-blue text-lg font-bold text-white">{{ $leader->initials }}</div>
                        @endif
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-bold uppercase tracking-[0.2em] text-zinc-400">{{ $leader->portfolio }}</p>
                            <h3 class="mt-1 font-display text-2xl font-semibold text-ecosa-blue-deep">{{ $leader->title }}</h3>
                            <p class="mt-1 text-sm text-zinc-600">{{ $leader->name ?: $leader->initials }}</p>
                        </div>
                        <div class="flex shrink-0 items-center gap-2">
                            <span class="rounded-full bg-white px-3 py-1 text-[0.65rem] font-bold uppercase tracking-[0.15em] text-zinc-500">Order {{ $leader->sort_order }}</span>
                            <button
                                type="button"
                                wire:click="deleteLeader({{ $leader->id }})"
                                wire:confirm="Delete profile for '{{ addslashes($leader->title) }}'? This cannot be undone."
                                class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-rose-100 bg-rose-50 text-rose-500 transition hover:bg-rose-100"
                                title="Delete this profile"
                            >
                                <i class="fas fa-trash-can text-xs"></i>
                            </button>
                        </div>
                    </div>
                </article>
            @empty
                <div class="rounded-[24px] border border-dashed border-ecosa-blue/15 py-10 text-center">
                    <i class="fas fa-users-gear text-3xl text-zinc-300"></i>
                    <p class="mt-4 text-sm text-zinc-500">No leadership profiles have been created yet.</p>
                </div>
            @endforelse
        </div>
    </section>
</div>
