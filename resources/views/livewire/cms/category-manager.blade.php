<x-jet-form-section submit="save">
    <x-slot name="title">
        {{ __('Manage Categories') }}
    </x-slot>

    <x-slot name="description">
        {{ __('The tagging data setup for the system') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6">
            <div class="max-w-xl text-sm text-gray-600">
                {{ __('Please provide the information of the category you will like to add to the system.') }}
            </div>
        </div>

        <!-- Member Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Name') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" required />
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        <!-- Member Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="description" value="{{ __('Description') }}" />
            <x-jet-input id="description" type="text" class="mt-1 block w-full" wire:model.defer="description" required />
            <x-jet-input-error for="description" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="parentCategory" value="{{ __('Parent Category (for only subcategories)') }}" />
            <select wire:model.defer="parentCategory" class="mt-1 block border-gray-200 rounded w-full">
                <option>select a parent category</option>
                @foreach($parentCategories as $category)
                <option>{{$category->name}}</option>
                @endforeach
            </select>
            <x-jet-input-error for="parentCategory" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="bgColour" value="{{ __('Background Colour') }}" />
            <x-jet-input id="bgColour" type="color" class="mt-1 block w-full" wire:model.defer="bgColour" required />
            <x-jet-input-error for="bgColour" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="fontColour" value="{{ __('Font Colour') }}" />
            <x-jet-input id="fontColour" type="color" class="mt-1 block w-full" wire:model.defer="fontColour" required />
            <x-jet-input-error for="fontColour" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="icon" value="{{ __('Icon') }}" />
            <!-- <x-jet-input id="icon" type="file" class="mt-1 block w-full" wire:model.defer="icon" /> -->
            <input type="file" class="mt-1 block w-full" wire:model="icon">
            <x-jet-input-error for="icon" class="mt-2" />
        </div>
    </x-slot>
    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Added.') }}
        </x-jet-action-message>

        <x-jet-button>
            {{ __('Add') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>