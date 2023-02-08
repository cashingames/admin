<div>
    <div class="w-full flex flex-row justify-between ">
        <div class="mb-6">
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Name
                </label>
                <textarea rows="1" , cols="54" wire:model="name" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="Name"> {{$trivia->name}}</textarea>
            </div>
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Grand Prize
                </label>
                <textarea rows="1" , cols="54" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="Grand Prize" wire:model="grand_price"> {{$trivia->grand_price}}</textarea>
            </div>
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Entry Fee
                </label>
                <textarea rows="1" , cols="54" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="Entry Fee" wire:model="entry_fee"> {{$trivia->entry_fee}}</textarea>
            </div>
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Prize Multiplier
                </label>
                <input wire:model="prize_multiplier" type="number" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
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
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Number of Winners
                </label>
                <input wire:model="numberOfWinners" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="number" value={{$numberOfWinners}} />
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
            <div class="w-full  px-3 mb-6 md:mb-0">

                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Entry Mode
                </label>
                <select class="block appearance-none w-full mb-4 bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" wire:model="entry_mode">
                    <option>{{$trivia->contest->entry_mode}}</option>
                    @foreach ($entryModes as $entryMode)
                    <option>{{$entryMode}}</option>
                    @endforeach
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
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Prize Type
                </label>
                <select class="block appearance-none w-full mb-4 bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" wire:model="prize_type">
                    <option>{{$trivia->contest->prize_type}}</option>
                    @foreach ($prizeTypes as $prizeType)
                    <option>{{$prizeType}}</option>
                    @endforeach
                </select>
            </div>
        </div>

    </div>
    <div class="w-full flex flex-row justify-center ">
        <span class="block uppercase tracking-wide mt-4 text-gray-700 text-l font-bold mb-2">Prize Pool</span>
    </div>

    <div class="w-full flex flex-row justify-center ">
        @foreach ($prizePool as $prizePool)
        <div>
            <div class="mb-6">
                <div class="w-full  px-3 mb-6 md:mb-0">
                    <span class="block uppercase tracking-wide mt-4 text-gray-700 text-l font-bold mb-2">({{$loop->index + 1}})</span>
                    <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                        Position From
                    </label>
                    <select class="block appearance-none w-full mb-4 bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" wire:model="prizePool.{{$loop->index}}.rank_from">
                        <option>{{$prizePool['rank_from']}}</option>
                        @for($i = 0; $i < $numberOfWinners; $i++ ) <option>{{$i + 1}}</option>
                            @endfor
                    </select>
                </div>
                <div class="w-full  px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                        Position To
                    </label>
                    <select class="block appearance-none w-full mb-4 bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" wire:model="prizePool.{{$loop->index}}.rank_to">
                        <option>{{$prizePool['rank_to']}}</option>
                        @for($i = 0; $i < $numberOfWinners; $i++ ) <option>{{$i + 1}}</option>
                            @endfor
                    </select>

                </div>
                <div class="w-full mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide mt-4 ml-4 text-gray-700 text-xs font-bold mb-2">
                        Each Person's Prize
                    </label>
                    <input wire:model="prizePool.{{$loop->index}}.each_prize" type="text" class="block appearance-none mb-4 mx-3 bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" value={{$prizePool['each_prize']}}>
                </div>
            </div>
            <div class="mb-6">


                <label class="block uppercase tracking-wide mt-4 ml-4 text-gray-700 text-xs font-bold mb-2">
                    Prize Description
                </label>
                <input wire:model="prizePool.{{$loop->index}}.prize" type="text" class="block appearance-none mb-4 mx-3 bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" value={{$prizePool['prize']}}>

                <label class="block uppercase tracking-wide mt-4 ml-4 text-gray-700 text-xs font-bold mb-2">
                    Total Prizes
                </label>
                <input wire:model="prizePool.{{$loop->index}}.net_prize" type="text" class="block appearance-none mb-4 mx-3 bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" value={{$prizePool['net_prize']}}>

            </div>
        </div>
        @endforeach
    </div>

    <label class="block uppercase mt-4 text-gray-700 text-xs text-center font-bold mb-2">
        Selected Questions
    </label>
    <div wire:model="questions" class="flex justify-center px-3 mb-6">

        <table class="table-auto w-full mb-6 mt-6">
            <thead>
                <tr>

                    <th class="px-4 py-2">S/N</th>
                    <th class="px-4 py-2">Level</th>
                    <th class="px-4 py-2">Question</th>
                    <th class="px-4 py-2"></th>
                </tr>
            </thead>

            <tbody>
                @foreach($questions as $question)
                <tr>
                    <td class="border px-4 py-2">{{$loop->index +1}}</td>
                    <td class="border px-4 py-2">{{$question['level']}}</td>
                    <td class="border px-4 py-2">{{$question['question']}}</td>
                    <td class="border px-4 py-2">

                        <button wire:click='removeMoreQuestions({{$loop->index}})' class="shadow bg-blue-500 text-white font-bold ml-2 px-1 rounded">remove</button>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
    <div class="flex justify-center md:items-center mb-4">
        <button wire:click="addMoreQuestions" wire:loading.attr="disabled" class="shadow bg-blue-500 text-white font-bold ml-4 py-2 px-4 rounded">
            Add more questions
        </button>
        <button wire:click="editTrivia" wire:loading.attr="disabled" class="shadow bg-blue-500 text-white font-bold ml-4 py-2 px-4 rounded">
            Save Changes
        </button>
    </div>