<div class="mx-auto max-w-7xl">
    <section class="admin-panel p-6 sm:p-7">
        <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Website Messages</p>
                <h1 class="mt-3 font-display text-5xl font-semibold text-ecosa-blue-deep">Review inquiries from the public website.</h1>
                <p class="mt-4 max-w-3xl text-sm leading-7 text-zinc-600">
                    This view gives the admin team a cleaner way to review membership questions, partnership requests, insurance interest, and general public contact messages.
                </p>
            </div>
            <div class="grid gap-3 sm:grid-cols-2">
                <div class="rounded-[24px] bg-ecosa-green/[0.08] px-5 py-4">
                    <p class="text-xs font-bold uppercase tracking-[0.22em] text-zinc-500">New</p>
                    <p class="mt-2 font-display text-4xl font-semibold text-ecosa-blue-deep">{{ $newCount }}</p>
                </div>
                <div class="rounded-[24px] bg-ecosa-blue/[0.03] px-5 py-4">
                    <p class="text-xs font-bold uppercase tracking-[0.22em] text-zinc-500">Read</p>
                    <p class="mt-2 font-display text-4xl font-semibold text-ecosa-blue-deep">{{ $readCount }}</p>
                </div>
            </div>
        </div>

        <div class="mt-8 grid gap-5 lg:grid-cols-[1fr_220px]">
            <label>
                <span class="site-label">Search Messages</span>
                <input type="search" wire:model.live.debounce.300ms="search" class="site-input" placeholder="Search by name, email, type, or message">
            </label>
            <label>
                <span class="site-label">Status</span>
                <select wire:model.live="status" class="site-input">
                    <option value="all">All</option>
                    <option value="new">New</option>
                    <option value="read">Read</option>
                </select>
            </label>
        </div>
    </section>

    <section class="mt-6 admin-panel p-6 sm:p-7">
        <div class="grid gap-4">
            @forelse ($messages as $message)
                <article class="rounded-[26px] border border-ecosa-blue/8 bg-ecosa-blue/[0.03] p-6">
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                        <div>
                            <p class="font-semibold text-ecosa-blue-deep">{{ $message->name }}</p>
                            <p class="mt-1 text-xs text-zinc-500">{{ $message->email }} • {{ $message->inquiry_type }}</p>
                            @if ($message->phone)
                                <p class="mt-1 text-xs text-zinc-500">{{ $message->phone }}</p>
                            @endif
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="rounded-full bg-white px-3 py-1 text-[0.72rem] font-bold uppercase tracking-[0.2em] text-ecosa-green-deep">{{ $message->status }}</span>
                            @if ($message->status !== 'read')
                                <button type="button" wire:click="markRead({{ $message->id }})" class="site-btn-ghost px-5 py-2.5">Mark Read</button>
                            @endif
                        </div>
                    </div>
                    <p class="mt-5 text-sm leading-7 text-zinc-600">{{ $message->message }}</p>
                </article>
            @empty
                <p class="text-sm text-zinc-500">No messages match the current filters.</p>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $messages->links() }}
        </div>
    </section>
</div>
