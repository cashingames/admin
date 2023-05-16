
<div wire:poll.300000ms='filterReports'>
    <div class="flex items-center">
        <span class="mx-2 text-gray-500">select date range</span>
        <div class="relative">
            <input wire:model='startDate' name="start" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start">
        </div>
        <span class="mx-2 text-gray-500">to</span>
        <div class="relative">
            <input wire:model='endDate' name="end" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end">
        </div>
        @if ($addExtraFilters)
        <span class="mx-2 text-gray-500">Subcategory</span>
        <select wire:model="subcategory" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-50 px-4 pr-8 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            <option>select subcategory</option>
            @foreach ($subcategories as $s )
            <option>{{$s->name}}</option>
            @endforeach
        </select>
        <span class="mx-2 text-gray-500">Creator</span>
        <select wire:model="creator" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-50 px-4 pr-8 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            <option>select creator</option>
            @foreach ($creators as $c )
            <option>{{$c->name}}</option>
            @endforeach
        </select>
        @endif

        <div class="md:items-center">
            <button wire:click='filterReports' class="shadow bg-blue-500 text-white font-bold ml-4 px-4 rounded">
                filter
            </button>
        </div>
        @if ($addExtraFilters)
        <div class="md:items-center">
            <button wire:click='addExtraFilters' class="shadow bg-blue-500 text-white font-bold ml-4 px-4 rounded">
                Remove filters
            </button>
        </div>
        @else
        <div class="md:items-center">
            <button wire:click='addExtraFilters' class="shadow bg-blue-500 text-white font-bold ml-4 px-4 rounded">
                Add filters
            </button>
        </div>
        @endif
    </div>

    <div class="flex flex-row flex-wrap justify-between">
        <div class=" text-center text-gray-600 text-lg font-bold mt-16">
            <span>Total Uploaded Questions Count</span>
            <x-reports-layout>
                <span wire:model='questionsCount'>{{$questionsCount}}</span>
            </x-reports-layout>
        </div>
        <div class=" text-center text-gray-600 text-lg font-bold mt-16">
            <span>Number of Published Questions</span>
            <x-reports-layout>
                <span wire:model='publishedQuestions'>{{$publishedQuestions}}</span>
            </x-reports-layout>
        </div>
        <div class=" text-center text-gray-600 text-lg font-bold mt-16">
            <span>Number of UnPublished Questions</span>
            <x-reports-layout>
                <span wire:model='unPublishedQuestions'>{{$unPublishedQuestions}}</span>
            </x-reports-layout>
        </div>
        <div class=" text-center text-gray-600 text-lg font-bold mt-16">
            <span>Number of Rejected Questions</span>
            <x-reports-layout>
                <span wire:model='rejectedQuestions'>{{$rejectedQuestions}}</span>
            </x-reports-layout>
        </div>
        <div class=" text-center text-gray-600 text-lg font-bold mt-16">
            <span>Number of Approved Questions</span>
            <x-reports-layout>
                <span wire:model='approvedQuestions'>{{$approvedQuestions}}</span>
            </x-reports-layout>
        </div>
    </div>
   
</div>
