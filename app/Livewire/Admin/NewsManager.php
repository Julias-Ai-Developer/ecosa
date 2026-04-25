<?php

namespace App\Livewire\Admin;

use App\Models\NewsUpdate;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[Layout('layouts.app')]
#[Title('News Manager')]
class NewsManager extends Component
{
    use WithFileUploads;

    public ?int $editingId = null;

    public string $newsCategory = 'Association';

    public string $newsTitle = '';

    public string $newsSummary = '';

    public string $newsBody = '';

    public mixed $newsImage = null;

    public bool $newsSaved = false;

    public function newEntry(): void
    {
        $this->reset('newsTitle', 'newsSummary', 'newsBody', 'newsImage');
        $this->newsCategory = 'Association';
        $this->editingId = null;
        $this->newsSaved = false;
        $this->resetValidation();
    }

    public function editNews(int $id): void
    {
        $record = NewsUpdate::query()->findOrFail($id);
        $this->editingId = $id;
        $this->newsCategory = $record->category;
        $this->newsTitle = $record->title;
        $this->newsSummary = $record->summary;
        $this->newsBody = $record->body ?? '';
        $this->newsImage = null;
        $this->newsSaved = false;
        $this->resetValidation();
    }

    public function saveNews(): void
    {
        $validated = $this->validate([
            'newsCategory' => ['required', 'string', 'max:40'],
            'newsTitle'    => ['required', 'string', 'max:160'],
            'newsSummary'  => ['required', 'string', 'max:300'],
            'newsBody'     => ['nullable', 'string', 'max:5000'],
            'newsImage'    => ['nullable', 'image', 'max:2048'],
        ]);

        $path = $this->newsImage
            ? $this->newsImage->store('news', 'uploads')
            : null;

        if ($this->editingId) {
            $data = [
                'category' => $validated['newsCategory'],
                'title'    => $validated['newsTitle'],
                'summary'  => $validated['newsSummary'],
                'body'     => $validated['newsBody'] ?? null,
            ];
            if ($path) {
                $data['image_path'] = $path;
            }
            NewsUpdate::query()->whereKey($this->editingId)->update($data);
        } else {
            NewsUpdate::query()->create([
                'category'     => $validated['newsCategory'],
                'title'        => $validated['newsTitle'],
                'summary'      => $validated['newsSummary'],
                'body'         => $validated['newsBody'] ?? null,
                'image_path'   => $path,
                'is_published' => true,
                'published_at' => now(),
            ]);
        }

        $this->reset('newsTitle', 'newsSummary', 'newsBody', 'newsImage');
        $this->newsCategory = 'Association';
        $this->editingId = null;
        $this->newsSaved = true;
    }

    public function deleteNews(int $newsId): void
    {
        NewsUpdate::query()->whereKey($newsId)->delete();
        $this->newsSaved = false;
    }

    public function render(): View
    {
        return view('livewire.admin.news-manager', [
            'newsUpdates' => NewsUpdate::query()->latest('published_at')->latest()->get(),
        ]);
    }
}
