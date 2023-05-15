<div class=" bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <div class="mb-4 w/50 text-red-500 font-bold">
        @error('file') <span class="error">{{ $message }}</span> @enderror
    </div>
    <form class="w-full  px-3 mb-6 md:mb-0" wire:submit.prevent="upload">
        <label class="text-center block uppercase tracking-wide mb-8 text-gray-700 text-xl font-bold mb-2">
            Upload Questions
        </label>
        <label class="block tracking-wide mt-2 text-gray-700 text-xs font-bold mb-2" for="grid-state">
            SELECT DESTINATION APP
        </label>
        <div class="relative">
            <select wire:model="appDestination" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option>Select App</option>
                <option>Cashingames</option>
                <option>GameArk</option>
            </select>
        </div>
        <label class="block tracking-wide mt-2 text-gray-700 text-xs font-bold mb-2" for="grid-state">
            SELECT CATEGORY
        </label>
        <div class="relative">
            <select wire:model="category" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option>Select Category</option>
                @foreach ($categories as $category )
                <option>{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class='text-blue-700' wire:loading wire:target="file">Saving selected file, hold on...</div>
        <div class="mt-4 relative">
            <input wire:model="file" type="file" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
            <x-jet-button class="mb-4" type="submit" wire:loading.attr="disabled">Upload</x-jet-button>
        </div>
    </form>
    <div class="mb-4 w/50 text-blue-500 text-center font-bold">
        <span class="info">{{ $info }}</span>
    </div>
</div>