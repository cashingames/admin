<x-cms-layout>
    <button onclick='Livewire.emit("openModal", "modals.add-question")'
        class="shadow bg-blue-500 text-white font-bold mb-4 py-2 px-4 rounded">
        + Add Question
    </button>
    <div class="mt-4">
        <livewire:cms.questions />
    </div>
</x-cms-layout>