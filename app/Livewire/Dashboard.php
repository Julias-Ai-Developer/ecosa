<?php

namespace App\Livewire;

use App\Models\MembershipProfile;
use App\Support\EcosaSite;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Member Portal')]
class Dashboard extends Component
{
    public string $paymentMethod = 'mtn_mobile_money';

    public string $paymentReference = '';

    public bool $paymentRecorded = false;

    public function mount(): void
    {
        $user = Auth::user();

        $profile = MembershipProfile::query()
            ->where('email', $user->email)
            ->first();

        if ($profile && $profile->user_id !== $user->id) {
            $profile->update(['user_id' => $user->id]);
        }
    }

    public function recordPayment(): void
    {
        $profile = $this->membershipProfile();

        if (! $profile) {
            $this->addError('paymentReference', 'Submit a membership application before recording payment.');

            return;
        }

        $this->validate([
            'paymentMethod' => ['required', Rule::in(['mtn_mobile_money', 'airtel_money', 'mastercard'])],
            'paymentReference' => ['required', 'string', 'min:4', 'max:80'],
        ], [], [
            'paymentMethod' => 'payment method',
            'paymentReference' => 'payment reference',
        ]);

        $profile->update([
            'payment_status' => 'pending_verification',
            'amount_paid' => MembershipProfile::REGISTRATION_FEE,
            'payment_method' => $this->paymentMethod,
            'payment_reference' => $this->paymentReference,
            'paid_at' => now(),
        ]);

        $this->paymentRecorded = true;
        $this->paymentReference = '';
    }

    public function render(): View
    {
        return view('livewire.dashboard', [
            'membership' => $this->membershipProfile(),
            'organization' => EcosaSite::organization(),
            'paymentOptions' => EcosaSite::paymentOptions(),
            'user' => Auth::user(),
        ]);
    }

    private function membershipProfile(): ?MembershipProfile
    {
        $user = Auth::user();

        return MembershipProfile::query()
            ->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhere('email', $user->email);
            })
            ->first();
    }
}
