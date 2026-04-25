<?php

namespace App\Livewire\Site;

use App\Models\ContactInquiry;
use App\Support\EcosaSite;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.site')]
#[Title('Contact Us')]
class Contact extends Component
{
    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $inquiryType = 'Membership Support';

    public string $message = '';

    public bool $submitted = false;

    public function sendMessage(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'min:3', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['nullable', 'string', 'max:40'],
            'inquiryType' => ['required', 'string', 'max:80'],
            'message' => ['required', 'string', 'min:10', 'max:1200'],
        ]);

        ContactInquiry::query()->create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'inquiry_type' => $this->inquiryType,
            'message' => $this->message,
        ]);

        $this->submitted = true;
        $this->reset('name', 'email', 'phone', 'message');
        $this->inquiryType = 'Membership Support';
    }

    public function render(): View
    {
        return view('livewire.site.contact', [
            'organization' => EcosaSite::organization(),
            'inquiryTypes' => EcosaSite::inquiryTypes(),
        ]);
    }
}
