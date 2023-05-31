<x-customers-layout>
    <ul class="hidden text-sm font-medium text-center text-gray-500 rounded-lg divide-x divide-gray-200 shadow sm:flex dark:divide-gray-700 dark:text-gray-400">
        <li class="w-full">
            <a href="{{ route('customers.general.data') }}" aria-current="page"class="inline-block p-4 w-full text-gray-900 bg-blue-300 rounded-l-lg focus:ring-4 focus:ring-blue-300 active focus:outline-none uppercase font-bold dark:bg-gray-700 dark:text-white" >Cashingames</a>
        </li>
        <li class="w-full">
            <a href="{{ route('gameark-customers.general.data') }}" aria-current="page" class="inline-block p-4 w-full bg-white hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 focus:outline-none uppercase dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" >GameArk</a>
        </li>
    </ul>
    <div class=" text-center text-gray-600 text-lg font-bold m-8">
        <span>Regular Users Overview</span>
    </div>
    <livewire:players.regular-users-overview exportable hideable="select" />
    <div class=" text-center text-gray-600 text-lg font-bold m-8">
        <span>Registered Users Yet to Play A Game</span>
    </div>
    <livewire:players.users-with-no-games exportable hideable="select" />
</x-customers-layout>