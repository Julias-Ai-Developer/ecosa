<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="site-shell min-h-screen antialiased">
        <div class="grid min-h-screen lg:grid-cols-[1.05fr_0.95fr]">
            <div class="relative hidden overflow-hidden bg-[#081b2c] px-10 py-14 text-white lg:flex">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(255,214,0,0.14),transparent_28%),radial-gradient(circle_at_bottom_right,rgba(23,146,75,0.18),transparent_24%)]"></div>
                <div class="relative z-10 flex max-w-xl flex-col justify-between">
                    <div>
                        <a href="{{ route('home') }}" class="flex items-center gap-3">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="ECOSA Logo" class="h-14 w-14 rounded-2xl bg-white object-contain p-2">
                            <div>
                                <p class="font-display text-3xl font-semibold">ECOSA</p>
                                <p class="mt-1 text-xs font-bold uppercase tracking-[0.24em] text-white/55">Member Access Platform</p>
                            </div>
                        </a>

                        <div class="mt-16 max-w-xl">
                            <span class="site-chip border-white/12 bg-white/10 text-white">Association Portal</span>
                            <h1 class="mt-6 font-display text-6xl font-semibold leading-[0.94] text-balance">
                                Alumni access built like a real institution.
                            </h1>
                            <p class="mt-6 max-w-lg text-lg leading-8 text-white/72">
                                Secure membership details, payment visibility, profile settings, and an administrative backend designed for a serious alumni association.
                            </p>
                        </div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-3">
                        <div class="rounded-[24px] border border-white/10 bg-white/7 p-5">
                            <p class="text-xs font-bold uppercase tracking-[0.24em] text-white/45">Members</p>
                            <p class="mt-3 font-display text-4xl font-semibold">500+</p>
                        </div>
                        <div class="rounded-[24px] border border-white/10 bg-white/7 p-5">
                            <p class="text-xs font-bold uppercase tracking-[0.24em] text-white/45">Payments</p>
                            <p class="mt-3 font-display text-4xl font-semibold">Live</p>
                        </div>
                        <div class="rounded-[24px] border border-white/10 bg-white/7 p-5">
                            <p class="text-xs font-bold uppercase tracking-[0.24em] text-white/45">Support</p>
                            <p class="mt-3 font-display text-4xl font-semibold">Online</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex min-h-screen items-center justify-center px-6 py-12 sm:px-10 lg:px-14">
                <div class="w-full max-w-md">
                    <a href="{{ route('home') }}" class="mb-8 flex items-center gap-3 lg:hidden" wire:navigate>
                        <img src="{{ asset('assets/images/logo.png') }}" alt="ECOSA Logo" class="h-12 w-12 rounded-2xl bg-white object-contain p-2 shadow-sm">
                        <div>
                            <p class="font-display text-3xl font-semibold text-ecosa-blue-deep">ECOSA</p>
                            <p class="text-xs font-bold uppercase tracking-[0.22em] text-zinc-500">Portal Access</p>
                        </div>
                    </a>

                    <div class="site-card overflow-hidden">
                        <div class="h-2 bg-[linear-gradient(90deg,#173a60,#67bc45,#ffd600)]"></div>
                        <div class="p-8 sm:p-10">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>
