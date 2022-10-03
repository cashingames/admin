<?php

namespace App\Http\Livewire\Modals;

use App\Models\Live\OddsRule;
use LivewireUI\Modal\ModalComponent;

class AddOddRule extends ModalComponent
{
    public $rule, $condition, $oddMultiplier, $operation;

    public function addOddRule()
    {
        $oddsRule = new OddsRule;
        $oddsRule->rule =  $this->rule;
        $oddsRule->display_name =  $this->condition;
        $oddsRule->odds_benefit =  $this->oddMultiplier;
        $oddsRule->odds_operation =  $this->operation;
        $oddsRule->save();

        return redirect()->to('/gaming/odds');
    
    }

    public function render()
    {
        return view('livewire.modals.add-odd-rule');
    }
}
