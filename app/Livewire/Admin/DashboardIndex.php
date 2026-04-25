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

        // 6-month registration chart
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

        // Payment counts
        $paidCount    = MembershipProfile::query()->where('payment_status', 'paid')->count();
        $pendingCount = MembershipProfile::query()->where('payment_status', 'pending_verification')->count();
        $unpaidCount  = MembershipProfile::query()->where('payment_status', 'unpaid')->count();

        // Stat totals
        $totalMembers   = MembershipProfile::query()->count();
        $activeMembers  = MembershipProfile::query()->where('membership_status', 'active')->count();
        $newMessages    = ContactInquiry::query()->where('status', 'new')->count();
        $publishedContent = NewsUpdate::query()->published()->count() + CommunityProgram::query()->published()->count();

        // Today's counts
        $todayMembers  = MembershipProfile::query()->whereDate('created_at', today())->count();
        $todayMessages = ContactInquiry::query()->whereDate('created_at', today())->count();

        // Month-over-month trend for members
        $thisMonth = MembershipProfile::query()
            ->whereYear('created_at', $now->year)
            ->whereMonth('created_at', $now->month)
            ->count();
        $lastMonth = MembershipProfile::query()
            ->whereYear('created_at', $now->copy()->subMonth()->year)
            ->whereMonth('created_at', $now->copy()->subMonth()->month)
            ->count();
        $memberTrend = $lastMonth > 0
            ? round((($thisMonth - $lastMonth) / $lastMonth) * 100)
            : ($thisMonth > 0 ? 100 : 0);

        // 7-day sparklines
        $sparkMembers  = [];
        $sparkMessages = [];
        for ($i = 6; $i >= 0; $i--) {
            $day = $now->copy()->subDays($i);
            $sparkMembers[]  = MembershipProfile::query()->whereDate('created_at', $day->toDateString())->count();
            $sparkMessages[] = ContactInquiry::query()->whereDate('created_at', $day->toDateString())->count();
        }

        return view('livewire.admin.dashboard-index', [
            'overviewStats' => [
                [
                    'label'   => 'Total Members',
                    'value'   => $totalMembers,
                    'detail'  => ($memberTrend >= 0 ? '+' : '') . $memberTrend . '% from last month',
                    'up'      => $memberTrend >= 0,
                    'icon'    => 'fa-users',
                    'color'   => 'bg-ecosa-blue/8 text-ecosa-blue',
                    'spark'   => 'sparkMembers',
                    'line'    => '#173a60',
                    'fill'    => 'rgba(23,58,96,0.08)',
                ],
                [
                    'label'   => 'Active Members',
                    'value'   => $activeMembers,
                    'detail'  => 'Verified & payment confirmed',
                    'up'      => true,
                    'icon'    => 'fa-user-check',
                    'color'   => 'bg-ecosa-green/10 text-ecosa-green-deep',
                    'spark'   => 'sparkMembers',
                    'line'    => '#17924b',
                    'fill'    => 'rgba(23,146,75,0.08)',
                ],
                [
                    'label'   => 'Pending Payments',
                    'value'   => $pendingCount,
                    'detail'  => 'Awaiting admin verification',
                    'up'      => false,
                    'icon'    => 'fa-clock',
                    'color'   => 'bg-yellow-50 text-yellow-700',
                    'spark'   => 'sparkMessages',
                    'line'    => '#d97706',
                    'fill'    => 'rgba(217,119,6,0.08)',
                ],
                [
                    'label'   => 'New Messages',
                    'value'   => $newMessages,
                    'detail'  => $todayMessages . ' received today',
                    'up'      => $todayMessages > 0,
                    'icon'    => 'fa-envelope-open-text',
                    'color'   => 'bg-rose-50 text-rose-700',
                    'spark'   => 'sparkMessages',
                    'line'    => '#be123c',
                    'fill'    => 'rgba(190,18,60,0.06)',
                ],
            ],
            'chartLabels'      => $chartLabels,
            'chartData'        => $chartData,
            'paymentBreakdown' => [
                'paid'    => $paidCount,
                'pending' => $pendingCount,
                'unpaid'  => $unpaidCount,
            ],
            'totalMembers'     => $totalMembers,
            'sparkMembers'     => $sparkMembers,
            'sparkMessages'    => $sparkMessages,
            'todayMembers'     => $todayMembers,
            'latestMemberships' => MembershipProfile::query()->latest()->limit(8)->get(),
            'latestInquiries'   => ContactInquiry::query()->latest()->limit(5)->get(),
            'latestNews'        => NewsUpdate::query()->latest()->limit(3)->get(),
            'latestPrograms'    => CommunityProgram::query()->latest()->limit(4)->get(),
            'latestLeaders'     => LeadershipMember::query()->orderBy('sort_order')->latest()->limit(4)->get(),
        ]);
    }
}
