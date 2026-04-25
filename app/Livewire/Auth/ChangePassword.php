<?php

namespace App\Livewire\Auth;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.auth.simple')]
#[Title('Set Your Password')]
class ChangePassword extends Component
{
    public string $password = '';
    public string $password_confirmation = '';

    public function save(): void
    {
        $this->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        // Pass plain password — the model's 'hashed' cast will hash it once
        $user->forceFill([
            'password'             => $this->password,
            'must_change_password' => false,
        ])->save();

        // Re-login so the auth session holds the refreshed model instantly
        Auth::login($user->fresh());

        $destination = $user->canAccessAdmin()
            ? route('admin.dashboard')
            : route('dashboard');

        $this->redirect($destination);
    }

    public function render(): View
    {
        return view('livewire.auth.change-password');
    }
}
