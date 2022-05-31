<x-gaming-layout>
    @can('super-admin-access')
        <livewire:gaming.sessions-table exportable hideable="select" />
    @else
        You are not authorised to access this data.
   
    @endcan
        
</x-gaming-layout>
