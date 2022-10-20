<?php

namespace App\Http\Livewire\Modals\Livetrivia;

use App\Models\Live\Category;
use App\Models\Live\Trivia;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Carbon;

class EditTrivia extends ModalComponent
{
    public $trivia, $subcategories, $name, $grand_price, $points_required;
    public $game_duration,$question_count,$start_time,$end_time,$subcategory;

    public function mount($id)
    {
        $this->trivia = Trivia::find($id);
        $this->subcategories = Category::where('category_id', '>', 0)->get();
        $this->name = $this->trivia->name;
        $this->grand_price = $this->trivia->grand_price;
        $this->question_count = $this->trivia->question_count;
        $this->game_duration = $this->trivia->game_duration;
        $this->start_time =date("Y-m-d\TH:i:s", strtotime('+1 hour',strtotime($this->trivia->start_time))); 
        $this->end_time =date("Y-m-d\TH:i:s", strtotime('+1 hour',strtotime($this->trivia->end_time))); 
        $this->points_required = $this->trivia->point_eligibility;
        $this->subcategory = Category::where('id', $this->trivia->category_id)->first()->name;
    }

    public function editTrivia()
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
        $trivia->start_time = $start; 
        $trivia->end_time = $end;

        $trivia->save();

        return redirect()->to('/gaming/trivia');
    }

    private function toTimeZone(string $date, string $dateTimeZone, $toTimeZone): Carbon
    {
        $result = Carbon::createFromFormat('Y-m-d H:i:s', $date, $dateTimeZone);
        $result->setTimezone($toTimeZone);

        return $result;
    }

    public function render()
    {
        return view('livewire.modals.edit-trivia');
    }
}
