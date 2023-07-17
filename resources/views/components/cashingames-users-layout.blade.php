<div>
    <ul class="hidden text-sm mt-8 mb-8 font-medium flex justify-center text-center text-gray-500 rounded-lg divide-x divide-gray-200 shadow sm:flex dark:divide-gray-700 dark:text-gray-400">
        <li class="w-full">
            <a href="{{ route('customers.list') }}" aria-current="page" class="inline-block p-1 w-full text-gray-900 bg-blue-300 rounded-l-lg focus:ring-4 focus:ring-blue-300 active focus:outline-none uppercase font-bold dark:bg-gray-700 dark:text-white" aria-current="page">Active Users</a>
        </li>
        <li class="w-full">
            <a href="{{ route('customers.deactivated') }}" aria-current="page" class="inline-block p-1 w-full bg-red-50 hover:text-gray-700 hover:bg-red-50 focus:ring-4 focus:ring-blue-300 focus:outline-none uppercase dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">Deactivated Users</a>
        </li>
    </ul>
    <livewire:players.users-table exportable hideable="select" />
</div>