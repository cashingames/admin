<div>
    <div class="text-center border-b-4 mt-4 mb-4 border-gray-500">
        <span class="font-bold mb-4 ">Add A Question</span>
    </div>
    <form class="w-full max-w-lg" method="post" action="{{url('/cms/question/add')}}">
        @csrf
        <div class="w-full px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                Question Type
            </label>
            <div class="relative">
                <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="type" required>
                    @foreach ($gameTypes as $type )
                    <option>{{$type->display_name}}</option>
                    @endforeach
                </select>
            </div>
            <label class="block tracking-wide mt-2 text-gray-700 text-xs font-bold mb-2" for="grid-state">
                SUBCATEGORY (You can select multiple)
            </label>
            @foreach ($subcategories as $s )
            <div class="relative flex w-full bg-gray-200 border border-gray-200 text-gray-700 px-4 pr-8 rounded">
                <span>{{$s->name}}</span>
                <input name="selectedSubcategories[]" class="shadow font-bold ml-16 rounded" type="checkbox" value={{$s->id}}>
            </div>
            @endforeach
            <!-- <div class="relative">
                <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="selectedSubcategories[]" multiple required>
                    @foreach ($subcategories as $s )
                    <option>{{$s->name}}</option>
                    @endforeach
                </select>
            </div> -->
            <label class="block uppercase tracking-wide mt-2 text-gray-700 text-xs font-bold mb-2" for="grid-state">
                Question Level
            </label>
            <div class="relative">
                <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="level" required>
                    <option>easy</option>
                    <option>medium</option>
                    <option>hard</option>
                </select>
            </div>
            <div class="w-full mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Question
                </label>
                <div>
                @if(count($questionHints)>0)
                    <p class="text-red-500 text-xs text-left">similar existing questions:</p>
                    @foreach($questionHints as $hint)
                    <div id="dropdownDotsHorizontal" class=" z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                        <ul class=" py-1 text-xs text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconHorizontalButton">
                            <li>
                                <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{$hint}}</a>
                            </li>
                        </ul>
                    </div>
                    @endforeach
                @endif
                </div>
                <textarea wire:model="keyWords" rows="4" , cols="54" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="Question" name="question" required> </textarea>
            </div>
            <div class="w-full mb-6 md:mb-0">
                <label class="block tracking-wide mt-4 text-blue-700 text-lg font-bold mb-2">
                    Add Option
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="option" name="options[]">
            </div>
            <label class="block lowercase tracking-wide text-gray-700 text-xs font-bold mb-1">
                is this the Correct Option ?
            </label>
            <div class="relative mb-2">
                <select class="block appearance-none w-1/2 bg-gray-200 border mb-4 border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="isCorrect[]">
                    <option>no</option>
                    <option>yes</option>
                </select>
            </div>
            <div class="w-full mb-6 md:mb-0">
                <label class="block tracking-wide mt-4 text-blue-700 text-lg font-bold mb-2">
                    Add Option
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="option" name="options[]">
            </div>
            <label class="block lowercase tracking-wide text-gray-700 text-xs font-bold mb-1">
                is this the Correct Option ?
            </label>
            <div class="relative mb-2">
                <select class="block appearance-none w-1/2 bg-gray-200 border mb-4 border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="isCorrect[]">
                    <option>no</option>
                    <option>yes</option>
                </select>
            </div>
            <div class="w-full mb-6 md:mb-0">
                <label class="block tracking-wide mt-4 text-blue-700 text-lg font-bold mb-2">
                    Add Option
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="option" name="options[]">
            </div>
            <label class="block lowercase tracking-wide text-gray-700 text-xs font-bold mb-1">
                is this the Correct Option ?
            </label>
            <div class="relative mb-2">
                <select class="block appearance-none w-1/2 bg-gray-200 border mb-4 border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="isCorrect[]">
                    <option>no</option>
                    <option>yes</option>
                </select>
            </div>
            <div class="w-full mb-6 md:mb-0">
                <label class="block tracking-wide mt-4 text-blue-700 text-lg font-bold mb-2">
                    Add Option
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="option" name="options[]">
            </div>
            <label class="block lowercase tracking-wide text-gray-700 text-xs font-bold mb-1">
                is this the Correct Option ?
            </label>
            <div class="relative mb-2">
                <select class="block appearance-none w-1/2 bg-gray-200 border mb-4 border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="isCorrect[]">
                    <option>no</option>
                    <option>yes</option>
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