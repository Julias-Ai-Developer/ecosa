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
