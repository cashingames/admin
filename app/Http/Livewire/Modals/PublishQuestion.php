<?php

namespace App\Http\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;
use App\Models\Live\Question;
use App\Models\Question as AdminQuestion;
use Illuminate\Support\Carbon;

class PublishQuestion extends ModalComponent
{   
    public $question;

    public function mount($question){
        $this->question = Question::find($question);
    }

    public function togglePublish(){
        if($this->question->is_published){
            $this->question->update(['is_published' => false]);
            AdminQuestion::where('question_id',$this->question->id)
            ->update(['published_at'=>null,'rejected_at'=>null,'approved_at'=>null]);
        }else{
            $this->question->update(['is_published' => true]);
            AdminQuestion::where('question_id',$this->question->id)
            ->update(['published_at'=>Carbon::now(),'rejected_at'=>null,'approved_at'=>null]);
        }

        return redirect()->to('/cms/questions/published');
    }

    public function render()
    {
        return view('livewire.modals.publish-question');
    }
}
