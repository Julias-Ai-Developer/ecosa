<div class="mx-auto grid max-w-7xl gap-6 xl:grid-cols-[0.95fr_1.05fr]">
    <section class="admin-panel p-6 sm:p-7">
        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Community Manager</p>
        <h1 class="mt-3 font-display text-5xl font-semibold text-ecosa-blue-deep">Manage events, projects, and the insurance group pages.</h1>
        <p class="mt-4 text-sm leading-7 text-zinc-600">
            This module powers the community area on the public site. Each item belongs to a dedicated route-driven page so the structure remains clear and corporate.
        </p>

        @if ($programSaved)
            <div class="site-success mt-6">Community entry published successfully.</div>
        @endif

        <form wire:submit.prevent="saveProgram" class="mt-6 grid gap-5">
            <div class="grid gap-5 sm:grid-cols-2">
                <label>
                    <span class="site-label">Program Type</span>
                    <select wire:model.blur="programType" class="site-input">
                        <option value="event">Event</option>
                        <option value="project">Project</option>
                        <option value="insurance_group">Insurance Group</option>
                    </select>
                    @error('programType') <p class="site-error">{{ $message }}</p> @enderror
                </label>
                <label>
                    <span class="site-label">Status</span>
                    <select wire:model.blur="programStatus" class="site-input">
                        <option value="upcoming">Upcoming</option>
                        <option value="active">Active</option>
                        <option value="completed">Completed</option>
                    </select>
                    @error('programStatus') <p class="site-error">{{ $message }}</p> @enderror
                </label>
            </div>

            <label>
                <span class="site-label">Title</span>
                <input type="text" wire:model.blur="programTitle" class="site-input" placeholder="Headline for the entry">
                @error('programTitle') <p class="site-error">{{ $message }}</p> @enderror
            </label>

            <label>
                <span class="site-label">Summary</span>
                <textarea wire:model.blur="programSummary" rows="4" class="site-input" placeholder="Card summary and intro text"></textarea>
                @error('programSummary') <p class="site-error">{{ $message }}</p> @enderror
            </label>

            <label>
                <span class="site-label">Body</span>
                <textarea wire:model.blur="programBody" rows="6" class="site-input" placeholder="Optional extended public description"></textarea>
                @error('programBody') <p class="site-error">{{ $message }}</p> @enderror
            </label>

            <div class="grid gap-5 sm:grid-cols-2">
                <label>
                    <span class="site-label">Location</span>
                    <input type="text" wire:model.blur="programLocation" class="site-input" placeholder="Campus, regional chapter, online...">
                    @error('programLocation') <p class="site-error">{{ $message }}</p> @enderror
                </label>
                <label>
                    <span class="site-label">Feature Image</span>
                    <input type="file" wire:model="programImage" accept="image/*" class="site-input">
                    @error('programImage') <p class="site-error">{{ $message }}</p> @enderror
                </label>
            </div>

            <div class="grid gap-5 sm:grid-cols-4">
                <label>
                    <span class="site-label">Starts At</span>
                    <input type="date" wire:model.blur="programStartsAt" class="site-input">
                    @error('programStartsAt') <p class="site-error">{{ $message }}</p> @enderror
                </label>
                <label>
                    <span class="site-label">Ends At</span>
                    <input type="date" wire:model.blur="programEndsAt" class="site-input">
                    @error('programEndsAt') <p class="site-error">{{ $message }}</p> @enderror
                </label>
                <label>
                    <span class="site-label">CTA Label</span>
                    <input type="text" wire:model.blur="programCtaLabel" class="site-input" placeholder="Learn more">
                    @error('programCtaLabel') <p class="site-error">{{ $message }}</p> @enderror
                </label>
                <label>
                    <span class="site-label">Sort Order</span>
                    <input type="number" wire:model.blur="programSortOrder" class="site-input">
                    @error('programSortOrder') <p class="site-error">{{ $message }}</p> @enderror
                </label>
            </div>

            <label>
                <span class="site-label">CTA URL</span>
                <input type="url" wire:model.blur="programCtaUrl" class="site-input" placeholder="https://...">
                @error('programCtaUrl') <p class="site-error">{{ $message }}</p> @enderror
            </label>

            <button type="submit" class="site-btn-primary" wire:loading.attr="disabled" wire:target="saveProgram,programImage">
                <span wire:loading.remove wire:target="saveProgram,programImage">Publish Community Entry</span>
                <span wire:loading wire:target="saveProgram,programImage">Publishing...</span>
            </button>
        </form>
    </section>

    <section class="admin-panel p-6 sm:p-7">
        <div class="flex items-end justify-between gap-4">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Community Records</p>
                <h2 class="mt-2 font-display text-4xl font-semibold text-ecosa-blue-deep">Current public entries</h2>
            </div>
            <span class="rounded-full bg-ecosa-blue/[0.04] px-4 py-2 text-xs font-bold uppercase tracking-[0.2em] text-ecosa-blue">{{ $programs->count() }} total</span>
        </div>

        <div class="mt-6 grid gap-4">
            @forelse ($programs as $program)
                <article class="rounded-[24px] border border-ecosa-blue/8 bg-ecosa-blue/[0.03] p-5">
                    <div class="flex items-center justify-between gap-3">
                        <span class="site-chip">{{ $program->typeLabel() }}</span>
                        <div class="flex items-center gap-2">
                            <span class="rounded-full bg-white px-3 py-1 text-[0.65rem] font-bold uppercase tracking-[0.15em] text-ecosa-green-deep">{{ $program->status }}</span>
                            <button
                                type="button"
                                wire:click="deleteProgram({{ $program->id }})"
                                wire:confirm="Delete '{{ addslashes($program->title) }}'? This cannot be undone."
                                class="inline-flex h-8 w-8 items-center justify-center rounded-xl border border-rose-100 bg-rose-50 text-rose-500 transition hover:bg-rose-100"
                                title="Delete this entry"
                            >
                                <i class="fas fa-trash-can text-xs"></i>
                            </button>
                        </div>
                    </div>
                    <h3 class="mt-4 font-display text-2xl font-semibold text-ecosa-blue-deep">{{ $program->title }}</h3>
                    <p class="mt-3 text-sm leading-7 text-zinc-600">{{ $program->summary }}</p>
                    @if ($program->location)
                        <p class="mt-3 inline-flex items-center gap-2 text-sm font-semibold text-ecosa-green-deep">
                            <i class="fas fa-location-dot text-ecosa-green text-xs"></i>
                            {{ $program->location }}
                        </p>
                    @endif
                    @if ($program->starts_at)
                        <p class="mt-2 text-xs text-zinc-400">{{ $program->scheduleLabel() }}</p>
                    @endif
                </article>
            @empty
                <div class="rounded-[24px] border border-dashed border-ecosa-blue/15 py-10 text-center">
                    <i class="fas fa-layer-group text-3xl text-zinc-300"></i>
                    <p class="mt-4 text-sm text-zinc-500">No community entries have been created yet.</p>
                </div>
            @endforelse
        </div>
    </section>
</div>
