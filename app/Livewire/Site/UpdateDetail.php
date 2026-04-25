<?php

namespace App\Livewire\Site;

use App\Models\NewsUpdate;
use App\Support\EcosaSite;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.site')]
class UpdateDetail extends Component
{
    public NewsUpdate $update;

    public function render(): View
    {
        $related = NewsUpdate::query()
            ->published()
            ->where('id', '!=', $this->update->id)
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('livewire.site.update-detail', [
            'update'     => $this->update,
            'related'    => $related->isNotEmpty() ? $related : collect(EcosaSite::updatesFallback()),
            'organization' => EcosaSite::organization(),
        ]);
    }
}
