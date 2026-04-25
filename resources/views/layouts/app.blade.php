@props([
    'title' => null,
])

@php
    $user = auth()->user();
    $adminSections = [
        [
            'heading' => 'Control Center',
            'items' => [
                ['label' => 'Admin Dashboard', 'route' => 'admin.dashboard', 'icon' => 'fa-gauge-high'],
                ['label' => 'News Manager', 'route' => 'admin.news', 'icon' => 'fa-newspaper'],
                ['label' => 'Community Pages', 'route' => 'admin.community', 'icon' => 'fa-layer-group'],
                ['label' => 'Team Content', 'route' => 'admin.team', 'icon' => 'fa-users-gear'],
                ['label' => 'Members', 'route' => 'admin.members', 'icon' => 'fa-id-card'],
                ['label' => 'Messages', 'route' => 'admin.messages', 'icon' => 'fa-envelope-open-text'],
            ],
        ],
    ];

    $memberSections = [
        [
            'heading' => 'Member Area',
            'items' => [
                ['label' => 'Member Portal', 'route' => 'dashboard', 'icon' => 'fa-address-card'],
                ['label' => 'Membership Hub', 'route' => 'site.membership', 'icon' => 'fa-user-plus'],
                ['label' => 'Public Website', 'route' => 'home', 'icon' => 'fa-globe'],
                ['label' => 'Settings', 'route' => 'profile.edit', 'icon' => 'fa-gear'],
            ],
        ],
    ];

    $navSections = $user?->is_admin ? array_merge($adminSections, $memberSections) : $memberSections;
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="ecosa-admin-surface min-h-screen text-zinc-900" x-data="{ sidebarOpen: false }">
        <div class="min-h-screen">
            <div
                x-cloak
                x-show="sidebarOpen"
                x-transition.opacity.duration.250ms
                class="fixed inset-0 z-40 bg-[#081b2c]/65 lg:hidden"
                @click="sidebarOpen = false"
            ></div>

            <aside
                class="fixed inset-y-0 left-0 z-50 w-[290px] -translate-x-full border-r border-white/10 bg-[#081b2c] text-white shadow-2xl transition duration-300 lg:translate-x-0"
                :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            >
                <div class="flex h-full flex-col">
                    <div class="border-b border-white/8 px-6 py-6">
                        <a href="{{ $user?->is_admin ? route('admin.dashboard') : route('dashboard') }}" class="flex items-center gap-3">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="ECOSA Logo" class="h-12 w-12 rounded-2xl bg-white object-contain p-2">
                            <div>
                                <p class="font-display text-2xl font-semibold leading-none">ECOSA</p>
                                <p class="mt-1 text-xs font-bold uppercase tracking-[0.24em] text-white/50">
                                    {{ $user?->is_admin ? 'Admin System' : 'Member Portal' }}
                                </p>
                            </div>
                        </a>
                    </div>

                    <div class="flex-1 space-y-8 overflow-y-auto px-5 py-6">
                        @foreach ($navSections as $section)
                            <div>
                                <p class="px-3 text-xs font-bold uppercase tracking-[0.24em] text-white/40">{{ $section['heading'] }}</p>
                                <div class="mt-3 grid gap-2">
                                    @foreach ($section['items'] as $item)
                                        <a
                                            href="{{ route($item['route']) }}"
                                            class="{{ request()->routeIs($item['route']) ? 'bg-white text-[#081b2c] shadow-[0_18px_30px_rgba(255,255,255,0.15)]' : 'text-white/72 hover:bg-white/8 hover:text-white' }} flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold"
                                        >
                                            <i class="fas {{ $item['icon'] }} w-4 text-center"></i>
                                            <span>{{ $item['label'] }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-white/8 px-5 py-5">
                        <div class="rounded-[24px] border border-white/10 bg-white/6 p-4">
                            <p class="text-sm font-bold text-white">{{ $user->name }}</p>
                            <p class="mt-1 text-xs text-white/58">{{ $user->email }}</p>
                            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                                @csrf
                                <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-full border border-white/12 px-4 py-3 text-sm font-bold text-white transition hover:bg-white/10">
                                    <i class="fas fa-arrow-right-from-bracket"></i>
                                    <span>Log out</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </aside>

            <div class="lg:pl-[290px]">
                <header class="sticky top-0 z-30 border-b border-white/70 bg-white/85 backdrop-blur-xl">
                    <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-5 py-4 lg:px-8">
                        <div class="flex items-center gap-3">
                            <button
                                type="button"
                                class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-ecosa-blue/10 text-ecosa-blue lg:hidden"
                                @click="sidebarOpen = true"
                                aria-label="Open sidebar"
                            >
                                <i class="fas fa-bars"></i>
                            </button>
                            <div>
                                <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">{{ $user?->is_admin ? 'System visibility' : 'Member access' }}</p>
                                <h1 class="font-display text-3xl font-semibold leading-none text-ecosa-blue-deep">{{ $title ?? 'ECOSA' }}</h1>
                            </div>
                        </div>

                        <div class="hidden items-center gap-3 md:flex">
                            @if ($user?->is_admin)
                                <a href="{{ route('admin.dashboard') }}" class="site-btn-ghost px-5 py-2.5">Admin Home</a>
                            @endif
                            <a href="{{ route('dashboard') }}" class="site-btn-ghost px-5 py-2.5">Member Portal</a>
                            <a href="{{ route('home') }}" class="site-btn-primary px-5 py-2.5">Public Website</a>
                        </div>
                    </div>
                </header>

                <main class="px-5 py-6 lg:px-8 lg:py-8">
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
