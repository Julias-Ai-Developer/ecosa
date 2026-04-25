<div class="space-y-5" x-data="{ showForm: false }"
     x-effect="if ($wire.programSaved) { showForm = false }">

    {{-- Toolbar --}}
    <div class="flex items-center justify-between gap-4">
        <div>
            <h2 class="text-base font-bold text-zinc-900">Community Programs</h2>
            <p class="mt-0.5 text-xs text-zinc-500">Events, projects and insurance group entries on the public site</p>
        </div>
        <button type="button" @click="$wire.newEntry().then(() => showForm = true)"
                class="inline-flex items-center gap-2 rounded-lg bg-ecosa-green px-4 py-2 text-sm font-semibold text-white transition hover:bg-ecosa-green-deep">
            <i class="fas fa-plus text-xs"></i> Add Entry
        </button>
    </div>

    {{-- Programs Table --}}
    <div class="overflow-hidden rounded-2xl border border-zinc-100 bg-white shadow-sm">
        @if($programs->isEmpty())
            <div class="px-6 py-16 text-center">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-zinc-100">
                    <i class="fas fa-layer-group text-2xl text-zinc-300"></i>
                </div>
                <p class="mt-3 text-sm text-zinc-500">No community entries yet.</p>
                <button type="button" @click="$wire.newEntry().then(() => showForm = true)"
                        class="mt-3 text-sm font-semibold text-ecosa-green hover:underline">
                    Add your first entry
                </button>
            </div>
        @else
            <table class="w-full text-left text-sm">
                <thead class="border-b border-zinc-100 bg-zinc-50">
                    <tr>
                        <th class="px-6 py-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Type</th>
                        <th class="px-6 py-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Title</th>
                        <th class="px-6 py-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Location</th>
                        <th class="px-6 py-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Schedule</th>
                        <th class="px-6 py-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Status</th>
                        <th class="px-6 py-3 text-right text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-50">
                    @foreach($programs as $program)
                    <tr class="transition hover:bg-zinc-50">
                        <td class="px-6 py-4">
                            <span class="rounded-full bg-ecosa-blue/8 px-2.5 py-1 text-[0.65rem] font-bold uppercase tracking-[0.12em] text-ecosa-blue">{{ $program->typeLabel() }}</span>
                        </td>
                        <td class="px-6 py-4 max-w-[220px]">
                            <p class="truncate font-semibold text-zinc-900">{{ $program->title }}</p>
                            <p class="mt-0.5 truncate text-xs text-zinc-400">{{ str($program->summary)->limit(60) }}</p>
                        </td>
                        <td class="px-6 py-4 text-xs text-zinc-500">{{ $program->location ?: '—' }}</td>
                        <td class="px-6 py-4 text-xs text-zinc-400">{{ $program->starts_at ? $program->scheduleLabel() : '—' }}</td>
                        <td class="px-6 py-4">
                            <span class="rounded-full px-2.5 py-1 text-xs font-semibold
                                {{ $program->status === 'active' ? 'bg-emerald-50 text-emerald-700' : ($program->status === 'upcoming' ? 'bg-blue-50 text-blue-700' : 'bg-zinc-100 text-zinc-500') }}">
                                {{ ucfirst($program->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button type="button"
                                        @click="$wire.editProgram({{ $program->id }}).then(() => showForm = true)"
                                        class="flex h-8 w-8 items-center justify-center rounded-lg border border-zinc-200 text-zinc-500 transition hover:border-ecosa-green hover:text-ecosa-green"
                                        title="Edit">
                                    <i class="fas fa-pen text-xs"></i>
                                </button>
                                <button type="button"
                                        wire:click="deleteProgram({{ $program->id }})"
                                        wire:confirm="Delete '{{ addslashes($program->title) }}'? This cannot be undone."
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

        <div class="flex shrink-0 items-center justify-between border-b border-zinc-100 px-6 py-5">
            <div>
                <h3 class="text-base font-bold text-zinc-900">
                    {{ $editingId ? 'Edit Entry' : 'Add Community Entry' }}
                </h3>
                <p class="mt-0.5 text-xs text-zinc-500">
                    {{ $editingId ? 'Make changes and save' : 'Create a new event, project or insurance group listing' }}
                </p>
            </div>
            <button type="button" @click="showForm = false"
                    class="flex h-8 w-8 items-center justify-center rounded-lg border border-zinc-200 text-zinc-400 transition hover:text-zinc-600">
                <i class="fas fa-xmark text-sm"></i>
            </button>
        </div>

        <form wire:submit.prevent="saveProgram" class="flex flex-1 flex-col overflow-hidden">
            <div class="flex-1 overflow-y-auto px-6 py-5 space-y-4">
                @if($programSaved)
                    <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                        <i class="fas fa-check mr-1.5"></i> {{ $editingId ? 'Changes saved.' : 'Entry published successfully.' }}
                    </div>
                @endif

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="mb-1.5 block text-xs font-semibold text-zinc-700">Program Type</label>
                        <select wire:model.blur="programType"
                                class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:border-ecosa-green focus:outline-none focus:ring-1 focus:ring-ecosa-green/30">
                            <option value="event">Event</option>
                            <option value="project">Project</option>
                            <option value="insurance_group">Insurance Group</option>
                        </select>
                        @error('programType') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="mb-1.5 block text-xs font-semibold text-zinc-700">Status</label>
                        <select wire:model.blur="programStatus"
                                class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:border-ecosa-green focus:outline-none focus:ring-1 focus:ring-ecosa-green/30">
                            <option value="upcoming">Upcoming</option>
                            <option value="active">Active</option>
                            <option value="completed">Completed</option>
                        </select>
                        @error('programStatus') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-semibold text-zinc-700">Title</label>
                    <input type="text" wire:model.blur="programTitle"
                           class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:border-ecosa-green focus:outline-none focus:ring-1 focus:ring-ecosa-green/30"
                           placeholder="Headline for the entry">
                    @error('programTitle') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-semibold text-zinc-700">Summary</label>
                    <textarea wire:model.blur="programSummary" rows="3"
                              class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:border-ecosa-green focus:outline-none focus:ring-1 focus:ring-ecosa-green/30"
                              placeholder="Card summary and intro text"></textarea>
                    @error('programSummary') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-semibold text-zinc-700">Body <span class="font-normal text-zinc-400">(optional)</span></label>
                    <textarea wire:model.blur="programBody" rows="3"
                              class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:border-ecosa-green focus:outline-none focus:ring-1 focus:ring-ecosa-green/30"
                              placeholder="Extended public description"></textarea>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="mb-1.5 block text-xs font-semibold text-zinc-700">Location</label>
                        <input type="text" wire:model.blur="programLocation"
                               class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:border-ecosa-green focus:outline-none focus:ring-1 focus:ring-ecosa-green/30"
                               placeholder="Campus, regional, online...">
                        @error('programLocation') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="mb-1.5 block text-xs font-semibold text-zinc-700">
                            Feature Image
                            @if($editingId) <span class="font-normal text-zinc-400">(leave blank to keep existing)</span> @endif
                        </label>
                        <input type="file" wire:model="programImage" accept="image/*"
                               class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm text-zinc-600 focus:border-ecosa-green focus:outline-none">
                        @error('programImage') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid gap-4 grid-cols-2">
                    <div>
                        <label class="mb-1.5 block text-xs font-semibold text-zinc-700">Starts At</label>
                        <input type="date" wire:model.blur="programStartsAt"
                               class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:border-ecosa-green focus:outline-none">
                        @error('programStartsAt') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="mb-1.5 block text-xs font-semibold text-zinc-700">Ends At</label>
                        <input type="date" wire:model.blur="programEndsAt"
                               class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:border-ecosa-green focus:outline-none">
                    </div>
                </div>

                <div class="grid gap-4 grid-cols-2">
                    <div>
                        <label class="mb-1.5 block text-xs font-semibold text-zinc-700">CTA Label</label>
                        <input type="text" wire:model.blur="programCtaLabel"
                               class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:border-ecosa-green focus:outline-none"
                               placeholder="Learn more">
                    </div>
                    <div>
                        <label class="mb-1.5 block text-xs font-semibold text-zinc-700">Sort Order</label>
                        <input type="number" wire:model.blur="programSortOrder"
                               class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:border-ecosa-green focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-semibold text-zinc-700">CTA URL <span class="font-normal text-zinc-400">(optional)</span></label>
                    <input type="url" wire:model.blur="programCtaUrl"
                           class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:border-ecosa-green focus:outline-none"
                           placeholder="https://...">
                </div>
            </div>

            <div class="shrink-0 flex justify-end gap-3 border-t border-zinc-100 px-6 py-4">
                <button type="button" @click="showForm = false"
                        class="rounded-lg border border-zinc-200 px-4 py-2 text-sm font-semibold text-zinc-600 transition hover:border-zinc-300">
                    Cancel
                </button>
                <button type="submit"
                        class="rounded-lg bg-ecosa-green px-5 py-2 text-sm font-semibold text-white transition hover:bg-ecosa-green-deep"
                        wire:loading.attr="disabled" wire:target="saveProgram,programImage">
                    <span wire:loading.remove wire:target="saveProgram,programImage">
                        {{ $editingId ? 'Save Changes' : 'Publish Entry' }}
                    </span>
                    <span wire:loading wire:target="saveProgram,programImage">Saving...</span>
                </button>
            </div>
        </form>
    </div>

</div>
