<div class="mx-auto max-w-7xl space-y-6">
    <div>
        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Member Chapter</p>
        <h1 class="mt-1 text-3xl font-bold text-zinc-900">Join or Request a Chapter</h1>
        <p class="mt-2 max-w-3xl text-sm leading-7 text-zinc-500">A member can belong to only one primary chapter. Creating a new chapter requires admin approval before it appears publicly.</p>
    </div>

    @if($saved)
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">
            Saved successfully.
        </div>
    @endif

    <section class="grid gap-6 xl:grid-cols-[0.9fr_1.1fr]">
        <article class="rounded-2xl border border-zinc-100 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-bold text-zinc-900">Your Current Chapter</h2>
            @if($currentMembership)
                <div class="mt-5 rounded-xl border border-ecosa-green/20 bg-ecosa-green/8 p-5">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-ecosa-green-deep">{{ $currentMembership->statusLabel() }}</p>
                    <h3 class="mt-2 text-2xl font-bold text-zinc-900">{{ $currentMembership->chapter->name }}</h3>
                    <p class="mt-2 text-sm leading-6 text-zinc-600">{{ $currentMembership->chapter->description }}</p>
                </div>
            @else
                <p class="mt-4 text-sm leading-7 text-zinc-600">You are not in a chapter yet. Select an approved chapter below.</p>
                <form wire:submit.prevent="joinChapter" class="mt-5 grid gap-4">
                    <label>
                        <span class="site-label">Approved Chapters</span>
                        <select wire:model.blur="selectedChapter" class="site-input">
                            <option value="">Choose a chapter</option>
                            @foreach($chapters as $chapter)
                                <option value="{{ $chapter->id }}">{{ $chapter->name }} ({{ $chapter->approved_memberships_count }} members)</option>
                            @endforeach
                        </select>
                        @error('selectedChapter') <p class="site-error">{{ $message }}</p> @enderror
                    </label>
                    <button type="submit" class="rounded-xl bg-ecosa-green px-5 py-3 text-sm font-bold text-white transition hover:bg-ecosa-green-deep">Join Chapter</button>
                </form>
            @endif
        </article>

        <article class="rounded-2xl border border-zinc-100 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-bold text-zinc-900">Request a New Chapter</h2>
            <form wire:submit.prevent="requestChapter" class="mt-5 grid gap-4 sm:grid-cols-2">
                <label class="sm:col-span-2">
                    <span class="site-label">Chapter Name</span>
                    <input type="text" wire:model.blur="name" class="site-input" placeholder="Engineering Chapter, Class of 2010...">
                    @error('name') <p class="site-error">{{ $message }}</p> @enderror
                </label>
                <label>
                    <span class="site-label">Category</span>
                    <select wire:model.live="category" class="site-input">
                        <option value="regional">Regional</option>
                        <option value="professional">Professional</option>
                        <option value="business">Business</option>
                        <option value="class_year">Class Year</option>
                    </select>
                </label>
                <label>
                    <span class="site-label">Region / Class Year</span>
                    <input type="text" wire:model.blur="region" class="site-input" placeholder="Kampala, Diaspora, 2010...">
                </label>
                <label>
                    <span class="site-label">Profession</span>
                    <input type="text" wire:model.blur="profession" class="site-input" placeholder="Engineering, Health, Law...">
                </label>
                <label>
                    <span class="site-label">Business Sector</span>
                    <input type="text" wire:model.blur="businessSector" class="site-input" placeholder="Construction, retail, consulting...">
                </label>
                <label class="sm:col-span-2">
                    <span class="site-label">Description</span>
                    <textarea wire:model.blur="description" rows="4" class="site-input" placeholder="Explain what this chapter is about."></textarea>
                    @error('description') <p class="site-error">{{ $message }}</p> @enderror
                </label>
                <label class="sm:col-span-2">
                    <span class="site-label">Reason for Request</span>
                    <textarea wire:model.blur="reason" rows="4" class="site-input" placeholder="Why should ECOSA approve this chapter?"></textarea>
                    @error('reason') <p class="site-error">{{ $message }}</p> @enderror
                </label>
                <div class="sm:col-span-2">
                    <button type="submit" class="rounded-xl bg-ecosa-blue-deep px-5 py-3 text-sm font-bold text-white transition hover:bg-ecosa-blue">Send Request for Approval</button>
                </div>
            </form>
        </article>
    </section>

    @if($myRequests->isNotEmpty())
        <section class="rounded-2xl border border-zinc-100 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-bold text-zinc-900">My Chapter Requests</h2>
            <div class="mt-4 grid gap-3">
                @foreach($myRequests as $request)
                    <div class="flex flex-wrap items-center justify-between gap-3 rounded-xl border border-zinc-100 bg-zinc-50 px-4 py-3">
                        <div>
                            <p class="font-semibold text-zinc-900">{{ $request->name }}</p>
                            <p class="text-xs text-zinc-500">{{ $request->categoryLabel() }}</p>
                        </div>
                        <span class="rounded-full bg-white px-3 py-1 text-xs font-bold text-zinc-600">{{ str($request->status)->title() }}</span>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
</div>
