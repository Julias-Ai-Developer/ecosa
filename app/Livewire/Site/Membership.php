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

    public string $paymentPurpose = 'membership';

    public string $paymentMethod = 'mtn_mobile_money';

    public string $paymentAmount = '20000';

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
        $this->paymentAmount = trim((string) request()->query('payment_amount', $this->paymentAmount));
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

        $paymentPurpose = (string) request()->query('payment_purpose', $this->paymentPurpose);
        if (array_key_exists($paymentPurpose, $this->paymentPurposeOptions())) {
            $this->paymentPurpose = $paymentPurpose;
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

    public function updatedPaymentPurpose(): void
    {
        $this->paymentAmount = $this->paymentPurpose === 'membership'
            ? (string) MembershipProfile::REGISTRATION_FEE
            : '';
    }

    public function completeRegistration(): void
    {
        $this->validateRegistrationDetails();

        $this->validate([
            'paymentMethod' => ['required', Rule::in(array_keys($this->paymentOptions()))],
            'paymentPurpose' => ['required', Rule::in(array_keys($this->paymentPurposeOptions()))],
            'paymentAmount' => ['required', 'integer', 'min:1'],
            'paymentPhone' => ['required_if:paymentMethod,mtn_mobile_money,airtel_money', 'nullable', 'string', 'max:40'],
            'paymentReference' => ['nullable', 'string', 'max:80'],
        ], [], [
            'paymentMethod' => 'payment method',
            'paymentPurpose' => 'payment purpose',
            'paymentAmount' => 'payment amount',
            'paymentPhone' => 'payment phone number',
            'paymentReference' => 'payment reference',
        ]);

        $email = Str::lower($this->email);

        $plainPassword = null;
        $existingUser = User::query()->where('email', $email)->first();
        $user = $existingUser;

        // Generate portal credentials only for actual membership registration.
        if (! $existingUser && $this->paymentPurpose === 'membership') {
            $plainPassword = Str::random(10);
            $user = User::create([
                'name'                 => $this->fullName,
                'email'                => $email,
                'password'             => $plainPassword,
                'must_change_password' => true,
            ]);
        } elseif ($user) {
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
            'user_id'          => $user?->id,
            'full_name'        => $this->fullName,
            'email'            => $email,
            'phone'            => $this->phone,
            'current_address'  => $this->currentAddress,
            'completion_year'  => filled($this->completionYear) ? (int) $this->completionYear : null,
            'occupation_type'  => $this->occupationType,
            'occupation_title' => $this->occupationTitle,
            'business_name'    => filled($this->businessName) ? $this->businessName : null,
            'business_nature'  => filled($this->businessNature) ? $this->businessNature : null,
            'marital_status'   => $this->maritalStatus,
            'membership_status' => $profile->membership_status ?? 'pending',
            'payment_status'   => 'pending_verification',
            'payment_purpose'  => $this->paymentPurpose,
            'registration_fee' => MembershipProfile::REGISTRATION_FEE,
            'amount_paid'      => (int) $this->paymentAmount,
            'payment_method'   => $this->paymentMethod,
            'payment_phone'    => filled($this->paymentPhone) ? $this->paymentPhone : null,
            'payment_reference' => filled($this->paymentReference) ? $this->paymentReference : $this->paymentPhone,
            'paid_at'          => now(),
        ]);
        $profile->save();

        if ($this->paymentPurpose === 'membership') {
            Mail::to($profile->email)->send(new MembershipRegistered($profile, $plainPassword));
        }

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
            'paymentAmount',
            'paymentReference',
            'paymentPhone',
        );
        $this->occupationType = 'professional';
        $this->maritalStatus = 'single';
        $this->paymentPurpose = 'membership';
        $this->paymentAmount = (string) MembershipProfile::REGISTRATION_FEE;
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

    public function paymentPurposeOptions(): array
    {
        return EcosaSite::paymentPurposeOptions();
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
        $membershipRules = $this->paymentPurpose === 'membership'
            ? [
                'completionYear' => ['required', 'integer', 'min:1950', 'max:'.date('Y')],
                'occupationType' => ['required', Rule::in(array_keys($this->occupationTypes()))],
                'occupationTitle' => ['required', 'string', 'min:2', 'max:120'],
                'businessName' => ['required_if:occupationType,business', 'nullable', 'string', 'max:120'],
                'businessNature' => ['required_if:occupationType,business', 'nullable', 'string', 'max:160'],
                'maritalStatus' => ['required', Rule::in(array_keys($this->maritalStatuses()))],
            ]
            : [
                'completionYear' => ['nullable', 'integer', 'min:1950', 'max:'.date('Y')],
                'occupationType' => ['nullable', Rule::in(array_keys($this->occupationTypes()))],
                'occupationTitle' => ['nullable', 'string', 'max:120'],
                'businessName' => ['nullable', 'string', 'max:120'],
                'businessNature' => ['nullable', 'string', 'max:160'],
                'maritalStatus' => ['nullable', Rule::in(array_keys($this->maritalStatuses()))],
            ];

        $this->validate(array_merge([
            'paymentPurpose' => ['required', Rule::in(array_keys($this->paymentPurposeOptions()))],
            'fullName' => ['required', 'string', 'min:3', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['required', 'string', 'max:40'],
            'currentAddress' => ['required', 'string', 'min:6', 'max:180'],
        ], $membershipRules), [], [
            'paymentPurpose' => 'payment purpose',
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
