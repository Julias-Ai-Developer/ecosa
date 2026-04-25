<div class="mx-auto max-w-7xl">
    @if ($membership)
        <div class="grid gap-6 xl:grid-cols-[1.05fr_0.95fr]">
            <section class="admin-panel overflow-hidden">
                <div class="bg-[linear-gradient(135deg,#081b2c,#173a60)] px-7 py-8 text-white sm:px-9">
                    <p class="text-xs font-bold uppercase tracking-[0.24em] text-white/48">Member Profile</p>
                    <div class="mt-5 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
                        <div>
                            <h2 class="font-display text-5xl font-semibold">{{ $membership->full_name }}</h2>
                            <p class="mt-3 text-sm font-semibold text-white/70">Membership ID {{ $membership->membership_number }}</p>
                        </div>
                        <div class="rounded-[24px] border border-white/12 bg-white/10 px-5 py-4 text-sm">
                            <p class="font-bold uppercase tracking-[0.2em] text-white/45">Portal Status</p>
                            <div class="mt-3 flex flex-wrap items-center gap-3">
                                <span class="rounded-full bg-white px-4 py-2 text-xs font-bold text-ecosa-blue-deep">{{ $membership->membershipStatusLabel() }}</span>
                                <span class="rounded-full px-4 py-2 text-xs font-bold {{ $membership->paymentStatusTone() }}">{{ $membership->paymentStatusLabel() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid gap-4 px-7 py-7 sm:grid-cols-2 sm:px-9">
                    <div class="rounded-[24px] bg-ecosa-blue/[0.03] p-5">
                        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Email</p>
                        <p class="mt-3 text-sm font-semibold text-ecosa-blue-deep">{{ $membership->email }}</p>
                    </div>
                    <div class="rounded-[24px] bg-ecosa-blue/[0.03] p-5">
                        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Phone</p>
                        <p class="mt-3 text-sm font-semibold text-ecosa-blue-deep">{{ $membership->phone ?: 'Not provided' }}</p>
                    </div>
                    <div class="rounded-[24px] bg-ecosa-blue/[0.03] p-5">
                        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Completion Year</p>
                        <p class="mt-3 text-sm font-semibold text-ecosa-blue-deep">{{ $membership->completion_year ?: 'Not provided' }}</p>
                    </div>
                    <div class="rounded-[24px] bg-ecosa-blue/[0.03] p-5">
                        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Marital Status</p>
                        <p class="mt-3 text-sm font-semibold text-ecosa-blue-deep">{{ str($membership->marital_status ?: 'Not recorded')->replace('_', ' ')->title() }}</p>
                    </div>
                    <div class="rounded-[24px] bg-ecosa-blue/[0.03] p-5 sm:col-span-2">
                        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Address</p>
                        <p class="mt-3 text-sm font-semibold text-ecosa-blue-deep">{{ $membership->current_address ?: 'Not provided' }}</p>
                    </div>
                </div>
            </section>

            <section class="admin-panel p-7">
                <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Payment Details</p>
                <div class="mt-5 grid gap-4">
                    <div class="rounded-[24px] bg-ecosa-green/[0.08] p-5">
                        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-500">Payment Method</p>
                        <p class="mt-3 font-display text-3xl font-semibold text-ecosa-blue-deep">{{ $membership->paymentMethodLabel() }}</p>
                    </div>
                    <div class="rounded-[24px] bg-ecosa-blue/[0.03] p-5">
                        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-500">Payment Reference</p>
                        <p class="mt-3 text-sm font-semibold text-ecosa-blue-deep">{{ $membership->payment_reference ?: 'Not recorded' }}</p>
                    </div>
                    <div class="rounded-[24px] bg-ecosa-blue/[0.03] p-5">
                        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-500">Payment Phone</p>
                        <p class="mt-3 text-sm font-semibold text-ecosa-blue-deep">{{ $membership->payment_phone ?: 'Not recorded' }}</p>
                    </div>
                    <div class="rounded-[24px] bg-ecosa-blue/[0.03] p-5">
                        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-500">Paid At</p>
                        <p class="mt-3 text-sm font-semibold text-ecosa-blue-deep">{{ $membership->paid_at?->format('M j, Y g:i A') ?: 'Awaiting verification' }}</p>
                    </div>
                </div>
            </section>
        </div>

        <div class="mt-6 grid gap-6 xl:grid-cols-[0.9fr_1.1fr]">
            <section class="admin-panel p-7">
                <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Professional Details</p>
                <div class="mt-5 grid gap-4">
                    <div class="rounded-[24px] bg-ecosa-blue/[0.03] p-5">
                        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-500">Professional Category</p>
                        <p class="mt-3 text-sm font-semibold text-ecosa-blue-deep">{{ $membership->occupationTypeLabel() }}</p>
                    </div>
                    <div class="rounded-[24px] bg-ecosa-blue/[0.03] p-5">
                        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-500">Profession / Job Title</p>
                        <p class="mt-3 text-sm font-semibold text-ecosa-blue-deep">{{ $membership->occupation_title ?: 'Not recorded' }}</p>
                    </div>
                    <div class="rounded-[24px] bg-ecosa-blue/[0.03] p-5">
                        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-500">Business Name</p>
                        <p class="mt-3 text-sm font-semibold text-ecosa-blue-deep">{{ $membership->business_name ?: 'Not recorded' }}</p>
                    </div>
                    <div class="rounded-[24px] bg-ecosa-blue/[0.03] p-5">
                        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-500">Nature of Business</p>
                        <p class="mt-3 text-sm font-semibold text-ecosa-blue-deep">{{ $membership->business_nature ?: 'Not recorded' }}</p>
                    </div>
                </div>
            </section>

            <section class="admin-panel p-7">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Portal Actions</p>
                        <h2 class="mt-2 font-display text-4xl font-semibold text-ecosa-blue-deep">Keep your record current.</h2>
                    </div>
                    @if ($user->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="site-btn-ghost">Open Admin System</a>
                    @endif
                </div>

                @if ($paymentRecorded)
                    <div class="site-success mt-6">
                        A new payment reference has been recorded. The admin team will verify it and update your status in the portal.
                    </div>
                @endif

                @if ($membership->payment_status !== 'paid')
                    <form wire:submit.prevent="recordPayment" class="mt-6 grid gap-5 sm:grid-cols-2">
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
                            <button type="submit" class="site-btn-primary">Record Payment Reference</button>
                        </div>
                    </form>
                @else
                    <div class="mt-6 rounded-[28px] bg-ecosa-green/[0.08] p-6">
                        <p class="font-display text-3xl font-semibold text-ecosa-blue-deep">Your payment has already been verified.</p>
                        <p class="mt-3 text-sm leading-7 text-zinc-600">No further action is required unless the admin team asks you to update your records.</p>
                    </div>
                @endif
            </section>
        </div>
    @else
        <section class="admin-panel overflow-hidden">
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
        </section>
    @endif
</div>
