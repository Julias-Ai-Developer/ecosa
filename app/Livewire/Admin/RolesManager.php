<?php

namespace App\Livewire\Admin;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Roles & Access')]
class RolesManager extends Component
{
    // Role form
    public string $roleName = '';
    public string $roleDescription = '';
    public array $rolePermissions = [];
    public ?int $editingRoleId = null;
    public bool $roleSaved = false;

    // User assignment
    public ?int $assigningUserId = null;
    public array $assignedRoles = [];
    public bool $assignSaved = false;

    public function newRole(): void
    {
        $this->reset('roleName', 'roleDescription', 'rolePermissions', 'editingRoleId', 'roleSaved');
        $this->resetValidation();
    }

    public function editRole(int $id): void
    {
        $role = Role::with('permissions')->findOrFail($id);
        $this->editingRoleId = $id;
        $this->roleName = $role->name;
        $this->roleDescription = $role->description ?? '';
        $this->rolePermissions = $role->permissions->pluck('id')->map(fn ($v) => (string) $v)->all();
        $this->roleSaved = false;
        $this->resetValidation();
    }

    public function saveRole(): void
    {
        $this->validate([
            'roleName'        => ['required', 'string', 'max:80'],
            'roleDescription' => ['nullable', 'string', 'max:200'],
            'rolePermissions' => ['array'],
        ]);

        $data = [
            'name'        => trim($this->roleName),
            'description' => trim($this->roleDescription) ?: null,
        ];

        if ($this->editingRoleId) {
            $role = Role::findOrFail($this->editingRoleId);
            $role->update($data);
        } else {
            $data['slug'] = \Illuminate\Support\Str::slug($this->roleName);
            $role = Role::create($data);
        }

        $role->permissions()->sync($this->rolePermissions);

        $this->reset('roleName', 'roleDescription', 'rolePermissions', 'editingRoleId');
        $this->roleSaved = true;
    }

    public function deleteRole(int $id): void
    {
        Role::where('is_system', false)->whereKey($id)->delete();
    }

    public function openAssign(int $userId): void
    {
        $user = User::with('roles')->findOrFail($userId);
        $this->assigningUserId = $userId;
        $this->assignedRoles = $user->roles->pluck('id')->map(fn ($v) => (string) $v)->all();
        $this->assignSaved = false;
    }

    public function closeAssign(): void
    {
        $this->assigningUserId = null;
    }

    public function saveAssignment(): void
    {
        $user = User::findOrFail($this->assigningUserId);
        $user->roles()->sync($this->assignedRoles);
        $this->assignSaved = true;
    }

    public function render(): View
    {
        return view('livewire.admin.roles-manager', [
            'roles'       => Role::with('permissions')->withCount('users')->get(),
            'permissions' => Permission::orderBy('group')->orderBy('name')->get()->groupBy('group'),
            'users'       => User::with('roles')->latest()->get(),
            'assigningUser' => $this->assigningUserId
                ? User::with('roles')->find($this->assigningUserId)
                : null,
        ]);
    }
}
