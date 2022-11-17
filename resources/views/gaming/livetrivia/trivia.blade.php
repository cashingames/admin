<x-gaming-layout>
    @can('super-admin-access')
    @if ($errors->any())
    <div class="mb-4 w/50 text-red-500 font-bold">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <a href="{{ route('trivia.create') }}" class="shadow bg-blue-500 text-white font-bold mb-4 py-2 px-4 rounded">
        + Create Live Trivia
    </a>
    <div class="mt-4">
        <livewire:gaming.livetrivia.trivia-table/>
     
    </div>
    @else
    <div class="mt-4">
        You are not authorized to access this data.
    </div>
    @endcan

</x-gaming-layout>