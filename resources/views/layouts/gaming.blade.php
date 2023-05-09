<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight basis-1/4">
                {{ __('Gaming') }}
            </h2>
            <div class="basis-3/4 text-right">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex justify-end">
                    <!-- <x-jet-nav-link href="{{ route('gaming.dashboard') }}" :active="request()->routeIs('gaming.dashboard')">
                        {{ __('Dashboard') }}
                    </x-jet-nav-link> -->
                    <x-jet-nav-link href="{{ route('gaming.challenges') }}" :active="request()->routeIs('gaming.challenges')">
                        {{ __('Challenges') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('gaming.sessions') }}" :active="request()->routeIs(['gaming.sessions'])">
                        {{ __('Exhibition Sessions') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('gaming.userAchievementBadges') }}" :active="request()->routeIs(['gaming.userAchievementBadges'])">
                        {{ __('User Achievement Badges') }}
                    </x-jet-nav-link>
                    @if (Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'create') )
                    <x-jet-nav-link href="{{ route('gaming.trivia') }}" :active="request()->routeIs('gaming.trivia')">
                        {{ __('Manage Live Trivia') }}
                    </x-jet-nav-link>
                    @endif
                    @if (Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'create') )
                    <x-jet-nav-link href="{{ route('gaming.odds') }}" :active="request()->routeIs('gaming.odds')">
                        {{ __('Manage Odds') }}
                    </x-jet-nav-link>
                    @endif
                    <x-jet-nav-link href="{{ route('gaming.stakings') }}" :active="request()->routeIs('gaming.stakings')">
                        {{ __('Stakings') }}
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