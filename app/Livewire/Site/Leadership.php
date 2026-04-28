<?php

namespace App\Livewire\Site;

use App\Models\LeadershipMember;
use App\Support\EcosaSite;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.site')]
#[Title('Leadership')]
class Leadership extends Component
{
    public function render(): View
    {
        $allLeaders = LeadershipMember::query()
            ->published()
            ->orderBy('sort_order')
            ->get();

        $groupMap = [
            'top_management'        => 'Top Management',
            'class_representatives' => 'Class Representatives',
            'chapter_leaders'       => 'Chapter Leaders',
        ];

        $grouped = $allLeaders->groupBy('group');

        $mapLeader = fn (LeadershipMember $leader): array => [
            'name'      => $leader->name,
            'initials'  => $leader->initials,
            'title'     => $leader->title,
            'portfolio' => $leader->portfolio,
            'focus'     => $leader->focus,
            'icon'      => $leader->icon,
            'tone'      => $leader->tone,
            'photo'     => $leader->photoUrl(),
        ];

        // Build ordered sections only where members exist
        $sections = [];
        foreach ($groupMap as $key => $label) {
            $members = $grouped->get($key, collect());
            if ($members->isNotEmpty()) {
                $sections[] = [
                    'key'     => $key,
                    'label'   => $label,
                    'members' => $members->map($mapLeader)->all(),
                ];
            }
        }

        // Fallback: if no DB records, show one "Management Team" section
        if (empty($sections)) {
            $sections = [
                [
                    'key'     => 'top_management',
                    'label'   => 'Management Team',
                    'members' => EcosaSite::leadershipFallback(),
                ],
            ];
        }

        return view('livewire.site.leadership', [
            'organization'    => EcosaSite::organization(),
            'sections'        => $sections,
            'contactLevels'   => EcosaSite::leadershipContactLevels(),
            'leadershipGroups' => EcosaSite::leadershipGroups(),
            'metrics'         => [
                ['value' => '8+', 'label' => 'Leadership roles'],
                ['value' => '500+', 'label' => 'Alumni community'],
                ['value' => '100%', 'label' => 'Member accountability'],
            ],
        ]);
    }
}
