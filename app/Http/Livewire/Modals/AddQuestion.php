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
    //to handle options,
    //create a variable as an array here tag it as wire model to option div in blade
    //create another wire model and tag it to the add button in blade
    //on click of add option, call a function here that adds the value(wire model say new option title, new option iscorrect) of the input 
    //to the array here
    //on submit, the options here is what is submitted
    //the options div in the blade will show the list of the array from here

    public $subcategories , $gameTypes;
    public $questionOptions = array();
    public $newOptionTitle, $newOptionIsCorrect;

    public function mount()
    {  
        $this->subcategories = Category::where('category_id' ,'>', 0)->get();
        $this->gameTypes = GameType::all();
    }

    public function addOption()
    {   
        // $data[$key] = $value;
        // $this->questionOptions = array_merge($this->questionOptions, ['title' => $this->newOptionTitle]);
        // $this->questionOptions = array_merge($this->questionOptions, ['is_correct' => $this->newOptionIsCorrect]);
        $this->questionOptions['title'] = $this->newOptionTitle;
        $this->questionOptions['is_correct'] = $this->newOptionIsCorrect;
       
    }

    public function render()
    {
        return view('livewire.modals.add-question');
    }
}
