<div class="mx-auto max-w-7xl space-y-6">

    {{-- Hero Banner --}}
    <section class="rounded-[34px] bg-[linear-gradient(135deg,#081b2c,#173a60)] px-7 py-9 text-white shadow-[var(--shadow-soft)] sm:px-9">
        <p class="text-xs font-bold uppercase tracking-[0.24em] text-white/48">Member Registry</p>
        <div class="mt-5 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <h1 class="font-display text-5xl font-semibold text-balance">Search, verify, and manage all member registrations.</h1>
                <p class="mt-4 max-w-3xl text-sm leading-7 text-white/72">
                    Every record here comes from the public registration workflow. Click any row to view full member details and take action.
                </p>
            </div>
            <a href="{{ route('site.membership.register') }}" class="site-btn-secondary shrink-0">
                <i class="fas fa-user-plus mr-1"></i> Open Public Registration
            </a>
        </div>
    </section>

    {{-- Stats Cards --}}
    <section class="grid gap-5 sm:grid-cols-2 xl:grid-cols-5">
        <article class="admin-panel overflow-hidden">
            <div class="bg-gradient-to-br from-[#173a60] to-[#244f7d] px-5 py-5 text-white">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.22em] opacity-65">Total</p>
                        <p class="mt-2 font-display text-4xl font-semibold">{{ $memberTotal }}</p>
                    </div>
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-white/20">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
            <p class="px-5 py-3 text-xs text-zinc-500">All registered alumni</p>
        </article>

        <article class="admin-panel overflow-hidden">
            <div class="bg-gradient-to-br from-[#17924b] to-[#0f743c] px-5 py-5 text-white">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.22em] opacity-65">Active</p>
                        <p class="mt-2 font-display text-4xl font-semibold">{{ $activeTotal }}</p>
                    </div>
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-white/20">
                        <i class="fas fa-user-check"></i>
                    </div>
                </div>
            </div>
            <p class="px-5 py-3 text-xs text-zinc-500">Verified members</p>
        </article>

        <article class="admin-panel overflow-hidden">
            <div class="bg-gradient-to-br from-[#67bc45] to-[#4f9731] px-5 py-5 text-white">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.22em] opacity-65">Paid</p>
                        <p class="mt-2 font-display text-4xl font-semibold">{{ $paidTotal }}</p>
                    </div>
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-white/20">
                        <i class="fas fa-circle-check"></i>
                    </div>
                </div>
            </div>
            <p class="px-5 py-3 text-xs text-zinc-500">Payment confirmed</p>
        </article>

        <article class="admin-panel overflow-hidden">
            <div class="bg-gradient-to-br from-[#ffd600] to-[#ffb703] px-5 py-5 text-[#102b47]">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.22em] opacity-65">Pending</p>
                        <p class="mt-2 font-display text-4xl font-semibold">{{ $pendingPaymentTotal }}</p>
                    </div>
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-black/10">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>
            <p class="px-5 py-3 text-xs text-zinc-500">Awaiting verification</p>
        </article>

        <article class="admin-panel overflow-hidden">
            <div class="bg-gradient-to-br from-[#8c2f39] to-[#5f0f40] px-5 py-5 text-white">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.22em] opacity-65">Unpaid</p>
                        <p class="mt-2 font-display text-4xl font-semibold">{{ $unpaidTotal }}</p>
                    </div>
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-white/20">
                        <i class="fas fa-triangle-exclamation"></i>
                    </div>
                </div>
            </div>
            <p class="px-5 py-3 text-xs text-zinc-500">No payment recorded</p>
        </article>
    </section>

    {{-- Filters --}}
    <section class="admin-panel p-6 sm:p-7">
        <p class="mb-4 text-xs font-bold uppercase tracking-[0.22em] text-zinc-400">Filter &amp; Search Members</p>
        <div class="grid gap-4 lg:grid-cols-[1fr_200px_200px_200px_auto]">
            <label>
                <span class="site-label">Search</span>
                <div class="relative">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-zinc-400"></i>
                    <input id="member-search" type="search" wire:model.live.debounce.300ms="search"
                        placeholder="Name, EC ID, email, phone, business..."
                        class="site-input pl-10">
                </div>
            </label>

            <label>
                <span class="site-label">Payment Status</span>
                <select wire:model.live="paymentStatus" class="site-input">
                    <option value="all">All payments</option>
                    <option value="paid">Paid</option>
                    <option value="pending_verification">Pending</option>
                    <option value="unpaid">Unpaid</option>
                </select>
            </label>

            <label>
                <span class="site-label">Member Status</span>
                <select wire:model.live="membershipStatus" class="site-input">
                    <option value="all">All statuses</option>
                    <option value="active">Active</option>
                    <option value="pending">Pending</option>
                    <option value="suspended">Suspended</option>
                </select>
            </label>

            <label>
                <span class="site-label">Sort By</span>
                <select wire:model.live="sort" class="site-input">
                    <option value="latest">Newest first</option>
                    <option value="oldest">Oldest first</option>
                    <option value="name">Name A–Z</option>
                </select>
            </label>

            <div class="flex items-end">
                <button type="button" wire:click="resetFilters" class="site-btn-ghost w-full">
                    <i class="fas fa-rotate-left mr-1"></i> Reset
                </button>
            </div>
        </div>
    </section>

    {{-- Members Table --}}
    <section class="admin-panel overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-[1100px] w-full text-left text-sm">
                <thead class="bg-ecosa-blue/[0.03] text-[0.68rem] uppercase tracking-[0.2em] text-zinc-400">
                    <tr>
                        <th class="px-6 py-4 font-bold">EC ID</th>
                        <th class="px-6 py-4 font-bold">Member</th>
                        <th class="px-6 py-4 font-bold">Address</th>
                        <th class="px-6 py-4 font-bold">Professional</th>
                        <th class="px-6 py-4 font-bold">Membership</th>
                        <th class="px-6 py-4 font-bold">Payment</th>
                        <th class="px-6 py-4 font-bold">Method</th>
                        <th class="px-6 py-4 font-bold">Joined</th>
                        <th class="px-6 py-4 font-bold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ecosa-blue/8">
                    @forelse ($members as $member)
                        <tr class="cursor-pointer transition hover:bg-ecosa-blue/[0.02]" wire:click="viewMember({{ $member->id }})">
                            <td class="px-6 py-4">
                                <span class="rounded-lg bg-ecosa-blue/8 px-2 py-1 font-mono text-xs font-bold text-ecosa-blue-deep">{{ $member->membership_number }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-zinc-900">{{ $member->full_name }}</p>
                                <p class="mt-0.5 text-xs text-zinc-500">{{ $member->email }}</p>
                                <p class="mt-0.5 text-xs text-zinc-400">{{ $member->phone ?: '—' }}</p>
                            </td>
                            <td class="px-6 py-4 text-xs text-zinc-600">{{ $member->current_address ?: '—' }}</td>
                            <td class="px-6 py-4">
                                <p class="text-xs font-semibold text-ecosa-blue-deep">{{ $member->occupationTypeLabel() }}</p>
                                <p class="mt-0.5 text-xs text-zinc-500">{{ $member->occupation_title ?: '—' }}</p>
                                @if ($member->business_name)
                                    <p class="mt-0.5 text-xs text-zinc-400">{{ $member->business_name }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="rounded-full bg-ecosa-blue/[0.08] px-3 py-1 text-xs font-bold text-ecosa-blue">{{ $member->membershipStatusLabel() }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="rounded-full px-3 py-1 text-xs font-bold {{ $member->paymentStatusTone() }}">{{ $member->paymentStatusLabel() }}</span>
                                @if ($member->payment_reference)
                                    <p class="mt-1 text-[0.65rem] text-zinc-400">Ref: {{ $member->payment_reference }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs text-zinc-600">{{ $member->paymentMethodLabel() }}</td>
                            <td class="px-6 py-4 text-xs text-zinc-500">{{ $member->created_at->format('M j, Y') }}</td>
                            <td class="px-6 py-4 text-right" @click.stop>
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button" wire:click="viewMember({{ $member->id }})"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-ecosa-blue/10 text-ecosa-blue transition hover:bg-ecosa-blue hover:text-white"
                                        title="View full details">
                                        <i class="fas fa-eye text-xs"></i>
                                    </button>
                                    @if ($member->payment_status === 'paid')
                                        <button type="button" wire:click="markPending({{ $member->id }})"
                                            class="inline-flex h-9 items-center justify-center rounded-xl border border-zinc-200 px-3 text-xs font-bold text-zinc-600 transition hover:bg-zinc-100"
                                            title="Mark as pending">
                                            Set Pending
                                        </button>
                                    @else
                                        <button type="button" wire:click="verifyPayment({{ $member->id }})"
                                            class="site-btn-primary h-9 px-4 py-0 text-xs"
                                            title="Verify payment">
                                            <i class="fas fa-check mr-1"></i> Verify
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-12 text-center">
                                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-zinc-100">
                                    <i class="fas fa-users text-2xl text-zinc-300"></i>
                                </div>
                                <p class="mt-4 text-sm text-zinc-500">No member records match the current filters.</p>
                                <button wire:click="resetFilters" class="mt-3 text-sm font-semibold text-ecosa-blue hover:underline">Clear filters</button>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-ecosa-blue/8 px-6 py-5">
            {{ $members->links() }}
        </div>
    </section>
</div>

{{-- Member Detail Modal --}}
@if ($viewingMember)
    <div class="fixed inset-0 z-50 flex items-start justify-center overflow-y-auto bg-[#081b2c]/72 px-4 py-10 backdrop-blur-sm"
        wire:click.self="closeModal">
        <div class="site-card w-full max-w-2xl overflow-hidden rounded-[32px]">

            {{-- Modal Header --}}
            <div class="bg-[linear-gradient(135deg,#081b2c,#173a60)] px-7 py-6 text-white">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <span class="rounded-lg bg-white/10 px-3 py-1 font-mono text-xs font-bold text-ecosa-gold">{{ $viewingMember->membership_number }}</span>
                        <h2 class="mt-3 font-display text-4xl font-semibold">{{ $viewingMember->full_name }}</h2>
                        <p class="mt-1 text-sm text-white/70">{{ $viewingMember->email }}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="rounded-full px-3 py-1 text-xs font-bold {{ $viewingMember->paymentStatusTone() }}">{{ $viewingMember->paymentStatusLabel() }}</span>
                        <button wire:click="closeModal" class="flex h-10 w-10 items-center justify-center rounded-full border border-white/14 text-white transition hover:bg-white/10" aria-label="Close">
                            <i class="fas fa-xmark"></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Modal Body --}}
            <div class="grid gap-6 p-7 sm:grid-cols-2">

                {{-- Personal Info --}}
                <div class="space-y-4">
                    <p class="text-xs font-bold uppercase tracking-[0.22em] text-zinc-400">Personal Information</p>

                    <div class="rounded-[20px] border border-ecosa-blue/8 bg-ecosa-blue/[0.02] p-4 space-y-3">
                        <div>
                            <p class="text-xs text-zinc-400">Phone</p>
                            <p class="mt-0.5 text-sm font-semibold text-zinc-800">{{ $viewingMember->phone ?: 'Not recorded' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-zinc-400">Current Address</p>
                            <p class="mt-0.5 text-sm font-semibold text-zinc-800">{{ $viewingMember->current_address ?: 'Not recorded' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-zinc-400">Completion Year</p>
                            <p class="mt-0.5 text-sm font-semibold text-zinc-800">{{ $viewingMember->completion_year ?: 'Not recorded' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-zinc-400">Marital Status</p>
                            <p class="mt-0.5 text-sm font-semibold text-zinc-800">{{ str($viewingMember->marital_status ?: 'Not recorded')->replace('_', ' ')->title() }}</p>
                        </div>
                    </div>
                </div>

                {{-- Professional Info --}}
                <div class="space-y-4">
                    <p class="text-xs font-bold uppercase tracking-[0.22em] text-zinc-400">Professional Details</p>

                    <div class="rounded-[20px] border border-ecosa-blue/8 bg-ecosa-blue/[0.02] p-4 space-y-3">
                        <div>
                            <p class="text-xs text-zinc-400">Category</p>
                            <p class="mt-0.5 text-sm font-semibold text-zinc-800">{{ $viewingMember->occupationTypeLabel() }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-zinc-400">Job Title / Profession</p>
                            <p class="mt-0.5 text-sm font-semibold text-zinc-800">{{ $viewingMember->occupation_title ?: 'Not recorded' }}</p>
                        </div>
                        @if ($viewingMember->business_name)
                            <div>
                                <p class="text-xs text-zinc-400">Business</p>
                                <p class="mt-0.5 text-sm font-semibold text-zinc-800">{{ $viewingMember->business_name }}</p>
                                <p class="text-xs text-zinc-500">{{ $viewingMember->business_nature }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Payment Info --}}
                <div class="sm:col-span-2 space-y-4">
                    <p class="text-xs font-bold uppercase tracking-[0.22em] text-zinc-400">Payment Information</p>

                    <div class="grid gap-3 sm:grid-cols-4">
                        <div class="rounded-[20px] bg-ecosa-blue/[0.04] p-4">
                            <p class="text-xs text-zinc-400">Status</p>
                            <p class="mt-1 text-sm font-bold text-ecosa-blue-deep">{{ $viewingMember->paymentStatusLabel() }}</p>
                        </div>
                        <div class="rounded-[20px] bg-ecosa-blue/[0.04] p-4">
                            <p class="text-xs text-zinc-400">Method</p>
                            <p class="mt-1 text-sm font-bold text-ecosa-blue-deep">{{ $viewingMember->paymentMethodLabel() }}</p>
                        </div>
                        <div class="rounded-[20px] bg-ecosa-blue/[0.04] p-4">
                            <p class="text-xs text-zinc-400">Amount Paid</p>
                            <p class="mt-1 text-sm font-bold text-ecosa-blue-deep">UGX {{ number_format($viewingMember->amount_paid ?? 0) }}</p>
                        </div>
                        <div class="rounded-[20px] bg-ecosa-blue/[0.04] p-4">
                            <p class="text-xs text-zinc-400">Payment Phone</p>
                            <p class="mt-1 text-sm font-bold text-ecosa-blue-deep">{{ $viewingMember->payment_phone ?: '—' }}</p>
                        </div>
                    </div>

                    @if ($viewingMember->payment_reference)
                        <div class="rounded-[20px] border border-ecosa-blue/8 bg-ecosa-blue/[0.02] p-4">
                            <p class="text-xs text-zinc-400">Transaction Reference</p>
                            <p class="mt-1 font-mono text-sm font-semibold text-ecosa-blue-deep">{{ $viewingMember->payment_reference }}</p>
                        </div>
                    @endif
                </div>

                {{-- Actions --}}
                <div class="sm:col-span-2 flex flex-wrap justify-end gap-3 border-t border-ecosa-blue/8 pt-5">
                    <p class="mr-auto text-xs text-zinc-400 self-center">Registered {{ $viewingMember->created_at->format('F j, Y') }}</p>
                    <button wire:click="closeModal" class="site-btn-ghost">Close</button>
                    @if ($viewingMember->payment_status === 'paid')
                        <button wire:click="markPending({{ $viewingMember->id }})" class="site-btn-ghost border-yellow-300 text-yellow-700 hover:bg-yellow-50">
                            <i class="fas fa-clock mr-1"></i> Set to Pending
                        </button>
                    @else
                        <button wire:click="verifyPayment({{ $viewingMember->id }})" class="site-btn-primary">
                            <i class="fas fa-check mr-1"></i> Verify Payment &amp; Activate
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
