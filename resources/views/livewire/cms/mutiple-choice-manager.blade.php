<x-jet-form-section submit="updateTeamName">
    <x-slot name="title">
        {{ __('Manage Mutiple Choice Content') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Manage the content for mutiple optoions questions') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6">
            <div class="max-w-xl text-sm text-gray-600">
                {{ __('Please provide the information of the category you will like to add to the system.') }}
            </div>
        </div>

        <!-- Member Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('Name') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="addTeamMemberForm.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>

          <!-- Member Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('Description') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="addTeamMemberForm.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>

         <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('Parent Category') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="addTeamMemberForm.email" />
            <x-jet-input-error for="email" class="mt-2" />
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
