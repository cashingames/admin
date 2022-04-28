<?php

namespace App\Http\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;
use App\Models\Live\Trivia;

class DeleteTrivia extends ModalComponent
{   
    public $trivia_id;

    public function mount($id){
        $this->trivia_id = $id ;
    }

    public function deleteTrivia(){
      Trivia::find($this->trivia_id)->delete();
        return redirect()->to('/gaming/trivia');
    }

    public function render()
    {
        return view('livewire.modals.delete-trivia');
    }
}
