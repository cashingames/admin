<?php

namespace App\Http\Livewire\Modals;

use App\Models\Live\Question;
use App\Models\Live\Category;
use App\Models\Live\Option;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EditQuestion extends ModalComponent
{   
    public $question;
    public $subcategories;

    public function mount($question)
    {  
        $this->question = Question::find($question);
        $this->subcategories = Category::where('category_id' ,'>', 0)->get();
    }

    public function editQuestion(Request $request){

       
        $validator = Validator::make($request->all(), [
            'question' => 'required',
            'level' => 'required',
            'subcategory' => 'required',
            'option.title' => 'required',
            'option.is_correct' => 'required'
        ]);
 
        if($validator->fails()) {
            return redirect()->to('/cms/questions')->withErrors($validator);
        }

        $question = Question::find($request->question_id);
        $question->label = $request->question;
        $question->level = $request->level;

        $category = Category::where('name',$request->subcategory)->first();

        if($category !== null){
            $question->category_id = $category->id;
        }
        $options = $question->options()->get();

        foreach($options as $key=>$_option){
                $_option->title = $request->option[$key]['title'];
                
                if($request->option[$key]['is_correct'] === 'yes'){
                    $_option->is_correct = true;
                }else{
                    $_option->is_correct = false;
                }
                $_option->save();
        }
        
        $question->save();
        return redirect()->to('/cms/questions');
    }

    public function render()
    {
        return view('livewire.modals.edit-question');
    }
    
}
