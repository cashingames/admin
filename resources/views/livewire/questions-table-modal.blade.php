{{-- <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" wire:model="question">{{$question->id}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-header">
            <h5 class="modal-title" wire:model="question">{{$question->label}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-header">
            <h5 class="modal-title" wire:model="question">{{$question->level}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-header">
            <h5 class="modal-title" wire:model="question">{{$question->category->name}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-header">
                @foreach ($question->options as $option)
                    <h5 class="modal-title" wire:model="question">{{$option->title}}</h5>
                @endforeach
        </div>
    </div>
</div> --}}

<form class="w-full max-w-lg pt-6">
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full md:w-1/2 -mx-3 mb-6 px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
              QUESTION ID
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  type="text" placeholder="Level" value={{$question->id}}>
          </div>
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
           QUESTION
        </label>
        <textarea rows="4", cols="54" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="text" placeholder="Question"> {{$question->label}}</textarea>
      </div>
      <div class="w-full md:w-1/2 -mx-3 mb-6 px-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
          LEVEL
        </label>
        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  type="text" placeholder="Level" value={{$question->level}}>
      </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full px-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
          SUBCATEGORY
        </label>
        <textarea rows="2", cols="54" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="text" placeholder="Question"> {{$question->category->name}}</textarea>
      </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-2">
      <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
          OPTIONS
        </label>
        <div class="relative">
            @foreach ($question->options as $option)
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  type="text" placeholder="Level" value={{$option->title}}>
            @endforeach
        </div>
      </div>
    </div>
    <div class="flex-no-wrap justify-between">
        <div class="md:items-center mb-4">
            <button class="shadow bg-blue-500 text-white font-bold ml-4 py-2 px-4 rounded" type="button">
                Edit
            </button>
        </div>
        <div class="md:items-center mb-4">  
            <button class="shadow bg-red-600 text-white font-bold ml-4 py-2 px-4 rounded" type="button">
                Delete
            </button>
           
        </div>
    </div>
  </form>