<div x-data="{ showRole: false, showAssign: false }"
     x-effect="
        if ($wire.roleSaved)   { setTimeout(() => { showRole   = false }, 800) }
        if ($wire.assignSaved) { setTimeout(() => { showAssign = false }, 800) }
     ">

    {{-- Page Toolbar --}}
    <div class="mb-5 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-base font-bold text-zinc-900">Roles &amp; Access Control</h2>
            <p class="mt-0.5 text-xs text-zinc-500">Define roles, assign permissions, and control who can access each admin section</p>
        </div>
        <button type="button" @click="$wire.newRole().then(() => showRole = true)"
                class="inline-flex shrink-0 items-center gap-2 rounded-lg bg-ecosa-green px-4 py-2 text-sm font-semibold text-white transition hover:bg-ecosa-green-deep">
            <i class="fas fa-plus text-xs"></i> New Role
        </button>
    </div>

    <div class="grid gap-6 xl:grid-cols-[1fr_1.1fr]">

        {{-- Roles Table --}}
        <div class="overflow-hidden rounded-2xl border border-zinc-100 bg-white shadow-sm">
            <div class="border-b border-zinc-100 px-6 py-4">
                <p class="text-sm font-bold text-zinc-900">Defined Roles</p>
                <p class="mt-0.5 text-xs text-zinc-500">Each role bundles a set of permissions</p>
            </div>
            @if($roles->isEmpty())
                <div class="px-6 py-14 text-center">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-zinc-100">
                        <i class="fas fa-shield-halved text-2xl text-zinc-300"></i>
                    </div>
                    <p class="mt-3 text-sm text-zinc-500">No roles defined yet.</p>
                </div>
            @else
                <table class="w-full text-left text-sm">
                    <thead class="border-b border-zinc-100 bg-zinc-50">
                        <tr>
                            <th class="px-5 py-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Role</th>
                            <th class="px-5 py-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Permissions</th>
                            <th class="px-5 py-3 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Users</th>
                            <th class="px-5 py-3 text-right text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-50">
                        @foreach($roles as $role)
                        <tr class="transition hover:bg-zinc-50">
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-2">
                                    <p class="font-semibold text-zinc-900">{{ $role->name }}</p>
                                    @if($role->is_system)
                                        <span class="rounded-full bg-ecosa-blue/8 px-2 py-0.5 text-[0.6rem] font-bold uppercase tracking-wide text-ecosa-blue">system</span>
                                    @endif
                                </div>
                                @if($role->description)
                                    <p class="mt-0.5 text-xs text-zinc-400">{{ $role->description }}</p>
                                @endif
                            </td>
                            <td class="px-5 py-3.5">
                                <span class="text-sm font-semibold text-zinc-700">{{ $role->permissions->count() }}</span>
                                <span class="text-xs text-zinc-400"> permission{{ $role->permissions->count() !== 1 ? 's' : '' }}</span>
                            </td>
                            <td class="px-5 py-3.5 text-sm text-zinc-600">{{ $role->users_count }}</td>
                            <td class="px-5 py-3.5 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button"
                                            @click="$wire.editRole({{ $role->id }}).then(() => showRole = true)"
                                            class="flex h-8 w-8 items-center justify-center rounded-lg border border-zinc-200 text-zinc-500 transition hover:border-ecosa-green hover:text-ecosa-green"
                                            title="Edit role">
                                        <i class="fas fa-pen text-xs"></i>
                                    </button>
                                    @if(!$role->is_system)
                                        <button type="button"
                                                wire:click="deleteRole({{ $role->id }})"
                                                wire:confirm="Delete role '{{ addslashes($role->name) }}'? Users with this role will lose access."
                                                class="flex h-8 w-8 items-center justify-center rounded-lg border border-rose-100 bg-rose-50 text-rose-500 transition hover:bg-rose-100"
                                                title="Delete">
                                            <i class="fas fa-trash-can text-xs"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        {{-- User Role Assignment --}}
        <div class="overflow-hidden rounded-2xl border border-zinc-100 bg-white shadow-sm">
            <div class="border-b border-zinc-100 px-6 py-4">
                <p class="text-sm font-bold text-zinc-900">User Access</p>
                <p class="mt-0.5 text-xs text-zinc-500">Assign roles to individual users</p>
            </div>
            @if($users->isEmpty())
                <div class="px-6 py-14 text-center">
                    <p class="text-sm text-zinc-500">No users in the system yet.</p>
                </div>
            @else
                <div class="divide-y divide-zinc-50">
                    @foreach($users as $u)
                    <div class="flex items-center justify-between gap-4 px-6 py-3.5 transition hover:bg-zinc-50">
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-semibold text-zinc-900">{{ $u->name }}</p>
                            <p class="truncate text-xs text-zinc-400">{{ $u->email }}</p>
                            <div class="mt-1 flex flex-wrap gap-1">
                                @if($u->is_admin)
                                    <span class="rounded-full bg-ecosa-green/10 px-2 py-0.5 text-[0.6rem] font-bold uppercase tracking-wide text-ecosa-green-deep">Super Admin</span>
                                @endif
                                @foreach($u->roles as $r)
                                    <span class="rounded-full bg-ecosa-blue/8 px-2 py-0.5 text-[0.6rem] font-bold uppercase tracking-wide text-ecosa-blue">{{ $r->name }}</span>
                                @endforeach
                                @if(!$u->is_admin && $u->roles->isEmpty())
                                    <span class="rounded-full bg-zinc-100 px-2 py-0.5 text-[0.6rem] font-bold uppercase tracking-wide text-zinc-400">No Role</span>
                                @endif
                            </div>
                        </div>
                        @if(!$u->is_admin)
                            <button type="button"
                                    @click="$wire.openAssign({{ $u->id }}).then(() => showAssign = true)"
                                    class="shrink-0 rounded-lg border border-zinc-200 px-3 py-1.5 text-xs font-semibold text-zinc-600 transition hover:border-ecosa-green hover:text-ecosa-green">
                                Assign Roles
                            </button>
                        @endif
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    {{-- ─── Role Form Drawer ─────────────────────────────────────────── --}}
    <div x-show="showRole" x-cloak
         x-transition:enter="transition duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-40 bg-black/40 backdrop-blur-sm"
         @click="showRole = false"></div>

    <div x-show="showRole" x-cloak
         x-transition:enter="transition duration-300 ease-out" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
         x-transition:leave="transition duration-200 ease-in" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
         class="fixed inset-y-0 right-0 z-50 flex w-full max-w-lg flex-col bg-white shadow-2xl"
         @keydown.escape.window="showRole = false">

        <div class="flex shrink-0 items-center justify-between border-b border-zinc-100 px-6 py-5">
            <div>
                <h3 class="text-base font-bold text-zinc-900">{{ $editingRoleId ? 'Edit Role' : 'New Role' }}</h3>
                <p class="mt-0.5 text-xs text-zinc-500">{{ $editingRoleId ? 'Update name and permissions' : 'Define a new role and pick its permissions' }}</p>
            </div>
            <button type="button" @click="showRole = false"
                    class="flex h-8 w-8 items-center justify-center rounded-lg border border-zinc-200 text-zinc-400 transition hover:text-zinc-600">
                <i class="fas fa-xmark text-sm"></i>
            </button>
        </div>

        <form wire:submit.prevent="saveRole" class="flex flex-1 flex-col overflow-hidden">
            <div class="flex-1 overflow-y-auto px-6 py-5 space-y-5">

                @if($roleSaved)
                    <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                        <i class="fas fa-check mr-1.5"></i> Role saved successfully.
                    </div>
                @endif

                <div>
                    <label class="mb-1.5 block text-xs font-semibold text-zinc-700">Role Name</label>
                    <input type="text" wire:model.blur="roleName"
                           class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:border-ecosa-green focus:outline-none focus:ring-1 focus:ring-ecosa-green/30"
                           placeholder="e.g. Treasurer, Editor, Viewer">
                    @error('roleName') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-semibold text-zinc-700">Description <span class="font-normal text-zinc-400">(optional)</span></label>
                    <input type="text" wire:model.blur="roleDescription"
                           class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:border-ecosa-green focus:outline-none focus:ring-1 focus:ring-ecosa-green/30"
                           placeholder="Short description of what this role can do">
                </div>

                {{-- Permissions grouped --}}
                <div>
                    <label class="mb-3 block text-xs font-semibold text-zinc-700">Permissions</label>
                    <div class="space-y-4">
                        @foreach($permissions as $group => $perms)
                        <div class="rounded-xl border border-zinc-100 bg-zinc-50 px-4 py-3">
                            <p class="mb-2.5 text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">{{ $group }}</p>
                            <div class="space-y-2">
                                @foreach($perms as $perm)
                                <label class="flex cursor-pointer items-center gap-3">
                                    <input type="checkbox"
                                           wire:model="rolePermissions"
                                           value="{{ $perm->id }}"
                                           class="h-4 w-4 rounded border-zinc-300 accent-ecosa-green">
                                    <span class="text-sm text-zinc-800">{{ $perm->name }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="shrink-0 flex justify-end gap-3 border-t border-zinc-100 px-6 py-4">
                <button type="button" @click="showRole = false"
                        class="rounded-lg border border-zinc-200 px-4 py-2 text-sm font-semibold text-zinc-600 transition hover:border-zinc-300">
                    Cancel
                </button>
                <button type="submit"
                        class="inline-flex items-center gap-2 rounded-lg bg-ecosa-green px-5 py-2 text-sm font-semibold text-white transition hover:bg-ecosa-green-deep"
                        wire:loading.attr="disabled" wire:target="saveRole">
                    <span wire:loading.remove wire:target="saveRole">
                        <i class="fas fa-shield-halved text-xs"></i>
                        {{ $editingRoleId ? 'Save Changes' : 'Create Role' }}
                    </span>
                    <span wire:loading wire:target="saveRole">Saving...</span>
                </button>
            </div>
        </form>
    </div>

    {{-- ─── Assign Roles Drawer ──────────────────────────────────────── --}}
    <div x-show="showAssign" x-cloak
         x-transition:enter="transition duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-40 bg-black/40 backdrop-blur-sm"
         @click="showAssign = false; $wire.closeAssign()"></div>

    <div x-show="showAssign" x-cloak
         x-transition:enter="transition duration-300 ease-out" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
         x-transition:leave="transition duration-200 ease-in" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
         class="fixed inset-y-0 right-0 z-50 flex w-full max-w-md flex-col bg-white shadow-2xl"
         @keydown.escape.window="showAssign = false; $wire.closeAssign()">

        <div class="flex shrink-0 items-center justify-between border-b border-zinc-100 px-6 py-5">
            <div>
                <h3 class="text-base font-bold text-zinc-900">Assign Roles</h3>
                @if($assigningUser)
                    <p class="mt-0.5 text-xs text-zinc-500">{{ $assigningUser->name }} &mdash; {{ $assigningUser->email }}</p>
                @endif
            </div>
            <button type="button" @click="showAssign = false; $wire.closeAssign()"
                    class="flex h-8 w-8 items-center justify-center rounded-lg border border-zinc-200 text-zinc-400 transition hover:text-zinc-600">
                <i class="fas fa-xmark text-sm"></i>
            </button>
        </div>

        <div class="flex flex-1 flex-col overflow-hidden">
            <div class="flex-1 overflow-y-auto px-6 py-5 space-y-3">

                @if($assignSaved)
                    <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                        <i class="fas fa-check mr-1.5"></i> Roles updated successfully.
                    </div>
                @endif

                <p class="text-xs font-semibold text-zinc-500">Select the roles this user should have:</p>

                @foreach($roles as $role)
                <label class="flex cursor-pointer items-start gap-4 rounded-xl border p-4 transition
                              {{ in_array((string)$role->id, $assignedRoles) ? 'border-ecosa-green bg-ecosa-green/5' : 'border-zinc-200 hover:border-zinc-300' }}">
                    <input type="checkbox"
                           wire:model.live="assignedRoles"
                           value="{{ $role->id }}"
                           class="mt-0.5 h-4 w-4 rounded border-zinc-300 accent-ecosa-green">
                    <div>
                        <div class="flex items-center gap-2">
                            <p class="text-sm font-semibold text-zinc-900">{{ $role->name }}</p>
                            @if($role->is_system)
                                <span class="rounded-full bg-zinc-100 px-1.5 py-0.5 text-[0.55rem] font-bold uppercase tracking-wide text-zinc-400">system</span>
                            @endif
                        </div>
                        @if($role->description)
                            <p class="mt-0.5 text-xs text-zinc-400">{{ $role->description }}</p>
                        @endif
                        <p class="mt-1 text-xs text-zinc-400">{{ $role->permissions->count() }} permission{{ $role->permissions->count() !== 1 ? 's' : '' }}</p>
                    </div>
                </label>
                @endforeach
            </div>

            <div class="shrink-0 flex justify-end gap-3 border-t border-zinc-100 px-6 py-4">
                <button type="button" @click="showAssign = false; $wire.closeAssign()"
                        class="rounded-lg border border-zinc-200 px-4 py-2 text-sm font-semibold text-zinc-600 transition hover:border-zinc-300">
                    Cancel
                </button>
                <button type="button" wire:click="saveAssignment"
                        class="inline-flex items-center gap-2 rounded-lg bg-ecosa-green px-5 py-2 text-sm font-semibold text-white transition hover:bg-ecosa-green-deep"
                        wire:loading.attr="disabled" wire:target="saveAssignment">
                    <span wire:loading.remove wire:target="saveAssignment"><i class="fas fa-check text-xs"></i> Save</span>
                    <span wire:loading wire:target="saveAssignment">Saving...</span>
                </button>
            </div>
        </div>
    </div>

</div>
