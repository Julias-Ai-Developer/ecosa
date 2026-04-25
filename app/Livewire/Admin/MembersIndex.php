<?php

namespace App\Livewire\Admin;

use App\Models\MemberNotification;
use App\Models\MembershipProfile;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Registered Members')]
class MembersIndex extends Component
{
    use WithPagination;

    public string $search = '';

    public string $paymentStatus = 'all';

    public string $membershipStatus = 'all';

    public string $sort = 'latest';

    public ?int $viewingMemberId = null;

    public ?int $messagingMemberId = null;
    public string $quickTitle = '';
    public string $quickBody  = '';
    public bool $messageSent  = false;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedPaymentStatus(): void
    {
        $this->resetPage();
    }

    public function updatedMembershipStatus(): void
    {
        $this->resetPage();
    }

    public function updatedSort(): void
    {
        $this->resetPage();
    }

    public function resetFilters(): void
    {
        $this->reset('search', 'paymentStatus', 'membershipStatus', 'sort');
        $this->resetPage();
    }

    public function viewMember(int $membershipProfileId): void
    {
        $this->viewingMemberId = $membershipProfileId;
    }

    public function closeModal(): void
    {
        $this->viewingMemberId = null;
    }

    public function verifyPayment(int $membershipProfileId): void
    {
        MembershipProfile::query()
            ->whereKey($membershipProfileId)
            ->update([
                'membership_status' => 'active',
                'payment_status' => 'paid',
                'amount_paid' => MembershipProfile::REGISTRATION_FEE,
                'paid_at' => now(),
            ]);
    }

    public function openMessageDrawer(int $membershipProfileId): void
    {
        $this->messagingMemberId = $membershipProfileId;
        $this->quickTitle = '';
        $this->quickBody  = '';
        $this->messageSent = false;
    }

    public function closeMessageDrawer(): void
    {
        $this->messagingMemberId = null;
    }

    public function sendQuickMessage(): void
    {
        $this->validate([
            'quickTitle' => ['required', 'string', 'min:3', 'max:200'],
            'quickBody'  => ['required', 'string', 'min:5'],
        ], [], ['quickTitle' => 'title', 'quickBody' => 'message']);

        MemberNotification::create([
            'title'             => trim($this->quickTitle),
            'body'              => trim($this->quickBody),
            'target_type'       => 'specific',
            'member_profile_id' => $this->messagingMemberId,
            'sent_by'           => Auth::id(),
        ]);

        $this->quickTitle = '';
        $this->quickBody  = '';
        $this->messageSent = true;
    }

    public function markPending(int $membershipProfileId): void
    {
        MembershipProfile::query()
            ->whereKey($membershipProfileId)
            ->update([
                'membership_status' => 'pending',
                'payment_status' => 'pending_verification',
            ]);
    }

    public function render(): View
    {
        $members = MembershipProfile::query()
            ->when($this->search !== '', function ($query): void {
                $search = '%'.$this->search.'%';

                $query->where(function ($query) use ($search): void {
                    $query->where('membership_number', 'like', $search)
                        ->orWhere('full_name', 'like', $search)
                        ->orWhere('email', 'like', $search)
                        ->orWhere('phone', 'like', $search)
                        ->orWhere('current_address', 'like', $search)
                        ->orWhere('occupation_title', 'like', $search)
                        ->orWhere('business_name', 'like', $search)
                        ->orWhere('payment_reference', 'like', $search);
                });
            })
            ->when($this->paymentStatus !== 'all', fn ($query) => $query->where('payment_status', $this->paymentStatus))
            ->when($this->membershipStatus !== 'all', fn ($query) => $query->where('membership_status', $this->membershipStatus))
            ->when($this->sort === 'oldest', fn ($query) => $query->oldest())
            ->when($this->sort === 'name', fn ($query) => $query->orderBy('full_name'))
            ->when($this->sort === 'latest', fn ($query) => $query->latest())
            ->paginate(15);

        return view('livewire.admin.members-index', [
            'members' => $members,
            'viewingMember' => $this->viewingMemberId
                ? MembershipProfile::query()->find($this->viewingMemberId)
                : null,
            'messagingMember' => $this->messagingMemberId
                ? MembershipProfile::query()->find($this->messagingMemberId)
                : null,
            'memberTotal' => MembershipProfile::query()->count(),
            'activeTotal' => MembershipProfile::query()->where('membership_status', 'active')->count(),
            'paidTotal' => MembershipProfile::query()->where('payment_status', 'paid')->count(),
            'pendingPaymentTotal' => MembershipProfile::query()->where('payment_status', 'pending_verification')->count(),
            'unpaidTotal' => MembershipProfile::query()->where('payment_status', 'unpaid')->count(),
        ]);
    }
}
