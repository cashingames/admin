<?php

namespace App\Http\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;
use App\Models\Live\OddsRule;

class DeleteOddRule extends ModalComponent
{   
    public $oddRuleId;

    public function mount($id){
        $this->oddRuleId = $id ;
    }

    public function deleteOddRule(){
      OddsRule::find($this->oddRuleId)->delete();
        return redirect()->to('/gaming/odds');
    }

    public function render()
    {
        return view('livewire.modals.delete-odd-rule');
    }
}
