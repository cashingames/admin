<?php

namespace App\Http\Livewire\Modals;
use App\Models\Live\Trivia;
use App\Models\Live\Category;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;

use LivewireUI\Modal\ModalComponent;


class AddTrivia extends ModalComponent
{

    public $trivia, $subcategories, $name, $grand_price, $points_required;
    public $game_duration,$question_count,$start_time,$end_time,$subcategory;
   
    public function mount()
    {  
        $this->subcategories = Category::where('category_id' ,'>', 0)->get();
    }

    public function addTrivia()
    {  
        $response = Http::acceptJson()->post(config('app.api_url').'/v3/trivia/create', [
            'name' => $this->name,
            'category' => $this->subcategory,
            'grand_price' => $this->grand_price,
            'point_eligibility' => $this->points_required,
            'start_time' => strval(Carbon::parse($this->start_time)),
            'end_time' => strval(Carbon::parse($this->end_time)),
            'game_duration' => $this->game_duration,
            'question_count' => $this->question_count
        ]);
      

        if($response->successful()){
            return redirect()->to('/gaming/trivia');
     
        }
        if($response->failed()){
            $response->throw();
        }
       
    }

    public function render()
    {
        return view('livewire.modals.add-trivia');
    }

 
}
