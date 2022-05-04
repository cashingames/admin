<div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
    <div class="flex">
        <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20">
                <path
                    d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
            </svg></div>
        <div>
            @if ($trivia->is_published)
                <p class="font-bold">Do you want to unpublish this live trivia ? </p>
            @else
                <p class="font-bold">Do you want to publish this live trivia ? </p>
            @endif
            
            <div class="flex justify-center mb-3">
                <button wire:click="togglePublish"
                    class="shadow bg-blue-500 text-white font-bold ml-4 py-2 px-4 rounded" type="button">
                    Yes
                </button>
                <button wire:click="$emit('closeModal')" class="shadow bg-green-500 text-white font-bold ml-4 py-2 px-4 rounded"
                    type="button">
                    No
                </button>
            </div>
        </div>
    </div>
</div>