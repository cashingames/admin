<?php

namespace App\Http\Livewire\Modals;

use App\Models\Live\StakingOdd;
use LivewireUI\Modal\ModalComponent;

class AddStakingOdd extends ModalComponent
{
    public $score, $odd , $active;

    public function addStakingOdd()
    {
        $stakingOdd = new StakingOdd;
        $stakingOdd->score =  $this->score;
        $stakingOdd->odd =  $this->odd;
        $stakingOdd->active = $this->active=="on"?true :false;
        $stakingOdd->save();

        return redirect()->to('/gaming/odds');
    
    }

    public function render()
    {
        return view('livewire.modals.add-staking-odd');
    }
}
