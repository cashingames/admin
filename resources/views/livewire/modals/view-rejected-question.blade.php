<div class="w-full max-w-lg pt-6">
    <div class="mb-6">
        <div class="w-full  px-3 mb-6 md:mb-0">
            <span class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                QUESTION ID
            </span>
            <span class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                {{$question->id}}
            </span>
        </div>
        <div class="w-full  px-3 mb-6 md:mb-0">
            <span class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                QUESTION
            </span>
            <p class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                {{$question->label}}
            </p>
        </div>
        <div class="w-full  px-3 mb-6 md:mb-0">
            <span class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                LEVEL
            </span>
            <span class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text">{{$question->level}}</span>
        </div>
    </div>
    <div class="flex flex-wrap  px-3 mb-6 md:mb-0">
        <div class="w-full">
            <span class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                SUBCATEGORIES
            </span>
            <span class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                @foreach ($question->categories as $subcategory)
                {{$subcategory->name}} ,
                @endforeach
            </span>
        </div>
    </div>
    <div class="flex flex-wrap px-3 mb-6 md:mb-0">
        <div class="w-full mb-6 md:mb-0">
            <span class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                OPTIONS
            </span>
            <div class="relative">
                @foreach ($question->options as $option)
                @if ($option->is_correct)
                <span class="appearance-none block w-full bg-green-500 mb-3 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">{{$option->title}}</span>
                @else
                <span class="appearance-none block w-full bg-gray-200 mb-3 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">{{$option->title}}</span>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="flex justify-center mb-4">
       
        @if (!$question->is_published)
        <button wire:click="$emit('openModal', 'modals.edit-rejected-question', {{ json_encode(["question"=> $question->id])
            }})" class="shadow bg-blue-500 text-white font-bold ml-2 py-2 px-2 rounded" type="button">
            Edit
        </button>
        @endif
        @if (Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'cms:delete') )
        @if (!$question->is_published)
        <button wire:click="$emit('openModal', 'modals.delete-rejected-question', {{ json_encode(["question"=>
            $question->id]) }})" class="shadow bg-red-600 text-white font-bold ml-4 py-2 px-2 rounded" type="button">
            Delete
        </button>
        @endif
        @endif
        @if ($canPublish)
        @if ($question->is_published)
        <button wire:click="$emit('openModal', 'modals.publish-rejected-question', {{ json_encode(["question"=>
            $question->id]) }})" class="shadow bg-green-500 text-white font-bold ml-4 py-2 px-2 rounded" type="button">
            Unpublish
        </button>
        @else
        <button wire:click="$emit('openModal', 'modals.publish-rejected-question', {{ json_encode(["question"=>
            $question->id]) }})" class="shadow bg-green-500 text-white font-bold ml-4 py-2 px-2 rounded" type="button">
            Publish
        </button>
        @endif
        @endif

        <!-- <button class="shadow bg-yellow-500 text-white font-bold ml-4 py-2 px-2 rounded" onclick='Livewire.emit("openModal", "modals.confrim-reject-question", {{ json_encode(["id" => $question->id]) }})'>
            Reject 
        </button> -->
        @if (Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'cms:approve') )
        <button class="shadow bg-purple-700 text-white font-bold ml-4 py-2 px-2 rounded" onclick='Livewire.emit("openModal", "modals.confirm-approve-question", {{ json_encode(["id" => $question->id]) }})'>
            Approve
        </button>
        @endif
    </div>
</div>