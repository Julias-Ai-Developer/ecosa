<?php

namespace App\Livewire\Admin;

use App\Models\CommunityProgram;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[Layout('layouts.app')]
#[Title('Community Manager')]
class CommunityManager extends Component
{
    use WithFileUploads;

    public ?int $editingId = null;

    public string $programType = 'event';

    public string $programTitle = '';

    public string $programSummary = '';

    public string $programBody = '';

    public string $programLocation = '';

    public string $programStatus = 'active';

    public string $programStartsAt = '';

    public string $programEndsAt = '';

    public string $programCtaLabel = 'Learn more';

    public string $programCtaUrl = '';

    public int $programSortOrder = 0;

    public mixed $programImage = null;

    public bool $programSaved = false;

    public function newEntry(): void
    {
        $this->reset('programTitle', 'programSummary', 'programBody', 'programLocation', 'programStartsAt', 'programEndsAt', 'programCtaUrl', 'programImage');
        $this->programType = 'event';
        $this->programStatus = 'active';
        $this->programCtaLabel = 'Learn more';
        $this->programSortOrder = 0;
        $this->editingId = null;
        $this->programSaved = false;
        $this->resetValidation();
    }

    public function editProgram(int $id): void
    {
        $record = CommunityProgram::query()->findOrFail($id);
        $this->editingId = $id;
        $this->programType = $record->type;
        $this->programTitle = $record->title;
        $this->programSummary = $record->summary;
        $this->programBody = $record->body ?? '';
        $this->programLocation = $record->location ?? '';
        $this->programStatus = $record->status;
        $this->programStartsAt = $record->starts_at?->format('Y-m-d') ?? '';
        $this->programEndsAt = $record->ends_at?->format('Y-m-d') ?? '';
        $this->programCtaLabel = $record->cta_label ?? 'Learn more';
        $this->programCtaUrl = $record->cta_url ?? '';
        $this->programSortOrder = $record->sort_order;
        $this->programImage = null;
        $this->programSaved = false;
        $this->resetValidation();
    }

    public function saveProgram(): void
    {
        $validated = $this->validate([
            'programType'      => ['required', Rule::in(['event', 'project', 'insurance_group'])],
            'programTitle'     => ['required', 'string', 'max:160'],
            'programSummary'   => ['required', 'string', 'max:300'],
            'programBody'      => ['nullable', 'string', 'max:6000'],
            'programLocation'  => ['nullable', 'string', 'max:180'],
            'programStatus'    => ['required', Rule::in(['upcoming', 'active', 'completed'])],
            'programStartsAt'  => ['nullable', 'date'],
            'programEndsAt'    => ['nullable', 'date', 'after_or_equal:programStartsAt'],
            'programCtaLabel'  => ['nullable', 'string', 'max:60'],
            'programCtaUrl'    => ['nullable', 'url', 'max:255'],
            'programSortOrder' => ['required', 'integer', 'min:0', 'max:500'],
            'programImage'     => ['nullable', 'image', 'max:2048'],
        ]);

        $path = $this->programImage
            ? $this->programImage->store('community', 'uploads')
            : null;

        $data = [
            'type'      => $validated['programType'],
            'title'     => $validated['programTitle'],
            'summary'   => $validated['programSummary'],
            'body'      => $validated['programBody'] ?? null,
            'location'  => $validated['programLocation'] ?: null,
            'status'    => $validated['programStatus'],
            'cta_label' => $validated['programCtaLabel'] ?: null,
            'cta_url'   => $validated['programCtaUrl'] ?: null,
            'starts_at' => $validated['programStartsAt'] ?: null,
            'ends_at'   => $validated['programEndsAt'] ?: null,
            'sort_order' => $validated['programSortOrder'],
        ];

        if ($this->editingId) {
            if ($path) {
                $data['image_path'] = $path;
            }
            CommunityProgram::query()->whereKey($this->editingId)->update($data);
        } else {
            $data['image_path'] = $path;
            $data['is_published'] = true;
            CommunityProgram::query()->create($data);
        }

        $this->reset('programTitle', 'programSummary', 'programBody', 'programLocation', 'programStartsAt', 'programEndsAt', 'programCtaUrl', 'programImage');
        $this->programType = 'event';
        $this->programStatus = 'active';
        $this->programCtaLabel = 'Learn more';
        $this->programSortOrder = 0;
        $this->editingId = null;
        $this->programSaved = true;
    }

    public function deleteProgram(int $programId): void
    {
        CommunityProgram::query()->whereKey($programId)->delete();
        $this->programSaved = false;
    }

    public function render(): View
    {
        return view('livewire.admin.community-manager', [
            'programs' => CommunityProgram::query()->orderBy('type')->orderBy('sort_order')->latest()->get(),
        ]);
    }
}
