<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" wire:model="question">{{$question->id}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-header">
            <h5 class="modal-title" wire:model="question">{{$question->label}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-header">
            <h5 class="modal-title" wire:model="question">{{$question->level}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-header">
            <h5 class="modal-title" wire:model="question">{{$question->category->name}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-header">
                @foreach ($question->options as $option)
                    <h5 class="modal-title" wire:model="question">{{$option->title}}</h5>
                @endforeach
        </div>
    </div>
</div>