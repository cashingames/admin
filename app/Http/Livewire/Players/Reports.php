<?php

namespace App\Http\Livewire\Players;

use App\Models\Live\GameSession;
use App\Models\Live\Plan;
use App\Models\Live\UserPlan;
use App\Models\Live\UserBoost;
use App\Models\Live\Profile;
use App\Models\Live\WalletTransaction;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Reports extends Component
{
    public $startDate, $endDate;
    public $userPlayedCount,$userExhaustedFreeGameCount,
    $referredUserCount, $boughtGamesCount, 
    $boughtBoostsCount, $usedBoostsCount;

    public function mount()
    {   
        //get reports without filter on page load
        $freePlan = Plan::where('is_free',true)->first();
        $this->userPlayedCount = GameSession::all()->groupBy('user_id')->count();
        
        $this->userExhaustedFreeGameCount =  UserPlan::where('plan_id',$freePlan->id)
        ->where('is_active',false)
        ->where('used_count','>=', $freePlan->game_count )->get()->groupBy('user_id')->count();

        $this->referredUserCount = Profile::whereNotNull('referrer')->get()->groupBy('referrer')->count();
        $this->boughtGamesCount = UserPlan::where('plan_id', '>',$freePlan->id)->get()->groupBy('user_id')->count();
        $this->boughtBoostsCount = WalletTransaction::where('description','Bought TIME FREEZE boosts')
        ->orWhere('description','Bought SKIP boosts')
        ->orWhere('description','Bought BOMB boosts')
        ->get()->groupBy('wallet_id')->count();

        $this->usedBoostsCount = UserBoost::where('used_count', '>', 0)->get()->groupBy('user_id')->count();
    }

    private function getCountOfUserGames()
    {
        $_startDate = Carbon::parse($this->startDate)->startOfDay() ;
        $_endDate = Carbon::parse($this->endDate)->endOfDay() ;
        
        $sql = GameSession::where('created_at','>=',$_startDate)
        ->where('created_at','<=', $_endDate)->get()->groupBy('user_id')->count();

        $this->userPlayedCount = $sql;
     
    }

    private function getCountOfUserExhaustedFreeGames()
    {
        $_startDate = Carbon::parse($this->startDate)->startOfDay() ;
        $_endDate = Carbon::parse($this->endDate)->endOfDay() ;
        $freePlan = Plan::where('is_free',true)->first();

        $sql = UserPlan::where('created_at','>=',$_startDate)
        ->where('created_at','<=', $_endDate)
        ->where('plan_id',$freePlan->id)
        ->where('is_active',false)
        ->where('used_count','>=', $freePlan->game_count )
        ->get()->groupBy('user_id')->count();

        $this->userExhaustedFreeGameCount = $sql;
     
    }
    private function getCountOfRefferedUsers()
    {
        $_startDate = Carbon::parse($this->startDate)->startOfDay() ;
        $_endDate = Carbon::parse($this->endDate)->endOfDay() ;

        $sql = Profile::whereNotNull('referrer')
                ->where('created_at','>=',$_startDate)
                ->where('created_at','<=', $_endDate)
                ->get()->groupBy('referrer')->count();
                
        $this->referredUserCount = $sql;
    }
    private function getCountOfBoughtGames()
    {
        $_startDate = Carbon::parse($this->startDate)->startOfDay() ;
        $_endDate = Carbon::parse($this->endDate)->endOfDay() ;

        $freePlan = Plan::where('is_free',true)->first();

        $sql = UserPlan::where('plan_id', '>',$freePlan->id)
                ->where('created_at','>=',$_startDate)
                ->where('created_at','<=', $_endDate)
                ->get()->groupBy('user_id')->count();
                
        $this->boughtGamesCount = $sql;
    }

    private function getCountOfBoughtBoosts()
    {
        $_startDate = Carbon::parse($this->startDate)->startOfDay() ;
        $_endDate = Carbon::parse($this->endDate)->endOfDay() ;

        $sql = WalletTransaction::where('created_at','>=',$_startDate)
                ->where('created_at','<=', $_endDate)
                ->where(function ($query) {
                    $query->where('description','Bought TIME FREEZE boosts')
                        ->orWhere('description','Bought SKIP boosts')
                        ->orWhere('description','Bought BOMB boosts');
                })->get()->groupBy('wallet_id')->count();

        $this->boughtBoostsCount = $sql;
    }

    private function getCountOfUsedBoosts()
    {
        $_startDate = Carbon::parse($this->startDate)->startOfDay() ;
        $_endDate = Carbon::parse($this->endDate)->endOfDay() ;

        $sql = UserBoost::where('created_at','>=',$_startDate)
                ->where('created_at','<=', $_endDate)->where('used_count', '>', 0)
                ->get()->groupBy('user_id')->count();
                
        $this->usedBoostsCount = $sql;
    }

    public function filterReports()
    {
        $this->getCountOfUserGames();
        $this->getCountOfUserExhaustedFreeGames();
        $this->getCountOfRefferedUsers();
        $this->getCountOfBoughtGames();
        $this->getCountOfBoughtBoosts();
        $this->getCountOfUsedBoosts();
    }


    public function render()
    {
        return view('livewire.players.reports');
    }
}
