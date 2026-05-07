<main>
    <x-site.page-hero
        eyebrow="Community"
        title="Business Network"
        current="Business Network"
        :image="asset('assets/images/school/aerialview.jpeg')"
    />

    <section class="site-section">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="site-grid-2 items-start">
                <div>
                    <x-site.section-heading
                        eyebrow="Alumni Business Directory"
                        title="Alumni businesses should be visible and easy to support."
                        text="The Business Network is for member-owned and member-operated businesses, products, services, and referral opportunities."
                    />
                    <a href="{{ route('site.membership.register', ['occupation_type' => 'business']) }}" class="site-btn-primary mt-7 inline-flex">Add Your Business</a>
                </div>

                <div class="grid gap-4">
                    @foreach ($businesses as $business)
                        <article class="site-card p-6">
                            <span class="site-chip">Business</span>
                            <h2 class="mt-4 font-display text-2xl font-semibold text-ecosa-blue-deep">{{ $business['name'] }}</h2>
                            <p class="mt-3 text-sm leading-7 text-zinc-600">{{ $business['services'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</main>
