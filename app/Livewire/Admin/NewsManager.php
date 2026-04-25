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

    public string $newsCategory = 'Association';

    public string $newsTitle = '';

    public string $newsSummary = '';

    public string $newsBody = '';

    public mixed $newsImage = null;

    public bool $newsSaved = false;

    public function saveNews(): void
    {
        $validated = $this->validate([
            'newsCategory' => ['required', 'string', 'max:40'],
            'newsTitle' => ['required', 'string', 'max:160'],
            'newsSummary' => ['required', 'string', 'max:300'],
            'newsBody' => ['nullable', 'string', 'max:5000'],
            'newsImage' => ['nullable', 'image', 'max:2048'],
        ]);

        $path = $this->newsImage
            ? $this->newsImage->store('news', 'uploads')
            : null;

        NewsUpdate::query()->create([
            'category' => $validated['newsCategory'],
            'title' => $validated['newsTitle'],
            'summary' => $validated['newsSummary'],
            'body' => $validated['newsBody'] ?? null,
            'image_path' => $path,
            'is_published' => true,
            'published_at' => now(),
        ]);

        $this->reset('newsTitle', 'newsSummary', 'newsBody', 'newsImage');
        $this->newsCategory = 'Association';
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
