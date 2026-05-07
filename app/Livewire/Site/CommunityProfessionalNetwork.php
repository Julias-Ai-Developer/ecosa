<?php

namespace App\Livewire\Site;

use App\Support\EcosaSite;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.site')]
#[Title('Professional Network')]
class CommunityProfessionalNetwork extends Component
{
    public function render(): View
    {
        return view('livewire.site.community-professional-network', [
            'organization' => EcosaSite::organization(),
            'professionals' => [
                [
                    'name' => 'Career Profiles',
                    'profession' => 'Education, health, engineering, public service, finance, law, technology, and entrepreneurship.',
                    'experience' => 'Member-submitted experience levels for mentorship, hiring, and collaboration.',
                    'skills' => 'Leadership, technical skills, sector knowledge, advisory support, and project delivery.',
                ],
                [
                    'name' => 'Professional Connections',
                    'profession' => 'Cross-sector alumni directory',
                    'experience' => 'Designed for hiring leads, referrals, peer guidance, and chapter-based support.',
                    'skills' => 'Collaboration, networking, mentoring, business development, and practical problem solving.',
                ],
            ],
        ]);
    }
}
