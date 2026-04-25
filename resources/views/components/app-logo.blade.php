@props([
    'sidebar' => false,
])

@if($sidebar)
    <flux:sidebar.brand name="ECI - ECOSA" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-9 items-center justify-center rounded-md bg-white">
            <x-app-logo-icon class="size-8" />
        </x-slot>
    </flux:sidebar.brand>
@else
    <flux:brand name="ECI - ECOSA" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-9 items-center justify-center rounded-md bg-white">
            <x-app-logo-icon class="size-8" />
        </x-slot>
    </flux:brand>
@endif
