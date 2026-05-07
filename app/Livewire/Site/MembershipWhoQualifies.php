<?php

namespace App\Livewire\Site;

use App\Support\EcosaSite;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.site')]
#[Title('Who Qualifies')]
class MembershipWhoQualifies extends Component
{
    public function render(): View
    {
        return view('livewire.site.membership-who-qualifies', [
            'organization' => EcosaSite::organization(),
            'qualifiers' => [
                'Old students and former learners of Equatorial College School.',
                'Class representatives and chapter coordinators helping alumni register.',
                'Diaspora alumni who want to stay connected and contribute remotely.',
                'Strategic supporters, patrons, and partners working through approved ECOSA channels.',
            ],
            'steps' => [
                'Confirm that you are an old student, approved representative, or recognized supporter.',
                'Prepare your basic alumni, contact, professional, and chapter information.',
                'Open the registration form and choose the correct payment or contribution purpose.',
                'Submit payment details for verification before member portal activation.',
            ],
        ]);
    }
}
