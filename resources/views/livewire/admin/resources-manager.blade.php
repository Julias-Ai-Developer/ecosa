<div class="grid gap-6 xl:grid-cols-[0.8fr_1.2fr]">
    <section class="rounded-2xl border border-zinc-100 bg-white p-6 shadow-sm">
        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Resources</p>
        <h1 class="mt-1 text-2xl font-bold text-zinc-900">Upload Resource</h1>

        @if($saved)
            <div class="mt-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">Resource saved.</div>
        @endif

        <form wire:submit.prevent="saveResource" class="mt-5 grid gap-4">
            <label>
                <span class="site-label">Title</span>
                <input type="text" wire:model.blur="title" class="site-input" placeholder="Document title">
                @error('title') <p class="site-error">{{ $message }}</p> @enderror
            </label>
            <div class="grid gap-4 sm:grid-cols-2">
                <label>
                    <span class="site-label">Category</span>
                    <select wire:model.blur="category" class="site-input">
                        <option value="documentation">Documentation</option>
                        <option value="external_document">External Document</option>
                        <option value="shortlist">Shortlist</option>
                        <option value="anthem">Anthem</option>
                        <option value="video">Video</option>
                        <option value="audio">Audio</option>
                        <option value="gallery">Gallery</option>
                    </select>
                </label>
                <label>
                    <span class="site-label">Media Type</span>
                    <select wire:model.blur="mediaType" class="site-input">
                        <option value="document">Document</option>
                        <option value="video">Video</option>
                        <option value="audio">Audio</option>
                        <option value="gallery">Gallery</option>
                        <option value="link">External Link</option>
                    </select>
                </label>
            </div>
            <label>
                <span class="site-label">Summary</span>
                <textarea wire:model.blur="summary" rows="4" class="site-input"></textarea>
            </label>
            <label>
                <span class="site-label">External URL</span>
                <input type="url" wire:model.blur="externalUrl" class="site-input" placeholder="https://...">
            </label>
            <label>
                <span class="site-label">Upload File</span>
                <input type="file" wire:model="file" class="site-input">
                @error('file') <p class="site-error">{{ $message }}</p> @enderror
            </label>
            <label>
                <span class="site-label">Sort Order</span>
                <input type="number" wire:model.blur="sortOrder" class="site-input" min="0">
            </label>
            <button type="submit" class="rounded-xl bg-ecosa-green px-5 py-3 text-sm font-bold text-white transition hover:bg-ecosa-green-deep">Publish Resource</button>
        </form>
    </section>

    <section class="rounded-2xl border border-zinc-100 bg-white shadow-sm">
        <div class="border-b border-zinc-100 px-6 py-4">
            <h2 class="text-lg font-bold text-zinc-900">Published Resources</h2>
        </div>
        <div class="divide-y divide-zinc-50">
            @foreach($resources as $resource)
                <div class="flex flex-col gap-3 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="font-semibold text-zinc-900">{{ $resource->title }}</p>
                        <p class="text-xs text-zinc-500">{{ str($resource->category)->replace('_', ' ')->title() }} · {{ str($resource->media_type)->title() }}</p>
                    </div>
                    <div class="flex gap-2">
                        <button type="button" wire:click="togglePublished({{ $resource->id }})" class="rounded-lg border border-zinc-200 px-3 py-2 text-xs font-semibold text-zinc-600">
                            {{ $resource->is_published ? 'Unpublish' : 'Publish' }}
                        </button>
                        <button type="button" wire:click="deleteResource({{ $resource->id }})" class="rounded-lg border border-rose-200 bg-rose-50 px-3 py-2 text-xs font-semibold text-rose-600">Delete</button>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
