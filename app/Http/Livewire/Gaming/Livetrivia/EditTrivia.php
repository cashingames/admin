<?php

namespace App\Http\Livewire\Gaming\Livetrivia;

use App\Models\Live\Category;
use App\Models\Live\ContestPrizePool;
use App\Models\Live\Trivia;
use App\Models\Live\TriviaQuestion;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Enums\Contest\EntryMode;
use App\Enums\Contest\PrizeType;
use App\Models\Live\Contest;

class EditTrivia extends Component
{
    public $trivia, $subcategories, $name, $grand_price, $points_required, $entry_fee, $triviaId;
    public $game_duration, $question_count, $start_time, $end_time, $subcategory, $questions;
    public $upDated, $removedQuestion,  $numberOfWinners, $description, $entry_mode, $prize_type, $prize_multiplier;
    public $prizePool, $entryModes, $prizeTypes;

    public function mount()
    {
        $id = Route::current()->parameter('id');

        $this->triviaId = $id;
        $this->trivia = Trivia::find($this->triviaId);
        $this->subcategories = Category::where('category_id', '>', 0)->get();
        $this->name = $this->trivia->name;
        $this->grand_price = $this->trivia->grand_price;
        $this->entry_fee = $this->trivia->entry_fee;
        $this->prize_multiplier = $this->trivia->prize_multiplier;
        $this->entry_mode = $this->trivia->contest->entry_mode;
        $this->description = $this->trivia->contest->description;
        $this->prize_type = $this->trivia->contest->prize_type;
        $this->questions = $this->getTriviaQuestions();
        $this->prizePool = $this->getPrizePool()->toArray();
        $this->question_count = count($this->questions);
        $this->game_duration = $this->trivia->game_duration;
        $this->start_time = date("Y-m-d\TH:i:s", strtotime('+1 hour', strtotime($this->trivia->start_time)));
        $this->end_time = date("Y-m-d\TH:i:s", strtotime('+1 hour', strtotime($this->trivia->end_time)));
        $this->points_required = $this->trivia->point_eligibility;
        $this->subcategory = Category::where('id', $this->trivia->category_id)->first()->name;
        $this->numberOfWinners = count($this->prizePool);

        $this->questions = $this->questions->toArray();
        $this->entryModes = array_column(EntryMode::cases(), 'value');
        $this->prizeTypes = array_column(PrizeType::cases(), 'value');
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
        return TriviaQuestion::join('questions', 'questions.id', 'trivia_questions.question_id')
            ->select('questions.label as question', 'questions.level as level', 'questions.id as id')
            ->where('trivia_questions.trivia_id', $this->triviaId)
            ->get();
    }

    private function getPrizePool()
    {
        return ContestPrizePool::select('id', 'rank_from', 'rank_to', 'prize', 'each_prize', 'net_prize')
            ->where('contest_id', $this->trivia->contest_id)->get();
    }

    private function saveTrivia()
    {
        $start = $this->toTimeZone(strval(Carbon::parse($this->start_time)), 'Africa/Lagos', 'UTC');
        $end = $this->toTimeZone(strval(Carbon::parse($this->end_time)), 'Africa/Lagos', 'UTC');

        $category = Category::where('name', $this->subcategory)->first();

        $trivia = $this->trivia;
        $trivia->name = $this->name;
        $trivia->category_id = $category->id;
        $trivia->point_eligibility = $this->points_required;
        $trivia->game_duration = $this->game_duration;
        $trivia->question_count = $this->question_count;
        $trivia->grand_price = $this->grand_price;
        $trivia->entry_fee = $this->entry_fee;
        $trivia->start_time = $start;
        $trivia->end_time = $end;
        $trivia->prize_multiplier = $this->prize_multiplier;

        $trivia->contest->entry_mode = $this->entry_mode;
        $trivia->contest->prize_type = $this->prize_type;
        $trivia->contest->description = $this->description;

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
        $trivia->contest->save();
        $trivia->save();

        DB::transaction(function () use ($trivia) {
            foreach ($this->prizePool as $value) {
                $trivia->contest->contestPrizePools()->where('id', $value['id'])->update([
                    'rank_from' => $value['rank_from'],
                    'rank_to' => $value['rank_to'],
                    'prize' => $value['prize'],
                    'each_prize' => $value['each_prize'],
                    'net_prize' => $value['net_prize']
                ]);
            }
        });
    }

    public function addMoreQuestions()
    {
        $this->saveTrivia();
        return redirect()->to('/gaming/trivia/select-questions/' . $this->triviaId);
    }

    public function updated()
    {
        $this->upDated = true;
    }

    public function removeMoreQuestions($key)
    {
        unset($this->questions[$key]);
        $this->questions = array_values($this->questions);
        $this->removedQuestion = true;
    }

    public function render()
    {
        $this->upDated = false;
        return view('livewire.gaming.edit-trivia', ['questions' => $this->questions]);
    }
}
