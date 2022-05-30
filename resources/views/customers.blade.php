<x-customers-layout>
    @can('super-admin-access')
    <livewire:players.users-table exportable hideable="select" />
    @else
    You are not authorised to access this data.

    @endcan

</x-customers-layout>