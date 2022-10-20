<?php

namespace App\Http\Livewire\Modals;

use App\Models\Live\StakingOddsRule;
use LivewireUI\Modal\ModalComponent;

class AddStakingOddRule extends ModalComponent
{
    public $rule, $condition, $oddMultiplier, $operation;

    public function addOddRule()
    {
        $stakingOddsRule = new StakingOddsRule;
        $stakingOddsRule->rule =  $this->rule;
        $stakingOddsRule->display_name =  $this->condition;
        $stakingOddsRule->odds_benefit =  $this->oddMultiplier;
        $stakingOddsRule->odds_operation =  $this->operation;
        $stakingOddsRule->save();

        return redirect()->to('/staking/odds');
    
    }

    public function render()
    {
        return view('livewire.modals.add-staking-odd-rule');
    }
}
