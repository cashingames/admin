<?php

namespace App\Http\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;
use App\Models\Question;

class ConfrimRejectQuestion extends ModalComponent
{   
     
    public $question_id;

    public function mount($id){
        $this->question_id = $id;
    }

    public function rejectQuestion(){
        Question::where('question_id',$this->question_id)->update(['is_approved'=>false]);
        return redirect()->to('/cms/questions');
    }

    public function render()
    {
        return view('livewire.modals.confrim-reject-question',
        [
            'id' =>$this->question_id,
        ]);
    }
}
