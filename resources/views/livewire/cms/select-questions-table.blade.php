<div>
    <div class="w-full flex pb-10">
        <div class="w-full mx-1">
            <input wire:model.debounce.300ms="search" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Search questions...">
        </div>
        <div class="w-full relative mx-1">
            <select wire:model="sortField" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                <option value="id">Id</option>
                <option value="label">Label</option>
                <option value="level">Level</option>
                {{-- <option value="subcategory">Subcategory</option> --}}
            </select>
        </div>
        <div class="w-full relative mx-1">
            <select wire:model="sortAsc" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                <option value="1">Ascending</option>
                <option value="0">Descending</option>
            </select>
        </div>
        <div class="w-full relative mx-1">
            <select wire:model="perPage" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                <option>10</option>
                <option>25</option>
                <option>50</option>
                <option>100</option>
            </select>
        </div>

    </div>
    @if($questions->isNotEmpty())
    @foreach($selected as $category)
                    {{$category}} , 
                    @endforeach
    <table class="table-auto w-full mb-6">
        <thead>
            <tr>

                <th class="px-4 py-2">Id</th>
                <th class="px-4 py-2">Level</th>
                <th class="px-4 py-2">Question</th>
                <th class="px-4 py-2">Subcategories</th>
                <th class="px-4 py-2"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($questions as $question)
            <tr>
                <td class="border px-4 py-2">{{$question->id}}</td>
                <td class="border px-4 py-2">{{$question->level}}</td>
                <td class="border px-4 py-2">{{$question->label}}</td>
                <td class="border px-4 py-2"> @foreach($question->categories as $category)
                    {{$category->name}} , 
                    @endforeach
                </td>
                <td class="border px-4 py-2">
                    <input wire:click='addToSelectedQuestions({{ $question->id }})' type="checkbox">
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $questions->links() !!}
    <div class='flex justify-center'>
        <button class="shadow mt-2 mb-2 ml-2 py-2 bg-blue-500 text-white font-bold px-4 rounded" wire:click="saveSelectedQuestions"> Save</button>
    </div>
    @else
    <p class="text-center">Whoops! No questions were found 🙁</p>
    @endif
</div>