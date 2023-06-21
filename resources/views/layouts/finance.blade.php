<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight basis-1/4">
                {{ __('Finance Management') }}
            </h2>
            <div class="basis-3/4 text-right">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex justify-end">
                    <!-- <x-jet-nav-link
                        href="{{ route('finance.dashboard') }}"
                        :active="request()->routeIs('finance.dashboard')">
                        {{ __('Dashboard') }}
                    </x-jet-nav-link> -->
                    <x-jet-nav-link href="{{ route('finance.transactions') }}" :active="request()->routeIs('finance.transactions')">
                        {{ __('Transactions') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('finance.wallets') }}" :active="request()->routeIs('finance.wallets')">
                        {{ __('Wallets') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('finance.bonuses') }}" :active="request()->routeIs('finance.bonuses')">
                        {{ __('User Bonuses') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('finance.fund') }}" :active="request()->routeIs('finance.fund')">
                        {{ __('Payouts') }}
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