<?php

namespace App\Http\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;
use App\Models\Question;
use App\Models\QuestionsReviewLog;
use Illuminate\Support\Carbon;

class RejectApprovedQuestion extends ModalComponent
{

    public $question_id;
    public $comment;

    public function mount($id)
    {
        $this->question_id = $id;
    }

    public function rejectQuestion()
    {

        $adminQuestion = Question::where('question_id', $this->question_id)->first();
        if ($adminQuestion === null) {
            Question::create([
                'question_id' => $this->question->id,
                'user_id' => $this->question->created_by
            ]);
        }
        Question::where('question_id', $this->question_id)
            ->update([
                'rejected_at' => Carbon::now(),
                'approved_at' => null,
                'published_at' => null,
                'comment' => $this->comment
            ]);

        QuestionsReviewLog::create([
            'question_id' => $this->question_id,
            'review_type' => 'REJECTED'
        ]);
        return redirect()->to('/cms/questions/approved');
    }

    public function render()
    {
        return view(
            'livewire.modals.reject-approved-question',
            [
                'id' => $this->question_id,
            ]
        );
    }
}
