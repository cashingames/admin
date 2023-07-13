<div>
    <div class="w-full max-w-lg">
        <p class="text-red-500 text-lg text-center mb-4 bg-red-100 font-bold italic">{{$error}}</p>
        <p class="text-teal-500 text-lg text-center mb-4 bg-teal-100 font-bold italic">{{$message}}</p>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    Username
                </label>
                <input wire:model="username" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="username">
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Wallet Type
                </label>
                <select wire:model="walletType" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option>Fundable Wallet</option>
                    <option>Bonus Wallet</option>
                </select>
            </div>

        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    Amount
                </label>
                <input wire:model="amount" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" placeholder="0.00">

                @if($walletType === "Bonus Wallet")
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    Bonus Type
                </label>
                <select wire:model="bonusType" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option>select bonus</option>
                    @foreach($bonuses as $bonus)
                    <option>{{$bonus->name}}</option>
                    @endforeach
                </select>
                @endif
            </div>

        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <button wire:click="fund" wire:loading.attr="disabled" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Fund
                </button>
            </div>

        </div>
    </div>
</div>