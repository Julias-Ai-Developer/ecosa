<?php

namespace App\Livewire\Admin;

use App\Models\MemberNotification;
use App\Models\MembershipProfile;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Notifications')]
class NotificationsManager extends Component
{
    public string $title       = '';
    public string $body        = '';
    public string $targetType  = 'all';
    public ?int   $targetMemberId = null;
    public bool   $saved       = false;

    public function send(): void
    {
        $this->validate([
            'title'          => ['required', 'string', 'min:3', 'max:200'],
            'body'           => ['required', 'string', 'min:5'],
            'targetType'     => ['required', 'in:all,specific'],
            'targetMemberId' => ['nullable', 'required_if:targetType,specific', 'exists:membership_profiles,id'],
        ], [], [
            'title'          => 'notification title',
            'body'           => 'message body',
            'targetMemberId' => 'target member',
        ]);

        MemberNotification::create([
            'title'             => trim($this->title),
            'body'              => trim($this->body),
            'target_type'       => $this->targetType,
            'member_profile_id' => $this->targetType === 'specific' ? $this->targetMemberId : null,
            'sent_by'           => Auth::id(),
        ]);

        $this->reset('title', 'body', 'targetMemberId');
        $this->targetType = 'all';
        $this->saved = true;
    }

    public function deleteNotification(int $id): void
    {
        MemberNotification::destroy($id);
    }

    public function render(): View
    {
        return view('livewire.admin.notifications-manager', [
            'notifications' => MemberNotification::with(['member', 'sender'])
                ->latest()
                ->paginate(20),
            'members' => MembershipProfile::query()
                ->orderBy('full_name')
                ->get(['id', 'full_name', 'membership_number']),
            'totalSent'      => MemberNotification::count(),
            'broadcastCount' => MemberNotification::where('target_type', 'all')->count(),
            'specificCount'  => MemberNotification::where('target_type', 'specific')->count(),
        ]);
    }
}
