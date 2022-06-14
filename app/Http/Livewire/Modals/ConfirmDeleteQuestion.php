<?php

namespace App\Http\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;
use App\Models\Live\Question;
use App\Models\Question as AdminQuestion;
use Illuminate\Support\Carbon;

class ConfirmDeleteQuestion extends ModalComponent
{   
    public $question_id;

    public function mount($question){
        $this->question_id = $question;
    }

    public function deleteQuestion(){
        Question::find($this->question_id)->delete();
        AdminQuestion::where('question_id',$this->question_id)
        ->update(['deleted_at'=>Carbon::now()]);
        return redirect()->to('/cms/questions/unreviewed');
    }

    public function render()
    {
        return view('livewire.modals.confirm-delete-question');
    }
}
