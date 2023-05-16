<x-cms-layout>
    {{--<button onclick='Livewire.emit("openModal", "modals.add-question")' class="shadow bg-blue-500 text-white font-bold mb-4 py-2 px-4 rounded">
        + Add Question Manually
    </button> --}}
    @if (Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'cms:upload') )
    <a href="{{ url('/cms/questions/upload') }}" class="shadow bg-blue-500 text-white font-bold mb-4 py-2 px-4 rounded">
        + Upload File
    </a>
    @endif
    <div class="mt-4 ">
        <ul class="hidden text-sm font-medium text-center text-gray-500 rounded-lg divide-x divide-gray-200 shadow sm:flex dark:divide-gray-700 dark:text-gray-400">
            <li class="w-full">
                <a href="{{ route('cms.publishedQuestions') }}" aria-current="page" class="inline-block p-4 w-full text-gray-900 bg-blue-300 rounded-l-lg focus:ring-4 focus:ring-blue-300 active focus:outline-none uppercase font-bold dark:bg-gray-700 dark:text-white" aria-current="page">Cashingames</a>
            </li>
            <li class="w-full">
                <a href="{{ route('cms.gameark.publishedQuestions') }}" aria-current="page" class="inline-block p-4 w-full bg-white hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 focus:outline-none uppercase dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">GameArk</a>
            </li>
        </ul>
    </div>
    <div class="mt-4 ">
        <livewire:cms.published-questions />
    </div>
</x-cms-layout>