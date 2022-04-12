<?php

namespace App\Http\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;

use App\Models\Question;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AddComment extends ModalComponent
{   
    public $questionId;
  
    public function mount($id)
    {
        $this->questionId = $id;
    }

    public function addComment(Request $request){
        
        $validator = Validator::make($request->all(), [
            'comment' => 'required',
        ]);

      
        $_question = Question::where('question_id',$request->id)->first();

        if ($_question == null){
            return redirect()->to('/cms/questions')->withErrors('The selected question was not found');
        }

        $_question->comment = $request->comment;
        $_question->is_approved = false;
        $_question->save();
        return redirect()->to('/cms/questions');
    }

    public function render()
    {
        
        return view('livewire.modals.add-comment', [
            'questionId' =>$this->questionId,
        ]);
    }
  
}
