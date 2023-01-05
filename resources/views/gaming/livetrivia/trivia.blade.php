<x-gaming-layout>
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
</x-gaming-layout>