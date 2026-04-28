<main>
    <x-site.page-hero
        eyebrow="Resources"
        title="Resources"
        current="Resources"
        :image="asset('assets/images/school/Equatorial-College-School5.jpeg')"
    />

    <section class="site-section">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <x-site.section-heading
                eyebrow="Documents & Media"
                title="Documentation, external documents, shortlists, anthems, videos, audio, and gallery resources."
                text="Admins can publish resource files or external links for members and the public."
                align="center"
            />

            <div class="mx-auto mt-8 max-w-sm">
                <select wire:model.live="category" class="site-input">
                    <option value="all">All resources</option>
                    <option value="documentation">Documentation</option>
                    <option value="external_document">External Documents</option>
                    <option value="shortlist">Shortlists</option>
                    <option value="anthem">Anthems</option>
                    <option value="video">Videos</option>
                    <option value="audio">Audio</option>
                    <option value="gallery">Gallery</option>
                </select>
            </div>

            <div class="mt-10 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                @forelse ($resources as $resource)
                    <article class="site-card flex flex-col p-7">
                        <span class="site-chip self-start">{{ str($resource->category)->replace('_', ' ')->title() }}</span>
                        <h2 class="mt-5 font-display text-2xl font-semibold text-ecosa-blue-deep">{{ $resource->title }}</h2>
                        <p class="mt-3 flex-1 text-sm leading-7 text-zinc-600">{{ $resource->summary ?: 'Open this resource for more information.' }}</p>
                        @if($resource->linkUrl())
                            <a href="{{ $resource->linkUrl() }}" target="_blank" rel="noopener noreferrer" class="site-btn-primary mt-6">Open Resource</a>
                        @endif
                    </article>
                @empty
                    @foreach ($fallbackResources as $resource)
                        <article class="site-card p-7">
                            <span class="site-chip">Coming Soon</span>
                            <h2 class="mt-5 font-display text-2xl font-semibold text-ecosa-blue-deep">{{ $resource }}</h2>
                            <p class="mt-3 text-sm leading-7 text-zinc-600">This resource category is ready for admin uploads.</p>
                        </article>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>
</main>
