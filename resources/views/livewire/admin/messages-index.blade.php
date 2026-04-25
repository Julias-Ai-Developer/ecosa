<div class="space-y-5" x-data="{ viewing: null }">

    {{-- Stat bar --}}
    <div class="grid gap-4 sm:grid-cols-2">
        <div class="overflow-hidden rounded-2xl border border-zinc-100 bg-white shadow-sm">
            <div class="bg-gradient-to-br from-rose-500 to-rose-600 px-5 py-4 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[0.6rem] font-bold uppercase tracking-[0.22em] opacity-60">Unread</p>
                        <p class="mt-1 text-3xl font-bold">{{ $newCount }}</p>
                    </div>
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/15">
                        <i class="fas fa-envelope text-sm"></i>
                    </div>
                </div>
            </div>
            <p class="px-5 py-2.5 text-xs text-zinc-500">Awaiting review</p>
        </div>
        <div class="overflow-hidden rounded-2xl border border-zinc-100 bg-white shadow-sm">
            <div class="bg-gradient-to-br from-zinc-500 to-zinc-600 px-5 py-4 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[0.6rem] font-bold uppercase tracking-[0.22em] opacity-60">Read</p>
                        <p class="mt-1 text-3xl font-bold">{{ $readCount }}</p>
                    </div>
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/15">
                        <i class="fas fa-envelope-open text-sm"></i>
                    </div>
                </div>
            </div>
            <p class="px-5 py-2.5 text-xs text-zinc-500">Already reviewed</p>
        </div>
    </div>

    {{-- Table card --}}
    <div class="overflow-hidden rounded-2xl border border-zinc-100 bg-white shadow-sm">
        <div class="border-b border-zinc-100 px-6 py-4">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                <div class="flex-1">
                    <h2 class="text-base font-bold text-zinc-900">Contact Messages</h2>
                    <p class="mt-0.5 text-xs text-zinc-500">Click a row to read the full message</p>
                </div>
                <div class="flex gap-3">
                    <div class="relative flex-1 sm:flex-none">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-xs text-zinc-400"></i>
                        <input type="search" wire:model.live.debounce.300ms="search"
                               placeholder="Search messages..."
                               class="w-full rounded-lg border border-zinc-200 bg-zinc-50 py-2 pl-8 pr-3 text-sm text-zinc-900 placeholder-zinc-400 focus:border-ecosa-green focus:bg-white focus:outline-none focus:ring-1 focus:ring-ecosa-green/30 sm:w-56">
                    </div>
                    <select wire:model.live="status"
                            class="rounded-lg border border-zinc-200 bg-zinc-50 px-3 py-2 text-sm text-zinc-700 focus:border-ecosa-green focus:outline-none">
                        <option value="all">All</option>
                        <option value="new">Unread</option>
                        <option value="read">Read</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-zinc-100 bg-zinc-50">
                    <tr>
                        <th class="px-6 py-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Sender</th>
                        <th class="px-6 py-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Type</th>
                        <th class="px-6 py-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Preview</th>
                        <th class="px-6 py-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Status</th>
                        <th class="px-6 py-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Received</th>
                        <th class="px-6 py-3 text-right text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-50">
                    @forelse($messages as $message)
                    <tr class="cursor-pointer transition hover:bg-zinc-50"
                        @click="viewing = {{ $message->id }}">
                        <td class="px-6 py-4">
                            <p class="font-semibold text-zinc-900">{{ $message->name }}</p>
                            <p class="text-xs text-zinc-400">{{ $message->email }}</p>
                            @if($message->phone)
                                <p class="text-xs text-zinc-400">{{ $message->phone }}</p>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="rounded-full bg-ecosa-blue/8 px-2.5 py-1 text-[0.65rem] font-semibold text-ecosa-blue">
                                {{ $message->inquiry_type }}
                            </span>
                        </td>
                        <td class="px-6 py-4 max-w-[280px]">
                            <p class="line-clamp-2 text-xs leading-5 text-zinc-500">{{ $message->message }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="rounded-full px-2.5 py-1 text-xs font-semibold
                                {{ $message->status === 'new' ? 'bg-rose-50 text-rose-600' : 'bg-zinc-100 text-zinc-500' }}">
                                {{ $message->status === 'new' ? 'Unread' : 'Read' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-xs text-zinc-400 whitespace-nowrap">
                            {{ $message->created_at->diffForHumans() }}
                        </td>
                        <td class="px-6 py-4 text-right" @click.stop>
                            @if($message->status !== 'read')
                                <button type="button" wire:click="markRead({{ $message->id }})"
                                        class="rounded-lg border border-zinc-200 px-3 py-1.5 text-xs font-semibold text-zinc-600 transition hover:border-ecosa-green hover:text-ecosa-green">
                                    Mark Read
                                </button>
                            @else
                                <span class="text-xs text-zinc-300">—</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-14 text-center">
                            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-zinc-100">
                                <i class="fas fa-envelope text-xl text-zinc-300"></i>
                            </div>
                            <p class="mt-3 text-sm text-zinc-500">No messages match the current filters.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-zinc-100 px-6 py-4">
            {{ $messages->links() }}
        </div>
    </div>

    {{-- Drawer Overlay --}}
    <div x-show="viewing !== null" x-cloak
         x-transition:enter="transition duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-40 bg-black/40 backdrop-blur-sm"
         @click="viewing = null"></div>

    {{-- Drawer Panel --}}
    <div x-show="viewing !== null" x-cloak
         x-transition:enter="transition duration-300 ease-out"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition duration-200 ease-in"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full"
         class="fixed inset-y-0 right-0 z-50 flex w-full max-w-md flex-col bg-white shadow-2xl"
         @keydown.escape.window="viewing = null">

        @foreach($messages as $message)
        <template x-if="viewing === {{ $message->id }}">
            <div class="flex h-full flex-col">
                {{-- Drawer Header --}}
                <div class="flex shrink-0 items-start justify-between border-b border-zinc-100 px-6 py-5">
                    <div>
                        <p class="font-bold text-zinc-900">{{ $message->name }}</p>
                        <p class="mt-0.5 text-xs text-zinc-400">{{ $message->email }}{{ $message->phone ? ' · ' . $message->phone : '' }}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="rounded-full px-2.5 py-1 text-xs font-semibold
                            {{ $message->status === 'new' ? 'bg-rose-50 text-rose-600' : 'bg-zinc-100 text-zinc-500' }}">
                            {{ $message->status === 'new' ? 'Unread' : 'Read' }}
                        </span>
                        <button @click="viewing = null"
                                class="flex h-8 w-8 items-center justify-center rounded-lg border border-zinc-200 text-zinc-400 transition hover:text-zinc-600">
                            <i class="fas fa-xmark text-sm"></i>
                        </button>
                    </div>
                </div>

                {{-- Drawer Body --}}
                <div class="flex-1 overflow-y-auto px-6 py-5">
                    <div class="mb-5 flex items-center gap-2">
                        <span class="rounded-full bg-ecosa-blue/8 px-2.5 py-1 text-[0.65rem] font-semibold text-ecosa-blue">
                            {{ $message->inquiry_type }}
                        </span>
                        <span class="text-xs text-zinc-400">{{ $message->created_at->format('M j, Y · g:i A') }}</span>
                    </div>
                    <p class="text-sm leading-7 text-zinc-700">{{ $message->message }}</p>
                </div>

                {{-- Drawer Footer --}}
                <div class="shrink-0 flex justify-end gap-3 border-t border-zinc-100 px-6 py-4">
                    <button @click="viewing = null"
                            class="rounded-lg border border-zinc-200 px-4 py-2 text-sm font-semibold text-zinc-600 transition hover:border-zinc-300">
                        Close
                    </button>
                    @if($message->status !== 'read')
                        <button type="button"
                                wire:click="markRead({{ $message->id }})"
                                @click="viewing = null"
                                class="rounded-lg bg-ecosa-green px-4 py-2 text-sm font-semibold text-white transition hover:bg-ecosa-green-deep">
                            <i class="fas fa-check mr-1.5 text-xs"></i> Mark as Read
                        </button>
                    @endif
                </div>
            </div>
        </template>
        @endforeach
    </div>

</div>
