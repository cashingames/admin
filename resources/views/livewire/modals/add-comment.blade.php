<div>
    <div class="text-center border-b-4 mt-4 mb-4 border-gray-500">
        <span class="font-bold mb-4 ">Add A Comment</span>
    </div>
    <form class="w-full max-w-lg" method="post" action="{{url('/cms/comment/add')}}">
        @csrf
        <div class="w-full px-3 mb-6 md:mb-0">

            <div class="w-full mb-6 md:mb-0">
                <textarea rows="4" , cols="54"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    type="text" placeholder="Add Comment" name="comment" required> </textarea>
            </div> 
            <div class="w-full mb-6 md:mb-0">
                <input
                    type="hidden" name="id" value={{$questionId}} required/>
            </div> 
        </div>
        <div class="md:items-center mt-4 mb-4">
            <button type="submit" class="shadow bg-blue-500 text-white font-bold ml-3 py-2 px-4 rounded">
               Done
            </button>
        </div>
    </form>


</div>