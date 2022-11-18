<x-customers-layout>
    @canany(['super-admin-access','view-only-access'])
    <div class=" text-center text-gray-600 text-lg font-bold m-8">
        <span>Regular Users Overview</span>
    </div>
    <livewire:players.regular-users-overview exportable hideable="select" />
    <div class=" text-center text-gray-600 text-lg font-bold m-8">
        <span>Registered Users Yet to Play A Game</span>
    </div>
    <livewire:players.users-with-no-games exportable hideable="select" />
    @else
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        You are not authorised to access this data.
    </div>
    @endcanany

</x-customers-layout>