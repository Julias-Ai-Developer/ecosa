<?php

namespace App\Livewire\Site;

use App\Models\CommunityProgram;
use App\Support\EcosaSite;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.site')]
#[Title('Community Projects')]
class CommunityProjects extends Component
{
    public function render(): View
    {
        $projects = CommunityProgram::query()
            ->published()
            ->forType('project')
            ->orderBy('sort_order')
            ->latest()
            ->get();

        return view('livewire.site.community-projects', [
            'organization' => EcosaSite::organization(),
            'projects' => $projects->isNotEmpty()
                ? $projects
                : collect(EcosaSite::communityFallback('project')),
        ]);
    }
}
