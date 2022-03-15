<?php

namespace App\Http\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;
use App\Models\Live\Question;

class ConfirmDeleteQuestion extends ModalComponent
{   
    public $question_id;

    public function mount($question){
        $this->question_id = $question;
    }

    public function deleteQuestion(){
        Question::find($this->question_id)->delete();
        return redirect()->to('/cms/questions');
    }

    public function render()
    {
        return view('livewire.modals.confirm-delete-question');
    }
}
