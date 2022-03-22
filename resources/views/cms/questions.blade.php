<x-cms-layout>
    @if ($errors->any())
    <div class="mb-4 w/50 text-red-500 font-bold">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <button onclick='Livewire.emit("openModal", "modals.add-question")'
        class="shadow bg-blue-500 text-white font-bold mb-4 py-2 px-4 rounded">
        + Add Question
    </button>
    <div class="mt-4">
        <livewire:cms.questions />
    </div>
</x-cms-layout>