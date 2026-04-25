<?php

namespace App\Livewire\Admin;

use App\Models\ContactInquiry;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Website Messages')]
class MessagesIndex extends Component
{
    use WithPagination;

    public string $search = '';

    public string $status = 'all';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedStatus(): void
    {
        $this->resetPage();
    }

    public function markRead(int $inquiryId): void
    {
        ContactInquiry::query()->whereKey($inquiryId)->update(['status' => 'read']);
    }

    public function render(): View
    {
        $messages = ContactInquiry::query()
            ->when($this->search !== '', function ($query): void {
                $search = '%'.$this->search.'%';

                $query->where(function ($query) use ($search): void {
                    $query->where('name', 'like', $search)
                        ->orWhere('email', 'like', $search)
                        ->orWhere('message', 'like', $search)
                        ->orWhere('inquiry_type', 'like', $search);
                });
            })
            ->when($this->status !== 'all', fn ($query) => $query->where('status', $this->status))
            ->latest()
            ->paginate(10);

        return view('livewire.admin.messages-index', [
            'messages' => $messages,
            'newCount' => ContactInquiry::query()->where('status', 'new')->count(),
            'readCount' => ContactInquiry::query()->where('status', 'read')->count(),
        ]);
    }
}
