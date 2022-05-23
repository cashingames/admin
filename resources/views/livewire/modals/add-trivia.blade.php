<div>
    <div class="w-full max-w-lg pt-6">

        <div class="mb-6">
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Name
                </label>
                <textarea rows="1" , cols="54" wire:model="name"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    type="text" placeholder="Trivia Name"></textarea>
            </div>
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Grand Prize
                </label>
                <textarea rows="1" , cols="54"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    type="text" placeholder="Grand Prize" wire:model="grand_price"></textarea>
            </div>
            <div class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    Subcategory
                </label>
                <select
                    class="block appearance-none w-full mb-4 bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    wire:model="subcategory">
                    <option>select subcategory</option>
                    @foreach ($subcategories as $s)
                    <option>{{$s->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Points Required
                </label>
                <input wire:model="points_required" type="number"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    placeholder="Points Required">
            </div>
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Number of Questions
                </label>
                <input wire:model="question_count" type="number"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    placeholder="Number of Questions">
            </div>
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Game Duration (In Seconds)
                </label>
                <select
                    class="block appearance-none w-full mb-4 bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    wire:model="game_duration">
                    <option>select duration</option>
                    <option>60</option>
                    <option>120</option>
                    <option>180</option>
                    <option>240</option>
                    <option>300</option>
                </select>
            </div>
        </div>
        <div class="w-full  px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                Start Time
            </label>
            <input wire:model="start_time" type="datetime-local"
                class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                placeholder="Start Time">
        </div>
        <div class="w-full  px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                End Time
            </label>
            <input wire:model="end_time" type="datetime-local"
                class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                placeholder="End Time">
        </div>
        <div class="w-full  px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                Choose Questions?
            </label>
            <input wire:click="toggleCanChooseQuestions" type="checkbox">
        </div>
        @if ($notifyError)
        <span class="block uppercase tracking-wide text-red-500 text-center text-xs font-bold mb-2"> Please select a
            subcategory before adding questions</span>
        @endif
        @if ($canChooseQuestions)
        <div class="w-full  px-3 mb-6 md:mb-0">
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Selected Questions will show below:
                </label>
                <ol>
                    @foreach ($selectedQuestions as $i=>$q)
                    <div class="flex flex-row">
                    <li>{{$i+1}} {{$q}}</li>
                    <button wire:click="removeFromSelectedQuestions({{ $q }})" class="shadow text-red-500 bg-white px-1 ml-1 mt-1 rounded">
                        x
                    </button>
                    </div>

                    @endforeach
                </ol>
            </div>
            <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                Eligible Questions
            </label>
            <select
                class="block appearance-none w-full mb-4 bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                wire:model="selectedQuestion">
                <option>select question</option>
                @foreach ($questions as $q)
                <option wire:click="addToSelectedQuestions">{{$q->label}}</option>
                @endforeach
            </select>
        </div>
        @endif
        <div class="md:items-center mb-4">
            <button wire:click="addTrivia" wire:loading.attr="disabled"
                class="shadow bg-blue-500 text-white font-bold ml-4 py-2 px-4 rounded">
                Save
            </button>

        </div>

    </div>