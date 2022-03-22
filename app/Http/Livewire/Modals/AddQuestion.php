<?php

namespace App\Http\Livewire\Modals;
use App\Models\Live\Question;
use App\Models\Live\Category;
use App\Models\Live\GameType;
use App\Models\Live\Option;
use Illuminate\Http\Request;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Validator;

class AddQuestion extends ModalComponent
{

    public $subcategories , $gameTypes;

    public function mount()
    {  
        $this->subcategories = Category::where('category_id' ,'>', 0)->get();
        $this->gameTypes = GameType::all();
    }

    public function addQuestion(Request $request)
    {  

        $validator = Validator::make($request->all(), [
            'question' => 'required',
            'level' => 'required',
            'subcategory' => 'required',
            'options' => 'required',
            'isCorrect' => 'required'
        ]);
 
        
        $validator->after(function ($validator, Request $request) {
            if ($this->has_duplicate_correct_options($request->isCorrect)) {
                $validator->errors()->add(
                    'correctOptions', 'You cannot have more than one correct option'
                );
            }
        });

        if($validator->fails()) {
            return redirect()->to('/cms/questions')->withErrors($validator);
        }

        $question = new Question;
        $gameType = GameType::where('display_name', $request->type)->first();
        $subcategory = Category::where('name', $request->subcategory)->first();
        $question->level = $request->level;
        $question->label = $request->question;
        $question->game_type_id = $gameType->id;
        $question->category_id = $subcategory->id;
        $question->save();

        $inputOptions = array_combine ( $request->options , $request->isCorrect );
       
        foreach( $inputOptions as $key=>$value){
            $option = new Option;
            $option->question_id = $question->id;
            $option->title = $key;
            if($value === 'yes' || $value=== null){
                $option->is_correct = true;
            }else{
                $option->is_correct = false;
            }
            $option->save();
        }

        return redirect()->to('/cms/questions');
       
    }

    public function render()
    {
        return view('livewire.modals.add-question');
    }

    private function has_duplicate_correct_options($array) {
        return count($array) !== count(array_unique($array));
    }
}
