@can('super-admin-access')
<div>
    <div date-rangepicker class="flex items-center">
        <div class="relative">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <input wire:model='startDate' name="start" type="text"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Select date start">
        </div>
        <span class="mx-4 text-gray-500">to</span>
        <div class="relative">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <input wire:model='endDate' name="end" type="text"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Select date end">
        </div>
        <div class="md:items-center">
            <button wire:click='filterReports' class="shadow bg-blue-500 text-white font-bold ml-4 px-4 rounded">
                filter
            </button>
        </div>
    </div>
    <div class="flex flex-row flex-wrap justify-between">
        <div class=" text-center text-gray-600 text-lg font-bold m-2">
            <span>Number of Users who have played a game</span>
            <x-reports-layout >
                <span wire:model='userPlayedCount'>{{$userPlayedCount}}</span>
            </x-reports-layout>
        </div>

        <div class=" text-center text-gray-600 text-lg font-bold m-2">
            <span>Number of Users who have exhausted free game</span>
            <x-reports-layout >
                <span wire:model='userExhaustedFreeGameCount'>{{$userExhaustedFreeGameCount}}</span>
            </x-reports-layout>
        </div>
        <div class=" text-center text-gray-600 text-lg font-bold m-2">
            <span>Number of Users who have referrals</span>
            <x-reports-layout>
                <span wire:model='referredUserCount'>{{$referredUserCount}}</span>
            </x-reports-layout>
        </div>
        <div class=" text-center text-gray-600 text-lg font-bold m-2">
            <span>Number of Users who have bought games</span>
            <x-reports-layout>
                <span wire:model='boughtGamesCount'>{{$boughtGamesCount}}</span>
            </x-reports-layout>
        </div>
   
        <div class=" text-center text-gray-600 text-lg font-bold m-2">
            <span>Number of Users who have bought boosts</span>
            <x-reports-layout >
                <span wire:model='boughtBoostsCount'>{{$boughtBoostsCount}}</span>
            </x-reports-layout>
        </div>

       <div class=" text-center text-gray-600 text-lg font-bold m-2">
            <span>Number of Users who have used boosts</span>
            <x-reports-layout >
                <span wire:model='usedBoostsCount'>{{$usedBoostsCount}}</span>
            </x-reports-layout>
        </div>
         {{-- 
        <div class=" text-center text-gray-600 text-lg font-bold mt-16">
            <span>Referred User Count</span>
            <x-reports-layout>
                <span wire:model='referredUserCount'>{{$referredUserCount}}</span>
            </x-reports-layout>
        </div> --}}
        {{-- <div class=" text-center text-gray-600 text-lg font-bold mt-16">
            <span>Bought Games Count</span>
            <x-reports-layout>
                <span wire:model='boughtGamesCount'>{{$boughtGamesCount}}</span>
            </x-reports-layout>
        </div> --}}
    </div>
</div>
@else
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    You are not authorised to access this data.
</div>
@endcan