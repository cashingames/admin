<?php

namespace App\Http\Livewire\Modals;

use App\Models\Live\Question;
use LivewireUI\Modal\ModalComponent;

class QuestionsTableModal extends ModalComponent
{

    public $question;

    public function mount($id)
    {
        $this->question = Question::find($id);
    }

    public function render()
    {
        return view('livewire.modals.questions-table-modal', [
            'question' =>$this->question,
        ]);
    }
}
