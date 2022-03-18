<?php

namespace App\Http\Livewire\Modals;
use App\Models\Live\Question;
use App\Models\Live\Category;
use App\Models\Live\GameType;
use App\Models\Live\Option;
use Illuminate\Http\Request;
use LivewireUI\Modal\ModalComponent;

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

        $data = $request->validate([
            'type' => ['required', 'string'],
            'subcategory' => ['required', 'string', 'max:20'],
            'level' => ['required', 'string'],
            'label' => ['required', 'string'],
        ]);

        $question = new Question;
        $gameType = GameType::where('display_name', $data['type'])->first();
        $subcategory = Category::where('name', $data['subcategory'])->first();
        $question->level = $data['level'];
        $question->label = $data['label'];
        $question->game_type_id = $gameType->id;
        $question->category_id = $subcategory->id;
        $question->save();

        foreach($request->options as $inputOption){
            $option = new Option;
            $option->question_id = $question->id;
            $option->title = $inputOption['title'];
            if($inputOption['is_correct'] === 'yes' || $inputOption['is_correct'] === null){
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
}
