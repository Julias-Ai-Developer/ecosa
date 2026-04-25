<div class="mx-auto max-w-7xl space-y-6">

    {{-- Hero Banner --}}
    <section class="rounded-[34px] bg-[linear-gradient(135deg,#081b2c,#173a60)] px-7 py-9 text-white shadow-[var(--shadow-soft)] sm:px-9">
        <p class="text-xs font-bold uppercase tracking-[0.24em] text-white/48">Administrative System</p>
        <div class="mt-5 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <h1 class="font-display text-5xl font-semibold text-balance">ECOSA Admin Control Center</h1>
                <p class="mt-4 max-w-3xl text-sm leading-7 text-white/72">
                    Manage members, content, leadership, community programs, and website messages — all from one dashboard.
                </p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.news') }}" class="site-btn-secondary">
                    <i class="fas fa-plus mr-1"></i> Publish Update
                </a>
                <a href="{{ route('admin.members') }}" class="site-btn-ghost border-white/12 bg-white/10 text-white hover:bg-white/16">
                    <i class="fas fa-users mr-1"></i> View All Members
                </a>
            </div>
        </div>
    </section>

    {{-- Stats Cards --}}
    <section class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($overviewStats as $stat)
            <article class="admin-panel overflow-hidden">
                <div class="bg-gradient-to-br {{ $stat['tone'] }} px-6 py-5">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-[0.22em] opacity-65">{{ $stat['label'] }}</p>
                            <p class="mt-3 font-display text-5xl font-semibold">{{ $stat['value'] }}</p>
                        </div>
                        <div class="stat-card-icon">
                            <i class="fas {{ $stat['icon'] }}"></i>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 text-xs leading-6 text-zinc-500">
                    {{ $stat['detail'] }}
                </div>
            </article>
        @endforeach
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

    {{-- Quick Nav to Modules --}}
    <section class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ([
            ['route' => 'admin.news',      'icon' => 'fa-newspaper',         'label' => 'News Manager',      'color' => 'bg-ecosa-blue/8 text-ecosa-blue'],
            ['route' => 'admin.community', 'icon' => 'fa-layer-group',        'label' => 'Community Pages',   'color' => 'bg-ecosa-green/10 text-ecosa-green-deep'],
            ['route' => 'admin.team',      'icon' => 'fa-users-gear',         'label' => 'Team Profiles',     'color' => 'bg-ecosa-gold/20 text-yellow-700'],
            ['route' => 'admin.messages',  'icon' => 'fa-envelope-open-text', 'label' => 'Messages',          'color' => 'bg-ecosa-burgundy/10 text-ecosa-burgundy'],
        ] as $mod)
            <a href="{{ route($mod['route']) }}" class="admin-panel flex items-center gap-4 p-5 transition hover:shadow-[var(--shadow-soft)]">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl {{ $mod['color'] }}">
                    <i class="fas {{ $mod['icon'] }}"></i>
                </div>
                <span class="font-accent text-sm font-bold text-ecosa-blue-deep">{{ $mod['label'] }}</span>
                <i class="fas fa-arrow-right ml-auto text-xs text-zinc-400"></i>
            </a>
        @endforeach
    </section>

    {{-- Members + Messages --}}
    <section class="grid gap-6 xl:grid-cols-[1.1fr_0.9fr]">
        {{-- Recent Members --}}
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
    // Registration Trend Chart
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
                        ticks: { color: '#a3a3a3', font: { size: 11, family: 'Plus Jakarta Sans, Manrope, sans-serif' } },
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            color: '#a3a3a3',
                            font: { size: 11, family: 'Plus Jakarta Sans, Manrope, sans-serif' },
                        },
                        grid: { color: 'rgba(23,58,96,0.06)' },
                    },
                },
            },
        });
    }

    // Payment Status Donut Chart
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
