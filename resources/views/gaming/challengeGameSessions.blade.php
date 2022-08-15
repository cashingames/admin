<x-gaming-layout>
    @can('super-admin-access')
    <ul
        class="hidden text-sm font-medium text-center text-gray-500 rounded-lg divide-x divide-gray-200 shadow sm:flex dark:divide-gray-700 dark:text-gray-400">
        <li class="w-full">
            <a href="{{ route('gaming.sessions') }}" aria-current="page"
                class="inline-block p-4 w-full bg-white hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 focus:outline-none uppercase dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                aria-current="page">Exhibition Game Sessions</a>
        </li>
        <li class="w-full">
            <a href="{{ route('gaming.challengeGameSessions') }}" aria-current="page"
                class="inline-block p-4 w-full text-gray-900 bg-blue-300 rounded-l-lg focus:ring-4 focus:ring-blue-300 active focus:outline-none uppercase font-bold dark:bg-gray-700 dark:text-white">Challenge Game Sessions</a>
        </li>
    </ul>
    <livewire:gaming.challenge-sessions-table exportable hideable="select" />
    @else
    You are not authorised to access this data.

    @endcan

</x-gaming-layout>