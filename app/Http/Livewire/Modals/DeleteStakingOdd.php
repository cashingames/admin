<?php

namespace App\Http\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;
use App\Models\Live\StakingOdd;

class DeleteStakingOdd extends ModalComponent
{   
    public $stakingOddId;

    public function mount($id){
        $this->stakingOddId = $id ;
    }

    public function deleteStakingOdd(){
        StakingOdd::find($this->stakingOddId)->delete();
        return redirect()->to('/staking/odds');
    }

    public function render()
    {
        return view('livewire.modals.delete-staking-odd');
    }
}
