<div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
    <p class="font-bold">You are rejecting this question.</p>
    <p>Do you want to add a comment?</p>
    <div class="flex justify-between">
    <button onclick='Livewire.emit("openModal", "modals.add-comment", {{ json_encode(["id" => $id]) }})' class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 mt-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
        Reject with a comment
    </button>
    <button wire:click="rejectQuestion"  class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 mt-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
       No, Just Reject
    </button>
    </div>
</div>