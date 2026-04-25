<?php

namespace App\Livewire\Admin;

use App\Models\LeadershipMember;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[Layout('layouts.app')]
#[Title('Team Manager')]
class TeamManager extends Component
{
    use WithFileUploads;

    public string $leaderName = '';

    public string $leaderInitials = '';

    public string $leaderTitle = '';

    public string $leaderPortfolio = '';

    public string $leaderFocus = '';

    public string $leaderIcon = 'fa-user-tie';

    public string $leaderTone = 'blue';

    public int $leaderSortOrder = 0;

    public mixed $leaderPhoto = null;

    public bool $leaderSaved = false;

    public function saveLeader(): void
    {
        $validated = $this->validate([
            'leaderName' => ['nullable', 'string', 'max:120'],
            'leaderInitials' => ['required_without:leaderName', 'nullable', 'string', 'max:24'],
            'leaderTitle' => ['required', 'string', 'max:120'],
            'leaderPortfolio' => ['required', 'string', 'max:120'],
            'leaderFocus' => ['required', 'string', 'max:500'],
            'leaderIcon' => ['required', 'string', 'max:80'],
            'leaderTone' => ['required', Rule::in(['blue', 'green', 'gold', 'rose'])],
            'leaderSortOrder' => ['required', 'integer', 'min:0', 'max:500'],
            'leaderPhoto' => ['nullable', 'image', 'max:2048'],
        ]);

        $path = $this->leaderPhoto
            ? $this->leaderPhoto->store('leaders', 'uploads')
            : null;

        LeadershipMember::query()->create([
            'name' => $validated['leaderName'] ?: null,
            'initials' => Str::upper($validated['leaderInitials'] ?: Str::substr($validated['leaderName'], 0, 2)),
            'title' => $validated['leaderTitle'],
            'portfolio' => $validated['leaderPortfolio'],
            'focus' => $validated['leaderFocus'],
            'icon' => $validated['leaderIcon'],
            'tone' => $validated['leaderTone'],
            'sort_order' => $validated['leaderSortOrder'],
            'photo_path' => $path,
            'is_published' => true,
        ]);

        $this->reset('leaderName', 'leaderInitials', 'leaderTitle', 'leaderPortfolio', 'leaderFocus', 'leaderPhoto');
        $this->leaderIcon = 'fa-user-tie';
        $this->leaderTone = 'blue';
        $this->leaderSortOrder = 0;
        $this->leaderSaved = true;
    }

    public function deleteLeader(int $leaderId): void
    {
        LeadershipMember::query()->whereKey($leaderId)->delete();
        $this->leaderSaved = false;
    }

    public function render(): View
    {
        return view('livewire.admin.team-manager', [
            'leaders' => LeadershipMember::query()->orderBy('sort_order')->latest()->get(),
        ]);
    }
}
