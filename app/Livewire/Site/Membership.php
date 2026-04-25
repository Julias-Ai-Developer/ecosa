<?php

namespace App\Livewire\Site;

use App\Mail\MembershipRegistered;
use App\Models\MembershipProfile;
use App\Models\User;
use App\Support\EcosaSite;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.site')]
#[Title('Membership')]
class Membership extends Component
{
    public string $fullName = '';

    public string $email = '';

    public string $completionYear = '';

    public string $phone = '';

    public string $currentAddress = '';

    public string $occupationType = 'professional';

    public string $occupationTitle = '';

    public string $businessName = '';

    public string $businessNature = '';

    public string $maritalStatus = 'single';

    public string $paymentMethod = 'mtn_mobile_money';

    public string $paymentReference = '';

    public string $paymentPhone = '';

    public bool $submitted = false;

    public bool $showPaymentModal = false;

    public ?string $submittedMembershipNumber = null;

    public ?string $submittedPaymentStatus = null;

    public function mount(): void
    {
        $this->fullName = trim((string) request()->query('full_name', $this->fullName));
        $this->email = trim((string) request()->query('email', $this->email));
        $this->completionYear = trim((string) request()->query('completion_year', $this->completionYear));
        $this->phone = trim((string) request()->query('phone', $this->phone));
        $this->currentAddress = trim((string) request()->query('current_address', $this->currentAddress));
        $this->occupationTitle = trim((string) request()->query('occupation_title', $this->occupationTitle));
        $this->businessName = trim((string) request()->query('business_name', $this->businessName));
        $this->businessNature = trim((string) request()->query('business_nature', $this->businessNature));
        $this->paymentPhone = trim((string) request()->query('payment_phone', $this->paymentPhone));
        $this->paymentReference = trim((string) request()->query('payment_reference', $this->paymentReference));

        $occupationType = (string) request()->query('occupation_type', $this->occupationType);
        if (array_key_exists($occupationType, $this->occupationTypes())) {
            $this->occupationType = $occupationType;
        }

        $maritalStatus = (string) request()->query('marital_status', $this->maritalStatus);
        if (array_key_exists($maritalStatus, $this->maritalStatuses())) {
            $this->maritalStatus = $maritalStatus;
        }

        $paymentMethod = (string) request()->query('payment_method', $this->paymentMethod);
        if (array_key_exists($paymentMethod, $this->paymentOptions())) {
            $this->paymentMethod = $paymentMethod;
        }
    }

    public function openPaymentModal(): void
    {
        $this->validateRegistrationDetails();

        $this->showPaymentModal = true;
    }

    public function submitRegistration(): void
    {
        $this->openPaymentModal();
    }

    public function completeRegistration(): void
    {
        $this->validateRegistrationDetails();

        $this->validate([
            'paymentMethod' => ['required', Rule::in(array_keys($this->paymentOptions()))],
            'paymentPhone' => ['required_if:paymentMethod,mtn_mobile_money,airtel_money', 'nullable', 'string', 'max:40'],
            'paymentReference' => ['nullable', 'string', 'max:80'],
        ], [], [
            'paymentMethod' => 'payment method',
            'paymentPhone' => 'payment phone number',
            'paymentReference' => 'payment reference',
        ]);

        $email = Str::lower($this->email);

        // Generate a temp password only for brand-new accounts
        $plainPassword = null;
        $existingUser = User::query()->where('email', $email)->first();

        if (! $existingUser) {
            $plainPassword = Str::random(10);
            $user = User::create([
                'name'                 => $this->fullName,
                'email'                => $email,
                'password'             => $plainPassword,
                'must_change_password' => true,
            ]);
        } else {
            $user = $existingUser;
            if ($user->name !== $this->fullName) {
                $user->forceFill(['name' => $this->fullName])->save();
            }
        }

        $existingProfile = MembershipProfile::query()->where('email', $email)->first();

        $profile = $existingProfile ?? new MembershipProfile([
            'email'             => $email,
            'membership_number' => MembershipProfile::nextMembershipNumber(),
        ]);

        $profile->fill([
            'user_id'          => $user->id,
            'full_name'        => $this->fullName,
            'email'            => $email,
            'phone'            => $this->phone,
            'current_address'  => $this->currentAddress,
            'completion_year'  => (int) $this->completionYear,
            'occupation_type'  => $this->occupationType,
            'occupation_title' => $this->occupationTitle,
            'business_name'    => filled($this->businessName) ? $this->businessName : null,
            'business_nature'  => filled($this->businessNature) ? $this->businessNature : null,
            'marital_status'   => $this->maritalStatus,
            'membership_status' => $profile->membership_status ?? 'pending',
            'payment_status'   => 'pending_verification',
            'registration_fee' => MembershipProfile::REGISTRATION_FEE,
            'amount_paid'      => MembershipProfile::REGISTRATION_FEE,
            'payment_method'   => $this->paymentMethod,
            'payment_phone'    => filled($this->paymentPhone) ? $this->paymentPhone : null,
            'payment_reference' => filled($this->paymentReference) ? $this->paymentReference : $this->paymentPhone,
            'paid_at'          => now(),
        ]);
        $profile->save();

        Mail::to($profile->email)->send(new MembershipRegistered($profile, $plainPassword));

        $this->submitted = true;
        $this->showPaymentModal = false;
        $this->submittedMembershipNumber = $profile->membership_number;
        $this->submittedPaymentStatus = $profile->paymentStatusLabel();
        $this->reset(
            'fullName',
            'email',
            'completionYear',
            'phone',
            'currentAddress',
            'occupationTitle',
            'businessName',
            'businessNature',
            'paymentReference',
            'paymentPhone',
        );
        $this->occupationType = 'professional';
        $this->maritalStatus = 'single';
        $this->paymentMethod = 'mtn_mobile_money';
    }

    public function closePaymentModal(): void
    {
        $this->showPaymentModal = false;
    }

    public function paymentOptions(): array
    {
        return EcosaSite::paymentOptions();
    }

    public function occupationTypes(): array
    {
        return EcosaSite::occupationTypes();
    }

    public function maritalStatuses(): array
    {
        return EcosaSite::maritalStatuses();
    }

    private function validateRegistrationDetails(): void
    {
        $this->validate([
            'fullName' => ['required', 'string', 'min:3', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'completionYear' => ['required', 'integer', 'min:1950', 'max:'.date('Y')],
            'phone' => ['required', 'string', 'max:40'],
            'currentAddress' => ['required', 'string', 'min:6', 'max:180'],
            'occupationType' => ['required', Rule::in(array_keys($this->occupationTypes()))],
            'occupationTitle' => ['required', 'string', 'min:2', 'max:120'],
            'businessName' => ['required_if:occupationType,business', 'nullable', 'string', 'max:120'],
            'businessNature' => ['required_if:occupationType,business', 'nullable', 'string', 'max:160'],
            'maritalStatus' => ['required', Rule::in(array_keys($this->maritalStatuses()))],
        ], [], [
            'fullName' => 'full name',
            'completionYear' => 'year of completion',
            'currentAddress' => 'current address',
            'occupationType' => 'professional category',
            'occupationTitle' => 'profession / job title',
            'businessName' => 'business name',
            'businessNature' => 'business nature',
            'maritalStatus' => 'marital status',
        ]);
    }

    public function render(): View
    {
        return view('livewire.site.membership', [
            'organization' => EcosaSite::organization(),
            'benefits' => EcosaSite::membershipBenefits(),
        ]);
    }
}
