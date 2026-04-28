<?php

namespace App\Livewire\Admin;

use App\Models\ResourceDocument;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[Layout('layouts.app')]
#[Title('Resources Manager')]
class ResourcesManager extends Component
{
    use WithFileUploads;

    public string $title = '';

    public string $category = 'documentation';

    public string $summary = '';

    public string $externalUrl = '';

    public string $mediaType = 'document';

    public int $sortOrder = 0;

    public mixed $file = null;

    public bool $saved = false;

    public function saveResource(): void
    {
        $validated = $this->validate([
            'title' => ['required', 'string', 'max:160'],
            'category' => ['required', Rule::in(['documentation', 'external_document', 'shortlist', 'anthem', 'video', 'audio', 'gallery'])],
            'summary' => ['nullable', 'string', 'max:500'],
            'externalUrl' => ['nullable', 'url', 'max:255'],
            'mediaType' => ['required', Rule::in(['document', 'video', 'audio', 'gallery', 'link'])],
            'sortOrder' => ['required', 'integer', 'min:0', 'max:500'],
            'file' => ['nullable', 'file', 'max:10240'],
        ]);

        $path = $this->file ? $this->file->store('resources', 'uploads') : null;

        ResourceDocument::create([
            'uploaded_by' => Auth::id(),
            'title' => $validated['title'],
            'category' => $validated['category'],
            'summary' => $validated['summary'] ?: null,
            'file_path' => $path,
            'external_url' => $validated['externalUrl'] ?: null,
            'media_type' => $validated['mediaType'],
            'sort_order' => $validated['sortOrder'],
            'is_published' => true,
        ]);

        $this->reset('title', 'summary', 'externalUrl', 'file');
        $this->category = 'documentation';
        $this->mediaType = 'document';
        $this->sortOrder = 0;
        $this->saved = true;
    }

    public function togglePublished(int $resourceId): void
    {
        $resource = ResourceDocument::query()->findOrFail($resourceId);
        $resource->update(['is_published' => ! $resource->is_published]);
    }

    public function deleteResource(int $resourceId): void
    {
        ResourceDocument::query()->whereKey($resourceId)->delete();
    }

    public function render(): View
    {
        return view('livewire.admin.resources-manager', [
            'resources' => ResourceDocument::query()->latest()->get(),
        ]);
    }
}
