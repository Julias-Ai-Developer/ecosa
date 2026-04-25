<?php

namespace App\Livewire\Site;

use App\Models\NewsUpdate;
use App\Support\EcosaSite;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.site')]
#[Title('Latest Updates')]
class Updates extends Component
{
    public function render(): View
    {
        $updates = NewsUpdate::query()
            ->published()
            ->latest('published_at')
            ->latest()
            ->get();

        return view('livewire.site.updates', [
            'organization' => EcosaSite::organization(),
            'updates' => $updates,
            'fallbackUpdates' => EcosaSite::updatesFallback(),
        ]);
    }
}
