<?php

namespace App\Http\Livewire;

use App\Models\Live\Question;
use LivewireUI\Modal\ModalComponent;

class QuestionsTableModal extends ModalComponent
{

    public $question;

    public function mount(Question $question)
    {
        $this->question = $question;
    }

    public function render()
    {
        return view('livewire.questions-table-modal');

        return view('livewire.questions-table-modal', [
            'questions' => Question::all(),
        ]);
    }
}
