<?php

namespace App\Http\Livewire\Modals;
use App\Models\Question as AdminQuestion;
use App\Models\Live\Question as LiveQuestion;
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
 
        $hasDuplicateCorrectAnswers = $this->has_duplicate_correct_options($request->isCorrect);
       
        $validator->after(function ($validator) use ($hasDuplicateCorrectAnswers ) {
            if ($hasDuplicateCorrectAnswers) {
                $validator->errors()->add(
                    'correctOptions', 'A question should not have more than one correct option'
                );
            }
        });

        if($validator->fails()) {
            return redirect()->to('/cms/questions')->withErrors($validator);
        }

        $question = new LiveQuestion;
        $gameType = GameType::where('display_name', $request->type)->first();
        $subcategory = Category::where('name', $request->subcategory)->first();
        $question->level = $request->level;
        $question->label = $request->question;
        $question->game_type_id = $gameType->id;
        $question->category_id = $subcategory->id;
        $question->created_by = auth()->user()->id;
        $question->save();

        $adminQuestion = new AdminQuestion;
        $adminQuestion->user_id = auth()->user()->id;
        $adminQuestion->question_id = $question->id;
        $adminQuestion->save();

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
        if(count(array_keys($array, "yes")) > 1){
            return true;
        }
        else {
            return false;
        }
    }
}
