<?php

namespace App\Http\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;
use App\Models\Question;
use App\Models\QuestionsReviewLog;
use Illuminate\Support\Carbon;

class ConfirmApproveQuestion extends ModalComponent
{   
    public $question_id;

    public function mount($id){
        $this->question_id = $id;
    }

    public function approveQuestion(){
        Question::where('question_id',$this->question_id)
        ->update(['approved_at'=>Carbon::now(),'rejected_at'=>null,'published_at'=>null]);

        QuestionsReviewLog::create(['question_id'=>$this->question_id,'review_type'=>'APPROVED']);

        return redirect()->to('/cms/questions/unreviewed');
    }

    public function render()
    {
        return view('livewire.modals.confirm-approve-question', [
            'id' =>$this->question_id,
        ]);
    }
}
