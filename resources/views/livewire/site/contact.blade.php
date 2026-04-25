<main>
    <x-site.page-hero
        eyebrow="Contact ECOSA"
        title="Contact"
        current="Contact"
        :image="asset('assets/images/school/aerialview.jpeg')"
    />

    <section class="site-section">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="text-center">
                <span class="site-chip">Direct Contact</span>
                <h2 class="site-heading mt-6">Tell us what you need and the ECOSA team will respond clearly.</h2>
                <p class="site-subheading mx-auto mt-4">
                    Membership support, project partnerships, welfare inquiries, and general association communication now sit inside one cleaner contact flow.
                </p>
            </div>

            <div class="mt-10 grid gap-5 md:grid-cols-3">
                <article class="site-card p-7 text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-ecosa-blue/8 text-2xl text-ecosa-blue">
                        <i class="fas fa-map-location-dot"></i>
                    </div>
                    <h3 class="mt-5 font-display text-2xl font-bold text-ecosa-blue-deep">Address Way</h3>
                    <p class="mt-4 text-sm leading-7 text-zinc-600">{{ $organization['location'] }}</p>
                    <p class="mt-2 text-sm leading-7 text-zinc-500">{{ $organization['postal_address'] }}</p>
                </article>

                <article class="site-card p-7 text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-ecosa-green/10 text-2xl text-ecosa-green-deep">
                        <i class="fas fa-address-book"></i>
                    </div>
                    <h3 class="mt-5 font-display text-2xl font-bold text-ecosa-blue-deep">Contact Info</h3>
                    <div class="mt-4 space-y-2 text-sm leading-7 text-zinc-600">
                        <p><span class="font-semibold text-ecosa-blue-deep">Mobile:</span> <a href="tel:{{ $organization['phones'][0] }}" class="hover:text-ecosa-blue">{{ $organization['phones'][0] }}</a></p>
                        <p><span class="font-semibold text-ecosa-blue-deep">Email:</span> <a href="mailto:{{ $organization['emails'][0] }}" class="hover:text-ecosa-blue">{{ $organization['emails'][0] }}</a></p>
                        <p><span class="font-semibold text-ecosa-blue-deep">Mail:</span> {{ $organization['website_label'] }}</p>
                    </div>
                </article>

                <article class="site-card p-7 text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-ecosa-gold/20 text-2xl text-amber-600">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="mt-5 font-display text-2xl font-bold text-ecosa-blue-deep">Work Time</h3>
                    <div class="mt-4 space-y-2 text-sm leading-7 text-zinc-600">
                        @foreach ($organization['office_hours'] as $hours)
                            <p>{{ $hours }}</p>
                        @endforeach
                    </div>
                </article>
            </div>

            <div class="mt-14 mx-auto max-w-4xl text-center">
                <h3 class="font-display text-3xl font-bold text-ecosa-blue-deep">Fill the form below so we can understand your need properly.</h3>
                <p class="mt-3 text-base leading-7 text-zinc-600">
                    This form is the quickest route for membership support, class coordination, projects, and insurance-group questions.
                </p>
            </div>

            <div class="mt-8 mx-auto max-w-4xl site-card p-6 sm:p-8">
                @if ($submitted)
                    <div class="site-success">
                        Your inquiry has been received. The ECOSA team will review it and respond using the email or phone details you provided.
                    </div>
                @endif

                <form wire:submit.prevent="sendMessage" class="grid gap-5 {{ $submitted ? 'mt-6' : '' }}">
                    <div class="grid gap-5 sm:grid-cols-2">
                        <label>
                            <span class="site-label">Full Name</span>
                            <input type="text" wire:model.blur="name" class="site-input" placeholder="Your name">
                            @error('name') <p class="site-error">{{ $message }}</p> @enderror
                        </label>
                        <label>
                            <span class="site-label">Email Address</span>
                            <input type="email" wire:model.blur="email" class="site-input" placeholder="you@example.com">
                            @error('email') <p class="site-error">{{ $message }}</p> @enderror
                        </label>
                        <label>
                            <span class="site-label">Phone Number</span>
                            <input type="tel" wire:model.blur="phone" class="site-input" placeholder="+256...">
                            @error('phone') <p class="site-error">{{ $message }}</p> @enderror
                        </label>
                        <label>
                            <span class="site-label">Inquiry Type</span>
                            <select wire:model.blur="inquiryType" class="site-input">
                                @foreach ($inquiryTypes as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                            @error('inquiryType') <p class="site-error">{{ $message }}</p> @enderror
                        </label>
                    </div>

                    <label>
                        <span class="site-label">Message</span>
                        <textarea wire:model.blur="message" rows="6" class="site-input" placeholder="Tell us what you need..."></textarea>
                        @error('message') <p class="site-error">{{ $message }}</p> @enderror
                    </label>

                    <div class="flex justify-center">
                        <button type="submit" class="site-btn-primary min-w-[14rem]" wire:loading.attr="disabled" wire:target="sendMessage">
                            <span wire:loading.remove wire:target="sendMessage">Send Inquiry</span>
                            <span wire:loading wire:target="sendMessage">Sending...</span>
                        </button>
                    </div>
                </form>
            </div>

            <div class="mt-12 site-card overflow-hidden">
                <iframe
                    src="{{ $organization['map_embed_url'] }}"
                    class="h-[360px] w-full border-0"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Equatorial College School map"
                ></iframe>
            </div>
        </div>
    </section>
</main>
