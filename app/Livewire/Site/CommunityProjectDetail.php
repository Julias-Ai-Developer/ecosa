<?php

namespace App\Livewire\Site;

use App\Models\CommunityProgram;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.site')]
#[Title('Project Details')]
class CommunityProjectDetail extends Component
{
    public int $programId;

    public function mount(CommunityProgram $program): void
    {
        abort_if(! $program->is_published, 404);
        $this->programId = $program->id;
    }

    public function render(): View
    {
        $program = CommunityProgram::findOrFail($this->programId);

        return view('livewire.site.community-project-detail', [
            'program' => $program,
        ]);
    }
}
