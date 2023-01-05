
@if ($errors->any())
<div class="mb-4 w/50 text-red-500 font-bold">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="mt-8 shadow bg-blue-100 mb-4 py-2 px-4 rounded ">
    <div class="shadow text-center text-gray-600 font-bold mb-4 py-2 px-4 rounded">
        {{ __('All Categories') }}
    </div>
    <livewire:cms.categories-table />
</div>
<div class="flex justify-around mt-8 shadow bg-blue-100 mb-4 py-2 px-4 rounded ">
    <div class="text-gray-600 self-center">
        <div class="shadow text-gray-600 text-center font-bold mb-4 py-2 px-4 rounded">
            {{ __('Add a new category or subcategory') }}
        </div>
    </div>
    <form method="post" action="{{url('/cms/category/add')}}" enctype="multipart/form-data">
        @csrf
        <div class="col-span-6 mb-4">
            <div class="max-w-xl text-sm text-gray-600">
                {{ __('Please provide the information of the category you will like to add to the system.') }}
            </div>
        </div>

        <!-- Member Email -->
        <div class="col-span-6 sm:col-span-4 mb-6">
            <x-jet-label for="name" value="{{ __('Name') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" name="categoryName" required />
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        <!-- Member Email -->
        <div class="col-span-6 sm:col-span-4 mb-6">
            <x-jet-label for="description" value="{{ __('Description') }}" />
            <x-jet-input id="description" type="text" class="mt-1 block w-full" name="description" required />
            <x-jet-input-error for="description" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4 mb-6">
            <x-jet-label for="parentCategory" value="{{ __('Parent Category (for only subcategories)') }}" />
            <select name="parentCategory" class="mt-1 block border-gray-200 rounded w-full">
                <option>select a parent category</option>
                @foreach($parentCategories as $category)
                <option>{{$category->name}}</option>
                @endforeach
            </select>
            <x-jet-input-error for="parentCategory" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4 mb-6">
            <x-jet-label for="bgColour" value="{{ __('Background Colour') }}" />
            <x-jet-input id="bgColour" type="color" class="mt-1 block w-full" name="bgColour" required />
            <x-jet-input-error for="bgColour" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4 mb-6">
            <x-jet-label for="fontColour" value="{{ __('Font Colour') }}" />
            <x-jet-input id="fontColour" type="color" class="mt-1 block w-full" name="fontColour" required />
            <x-jet-input-error for="fontColour" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4 mb-6">
            <x-jet-label for="icon" value="{{ __('Icon (max size 1mb)') }}" />
            <!-- <x-jet-input id="icon" type="file" class="mt-1 block w-full" wire:model.defer="icon" /> -->
            <input type="file" class="mt-1 block w-full" name="icon">

        </div>

        <button type="submit" class='inline-flex items-center px-4 py-2 bg-gray-800 
        border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition'>
            {{ __('Add') }}
        </button>

    </form>


</div>
