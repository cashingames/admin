<div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
    <p class="font-bold">You clicked on delete!</p>
    <p>Are you sure you want to delete this question?.</p>
    <div class="flex justify-between">
    <button wire:click="deleteQuestion" class="bg-red-600 hover:bg-red-400 text-white font-bold py-2 px-4 mt-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
        Yes, Delete
    </button>
    <button wire:click="$emit('closeModal')" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 mt-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
       No, Cancel
    </button>
    </div>
</div>