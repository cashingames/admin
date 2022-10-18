<div>
    <form class="w-full max-w-lg pt-6" method="post" action="{{url('/cms/category/edit')}}">
        @csrf
        <div class="mb-6">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <input type="hidden" name="category_id" value={{$category->id}}>
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Category Name
                </label>
                <textarea rows="2" , cols="12" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" name="name"> {{$category->name}}</textarea>
            </div>
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Description
                </label>
                <textarea rows="2" , cols="12" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" name="description"> {{$category->description}}</textarea>
            </div>
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Font Colour
                </label>
                <textarea rows="1" , cols="12" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" name="fontColour"> {{$category->font_color}}</textarea>
            </div>
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Background Colour
                </label>
                <textarea rows="1" , cols="12" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" name="bgColour"> {{$category->background_color}}</textarea>
            </div>
            @if (!is_null($parentCategory))
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Parent Category
                </label>
                <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="parentCategory">
                    <option>{{$parentCategory->name}}</option>
                    @foreach ($parentCategories as $category)
                    <option>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            @endif
            <div class="md:items-center flex mb-4">
                <button type="submit" class="shadow bg-gray-800 text-white font-bold ml-4 py-2 px-4 rounded">
                    Save
                </button>
            </div>
    </form>

</div>