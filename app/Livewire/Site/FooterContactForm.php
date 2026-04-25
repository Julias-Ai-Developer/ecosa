<?php

namespace App\Livewire\Site;

use App\Models\ContactInquiry;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class FooterContactForm extends Component
{
    public string $name = '';

    public string $email = '';

    public string $message = '';

    public bool $submitted = false;

    public function sendMessage(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'min:3', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'message' => ['required', 'string', 'min:10', 'max:800'],
        ]);

        ContactInquiry::query()->create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => null,
            'inquiry_type' => 'Footer Message',
            'message' => $this->message,
            'status' => 'new',
        ]);

        $this->submitted = true;
        $this->reset('name', 'email', 'message');
    }

    public function render(): View
    {
        return view('livewire.site.footer-contact-form');
    }
}
