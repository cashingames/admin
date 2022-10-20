<?php

namespace App\Http\Livewire\Modals;

use App\Models\Live\StakingOddsRule;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditStakingOddsConditions extends ModalComponent
{   
    public $rule, $condition, $oddMultiplier, $oddsRule, $operation;

    public function mount($id)
    {
        $this->oddsRule = StakingOddsRule::find($id);
        $this->rule =  $this->oddsRule->rule;
        $this->condition =  $this->oddsRule->display_name;
        $this->oddMultiplier = $this->oddsRule->odds_benefit;
        $this->operation = $this->oddsRule->odds_operation;
    }

    public function editOddMultiplier()
    {
        $oddsRule = StakingOddsRule::find($this->oddsRule->id);
        $oddsRule->odds_benefit =  $this->oddMultiplier;
        $oddsRule->odds_operation =  $this->operation;
        $oddsRule->save();

        return redirect()->to('/staking/odds');
    }

    public function render()
    {
        return view('livewire.modals.edit-staking-odds-conditions');
    }
}
