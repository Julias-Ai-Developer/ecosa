<main>
    <x-site.page-hero
        eyebrow="Community"
        title="Professional Network"
        current="Professional Network"
        :image="asset('assets/images/school/Equatorial-College-School5.jpeg')"
    />

    <section class="site-section">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <x-site.section-heading
                eyebrow="Professional Directory"
                title="Find alumni by profession, experience, and skills."
                text="The Professional Network is separate from the Business Network because hiring, mentorship, and career collaboration need different profile details."
                align="center"
            />

            <div class="mt-10 grid gap-5 md:grid-cols-2">
                @foreach ($professionals as $profile)
                    <article class="site-card p-7">
                        <span class="site-chip">Professional</span>
                        <h2 class="mt-5 font-display text-3xl font-semibold text-ecosa-blue-deep">{{ $profile['name'] }}</h2>
                        <dl class="mt-5 grid gap-3 text-sm leading-7 text-zinc-600">
                            <div><dt class="inline font-bold text-ecosa-blue-deep">Profession:</dt> <dd class="inline">{{ $profile['profession'] }}</dd></div>
                            <div><dt class="inline font-bold text-ecosa-blue-deep">Experience:</dt> <dd class="inline">{{ $profile['experience'] }}</dd></div>
                            <div><dt class="inline font-bold text-ecosa-blue-deep">Skills:</dt> <dd class="inline">{{ $profile['skills'] }}</dd></div>
                        </dl>
                    </article>
                @endforeach
            </div>

            <div class="mt-10 text-center">
                <a href="{{ route('site.membership.register', ['occupation_type' => 'professional']) }}" class="site-btn-primary inline-flex">Create Professional Profile</a>
            </div>
        </div>
    </section>
</main>
