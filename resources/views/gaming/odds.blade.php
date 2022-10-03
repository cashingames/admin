<x-gaming-layout>
    @can('super-admin-access')
    <div>
        <button onclick='Livewire.emit("openModal", "modals.add-odd-rule")' class="shadow bg-blue-500 text-white font-bold mb-4 py-2 px-4 rounded">
            + Add Odds Rule
        </button>
    </div>
    <div class="mt-4 text-center">
        <p class=" p-4 w-full text-gray-900 font-bold">ODDS RULES</p>
        <livewire:gaming.odds-rules exportable hideable="select" />
    </div>
    <div class="mt-16">
        <button onclick='Livewire.emit("openModal", "modals.add-staking-odd")' class="shadow bg-blue-500 text-white font-bold mb-4 py-2 px-4 rounded">
            + Add Staking Odd
        </button>
    </div>
    <div class="text-center">
        <p class=" p-4 w-full text-gray-900 font-bold">STAKING ODDS</p>
        <livewire:gaming.staking-odds exportable hideable="select" per-page="20" />
    </div>
    @else
    <div class="mt-4">
        You are not authorized to access this data.
    </div>
    @endcan

</x-gaming-layout>