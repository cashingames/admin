<?php

namespace App\Http\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;

use App\Models\Question;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
            return redirect()->to('/cms/questions/unreviewed')->withErrors('The selected question was not found');
        }

        $_question->comment = $request->comment;
        $_question->rejected_at = Carbon::now();
        $_question->save();
        return redirect()->to('/cms/questions/unreviewed');
    }

    public function render()
    {
        
        return view('livewire.modals.add-comment', [
            'questionId' =>$this->questionId,
        ]);
    }
  
}
