<?php

namespace App\Http\Livewire\Modals;

use App\Models\Live\Question;
use App\Models\Live\Category;
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
    
        $question = Question::find($request->question_id);
        $question->label = $request->label;
        $question->level = $request->level;

        $category = Category::where('name',$request->subcategory)->first();

        if($category !==null){
            $question->category_id = $category->id;
        }
        $options = $question->options()->get();

        // foreach($request->option as $o){
        //     var_dump($o['title']);
        
        // }
        // die();
        foreach($options as $_option){
            foreach($request->option as $key=>$value){
                
                $_option->title = $value['title'];
                
                if($value['is_correct'] === 'yes'){
                    $_option->is_correct = true;
                }else{
                    $_option->is_correct = false;
                }
                $_option->save();
            } 
        }
        // die();
        $question->save();
    }

    public function render()
    {
        return view('livewire.modals.edit-question');
    }
}
