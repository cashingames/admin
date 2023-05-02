<x-cms-layout>
    <button onclick='Livewire.emit("openModal", "modals.add-question")' class="shadow bg-blue-500 text-white font-bold mb-4 py-2 px-4 rounded">
        + Add Question Manually
    </button>
    <a href="{{ url('/cms/questions/upload') }}" class="shadow bg-blue-500 text-white font-bold mb-4 py-2 px-4 rounded">
        + Upload File
    </a>

    <ul class="hidden text-sm font-medium text-center text-gray-500 rounded-lg divide-x divide-gray-200 shadow sm:flex dark:divide-gray-700 dark:text-gray-400">
        <li class="w-full">
            <a href="{{ route('cms.unreviewedQuestions') }}" class="inline-block p-4 w-full bg-white hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 uppercase focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">Ready For Review</a>
        </li>
        <li class="w-full">
            <a href="{{ route('cms.approvedQuestions') }}" class="inline-block p-4 w-full text-gray-900 bg-blue-300 focus:ring-4 focus:ring-blue-300 active focus:outline-none uppercase font-bold dark:bg-gray-700 dark:text-white" aria-current="page">Approved</a>
        </li>
        <li class="w-full">
            <a href="{{ route('cms.rejectedQuestions') }}" class="inline-block p-4 w-full bg-white hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 uppercase focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">Rejected</a>
        </li>
        <li class="w-full">
            <a href="{{ route('cms.publishedQuestions') }}" class="inline-block p-4 w-full bg-white rounded-r-lg hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:outline-none uppercase focus:ring-blue-300 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">Published</a>
        </li>
    </ul>
    <div class="mt-4 ">
        <livewire:cms.approved-questions />
    </div>

</x-cms-layout>