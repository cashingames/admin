<form class="w-full max-w-lg pt-6">
    <div class="mb-6">
        <div class="w-full  px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                QUESTION ID
            </label>
            <input
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                type="text" placeholder="Level" value={{$question->id}}>
        </div>
        <div class="w-full  px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2" >
                QUESTION
            </label>
            <textarea rows="4" , cols="54"
                class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                type="text" placeholder="Question"> {{$question->label}}</textarea>
        </div>
        <div class="w-full  px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                LEVEL
            </label>
            <input
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                type="text" placeholder="Level" value={{$question->level}}>
        </div>
    </div>
    <div class="flex flex-wrap  px-3 mb-6 md:mb-0">
        <div class="w-full">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                SUBCATEGORY
            </label>
            <textarea rows="2" , cols="54"
                class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                type="text" placeholder="Question"> {{$question->category->name}}</textarea>
        </div>
    </div>
    <div class="flex flex-wrap px-3 mb-6 md:mb-0">
        <div class="w-full mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                OPTIONS
            </label>
            <div class="relative">
                @foreach ($question->options as $option)
                @if ($option->is_correct)
                <input
                    class="appearance-none block w-full bg-green-500 mb-3 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    type="text" placeholder="Level" value={{$option->title}}>
                @else
                <input
                    class="appearance-none block w-full bg-gray-200 mb-3 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    type="text" placeholder="Level" value={{$option->title}}>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="flex-no-wrap justify-between">
        <div class="md:items-center mb-4">
            <button class="shadow bg-blue-500 text-white font-bold ml-4 py-2 px-4 rounded" type="button">
                Edit
            </button>
        </div>
        <div class="md:items-center mb-4">
            <button class="shadow bg-red-600 text-white font-bold ml-4 py-2 px-4 rounded" type="button">
                Delete
            </button>

        </div>
    </div>
</form>