<?php

namespace App\Http\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;
use App\Models\Question;

class ConfirmApproveQuestion extends ModalComponent
{   
    public $question_id;

    public function mount($id){
        $this->question_id = $id;
    }

    public function approveQuestion(){
        Question::where('question_id',$this->question_id)->update(['is_approved'=>true]);
        return redirect()->to('/cms/questions');
    }

    public function render()
    {
        return view('livewire.modals.confirm-approve-question', [
            'id' =>$this->question_id,
        ]);
    }
}
