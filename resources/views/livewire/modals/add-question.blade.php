<div>
    <div class="text-center border-b-4 mt-4 mb-4 border-gray-500">
        <span class="font-bold mb-4 ">Add A Question</span>
    </div>
    <form class="w-full max-w-lg" method="post" action="{{url('/cms/question/add')}}">
        @csrf
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                Question Type
            </label>
            <div class="relative">
                <select
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    name="type" required>
                    @foreach ($gameTypes as $type )
                    <option>{{$type->display_name}}</option>
                    @endforeach
                </select>
            </div>
            <label class="block uppercase tracking-wide mt-2 text-gray-700 text-xs font-bold mb-2" for="grid-state">
                Subcategory
            </label>
            <div class="relative">
                <select
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    name="subcategory" required>
                    @foreach ($subcategories as $s )
                    <option>{{$s->name}}</option>
                    @endforeach
                </select>
            </div>
            <label class="block uppercase tracking-wide mt-2 text-gray-700 text-xs font-bold mb-2" for="grid-state">
                Question Level
            </label>
            <div class="relative">
                <select
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    name="level" required>
                    <option>easy</option>
                    <option>medium</option>
                    <option>hard</option>
                </select>
            </div>
            <div class="w-full mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Question
                </label>
                <textarea rows="4" , cols="54"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    type="text" placeholder="Question" name="label" required> </textarea>
            </div>
            {{-- <div class="w-full mb-6 md:mb-0" wire:model="questionOptions">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Options
                </label>
                @foreach ($questionOptions as $key=> $value )
                <div
                    class=" border-b-4 border-blue-500 appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                    <span>option: {{$value}}</span>

                </div>
                @endforeach

            </div> --}}
            <div class="w-full mb-6 md:mb-0">
                <label class="block tracking-wide mt-4 text-blue-700 text-lg font-bold mb-2">
                    Add Option
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    type="text" placeholder="90210" name="options[0]['title']">
            </div>
            <label class="block lowercase tracking-wide text-gray-700 text-xs font-bold mb-1">
                correct ?
            </label>
            <div class="relative mb-2">
                <select
                    class="block appearance-none w-1/2 bg-gray-200 border mb-4 border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    name="options[0]['is_correct']">
                    <option>yes</option>
                    <option>no</option>
                </select>
            </div>
            <div class="w-full mb-6 md:mb-0">
                <label class="block tracking-wide mt-4 text-blue-700 text-lg font-bold mb-2">
                    Add Option
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    type="text" placeholder="90210" name="options[1]['title']">
            </div>
            <label class="block lowercase tracking-wide text-gray-700 text-xs font-bold mb-1">
                correct ?
            </label>
            <div class="relative mb-2">
                <select
                    class="block appearance-none w-1/2 bg-gray-200 border mb-4 border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    name="options[1]['is_correct']">
                    <option>yes</option>
                    <option>no</option>
                </select>
            </div>
            <div class="w-full mb-6 md:mb-0">
                <label class="block tracking-wide mt-4 text-blue-700 text-lg font-bold mb-2">
                    Add Option
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    type="text" placeholder="90210" name="options[2]['title']">
            </div>
            <label class="block lowercase tracking-wide text-gray-700 text-xs font-bold mb-1">
                correct ?
            </label>
            <div class="relative mb-2">
                <select
                    class="block appearance-none w-1/2 bg-gray-200 border mb-4 border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    name="options[2]['is_correct']">
                    <option>yes</option>
                    <option>no</option>
                </select>
            </div>
            <div class="w-full mb-6 md:mb-0">
                <label class="block tracking-wide mt-4 text-blue-700 text-lg font-bold mb-2">
                    Add Option
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    type="text" placeholder="90210" name="options[3]['title']">
            </div>
            <label class="block lowercase tracking-wide text-gray-700 text-xs font-bold mb-1">
                correct ?
            </label>
            <div class="relative mb-2">
                <select
                    class="block appearance-none w-1/2 bg-gray-200 border mb-4 border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    name="options[3]['is_correct']">
                    <option>yes</option>
                    <option>no</option>
                </select>
            </div>
        </div>
        <div class="md:items-center mt-4 mb-4">
            <button type="submit" class="shadow bg-blue-500 text-white font-bold ml-3 py-2 px-4 rounded">
                Save Question
            </button>
        </div>
    </form>


</div>