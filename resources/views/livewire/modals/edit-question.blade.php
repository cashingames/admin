<form class="w-full max-w-lg pt-6">
    <div class="mb-6">
        <div class="w-full  px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                QUESTION
            </label>
            <textarea rows="4" , cols="54"
                class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                type="text" placeholder="Question"> {{$question->label}}</textarea>
        </div>
        <div class="w-full  px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                LEVEL
            </label>
            <div class="relative ">
                <select
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option>easy</option>
                    <option>medium</option>
                    <option>hard</option>
                </select>
            </div>
        </div>
    </div>
    <div class="flex flex-wrap  px-3 mb-6 md:mb-0">
        <div class="w-full">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                SUBCATEGORY
            </label>
            <select
                class="block appearance-none w-full mb-4 bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="grid-state">
                @foreach ($subcategories as $s)
                <option>{{$s->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="flex flex-wrap px-3 mb-6 md:mb-0">
        <div class="w-full mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                OPTIONS
            </label>
            <div class="relative">
                
                @foreach ($question->options as $option)
                @if ($option->is_correct)
                <textarea rows="2", cols="54"
                    class="appearance-none block w-full bg-green-500 mb-1 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    type="text" placeholder="option" >{{$option->title}}</textarea>
                <label class="block lowercase tracking-wide text-gray-700 text-xs font-bold mb-1">
                    is this the Correct Option ?
                </label>
                <div class="relative mb-2 border-b-4 border-blue-500">
                    <select
                        class="block appearance-none w-1/2 bg-gray-200 border mb-4 border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-state">
                        <option>yes</option>
                        <option>no</option>
                    </select>
                </div>
                @else
                <textarea rows="2", cols="54"
                    class="appearance-none block w-full bg-gray-200 mb-1 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    type="text" placeholder="option" >{{$option->title}}</textarea>
                <label class="block lowercase tracking-wide text-gray-700 text-xs font-bold mb-1">
                    is this the Correct Option ?
                </label>
                <div class="relative mb-2 border-b-4 border-blue-500">
                    <select
                        class="block appearance-none w-1/2 bg-gray-200 mb-4 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-state">
                        <option>yes</option>
                        <option>no</option>
                    </select>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="flex-no-wrap justify-between">
        <div class="md:items-center mb-4">
            <button class="shadow bg-blue-500 text-white font-bold ml-4 py-2 px-4 rounded" type="button">
                Save
            </button>
        </div>
    </div>
</form>