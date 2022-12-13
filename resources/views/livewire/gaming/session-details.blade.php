<div>
    @canany(['super-admin-access','view-only-access'])
    <div>
        <span>{{$err}}</span>
        <div class="w-full  mb-6 md:mb-0">
            <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                Game Mode
            </label>
            <select class="block appearance-none w-full mb-4 bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" wire:model="gameMode">
                <option>select game mode</option>
                <option>Live Trivia</option>
                <option>Exhibition</option>
            </select>
        </div>
        <label class="text-gray-700 uppercase font-bold">Game Session Id </label>
        <div class="relative">
            <input wire:model="sessionId" class="shadow font-bold rounded" type="text">
        </div>
        <button class="shadow bg-blue-500 text-white font-bold ml-4 py-2 px-4 rounded" wire:click="fetch" wire:loading.attr="disabled">
            Go
        <button>
    </div>

    <div wire:model="data" class="flex justify-center px-3 mb-6">

        <table class="table-auto w-full mb-6 mt-6">
            <thead>
                <tr>

                    <th class="px-4 py-2">S/N</th>
                    <th class="px-4 py-2">Level</th>
                    <th class="px-4 py-2">Question</th>
                    <th class="px-4 py-2">Answered Option</th>
                    <th class="px-4 py-2">Correct</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($data as $question)
                <tr>
                    <td class="border px-4 py-2">{{$loop->index +1}}</td>
                    <td class="border px-4 py-2">{{$question['level']}}</td>
                    <td class="border px-4 py-2">{{$question['question']}}</td>
                    <td class="border px-4 py-2">{{$question['option']}}
                    <td class="border px-4 py-2">@if($question['correct'] == '0') No @else Yes @endif
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
    @else
    You are not authorised to access this data.

    @endcanany

</div>