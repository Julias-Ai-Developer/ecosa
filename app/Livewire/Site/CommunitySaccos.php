<?php

namespace App\Livewire\Site;

use App\Support\EcosaSite;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.site')]
#[Title('SACCOs & Circles')]
class CommunitySaccos extends Component
{
    public function render(): View
    {
        return view('livewire.site.community-saccos', [
            'organization' => EcosaSite::organization(),
            'opportunities' => [
                [
                    'title' => 'Savings Circles',
                    'text' => 'Member-led groups for disciplined saving, shared accountability, and peer support.',
                ],
                [
                    'title' => 'Investment Groups',
                    'text' => 'Small alumni groups can document shared investment ideas and invite interested members.',
                ],
                [
                    'title' => 'SACCO Conversations',
                    'text' => 'A structured space for members exploring formal savings and credit cooperation.',
                ],
            ],
        ]);
    }
}
