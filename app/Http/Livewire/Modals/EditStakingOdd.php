<?php

namespace App\Http\Livewire\Modals;

use App\Models\Live\StakingOdd;
use LivewireUI\Modal\ModalComponent;

class EditStakingOdd extends ModalComponent
{   
    public $score, $odd, $stakingOdd, $active;

    public function mount($id)
    {
        $this->stakingOdd =  StakingOdd::find($id);
        $this->score =  $this->stakingOdd->score;
        $this->odd =  $this->stakingOdd->odd;
        $this->active = $this->stakingOdd->active;
    }

    public function editStakingOdd()
    {
        $stakingOdd = StakingOdd::find($this->stakingOdd->id);
        $stakingOdd->odd =  $this->odd;
        $stakingOdd->score =  $this->score;
        $stakingOdd->active = $this->active=="true"?true :false;
        $stakingOdd->save();

        return redirect()->to('/staking/odds');
    }
    
    public function render()
    {
        return view('livewire.modals.edit-staking-odd');
    }
}
