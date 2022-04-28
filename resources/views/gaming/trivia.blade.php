<x-gaming-layout>
    @can('super-admin-access')
    <button class="shadow bg-blue-500 text-white font-bold mb-4 py-2 px-4 rounded">
        + Create Trivia
    </button>
    <div class="mt-4">
        <livewire:gaming.trivia-table />
    </div>
    @else
    <div class="mt-4">
        You are not authorized to access this data.
    </div>
    @endcan

</x-gaming-layout>