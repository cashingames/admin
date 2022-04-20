<?php

namespace App\Http\Livewire\Finance;
use App\Models\Live\WalletTransaction;

use Livewire\Component;
use App\Models\Live\Plan;
use App\Models\Live\UserPlan;
use App\Models\Live\UserBoost;
use Illuminate\Support\Carbon;

class Reports extends Component
{   
    public $startDate, $endDate, $freePlan;
    public $boughtGamesFunds, $boughtBoostsFunds;

    public function mount(){
        $this->freePlan = Plan::where('is_free',true)->first();
        
        //get total amount of games without filter
        $gamePriceSum = 0;
        $userPlans = UserPlan::where('plan_id','>',$this->freePlan->id)->get() ;
        foreach($userPlans as $_plan){
            $gamePriceSum +=  $_plan->plan->price;
        }
        
        $this->boughtGamesFunds =  $gamePriceSum; 
        
        //get amount of boosts without filter
        $boostPriceSum = 0;
        $userBoosts = UserBoost::all();

        foreach($userBoosts as $b){
            $boostPriceSum +=  ($b->boost->currency_value * $b->boost->pack_count );
        }
        
        $this->boughtBoostsFunds =  $boostPriceSum; 

    }

    public function filterReports()
    {
        $this->getTotalGamesAmount();
        $this->getTotalBoostsAmount();
    }

    private function getTotalGamesAmount(){
        $_startDate = Carbon::parse($this->startDate) ;
        $_endDate = Carbon::parse($this->endDate) ;

        $gamesPriceSum = 0;
        $userPlan = UserPlan::where('plan_id','>',$this->freePlan->id)
                    ->where('created_at','>=',$_startDate)
                    ->where('created_at','<', $_endDate)
                    ->get() ;

        foreach($userPlan as $_plan){
            $gamesPriceSum +=  $_plan->plan->price;
        }
        
        $this->boughtGamesFunds =  $gamesPriceSum; 
    }

    private function getTotalBoostsAmount(){
        $_startDate = Carbon::parse($this->startDate) ;
        $_endDate = Carbon::parse($this->endDate) ;

        $boostPriceSum = 0;
        $userBoosts = UserBoost::where('created_at','>=',$_startDate)
                    ->where('created_at','<', $_endDate)
                    ->get() ;
                    
        foreach($userBoosts as $b){
            $boostPriceSum +=  ($b->boost->currency_value * $b->boost->pack_count );
        }
        
        $this->boughtBoostsFunds =  $boostPriceSum; 
    }


    public function render()
    {
        return view('livewire.finance.reports');
    }
}
