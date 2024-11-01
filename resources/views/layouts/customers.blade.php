<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight basis-1/4">
                {{ __('Players') }}
            </h2>
            <div class="basis-3/4 text-right">
                 <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex justify-end" >
                    <!-- <x-jet-nav-link href="{{ route('customers.dashboard') }}" :active="request()->routeIs('customers.dashboard')">
                        {{ __('Dashboard') }}
                    </x-jet-nav-link> -->
                    <x-jet-nav-link href="{{ route('customers.list') }}" :active="request()->routeIs('customers.list')">
                        {{ __('Players') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('customers.general.data') }}" :active="request()->routeIs('customers.reports.data')">
                        {{ __('General Data') }}
                    </x-jet-nav-link>
                </div>
            </div>
        </div>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </div>
</x-app-layout>
