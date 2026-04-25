<div class="mx-auto max-w-7xl space-y-6">
    @if ($membership)

        {{-- Page Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Member Portal</p>
                <h1 class="mt-2 font-display text-4xl font-bold text-ecosa-blue-deep">{{ $membership->full_name }}</h1>
                <p class="mt-1 text-sm leading-6 text-zinc-500">Membership ID <span class="font-mono font-bold text-ecosa-blue">{{ $membership->membership_number }}</span> &mdash; manage your record and payment below.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                @if ($user->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="site-btn-primary">
                        <i class="fas fa-shield-halved text-xs"></i> Admin System
                    </a>
                @endif
                <a href="{{ route('site.membership') }}" class="site-btn-ghost">
                    <i class="fas fa-globe text-xs"></i> Membership Hub
                </a>
            </div>
        </div>

        {{-- Quick Stat Cards --}}
        <section class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
            <article class="admin-panel p-6">
                <div class="flex items-start justify-between gap-4">
                    <span class="text-xs font-bold uppercase tracking-[0.22em] text-zinc-400">Membership ID</span>
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-ecosa-blue/10 text-ecosa-blue">
                        <i class="fas fa-id-card text-sm"></i>
                    </div>
                </div>
                <p class="mt-5 font-mono text-3xl font-bold text-ecosa-blue-deep">{{ $membership->membership_number }}</p>
                <p class="mt-2 text-xs text-zinc-400">Your ECOSA alumni identifier</p>
            </article>

            <article class="admin-panel p-6">
                <div class="flex items-start justify-between gap-4">
                    <span class="text-xs font-bold uppercase tracking-[0.22em] text-zinc-400">Membership Status</span>
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-ecosa-green/10 text-ecosa-green-deep">
                        <i class="fas fa-user-check text-sm"></i>
                    </div>
                </div>
                <p class="mt-5 font-display text-2xl font-bold text-ecosa-blue-deep">{{ $membership->membershipStatusLabel() }}</p>
                <p class="mt-2 text-xs text-zinc-400">Current portal standing</p>
            </article>

            <article class="admin-panel p-6">
                <div class="flex items-start justify-between gap-4">
                    <span class="text-xs font-bold uppercase tracking-[0.22em] text-zinc-400">Payment Status</span>
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-ecosa-gold/20 text-yellow-700">
                        <i class="fas fa-credit-card text-sm"></i>
                    </div>
                </div>
                <p class="mt-5 font-display text-2xl font-bold text-ecosa-blue-deep">{{ $membership->paymentStatusLabel() }}</p>
                <p class="mt-2 text-xs text-zinc-400">Registration fee verification</p>
            </article>

            <article class="admin-panel p-6">
                <div class="flex items-start justify-between gap-4">
                    <span class="text-xs font-bold uppercase tracking-[0.22em] text-zinc-400">Member Since</span>
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-ecosa-burgundy/10 text-ecosa-burgundy">
                        <i class="fas fa-calendar text-sm"></i>
                    </div>
                </div>
                <p class="mt-5 font-display text-2xl font-bold text-ecosa-blue-deep">{{ $membership->created_at->format('M Y') }}</p>
                <p class="mt-2 text-xs text-zinc-400">Joined {{ $membership->created_at->diffForHumans() }}</p>
            </article>
        </section>

        {{-- Profile + Payment Details --}}
        <section class="grid gap-6 xl:grid-cols-[1.05fr_0.95fr]">

            {{-- Profile Details --}}
            <div class="admin-panel overflow-hidden">
                <div class="border-b border-ecosa-blue/8 bg-ecosa-mist/60 px-6 py-4">
                    <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Personal Information</p>
                    <h3 class="mt-0.5 font-display text-xl font-semibold text-ecosa-blue-deep">Profile Details</h3>
                </div>
                <div class="grid gap-4 p-6 sm:grid-cols-2">
                    <div class="rounded-[20px] bg-ecosa-blue/[0.03] p-5">
                        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Email</p>
                        <p class="mt-3 text-sm font-semibold text-ecosa-blue-deep">{{ $membership->email }}</p>
                    </div>
                    <div class="rounded-[20px] bg-ecosa-blue/[0.03] p-5">
                        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Phone</p>
                        <p class="mt-3 text-sm font-semibold text-ecosa-blue-deep">{{ $membership->phone ?: 'Not provided' }}</p>
                    </div>
                    <div class="rounded-[20px] bg-ecosa-blue/[0.03] p-5">
                        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Completion Year</p>
                        <p class="mt-3 text-sm font-semibold text-ecosa-blue-deep">{{ $membership->completion_year ?: 'Not provided' }}</p>
                    </div>
                    <div class="rounded-[20px] bg-ecosa-blue/[0.03] p-5">
                        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Marital Status</p>
                        <p class="mt-3 text-sm font-semibold text-ecosa-blue-deep">{{ str($membership->marital_status ?: 'Not recorded')->replace('_', ' ')->title() }}</p>
                    </div>
                    <div class="rounded-[20px] bg-ecosa-blue/[0.03] p-5 sm:col-span-2">
                        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Address</p>
                        <p class="mt-3 text-sm font-semibold text-ecosa-blue-deep">{{ $membership->current_address ?: 'Not provided' }}</p>
                    </div>
                </div>
            </div>

            {{-- Payment Details --}}
            <div class="admin-panel overflow-hidden">
                <div class="border-b border-ecosa-blue/8 bg-ecosa-mist/60 px-6 py-4">
                    <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Financial Record</p>
                    <h3 class="mt-0.5 font-display text-xl font-semibold text-ecosa-blue-deep">Payment Details</h3>
                </div>
                <div class="grid gap-4 p-6">
                    <div class="rounded-[20px] bg-ecosa-green/[0.08] p-5">
                        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-500">Payment Method</p>
                        <p class="mt-3 font-display text-2xl font-semibold text-ecosa-blue-deep">{{ $membership->paymentMethodLabel() }}</p>
                    </div>
                    <div class="rounded-[20px] bg-ecosa-blue/[0.03] p-5">
                        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-500">Payment Reference</p>
                        <p class="mt-3 text-sm font-semibold text-ecosa-blue-deep">{{ $membership->payment_reference ?: 'Not recorded' }}</p>
                    </div>
                    <div class="rounded-[20px] bg-ecosa-blue/[0.03] p-5">
                        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-500">Payment Phone</p>
                        <p class="mt-3 text-sm font-semibold text-ecosa-blue-deep">{{ $membership->payment_phone ?: 'Not recorded' }}</p>
                    </div>
                    <div class="rounded-[20px] bg-ecosa-blue/[0.03] p-5">
                        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-500">Paid At</p>
                        <p class="mt-3 text-sm font-semibold text-ecosa-blue-deep">{{ $membership->paid_at?->format('M j, Y g:i A') ?: 'Awaiting verification' }}</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Professional Details + Portal Actions --}}
        <section class="grid gap-6 xl:grid-cols-[0.9fr_1.1fr]">

            {{-- Professional Details --}}
            <div class="admin-panel overflow-hidden">
                <div class="border-b border-ecosa-blue/8 bg-ecosa-mist/60 px-6 py-4">
                    <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Career & Business</p>
                    <h3 class="mt-0.5 font-display text-xl font-semibold text-ecosa-blue-deep">Professional Details</h3>
                </div>
                <div class="grid gap-4 p-6">
                    <div class="rounded-[20px] bg-ecosa-blue/[0.03] p-5">
                        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-500">Professional Category</p>
                        <p class="mt-3 text-sm font-semibold text-ecosa-blue-deep">{{ $membership->occupationTypeLabel() }}</p>
                    </div>
                    <div class="rounded-[20px] bg-ecosa-blue/[0.03] p-5">
                        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-500">Profession / Job Title</p>
                        <p class="mt-3 text-sm font-semibold text-ecosa-blue-deep">{{ $membership->occupation_title ?: 'Not recorded' }}</p>
                    </div>
                    <div class="rounded-[20px] bg-ecosa-blue/[0.03] p-5">
                        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-500">Business Name</p>
                        <p class="mt-3 text-sm font-semibold text-ecosa-blue-deep">{{ $membership->business_name ?: 'Not recorded' }}</p>
                    </div>
                    <div class="rounded-[20px] bg-ecosa-blue/[0.03] p-5">
                        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-500">Nature of Business</p>
                        <p class="mt-3 text-sm font-semibold text-ecosa-blue-deep">{{ $membership->business_nature ?: 'Not recorded' }}</p>
                    </div>
                </div>
            </div>

            {{-- Portal Actions --}}
            <div class="admin-panel overflow-hidden">
                <div class="border-b border-ecosa-blue/8 bg-ecosa-mist/60 px-6 py-4">
                    <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Portal Actions</p>
                    <h3 class="mt-0.5 font-display text-xl font-semibold text-ecosa-blue-deep">Keep your record current.</h3>
                </div>
                <div class="p-6">
                    @if ($paymentRecorded)
                        <div class="site-success mb-6">
                            A new payment reference has been recorded. The admin team will verify it and update your status.
                        </div>
                    @endif

                    @if ($membership->payment_status !== 'paid')
                        <p class="mb-5 text-sm leading-6 text-zinc-600">Submit your payment reference below and the admin team will verify and activate your membership.</p>
                        <form wire:submit.prevent="recordPayment" class="grid gap-5 sm:grid-cols-2">
                            <label>
                                <span class="site-label">Payment Method</span>
                                <select wire:model.blur="paymentMethod" class="site-input">
                                    @foreach ($paymentOptions as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('paymentMethod') <p class="site-error">{{ $message }}</p> @enderror
                            </label>
                            <label>
                                <span class="site-label">Payment Reference</span>
                                <input type="text" wire:model.blur="paymentReference" class="site-input" placeholder="Transaction or receipt reference">
                                @error('paymentReference') <p class="site-error">{{ $message }}</p> @enderror
                            </label>
                            <div class="sm:col-span-2">
                                <button type="submit" class="site-btn-primary">
                                    <i class="fas fa-check text-xs"></i> Record Payment Reference
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="rounded-[24px] bg-ecosa-green/[0.08] p-6">
                            <div class="flex items-start gap-4">
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-ecosa-green/15 text-ecosa-green-deep">
                                    <i class="fas fa-circle-check text-lg"></i>
                                </div>
                                <div>
                                    <p class="font-display text-2xl font-semibold text-ecosa-blue-deep">Payment verified.</p>
                                    <p class="mt-2 text-sm leading-6 text-zinc-600">Your registration fee has been confirmed. No further action is required unless the admin team asks you to update your records.</p>
                                </div>
                            </div>
                        </div>

                        {{-- Quick Links --}}
                        <div class="mt-6 space-y-3">
                            <p class="text-xs font-bold uppercase tracking-[0.22em] text-zinc-400">Quick Links</p>
                            @foreach ([
                                ['href' => route('site.membership'),  'icon' => 'fa-users',        'label' => 'Membership Hub',   'sub' => 'View membership information'],
                                ['href' => route('site.community'),   'icon' => 'fa-layer-group',  'label' => 'Community',        'sub' => 'Programs & projects'],
                                ['href' => route('site.contact'),     'icon' => 'fa-envelope',     'label' => 'Contact Us',       'sub' => 'Reach the ECOSA team'],
                            ] as $link)
                                <a href="{{ $link['href'] }}" class="flex items-center gap-3 rounded-[18px] border border-ecosa-blue/8 bg-ecosa-blue/[0.02] p-4 transition hover:border-ecosa-blue/20 hover:bg-ecosa-mist/60">
                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-ecosa-blue/10 text-ecosa-blue">
                                        <i class="fas {{ $link['icon'] }} text-sm"></i>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-bold text-ecosa-blue-deep">{{ $link['label'] }}</p>
                                        <p class="text-xs text-zinc-400">{{ $link['sub'] }}</p>
                                    </div>
                                    <i class="fas fa-chevron-right text-xs text-zinc-300"></i>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </section>

        {{-- Notifications --}}
        @if($notifications->isNotEmpty())
        <section class="admin-panel overflow-hidden">
            <div class="border-b border-ecosa-blue/8 bg-ecosa-mist/60 px-6 py-4">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Inbox</p>
                        <h3 class="mt-0.5 font-display text-xl font-semibold text-ecosa-blue-deep">Notifications from ECOSA</h3>
                    </div>
                    <span class="flex h-7 min-w-[28px] items-center justify-center rounded-full bg-ecosa-green px-2 text-xs font-bold text-white">{{ $notifications->count() }}</span>
                </div>
            </div>
            <div class="divide-y divide-zinc-50 px-6">
                @foreach($notifications as $note)
                <div class="py-4">
                    <div class="flex items-start gap-3">
                        <div class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-ecosa-blue/8 text-ecosa-blue">
                            <i class="fas fa-bell text-xs"></i>
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-start justify-between gap-3">
                                <p class="text-sm font-bold text-ecosa-blue-deep">{{ $note->title }}</p>
                                <span class="shrink-0 text-xs text-zinc-400">{{ $note->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="mt-1 text-sm leading-6 text-zinc-600">{{ $note->body }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

    @else

        {{-- No Membership State --}}
        <div class="admin-panel overflow-hidden">
            <div class="bg-[linear-gradient(135deg,#081b2c,#173a60)] px-7 py-9 text-white sm:px-9">
                <p class="text-xs font-bold uppercase tracking-[0.24em] text-white/48">Member Portal</p>
                <h2 class="mt-5 font-display text-5xl font-semibold">No membership record is linked to this account yet.</h2>
                <p class="mt-4 max-w-2xl text-sm leading-7 text-white/72">
                    Register your membership using the same email address, then return here to view your ECOSA ID, payment details, and profile information.
                </p>
                <div class="mt-7 flex flex-wrap gap-4">
                    <a href="{{ route('site.membership.register') }}" class="site-btn-secondary">Go to Registration</a>
                    <a href="{{ route('site.membership') }}" class="site-btn-ghost border-white/12 bg-white/10 text-white hover:bg-white/16">View Membership Hub</a>
                </div>
            </div>

            {{-- Prompt Cards --}}
            <div class="grid gap-5 p-6 sm:grid-cols-3">
                <div class="rounded-[20px] border border-ecosa-blue/8 bg-ecosa-blue/[0.03] p-5 text-center">
                    <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-ecosa-blue/10 text-ecosa-blue">
                        <i class="fas fa-file-pen text-lg"></i>
                    </div>
                    <p class="font-semibold text-ecosa-blue-deep">Register</p>
                    <p class="mt-1 text-xs text-zinc-500">Complete the membership application form</p>
                </div>
                <div class="rounded-[20px] border border-ecosa-blue/8 bg-ecosa-blue/[0.03] p-5 text-center">
                    <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-ecosa-gold/20 text-yellow-700">
                        <i class="fas fa-credit-card text-lg"></i>
                    </div>
                    <p class="font-semibold text-ecosa-blue-deep">Pay Your Fee</p>
                    <p class="mt-1 text-xs text-zinc-500">Submit your registration fee reference</p>
                </div>
                <div class="rounded-[20px] border border-ecosa-blue/8 bg-ecosa-blue/[0.03] p-5 text-center">
                    <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-ecosa-green/10 text-ecosa-green-deep">
                        <i class="fas fa-circle-check text-lg"></i>
                    </div>
                    <p class="font-semibold text-ecosa-blue-deep">Get Verified</p>
                    <p class="mt-1 text-xs text-zinc-500">Admin confirms and activates your profile</p>
                </div>
            </div>
        </div>

    @endif
</div>
