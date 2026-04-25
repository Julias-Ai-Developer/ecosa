<div class="mx-auto grid max-w-7xl gap-6 xl:grid-cols-[0.95fr_1.05fr]">
    <section class="admin-panel p-6 sm:p-7">
        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">News Manager</p>
        <h1 class="mt-3 font-display text-5xl font-semibold text-ecosa-blue-deep">Publish latest updates for the public website.</h1>
        <p class="mt-4 text-sm leading-7 text-zinc-600">
            Use this module for announcements, projects, leadership communication, and any content that belongs on the public updates page or home-page highlights.
        </p>

        @if ($newsSaved)
            <div class="site-success mt-6">News update published successfully.</div>
        @endif

        <form wire:submit.prevent="saveNews" class="mt-6 grid gap-5">
            <div class="grid gap-5 sm:grid-cols-2">
                <label>
                    <span class="site-label">Category</span>
                    <input type="text" wire:model.blur="newsCategory" class="site-input" placeholder="Association, Project, Event...">
                    @error('newsCategory') <p class="site-error">{{ $message }}</p> @enderror
                </label>
                <label>
                    <span class="site-label">Feature Image</span>
                    <input type="file" wire:model="newsImage" accept="image/*" class="site-input">
                    @error('newsImage') <p class="site-error">{{ $message }}</p> @enderror
                </label>
            </div>

            <label>
                <span class="site-label">Title</span>
                <input type="text" wire:model.blur="newsTitle" class="site-input" placeholder="Headline for the update">
                @error('newsTitle') <p class="site-error">{{ $message }}</p> @enderror
            </label>

            <label>
                <span class="site-label">Summary</span>
                <textarea wire:model.blur="newsSummary" rows="4" class="site-input" placeholder="Short summary used across cards and previews"></textarea>
                @error('newsSummary') <p class="site-error">{{ $message }}</p> @enderror
            </label>

            <label>
                <span class="site-label">Body</span>
                <textarea wire:model.blur="newsBody" rows="6" class="site-input" placeholder="Optional longer body for editorial detail"></textarea>
                @error('newsBody') <p class="site-error">{{ $message }}</p> @enderror
            </label>

            <button type="submit" class="site-btn-primary" wire:loading.attr="disabled" wire:target="saveNews,newsImage">
                <span wire:loading.remove wire:target="saveNews,newsImage">Publish Update</span>
                <span wire:loading wire:target="saveNews,newsImage">Publishing...</span>
            </button>
        </form>
    </section>

    <section class="admin-panel p-6 sm:p-7">
        <div class="flex items-end justify-between gap-4">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Published Content</p>
                <h2 class="mt-2 font-display text-4xl font-semibold text-ecosa-blue-deep">Recent updates</h2>
            </div>
            <span class="rounded-full bg-ecosa-blue/[0.04] px-4 py-2 text-xs font-bold uppercase tracking-[0.2em] text-ecosa-blue">{{ $newsUpdates->count() }} total</span>
        </div>

        <div class="mt-6 grid gap-4">
            @forelse ($newsUpdates as $update)
                <article class="rounded-[24px] border border-ecosa-blue/8 bg-ecosa-blue/[0.03] p-5">
                    <div class="flex items-center justify-between gap-3">
                        <span class="site-chip">{{ $update->category }}</span>
                        <div class="flex items-center gap-2">
                            @if ($update->published_at)
                                <span class="text-xs font-bold uppercase tracking-[0.18em] text-zinc-400">{{ $update->published_at->format('M j, Y') }}</span>
                            @endif
                            <button
                                type="button"
                                wire:click="deleteNews({{ $update->id }})"
                                wire:confirm="Delete '{{ addslashes($update->title) }}'? This cannot be undone."
                                class="inline-flex h-8 w-8 items-center justify-center rounded-xl border border-rose-100 bg-rose-50 text-rose-500 transition hover:bg-rose-100"
                                title="Delete this update"
                            >
                                <i class="fas fa-trash-can text-xs"></i>
                            </button>
                        </div>
                    </div>
                    <h3 class="mt-4 font-display text-3xl font-semibold text-ecosa-blue-deep">{{ $update->title }}</h3>
                    <p class="mt-3 text-sm leading-7 text-zinc-600">{{ $update->summary }}</p>
                </article>
            @empty
                <div class="rounded-[24px] border border-dashed border-ecosa-blue/15 py-10 text-center">
                    <i class="fas fa-newspaper text-3xl text-zinc-300"></i>
                    <p class="mt-4 text-sm text-zinc-500">No updates have been published yet.</p>
                </div>
            @endforelse
        </div>
    </section>
</div>
