<?php

namespace App\Http\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;
use App\Models\Live\Question;
use App\Models\Question as AdminQuestion;
use App\Models\QuestionsReviewLog;
use Illuminate\Support\Carbon;

class DeleteRejectedQuestion extends ModalComponent
{
    public $question_id;

    public function mount($question)
    {
        $this->question_id = $question;
    }

    public function deleteQuestion()
    {
        Question::find($this->question_id)->delete();
        AdminQuestion::where('question_id', $this->question_id)
            ->update([
                'deleted_at' => Carbon::now(), 'approved_at' => null,
                'published_at' => null, 'rejected_at' => null
            ]);
        QuestionsReviewLog::create([
            'question_id' => $this->question_id,
            'review_type' => 'DELETED'
        ]);
        return redirect()->to('/cms/questions/rejected');
    }

    public function render()
    {
        return view('livewire.modals.delete-rejected-question');
    }
}
