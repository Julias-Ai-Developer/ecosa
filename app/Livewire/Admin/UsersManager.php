<?php

namespace App\Livewire\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Users Management')]
class UsersManager extends Component
{
    use WithPagination;

    public string $search = '';

    // Drawer state
    public ?int $editingId = null;

    // Form fields
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public bool $isAdmin = false;
    public bool $mustChangePassword = true;
    public array $selectedRoles = [];

    // View profile drawer
    public ?int $viewingId = null;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function newUser(): void
    {
        $this->editingId = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->isAdmin = false;
        $this->mustChangePassword = true;
        $this->selectedRoles = [];
        $this->resetValidation();
    }

    public function editUser(int $id): void
    {
        $user = User::with('roles')->findOrFail($id);
        $this->editingId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = '';
        $this->isAdmin = (bool) $user->is_admin;
        $this->mustChangePassword = (bool) $user->must_change_password;
        $this->selectedRoles = $user->roles->pluck('id')->map(fn ($id) => (string) $id)->all();
        $this->resetValidation();
    }

    public function saveUser(): void
    {
        $rules = [
            'name'    => ['required', 'string', 'min:2', 'max:120'],
            'email'   => ['required', 'email', 'max:160', Rule::unique('users', 'email')->ignore($this->editingId)],
            'isAdmin' => ['boolean'],
            'selectedRoles' => ['array'],
        ];

        if (! $this->editingId) {
            $rules['password'] = ['required', 'string', 'min:8'];
        } elseif (filled($this->password)) {
            $rules['password'] = ['string', 'min:8'];
        }

        $this->validate($rules, [], [
            'name'     => 'full name',
            'email'    => 'email address',
            'password' => 'password',
            'isAdmin'  => 'admin flag',
        ]);

        if ($this->editingId) {
            $user = User::findOrFail($this->editingId);

            $data = [
                'name'                => $this->name,
                'email'               => $this->email,
                'is_admin'            => $this->isAdmin,
                'must_change_password' => $this->mustChangePassword,
            ];

            if (filled($this->password)) {
                $data['password'] = Hash::make($this->password);
            }

            $user->forceFill($data)->save();
        } else {
            $user = User::create([
                'name'                => $this->name,
                'email'               => $this->email,
                'password'            => Hash::make($this->password),
                'is_admin'            => $this->isAdmin,
                'must_change_password' => $this->mustChangePassword,
            ]);
        }

        // Sync roles
        $user->roles()->sync($this->selectedRoles);

        $this->editingId = null;
        $this->reset('name', 'email', 'password', 'selectedRoles');
        $this->isAdmin = false;
        $this->mustChangePassword = true;

        $this->dispatch('notify', message: $this->editingId ? 'User updated.' : 'User created.');
    }

    public function deleteUser(int $id): void
    {
        // Cannot delete yourself
        if ($id === Auth::id()) {
            return;
        }

        User::findOrFail($id)->delete();
        $this->resetPage();
    }

    public function toggleAdmin(int $id): void
    {
        if ($id === Auth::id()) {
            return;
        }

        $user = User::findOrFail($id);
        $user->forceFill(['is_admin' => ! $user->is_admin])->save();
    }

    public function resetPasswordForUser(int $id): void
    {
        $user = User::findOrFail($id);
        $plain = Str::random(12);
        $user->forceFill([
            'password'            => Hash::make($plain),
            'must_change_password' => true,
        ])->save();

        session()->flash('reset_info', "New temporary password for {$user->name}: {$plain}");
    }

    public function viewUser(int $id): void
    {
        $this->viewingId = $id;
    }

    public function closeView(): void
    {
        $this->viewingId = null;
    }

    public function render(): View
    {
        $users = User::with('roles', 'membershipProfile')
            ->when($this->search !== '', function ($q) {
                $s = '%'.$this->search.'%';
                $q->where(fn ($q) => $q->where('name', 'like', $s)->orWhere('email', 'like', $s));
            })
            ->latest()
            ->paginate(15);

        return view('livewire.admin.users-manager', [
            'users'       => $users,
            'allRoles'    => Role::orderBy('name')->get(),
            'viewingUser' => $this->viewingId ? User::with('roles', 'membershipProfile')->find($this->viewingId) : null,
            'totalUsers'  => User::count(),
            'adminCount'  => User::where('is_admin', true)->count(),
            'memberCount' => User::where('is_admin', false)->count(),
        ]);
    }
}
