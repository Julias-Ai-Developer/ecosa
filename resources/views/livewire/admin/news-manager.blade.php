<div class="space-y-5" x-data="{ showForm: false }"
     x-effect="if ($wire.newsSaved) { showForm = false }">

    {{-- Toolbar --}}
    <div class="flex items-center justify-between gap-4">
        <div>
            <h2 class="text-base font-bold text-zinc-900">News &amp; Updates</h2>
            <p class="mt-0.5 text-xs text-zinc-500">Manage announcements published to the public website</p>
        </div>
        <button type="button" @click="$wire.newEntry().then(() => showForm = true)"
                class="inline-flex items-center gap-2 rounded-lg bg-ecosa-green px-4 py-2 text-sm font-semibold text-white transition hover:bg-ecosa-green-deep">
            <i class="fas fa-plus text-xs"></i> Publish Update
        </button>
    </div>

    {{-- News Table --}}
    <div class="overflow-hidden rounded-2xl border border-zinc-100 bg-white shadow-sm">
        @if($newsUpdates->isEmpty())
            <div class="px-6 py-16 text-center">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-zinc-100">
                    <i class="fas fa-newspaper text-2xl text-zinc-300"></i>
                </div>
                <p class="mt-3 text-sm text-zinc-500">No updates published yet.</p>
                <button type="button" @click="$wire.newEntry().then(() => showForm = true)"
                        class="mt-3 text-sm font-semibold text-ecosa-green hover:underline">
                    Publish your first update
                </button>
            </div>
        @else
            <table class="w-full text-left text-sm">
                <thead class="border-b border-zinc-100 bg-zinc-50">
                    <tr>
                        <th class="px-6 py-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Category</th>
                        <th class="px-6 py-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Title</th>
                        <th class="px-6 py-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Summary</th>
                        <th class="px-6 py-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Published</th>
                        <th class="px-6 py-3 text-right text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-50">
                    @foreach($newsUpdates as $update)
                    <tr class="transition hover:bg-zinc-50">
                        <td class="px-6 py-4">
                            <span class="rounded-full bg-ecosa-blue/8 px-2.5 py-1 text-[0.65rem] font-bold uppercase tracking-[0.12em] text-ecosa-blue">{{ $update->category }}</span>
                        </td>
                        <td class="px-6 py-4 max-w-[220px]">
                            <p class="truncate font-semibold text-zinc-900">{{ $update->title }}</p>
                        </td>
                        <td class="px-6 py-4 max-w-[300px]">
                            <p class="line-clamp-2 text-xs leading-5 text-zinc-500">{{ $update->summary }}</p>
                        </td>
                        <td class="px-6 py-4 text-xs text-zinc-400">
                            {{ $update->published_at ? $update->published_at->format('M j, Y') : '—' }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button type="button"
                                        @click="$wire.editNews({{ $update->id }}).then(() => showForm = true)"
                                        class="flex h-8 w-8 items-center justify-center rounded-lg border border-zinc-200 text-zinc-500 transition hover:border-ecosa-green hover:text-ecosa-green"
                                        title="Edit">
                                    <i class="fas fa-pen text-xs"></i>
                                </button>
                                <button type="button"
                                        wire:click="deleteNews({{ $update->id }})"
                                        wire:confirm="Delete '{{ addslashes($update->title) }}'? This cannot be undone."
                                        class="flex h-8 w-8 items-center justify-center rounded-lg border border-rose-100 bg-rose-50 text-rose-500 transition hover:bg-rose-100"
                                        title="Delete">
                                    <i class="fas fa-trash-can text-xs"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    {{-- Drawer Overlay --}}
    <div x-show="showForm" x-cloak
         x-transition:enter="transition duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-40 bg-black/40 backdrop-blur-sm"
         @click="showForm = false"></div>

    {{-- Drawer Panel --}}
    <div x-show="showForm" x-cloak
         x-transition:enter="transition duration-300 ease-out"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition duration-200 ease-in"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full"
         class="fixed inset-y-0 right-0 z-50 flex w-full max-w-lg flex-col bg-white shadow-2xl"
         @keydown.escape.window="showForm = false">

        {{-- Drawer Header --}}
        <div class="flex shrink-0 items-center justify-between border-b border-zinc-100 px-6 py-5">
            <div>
                <h3 class="text-base font-bold text-zinc-900">
                    {{ $editingId ? 'Edit Update' : 'Publish Update' }}
                </h3>
                <p class="mt-0.5 text-xs text-zinc-500">
                    {{ $editingId ? 'Make changes and save' : 'Add an announcement to the public website' }}
                </p>
            </div>
            <button type="button" @click="showForm = false"
                    class="flex h-8 w-8 items-center justify-center rounded-lg border border-zinc-200 text-zinc-400 transition hover:text-zinc-600">
                <i class="fas fa-xmark text-sm"></i>
            </button>
        </div>

        {{-- Drawer Body --}}
        <form wire:submit.prevent="saveNews" class="flex flex-1 flex-col overflow-hidden">
            <div class="flex-1 overflow-y-auto px-6 py-5 space-y-4">
                @if($newsSaved)
                    <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                        <i class="fas fa-check mr-1.5"></i> {{ $editingId ? 'Changes saved.' : 'Update published successfully.' }}
                    </div>
                @endif

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="mb-1.5 block text-xs font-semibold text-zinc-700">Category</label>
                        <input type="text" wire:model.blur="newsCategory"
                               class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:border-ecosa-green focus:outline-none focus:ring-1 focus:ring-ecosa-green/30"
                               placeholder="Association, Project, Event...">
                        @error('newsCategory') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="mb-1.5 block text-xs font-semibold text-zinc-700">
                            Feature Image
                            @if($editingId) <span class="font-normal text-zinc-400">(leave blank to keep existing)</span> @endif
                        </label>
                        <input type="file" wire:model="newsImage" accept="image/*"
                               class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm text-zinc-600 focus:border-ecosa-green focus:outline-none">
                        @error('newsImage') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-semibold text-zinc-700">Title</label>
                    <input type="text" wire:model.blur="newsTitle"
                           class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:border-ecosa-green focus:outline-none focus:ring-1 focus:ring-ecosa-green/30"
                           placeholder="Headline for the update">
                    @error('newsTitle') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-semibold text-zinc-700">Summary</label>
                    <textarea wire:model.blur="newsSummary" rows="3"
                              class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:border-ecosa-green focus:outline-none focus:ring-1 focus:ring-ecosa-green/30"
                              placeholder="Short summary used across cards and previews"></textarea>
                    @error('newsSummary') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-semibold text-zinc-700">
                        Body <span class="font-normal text-zinc-400">(optional)</span>
                    </label>
                    <textarea wire:model.blur="newsBody" rows="5"
                              class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:border-ecosa-green focus:outline-none focus:ring-1 focus:ring-ecosa-green/30"
                              placeholder="Extended editorial content"></textarea>
                </div>
            </div>

            {{-- Drawer Footer --}}
            <div class="shrink-0 flex justify-end gap-3 border-t border-zinc-100 px-6 py-4">
                <button type="button" @click="showForm = false"
                        class="rounded-lg border border-zinc-200 px-4 py-2 text-sm font-semibold text-zinc-600 transition hover:border-zinc-300">
                    Cancel
                </button>
                <button type="submit"
                        class="rounded-lg bg-ecosa-green px-5 py-2 text-sm font-semibold text-white transition hover:bg-ecosa-green-deep"
                        wire:loading.attr="disabled" wire:target="saveNews,newsImage">
                    <span wire:loading.remove wire:target="saveNews,newsImage">
                        {{ $editingId ? 'Save Changes' : 'Publish Update' }}
                    </span>
                    <span wire:loading wire:target="saveNews,newsImage">Saving...</span>
                </button>
            </div>
        </form>
    </div>

</div>
