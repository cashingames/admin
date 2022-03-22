<?php

namespace App\Http\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;
use App\Models\Live\Question;

class PublishQuestion extends ModalComponent
{   
    public $question;

    public function mount($question){
        $this->question = Question::find($question);
    }

    public function togglePublish(){
        if($this->question->is_published){
            $this->question->update(['is_published' => false]);
        }else{
            $this->question->update(['is_published' => true]);
        }

        return redirect()->to('/cms/questions');
    }

    public function render()
    {
        return view('livewire.modals.publish-question');
    }
}
