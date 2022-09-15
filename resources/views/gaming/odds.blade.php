<x-gaming-layout>
    @can('super-admin-access')
    <div class="mt-4 text-center">
        <p class=" p-4 w-full text-gray-900 font-bold">ODDS CONDITIONS AND RULES</p>
        <livewire:gaming.odds-conditions-and-rules exportable hideable="select" />
    </div>
    @else
    <div class="mt-4">
        You are not authorized to access this data.
    </div>
    @endcan

</x-gaming-layout>