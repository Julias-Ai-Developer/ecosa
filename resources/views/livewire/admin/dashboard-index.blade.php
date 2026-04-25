<div class="space-y-6">

    {{-- ===== PAGE HEADER ===== --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h1 class="font-display text-3xl font-bold text-ecosa-blue-deep">ECOSA Overview</h1>
            <p class="mt-1 text-sm text-zinc-500">Real-time monitoring across membership and community activity</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.news') }}" class="inline-flex items-center gap-2 rounded-xl bg-ecosa-blue-deep px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-ecosa-blue">
                <i class="fas fa-plus text-xs"></i> Publish Update
            </a>
            <a href="{{ route('admin.members') }}" class="inline-flex items-center gap-2 rounded-xl border border-zinc-200 bg-white px-5 py-2.5 text-sm font-semibold text-zinc-700 shadow-sm transition hover:border-zinc-300 hover:text-zinc-900">
                <i class="fas fa-users text-xs"></i> All Members
            </a>
        </div>
    </div>

    {{-- ===== STAT CARDS ===== --}}
    <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($overviewStats as $i => $stat)
        <article class="relative overflow-hidden rounded-2xl border border-zinc-100 bg-white p-5 shadow-sm">
            <div class="flex items-start justify-between">
                <span class="text-xs font-medium text-zinc-500">{{ $stat['label'] }}</span>
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl {{ $stat['color'] }}">
                    <i class="fas {{ $stat['icon'] }} text-sm"></i>
                </div>
            </div>
            <p class="mt-4 font-display text-4xl font-bold tracking-tight text-zinc-900">{{ $stat['value'] }}</p>
            <p class="mt-1.5 flex items-center gap-1 text-xs text-zinc-500">
                @if($stat['up'])
                    <i class="fas fa-arrow-trend-up text-emerald-500"></i>
                    <span class="font-semibold text-emerald-600">{{ $stat['detail'] }}</span>
                @else
                    <i class="fas fa-arrow-trend-down text-rose-400"></i>
                    <span class="text-zinc-400">{{ $stat['detail'] }}</span>
                @endif
            </p>
            <div class="mt-4 h-10">
                <canvas id="spark-{{ $i }}" class="h-full w-full" data-spark="{{ $stat['spark'] }}" data-line="{{ $stat['line'] }}" data-fill="{{ $stat['fill'] }}"></canvas>
            </div>
        </article>
        @endforeach
    </section>

    {{-- ===== CHARTS ROW ===== --}}
    <section class="grid gap-6 xl:grid-cols-[2fr_1fr]">

        {{-- Registration Trend --}}
        <div class="rounded-2xl border border-zinc-100 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                <div>
                    <h2 class="text-base font-bold text-zinc-900">Member Registration Trend</h2>
                    <p class="mt-0.5 text-xs text-zinc-500">New member signups per month over the last 6 months</p>
                </div>
                <a href="{{ route('admin.members') }}" class="shrink-0 rounded-lg border border-zinc-200 px-3 py-1.5 text-xs font-semibold text-zinc-600 transition hover:border-zinc-300 hover:text-zinc-900">View Members →</a>
            </div>
            <div class="relative mt-6 h-60">
                <canvas id="registrationChart" class="h-full w-full"></canvas>
            </div>
        </div>

        {{-- Payment Status Donut --}}
        <div class="rounded-2xl border border-zinc-100 bg-white p-6 shadow-sm">
            <div>
                <h2 class="text-base font-bold text-zinc-900">Payment Status</h2>
                <p class="mt-0.5 text-xs text-zinc-500">Current status across all registered members</p>
            </div>
            <div class="relative mx-auto mt-6 h-44 w-44">
                <canvas id="paymentChart" class="h-full w-full"></canvas>
                <div class="pointer-events-none absolute inset-0 flex flex-col items-center justify-center">
                    <span class="font-display text-3xl font-bold text-zinc-900">{{ $totalMembers }}</span>
                    <span class="text-xs text-zinc-400">Members</span>
                </div>
            </div>
            <div class="mt-6 space-y-3">
                @php
                    $total = max($totalMembers, 1);
                    $legend = [
                        ['label' => 'Paid',     'count' => $paymentBreakdown['paid'],    'dot' => 'bg-emerald-500', 'pct' => 'text-emerald-600', 'bg' => 'bg-emerald-50'],
                        ['label' => 'Pending',  'count' => $paymentBreakdown['pending'], 'dot' => 'bg-amber-400',   'pct' => 'text-amber-600',   'bg' => 'bg-amber-50'],
                        ['label' => 'Unpaid',   'count' => $paymentBreakdown['unpaid'],  'dot' => 'bg-rose-400',    'pct' => 'text-rose-600',    'bg' => 'bg-rose-50'],
                    ];
                @endphp
                @foreach($legend as $leg)
                <div class="flex items-center justify-between rounded-xl {{ $leg['bg'] }} px-3 py-2">
                    <div class="flex items-center gap-2">
                        <span class="h-2.5 w-2.5 rounded-full {{ $leg['dot'] }}"></span>
                        <span class="text-sm font-medium text-zinc-700">{{ $leg['label'] }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-sm font-bold text-zinc-900">{{ $leg['count'] }}</span>
                        <span class="text-xs font-bold {{ $leg['pct'] }}">{{ round($leg['count'] / $total * 100) }}%</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== BOTTOM ROW ===== --}}
    <section class="grid gap-6 xl:grid-cols-[1.2fr_0.8fr]">

        {{-- Recent Members Table --}}
        <div class="overflow-hidden rounded-2xl border border-zinc-100 bg-white shadow-sm">
            <div class="flex items-center justify-between border-b border-zinc-100 px-6 py-4">
                <div>
                    <h2 class="text-base font-bold text-zinc-900">Recent Registrations</h2>
                    <p class="mt-0.5 text-xs text-zinc-500">Latest member signups across the network</p>
                </div>
                <div class="flex items-center gap-3">
                    @if($todayMembers > 0)
                        <span class="rounded-full bg-ecosa-green/10 px-3 py-1 text-xs font-bold text-ecosa-green-deep">
                            → {{ $todayMembers }} today
                        </span>
                    @endif
                    <a href="{{ route('admin.members') }}" class="rounded-lg border border-zinc-200 px-3 py-1.5 text-xs font-semibold text-zinc-600 transition hover:border-zinc-300">View All →</a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="border-b border-zinc-100 bg-zinc-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-[0.68rem] font-bold uppercase tracking-[0.18em] text-zinc-400">EC ID</th>
                            <th class="px-6 py-3 text-left text-[0.68rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Member</th>
                            <th class="px-6 py-3 text-left text-[0.68rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Status</th>
                            <th class="px-6 py-3 text-left text-[0.68rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Joined</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-50">
                        @forelse ($latestMemberships as $member)
                        <tr class="transition hover:bg-zinc-50">
                            <td class="px-6 py-3.5">
                                <span class="rounded-lg bg-ecosa-blue/8 px-2.5 py-1 font-mono text-xs font-bold text-ecosa-blue-deep">{{ $member->membership_number }}</span>
                            </td>
                            <td class="px-6 py-3.5">
                                <p class="font-semibold text-zinc-900">{{ $member->full_name }}</p>
                                <p class="text-xs text-zinc-400">{{ $member->email }}</p>
                            </td>
                            <td class="px-6 py-3.5">
                                <span class="rounded-full px-3 py-1 text-xs font-bold {{ $member->paymentStatusTone() }}">{{ $member->paymentStatusLabel() }}</span>
                            </td>
                            <td class="px-6 py-3.5 text-xs text-zinc-400">{{ $member->created_at->format('M j, Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-sm text-zinc-400">No membership records yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Active Messages --}}
        <div class="overflow-hidden rounded-2xl border border-zinc-100 bg-white shadow-sm">
            <div class="flex items-center justify-between border-b border-zinc-100 px-6 py-4">
                <div>
                    <h2 class="text-base font-bold text-zinc-900">Active Messages</h2>
                    <p class="mt-0.5 text-xs text-zinc-500">Unread contact submissions</p>
                </div>
                <a href="{{ route('admin.messages') }}" class="rounded-lg border border-zinc-200 px-3 py-1.5 text-xs font-semibold text-zinc-600 transition hover:border-zinc-300">View All →</a>
            </div>
            <div class="divide-y divide-zinc-50">
                @forelse ($latestInquiries as $inquiry)
                <div class="px-6 py-4 transition hover:bg-zinc-50">
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex items-start gap-3">
                            <div class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-ecosa-burgundy/10 text-ecosa-burgundy">
                                <i class="fas fa-envelope text-xs"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-zinc-900">{{ $inquiry->name }}</p>
                                <p class="text-xs text-zinc-400">{{ $inquiry->inquiry_type }}</p>
                            </div>
                        </div>
                        <span class="shrink-0 rounded-full {{ $inquiry->status === 'new' ? 'bg-rose-50 text-rose-600' : 'bg-zinc-100 text-zinc-500' }} px-2.5 py-0.5 text-[0.65rem] font-bold uppercase tracking-[0.1em]">{{ $inquiry->status }}</span>
                    </div>
                    <p class="mt-2.5 pl-11 text-xs leading-5 text-zinc-500">{{ str($inquiry->message)->limit(90) }}</p>
                    <p class="mt-1.5 pl-11 text-[0.65rem] text-zinc-400">{{ $inquiry->created_at->diffForHumans() }}</p>
                </div>
                @empty
                <div class="px-6 py-12 text-center text-sm text-zinc-400">No messages yet.</div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ===== NEWS + COMMUNITY ===== --}}
    <section class="grid gap-6 xl:grid-cols-2">

        {{-- Latest News --}}
        <div class="overflow-hidden rounded-2xl border border-zinc-100 bg-white shadow-sm">
            <div class="flex items-center justify-between border-b border-zinc-100 px-6 py-4">
                <div>
                    <h2 class="text-base font-bold text-zinc-900">Latest Updates</h2>
                    <p class="mt-0.5 text-xs text-zinc-500">Published news &amp; announcements</p>
                </div>
                <a href="{{ route('admin.news') }}" class="rounded-lg border border-zinc-200 px-3 py-1.5 text-xs font-semibold text-zinc-600 transition hover:border-zinc-300">Manage →</a>
            </div>
            <div class="divide-y divide-zinc-50">
                @forelse ($latestNews as $news)
                <div class="px-6 py-4 transition hover:bg-zinc-50">
                    <div class="flex items-center gap-2">
                        <span class="rounded-full bg-ecosa-blue/8 px-2.5 py-0.5 text-[0.65rem] font-bold uppercase tracking-[0.12em] text-ecosa-blue">{{ $news->category }}</span>
                        @if($news->published_at)
                            <span class="text-[0.65rem] text-zinc-400">{{ $news->published_at->format('M j, Y') }}</span>
                        @endif
                    </div>
                    <h3 class="mt-2 text-sm font-bold text-zinc-900">{{ $news->title }}</h3>
                    <p class="mt-1 text-xs leading-5 text-zinc-500">{{ str($news->summary)->limit(110) }}</p>
                </div>
                @empty
                <div class="px-6 py-12 text-center text-sm text-zinc-400">No updates published yet.</div>
                @endforelse
            </div>
        </div>

        {{-- Community Programs + Leaders --}}
        <div class="overflow-hidden rounded-2xl border border-zinc-100 bg-white shadow-sm">
            <div class="flex items-center justify-between border-b border-zinc-100 px-6 py-4">
                <div>
                    <h2 class="text-base font-bold text-zinc-900">Programs &amp; Leadership</h2>
                    <p class="mt-0.5 text-xs text-zinc-500">Active community programs &amp; key leaders</p>
                </div>
                <a href="{{ route('admin.community') }}" class="rounded-lg border border-zinc-200 px-3 py-1.5 text-xs font-semibold text-zinc-600 transition hover:border-zinc-300">Manage →</a>
            </div>
            <div class="divide-y divide-zinc-50">
                @forelse ($latestPrograms as $program)
                <div class="px-6 py-4 transition hover:bg-zinc-50">
                    <div class="flex items-center justify-between gap-3">
                        <span class="rounded-full bg-ecosa-green/10 px-2.5 py-0.5 text-[0.65rem] font-bold uppercase tracking-[0.12em] text-ecosa-green-deep">{{ $program->typeLabel() }}</span>
                        <span class="text-[0.65rem] font-semibold {{ $program->status === 'active' ? 'text-emerald-600' : 'text-zinc-400' }}">{{ $program->status }}</span>
                    </div>
                    <h3 class="mt-2 text-sm font-bold text-zinc-900">{{ $program->title }}</h3>
                    <p class="mt-1 text-xs leading-5 text-zinc-500">{{ str($program->summary)->limit(100) }}</p>
                </div>
                @empty
                <div class="px-6 py-12 text-center text-sm text-zinc-400">No community entries yet.</div>
                @endforelse
            </div>
            @if($latestLeaders->isNotEmpty())
            <div class="border-t border-zinc-100 bg-zinc-50 px-6 py-4">
                <p class="mb-3 text-[0.68rem] font-bold uppercase tracking-[0.18em] text-zinc-400">Leadership</p>
                <div class="grid gap-2 sm:grid-cols-2">
                    @foreach($latestLeaders as $leader)
                    <div class="rounded-xl border border-zinc-100 bg-white p-3">
                        <p class="text-[0.65rem] font-bold uppercase tracking-[0.14em] text-zinc-400">{{ $leader->portfolio }}</p>
                        <p class="mt-1 text-sm font-semibold text-ecosa-blue-deep">{{ $leader->title }}</p>
                        <p class="text-xs text-zinc-400">{{ $leader->name ?: $leader->initials }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </section>

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const sparkMembers  = @json($sparkMembers);
    const sparkMessages = @json($sparkMessages);

    // Draw sparklines on stat cards
    document.querySelectorAll('[id^="spark-"]').forEach(canvas => {
        const key  = canvas.dataset.spark;
        const data = key === 'sparkMembers' ? sparkMembers : sparkMessages;
        const line = canvas.dataset.line;
        const fill = canvas.dataset.fill;
        new Chart(canvas, {
            type: 'line',
            data: {
                labels: data.map((_, i) => i),
                datasets: [{ data, borderColor: line, backgroundColor: fill, borderWidth: 2, fill: true, tension: 0.4, pointRadius: 0 }],
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display: false }, tooltip: { enabled: false } },
                scales: { x: { display: false }, y: { display: false, beginAtZero: true } },
                animation: { duration: 600 },
            },
        });
    });

    // Registration trend line chart
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
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
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
                        cornerRadius: 10,
                        callbacks: {
                            title: (items) => items[0].label,
                            label: (item) => ` ${item.raw} new registrations`,
                        },
                    },
                },
                scales: {
                    x: {
                        grid: { display: false },
                        border: { display: false },
                        ticks: { color: '#a3a3a3', font: { size: 11 } },
                    },
                    y: {
                        beginAtZero: true,
                        border: { display: false },
                        grid: { color: 'rgba(0,0,0,0.04)' },
                        ticks: { stepSize: 1, color: '#a3a3a3', font: { size: 11 } },
                    },
                },
            },
        });
    }

    // Payment donut
    const payCtx = document.getElementById('paymentChart');
    if (payCtx) {
        new Chart(payCtx, {
            type: 'doughnut',
            data: {
                labels: ['Paid', 'Pending', 'Unpaid'],
                datasets: [{
                    data: [
                        {{ $paymentBreakdown['paid'] }},
                        {{ $paymentBreakdown['pending'] }},
                        {{ $paymentBreakdown['unpaid'] }},
                    ],
                    backgroundColor: ['#10b981', '#f59e0b', '#fb7185'],
                    borderWidth: 0,
                    hoverOffset: 6,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#081b2c',
                        titleColor: '#ffd600',
                        bodyColor: '#fff',
                        padding: 10,
                        cornerRadius: 10,
                    },
                },
            },
        });
    }
});
</script>
@endpush
