<?php

namespace App\Livewire\Site;

use App\Support\EcosaSite;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.site')]
#[Title('Membership')]
class MembershipHub extends Component
{
    public function render(): View
    {
        return view('livewire.site.membership-hub', [
            'organization' => EcosaSite::organization(),
            'benefits' => EcosaSite::membershipBenefits(),
            'paymentOptions' => EcosaSite::paymentOptions(),
            'paymentPurposeOptions' => EcosaSite::paymentPurposeOptions(),
            'guidingPrinciples' => EcosaSite::guidingPrinciples(),
            'chapters' => EcosaSite::chapters(),
            'sectors' => [
                'Education and public service',
                'Corporate leadership and entrepreneurship',
                'Creative industries and communications',
                'Health, engineering, and community development',
            ],
            'steps' => [
                'Complete the membership registration form with your alumni and professional details.',
                'Choose what you are paying for, such as membership, donation, project support, chapter support, or welfare support.',
                'Use MTN MoMo or Airtel Money, submit confirmation details, and wait for ECOSA verification.',
                'Receive your membership ID by email and access your member portal after login.',
            ],
        ]);
    }
}
