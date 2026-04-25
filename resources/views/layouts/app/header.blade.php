<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-ecosa-mist text-zinc-900">
        <flux:header container class="border-b border-[#d7e4d5] bg-white">
            <flux:sidebar.toggle class="lg:hidden mr-2" icon="bars-2" inset="left" />

            <x-app-logo href="{{ route('dashboard') }}" wire:navigate />

            <flux:navbar class="-mb-px max-lg:hidden">
                <flux:navbar.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                    {{ __('Dashboard') }}
                </flux:navbar.item>
                <flux:navbar.item icon="users" :href="route('admin.members')" :current="request()->routeIs('admin.members')" wire:navigate>
                    {{ __('Registered Members') }}
                </flux:navbar.item>
                <flux:navbar.item icon="globe-alt" :href="route('home')">
                    {{ __('Public Website') }}
                </flux:navbar.item>
                <flux:navbar.item icon="newspaper" :href="route('admin.content')" :current="request()->routeIs('admin.content')" wire:navigate>
                    {{ __('Website Content') }}
                </flux:navbar.item>
            </flux:navbar>

            <flux:spacer />

            <flux:navbar class="me-1.5 space-x-0.5 rtl:space-x-reverse py-0!">
                <flux:tooltip :content="__('Search')" position="bottom">
                    <flux:navbar.item class="!h-10 [&>div>svg]:size-5" icon="magnifying-glass" href="#" :label="__('Search')" />
                </flux:tooltip>
                <flux:tooltip :content="__('Contact Page')" position="bottom">
                    <flux:navbar.item
                        class="h-10 max-lg:hidden [&>div>svg]:size-5"
                        icon="envelope"
                        :href="route('site.contact')"
                        :label="__('Contact Page')"
                    />
                </flux:tooltip>
            </flux:navbar>

            <x-desktop-user-menu />
        </flux:header>

        <!-- Mobile Menu -->
        <flux:sidebar collapsible="mobile" sticky class="border-e border-[#102b47] bg-[#173a60] text-white lg:hidden">
            <flux:sidebar.header>
                <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" class="text-white" wire:navigate />
                <flux:sidebar.collapse class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
            </flux:sidebar.header>

            <flux:sidebar.nav>
                <flux:sidebar.group :heading="__('ECOSA')">
                    <flux:sidebar.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard')  }}
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="users" :href="route('admin.members')" :current="request()->routeIs('admin.members')" wire:navigate>
                        {{ __('Registered Members')  }}
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="globe-alt" :href="route('home')">
                        {{ __('Public Website')  }}
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="newspaper" :href="route('admin.content')" :current="request()->routeIs('admin.content')" wire:navigate>
                        {{ __('Website Content')  }}
                    </flux:sidebar.item>
                </flux:sidebar.group>
            </flux:sidebar.nav>

            <flux:spacer />

            <flux:sidebar.nav>
                <flux:sidebar.item icon="envelope" :href="route('site.contact')">
                    {{ __('Contact Page') }}
                </flux:sidebar.item>
            </flux:sidebar.nav>
        </flux:sidebar>

        {{ $slot }}

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>
