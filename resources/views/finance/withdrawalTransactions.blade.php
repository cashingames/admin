<x-finance-layout>
    @can('super-admin-access')
    <ul
        class="hidden text-sm font-medium text-center text-gray-500 rounded-lg divide-x divide-gray-200 shadow sm:flex dark:divide-gray-700 dark:text-gray-400">
        <li class="w-full">
            <a href="{{ route('finance.transactions') }}" aria-current="page"
            class="inline-block p-4 w-full bg-white hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 focus:outline-none uppercase dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                aria-current="page">All Transactions</a>
        </li>
        <li class="w-full">
            <a href="{{ route('finance.fundings') }}" aria-current="page"
                class="inline-block p-4 w-full bg-white hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 focus:outline-none uppercase dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">
                Wallet Funds</a>
        </li>
        <li class="w-full">
            <a href="{{ route('finance.withdrawals') }}" aria-current="page"
            class="inline-block p-4 w-full text-gray-900 bg-blue-300 rounded-l-lg focus:ring-4 focus:ring-blue-300 active focus:outline-none uppercase font-bold dark:bg-gray-700 dark:text-white">
                Wallet Withdrawals</a>
        </li>

    </ul>
    <div class="pt-8">
        <livewire:finance.wallet-withdrawals-table exportable hideable="select" />
    </div>
    @else
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        You are not authorised to access this data.
    </div>
    @endcan

</x-finance-layout>