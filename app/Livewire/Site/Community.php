<?php

namespace App\Livewire\Site;

use App\Models\CommunityProgram;
use App\Models\NewsUpdate;
use App\Support\EcosaSite;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.site')]
#[Title('Community')]
class Community extends Component
{
    public function render(): View
    {
        return view('livewire.site.community', [
            'organization' => EcosaSite::organization(),
            'events' => $this->programs('event', 2),
            'projects' => $this->programs('project', 2),
            'insurancePrograms' => $this->programs('insurance_group', 2),
            'chapters' => EcosaSite::chapters(),
            'resources' => EcosaSite::resources(),
            'businesses' => [
                [
                    'name' => 'Alumni Enterprise Desk',
                    'services' => 'Business listings, referrals, procurement visibility, and member-to-member service discovery.',
                ],
                [
                    'name' => 'ECOSA Market Link',
                    'services' => 'Products, professional services, agriculture, logistics, consulting, retail, and creative work from alumni.',
                ],
            ],
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
            'updates' => NewsUpdate::query()
                ->published()
                ->latest('published_at')
                ->latest()
                ->limit(3)
                ->get(),
            'fallbackUpdates' => EcosaSite::updatesFallback(),
        ]);
    }

    private function programs(string $type, int $limit): mixed
    {
        $programs = CommunityProgram::query()
            ->published()
            ->forType($type)
            ->orderBy('sort_order')
            ->latest()
            ->limit($limit)
            ->get();

        return $programs->isNotEmpty()
            ? $programs
            : collect(EcosaSite::communityFallback($type));
    }
}
