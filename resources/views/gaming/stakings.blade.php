<x-gaming-layout>
    @can('super-admin-access')
    <div class="mt-4 text-center">
        <p class=" p-4 w-full text-gray-900 font-bold">USER STAKINGS DATA</p>
        <livewire:gaming.stakers-table exportable hideable="select" />
    </div>
   
    @else
    <div class="mt-4">
        You are not authorized to access this data.
    </div>
    @endcan

</x-gaming-layout>