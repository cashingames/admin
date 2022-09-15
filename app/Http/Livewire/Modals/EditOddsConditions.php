<?php

namespace App\Http\Livewire\Modals;

use App\Models\Live\OddsConditionAndRule;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditOddsConditions extends ModalComponent
{   
    public $rule, $condition, $oddMultiplier, $oddsConditionAndRule;

    public function mount($id)
    {
        $this->oddsConditionAndRule = OddsConditionAndRule::find($id);
        $this->rule =  $this->oddsConditionAndRule->rule;
        $this->condition =  $this->oddsConditionAndRule->condition;
        $this->oddMultiplier = $this->oddsConditionAndRule->odds_benefit;
    }

    public function editOddMultiplier()
    {
        $oddsConditionAndRule = OddsConditionAndRule::find($this->oddsConditionAndRule->id);
        $oddsConditionAndRule->odds_benefit =  $this->oddMultiplier;
    
        $oddsConditionAndRule->save();

        return redirect()->to('/gaming/odds');
    }

    public function render()
    {
        return view('livewire.modals.edit-odds-conditions');
    }
}
