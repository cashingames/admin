<div>
    <div class="w-full flex flex-row justify-center ">
        <span class="block uppercase tracking-wide mt-4 text-red-700 text-l font-bold mb-2">{{$error}}</span>
    </div>
    <div class="w-full flex flex-row justify-between ">
        <div class="mb-6">
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Name
                </label>
                <textarea rows="1" , cols="54" wire:model="name" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="Question"> {{$trivia->name}}</textarea>
            </div>
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Grand Prize
                </label>
                <textarea rows="1" , cols="54" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="Question" wire:model="grand_price"> {{$trivia->grand_price}}</textarea>
            </div>
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Entry Fee
                </label>
                <textarea rows="1" , cols="54" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="Question" wire:model="entry_fee"> {{$trivia->entry_fee}}</textarea>
            </div>
        </div>

        <div class="mb-6">
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Subcategory
                </label>
                <select class="block appearance-none w-full mb-4 bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" wire:model="subcategory">
                    <option>{{$trivia->category->name}}</option>
                    @foreach ($subcategories as $s)
                    <option>{{$s->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Points Required
                </label>
                <input wire:model="points_required" type="number" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" value={{$trivia->point_eligibility}}>
            </div>

        </div>
        <div class="mb-6">
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Number of Questions
                </label>
                <input wire:model="question_count" type="number" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" value={{$trivia->question_count}}>
            </div>
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Game Duration (In Seconds)
                </label>
                <select class="block appearance-none w-full mb-4 bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" wire:model="game_duration">
                    <option>{{$trivia->game_duration}}</option>
                    <option>60</option>
                    <option>120</option>
                    <option>180</option>
                    <option>240</option>
                    <option>300</option>
                </select>
            </div>
        </div>
        <div class="mb-6">
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Start Time
                </label>
                <input wire:model="start_time" type="datetime-local" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
            </div>
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    End Time
                </label>
                <input wire:model="end_time" type="datetime-local" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
            </div>
        </div>

    </div>
    <!-- <div class="flex flex-row w-full  px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2" checked>
            Do you want to Manually add questions?
        </label>
        @if (!$canChooseQuestions)
        <button wire:click="toggleCanChooseQuestions"
            class="shadow mt-2 mb-2 ml-2 bg-blue-500 text-white font-bold px-4 rounded">
            yes
        </button>
        @else
        <button wire:click="toggleCanChooseQuestions"
            class="shadow mt-2 mb-2 ml-2 bg-blue-500 text-white font-bold px-4 rounded">
            no
        </button>
        @endif
    </div>
    <div class="w-full flex flex-column justify-center">
        @if ($canChooseQuestions)
        <div class="flex flex-column justify-center mt-6 w-full  px-3 mb-6 md:mb-0">
            <livewire:cms.select-questions-table>
        </div>
        @else
        <div class="md:items-center mb-4">
            <button wire:click="addTrivia" wire:loading.attr="disabled"
                class="shadow bg-blue-500 text-white font-bold ml-4 py-2 px-4 rounded">
                Save
            </button>
        </div>
        @endif

    </div> -->