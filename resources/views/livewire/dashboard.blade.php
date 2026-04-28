<div class="mx-auto max-w-7xl space-y-6">
    @if ($membership)

        {{-- Page Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Member Portal</p>
                <h1 class="mt-1 font-display text-3xl font-bold text-ecosa-blue-deep">{{ $membership->full_name }}</h1>
                <p class="mt-1 text-sm text-zinc-500">
                    Member <span class="font-mono font-bold text-ecosa-blue">{{ $membership->membership_number }}</span>
                    &mdash; your profile and payment record below.
                </p>
            </div>
            <div class="flex flex-wrap gap-3">
                @if ($user->is_admin || $user->canAccessAdmin())
                    <a href="{{ route('admin.dashboard') }}"
                       class="inline-flex items-center gap-2 rounded-xl bg-ecosa-blue-deep px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-ecosa-blue">
                        <i class="fas fa-shield-halved text-xs"></i> Admin System
                    </a>
                @endif
                <a href="{{ route('site.membership') }}"
                   class="inline-flex items-center gap-2 rounded-xl border border-zinc-200 bg-white px-5 py-2.5 text-sm font-semibold text-zinc-700 shadow-sm transition hover:border-zinc-300 hover:text-zinc-900">
                    <i class="fas fa-globe text-xs"></i> Membership Hub
                </a>
            </div>
        </div>

        {{-- Stat Cards --}}
        <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">

            <article class="relative overflow-hidden rounded-2xl border border-zinc-100 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between">
                    <span class="text-xs font-medium text-zinc-500">Membership ID</span>
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-ecosa-blue/10 text-ecosa-blue">
                        <i class="fas fa-id-card text-sm"></i>
                    </div>
                </div>
                <p class="mt-4 font-mono text-3xl font-bold tracking-tight text-zinc-900">{{ $membership->membership_number }}</p>
                <p class="mt-1.5 text-xs text-zinc-400">Your ECOSA alumni identifier</p>
            </article>

            <article class="relative overflow-hidden rounded-2xl border border-zinc-100 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between">
                    <span class="text-xs font-medium text-zinc-500">Membership Status</span>
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-ecosa-green/10 text-ecosa-green-deep">
                        <i class="fas fa-user-check text-sm"></i>
                    </div>
                </div>
                <p class="mt-4 font-display text-2xl font-bold tracking-tight text-zinc-900">{{ $membership->membershipStatusLabel() }}</p>
                <p class="mt-1.5 text-xs text-zinc-400">Current portal standing</p>
            </article>

            <article class="relative overflow-hidden rounded-2xl border border-zinc-100 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between">
                    <span class="text-xs font-medium text-zinc-500">Payment Status</span>
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                        <i class="fas fa-credit-card text-sm"></i>
                    </div>
                </div>
                <p class="mt-4 font-display text-2xl font-bold tracking-tight text-zinc-900">{{ $membership->paymentStatusLabel() }}</p>
                <p class="mt-1.5 text-xs text-zinc-400">Registration fee verification</p>
            </article>

            <article class="relative overflow-hidden rounded-2xl border border-zinc-100 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between">
                    <span class="text-xs font-medium text-zinc-500">Member Since</span>
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-ecosa-burgundy/10 text-ecosa-burgundy">
                        <i class="fas fa-calendar text-sm"></i>
                    </div>
                </div>
                <p class="mt-4 font-display text-2xl font-bold tracking-tight text-zinc-900">{{ $membership->created_at->format('M Y') }}</p>
                <p class="mt-1.5 text-xs text-zinc-400">Joined {{ $membership->created_at->diffForHumans() }}</p>
            </article>

        </section>

        {{-- Profile + Payment --}}
        <section class="grid gap-6 xl:grid-cols-[1.05fr_0.95fr]">

            {{-- Profile Details --}}
            <div class="overflow-hidden rounded-2xl border border-zinc-100 bg-white shadow-sm">
                <div class="flex items-center justify-between border-b border-zinc-100 px-6 py-4">
                    <div>
                        <h2 class="text-base font-bold text-zinc-900">Personal Information</h2>
                        <p class="mt-0.5 text-xs text-zinc-500">Your profile details on record</p>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <tbody class="divide-y divide-zinc-50">
                            @foreach ([
                                ['label' => 'Email',           'value' => $membership->email],
                                ['label' => 'Phone',           'value' => $membership->phone ?: '—'],
                                ['label' => 'Completion Year', 'value' => $membership->completion_year ?: '—'],
                                ['label' => 'Marital Status',  'value' => str($membership->marital_status ?: '—')->replace('_', ' ')->title()],
                                ['label' => 'Address',         'value' => $membership->current_address ?: '—'],
                            ] as $row)
                            <tr class="transition hover:bg-zinc-50">
                                <td class="w-40 px-6 py-3.5 text-xs font-bold uppercase tracking-[0.14em] text-zinc-400">
                                    {{ $row['label'] }}
                                </td>
                                <td class="px-6 py-3.5 font-medium text-zinc-800">{{ $row['value'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Payment Details --}}
            <div class="overflow-hidden rounded-2xl border border-zinc-100 bg-white shadow-sm">
                <div class="flex items-center justify-between border-b border-zinc-100 px-6 py-4">
                    <div>
                        <h2 class="text-base font-bold text-zinc-900">Payment Details</h2>
                        <p class="mt-0.5 text-xs text-zinc-500">Your registration fee record</p>
                    </div>
                    <span class="rounded-full px-3 py-1 text-xs font-bold
                        {{ $membership->payment_status === 'paid' ? 'bg-emerald-50 text-emerald-600' :
                           ($membership->payment_status === 'pending_verification' ? 'bg-amber-50 text-amber-600' : 'bg-rose-50 text-rose-500') }}">
                        {{ $membership->paymentStatusLabel() }}
                    </span>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <tbody class="divide-y divide-zinc-50">
                            @foreach ([
                                ['label' => 'Method',    'value' => $membership->paymentMethodLabel()],
                                ['label' => 'Purpose',   'value' => $membership->paymentPurposeLabel()],
                                ['label' => 'Amount',    'value' => 'UGX ' . number_format($membership->amount_paid ?: $membership->registration_fee)],
                                ['label' => 'Phone',     'value' => $membership->payment_phone ?: '—'],
                                ['label' => 'Reference', 'value' => $membership->payment_reference ?: '—'],
                                ['label' => 'Paid At',   'value' => $membership->paid_at?->format('M j, Y g:i A') ?: 'Awaiting verification'],
                            ] as $row)
                            <tr class="transition hover:bg-zinc-50">
                                <td class="w-32 px-6 py-3.5 text-xs font-bold uppercase tracking-[0.14em] text-zinc-400">
                                    {{ $row['label'] }}
                                </td>
                                <td class="px-6 py-3.5 font-medium text-zinc-800">{{ $row['value'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </section>

        {{-- Professional Details + Portal Actions --}}
        <section class="grid gap-6 xl:grid-cols-[0.9fr_1.1fr]">

            {{-- Professional Details --}}
            <div class="overflow-hidden rounded-2xl border border-zinc-100 bg-white shadow-sm">
                <div class="flex items-center justify-between border-b border-zinc-100 px-6 py-4">
                    <div>
                        <h2 class="text-base font-bold text-zinc-900">Career & Business</h2>
                        <p class="mt-0.5 text-xs text-zinc-500">Professional details on your profile</p>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <tbody class="divide-y divide-zinc-50">
                            @foreach ([
                                ['label' => 'Category',  'value' => $membership->occupationTypeLabel()],
                                ['label' => 'Job Title', 'value' => $membership->occupation_title ?: '—'],
                                ['label' => 'Business',  'value' => $membership->business_name ?: '—'],
                                ['label' => 'Nature',    'value' => $membership->business_nature ?: '—'],
                            ] as $row)
                            <tr class="transition hover:bg-zinc-50">
                                <td class="w-32 px-6 py-3.5 text-xs font-bold uppercase tracking-[0.14em] text-zinc-400">
                                    {{ $row['label'] }}
                                </td>
                                <td class="px-6 py-3.5 font-medium text-zinc-800">{{ $row['value'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Portal Actions --}}
            <div class="overflow-hidden rounded-2xl border border-zinc-100 bg-white shadow-sm">
                <div class="flex items-center justify-between border-b border-zinc-100 px-6 py-4">
                    <div>
                        <h2 class="text-base font-bold text-zinc-900">Portal Actions</h2>
                        <p class="mt-0.5 text-xs text-zinc-500">Keep your record current</p>
                    </div>
                </div>
                <div class="p-6">
                    @if ($paymentRecorded)
                        <div class="mb-5 rounded-2xl border border-ecosa-green/20 bg-ecosa-green/8 px-5 py-4 text-sm font-semibold text-ecosa-green-deep">
                            <i class="fas fa-circle-check mr-2"></i>
                            Payment reference recorded. Admin will verify and update your status.
                        </div>
                    @endif

                    @if ($membership->payment_status !== 'paid')
                        <p class="mb-5 text-sm leading-6 text-zinc-600">
                            Submit your payment reference below and the admin team will verify and activate your membership.
                        </p>
                        <form wire:submit.prevent="recordPayment" class="grid gap-4 sm:grid-cols-2">
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
                                <input type="text" wire:model.blur="paymentReference" class="site-input"
                                       placeholder="Transaction or receipt reference">
                                @error('paymentReference') <p class="site-error">{{ $message }}</p> @enderror
                            </label>
                            <div class="sm:col-span-2">
                                <button type="submit"
                                        class="inline-flex items-center gap-2 rounded-xl bg-ecosa-blue-deep px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-ecosa-blue">
                                    <i class="fas fa-check text-xs"></i> Record Payment Reference
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="rounded-2xl border border-zinc-100 bg-emerald-50 p-5">
                            <div class="flex items-start gap-4">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                                    <i class="fas fa-circle-check"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-zinc-900">Payment verified</p>
                                    <p class="mt-1 text-sm leading-6 text-zinc-600">
                                        Your registration fee has been confirmed. No further action required.
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Quick Links --}}
                        <div class="mt-5 space-y-2">
                            <p class="mb-2 text-xs font-bold uppercase tracking-[0.22em] text-zinc-400">Quick Links</p>
                            @foreach ([
                                ['href' => route('site.membership'),  'icon' => 'fa-users',       'label' => 'Membership Hub',  'sub' => 'View membership information'],
                                ['href' => route('site.community'),   'icon' => 'fa-layer-group', 'label' => 'Community',       'sub' => 'Programs & projects'],
                                ['href' => route('site.contact'),     'icon' => 'fa-envelope',    'label' => 'Contact Us',      'sub' => 'Reach the ECOSA team'],
                            ] as $link)
                                <a href="{{ $link['href'] }}"
                                   class="flex items-center gap-3 rounded-xl border border-zinc-100 bg-zinc-50 p-3.5 transition hover:border-zinc-200 hover:bg-white">
                                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-ecosa-blue/10 text-ecosa-blue">
                                        <i class="fas {{ $link['icon'] }} text-xs"></i>
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
        @if ($notifications->isNotEmpty())
        <section class="overflow-hidden rounded-2xl border border-zinc-100 bg-white shadow-sm">
            <div class="flex items-center justify-between border-b border-zinc-100 px-6 py-4">
                <div>
                    <h2 class="text-base font-bold text-zinc-900">Notifications from ECOSA</h2>
                    <p class="mt-0.5 text-xs text-zinc-500">Messages sent to you by the admin team</p>
                </div>
                <span class="flex h-7 min-w-[28px] items-center justify-center rounded-full bg-ecosa-green px-2 text-xs font-bold text-white">
                    {{ $notifications->count() }}
                </span>
            </div>
            <div class="divide-y divide-zinc-50">
                @foreach ($notifications as $note)
                <div class="px-6 py-4 transition hover:bg-zinc-50">
                    <div class="flex items-start gap-3">
                        <div class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-ecosa-blue/8 text-ecosa-blue">
                            <i class="fas fa-bell text-xs"></i>
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-start justify-between gap-3">
                                <p class="text-sm font-bold text-zinc-900">{{ $note->title }}</p>
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
        <div class="overflow-hidden rounded-2xl border border-zinc-100 bg-white shadow-sm">
            <div class="bg-[linear-gradient(135deg,#081b2c,#173a60)] px-7 py-9 text-white sm:px-9">
                <p class="text-xs font-bold uppercase tracking-[0.24em] text-white/50">Member Portal</p>
                <h2 class="mt-4 font-display text-4xl font-semibold">No membership record linked yet.</h2>
                <p class="mt-3 max-w-2xl text-sm leading-7 text-white/70">
                    Register your membership using the same email address, then return here to view your ECOSA ID, payment details, and profile.
                </p>
                <div class="mt-6 flex flex-wrap gap-4">
                    <a href="{{ route('site.membership.register') }}"
                       class="inline-flex items-center gap-2 rounded-xl border border-ecosa-green bg-ecosa-green px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-ecosa-green-deep">
                        Go to Registration
                    </a>
                    <a href="{{ route('site.membership') }}"
                       class="inline-flex items-center gap-2 rounded-xl border border-white/15 bg-white/10 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-white/16">
                        View Membership Hub
                    </a>
                </div>
            </div>
            <div class="grid gap-4 p-6 sm:grid-cols-3">
                @foreach ([
                    ['icon' => 'fa-file-pen',    'color' => 'bg-ecosa-blue/10 text-ecosa-blue',        'label' => 'Register',       'sub' => 'Complete the membership application form'],
                    ['icon' => 'fa-credit-card', 'color' => 'bg-amber-50 text-amber-600',              'label' => 'Pay Your Fee',   'sub' => 'Submit your registration fee reference'],
                    ['icon' => 'fa-circle-check','color' => 'bg-emerald-50 text-emerald-600',           'label' => 'Get Verified',   'sub' => 'Admin confirms and activates your profile'],
                ] as $step)
                <div class="rounded-xl border border-zinc-100 bg-zinc-50 p-5 text-center">
                    <div class="mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl {{ $step['color'] }}">
                        <i class="fas {{ $step['icon'] }}"></i>
                    </div>
                    <p class="font-semibold text-zinc-900">{{ $step['label'] }}</p>
                    <p class="mt-1 text-xs text-zinc-500">{{ $step['sub'] }}</p>
                </div>
                @endforeach
            </div>
        </div>

    @endif
</div>
