<?php

namespace App\Livewire\Site;

use App\Support\EcosaSite;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.site')]
#[Title('Business Network')]
class CommunityBusinessNetwork extends Component
{
    public function render(): View
    {
        return view('livewire.site.community-business-network', [
            'organization' => EcosaSite::organization(),
            'businesses' => [
                [
                    'name' => 'Alumni Enterprise Desk',
                    'services' => 'Business listings, referrals, procurement visibility, and member-to-member service discovery.',
                ],
                [
                    'name' => 'ECOSA Market Link',
                    'services' => 'Products, professional services, agriculture, logistics, consulting, retail, and creative work from alumni.',
                ],
                [
                    'name' => 'Member Business Directory',
                    'services' => 'A growing directory for alumni-owned and alumni-operated businesses once profiles are submitted.',
                ],
            ],
        ]);
    }
}
