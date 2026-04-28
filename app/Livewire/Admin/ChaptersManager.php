<?php

namespace App\Livewire\Admin;

use App\Models\Chapter;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Chapters Manager')]
class ChaptersManager extends Component
{
    public string $adminNotes = '';

    public function approveChapter(int $chapterId): void
    {
        Chapter::query()->whereKey($chapterId)->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
            'admin_notes' => $this->adminNotes ?: null,
        ]);

        $this->adminNotes = '';
    }

    public function rejectChapter(int $chapterId): void
    {
        Chapter::query()->whereKey($chapterId)->update([
            'status' => 'rejected',
            'admin_notes' => $this->adminNotes ?: 'Rejected by admin.',
        ]);

        $this->adminNotes = '';
    }

    public function render(): View
    {
        return view('livewire.admin.chapters-manager', [
            'chapters' => Chapter::query()
                ->with(['creator', 'approver'])
                ->withCount('approvedMemberships')
                ->latest()
                ->get(),
        ]);
    }
}
