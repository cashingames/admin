<div>
    <div class="w-full max-w-lg pt-6">
        {{-- <p class="uppercase text-center text-xl mt-4 text-gray-700 text-xs font-bold mb-2">
            Edit Odd Multiplier
        </p>
        --}}
        <div class="mb-6">
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase text-lg tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Rule
                </label>
                <p
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                    {{$rule}}</p>
            </div>
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase text-lg tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Condition
                </label>
                <p
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                    {{$condition}}</p>
            </div>
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase text-lg tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Odd Multiplier
                </label>
                <input wire:model="oddMultiplier" type="text"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    value={{$oddMultiplier}}>
            </div>
            <div class="md:items-center mb-4">
                <button wire:click="editOddMultiplier" wire:loading.attr="disabled" class="shadow bg-blue-500 text-white font-bold ml-4 py-2 px-4 rounded">
                    Save
                </button>
            </div>
        </div>

    </div>

</div>