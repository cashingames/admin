<x-customers-layout>
    @canany(['super-admin-access','view-only-access'])
    <livewire:players.users-table exportable hideable="select" />
    @else
    You are not authorised to access this data.

    @endcanany

</x-customers-layout>