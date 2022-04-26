<?php

namespace App\Http\Livewire\Finance;

use Livewire\Component;
use App\Models\Live\Plan;
use App\Models\Live\UserPlan;
use App\Models\Live\UserBoost;
use App\Models\Live\WalletTransaction;
use Illuminate\Support\Carbon;

class Reports extends Component
{   
    public $startDate, $endDate;
    public $boughtGamesFunds, $boughtBoostsFunds, $totalWalletDeposit;

    public function mount(){
        $freePlan = Plan::where('is_free',true)->first();
        
        //get total amount of games without filter
        $gamePriceSum = 0;
        $userPlans = UserPlan::where('plan_id','>',$freePlan->id)->get() ;
        foreach($userPlans as $_plan){
            if($_plan->plan !== null){
                $gamePriceSum +=  $_plan->plan->price;
            }
            
        }
        
        $this->boughtGamesFunds =  $gamePriceSum; 
        
        //get amount of boosts without filter
        $boostPriceSum = 0;
        $userBoosts = UserBoost::all();

        foreach($userBoosts as $b){
            if($b->boost !== null){
                $boostPriceSum +=  ($b->boost->currency_value * $b->boost->pack_count );
            }
        }
        
        $this->boughtBoostsFunds =  $boostPriceSum; 

        //total wallet deposit
        $this->totalWalletDeposit = WalletTransaction::where('transaction_type', "CREDIT")->sum('amount');

    }


    private function getTotalGamesAmount(){
        $_startDate = Carbon::parse($this->startDate) ;
        $_endDate = Carbon::parse($this->endDate) ;

        $gamesPriceSum = 0;
        $freePlan = Plan::where('is_free',true)->first();
        $userPlan = UserPlan::where('plan_id','>',$freePlan->id)
                    ->where('created_at','>=',$_startDate)
                    ->where('created_at','<', $_endDate)
                    ->get() ;

        foreach($userPlan as $_plan){
            if($_plan->plan !== null){
                $gamesPriceSum +=  $_plan->plan->price;
            }
           
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
            if($b->boost !== null){
                $boostPriceSum +=  ($b->boost->currency_value * $b->boost->pack_count );
            };
            
        }
        
        $this->boughtBoostsFunds =  $boostPriceSum; 
    }

    private function getTotalWalletDeopsit(){
        $_startDate = Carbon::parse($this->startDate) ;
        $_endDate = Carbon::parse($this->endDate) ;

        $this->totalWalletDeposit = WalletTransaction::where('transaction_type', "CREDIT")
                                    ->where('created_at','>=',$_startDate)
                                    ->where('created_at','<', $_endDate)
                                    ->sum('amount');
    }
    
    public function filterReports()
    {   
        $this->getTotalWalletDeopsit();
        $this->getTotalGamesAmount();
        $this->getTotalBoostsAmount();
      
    }

    public function render()
    {
        return view('livewire.finance.reports');
    }
}
