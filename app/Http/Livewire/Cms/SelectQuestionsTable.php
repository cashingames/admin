<?php

namespace App\Http\Livewire\Cms;

use App\Models\Live\Question;
use App\Models\Live\TriviaQuestion;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Route;

class SelectQuestionsTable extends Component
{
    use WithPagination;
    public $search = '';
    public $perPage = 100;
    public $sortField = 'id';
    public $sortAsc = true;
    public $selected;
    public $checked;
    public $triviaId = null;
    public $updatingTrivia = false;

    public function mount()
    {   
       
        $this->selected = [];
        $this->checked = false;
        $this->triviaId = Route::current()->parameter('id');
      
        if(!is_null( $this->triviaId)){
            $this->updatingTrivia = true;
        }else{
            $this->updatingTrivia = false;
        }
    }

    public function addToSelectedQuestions($value)
    {   
            if (count(array_keys($this->selected, $value)) == 0) {
                return array_push($this->selected, $value);
            }
            $key = array_search($value, $this->selected);
            unset($this->selected[$key]);
            $this->selected = array_values($this->selected);
            return;

    }

    public function saveSelectedQuestions()
    {
        $this->emit('questionsSelected', $this->selected);
    }

    public function render()
    {
        return view('livewire.cms.select-questions-table', [
            'questions' => Question::search($this->search)
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->simplePaginate($this->perPage),
        ]);
    }
}
