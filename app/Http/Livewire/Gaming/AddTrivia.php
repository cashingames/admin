<?php

namespace App\Http\Livewire\Gaming;

use Livewire\Component;
use App\Models\Live\Trivia;
use App\Models\Live\TriviaQuestion;
use App\Models\Live\Category;
use App\Models\Live\Question;

use Illuminate\Support\Carbon;

class AddTrivia extends Component
{

    public $trivia, $subcategories, $name, $grand_price, $points_required;
    public $game_duration, $question_count, $start_time, $end_time, $subcategory, $selectedQuestion;
    public $canChooseQuestions = false;
    public $selectedQuestions = [];
    protected $listeners = ['questionsSelected' => 'setSelectedQuestions'];

    public function mount()
    {   
        $this->name = '';
        $this->points_required = 0;
        $this->question_count = 10;
        $this->start_time = Carbon::now()->addMinutes(30);
        $this->end_time =  Carbon::now()->addMinutes(35) ;
        $this->grand_price= 0;
        $this->game_duration= 60;
        $this->subcategory = 'Premier League Clubs';
        $this->subcategories = Category::where('category_id', '>', 0)->get();
    }

    public function setSelectedQuestions($value)
    {
        $this->selectedQuestions = $value;
        $this->addTrivia();
    }

    public function addTrivia()
    {
        $category = Category::where('name', $this->subcategory)->first();
        $start = $this->toTimeZone(strval(Carbon::parse($this->start_time)), 'Africa/Lagos', 'UTC');
        $end = $this->toTimeZone(strval(Carbon::parse($this->end_time)), 'Africa/Lagos', 'UTC');

        $trivia = new Trivia;
        $trivia->name =  $this->name;
        $trivia->grand_price =  $this->grand_price;
        $trivia->point_eligibility = $this->points_required;
        $trivia->category_id = $category->id;
        $trivia->game_mode_id = 1;
        $trivia->game_type_id = 2;
        $trivia->start_time = $start;
        $trivia->end_time = $end;
        $trivia->is_published = false;
        $trivia->game_duration = $this->game_duration;
        $trivia->question_count = $this->question_count;
        $trivia->save();

        if (count($this->selectedQuestions) > 0) {
            if(count($this->selectedQuestions) <= ($this->question_count)){
                $questions = $trivia->category->questions()
                ->whereNull('deleted_at')
                ->where('is_published', true)->inRandomOrder()->take(10)->get();
                
                foreach ($questions as $q) {
                    TriviaQuestion::create([
                        'trivia_id' => $trivia->id,
                        'question_id' => $q->id
                    ]);
                }
            }
            foreach ($this->selectedQuestions as $q) {
                TriviaQuestion::create([
                    'trivia_id' => $trivia->id,
                    'question_id' => $q
                ]);
            }
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

        return redirect()->to('/gaming/trivia');
    }

    public function toggleCanChooseQuestions()
    {
        if ($this->canChooseQuestions) {
            $this->canChooseQuestions = false;
        } else {
                $this->canChooseQuestions = true;
        }
    }

    private function toTimeZone(string $date, string $dateTimeZone, $toTimeZone): Carbon
    {
        $result = Carbon::createFromFormat('Y-m-d H:i:s', $date, $dateTimeZone);
        $result->setTimezone($toTimeZone);

        return $result;
    }

    public function render()
    {
        return view('livewire.gaming.add-trivia');
    }
}
