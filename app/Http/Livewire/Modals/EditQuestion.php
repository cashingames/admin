<?php

namespace App\Http\Livewire\Modals;

use App\Models\Live\Question;
use App\Models\Live\Category;
use LivewireUI\Modal\ModalComponent;

class EditQuestion extends ModalComponent
{   
    public $question;
    public $subcategories;

    public function mount($question)
    {  
        $this->question = Question::find($question);
        $this->subcategories = Category::where('category_id' ,'>', 0)->get();
    }

    public function render()
    {
        return view('livewire.modals.edit-question');
    }
}
