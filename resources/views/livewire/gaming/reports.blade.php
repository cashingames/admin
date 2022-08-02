@can('super-admin-access')
<div>
    <div class="flex items-center">
        <span class="mx-2 text-gray-500">select date range</span>
        <div class="relative">
            <input wire:model='startDate' name="start" type="date"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Select date start">
        </div>
        <span class="mx-4 text-gray-500">to</span>
        <div class="relative">
            <input wire:model='endDate' name="end" type="date"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Select date end">
        </div>
        <div class="md:items-center">
            <button wire:click='filterReports' class="shadow bg-blue-500 text-white font-bold ml-4 px-4 rounded">
                filter
            </button>
        </div>
    </div>
    <p class=" text-center text-gray-600 text-lg font-bold m-4">CHALLENGE</p>
    <div class="flex flex-row flex-wrap justify-center">
        <div class=" text-center text-gray-600 text-lg font-bold m-4">
            <span>Number of Initiated Challenges</span>
            <x-reports-layout>
                <span wire:model='initiatedChallenges'>{{$initiatedChallenges}}</span>
            </x-reports-layout>
        </div>

        <div class=" text-center text-gray-600 text-lg font-bold m-4">
            <span>Number of Accepted Challenges</span>
            <x-reports-layout>
                <span wire:model='acceptedChallenges'>{{$acceptedChallenges}}</span>
            </x-reports-layout>
        </div>

        <div class=" text-center text-gray-600 text-lg font-bold m-4">
            <span>Number of Declined Challenges</span>
            <x-reports-layout>
                <span wire:model='declinedChallenges'>{{$declinedChallenges}}</span>
            </x-reports-layout>
        </div>

        <div class=" text-center text-gray-600 text-lg font-bold m-4">
            <span>Number of Pending Challenges</span>
            <x-reports-layout>
                <span wire:model='pendingChallenges'>{{$pendingChallenges}}</span>
            </x-reports-layout>
        </div>
    </div>
    <p class=" text-center text-gray-600 text-lg font-bold m-4">LIVE TRIVIA</p>
    <div class="flex flex-row flex-wrap justify-center">
        <div class=" text-center text-gray-600 text-lg font-bold m-4">
            <span>Number of Live Trivia</span>
            <x-reports-layout>
                <span wire:model='liveTriviaCount'>{{$liveTriviaCount}}</span>
            </x-reports-layout>
        </div>

        <div class=" text-center text-gray-600 text-lg font-bold m-4">
            <span>Number of Live Trivia Participants</span>
            <x-reports-layout>
                <span wire:model='liveTriviaParticipants'>{{$liveTriviaParticipants}}</span>
            </x-reports-layout>
        </div>
    </div>

</div>
@else
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    You are not authorised to access this data.
</div>
@endcan