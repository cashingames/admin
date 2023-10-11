<div>
    <div class="w-full flex flex-row justify-center ">
        <p class="block uppercase tracking-wide mt-4 text-gray-700 text-l font-bold mb-2">
            Edit User Details
        </p>
    </div>

    <div class="flex flex-row justify-center">
        <p wire:loading class="text-teal-500 text-lg text-center mb-4 font-bold italic">Saving Details...</p>
        <p class="text-teal-500 text-lg text-center mb-4 font-bold italic">{{$message}}</p>
    </div>
    <div class="w-full flex flex-row justify-center ">
        <div class="mb-6">
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Username
                </label>
                <textarea rows="1" , cols="54" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" wire:model="username"> {{$user->username}}</textarea>
            </div>
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Email
                </label>
                <textarea rows="1" , cols="1" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" wire:model="email"> {{$user->email}}</textarea>
            </div>
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Phone Number
                </label>
                <textarea rows="1" , cols="1" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" wire:model="phone"> {{$user->phone_number}}</textarea>
            </div>
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    First Name
                </label>
                <textarea rows="1" cols="1" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" wire:model="firstName">{{$user->profile->first_name}}</textarea>
            </div>
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                    Last Name
                </label>
                <textarea rows="1" cols="1" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" wire:model="lastName">{{$user->profile->last_name}}</textarea>
            </div>

            <button wire:click="editUser" wire:loading.attr="disabled" class="shadow bg-blue-500 text-white font-bold ml-4 py-2 px-4 rounded">
                Save
            </button>
            <button wire:click="verifyUser" wire:loading.attr="disabled" class="shadow bg-blue-500 text-white font-bold ml-4 py-2 px-4 rounded">
                @if(isset($user->meta_data['kyc_verified']) && $user->meta_data['kyc_verified'])
                Verified
            @else
                Verify
            @endif
            </button>
        </div>


    </div>