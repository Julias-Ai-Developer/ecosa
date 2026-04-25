<?php

namespace App\Livewire\Site;

use App\Models\CommunityProgram;
use App\Support\EcosaSite;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.site')]
#[Title('Community Events')]
class CommunityEvents extends Component
{
    public function render(): View
    {
        $events = CommunityProgram::query()
            ->published()
            ->forType('event')
            ->orderBy('sort_order')
            ->orderBy('starts_at')
            ->get();

        return view('livewire.site.community-events', [
            'organization' => EcosaSite::organization(),
            'events' => $events->isNotEmpty()
                ? $events
                : collect(EcosaSite::communityFallback('event')),
        ]);
    }
}
