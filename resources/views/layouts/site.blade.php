@props([
    'title' => null,
])

@php
    $organization = \App\Support\EcosaSite::organization();
    $whatsAppContacts = \App\Support\EcosaSite::whatsappContacts();
    $primaryPhone = preg_replace('/\D+/', '', $organization['phones'][0]);

    $navigation = [
        [
            'label' => 'Home',
            'route' => 'home',
            'children' => [],
        ],
        [
            'label' => 'About',
            'route' => 'site.about',
            'children' => [
                ['label' => 'About ECOSA', 'route' => 'site.about'],
                ['label' => 'Leadership', 'route' => 'site.leadership'],
                ['label' => 'Governance', 'route' => 'site.governance'],
            ],
            'active' => request()->routeIs('site.about', 'site.leadership', 'site.governance'),
        ],
        [
            'label' => 'Membership',
            'route' => 'site.membership',
            'children' => [
                ['label' => 'Membership Hub', 'route' => 'site.membership'],
                ['label' => 'Register', 'route' => 'site.membership.register'],
                ['label' => 'Member Login', 'route' => 'login'],
            ],
            'active' => request()->routeIs('site.membership', 'site.membership.register'),
        ],
        [
            'label' => 'Community',
            'route' => 'site.community',
            'children' => [
                ['label' => 'Community Overview', 'route' => 'site.community'],
                ['label' => 'Events', 'route' => 'site.community.events'],
                ['label' => 'Projects', 'route' => 'site.community.projects'],
                ['label' => 'Insurance Group', 'route' => 'site.community.insurance'],
            ],
            'active' => request()->routeIs('site.community', 'site.community.events', 'site.community.projects', 'site.community.insurance'),
        ],
        [
            'label' => 'Updates',
            'route' => 'site.updates',
            'children' => [],
        ],
        [
            'label' => 'Contact',
            'route' => 'site.contact',
            'children' => [],
        ],
    ];

    $footerQuickLinks = [
        ['label' => 'Home', 'route' => 'home'],
        ['label' => 'Membership Hub', 'route' => 'site.membership'],
        ['label' => 'Register Now', 'route' => 'site.membership.register'],
        ['label' => 'Community Events', 'route' => 'site.community.events'],
        ['label' => 'Latest Updates', 'route' => 'site.updates'],
    ];

    $footerAbout = [
        ['label' => 'About ECOSA', 'route' => 'site.about'],
        ['label' => 'Leadership', 'route' => 'site.leadership'],
        ['label' => 'Governance', 'route' => 'site.governance'],
        ['label' => 'Projects', 'route' => 'site.community.projects'],
        ['label' => 'Insurance Group', 'route' => 'site.community.insurance'],
    ];

    $footerValues = [
        ['icon' => 'fa-users', 'title' => 'Legacy & Heritage', 'text' => 'United by a shared school history and purpose.'],
        ['icon' => 'fa-shield-heart', 'title' => 'Member Welfare', 'text' => 'Welfare, insurance, and solidarity support.'],
        ['icon' => 'fa-handshake', 'title' => 'Community Impact', 'text' => 'Programs that give back to school and society.'],
        ['icon' => 'fa-briefcase', 'title' => 'Professional Growth', 'text' => 'Networking, mentorship, and career connections.'],
    ];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ filled($title) ? $title.' | ECOSA' : 'ECOSA | Equatorial College School Old Students Association' }}</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body
        class="site-shell text-ecosa-ink"
        x-data="{
            mobileMenu: false,
            registerDrawer: false,
            whatsappOpen: false,
        }"
        :class="{ 'overflow-hidden': mobileMenu || registerDrawer }"
        @keydown.escape.window="mobileMenu = false; registerDrawer = false; whatsappOpen = false"
    >
        {{-- Top Info Bar --}}
        <div class="border-b border-white/10 bg-ecosa-blue-deep text-white">
            <div class="font-accent mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-3 px-5 py-3 text-xs sm:text-sm lg:px-8">
                <div class="flex flex-wrap items-center gap-x-5 gap-y-2">
                    <a href="mailto:{{ $organization['emails'][0] }}" class="inline-flex items-center gap-2 text-white/78 hover:text-white">
                        <i class="fas fa-envelope text-ecosa-green"></i>
                        <span>{{ $organization['emails'][0] }}</span>
                    </a>
                    <a href="tel:{{ $organization['phones'][0] }}" class="inline-flex items-center gap-2 text-white/78 hover:text-white">
                        <i class="fas fa-phone text-ecosa-green"></i>
                        <span>{{ $organization['phones'][0] }}</span>
                    </a>
                </div>

                <div class="flex flex-wrap items-center gap-x-5 gap-y-2">
                    <span class="inline-flex items-center gap-2 text-white/72">
                        <i class="fas fa-location-dot text-ecosa-gold"></i>
                        <span>{{ $organization['location_short'] }}</span>
                    </span>
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-white/80 hover:text-white">
                        <i class="fas fa-lock text-ecosa-green"></i>
                        <span>Member Login</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Sticky Header / Navigation --}}
        <header class="sticky top-0 z-40 border-b border-ecosa-blue/8 bg-white/92 shadow-[0_14px_32px_rgba(8,27,44,0.08)] backdrop-blur-xl">
            <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-5 py-4 lg:px-8">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="ECOSA Logo" class="h-14 w-14 rounded-2xl border border-ecosa-blue/10 bg-white object-contain p-2 shadow-sm">
                    <div>
                        <p class="font-display text-2xl font-semibold leading-none text-ecosa-blue-deep">ECOSA</p>
                        <p class="mt-1 text-xs font-bold uppercase tracking-[0.24em] text-zinc-500">Old Students Association</p>
                    </div>
                </a>

                <button
                    type="button"
                    class="inline-flex h-12 w-12 items-center justify-center rounded-full border border-ecosa-blue/10 text-ecosa-blue lg:hidden"
                    @click="mobileMenu = !mobileMenu"
                    aria-label="Toggle menu"
                >
                    <i class="fas" :class="mobileMenu ? 'fa-xmark' : 'fa-bars'"></i>
                </button>

                <div class="hidden items-center gap-3 lg:flex">
                    <nav class="font-accent flex items-center gap-2">
                        @foreach ($navigation as $item)
                            @php
                                $itemActive = $item['active'] ?? request()->routeIs($item['route']);
                            @endphp
                            @if (! empty($item['children']))
                                <div class="site-nav-item {{ $itemActive ? 'is-active' : '' }} relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                                    <div class="site-nav-link-group">
                                        <a href="{{ route($item['route']) }}" class="site-nav-link">{{ $item['label'] }}</a>
                                        <button type="button" class="site-nav-toggle" @click.prevent="open = !open" aria-label="Toggle {{ $item['label'] }} submenu">
                                            <i class="fas fa-angle-down text-xs transition" :class="open ? 'rotate-180' : ''"></i>
                                        </button>
                                    </div>
                                    <div
                                        x-cloak x-show="open"
                                        x-transition.origin.top.duration.200ms
                                        @click.outside="open = false"
                                        class="absolute left-1/2 top-full mt-4 w-72 -translate-x-1/2 rounded-[24px] border border-ecosa-blue/8 bg-white p-3 shadow-[var(--shadow-soft)]"
                                    >
                                        @foreach ($item['children'] as $child)
                                            <a href="{{ route($child['route']) }}" class="flex items-center justify-between rounded-2xl px-4 py-3 text-sm font-semibold text-ecosa-blue-deep transition hover:bg-ecosa-blue/5">
                                                <span>{{ $child['label'] }}</span>
                                                <i class="fas fa-arrow-right text-xs text-zinc-400"></i>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="site-nav-item {{ $itemActive ? 'is-active' : '' }}">
                                    <a href="{{ route($item['route']) }}" class="site-nav-link">{{ $item['label'] }}</a>
                                </div>
                            @endif
                        @endforeach
                    </nav>

                    <div class="flex items-center gap-3">
                        <a href="{{ route('site.membership.register') }}" class="site-nav-cta-outline whitespace-nowrap">Register</a>
                        <a href="{{ route('login') }}" class="whitespace-nowrap rounded-[10px] bg-ecosa-green px-4 py-2 text-sm font-bold text-white transition hover:bg-ecosa-green-deep">Log in</a>
                    </div>
                </div>
            </div>

            {{-- Mobile Menu --}}
            <div x-cloak x-show="mobileMenu" x-transition.opacity.duration.250ms class="border-t border-ecosa-blue/8 bg-white lg:hidden">
                <div class="mx-auto max-w-7xl space-y-4 px-5 py-5">
                    @foreach ($navigation as $item)
                        @php $itemActive = $item['active'] ?? request()->routeIs($item['route']); @endphp
                        @if (filled($item['children']))
                            <details class="rounded-[22px] border border-ecosa-blue/8 bg-ecosa-blue/[0.03] p-4">
                                <summary class="flex cursor-pointer list-none items-center justify-between text-sm font-bold text-ecosa-blue-deep">
                                    <span>{{ $item['label'] }}</span>
                                    <i class="fas fa-angle-down text-xs text-zinc-500"></i>
                                </summary>
                                <div class="mt-3 grid gap-2">
                                    @foreach ($item['children'] as $child)
                                        <a href="{{ route($child['route']) }}" class="rounded-[10px] border-l-2 px-4 py-3 text-sm font-semibold {{ request()->routeIs($child['route']) ? 'border-ecosa-green bg-white text-ecosa-green-deep' : 'border-transparent text-zinc-700 hover:border-ecosa-green/35 hover:bg-white' }}">
                                            {{ $child['label'] }}
                                        </a>
                                    @endforeach
                                </div>
                            </details>
                        @else
                            <a href="{{ route($item['route']) }}" class="{{ $itemActive ? 'border-l-2 border-ecosa-green bg-white text-ecosa-green-deep' : 'border-l-2 border-transparent bg-ecosa-blue/[0.03] text-ecosa-blue-deep hover:border-ecosa-green/35' }} flex items-center justify-between rounded-[10px] px-5 py-4 text-sm font-bold">
                                <span>{{ $item['label'] }}</span>
                                <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        @endif
                    @endforeach

                    <div class="grid gap-3 pt-2 sm:grid-cols-2">
                        <a href="{{ route('site.membership.register') }}" class="site-nav-cta-outline w-full">Register</a>
                        <a href="{{ route('login') }}" class="site-nav-cta-fill w-full">Log in</a>
                    </div>
                </div>
            </div>
        </header>

        {{-- Quick Register Drawer Trigger --}}
        <button
            type="button"
            class="fixed right-0 top-[44vh] z-30 flex h-14 w-14 -translate-y-1/2 items-center justify-center rounded-l-2xl bg-ecosa-green text-white shadow-[0_18px_32px_rgba(23,146,75,0.35)] transition hover:bg-ecosa-green-deep"
            @click="registerDrawer = true"
            aria-label="Open quick registration panel"
        >
            <i class="fas fa-user-plus text-lg"></i>
        </button>

        {{-- Quick Register Drawer --}}
        <div x-cloak x-show="registerDrawer" class="fixed inset-0 z-50">
            <div class="absolute inset-0 bg-[#081b2c]/60 backdrop-blur-sm" @click="registerDrawer = false"></div>
            <aside
                x-transition:enter="transform transition duration-300 ease-out"
                x-transition:enter-start="translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transform transition duration-250 ease-in"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="translate-x-full"
                class="absolute right-0 top-0 h-full w-full max-w-md overflow-y-auto bg-white shadow-[0_28px_60px_rgba(8,27,44,0.24)]"
            >
                <div class="sticky top-0 z-10 border-b border-ecosa-blue/8 bg-white/95 px-6 py-5 backdrop-blur sm:px-8">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-[0.3em] text-zinc-400">Quick Registration</p>
                            <h2 class="mt-3 font-display text-4xl font-semibold text-ecosa-green-deep">Available Membership Registration</h2>
                            <p class="mt-2 text-sm leading-7 text-zinc-600">Start here, then continue on the full registration page for payment and final submission.</p>
                        </div>
                        <button type="button" class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-ecosa-blue/10 text-ecosa-blue" @click="registerDrawer = false" aria-label="Close">
                            <i class="fas fa-xmark"></i>
                        </button>
                    </div>
                </div>

                <div class="px-6 py-8 sm:px-8 sm:py-10">
                    <form method="GET" action="{{ route('site.membership.register') }}" class="space-y-4">
                        <div>
                            <label for="quick_full_name" class="site-label">Full Name</label>
                            <input id="quick_full_name" type="text" name="full_name" class="site-input" placeholder="Your full name">
                        </div>
                        <div>
                            <label for="quick_phone" class="site-label">Phone Number</label>
                            <input id="quick_phone" type="tel" name="phone" class="site-input" placeholder="+256...">
                        </div>
                        <div>
                            <label for="quick_email" class="site-label">Email Address</label>
                            <input id="quick_email" type="email" name="email" class="site-input" placeholder="you@example.com">
                        </div>
                        <div>
                            <label for="quick_completion_year" class="site-label">Completion Year</label>
                            <input id="quick_completion_year" type="number" name="completion_year" class="site-input" placeholder="2016">
                        </div>
                        <div>
                            <label for="quick_occupation_type" class="site-label">Professional Category</label>
                            <select id="quick_occupation_type" name="occupation_type" class="site-input">
                                @foreach (\App\Support\EcosaSite::occupationTypes() as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="site-btn-primary w-full">Continue Registration</button>
                    </form>

                    <div class="mt-6 rounded-[24px] bg-ecosa-blue/[0.04] p-5 text-sm leading-7 text-zinc-600">
                        <p class="font-semibold text-ecosa-blue-deep">Registration fee: UGX 20,000.</p>
                        <p class="mt-2">Complete payment on the full membership page using MTN Mobile Money or Airtel Money. Your membership ID is emailed automatically.</p>
                    </div>
                </div>
            </aside>
        </div>

        {{-- Page Content --}}
        {{ $slot }}

        {{-- ======================================== --}}
        {{-- FOOTER                                    --}}
        {{-- ======================================== --}}

        {{-- Footer SVG Wave --}}
        <div class="relative w-full overflow-hidden leading-[0]">
            <svg class="block h-[40px] w-[calc(100%+1.3px)] lg:h-[80px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="#17924b"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" fill="#17924b"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="#17924b"></path>
            </svg>
        </div>

        <footer class="bg-[#17924b] text-white">
            {{-- Values Strip --}}
            <div class="border-b border-white/10">
                <div class="mx-auto max-w-7xl px-5 lg:px-8">
                    <div class="grid divide-y divide-white/10 sm:grid-cols-2 sm:divide-x sm:divide-y-0 lg:grid-cols-4">
                        @foreach ($footerValues as $val)
                            <div class="flex items-center gap-4 px-4 py-8 xl:px-6">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center text-ecosa-gold">
                                    <i class="fas {{ $val['icon'] }} text-2xl"></i>
                                </div>
                                <div>
                                    <p class="font-accent text-[0.8rem] font-bold uppercase tracking-wider text-white">{{ $val['title'] }}</p>
                                    <p class="mt-1 text-xs leading-5 text-white/80">{{ $val['text'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Main Footer Content --}}
            <div class="mx-auto max-w-7xl px-5 py-14 lg:px-8">
                <div class="grid gap-10 lg:grid-cols-[1.5fr_1fr_1fr_1.5fr]">

                    {{-- Brand Column --}}
                    <div>
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="ECOSA Logo" class="h-16 w-16 rounded-xl bg-white object-contain p-2 shadow-sm">
                            <div>
                                <p class="font-display text-4xl font-bold text-white">ECOSA</p>
                            </div>
                        </div>
                        <p class="mt-6 text-sm leading-8 text-white/80">
                            Connecting Equatorial College School alumni through structured registration, community programs, welfare support, and school-impact initiatives.
                        </p>
                    </div>

                    {{-- Navigation Columns --}}
                    <div>
                        <h3 class="font-accent text-xs font-bold uppercase tracking-[0.2em] text-white">Quick Links</h3>
                        <div class="mt-6 grid gap-4">
                            @foreach ($footerQuickLinks as $link)
                                <a href="{{ route($link['route']) }}" class="text-sm font-semibold text-white/80 transition hover:text-white">
                                    {{ $link['label'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h3 class="font-accent text-xs font-bold uppercase tracking-[0.2em] text-white">About ECOSA</h3>
                        <div class="mt-6 grid gap-4">
                            @foreach ($footerAbout as $link)
                                <a href="{{ route($link['route']) }}" class="text-sm font-semibold text-white/80 transition hover:text-white">
                                    {{ $link['label'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- Contact Column --}}
                    <div>
                        <h3 class="font-accent text-xs font-bold uppercase tracking-[0.2em] text-white">Contact Info</h3>
                        <div class="mt-6 grid gap-5">
                            <a href="mailto:{{ $organization['emails'][0] }}" class="flex items-start gap-3 text-sm text-white/80 transition hover:text-white">
                                <i class="fas fa-envelope mt-1 text-ecosa-gold"></i>
                                <span>{{ $organization['emails'][0] }}</span>
                            </a>
                            <a href="tel:{{ $organization['phones'][0] }}" class="flex items-center gap-3 text-sm text-white/80 transition hover:text-white">
                                <i class="fas fa-phone text-ecosa-gold"></i>
                                <span>{{ $organization['phones'][0] }}</span>
                            </a>
                            <div class="flex items-start gap-3 text-sm text-white/80">
                                <i class="fas fa-location-dot mt-1 text-ecosa-gold"></i>
                                <span>{{ $organization['location_short'] }}</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Footer Bottom Bar --}}
            <div class="border-t border-white/10 border-dashed">
                <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-4 px-5 py-6 sm:flex-row lg:px-8">
                    <p class="text-xs font-semibold text-white/80">&copy; {{ date('Y') }} {{ $organization['short_name'] }}. All rights reserved. Designed by: <span class="font-bold text-white">Nugsoft</span></p>
                    <div class="flex items-center gap-4">
                        <a href="#" class="text-white/80 transition hover:text-white"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white/80 transition hover:text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white/80 transition hover:text-white"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-white/80 transition hover:text-white"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </footer>

        {{-- ======================================== --}}
        {{-- FLOATING ACTION BUTTONS                   --}}
        {{-- ======================================== --}}

        {{-- WhatsApp Popup Overlay --}}
        <div x-cloak x-show="whatsappOpen" class="fixed inset-0 z-40" @click="whatsappOpen = false"></div>

        {{-- WhatsApp Contact Popup --}}
        <div
            x-cloak
            x-show="whatsappOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-4 scale-95"
            x-transition:enter-end="opacity-1 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-1 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 scale-95"
            class="fixed bottom-28 right-5 z-50 w-80 overflow-hidden rounded-[28px] bg-[#081b2c] shadow-[0_30px_80px_rgba(0,0,0,0.5)] sm:right-6"
        >
            <div class="bg-[#17924b] px-5 py-4">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white/20">
                        <i class="fab fa-whatsapp text-xl text-white"></i>
                    </div>
                    <div>
                        <p class="font-accent text-sm font-bold text-white">ECOSA WhatsApp Support</p>
                        <p class="text-xs text-white/75">Choose a contact to chat</p>
                    </div>
                    <button @click="whatsappOpen = false" class="ml-auto flex h-8 w-8 items-center justify-center rounded-full bg-white/15 text-white/80 transition hover:bg-white/25">
                        <i class="fas fa-xmark text-xs"></i>
                    </button>
                </div>
            </div>

            <div class="space-y-3 p-4">
                @foreach ($whatsAppContacts as $contact)
                    @php $waNumber = preg_replace('/\D+/', '', $contact['phone']); @endphp
                    <div class="rounded-[20px] border border-white/8 bg-white/5 p-4">
                        <div class="flex items-center gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full text-sm font-bold text-white" style="background-color: {{ $contact['color'] }}">
                                {{ $contact['initials'] }}
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="font-accent text-sm font-bold text-white">{{ $contact['name'] }}</p>
                                <p class="text-xs text-white/58">{{ $contact['role'] }}</p>
                                <p class="mt-0.5 text-xs font-semibold text-ecosa-green">{{ $contact['number_display'] }}</p>
                            </div>
                        </div>
                        <div class="mt-3 grid grid-cols-2 gap-2">
                            <a
                                href="https://wa.me/{{ $waNumber }}?text=Hello%2C%20I%20need%20help%20with%20ECOSA%20membership."
                                target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex items-center justify-center gap-2 rounded-2xl bg-[#25d366] px-3 py-2.5 text-xs font-bold text-white transition hover:bg-[#1da851]"
                            >
                                <i class="fab fa-whatsapp"></i>
                                <span>Chat</span>
                            </a>
                            <a
                                href="tel:{{ $contact['phone'] }}"
                                class="inline-flex items-center justify-center gap-2 rounded-2xl border border-white/12 bg-white/8 px-3 py-2.5 text-xs font-bold text-white transition hover:bg-white/16"
                            >
                                <i class="fas fa-phone"></i>
                                <span>Call</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Floating Buttons Stack --}}
        <div class="fixed bottom-5 right-5 z-40 flex flex-col items-center gap-3 sm:right-6">
            {{-- Direct Call Button --}}
            <a
                href="tel:{{ $organization['phones'][0] }}"
                class="group flex h-14 w-14 items-center justify-center rounded-full bg-ecosa-blue text-white shadow-[0_18px_40px_rgba(23,58,96,0.45)] transition hover:scale-110 hover:bg-ecosa-blue-deep"
                aria-label="Call ECOSA"
                title="Call us: {{ $organization['phones'][0] }}"
            >
                <i class="fas fa-phone text-lg"></i>
            </a>

            {{-- WhatsApp Toggle Button --}}
            <button
                type="button"
                @click.stop="whatsappOpen = !whatsappOpen"
                class="flex h-16 w-16 items-center justify-center rounded-full bg-[#25d366] text-white shadow-[0_18px_40px_rgba(37,211,102,0.45)] transition hover:scale-110 hover:bg-[#1da851]"
                aria-label="Open WhatsApp contacts"
            >
                <i class="fab text-2xl" :class="whatsappOpen ? 'fa-xmark' : 'fa-whatsapp'"></i>
            </button>
        </div>

        @fluxScripts
    </body>
</html>
