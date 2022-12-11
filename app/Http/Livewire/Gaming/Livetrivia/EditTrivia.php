<?php

namespace App\Http\Livewire\Gaming\Livetrivia;

use App\Models\Live\Category;
use App\Models\Live\Trivia;
use App\Models\Live\TriviaQuestion;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class EditTrivia extends Component
{
    public $trivia, $subcategories, $name, $grand_price, $points_required, $entry_fee, $triviaId;
    public $game_duration, $question_count, $start_time, $end_time, $subcategory, $questions;
    public $removedQuestion;

    public function mount()
    {
        $id = Route::current()->parameter('id');

        $this->triviaId = $id;
        $this->trivia = Trivia::find($this->triviaId);
        $this->subcategories = Category::where('category_id', '>', 0)->get();
        $this->name = $this->trivia->name;
        $this->grand_price = $this->trivia->grand_price;
        $this->entry_fee = $this->trivia->entry_fee;
        $this->questions = $this->getTriviaQuestions();
        $this->question_count = count($this->questions);
        $this->game_duration = $this->trivia->game_duration;
        $this->start_time = date("Y-m-d\TH:i:s", strtotime('+1 hour', strtotime($this->trivia->start_time)));
        $this->end_time = date("Y-m-d\TH:i:s", strtotime('+1 hour', strtotime($this->trivia->end_time)));
        $this->points_required = $this->trivia->point_eligibility;
        $this->subcategory = Category::where('id', $this->trivia->category_id)->first()->name;

       
        $this->removedQuestion = false;

        // dd($this->questions);
    }

    public function editTrivia()
    {
        $this->saveTrivia();
        return redirect()->to('/gaming/trivia');
    }

    private function toTimeZone(string $date, string $dateTimeZone, $toTimeZone): Carbon
    {
        $result = Carbon::createFromFormat('Y-m-d H:i:s', $date, $dateTimeZone);
        $result->setTimezone($toTimeZone);

        return $result;
    }

    private function getTriviaQuestions()
    {
        return DB::connection('mysqllive')->table('trivia_questions')
            ->join('questions', 'questions.id', 'trivia_questions.question_id')
            ->select('questions.label as question', 'questions.level as level', 'questions.id as id')
            ->where('trivia_questions.trivia_id', $this->triviaId)
            ->get();
    }

    private function saveTrivia()
    {
        $start = $this->toTimeZone(strval(Carbon::parse($this->start_time)), 'Africa/Lagos', 'UTC');
        $end = $this->toTimeZone(strval(Carbon::parse($this->end_time)), 'Africa/Lagos', 'UTC');

        $category = Category::where('name', $this->subcategory)->first();

        $trivia = Trivia::find($this->trivia->id);
        $trivia->name = $this->name;
        $trivia->category_id = $category->id;
        $trivia->point_eligibility = $this->points_required;
        $trivia->game_duration = $this->game_duration;
        $trivia->question_count = $this->question_count;
        $trivia->grand_price = $this->grand_price;
        $trivia->entry_fee = $this->entry_fee;
        $trivia->start_time = $start;
        $trivia->end_time = $end;

        if ($this->removedQuestion) {
            TriviaQuestion::where('trivia_id', $this->triviaId)->delete();

            foreach ($this->questions as $q) {
                TriviaQuestion::create([
                    'trivia_id' => $this->triviaId,
                    'question_id' => $q['id']
                ]);
            }
            $trivia->question_count = count($this->questions);
        }
        $trivia->save();
    }

    public function addMoreQuestions()
    {
        $this->saveTrivia();
        return redirect()->to('/gaming/trivia/select-questions/' . $this->triviaId);
    }

    public function removeQuestion($key)
    {
        $this->questions->forget($key);
        $this->questions = $this->questions->all();
        $this->removedQuestion = true;
    }

    public function removeMoreQuestions($key)
    {
        unset($this->questions[$key]);
        $this->questions = array_values($this->questions);
    }

    public function render()
    {
        return view('livewire.gaming.edit-trivia', ['questions' => $this->questions]);
    }
}
