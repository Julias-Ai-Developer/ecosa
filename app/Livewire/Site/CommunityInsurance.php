<?php

namespace App\Livewire\Site;

use App\Models\CommunityProgram;
use App\Support\EcosaSite;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.site')]
#[Title('Insurance Group')]
class CommunityInsurance extends Component
{
    public function render(): View
    {
        $programs = CommunityProgram::query()
            ->published()
            ->forType('insurance_group')
            ->orderBy('sort_order')
            ->latest()
            ->get();

        return view('livewire.site.community-insurance', [
            'organization' => EcosaSite::organization(),
            'programs' => $programs->isNotEmpty()
                ? $programs
                : collect(EcosaSite::communityFallback('insurance_group')),
        ]);
    }
}
