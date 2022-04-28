<?php

namespace App\Http\Livewire\Modals;

use App\Models\Live\Category;
use App\Models\Live\Trivia;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EditTrivia extends ModalComponent
{
    public $trivia, $subcategories;

    public function mount($id)
    {
        $this->trivia = Trivia::find($id);
        $this->subcategories = Category::where('category_id', '>', 0)->get();
    }

    public function editTrivia(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'grand_price' => 'required',
            'points_required' => 'required',
            'game_duration' => 'required',
            'question_count' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'subcategory' => 'required'

        ]);
        if ($validator->fails()) {
            return redirect()->to('/gaming/trivia')->withErrors($validator);
        }

        $category = Category::where('name', $request->subcategory)->first();

        $trivia = Trivia::find($this->trivia->id);
        $trivia->name = $request->name;
        $trivia->category = $category->id;
        $trivia->point_eligibility = $request->points_required;
        $trivia->game_duration = $request->game_duration;
        $trivia->question_count = $request->question_count;
        $trivia->grand_price = $request->grand_price;
        $trivia->start_time = $request->start_time;
        $trivia->end_time = $request->end_time;

        $trivia->save();

        return redirect()->to('/gaming/trivia');
    }


    public function render()
    {
        return view('livewire.modals.edit-trivia');
    }
}
