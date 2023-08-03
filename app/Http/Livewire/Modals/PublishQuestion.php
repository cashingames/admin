<?php

namespace App\Http\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;
use App\Models\Live\Question;
use App\Models\Question as AdminQuestion;
use App\Models\QuestionsReviewLog;
use Illuminate\Support\Carbon;

class PublishQuestion extends ModalComponent
{
    public $question;

    public function mount($question)
    {
        $this->question = Question::find($question);
    }

    public function togglePublish()
    {   
        $adminQuestion = AdminQuestion::where('question_id', $this->question->id);

        if ($this->question->is_published) {
            $this->question->update(['is_published' => false]);

            if ($adminQuestion->first() === null) {
                AdminQuestion::create([
                    'question_id' => $this->question->id,
                    'user_id' => $this->question->created_by
                ]);
            }

            $adminQuestion->update(['published_at' => null, 'rejected_at' => null, 'approved_at' => null]);

            QuestionsReviewLog::create(['question_id' => $this->question->id, 'review_type' => 'UNPUBLISHED']);
            return redirect()->to('/cms/questions/published');
        } else {

            $this->question->update(['is_published' => true]);
            $adminQuestion->update(['published_at' => Carbon::now(), 'rejected_at' => null, 'approved_at' => null]);
          
            QuestionsReviewLog::create(['question_id' => $this->question->id, 'review_type' => 'PUBLISHED']);
        }

        return redirect()->to('/cms/questions/published');
    }

    public function render()
    {
        return view('livewire.modals.publish-question');
    }
}
