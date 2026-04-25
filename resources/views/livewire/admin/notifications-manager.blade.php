<div class="space-y-5" x-data="{ showForm: false }"
     x-effect="if ($wire.saved) { showForm = false }">

    {{-- Stat bar --}}
    <div class="grid gap-4 sm:grid-cols-3">
        <div class="overflow-hidden rounded-2xl border border-zinc-100 bg-white shadow-sm">
            <div class="bg-gradient-to-br from-ecosa-blue to-ecosa-blue-deep px-5 py-4 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[0.6rem] font-bold uppercase tracking-[0.22em] opacity-60">Total Sent</p>
                        <p class="mt-1 text-3xl font-bold">{{ $totalSent }}</p>
                    </div>
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/15">
                        <i class="fas fa-bell text-sm"></i>
                    </div>
                </div>
            </div>
            <p class="px-5 py-2.5 text-xs text-zinc-500">All notifications dispatched</p>
        </div>
        <div class="overflow-hidden rounded-2xl border border-zinc-100 bg-white shadow-sm">
            <div class="bg-gradient-to-br from-ecosa-green to-ecosa-green-deep px-5 py-4 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[0.6rem] font-bold uppercase tracking-[0.22em] opacity-60">Broadcasts</p>
                        <p class="mt-1 text-3xl font-bold">{{ $broadcastCount }}</p>
                    </div>
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/15">
                        <i class="fas fa-bullhorn text-sm"></i>
                    </div>
                </div>
            </div>
            <p class="px-5 py-2.5 text-xs text-zinc-500">Sent to all members</p>
        </div>
        <div class="overflow-hidden rounded-2xl border border-zinc-100 bg-white shadow-sm">
            <div class="bg-gradient-to-br from-violet-600 to-violet-700 px-5 py-4 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[0.6rem] font-bold uppercase tracking-[0.22em] opacity-60">Direct</p>
                        <p class="mt-1 text-3xl font-bold">{{ $specificCount }}</p>
                    </div>
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/15">
                        <i class="fas fa-user-tag text-sm"></i>
                    </div>
                </div>
            </div>
            <p class="px-5 py-2.5 text-xs text-zinc-500">Sent to specific members</p>
        </div>
    </div>

    {{-- Toolbar --}}
    <div class="flex items-center justify-between gap-4">
        <div>
            <h2 class="text-base font-bold text-zinc-900">Notification History</h2>
            <p class="mt-0.5 text-xs text-zinc-500">All messages sent to members appear here</p>
        </div>
        <button type="button" @click="showForm = true"
                class="inline-flex items-center gap-2 rounded-lg bg-ecosa-green px-4 py-2 text-sm font-semibold text-white transition hover:bg-ecosa-green-deep">
            <i class="fas fa-paper-plane text-xs"></i> Send Notification
        </button>
    </div>

    {{-- Notifications Table --}}
    <div class="overflow-hidden rounded-2xl border border-zinc-100 bg-white shadow-sm">
        @if($notifications->isEmpty())
            <div class="px-6 py-16 text-center">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-zinc-100">
                    <i class="fas fa-bell text-2xl text-zinc-300"></i>
                </div>
                <p class="mt-3 text-sm text-zinc-500">No notifications sent yet.</p>
                <button type="button" @click="showForm = true"
                        class="mt-3 text-sm font-semibold text-ecosa-green hover:underline">
                    Send your first notification
                </button>
            </div>
        @else
            <table class="w-full text-left text-sm">
                <thead class="border-b border-zinc-100 bg-zinc-50">
                    <tr>
                        <th class="px-6 py-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Audience</th>
                        <th class="px-6 py-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Title</th>
                        <th class="px-6 py-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Message</th>
                        <th class="px-6 py-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Sent</th>
                        <th class="px-6 py-3 text-right text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-50">
                    @foreach($notifications as $n)
                    <tr class="transition hover:bg-zinc-50">
                        <td class="px-6 py-4">
                            @if($n->target_type === 'all')
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-ecosa-green/10 px-2.5 py-1 text-[0.65rem] font-semibold text-ecosa-green-deep">
                                    <i class="fas fa-users text-[0.55rem]"></i> All Members
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-violet-50 px-2.5 py-1 text-[0.65rem] font-semibold text-violet-700">
                                    <i class="fas fa-user text-[0.55rem]"></i>
                                    {{ $n->member?->full_name ?? 'Member' }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 max-w-[200px]">
                            <p class="truncate font-semibold text-zinc-900">{{ $n->title }}</p>
                        </td>
                        <td class="px-6 py-4 max-w-[300px]">
                            <p class="line-clamp-2 text-xs leading-5 text-zinc-500">{{ $n->body }}</p>
                        </td>
                        <td class="px-6 py-4 text-xs text-zinc-400 whitespace-nowrap">
                            {{ $n->created_at->diffForHumans() }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button type="button"
                                    wire:click="deleteNotification({{ $n->id }})"
                                    wire:confirm="Delete this notification? Members who haven't read it yet will no longer see it."
                                    class="ml-auto flex h-8 w-8 items-center justify-center rounded-lg border border-rose-100 bg-rose-50 text-rose-500 transition hover:bg-rose-100"
                                    title="Delete">
                                <i class="fas fa-trash-can text-xs"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="border-t border-zinc-100 px-6 py-4">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>

    {{-- Drawer Overlay --}}
    <div x-show="showForm" x-cloak
         x-transition:enter="transition duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-40 bg-black/40 backdrop-blur-sm"
         @click="showForm = false"></div>

    {{-- Compose Drawer --}}
    <div x-show="showForm" x-cloak
         x-transition:enter="transition duration-300 ease-out" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
         x-transition:leave="transition duration-200 ease-in" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
         class="fixed inset-y-0 right-0 z-50 flex w-full max-w-lg flex-col bg-white shadow-2xl"
         @keydown.escape.window="showForm = false">

        <div class="flex shrink-0 items-center justify-between border-b border-zinc-100 px-6 py-5">
            <div>
                <h3 class="text-base font-bold text-zinc-900">Send Notification</h3>
                <p class="mt-0.5 text-xs text-zinc-500">Compose a message for members to see in their portal</p>
            </div>
            <button type="button" @click="showForm = false"
                    class="flex h-8 w-8 items-center justify-center rounded-lg border border-zinc-200 text-zinc-400 transition hover:text-zinc-600">
                <i class="fas fa-xmark text-sm"></i>
            </button>
        </div>

        <form wire:submit.prevent="send" class="flex flex-1 flex-col overflow-hidden">
            <div class="flex-1 overflow-y-auto px-6 py-5 space-y-4">
                @if($saved)
                    <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                        <i class="fas fa-check mr-1.5"></i> Notification sent successfully.
                    </div>
                @endif

                {{-- Audience --}}
                <div>
                    <label class="mb-2 block text-xs font-semibold text-zinc-700">Send To</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="flex cursor-pointer items-start gap-3 rounded-xl border p-3.5 transition
                                      {{ $targetType === 'all' ? 'border-ecosa-green bg-ecosa-green/5' : 'border-zinc-200 hover:border-zinc-300' }}">
                            <input type="radio" wire:model.live="targetType" value="all" class="mt-0.5 accent-ecosa-green">
                            <div>
                                <p class="text-sm font-semibold text-zinc-900">All Members</p>
                                <p class="text-xs text-zinc-400">Broadcast to everyone</p>
                            </div>
                        </label>
                        <label class="flex cursor-pointer items-start gap-3 rounded-xl border p-3.5 transition
                                      {{ $targetType === 'specific' ? 'border-ecosa-green bg-ecosa-green/5' : 'border-zinc-200 hover:border-zinc-300' }}">
                            <input type="radio" wire:model.live="targetType" value="specific" class="mt-0.5 accent-ecosa-green">
                            <div>
                                <p class="text-sm font-semibold text-zinc-900">Specific Member</p>
                                <p class="text-xs text-zinc-400">Target one person</p>
                            </div>
                        </label>
                    </div>
                    @error('targetType') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                </div>

                {{-- Member picker --}}
                @if($targetType === 'specific')
                <div>
                    <label class="mb-1.5 block text-xs font-semibold text-zinc-700">Select Member</label>
                    <select wire:model="targetMemberId"
                            class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:border-ecosa-green focus:outline-none focus:ring-1 focus:ring-ecosa-green/30">
                        <option value="">— Choose a member —</option>
                        @foreach($members as $m)
                            <option value="{{ $m->id }}">{{ $m->full_name }} ({{ $m->membership_number }})</option>
                        @endforeach
                    </select>
                    @error('targetMemberId') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                </div>
                @endif

                {{-- Title --}}
                <div>
                    <label class="mb-1.5 block text-xs font-semibold text-zinc-700">Title</label>
                    <input type="text" wire:model.blur="title"
                           class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:border-ecosa-green focus:outline-none focus:ring-1 focus:ring-ecosa-green/30"
                           placeholder="e.g. Important update from ECOSA">
                    @error('title') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                </div>

                {{-- Body --}}
                <div>
                    <label class="mb-1.5 block text-xs font-semibold text-zinc-700">Message</label>
                    <textarea wire:model.blur="body" rows="6"
                              class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:border-ecosa-green focus:outline-none focus:ring-1 focus:ring-ecosa-green/30"
                              placeholder="Write your message here..."></textarea>
                    @error('body') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                </div>

                <div class="rounded-xl border border-amber-100 bg-amber-50 px-4 py-3 text-xs text-amber-700">
                    <i class="fas fa-triangle-exclamation mr-1.5"></i>
                    Members will see this notification the next time they log in to their portal.
                </div>
            </div>

            <div class="shrink-0 flex justify-end gap-3 border-t border-zinc-100 px-6 py-4">
                <button type="button" @click="showForm = false"
                        class="rounded-lg border border-zinc-200 px-4 py-2 text-sm font-semibold text-zinc-600 transition hover:border-zinc-300">
                    Cancel
                </button>
                <button type="submit"
                        class="inline-flex items-center gap-2 rounded-lg bg-ecosa-green px-5 py-2 text-sm font-semibold text-white transition hover:bg-ecosa-green-deep"
                        wire:loading.attr="disabled" wire:target="send">
                    <span wire:loading.remove wire:target="send"><i class="fas fa-paper-plane text-xs"></i> Send</span>
                    <span wire:loading wire:target="send">Sending...</span>
                </button>
            </div>
        </form>
    </div>

</div>
