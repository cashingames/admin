<div>
    <div class="w-full max-w-lg pt-6">
        <p class="uppercase text-center text-xl mt-4 text-gray-700 text-xs font-bold mb-2">
            New Odds Rule
        </p>

        <div class="mb-6">
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase text-lg tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Rule
                </label>
                <input wire:model="rule" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" >
            </div>
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase text-lg tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Condition
                </label>
                <input wire:model="condition" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" >
            </div>
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase text-lg tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Odd Multiplier
                </label>
                <input wire:model="oddMultiplier" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" value={{$oddMultiplier}}>
            </div>
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase text-lg tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Odd Operation
                </label>
                <select wire:model="operation" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="level">
                    <option>select operation</option>
                    <option>+</option>
                    <option>-</option>
                    <option>*</option>
                </select>
            </div>
            <div class="md:items-center mb-4">
                <button wire:click="addOddRule" wire:loading.attr="disabled" class="shadow bg-blue-500 text-white font-bold ml-4 py-2 px-4 rounded">
                    Save
                </button>
            </div>
        </div>

    </div>

</div>