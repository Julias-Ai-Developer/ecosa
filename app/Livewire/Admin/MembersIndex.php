<?php

namespace App\Livewire\Admin;

use App\Mail\MemberCredentialsMail;
use App\Mail\PaymentReceiptMail;
use App\Models\MemberNotification;
use App\Models\MembershipProfile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\StreamedResponse;

#[Layout('layouts.app')]
#[Title('Registered Members')]
class MembersIndex extends Component
{
    use WithPagination;

    public string $search = '';

    public string $paymentStatus = 'all';

    public string $paymentPurpose = 'all';

    public string $membershipStatus = 'all';

    public string $sort = 'latest';

    public ?int $viewingMemberId = null;

    public ?int $messagingMemberId = null;
    public string $quickTitle = '';
    public string $quickBody  = '';
    public bool $messageSent  = false;

    public function canViewPaymentDetails(): bool
    {
        return Auth::user()?->hasPermission('admin.payments.view') ?? false;
    }

    public function canConfirmPayments(): bool
    {
        return Auth::user()?->hasPermission('admin.payments.confirm') ?? false;
    }

    public function canVerifyPayments(): bool
    {
        return Auth::user()?->hasPermission('admin.payments.verify') ?? false;
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedPaymentStatus(): void
    {
        $this->resetPage();
    }

    public function updatedPaymentPurpose(): void
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
        $this->reset('search', 'paymentStatus', 'paymentPurpose', 'membershipStatus', 'sort');
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
        $profile = MembershipProfile::query()->findOrFail($membershipProfileId);

        if (! $this->canVerifyPayments()) {
            $this->addError('paymentVerification', 'You do not have permission to verify payments.');

            return;
        }

        if (! $profile->payment_confirmed_by) {
            $this->addError('paymentVerification', 'Confirm receipt before verifying this payment.');

            return;
        }

        if ((int) $profile->payment_confirmed_by === (int) Auth::id()) {
            $this->addError('paymentVerification', 'A different admin must verify this payment.');

            return;
        }

        $profile->update([
            'membership_status' => $profile->payment_purpose === 'membership' ? 'active' : $profile->membership_status,
            'payment_status'    => 'paid',
            'payment_verified_by' => Auth::id(),
            'payment_verified_at' => now(),
            'paid_at'           => now(),
        ]);

        // Create portal account if none exists
        $user = User::query()
            ->where('email', $profile->email)
            ->orWhere(fn ($q) => $q->whereKey($profile->user_id))
            ->first();

        $plainPassword = null;

        if (! $user && $profile->payment_purpose === 'membership') {
            $plainPassword = Str::random(10);

            $user = User::create([
                'name'                => $profile->full_name,
                'email'               => $profile->email,
                'password'            => Hash::make($plainPassword),
                'must_change_password' => true,
            ]);

            $profile->update(['user_id' => $user->id]);
        }

        if ($user && $profile->payment_purpose === 'membership') {
            $memberRole = Role::where('slug', 'member')->first();
            if ($memberRole && ! $user->roles()->where('slug', 'member')->exists()) {
                $user->roles()->attach($memberRole);
            }
        }

        // Send credentials only when we created a new account
        if ($plainPassword) {
            Mail::to($profile->email)->send(new MemberCredentialsMail(
                fullName:        $profile->full_name,
                membershipNumber: $profile->membership_number,
                email:           $profile->email,
                plainPassword:   $plainPassword,
            ));
        }

        Mail::to($profile->email)->send(new PaymentReceiptMail($profile->fresh()));
    }

    public function confirmPayment(int $membershipProfileId): void
    {
        if (! $this->canConfirmPayments()) {
            $this->addError('paymentVerification', 'You do not have permission to confirm payments.');

            return;
        }

        $profile = MembershipProfile::query()->findOrFail($membershipProfileId);

        $profile->update([
            'payment_status' => 'confirmed',
            'payment_confirmed_by' => Auth::id(),
            'payment_confirmed_at' => now(),
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
                'payment_confirmed_by' => null,
                'payment_confirmed_at' => null,
                'payment_verified_by' => null,
                'payment_verified_at' => null,
            ]);
    }

    public function exportReport(): StreamedResponse
    {
        $fileName = 'ecosa-members-report-'.now()->format('Y-m-d-His').'.csv';

        return response()->streamDownload(function (): void {
            $handle = fopen('php://output', 'w');
            $canViewPaymentDetails = $this->canViewPaymentDetails();

            fputcsv($handle, [
                'Membership Number',
                'Full Name',
                'Email',
                'Phone',
                'Completion Year',
                'Address',
                'Occupation Type',
                'Occupation Title',
                'Business Name',
                'Payment Purpose',
                'Payment Status',
                'Confirmed By',
                'Confirmed At',
                'Verified By',
                'Verified At',
                'Payment Method',
                'Payment Phone',
                'Amount Paid',
                'Transaction Reference',
                'Membership Status',
                'Registered At',
            ]);

            $this->memberReportQuery()
                ->orderBy('id')
                ->chunk(200, function ($members) use ($handle): void {
                    foreach ($members as $member) {
                        fputcsv($handle, [
                            $member->membership_number,
                            $member->full_name,
                            $member->email,
                            $member->phone,
                            $member->completion_year,
                            $member->current_address,
                            $member->occupationTypeLabel(),
                            $member->occupation_title,
                            $member->business_name,
                            $member->paymentPurposeLabel(),
                            $member->paymentStatusLabel(),
                            $member->confirmedBy?->name,
                            optional($member->payment_confirmed_at)->format('Y-m-d H:i:s'),
                            $member->verifiedBy?->name,
                            optional($member->payment_verified_at)->format('Y-m-d H:i:s'),
                            $canViewPaymentDetails ? $member->paymentMethodLabel() : 'Restricted',
                            $canViewPaymentDetails ? $member->payment_phone : 'Restricted',
                            $canViewPaymentDetails ? $member->amount_paid : 'Restricted',
                            $canViewPaymentDetails ? $member->payment_reference : 'Restricted',
                            $member->membershipStatusLabel(),
                            optional($member->created_at)->format('Y-m-d H:i:s'),
                        ]);
                    }
                });

            fclose($handle);
        }, $fileName, ['Content-Type' => 'text/csv']);
    }

    public function render(): View
    {
        $members = $this->memberReportQuery()
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
            'canViewPaymentDetails' => $this->canViewPaymentDetails(),
            'canConfirmPayments' => $this->canConfirmPayments(),
            'canVerifyPayments' => $this->canVerifyPayments(),
        ]);
    }

    private function memberReportQuery()
    {
        return MembershipProfile::query()
            ->with(['confirmedBy', 'verifiedBy'])
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
            ->when($this->paymentPurpose !== 'all', fn ($query) => $query->where('payment_purpose', $this->paymentPurpose))
            ->when($this->membershipStatus !== 'all', fn ($query) => $query->where('membership_status', $this->membershipStatus));
    }
}
