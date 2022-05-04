<?php

namespace App\Http\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;
use App\Models\Live\Trivia;

class PublishTrivia extends ModalComponent
{
    public $trivia;

    public function mount($trivia){
        $this->trivia = Trivia::find($trivia);
    }

    public function togglePublish(){
        if($this->trivia->is_published){
            $_trivia = Trivia::find($this->trivia->id);
            $_trivia->is_published = false;
            $_trivia->save();
        }else{
            $_trivia = Trivia::find($this->trivia->id);
            $_trivia->is_published = true;
            $_trivia->save();
        }
        return redirect()->to('/gaming/trivia');
    }

    public function render()
    {
        return view('livewire.modals.publish-trivia');
    }
}
