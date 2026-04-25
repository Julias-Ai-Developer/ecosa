<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen antialiased" style="background:#eef3f9;">

        <div class="flex min-h-screen">

            {{-- Left Panel — School Image --}}
            <div class="relative hidden w-[55%] flex-col overflow-hidden lg:flex"
                 style="background: linear-gradient(160deg,#0a2540 0%,#173a60 60%,#17924b 100%);">

                {{-- Background photo --}}
                <img src="{{ asset('assets/images/school/Equatorial-College-School5.jpeg') }}"
                     alt="Equatorial College"
                     class="absolute inset-0 h-full w-full object-cover opacity-30 mix-blend-luminosity">

                {{-- Overlay gradient --}}
                <div class="absolute inset-0"
                     style="background: linear-gradient(160deg, rgba(10,37,64,0.82) 0%, rgba(23,58,96,0.68) 55%, rgba(23,146,75,0.55) 100%);"></div>

                {{-- Content --}}
                <div class="relative z-10 flex h-full flex-col justify-between px-14 py-14">
                    {{-- Logo --}}
                    <a href="{{ route('home') }}" class="flex items-center gap-4">
                        <img src="{{ asset('assets/images/logo.png') }}"
                             alt="ECOSA Logo"
                             class="h-14 w-14 rounded-2xl bg-white object-contain p-2 shadow-lg">
                        <div>
                            <p class="text-2xl font-bold tracking-tight text-white">ECOSA</p>
                            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-white/55">Member Portal</p>
                        </div>
                    </a>

                    {{-- Main message --}}
                    <div class="max-w-lg">
                        <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-widest text-white/70">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                            Equatorial College Old Students Association
                        </div>
                        <h1 class="text-5xl font-bold leading-tight text-white">
                            Your alumni home,<br>
                            <span style="color:#67bc45;">always open.</span>
                        </h1>
                        <p class="mt-5 text-lg leading-8 text-white/70">
                            Access your membership record, track your payment status, and stay connected with the ECOSA community — all in one place.
                        </p>
                    </div>

                    {{-- Stats row --}}
                    <div class="grid grid-cols-3 gap-4">
                        <div class="rounded-2xl border border-white/10 bg-white/8 p-5 backdrop-blur-sm">
                            <p class="text-xs font-bold uppercase tracking-widest text-white/45">Members</p>
                            <p class="mt-2 text-3xl font-bold text-white">500+</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/8 p-5 backdrop-blur-sm">
                            <p class="text-xs font-bold uppercase tracking-widest text-white/45">Since</p>
                            <p class="mt-2 text-3xl font-bold text-white">1985</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/8 p-5 backdrop-blur-sm">
                            <p class="text-xs font-bold uppercase tracking-widest text-white/45">Verified</p>
                            <p class="mt-2 text-3xl font-bold text-white">Secure</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Panel — Form --}}
            <div class="flex flex-1 flex-col items-center justify-center px-6 py-12 sm:px-10 lg:px-14"
                 style="background:#eef3f9;">

                {{-- Mobile logo --}}
                <a href="{{ route('home') }}" class="mb-8 flex items-center gap-3 lg:hidden">
                    <img src="{{ asset('assets/images/logo.png') }}"
                         alt="ECOSA Logo"
                         class="h-12 w-12 rounded-2xl bg-white object-contain p-2 shadow-sm">
                    <div>
                        <p class="text-2xl font-bold text-[#173a60]">ECOSA</p>
                        <p class="text-xs font-semibold uppercase tracking-[0.22em] text-zinc-500">Portal Access</p>
                    </div>
                </a>

                <div class="w-full max-w-sm">
                    {{-- Card --}}
                    <div class="overflow-hidden rounded-2xl bg-white shadow-xl ring-1 ring-black/5">
                        {{-- Blue top bar --}}
                        <div style="height:4px; background: linear-gradient(90deg,#173a60,#17924b,#ffd600);"></div>
                        <div class="px-8 py-9">
                            {{ $slot }}
                        </div>
                    </div>

                    <p class="mt-6 text-center text-xs text-zinc-400">
                        &copy; {{ date('Y') }} Equatorial College Old Students Association
                    </p>
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
