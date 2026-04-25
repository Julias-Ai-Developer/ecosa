<?php

namespace App\Livewire\Admin;

use App\Models\CommunityProgram;
use App\Models\ContactInquiry;
use App\Models\LeadershipMember;
use App\Models\MembershipProfile;
use App\Models\NewsUpdate;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Admin Dashboard')]
class DashboardIndex extends Component
{
    public function render(): View
    {
        $now = now();

        $chartLabels = [];
        $chartData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = $now->copy()->subMonths($i);
            $chartLabels[] = $month->format('M Y');
            $chartData[] = MembershipProfile::query()
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }

        $paidCount = MembershipProfile::query()->where('payment_status', 'paid')->count();
        $pendingCount = MembershipProfile::query()->where('payment_status', 'pending_verification')->count();
        $unpaidCount = MembershipProfile::query()->where('payment_status', 'unpaid')->count();

        $totalMembers = MembershipProfile::query()->count();
        $activeMembers = MembershipProfile::query()->where('membership_status', 'active')->count();
        $newMessages = ContactInquiry::query()->where('status', 'new')->count();
        $publishedContent = NewsUpdate::query()->published()->count() + CommunityProgram::query()->published()->count();

        return view('livewire.admin.dashboard-index', [
            'overviewStats' => [
                [
                    'label' => 'Total Members',
                    'value' => (string) $totalMembers,
                    'detail' => 'Registered alumni profiles',
                    'icon' => 'fa-users',
                    'tone' => 'from-[#173a60] to-[#244f7d] text-white',
                ],
                [
                    'label' => 'Active Members',
                    'value' => (string) $activeMembers,
                    'detail' => 'Verified & payment confirmed',
                    'icon' => 'fa-user-check',
                    'tone' => 'from-[#17924b] to-[#0f743c] text-white',
                ],
                [
                    'label' => 'Pending Payments',
                    'value' => (string) $pendingCount,
                    'detail' => 'Awaiting admin verification',
                    'icon' => 'fa-clock',
                    'tone' => 'from-[#ffd600] to-[#ffb703] text-[#102b47]',
                ],
                [
                    'label' => 'Website Messages',
                    'value' => (string) $newMessages,
                    'detail' => 'Unread contact submissions',
                    'icon' => 'fa-envelope-open-text',
                    'tone' => 'from-[#8c2f39] to-[#5f0f40] text-white',
                ],
            ],
            'chartLabels' => $chartLabels,
            'chartData' => $chartData,
            'paymentBreakdown' => [
                'paid' => $paidCount,
                'pending' => $pendingCount,
                'unpaid' => $unpaidCount,
            ],
            'latestMemberships' => MembershipProfile::query()->latest()->limit(6)->get(),
            'latestInquiries' => ContactInquiry::query()->latest()->limit(5)->get(),
            'latestNews' => NewsUpdate::query()->latest()->limit(3)->get(),
            'latestPrograms' => CommunityProgram::query()->latest()->limit(4)->get(),
            'latestLeaders' => LeadershipMember::query()->orderBy('sort_order')->latest()->limit(4)->get(),
        ]);
    }
}
