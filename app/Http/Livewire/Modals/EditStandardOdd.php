<?php

namespace App\Http\Livewire\Modals;

use App\Models\Live\StandardOdd;
use LivewireUI\Modal\ModalComponent;

class EditStandardOdd extends ModalComponent
{   
    public $score, $odd, $standardOdd;

    public function mount($id)
    {
        $this->standardOdd =  StandardOdd::find($id);
        $this->score =  $this->standardOdd->score;
        $this->odd =  $this->standardOdd->odd;

    }

    public function editStandardOdd()
    {
        $standardOdd = StandardOdd::find($this->standardOdd->id);
        $standardOdd->odd =  $this->odd;
    
        $standardOdd->save();

        return redirect()->to('/gaming/odds');
    }
    
    public function render()
    {
        return view('livewire.modals.edit-standard-odd');
    }
}
