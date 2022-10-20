<?php

namespace App\Http\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;
use App\Models\Live\StakingOddsRule;

class DeleteStakingOddRule extends ModalComponent
{   
    public $oddRuleId;

    public function mount($id){
        $this->oddRuleId = $id ;
    }

    public function deleteOddRule(){
      StakingOddsRule::find($this->oddRuleId)->delete();
        return redirect()->to('/staking/odds');
    }

    public function render()
    {
        return view('livewire.modals.delete-staking-odd-rule');
    }
}
