<?php

namespace App\Http\Livewire\Modals;

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
        $this->start_time = $this->trivia->start_time;
        $this->end_time = $this->trivia->end_time;
        $this->points_required = $this->trivia->point_eligibility;
        $this->subcategory = Category::where('id', $this->trivia->category_id)->first()->name;
    }

    public function editTrivia()
    {

        $category = Category::where('name', $this->subcategory)->first();

        $trivia = Trivia::find($this->trivia->id);
        $trivia->name = $this->name;
        $trivia->category_id = $category->id;
        $trivia->point_eligibility = $this->points_required;
        $trivia->game_duration = $this->game_duration;
        $trivia->question_count = $this->question_count;
        $trivia->grand_price = $this->grand_price;
        $trivia->start_time = Carbon::parse($this->start_time); 
        $trivia->end_time = Carbon::parse($this->end_time);

        $trivia->save();

        return redirect()->to('/gaming/trivia');
    }


    public function render()
    {
        return view('livewire.modals.edit-trivia');
    }
}
