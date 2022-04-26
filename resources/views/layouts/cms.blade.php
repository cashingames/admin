<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight basis-1/4">
                {{ __('Manage Content') }}
            </h2>
            <div class="basis-3/4 text-right">
                 <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex justify-end" >
                    <x-jet-nav-link href="{{ route('cms.dashboard') }}" :active="request()->routeIs('cms.dashboard')">
                        {{ __('Dashboard') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('cms.questions') }}" :active="request()->routeIs('cms.questions')">
                        {{ __('Questions Manager') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('cms.categories') }}" :active="request()->routeIs('cms.categories')">
                        {{ __('Categories Manager') }}
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
