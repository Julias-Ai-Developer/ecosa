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
        $leaders = LeadershipMember::query()
            ->published()
            ->orderBy('sort_order')
            ->get();

        return view('livewire.site.leadership', [
            'organization' => EcosaSite::organization(),
            'leaders' => $leaders->isNotEmpty()
                ? $leaders->map(fn (LeadershipMember $leader): array => [
                    'name' => $leader->name,
                    'initials' => $leader->initials,
                    'title' => $leader->title,
                    'portfolio' => $leader->portfolio,
                    'focus' => $leader->focus,
                    'icon' => $leader->icon,
                    'tone' => $leader->tone,
                    'photo' => $leader->photoUrl(),
                ])->all()
                : EcosaSite::leadershipFallback(),
            'metrics' => [
                ['value' => '8+', 'label' => 'Leadership roles'],
                ['value' => '500+', 'label' => 'Alumni community'],
                ['value' => '100%', 'label' => 'Member accountability'],
            ],
        ]);
    }
}
