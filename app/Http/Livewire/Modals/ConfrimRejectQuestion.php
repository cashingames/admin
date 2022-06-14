<?php

namespace App\Http\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;
use App\Models\Question;
use App\Models\QuestionsReviewLog;
use Illuminate\Support\Carbon;

class ConfrimRejectQuestion extends ModalComponent
{   
     
    public $question_id;
    public $comment;

    public function mount($id){
        $this->question_id = $id;
    }

    public function rejectQuestion(){
        Question::where('question_id',$this->question_id)
        ->update(['rejected_at'=>Carbon::now(),
        'approved_at'=>null,
        'published_at'=>null,
        'comment' =>$this->comment
    ]);

        QuestionsReviewLog::create(['question_id'=>$this->question_id,'review_type'=>'REJECTED']);
        return redirect()->to('/cms/questions/unreviewed');
    }

    public function render()
    {
        return view('livewire.modals.confrim-reject-question',
        [
            'id' =>$this->question_id,
        ]);
    }
}
