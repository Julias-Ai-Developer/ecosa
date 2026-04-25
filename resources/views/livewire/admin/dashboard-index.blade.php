<div class="mx-auto max-w-7xl space-y-6">

    {{-- Page Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Administrative System</p>
            <h1 class="mt-2 font-display text-4xl font-bold text-ecosa-blue-deep">Dashboard Overview</h1>
            <p class="mt-1 text-sm leading-6 text-zinc-500">Welcome back — here is what is happening with ECOSA today.</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.news') }}" class="site-btn-primary">
                <i class="fas fa-plus text-xs"></i> Publish Update
            </a>
            <a href="{{ route('admin.members') }}" class="site-btn-ghost">
                <i class="fas fa-users text-xs"></i> All Members
            </a>
        </div>
    </div>

    {{-- Metric Cards Bento Grid --}}
    @php
        $iconStyles = [
            'bg-ecosa-blue/10 text-ecosa-blue',
            'bg-ecosa-green/10 text-ecosa-green-deep',
            'bg-ecosa-gold/20 text-yellow-700',
            'bg-ecosa-burgundy/10 text-ecosa-burgundy',
        ];
    @endphp
    <section class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($overviewStats as $stat)
            <article class="admin-panel p-6">
                <div class="flex items-start justify-between gap-4">
                    <span class="text-xs font-bold uppercase tracking-[0.22em] text-zinc-400">{{ $stat['label'] }}</span>
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl {{ $iconStyles[$loop->index] }}">
                        <i class="fas {{ $stat['icon'] }}"></i>
                    </div>
                </div>
                <p class="mt-5 font-display text-5xl font-semibold text-ecosa-blue-deep">{{ $stat['value'] }}</p>
                <p class="mt-2 text-xs text-zinc-400">{{ $stat['detail'] }}</p>
            </article>
        @endforeach
    </section>

    {{-- Activity Feed + Module Quick Access --}}
    <section class="grid gap-6 lg:grid-cols-3">

        {{-- Recent Activity Feed (2/3) --}}
        <div class="lg:col-span-2 admin-panel overflow-hidden">
            <div class="flex items-center justify-between border-b border-ecosa-blue/8 bg-ecosa-mist/60 px-6 py-4">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Live Feed</p>
                    <h3 class="mt-0.5 font-display text-xl font-semibold text-ecosa-blue-deep">Recent Activity</h3>
                </div>
                <a href="{{ route('admin.members') }}" class="site-btn-ghost py-2 text-xs">View All</a>
            </div>
            <div class="divide-y divide-ecosa-blue/6">
                @forelse ($latestMemberships->take(3) as $member)
                    <div class="flex items-start gap-4 px-6 py-4 transition-colors hover:bg-ecosa-mist/40">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-ecosa-blue/10 text-ecosa-blue">
                            <i class="fas fa-user-plus text-sm"></i>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm text-zinc-900">
                                <span class="font-bold">{{ $member->full_name }}</span> registered as a new member.
                            </p>
                            <p class="mt-0.5 text-xs text-zinc-500">
                                {{ $member->email }} &middot;
                                <span class="rounded-full px-2 py-0.5 text-[0.65rem] font-bold {{ $member->paymentStatusTone() }}">{{ $member->paymentStatusLabel() }}</span>
                            </p>
                        </div>
                        <span class="shrink-0 whitespace-nowrap text-xs text-zinc-400">{{ $member->created_at->diffForHumans() }}</span>
                    </div>
                @empty
                @endforelse

                @forelse ($latestInquiries->take(3) as $inquiry)
                    <div class="flex items-start gap-4 px-6 py-4 transition-colors hover:bg-ecosa-mist/40">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-ecosa-burgundy/10 text-ecosa-burgundy">
                            <i class="fas fa-envelope text-sm"></i>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm text-zinc-900">
                                <span class="font-bold">{{ $inquiry->name }}</span> sent a message via the contact form.
                            </p>
                            <p class="mt-0.5 text-xs text-zinc-500">{{ $inquiry->inquiry_type }} &middot; {{ $inquiry->email }}</p>
                            <p class="mt-1 text-xs leading-5 text-zinc-600">{{ str($inquiry->message)->limit(80) }}</p>
                        </div>
                        <span class="shrink-0 whitespace-nowrap text-xs text-zinc-400">{{ $inquiry->created_at->diffForHumans() }}</span>
                    </div>
                @empty
                    <div class="px-6 py-10 text-center text-sm text-zinc-400">No recent activity to show.</div>
                @endforelse
            </div>
        </div>

        {{-- Module Quick Access (1/3) --}}
        <div class="admin-panel flex flex-col overflow-hidden">
            <div class="border-b border-ecosa-blue/8 bg-ecosa-mist/60 px-6 py-4">
                <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Admin Modules</p>
                <h3 class="mt-0.5 font-display text-xl font-semibold text-ecosa-blue-deep">Quick Access</h3>
            </div>
            <div class="flex-1 space-y-3 p-5">
                @foreach ([
                    ['route' => 'admin.news',      'icon' => 'fa-newspaper',         'label' => 'News Manager',    'sub' => 'Publish & manage updates',  'color' => 'bg-ecosa-blue/8 text-ecosa-blue'],
                    ['route' => 'admin.community', 'icon' => 'fa-layer-group',        'label' => 'Community Pages', 'sub' => 'Programs & projects',       'color' => 'bg-ecosa-green/10 text-ecosa-green-deep'],
                    ['route' => 'admin.team',      'icon' => 'fa-users-gear',         'label' => 'Team Profiles',   'sub' => 'Leadership & staff',        'color' => 'bg-ecosa-gold/20 text-yellow-700'],
                    ['route' => 'admin.messages',  'icon' => 'fa-envelope-open-text', 'label' => 'Messages',        'sub' => 'Contact inquiries',         'color' => 'bg-ecosa-burgundy/10 text-ecosa-burgundy'],
                    ['route' => 'admin.members',   'icon' => 'fa-users',              'label' => 'Members',         'sub' => 'Registered alumni',         'color' => 'bg-ecosa-ink/8 text-ecosa-ink'],
                ] as $mod)
                    <a href="{{ route($mod['route']) }}" class="flex items-center gap-3 rounded-[18px] border border-ecosa-blue/8 bg-white p-4 transition hover:border-ecosa-blue/20 hover:shadow-[var(--shadow-card)]">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl {{ $mod['color'] }}">
                            <i class="fas {{ $mod['icon'] }} text-sm"></i>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-bold text-ecosa-blue-deep">{{ $mod['label'] }}</p>
                            <p class="text-xs text-zinc-400">{{ $mod['sub'] }}</p>
                        </div>
                        <i class="fas fa-chevron-right text-xs text-zinc-300"></i>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Charts Row --}}
    <section class="grid gap-6 xl:grid-cols-[1.6fr_1fr]">

        {{-- Registration Trend Chart --}}
        <div class="admin-panel p-6">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Registration Trend</p>
                    <h2 class="mt-2 font-display text-3xl font-semibold text-ecosa-blue-deep">New members — last 6 months</h2>
                </div>
                <a href="{{ route('admin.members') }}" class="site-btn-ghost text-xs">Open Members</a>
            </div>
            <div class="relative mt-6 h-56">
                <canvas id="registrationChart" class="h-full w-full"></canvas>
            </div>
        </div>

        {{-- Payment Status Donut --}}
        <div class="admin-panel p-6">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Payment Breakdown</p>
                <h2 class="mt-2 font-display text-3xl font-semibold text-ecosa-blue-deep">Payment status overview</h2>
            </div>
            <div class="relative mx-auto mt-6 h-48 w-48">
                <canvas id="paymentChart"></canvas>
            </div>
            <div class="mt-5 grid grid-cols-3 gap-2 text-center text-xs">
                <div class="rounded-2xl bg-ecosa-green/10 p-3">
                    <p class="font-bold text-ecosa-green-deep">{{ $paymentBreakdown['paid'] }}</p>
                    <p class="mt-1 text-zinc-500">Paid</p>
                </div>
                <div class="rounded-2xl bg-ecosa-gold/16 p-3">
                    <p class="font-bold text-yellow-700">{{ $paymentBreakdown['pending'] }}</p>
                    <p class="mt-1 text-zinc-500">Pending</p>
                </div>
                <div class="rounded-2xl bg-rose-50 p-3">
                    <p class="font-bold text-rose-600">{{ $paymentBreakdown['unpaid'] }}</p>
                    <p class="mt-1 text-zinc-500">Unpaid</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Recent Members + Messages --}}
    <section class="grid gap-6 xl:grid-cols-[1.1fr_0.9fr]">

        {{-- Recent Members Table --}}
        <div class="admin-panel p-6">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Latest Registrations</p>
                    <h2 class="mt-2 font-display text-3xl font-semibold text-ecosa-blue-deep">Recent member activity</h2>
                </div>
                <a href="{{ route('admin.members') }}" class="site-btn-ghost text-xs">All Members</a>
            </div>

            <div class="mt-6 overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="text-[0.68rem] uppercase tracking-[0.2em] text-zinc-400">
                        <tr>
                            <th class="pb-3 font-bold">EC ID</th>
                            <th class="pb-3 font-bold">Member</th>
                            <th class="pb-3 font-bold">Payment</th>
                            <th class="pb-3 font-bold">Joined</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-ecosa-blue/8">
                        @forelse ($latestMemberships as $member)
                            <tr>
                                <td class="py-4">
                                    <span class="rounded-lg bg-ecosa-blue/8 px-2 py-1 font-mono text-xs font-bold text-ecosa-blue-deep">{{ $member->membership_number }}</span>
                                </td>
                                <td class="py-4">
                                    <p class="font-semibold text-zinc-900">{{ $member->full_name }}</p>
                                    <p class="text-xs text-zinc-500">{{ $member->email }}</p>
                                </td>
                                <td class="py-4">
                                    <span class="rounded-full px-3 py-1 text-xs font-bold {{ $member->paymentStatusTone() }}">{{ $member->paymentStatusLabel() }}</span>
                                </td>
                                <td class="py-4 text-xs text-zinc-500">{{ $member->created_at->format('M j, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-sm text-zinc-400">No membership records yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Recent Messages --}}
        <div class="admin-panel p-6">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Website Messages</p>
                    <h2 class="mt-2 font-display text-3xl font-semibold text-ecosa-blue-deep">Unread inquiries</h2>
                </div>
                <a href="{{ route('admin.messages') }}" class="site-btn-ghost text-xs">All Messages</a>
            </div>

            <div class="mt-6 grid gap-3">
                @forelse ($latestInquiries as $inquiry)
                    <article class="rounded-[20px] border border-ecosa-blue/8 bg-ecosa-blue/[0.03] p-4">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="font-semibold text-ecosa-blue-deep">{{ $inquiry->name }}</p>
                                <p class="text-xs text-zinc-500">{{ $inquiry->email }} &middot; {{ $inquiry->inquiry_type }}</p>
                            </div>
                            <span class="shrink-0 rounded-full bg-white px-2 py-0.5 text-[0.65rem] font-bold uppercase tracking-[0.15em] text-ecosa-green-deep">{{ $inquiry->status }}</span>
                        </div>
                        <p class="mt-3 text-xs leading-6 text-zinc-600">{{ str($inquiry->message)->limit(100) }}</p>
                    </article>
                @empty
                    <p class="py-6 text-center text-sm text-zinc-400">No messages yet.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- News + Community --}}
    <section class="grid gap-6 xl:grid-cols-2">

        {{-- Latest News --}}
        <div class="admin-panel p-6">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Public Content</p>
                    <h2 class="mt-2 font-display text-3xl font-semibold text-ecosa-blue-deep">Latest news &amp; updates</h2>
                </div>
                <a href="{{ route('admin.news') }}" class="site-btn-ghost text-xs">Manage News</a>
            </div>
            <div class="mt-6 grid gap-4">
                @forelse ($latestNews as $news)
                    <article class="rounded-[20px] border border-ecosa-blue/8 bg-ecosa-blue/[0.03] p-4">
                        <div class="flex items-center gap-2">
                            <span class="site-chip text-[0.65rem]">{{ $news->category }}</span>
                            @if ($news->published_at)
                                <span class="text-xs text-zinc-400">{{ $news->published_at->format('M j, Y') }}</span>
                            @endif
                        </div>
                        <h3 class="mt-3 font-display text-2xl font-semibold text-ecosa-blue-deep">{{ $news->title }}</h3>
                        <p class="mt-2 text-xs leading-6 text-zinc-600">{{ str($news->summary)->limit(120) }}</p>
                    </article>
                @empty
                    <p class="py-6 text-center text-sm text-zinc-400">No updates published yet.</p>
                @endforelse
            </div>
        </div>

        {{-- Community Programs + Leaders --}}
        <div class="admin-panel p-6">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Community &amp; Team</p>
                    <h2 class="mt-2 font-display text-3xl font-semibold text-ecosa-blue-deep">Programs &amp; leadership</h2>
                </div>
                <a href="{{ route('admin.community') }}" class="site-btn-ghost text-xs">Manage Community</a>
            </div>
            <div class="mt-6 grid gap-3">
                @forelse ($latestPrograms as $program)
                    <article class="rounded-[20px] border border-ecosa-blue/8 bg-ecosa-blue/[0.03] p-4">
                        <div class="flex items-center justify-between gap-3">
                            <span class="site-chip text-[0.65rem]">{{ $program->typeLabel() }}</span>
                            <span class="text-xs font-semibold text-ecosa-green-deep">{{ $program->status }}</span>
                        </div>
                        <h3 class="mt-3 font-display text-2xl font-semibold text-ecosa-blue-deep">{{ $program->title }}</h3>
                        <p class="mt-2 text-xs leading-6 text-zinc-600">{{ str($program->summary)->limit(100) }}</p>
                    </article>
                @empty
                    <p class="py-4 text-center text-sm text-zinc-400">No community entries yet.</p>
                @endforelse

                @if ($latestLeaders->isNotEmpty())
                    <div class="mt-2 grid gap-3 sm:grid-cols-2">
                        @foreach ($latestLeaders as $leader)
                            <article class="rounded-[20px] border border-ecosa-blue/8 bg-white p-4">
                                <p class="text-[0.65rem] font-bold uppercase tracking-[0.18em] text-zinc-400">{{ $leader->portfolio }}</p>
                                <h3 class="mt-2 font-display text-xl font-semibold text-ecosa-blue-deep">{{ $leader->title }}</h3>
                                <p class="mt-1 text-xs text-zinc-500">{{ $leader->name ?: $leader->initials }}</p>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const regCtx = document.getElementById('registrationChart');
    if (regCtx) {
        new Chart(regCtx, {
            type: 'line',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'New Members',
                    data: @json($chartData),
                    borderColor: '#17924b',
                    backgroundColor: 'rgba(23,146,75,0.08)',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#17924b',
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    fill: true,
                    tension: 0.4,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#081b2c',
                        titleColor: '#ffd600',
                        bodyColor: '#ffffff',
                        padding: 12,
                        cornerRadius: 12,
                    },
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: '#a3a3a3', font: { size: 11, family: 'Inter, sans-serif' } },
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            color: '#a3a3a3',
                            font: { size: 11, family: 'Inter, sans-serif' },
                        },
                        grid: { color: 'rgba(23,58,96,0.06)' },
                    },
                },
            },
        });
    }

    const payCtx = document.getElementById('paymentChart');
    if (payCtx) {
        new Chart(payCtx, {
            type: 'doughnut',
            data: {
                labels: ['Paid', 'Pending Verification', 'Unpaid'],
                datasets: [{
                    data: [
                        {{ $paymentBreakdown['paid'] }},
                        {{ $paymentBreakdown['pending'] }},
                        {{ $paymentBreakdown['unpaid'] }},
                    ],
                    backgroundColor: ['#17924b', '#ffd600', '#e5e5e5'],
                    borderWidth: 0,
                    hoverOffset: 8,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '72%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#081b2c',
                        titleColor: '#ffd600',
                        bodyColor: '#ffffff',
                        padding: 12,
                        cornerRadius: 12,
                    },
                },
            },
        });
    }
});
</script>
@endpush
