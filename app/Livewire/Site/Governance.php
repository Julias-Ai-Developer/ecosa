<?php

namespace App\Livewire\Site;

use App\Support\EcosaSite;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.site')]
#[Title('Governance')]
class Governance extends Component
{
    public function render(): View
    {
        return view('livewire.site.governance', [
            'organization' => EcosaSite::organization(),
            'pillars' => EcosaSite::governancePillars(),
            'frameworks' => [
                [
                    'title' => 'Member records and data discipline',
                    'text' => 'Digital membership records, payment verification, and contact workflows are organized to support trust and continuity.',
                ],
                [
                    'title' => 'Corporate-style reporting',
                    'text' => 'Programs, updates, and administrative actions are designed to be visible, reviewable, and easy to manage.',
                ],
                [
                    'title' => 'School-aligned legacy building',
                    'text' => 'Every ECOSA initiative is structured to strengthen alumni relevance while advancing the wider school community.',
                ],
            ],
        ]);
    }
}
