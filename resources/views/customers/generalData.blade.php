<x-customers-layout>
    <div class=" text-center text-gray-600 text-lg font-bold m-8">
        <span>Registered Users Yet to Play A Game</span>
    </div>
    <livewire:players.users-with-no-games exportable hideable="select" />

    <div class=" text-center text-gray-600 text-lg font-bold m-8">
        <span>Regular Users Overview</span>
    </div>
    <livewire:players.regular-users-overview exportable hideable="select"/>
</x-customers-layout>