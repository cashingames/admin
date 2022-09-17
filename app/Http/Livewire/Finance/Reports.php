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
         $this->startDate = Carbon::today()->toDateString();
        $this->endDate = Carbon::today()->toDateString();
        
        $this->filterReports();
    }


    private function getTotalGamesAmount(){
        $_startDate = Carbon::parse($this->startDate)->startOfDay() ;
        $_endDate = Carbon::parse($this->endDate)->endOfDay() ;

        $gamesPriceSum = 0;
        $freePlan = Plan::where('is_free',true)->first();
        $userPlan = UserPlan::where('plan_id','>',$freePlan->id)
                    ->where('created_at','>=',$_startDate)
                    ->where('created_at','<=', $_endDate)
                    ->get() ;

        foreach($userPlan as $_plan){
            if($_plan->plan !== null){
                $gamesPriceSum +=  $_plan->plan->price;
            }
           
        }
        
        $this->boughtGamesFunds =  $gamesPriceSum; 
    }

    private function getTotalBoostsAmount(){
        $_startDate = Carbon::parse($this->startDate)->startOfDay() ;
        $_endDate = Carbon::parse($this->endDate)->endOfDay() ;
        
        $this->boughtBoostsFunds = WalletTransaction::where('created_at','>=',$_startDate)
                ->where('created_at','<=', $_endDate)
                ->where(function ($query) {
                    $query->where('description','Bought TIME FREEZE boosts')
                        ->orWhere('description','Bought SKIP boosts')
                        ->orWhere('description','Bought BOMB boosts');
                })->sum('amount');
    }

    private function getTotalWalletDeopsit(){
        $_startDate = Carbon::parse($this->startDate)->startOfDay() ;
        $_endDate = Carbon::parse($this->endDate)->endOfDay() ;

        $this->totalWalletDeposit = WalletTransaction::where('transaction_type', "CREDIT")
                                    ->where('description','Fund Wallet')
                                    ->where('created_at','>=',$_startDate)
                                    ->where('created_at','<=', $_endDate)
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
