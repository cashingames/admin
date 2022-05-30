<?php

namespace App\Http\Livewire\Cms;

use App\Models\Live\Question;
use Livewire\Component;
use Livewire\WithPagination;

class SelectQuestionsTable extends Component
{
    use WithPagination;
    public $search = '';
    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = true;
    public $selected;
    public $checked;

    public function mount()
    {
        $this->selected = [];
        $this->checked = false;
    }

    public function addToSelectedQuestions($value)
    {   
            if (count(array_keys($this->selected, $value)) == 0) {
                array_push($this->selected, $value);
            }

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
