<div x-data="{ showForm: false, showView: false }"
     x-effect="if ($wire.editingId === null && !$wire.name) { showForm = false }">

    {{-- ── Stats row ─────────────────────────────────────────────── --}}
    <div class="mb-6 grid grid-cols-3 gap-4">
        <div class="admin-panel rounded-2xl p-5">
            <p class="text-xs font-bold uppercase tracking-[0.22em] text-zinc-400">Total Users</p>
            <p class="mt-2 text-3xl font-bold text-ecosa-blue-deep">{{ $totalUsers }}</p>
        </div>
        <div class="admin-panel rounded-2xl p-5">
            <p class="text-xs font-bold uppercase tracking-[0.22em] text-zinc-400">Super Admins</p>
            <p class="mt-2 text-3xl font-bold text-ecosa-blue-deep">{{ $adminCount }}</p>
        </div>
        <div class="admin-panel rounded-2xl p-5">
            <p class="text-xs font-bold uppercase tracking-[0.22em] text-zinc-400">Members</p>
            <p class="mt-2 text-3xl font-bold text-ecosa-blue-deep">{{ $memberCount }}</p>
        </div>
    </div>

    {{-- ── Toolbar ─────────────────────────────────────────────────── --}}
    <div class="admin-panel mb-5 flex flex-wrap items-center justify-between gap-3 rounded-2xl p-4">
        <div class="relative flex-1 min-w-[180px]">
            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-xs text-zinc-400"></i>
            <input wire:model.live.debounce.300ms="search" type="search"
                   placeholder="Search by name or email…"
                   class="w-full rounded-xl border border-zinc-200 bg-white py-2 pl-9 pr-4 text-sm text-zinc-700 outline-none focus:border-ecosa-blue focus:ring-2 focus:ring-ecosa-blue/10">
        </div>
        <button @click="$wire.newUser().then(() => showForm = true)"
                class="inline-flex items-center gap-2 rounded-xl bg-ecosa-blue-deep px-4 py-2 text-sm font-bold text-white transition hover:bg-ecosa-blue">
            <i class="fas fa-plus text-xs"></i> New User
        </button>
    </div>

    {{-- ── Flash: reset password info ──────────────────────────────── --}}
    @if (session('reset_info'))
        <div class="mb-4 rounded-2xl border border-ecosa-gold/30 bg-ecosa-gold/10 p-4 text-sm text-ecosa-blue-deep">
            <i class="fas fa-key mr-2 text-ecosa-gold"></i> {{ session('reset_info') }}
        </div>
    @endif

    {{-- ── Users table ─────────────────────────────────────────────── --}}
    <div class="admin-panel overflow-hidden rounded-2xl">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-zinc-100 bg-zinc-50/70 text-left">
                    <th class="px-5 py-3.5 text-xs font-bold uppercase tracking-[0.18em] text-zinc-400">User</th>
                    <th class="hidden px-4 py-3.5 text-xs font-bold uppercase tracking-[0.18em] text-zinc-400 sm:table-cell">Roles</th>
                    <th class="hidden px-4 py-3.5 text-xs font-bold uppercase tracking-[0.18em] text-zinc-400 md:table-cell">Type</th>
                    <th class="hidden px-4 py-3.5 text-xs font-bold uppercase tracking-[0.18em] text-zinc-400 lg:table-cell">Member ID</th>
                    <th class="px-4 py-3.5 text-xs font-bold uppercase tracking-[0.18em] text-zinc-400">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-100">
                @forelse ($users as $user)
                    <tr class="group transition hover:bg-zinc-50/60">
                        {{-- User info --}}
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-ecosa-blue/10 text-xs font-bold text-ecosa-blue-deep">
                                    {{ $user->initials() }}
                                </div>
                                <div class="min-w-0">
                                    <p class="truncate font-semibold text-zinc-900">{{ $user->name }}</p>
                                    <p class="truncate text-xs text-zinc-400">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        {{-- Roles --}}
                        <td class="hidden px-4 py-3.5 sm:table-cell">
                            <div class="flex flex-wrap gap-1">
                                @foreach ($user->roles as $role)
                                    <span class="rounded-full bg-ecosa-blue/8 px-2.5 py-0.5 text-[0.65rem] font-bold text-ecosa-blue-deep">
                                        {{ $role->name }}
                                    </span>
                                @endforeach
                                @if ($user->roles->isEmpty() && ! $user->is_admin)
                                    <span class="text-xs text-zinc-300">—</span>
                                @endif
                            </div>
                        </td>
                        {{-- Type --}}
                        <td class="hidden px-4 py-3.5 md:table-cell">
                            @if ($user->is_admin)
                                <span class="inline-flex items-center gap-1 rounded-full bg-ecosa-gold/20 px-2.5 py-0.5 text-[0.65rem] font-bold text-ecosa-blue-deep">
                                    <i class="fas fa-shield-halved text-ecosa-gold"></i> Super Admin
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 rounded-full bg-ecosa-green/10 px-2.5 py-0.5 text-[0.65rem] font-bold text-ecosa-green-deep">
                                    <i class="fas fa-user"></i> Member
                                </span>
                            @endif
                            @if ($user->must_change_password)
                                <span class="ml-1 inline-flex items-center gap-1 rounded-full bg-amber-50 px-2 py-0.5 text-[0.6rem] font-bold text-amber-600">
                                    <i class="fas fa-key"></i> Must Reset
                                </span>
                            @endif
                        </td>
                        {{-- Member ID --}}
                        <td class="hidden px-4 py-3.5 text-xs text-zinc-500 lg:table-cell">
                            {{ $user->membershipProfile?->membership_number ?? '—' }}
                        </td>
                        {{-- Actions --}}
                        <td class="px-4 py-3.5">
                            <div class="flex items-center gap-1">
                                <button title="View details"
                                        @click="$wire.viewUser({{ $user->id }}).then(() => showView = true)"
                                        class="flex h-8 w-8 items-center justify-center rounded-lg text-zinc-400 transition hover:bg-ecosa-blue/8 hover:text-ecosa-blue">
                                    <i class="fas fa-eye text-xs"></i>
                                </button>
                                <button title="Edit user"
                                        @click="$wire.editUser({{ $user->id }}).then(() => showForm = true)"
                                        class="flex h-8 w-8 items-center justify-center rounded-lg text-zinc-400 transition hover:bg-ecosa-blue/8 hover:text-ecosa-blue">
                                    <i class="fas fa-pen text-xs"></i>
                                </button>
                                @if (auth()->id() !== $user->id)
                                    <button title="{{ $user->is_admin ? 'Remove super-admin' : 'Make super-admin' }}"
                                            wire:click="toggleAdmin({{ $user->id }})"
                                            wire:confirm="Toggle super-admin status for {{ $user->name }}?"
                                            class="flex h-8 w-8 items-center justify-center rounded-lg text-zinc-400 transition hover:bg-ecosa-gold/15 hover:text-ecosa-gold">
                                        <i class="fas fa-shield-halved text-xs"></i>
                                    </button>
                                    <button title="Reset password"
                                            wire:click="resetPasswordForUser({{ $user->id }})"
                                            wire:confirm="Generate a new temporary password for {{ $user->name }}?"
                                            class="flex h-8 w-8 items-center justify-center rounded-lg text-zinc-400 transition hover:bg-amber-50 hover:text-amber-600">
                                        <i class="fas fa-key text-xs"></i>
                                    </button>
                                    <button title="Delete user"
                                            wire:click="deleteUser({{ $user->id }})"
                                            wire:confirm="Permanently delete {{ $user->name }}? This cannot be undone."
                                            class="flex h-8 w-8 items-center justify-center rounded-lg text-zinc-400 transition hover:bg-red-50 hover:text-red-500">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-12 text-center text-sm text-zinc-400">
                            <i class="fas fa-users mb-3 block text-3xl text-zinc-200"></i>
                            No users found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if ($users->hasPages())
            <div class="border-t border-zinc-100 px-5 py-4">
                {{ $users->links() }}
            </div>
        @endif
    </div>

    {{-- ════════════════════════════════════════════════════════════ --}}
    {{-- CREATE / EDIT DRAWER                                         --}}
    {{-- ════════════════════════════════════════════════════════════ --}}
    <div x-show="showForm"
         x-cloak
         class="fixed inset-0 z-50 flex justify-end"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">

        <div class="absolute inset-0 bg-black/30" @click="showForm = false"></div>

        <div class="relative z-10 flex h-full w-full flex-col bg-white shadow-2xl sm:max-w-[460px]"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full">

            {{-- Drawer header --}}
            <div class="shrink-0 border-b border-zinc-100 px-6 py-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.22em] text-zinc-400">
                            {{ $editingId ? 'Edit User' : 'Create User' }}
                        </p>
                        <h2 class="mt-0.5 text-lg font-bold text-zinc-900">
                            {{ $editingId ? 'Update user account' : 'Add new user account' }}
                        </h2>
                    </div>
                    <button @click="showForm = false"
                            class="flex h-9 w-9 items-center justify-center rounded-xl border border-zinc-200 text-zinc-500 transition hover:border-zinc-300 hover:text-zinc-700">
                        <i class="fas fa-xmark text-sm"></i>
                    </button>
                </div>
            </div>

            {{-- Drawer body --}}
            <form wire:submit="saveUser" class="flex flex-1 flex-col overflow-hidden">
                <div class="flex-1 space-y-5 overflow-y-auto p-6">

                    <div>
                        <label class="mb-1.5 block text-xs font-bold uppercase tracking-[0.18em] text-zinc-400">Full Name</label>
                        <input wire:model="name" type="text" placeholder="Full name"
                               class="w-full rounded-xl border border-zinc-200 px-4 py-2.5 text-sm text-zinc-800 outline-none transition focus:border-ecosa-blue focus:ring-2 focus:ring-ecosa-blue/10">
                        @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="mb-1.5 block text-xs font-bold uppercase tracking-[0.18em] text-zinc-400">Email Address</label>
                        <input wire:model="email" type="email" placeholder="email@example.com"
                               class="w-full rounded-xl border border-zinc-200 px-4 py-2.5 text-sm text-zinc-800 outline-none transition focus:border-ecosa-blue focus:ring-2 focus:ring-ecosa-blue/10">
                        @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="mb-1.5 block text-xs font-bold uppercase tracking-[0.18em] text-zinc-400">
                            Password @if($editingId) <span class="font-normal normal-case tracking-normal text-zinc-400">(leave blank to keep current)</span> @endif
                        </label>
                        <input wire:model="password" type="password"
                               placeholder="{{ $editingId ? 'New password (optional)' : 'Minimum 8 characters' }}"
                               class="w-full rounded-xl border border-zinc-200 px-4 py-2.5 text-sm text-zinc-800 outline-none transition focus:border-ecosa-blue focus:ring-2 focus:ring-ecosa-blue/10">
                        @error('password') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    {{-- Flags --}}
                    <div class="space-y-3 rounded-2xl border border-zinc-100 bg-zinc-50/60 p-4">
                        <label class="flex cursor-pointer items-center gap-3">
                            <input type="checkbox" wire:model.live="isAdmin"
                                   class="h-4 w-4 rounded accent-ecosa-blue">
                            <div>
                                <p class="text-sm font-semibold text-zinc-800">Super Admin</p>
                                <p class="text-xs text-zinc-500">Full system access, bypasses all role checks.</p>
                            </div>
                        </label>
                        <label class="flex cursor-pointer items-center gap-3">
                            <input type="checkbox" wire:model="mustChangePassword"
                                   class="h-4 w-4 rounded accent-ecosa-blue">
                            <div>
                                <p class="text-sm font-semibold text-zinc-800">Must change password on first login</p>
                                <p class="text-xs text-zinc-500">User will be redirected to set a new password.</p>
                            </div>
                        </label>
                    </div>

                    {{-- Roles --}}
                    @if (! $isAdmin)
                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-[0.18em] text-zinc-400">Assign Roles</label>
                            @if ($allRoles->isEmpty())
                                <p class="text-xs text-zinc-400">No roles defined yet. Create roles in Roles & Access.</p>
                            @else
                                <div class="space-y-2">
                                    @foreach ($allRoles as $role)
                                        <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-zinc-100 bg-white p-3 transition hover:border-ecosa-blue/20">
                                            <input type="checkbox" value="{{ $role->id }}"
                                                   wire:model="selectedRoles"
                                                   class="mt-0.5 h-4 w-4 rounded accent-ecosa-blue">
                                            <div>
                                                <p class="text-sm font-semibold text-zinc-800">{{ $role->name }}</p>
                                                @if ($role->description)
                                                    <p class="text-xs text-zinc-400">{{ $role->description }}</p>
                                                @endif
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif

                </div>

                {{-- Drawer footer --}}
                <div class="shrink-0 border-t border-zinc-100 p-5 flex justify-end gap-3">
                    <button type="button" @click="showForm = false"
                            class="rounded-xl border border-zinc-200 px-5 py-2.5 text-sm font-semibold text-zinc-600 transition hover:border-zinc-300">
                        Cancel
                    </button>
                    <button type="submit"
                            class="rounded-xl bg-ecosa-blue-deep px-5 py-2.5 text-sm font-bold text-white transition hover:bg-ecosa-blue"
                            wire:loading.attr="disabled">
                        <span wire:loading.remove>{{ $editingId ? 'Save Changes' : 'Create User' }}</span>
                        <span wire:loading>Saving…</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════════════════ --}}
    {{-- VIEW USER DRAWER                                             --}}
    {{-- ════════════════════════════════════════════════════════════ --}}
    <div x-show="showView"
         x-cloak
         class="fixed inset-0 z-50 flex justify-end"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">

        <div class="absolute inset-0 bg-black/25" @click="$wire.closeView(); showView = false"></div>

        <div class="relative z-10 flex h-full w-full flex-col overflow-y-auto bg-white shadow-2xl sm:max-w-[420px]"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full">

            @if ($viewingUser)
                <div class="shrink-0 border-b border-zinc-100 bg-ecosa-blue-deep px-6 py-6 text-white">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-white/15 text-xl font-bold text-white">
                                {{ $viewingUser->initials() }}
                            </div>
                            <div>
                                <p class="text-lg font-bold">{{ $viewingUser->name }}</p>
                                <p class="text-sm text-white/60">{{ $viewingUser->email }}</p>
                            </div>
                        </div>
                        <button @click="$wire.closeView(); showView = false"
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full border border-white/15 text-white/60 transition hover:bg-white/10 hover:text-white">
                            <i class="fas fa-xmark text-sm"></i>
                        </button>
                    </div>
                    <div class="mt-4 flex flex-wrap gap-2">
                        @if ($viewingUser->is_admin)
                            <span class="rounded-full bg-ecosa-gold/25 px-3 py-1 text-xs font-bold text-ecosa-gold">Super Admin</span>
                        @endif
                        @foreach ($viewingUser->roles as $role)
                            <span class="rounded-full bg-white/15 px-3 py-1 text-xs font-bold text-white/80">{{ $role->name }}</span>
                        @endforeach
                        @if ($viewingUser->must_change_password)
                            <span class="rounded-full bg-amber-400/25 px-3 py-1 text-xs font-bold text-amber-200">Must Reset Password</span>
                        @endif
                    </div>
                </div>

                <div class="flex-1 space-y-5 p-6">
                    @php $profile = $viewingUser->membershipProfile; @endphp

                    <div class="rounded-2xl border border-zinc-100 p-4 space-y-3">
                        <p class="text-xs font-bold uppercase tracking-[0.22em] text-zinc-400">Account</p>
                        <div class="grid gap-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-zinc-500">User ID</span>
                                <span class="font-semibold text-zinc-800">#{{ $viewingUser->id }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-zinc-500">Joined</span>
                                <span class="font-semibold text-zinc-800">{{ $viewingUser->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-zinc-500">Email verified</span>
                                <span class="font-semibold {{ $viewingUser->email_verified_at ? 'text-ecosa-green-deep' : 'text-amber-600' }}">
                                    {{ $viewingUser->email_verified_at ? 'Yes' : 'No' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    @if ($profile)
                        <div class="rounded-2xl border border-zinc-100 p-4 space-y-3">
                            <p class="text-xs font-bold uppercase tracking-[0.22em] text-zinc-400">Membership Profile</p>
                            <div class="grid gap-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-zinc-500">Member ID</span>
                                    <span class="font-bold text-ecosa-blue-deep">{{ $profile->membership_number }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-zinc-500">Phone</span>
                                    <span class="font-semibold text-zinc-800">{{ $profile->phone ?? '—' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-zinc-500">Completion year</span>
                                    <span class="font-semibold text-zinc-800">{{ $profile->completion_year ?? '—' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-zinc-500">Membership</span>
                                    <span class="font-semibold capitalize text-zinc-800">{{ $profile->membership_status }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-zinc-500">Payment</span>
                                    <span class="font-semibold capitalize text-zinc-800">{{ $profile->paymentStatusLabel() }}</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Quick actions --}}
                    <div class="flex flex-wrap gap-3">
                        <button @click="$wire.editUser({{ $viewingUser->id }}).then(() => { showView = false; showForm = true })"
                                class="flex-1 rounded-xl border border-ecosa-blue/20 bg-ecosa-blue/5 px-4 py-2.5 text-sm font-bold text-ecosa-blue-deep transition hover:bg-ecosa-blue/10">
                            <i class="fas fa-pen mr-1"></i> Edit User
                        </button>
                        @if (auth()->id() !== $viewingUser->id)
                            <button wire:click="resetPasswordForUser({{ $viewingUser->id }})"
                                    wire:confirm="Generate a new temporary password for {{ $viewingUser->name }}?"
                                    @click="showView = false"
                                    class="flex-1 rounded-xl border border-amber-200 bg-amber-50 px-4 py-2.5 text-sm font-bold text-amber-700 transition hover:bg-amber-100">
                                <i class="fas fa-key mr-1"></i> Reset Password
                            </button>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

</div>
