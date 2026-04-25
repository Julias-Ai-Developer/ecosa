<div class="space-y-5">

    {{-- Stat Cards --}}
    <section class="grid gap-4 sm:grid-cols-3 xl:grid-cols-5">
        <article class="overflow-hidden rounded-2xl border border-zinc-100 bg-white shadow-sm">
            <div class="bg-gradient-to-br from-[#173a60] to-[#244f7d] px-5 py-4 text-white">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-[0.6rem] font-bold uppercase tracking-[0.22em] opacity-60">Total</p>
                        <p class="mt-1 text-3xl font-bold">{{ $memberTotal }}</p>
                    </div>
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/15">
                        <i class="fas fa-users text-sm"></i>
                    </div>
                </div>
            </div>
            <p class="px-5 py-2.5 text-xs text-zinc-500">All registered alumni</p>
        </article>

        <article class="overflow-hidden rounded-2xl border border-zinc-100 bg-white shadow-sm">
            <div class="bg-gradient-to-br from-[#17924b] to-[#0f743c] px-5 py-4 text-white">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-[0.6rem] font-bold uppercase tracking-[0.22em] opacity-60">Active</p>
                        <p class="mt-1 text-3xl font-bold">{{ $activeTotal }}</p>
                    </div>
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/15">
                        <i class="fas fa-user-check text-sm"></i>
                    </div>
                </div>
            </div>
            <p class="px-5 py-2.5 text-xs text-zinc-500">Verified members</p>
        </article>

        <article class="overflow-hidden rounded-2xl border border-zinc-100 bg-white shadow-sm">
            <div class="bg-gradient-to-br from-[#67bc45] to-[#4f9731] px-5 py-4 text-white">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-[0.6rem] font-bold uppercase tracking-[0.22em] opacity-60">Paid</p>
                        <p class="mt-1 text-3xl font-bold">{{ $paidTotal }}</p>
                    </div>
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/15">
                        <i class="fas fa-circle-check text-sm"></i>
                    </div>
                </div>
            </div>
            <p class="px-5 py-2.5 text-xs text-zinc-500">Payment confirmed</p>
        </article>

        <article class="overflow-hidden rounded-2xl border border-zinc-100 bg-white shadow-sm">
            <div class="bg-gradient-to-br from-[#ffd600] to-[#ffb703] px-5 py-4 text-[#102b47]">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-[0.6rem] font-bold uppercase tracking-[0.22em] opacity-60">Pending</p>
                        <p class="mt-1 text-3xl font-bold">{{ $pendingPaymentTotal }}</p>
                    </div>
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-black/10">
                        <i class="fas fa-clock text-sm"></i>
                    </div>
                </div>
            </div>
            <p class="px-5 py-2.5 text-xs text-zinc-500">Awaiting verification</p>
        </article>

        <article class="overflow-hidden rounded-2xl border border-zinc-100 bg-white shadow-sm">
            <div class="bg-gradient-to-br from-[#8c2f39] to-[#5f0f40] px-5 py-4 text-white">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-[0.6rem] font-bold uppercase tracking-[0.22em] opacity-60">Unpaid</p>
                        <p class="mt-1 text-3xl font-bold">{{ $unpaidTotal }}</p>
                    </div>
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/15">
                        <i class="fas fa-triangle-exclamation text-sm"></i>
                    </div>
                </div>
            </div>
            <p class="px-5 py-2.5 text-xs text-zinc-500">No payment recorded</p>
        </article>
    </section>

    {{-- Table Card --}}
    <div class="overflow-hidden rounded-2xl border border-zinc-100 bg-white shadow-sm">

        {{-- Toolbar --}}
        <div class="border-b border-zinc-100 px-6 py-4">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-base font-bold text-zinc-900">Member Registry</h2>
                    <p class="mt-0.5 text-xs text-zinc-500">Click any row to view full member details</p>
                </div>
                <a href="{{ route('site.membership.register') }}"
                   class="inline-flex shrink-0 items-center gap-2 rounded-lg bg-ecosa-green px-4 py-2 text-sm font-semibold text-white transition hover:bg-ecosa-green-deep">
                    <i class="fas fa-user-plus text-xs"></i> Register Member
                </a>
            </div>

            {{-- Filters --}}
            <div class="mt-4 grid gap-3 sm:grid-cols-2 lg:grid-cols-[1fr_160px_160px_160px_auto]">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-xs text-zinc-400"></i>
                    <input type="search" wire:model.live.debounce.300ms="search"
                           placeholder="Name, EC ID, email, phone..."
                           class="w-full rounded-lg border border-zinc-200 bg-zinc-50 py-2 pl-8 pr-3 text-sm text-zinc-900 placeholder-zinc-400 focus:border-ecosa-green focus:bg-white focus:outline-none focus:ring-1 focus:ring-ecosa-green/30">
                </div>

                <select wire:model.live="paymentStatus"
                        class="rounded-lg border border-zinc-200 bg-zinc-50 px-3 py-2 text-sm text-zinc-700 focus:border-ecosa-green focus:outline-none focus:ring-1 focus:ring-ecosa-green/30">
                    <option value="all">All payments</option>
                    <option value="paid">Paid</option>
                    <option value="pending_verification">Pending</option>
                    <option value="unpaid">Unpaid</option>
                </select>

                <select wire:model.live="membershipStatus"
                        class="rounded-lg border border-zinc-200 bg-zinc-50 px-3 py-2 text-sm text-zinc-700 focus:border-ecosa-green focus:outline-none focus:ring-1 focus:ring-ecosa-green/30">
                    <option value="all">All statuses</option>
                    <option value="active">Active</option>
                    <option value="pending">Pending</option>
                    <option value="suspended">Suspended</option>
                </select>

                <select wire:model.live="sort"
                        class="rounded-lg border border-zinc-200 bg-zinc-50 px-3 py-2 text-sm text-zinc-700 focus:border-ecosa-green focus:outline-none focus:ring-1 focus:ring-ecosa-green/30">
                    <option value="latest">Newest first</option>
                    <option value="oldest">Oldest first</option>
                    <option value="name">Name A–Z</option>
                </select>

                <button type="button" wire:click="resetFilters"
                        class="rounded-lg border border-zinc-200 bg-white px-4 py-2 text-sm font-medium text-zinc-600 transition hover:border-zinc-300 hover:text-zinc-900">
                    <i class="fas fa-rotate-left mr-1 text-xs"></i> Reset
                </button>
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-[1100px] w-full text-left text-sm">
                <thead class="border-b border-zinc-100 bg-zinc-50">
                    <tr>
                        <th class="px-6 py-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">EC ID</th>
                        <th class="px-6 py-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Member</th>
                        <th class="px-6 py-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Address</th>
                        <th class="px-6 py-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Professional</th>
                        <th class="px-6 py-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Membership</th>
                        <th class="px-6 py-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Payment</th>
                        <th class="px-6 py-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Method</th>
                        <th class="px-6 py-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Joined</th>
                        <th class="px-6 py-3 text-right text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-50">
                    @forelse ($members as $member)
                        <tr class="cursor-pointer transition hover:bg-zinc-50" wire:click="viewMember({{ $member->id }})">
                            <td class="px-6 py-3.5">
                                <span class="rounded-md bg-ecosa-blue/8 px-2 py-1 font-mono text-xs font-bold text-ecosa-blue-deep">{{ $member->membership_number }}</span>
                            </td>
                            <td class="px-6 py-3.5">
                                <p class="font-semibold text-zinc-900">{{ $member->full_name }}</p>
                                <p class="text-xs text-zinc-400">{{ $member->email }}</p>
                                <p class="text-xs text-zinc-400">{{ $member->phone ?: '—' }}</p>
                            </td>
                            <td class="px-6 py-3.5 text-xs text-zinc-500">{{ $member->current_address ?: '—' }}</td>
                            <td class="px-6 py-3.5">
                                <p class="text-xs font-semibold text-zinc-800">{{ $member->occupationTypeLabel() }}</p>
                                <p class="text-xs text-zinc-400">{{ $member->occupation_title ?: '—' }}</p>
                                @if($member->business_name)
                                    <p class="text-xs text-zinc-400">{{ $member->business_name }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-3.5">
                                <span class="rounded-full bg-ecosa-blue/8 px-2.5 py-1 text-xs font-semibold text-ecosa-blue">{{ $member->membershipStatusLabel() }}</span>
                            </td>
                            <td class="px-6 py-3.5">
                                <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $member->paymentStatusTone() }}">{{ $member->paymentStatusLabel() }}</span>
                                @if($member->payment_reference)
                                    <p class="mt-0.5 text-[0.65rem] text-zinc-400">{{ $member->payment_reference }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-3.5 text-xs text-zinc-500">{{ $member->paymentMethodLabel() }}</td>
                            <td class="px-6 py-3.5 text-xs text-zinc-400">{{ $member->created_at->format('M j, Y') }}</td>
                            <td class="px-6 py-3.5 text-right" @click.stop>
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button" wire:click="viewMember({{ $member->id }})"
                                            class="flex h-8 w-8 items-center justify-center rounded-lg border border-zinc-200 text-zinc-500 transition hover:border-ecosa-green hover:text-ecosa-green"
                                            title="View details">
                                        <i class="fas fa-eye text-xs"></i>
                                    </button>
                                    @if($member->payment_status === 'paid')
                                        <button type="button" wire:click="markPending({{ $member->id }})"
                                                class="rounded-lg border border-zinc-200 px-3 py-1.5 text-xs font-semibold text-zinc-600 transition hover:bg-zinc-50"
                                                title="Mark as pending">
                                            Set Pending
                                        </button>
                                    @else
                                        <button type="button" wire:click="verifyPayment({{ $member->id }})"
                                                class="rounded-lg bg-ecosa-green px-3 py-1.5 text-xs font-semibold text-white transition hover:bg-ecosa-green-deep"
                                                title="Verify payment">
                                            <i class="fas fa-check mr-1"></i> Verify
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-14 text-center">
                                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-zinc-100">
                                    <i class="fas fa-users text-xl text-zinc-300"></i>
                                </div>
                                <p class="mt-3 text-sm text-zinc-500">No records match the current filters.</p>
                                <button wire:click="resetFilters" class="mt-2 text-sm font-semibold text-ecosa-green hover:underline">Clear filters</button>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-zinc-100 px-6 py-4">
            {{ $members->links() }}
        </div>
    </div>
</div>

{{-- Drawer Overlay --}}
<div
    style="display: {{ $viewingMember ? 'block' : 'none' }}"
    class="fixed inset-0 z-40 bg-black/40 backdrop-blur-sm"
    wire:click="closeModal"></div>

{{-- Member Detail Drawer --}}
<div
    class="fixed inset-y-0 right-0 z-50 flex w-full max-w-lg flex-col bg-white shadow-2xl transition-transform duration-300"
    style="transform: translateX({{ $viewingMember ? '0' : '100%' }})">

    @if($viewingMember)
    {{-- Drawer Header --}}
    <div class="flex shrink-0 items-start justify-between border-b border-zinc-100 px-6 py-5">
        <div>
            <span class="rounded-md bg-ecosa-blue/8 px-2.5 py-1 font-mono text-xs font-bold text-ecosa-blue-deep">{{ $viewingMember->membership_number }}</span>
            <h2 class="mt-3 text-lg font-bold text-zinc-900">{{ $viewingMember->full_name }}</h2>
            <p class="text-sm text-zinc-400">{{ $viewingMember->email }}</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $viewingMember->paymentStatusTone() }}">{{ $viewingMember->paymentStatusLabel() }}</span>
            <button wire:click="closeModal"
                    class="flex h-8 w-8 items-center justify-center rounded-lg border border-zinc-200 text-zinc-400 transition hover:text-zinc-600">
                <i class="fas fa-xmark text-sm"></i>
            </button>
        </div>
    </div>

    {{-- Drawer Body --}}
    <div class="flex-1 overflow-y-auto px-6 py-5 space-y-5">

        {{-- Personal --}}
        <div>
            <p class="mb-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Personal Information</p>
            <div class="grid grid-cols-2 gap-3">
                @foreach([
                    ['Phone', $viewingMember->phone ?: 'Not recorded'],
                    ['Completion Year', $viewingMember->completion_year ?: 'Not recorded'],
                    ['Marital Status', str($viewingMember->marital_status ?: 'Not recorded')->replace('_',' ')->title()],
                    ['Address', $viewingMember->current_address ?: 'Not recorded'],
                ] as [$label, $value])
                <div class="rounded-xl border border-zinc-100 bg-zinc-50 p-3 {{ $label === 'Address' ? 'col-span-2' : '' }}">
                    <p class="text-xs text-zinc-400">{{ $label }}</p>
                    <p class="mt-0.5 text-sm font-semibold text-zinc-800">{{ $value }}</p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Professional --}}
        <div>
            <p class="mb-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Professional Details</p>
            <div class="space-y-3 rounded-xl border border-zinc-100 bg-zinc-50 p-4">
                <div>
                    <p class="text-xs text-zinc-400">Category</p>
                    <p class="text-sm font-semibold text-zinc-800">{{ $viewingMember->occupationTypeLabel() }}</p>
                </div>
                <div>
                    <p class="text-xs text-zinc-400">Job Title</p>
                    <p class="text-sm font-semibold text-zinc-800">{{ $viewingMember->occupation_title ?: 'Not recorded' }}</p>
                </div>
                @if($viewingMember->business_name)
                <div>
                    <p class="text-xs text-zinc-400">Business</p>
                    <p class="text-sm font-semibold text-zinc-800">{{ $viewingMember->business_name }}</p>
                    <p class="text-xs text-zinc-400">{{ $viewingMember->business_nature }}</p>
                </div>
                @endif
            </div>
        </div>

        {{-- Payment --}}
        <div>
            <p class="mb-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Payment Information</p>
            <div class="grid grid-cols-2 gap-3">
                @foreach([
                    ['Status', $viewingMember->paymentStatusLabel()],
                    ['Method', $viewingMember->paymentMethodLabel()],
                    ['Amount', 'UGX '.number_format($viewingMember->amount_paid ?? 0)],
                    ['Payment Phone', $viewingMember->payment_phone ?: '—'],
                ] as [$label, $value])
                <div class="rounded-xl border border-zinc-100 bg-zinc-50 p-3">
                    <p class="text-xs text-zinc-400">{{ $label }}</p>
                    <p class="mt-0.5 text-sm font-bold text-zinc-800">{{ $value }}</p>
                </div>
                @endforeach
            </div>
            @if($viewingMember->payment_reference)
            <div class="mt-3 rounded-xl border border-zinc-100 bg-zinc-50 p-3">
                <p class="text-xs text-zinc-400">Transaction Reference</p>
                <p class="mt-0.5 font-mono text-sm font-semibold text-zinc-800">{{ $viewingMember->payment_reference }}</p>
            </div>
            @endif
        </div>
    </div>

    {{-- Drawer Footer --}}
    <div class="shrink-0 flex items-center justify-between gap-3 border-t border-zinc-100 px-6 py-4">
        <p class="text-xs text-zinc-400">Registered {{ $viewingMember->created_at->format('M j, Y') }}</p>
        <div class="flex gap-2">
            <button wire:click="closeModal"
                    class="rounded-lg border border-zinc-200 px-4 py-2 text-sm font-semibold text-zinc-600 transition hover:border-zinc-300">
                Close
            </button>
            @if($viewingMember->payment_status === 'paid')
                <button wire:click="markPending({{ $viewingMember->id }})"
                        class="rounded-lg border border-amber-200 bg-amber-50 px-4 py-2 text-sm font-semibold text-amber-700 transition hover:bg-amber-100">
                    <i class="fas fa-clock mr-1 text-xs"></i> Set Pending
                </button>
            @else
                <button wire:click="verifyPayment({{ $viewingMember->id }})"
                        class="rounded-lg bg-ecosa-green px-4 py-2 text-sm font-semibold text-white transition hover:bg-ecosa-green-deep">
                    <i class="fas fa-check mr-1 text-xs"></i> Verify &amp; Activate
                </button>
            @endif
        </div>
    </div>
    @endif
</div>
