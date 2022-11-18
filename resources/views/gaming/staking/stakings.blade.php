<x-gaming-layout>
    @canany(['super-admin-access','view-only-access'])
    <div class="mt-4 text-center">
        <p class=" p-4 w-full text-gray-900 font-bold">EXHIBITION STAKINGS DATA</p>
        <livewire:gaming.staking.stakers-table exportable hideable="select" />
    </div>

    <div class="mt-4 text-center">
        <p class=" p-4 w-full text-gray-900 font-bold">CHALLENGE STAKINGS DATA</p>
        <livewire:gaming.staking.challenge-stakers-table exportable hideable="select" />
    </div>

    @else
    <div class="mt-4">
        You are not authorized to access this data.
    </div>
    @endcanany

</x-gaming-layout>