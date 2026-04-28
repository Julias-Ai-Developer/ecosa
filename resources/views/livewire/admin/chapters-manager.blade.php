<div class="space-y-5">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Community</p>
            <h1 class="text-2xl font-bold text-zinc-900">Chapters Manager</h1>
            <p class="mt-1 text-sm text-zinc-500">Approve or reject chapter requests. Approved chapters appear on the public website.</p>
        </div>
        <input type="text" wire:model.blur="adminNotes" class="max-w-md rounded-lg border border-zinc-200 px-3 py-2 text-sm" placeholder="Optional admin note before approving/rejecting">
    </div>

    <div class="grid gap-4">
        @foreach($chapters as $chapter)
            <article class="rounded-2xl border border-zinc-100 bg-white p-6 shadow-sm">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                    <div class="max-w-3xl">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="rounded-full bg-ecosa-blue/8 px-3 py-1 text-xs font-bold text-ecosa-blue-deep">{{ $chapter->categoryLabel() }}</span>
                            <span class="rounded-full bg-zinc-100 px-3 py-1 text-xs font-bold text-zinc-600">{{ str($chapter->status)->title() }}</span>
                            <span class="rounded-full bg-ecosa-green/10 px-3 py-1 text-xs font-bold text-ecosa-green-deep">{{ $chapter->approved_memberships_count }} members</span>
                        </div>
                        <h2 class="mt-4 text-xl font-bold text-zinc-900">{{ $chapter->name }}</h2>
                        <p class="mt-2 text-sm leading-7 text-zinc-600">{{ $chapter->description }}</p>
                        @if($chapter->reason)
                            <p class="mt-3 rounded-xl bg-zinc-50 p-3 text-xs leading-6 text-zinc-500"><strong>Reason:</strong> {{ $chapter->reason }}</p>
                        @endif
                        <p class="mt-3 text-xs text-zinc-400">Requested by {{ $chapter->creator?->name ?: 'Unknown' }}</p>
                    </div>
                    <div class="flex shrink-0 flex-wrap gap-2">
                        @if($chapter->status !== 'approved')
                            <button type="button" wire:click="approveChapter({{ $chapter->id }})" class="rounded-lg bg-ecosa-green px-4 py-2 text-sm font-semibold text-white">Approve</button>
                        @endif
                        @if($chapter->status !== 'rejected')
                            <button type="button" wire:click="rejectChapter({{ $chapter->id }})" class="rounded-lg border border-rose-200 bg-rose-50 px-4 py-2 text-sm font-semibold text-rose-600">Reject</button>
                        @endif
                    </div>
                </div>
            </article>
        @endforeach
    </div>
</div>
