<?php

namespace App\Livewire\Site;

use App\Models\Chapter;
use App\Support\EcosaSite;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.site')]
#[Title('Chapters')]
class Chapters extends Component
{
    public string $search = '';

    public string $category = 'all';

    public function render(): View
    {
        $chapters = Chapter::query()
            ->approved()
            ->withCount(['approvedMemberships as members_count'])
            ->when($this->category !== 'all', fn ($query) => $query->where('category', $this->category))
            ->when($this->search !== '', function ($query): void {
                $search = '%'.$this->search.'%';
                $query->where(function ($query) use ($search): void {
                    $query->where('name', 'like', $search)
                        ->orWhere('region', 'like', $search)
                        ->orWhere('profession', 'like', $search)
                        ->orWhere('business_sector', 'like', $search)
                        ->orWhere('description', 'like', $search);
                });
            })
            ->latest('approved_at')
            ->get();

        return view('livewire.site.chapters', [
            'organization' => EcosaSite::organization(),
            'chapters' => $chapters,
        ]);
    }
}
