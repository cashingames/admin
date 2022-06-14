<div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
    <p class="font-bold">You are rejecting this question.</p>
    <p class="font-bold">Add a comment (optional)</p>
    <textarea rows="4" , cols="54"
    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
    type="text" placeholder="Type comment" name="question" wire:model="comment"></textarea>
    <div class="flex justify-between">
    <button wire:click="rejectQuestion"  class="bg-green-500 hover:bg-blue-400 text-white font-bold py-2 px-4 mt-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
       Reject
    </button>
    </div>
</div>