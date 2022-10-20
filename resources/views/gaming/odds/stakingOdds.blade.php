<x-gaming-layout>
    @can('super-admin-access')
    <ul class="hidden text-sm font-medium text-center text-gray-500 rounded-lg divide-x divide-gray-200 shadow sm:flex dark:divide-gray-700 dark:text-gray-400">
        <li class="w-full">
            <a href="{{ route('gaming.odds') }}" aria-current="page" class="inline-block p-4 w-full bg-white hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 focus:outline-none uppercase dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">Game Odds</a>
        </li>
        <li class="w-full">
            <a href="{{ route('gaming.stakingOdds') }}" aria-current="page" class="inline-block p-4 w-full text-gray-900 bg-blue-300 rounded-l-lg focus:ring-4 focus:ring-blue-300 active focus:outline-none uppercase font-bold dark:bg-gray-700 dark:text-white" >Staking Odds</a>
        </li>

    </ul>
    <div>
        <button onclick='Livewire.emit("openModal", "modals.add-staking-odd-rule")' class="shadow bg-blue-500 text-white font-bold mt-4 mb-4 py-2 px-4 rounded">
            + Add Staking Odds Rule
        </button>
    </div>
    <div class="mt-4 text-center">
        <p class=" p-4 w-full text-gray-900 font-bold">STAKING ODDS RULES</p>
        <livewire:gaming.odds.staking-odds-rules exportable hideable="select" />
    </div>
    <div class="mt-16">
        <button onclick='Livewire.emit("openModal", "modals.add-staking-odd")' class="shadow bg-blue-500 text-white font-bold mb-4 py-2 px-4 rounded">
            + Add Staking Odd
        </button>
    </div>
    <div class="text-center">
        <p class=" p-4 w-full text-gray-900 font-bold">STAKING ODDS</p>
        <livewire:gaming.odds.staking-odds exportable hideable="select" per-page="20" />
    </div>
    @else
    <div class="mt-4">
        You are not authorized to access this data.
    </div>
    @endcan

</x-gaming-layout>