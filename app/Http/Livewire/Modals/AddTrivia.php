<?php

namespace App\Http\Livewire\Modals;

use App\Models\Live\Trivia;
use App\Models\Live\Category;
use App\Models\Live\Question;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;

use LivewireUI\Modal\ModalComponent;


class AddTrivia extends ModalComponent
{

    public $trivia, $subcategories, $name, $grand_price, $points_required, $questions ;
    public $game_duration, $question_count, $start_time, $end_time, $subcategory, $selectedQuestion;
    public $canChooseQuestions = false;
    public $notifyError = false;
    public $selectedQuestions = [];

    public function mount()
    {   
        $this->value = 2;
        $this->subcategories = Category::where('category_id', '>', 0)->get();
    }

    public function addTrivia()
    {
        $response = Http::acceptJson()->post(config('app.api_url') . '/v3/trivia/create', [
            'name' => $this->name,
            'category' => $this->subcategory,
            'grand_price' => $this->grand_price,
            'point_eligibility' => $this->points_required,
            'start_time' => strval(Carbon::parse($this->start_time)),
            'end_time' => strval(Carbon::parse($this->end_time)),
            'game_duration' => $this->game_duration,
            'question_count' => $this->question_count
        ]);


        if ($response->successful()) {
            return redirect()->to('/gaming/trivia');
        }
        if ($response->failed()) {
            $response->throw();
        }
    }

    public function updatedSubcategory()
    {
        if( $this->notifyError ){
            $this->notifyError = false;
        }
    }

    public function toggleCanChooseQuestions()
    {   
        if ($this->canChooseQuestions) {
            $this->canChooseQuestions = false;
        } else {
            $category = Category::where('name', $this->subcategory)->first();
            if($category === null){
                $this->notifyError = true;
                $this->canChooseQuestions = false;
            }else{
                $this->canChooseQuestions = true;
                $this->notifyError = false;
                $this->questions = Question::where('category_id', $category->id)
                ->inRandomOrder()->limit(100)->get();
            }
        }
    }

    public function addToSelectedQuestions()
    {
        array_push($this->selectedQuestions, $this->selectedQuestion);
    }

    public function removeFromSelectedQuestions($value)
    {   
    
        $key = array_search($value, $this->selectedQuestions, true);
        if ($key !== false) {
            array_splice($this->selectedQuestions, $key, 1);
        }
    }


    public function render()
    {
        return view('livewire.modals.add-trivia');
    }
}
