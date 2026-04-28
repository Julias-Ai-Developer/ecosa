<?php

namespace App\Livewire\Site;

use App\Models\ResourceDocument;
use App\Support\EcosaSite;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.site')]
#[Title('Resources')]
class Resources extends Component
{
    public string $category = 'all';

    public function render(): View
    {
        $resources = ResourceDocument::query()
            ->published()
            ->when($this->category !== 'all', fn ($query) => $query->where('category', $this->category))
            ->orderBy('sort_order')
            ->latest()
            ->get();

        return view('livewire.site.resources', [
            'organization' => EcosaSite::organization(),
            'resources' => $resources,
            'fallbackResources' => EcosaSite::resources(),
        ]);
    }
}
