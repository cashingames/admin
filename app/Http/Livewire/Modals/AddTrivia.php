<?php

namespace App\Http\Livewire\Modals;

use App\Models\Live\Trivia;
use App\Models\Live\TriviaQuestion;
use App\Models\Live\Category;
use App\Models\Live\Question;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;

use LivewireUI\Modal\ModalComponent;


class AddTrivia extends ModalComponent
{

    public $trivia, $subcategories, $name, $grand_price, $points_required, $questions, $searchKeyword;
    public $game_duration, $question_count, $start_time, $end_time, $subcategory, $selectedQuestion;
    public $canChooseQuestions = false;
    public $hasSearchedQuestion = false;
    public $notifyError = false;
    public $selectedQuestions = [];

    public function mount()
    {
        $this->value = 2;
        $this->subcategories = Category::where('category_id', '>', 0)->get();
    }

    public function addTrivia()
    {
        $category = Category::where('name', $this->subcategory)->first();

        $trivia = new Trivia;
        $trivia->name =  $this->name;
        $trivia->grand_price =  $this->grand_price;
        $trivia->point_eligibility = $this->points_required;
        $trivia->category_id = $category->id;
        $trivia->game_mode_id = 1;
        $trivia->game_type_id = 2;
        $trivia->start_time = strval(Carbon::parse($this->start_time));
        $trivia->end_time = strval(Carbon::parse($this->end_time));
        $trivia->is_published = false;
        $trivia->game_duration = $this->game_duration;
        $trivia->question_count = $this->question_count;

        if (count($this->selectedQuestions) > 0) {
            $triviaQuestions = new TriviaQuestion;
            //to do : selected questions should be an array both id and label . display only the label to the front end
            //addToSelectedQuestions function should take parameters id and label
        } else {
            $questions = $trivia->category->questions()
                ->whereNull('deleted_at')
                ->where('is_published', true)->inRandomOrder()->take($this->question_count + 10)->get();

            foreach ($questions as $q) {
                TriviaQuestion::create([
                    'trivia_id' => $trivia->id,
                    'question_id' => $q->id
                ]);
            }
        }
        $trivia->save();

        // $response = Http::acceptJson()->post(config('app.api_url') . '/v3/trivia/create', [
        //     'name' => $this->name,
        //     'category' => $this->subcategory,
        //     'grand_price' => $this->grand_price,
        //     'point_eligibility' => $this->points_required,
        //     'start_time' => strval(Carbon::parse($this->start_time)),
        //     'end_time' => strval(Carbon::parse($this->end_time)),
        //     'game_duration' => $this->game_duration,
        //     'question_count' => $this->question_count
        // ]);


        // if ($response->successful()) {
        //     return redirect()->to('/gaming/trivia');
        // }
        // if ($response->failed()) {
        //     $response->throw();
        // }
    }

    public function updatedSubcategory()
    {
        if ($this->notifyError) {
            $this->notifyError = false;
        }
    }

    public function toggleCanChooseQuestions()
    {
        if ($this->canChooseQuestions) {
            $this->canChooseQuestions = false;
        } else {
            $category = Category::where('name', $this->subcategory)->first();
            if ($category === null) {
                $this->notifyError = true;
                $this->canChooseQuestions = false;
            } else {
                $this->canChooseQuestions = true;
                $this->notifyError = false;
            }
        }
    }

    public function fetchQuestions()
    {
        $category = Category::where('name', $this->subcategory)->first();
        $this->questions = Question::select('id','label')->where('category_id', $category->id)
            ->where('label', 'LIKE', '%' . $this->searchKeyword . '%')->inRandomOrder()->limit(500)->get();

        $this->hasSearchedQuestion = true;
    }

    public function addToSelectedQuestions()
    {
        array_push($this->selectedQuestions, $this->selectedQuestion);
    }

    public function removeFromSelectedQuestions($index)
    {
        unset($this->selectedQuestions[$index]);
    }

    public function render()
    {
        return view('livewire.modals.add-trivia');
    }
}
