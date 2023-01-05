<x-gaming-layout>
    <div class="mt-4 text-center">
        <p class=" p-4 w-full text-gray-900 font-bold">EXHIBITION STAKINGS DATA</p>
        <livewire:gaming.staking.stakers-table exportable hideable="select" />
    </div>

    <div class="mt-4 text-center">
        <p class=" p-4 w-full text-gray-900 font-bold">CHALLENGE STAKINGS DATA</p>
        <livewire:gaming.staking.challenge-stakers-table exportable hideable="select" />
    </div>

</x-gaming-layout>