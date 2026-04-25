<?php

namespace App\Livewire\Site;

use App\Support\EcosaSite;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.site')]
#[Title('About Us')]
class About extends Component
{
    public function render(): View
    {
        return view('livewire.site.about', [
            'organization' => EcosaSite::organization(),
            'highlights' => [
                [
                    'value' => '2002',
                    'label' => 'Association foundation',
                    'detail' => 'Built to keep old students connected to one another and to the school community.',
                ],
                [
                    'value' => '500+',
                    'label' => 'Growing alumni reach',
                    'detail' => 'A structured network of senior leaders, professionals, entrepreneurs, and young alumni.',
                ],
                [
                    'value' => '3',
                    'label' => 'Core priorities',
                    'detail' => 'Membership value, community programs, and disciplined institutional coordination.',
                ],
            ],
            'storyBlocks' => [
                [
                    'title' => 'Why ECOSA exists',
                    'text' => 'ECOSA brings old students together in a way that feels credible to senior stakeholders and useful to active members. The association is built to coordinate people, ideas, and resources without losing the values of the school that shaped them.',
                ],
                [
                    'title' => 'What the association delivers',
                    'text' => 'The platform supports professional networking, membership administration, structured updates, school-facing projects, and a stronger welfare ecosystem for alumni.',
                ],
                [
                    'title' => 'How the identity is expressed',
                    'text' => 'The public website, member portal, and admin system are designed to present ECOSA as a modern institutional body rather than a casual alumni page.',
                ],
            ],
            'pillars' => EcosaSite::governancePillars(),
        ]);
    }
}
