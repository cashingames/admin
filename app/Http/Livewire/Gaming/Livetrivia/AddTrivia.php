<?php

namespace App\Http\Livewire\Gaming\Livetrivia;

use App\Enums\Contest\ContestType;
use App\Enums\Contest\EntryMode;
use App\Enums\Contest\PrizeType;
use Livewire\Component;
use App\Models\Live\Trivia;
use App\Models\Live\TriviaQuestion;
use App\Models\Live\Category;
use App\Models\Live\Contest;
use App\Models\Live\ContestPrizePool;
use App\Models\Live\Question;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AddTrivia extends Component
{

    public $trivia, $subcategories, $name, $grand_price, $points_required, $entry_fee;
    public $game_duration, $question_count, $start_time, $end_time, $subcategory, $selectedQuestion;
    public $entryMode, $entryModes, $prizeTypes, $prizeDetails;
    public $description, $displayName, $numberOfWinners;
    public $canChooseQuestions = false;
    public $selectedQuestions = [];
    protected $listeners = ['questionsSelected' => 'setSelectedQuestions'];
    public $error = '';

    public function mount()
    {
        $this->name = '';
        $this->points_required = 0;
        $this->question_count = 10;
        $this->start_time = Carbon::now()->addMinutes(30);
        $this->end_time =  Carbon::now()->addMinutes(35);
        $this->grand_price = 0;
        $this->game_duration = 60;
        $this->entry_fee = 0;
        $this->subcategory = 'Premier League Clubs';
        $this->subcategories = Category::where('category_id', '>', 0)->get();
        $this->entryModes = array_column(EntryMode::cases(), 'value');
        $this->numberOfWinners = 3;
        $this->prizeTypes = array_column(PrizeType::cases(), 'value');
        $this->prizeDetails = [];
    }


    public function updated()
    {
        $this->error = '';
    }

    public function setSelectedQuestions($value)
    {
        $this->selectedQuestions = $value;
        $this->addTrivia();
    }

    public function addTrivia()
    {
        // dd($this->prizeDetails);

        $category = Category::where('name', $this->subcategory)->first();
        $start = $this->toTimeZone(strval(Carbon::parse($this->start_time)), 'Africa/Lagos', 'UTC');
        $end = $this->toTimeZone(strval(Carbon::parse($this->end_time)), 'Africa/Lagos', 'UTC');

        if ($end  <= $start) {
            $this->error = 'End date must be after start date';
            return;
        }

        if ($this->name == '') {
            $this->error = 'Trivia name is required';
            return;
        }

        if (count($this->selectedQuestions) > 0  && count($this->selectedQuestions) < ($this->question_count)) {
            $this->error = 'Selected Questions must not be less than ' . $this->question_count;
            return;
        }

        if(empty($this->prizeDetails)){
            $this->error = 'All Prize Details Fields Are required ';
            return;
        }

        foreach ($this->prizeDetails as $value) {
            if(count($value) < 6){
                $this->error = 'All Prize Details Fields Are required ';
                return;
            }
        }

        $contest = new Contest;
        $contest->start_date = $start;
        $contest->end_date = $end;
        $contest->name = $this->name;
        $contest->description = is_null($this->description) ? $this->name : $this->description;
        $contest->display_name = $this->name;
        $contest->contest_type = ContestType::Livetrivia;
        $contest->entry_mode = $this->entryMode;
        $contest->save();

        $trivia = new Trivia;
        $trivia->name =  $this->name;
        $trivia->grand_price =  $this->grand_price;
        $trivia->entry_fee =  $this->entry_fee;
        $trivia->point_eligibility = $this->points_required;
        $trivia->category_id = $category->id;
        $trivia->game_mode_id = 1;
        $trivia->game_type_id = 2;
        $trivia->start_time = $start;
        $trivia->end_time = $end;
        $trivia->is_published = false;
        $trivia->game_duration = $this->game_duration;
        $trivia->question_count = $this->question_count;
        $trivia->contest_id = $contest->id;
        $trivia->save();

        if (count($this->selectedQuestions) > 0) {
            foreach ($this->selectedQuestions as $q) {
                TriviaQuestion::create([
                    'trivia_id' => $trivia->id,
                    'question_id' => $q
                ]);
            }
        } else {

            $questions = Category::find($trivia->category_id)->questions()
                ->whereNull('deleted_at')
                ->where('is_published', true)->inRandomOrder()->take($this->question_count + 10)->get();

            foreach ($questions as $q) {
                TriviaQuestion::create([
                    'trivia_id' => $trivia->id,
                    'question_id' => $q->id
                ]);
            }
        }

        $data = [];

        foreach ($this->prizeDetails as $value) {
            $data[] = [
                'contest_id' => $contest->id,
                'rank_from' => $value['rankFrom'],
                'rank_to' => $value['rankTo'],
                'prize' => $value['prize']  ,
                'prize_type' => $value['prizeType'],
                'each_prize' => $value['eachPrize'] ,
                'net_prize' => $value['netPrize'] 
            ];
        }
        ContestPrizePool::insert($data);

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
