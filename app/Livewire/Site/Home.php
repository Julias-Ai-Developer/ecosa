<?php

namespace App\Livewire\Site;

use App\Models\CommunityProgram;
use App\Models\LeadershipMember;
use App\Models\NewsUpdate;
use App\Support\EcosaSite;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.site')]
#[Title('Home')]
class Home extends Component
{
    public function render(): View
    {
        $leaders = LeadershipMember::query()
            ->published()
            ->orderBy('sort_order')
            ->limit(4)
            ->get();

        $updates = NewsUpdate::query()
            ->published()
            ->latest('published_at')
            ->latest()
            ->limit(3)
            ->get();

        $events = CommunityProgram::query()
            ->published()
            ->forType('event')
            ->orderBy('sort_order')
            ->orderBy('starts_at')
            ->limit(3)
            ->get();

        $projects = CommunityProgram::query()
            ->published()
            ->forType('project')
            ->orderBy('sort_order')
            ->latest()
            ->limit(2)
            ->get();

        return view('livewire.site.home', [
            'organization'     => EcosaSite::organization(),
            'heroSlides'       => EcosaSite::heroSlides(),
            'showcaseCards'    => EcosaSite::homeShowcaseCards(),
            'benefits'         => EcosaSite::membershipBenefits(),
            'membershipTracks' => EcosaSite::membershipTracks(),
            'sponsors'         => EcosaSite::sponsors(),
            'leaders'          => $leaders->isNotEmpty() ? $leaders : collect(EcosaSite::leadershipFallback()),
            'updates'          => $updates,
            'fallbackUpdates'  => EcosaSite::updatesFallback(),
            'events'           => $events->isNotEmpty() ? $events : collect(EcosaSite::communityFallback('event')),
            'projects'         => $projects->isNotEmpty() ? $projects : collect(EcosaSite::communityFallback('project')),
        ]);
    }
}
