@props([
    'title' => null,
])

@php
    $user = auth()->user();

    $sidebarPendingCount = $user?->is_admin ? \App\Models\MembershipProfile::where('payment_status', 'pending_verification')->count() : 0;
    $sidebarMessageCount = $user?->is_admin ? \App\Models\ContactInquiry::where('status', 'new')->count() : 0;

    $adminSections = [
        [
            'heading' => 'Overview',
            'items' => [
                ['label' => 'Dashboard',       'route' => 'admin.dashboard', 'icon' => 'fa-gauge-high',        'badge' => null],
            ],
        ],
        [
            'heading' => 'Content',
            'items' => [
                ['label' => 'News Manager',    'route' => 'admin.news',      'icon' => 'fa-newspaper',          'badge' => null],
                ['label' => 'Community Pages', 'route' => 'admin.community', 'icon' => 'fa-layer-group',        'badge' => null],
                ['label' => 'Team Content',    'route' => 'admin.team',      'icon' => 'fa-users-gear',         'badge' => null],
            ],
        ],
        [
            'heading' => 'Members',
            'items' => [
                ['label' => 'All Members',     'route' => 'admin.members',   'icon' => 'fa-id-card',            'badge' => $sidebarPendingCount ?: null, 'badgeColor' => 'bg-ecosa-gold/30 text-ecosa-gold'],
                ['label' => 'Messages',        'route' => 'admin.messages',  'icon' => 'fa-envelope-open-text', 'badge' => $sidebarMessageCount ?: null, 'badgeColor' => 'bg-white/20 text-white'],
            ],
        ],
        [
            'heading' => 'System',
            'items' => [
                ['label' => 'Member Portal',   'route' => 'dashboard',       'icon' => 'fa-address-card',       'badge' => null],
                ['label' => 'Public Website',  'route' => 'home',            'icon' => 'fa-globe',              'badge' => null],
                ['label' => 'Settings',        'route' => 'profile.edit',    'icon' => 'fa-gear',               'badge' => null],
            ],
        ],
    ];

    $memberSections = [
        [
            'heading' => 'Member Area',
            'items' => [
                ['label' => 'Member Portal',   'route' => 'dashboard',       'icon' => 'fa-address-card',       'badge' => null],
                ['label' => 'Membership Hub',  'route' => 'site.membership', 'icon' => 'fa-user-plus',          'badge' => null],
                ['label' => 'Public Website',  'route' => 'home',            'icon' => 'fa-globe',              'badge' => null],
                ['label' => 'Settings',        'route' => 'profile.edit',    'icon' => 'fa-gear',               'badge' => null],
            ],
        ],
    ];

    $navSections = $user?->is_admin ? $adminSections : $memberSections;
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="bg-zinc-50 text-zinc-900 antialiased" x-data="{ sidebarOpen: false }">

        <div class="flex h-screen overflow-hidden">

            {{-- ===== MOBILE OVERLAY ===== --}}
            <div
                x-cloak
                x-show="sidebarOpen"
                x-transition.opacity.duration.200ms
                class="fixed inset-0 z-30 bg-black/50 lg:hidden"
                @click="sidebarOpen = false"
            ></div>

            {{-- ===== SIDEBAR ===== --}}
            <aside
                class="fixed inset-y-0 left-0 z-40 flex w-64 shrink-0 flex-col bg-[#0e6433] text-white shadow-xl
                       -translate-x-full transition-transform duration-300
                       lg:static lg:translate-x-0"
                :class="sidebarOpen ? 'translate-x-0' : ''"
            >
                {{-- Logo area --}}
                <div class="flex items-center gap-3 border-b border-black/10 px-5 py-5">
                    <a href="{{ $user?->is_admin ? route('admin.dashboard') : route('dashboard') }}"
                       class="flex items-center gap-3">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white/15">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="ECOSA" class="h-7 w-7 object-contain">
                        </div>
                        <div>
                            <p class="text-base font-bold leading-none text-white">ECOSA</p>
                            <p class="mt-0.5 text-[0.6rem] font-semibold uppercase tracking-[0.22em] text-white/55">
                                {{ $user?->is_admin ? 'Admin System' : 'Member Portal' }}
                            </p>
                        </div>
                    </a>
                </div>

                {{-- Navigation --}}
                <nav class="flex-1 overflow-y-auto px-3 py-5 space-y-5">
                    @foreach ($navSections as $section)
                    <div>
                        <p class="mb-1 px-3 text-[0.58rem] font-bold uppercase tracking-[0.22em] text-white/40">
                            {{ $section['heading'] }}
                        </p>
                        <div class="space-y-0.5">
                            @foreach ($section['items'] as $item)
                                @php $isActive = request()->routeIs($item['route']); @endphp
                                <a href="{{ route($item['route']) }}"
                                   class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-150
                                          {{ $isActive
                                              ? 'bg-black/20 text-white shadow-inner'
                                              : 'text-white/65 hover:bg-black/10 hover:text-white' }}">
                                    <i class="fas {{ $item['icon'] }} w-4 shrink-0 text-center text-[0.8rem]
                                               {{ $isActive ? 'text-ecosa-gold' : 'text-white/50 group-hover:text-white/80' }}"></i>
                                    <span class="flex-1 leading-none">{{ $item['label'] }}</span>
                                    @if(!empty($item['badge']))
                                        <span class="rounded-full {{ $item['badgeColor'] ?? 'bg-white/20 text-white' }} px-2 py-0.5 text-[0.6rem] font-bold tabular-nums leading-none">
                                            {{ $item['badge'] }}
                                        </span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </nav>

                {{-- User card --}}
                <div class="border-t border-black/10 p-4">
                    <div class="flex items-center gap-3 rounded-xl bg-black/15 px-3 py-3">
                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-white/20 text-xs font-bold text-white">
                            {{ $user->initials() }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-semibold leading-none text-white">{{ $user->name }}</p>
                            <p class="mt-0.5 text-[0.65rem] text-white/50">{{ $user?->is_admin ? 'Administrator' : 'Member' }}</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" title="Log out"
                                    class="flex h-7 w-7 items-center justify-center rounded-lg text-white/40 transition hover:bg-white/10 hover:text-white/80">
                                <i class="fas fa-arrow-right-from-bracket text-xs"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </aside>

            {{-- ===== MAIN CONTENT ===== --}}
            <div class="flex flex-1 flex-col overflow-hidden">

                {{-- Header --}}
                <header class="shrink-0 border-b border-zinc-200 bg-white shadow-sm">
                    <div class="flex items-center justify-between gap-4 px-5 py-3.5 lg:px-8">
                        <div class="flex items-center gap-4">
                            <button
                                type="button"
                                class="flex h-9 w-9 items-center justify-center rounded-lg border border-zinc-200 text-zinc-600 lg:hidden"
                                @click="sidebarOpen = true"
                                aria-label="Open menu"
                            >
                                <i class="fas fa-bars text-sm"></i>
                            </button>
                            <div>
                                <p class="text-[0.65rem] font-bold uppercase tracking-[0.22em] text-zinc-400">
                                    {{ $user?->is_admin ? 'System Visibility' : 'Member Access' }}
                                </p>
                                <h1 class="text-xl font-bold leading-tight text-zinc-900">{{ $title ?? 'ECOSA' }}</h1>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            @if($user?->is_admin)
                                <a href="{{ route('admin.dashboard') }}"
                                   class="hidden rounded-lg border border-zinc-200 bg-white px-4 py-2 text-sm font-semibold text-zinc-700 transition hover:border-zinc-300 hover:text-zinc-900 md:inline-flex">
                                    Admin Home
                                </a>
                            @endif
                            <a href="{{ route('dashboard') }}"
                               class="hidden rounded-lg border border-zinc-200 bg-white px-4 py-2 text-sm font-semibold text-zinc-700 transition hover:border-zinc-300 hover:text-zinc-900 md:inline-flex">
                                Member Portal
                            </a>
                            <a href="{{ route('home') }}"
                               class="rounded-lg bg-ecosa-green px-4 py-2 text-sm font-semibold text-white transition hover:bg-ecosa-green-deep">
                                Public Website
                            </a>
                        </div>
                    </div>
                </header>

                {{-- Page content --}}
                <main class="flex-1 overflow-y-auto px-5 py-6 lg:px-8 lg:py-8">
                    {{ $slot }}
                </main>
            </div>

        </div>

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @stack('scripts')
        @fluxScripts
    </body>
</html>
