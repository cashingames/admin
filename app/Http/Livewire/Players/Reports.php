<?php

namespace App\Http\Livewire\Players;

use App\Models\Live\GameSession;
use App\Models\Live\Plan;
use App\Models\Live\UserPlan;
use App\Models\Live\UserBoost;
use App\Models\Live\Profile;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Reports extends Component
{
    public $startDate, $endDate, $freePlan;
    public $userPlayedCount,$userExhaustedFreeGameCount,
    $referredUserCount, $boughtGamesCount, 
    $boughtBoostsCount, $usedBoostsCount;

    public function mount()
    {   
        //get reports without filter on page load
        $this->freePlan = Plan::where('is_free',true)->first();
        $this->userPlayedCount = GameSession::all()->groupBy('user_id')->count();
        
        $this->userExhaustedFreeGameCount =  UserPlan::where('id',$this->freePlan->id)
        ->where('used_count','>=', 'plan_count')
        ->get()->groupBy('user_id')->count();

        $this->referredUserCount = Profile::whereNotNull('referrer')->get()->groupBy('referrer')->count();
        $this->boughtGamesCount = UserPlan::where('plan_id', '>',$this->freePlan->id)->get()->groupBy('user_id')->count();
        $this->boughtBoostsCount = UserBoost::all()->groupBy('user_id')->count();
        $this->usedBoostsCount = UserBoost::where('used_count', '>', 0)->get()->groupBy('user_id')->count();
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

    private function getCountOfUserGames()
    {
        $_startDate = Carbon::parse($this->startDate) ;
        $_endDate = Carbon::parse($this->endDate) ;
        
        $sql = GameSession::where('created_at','>=',$_startDate)
        ->where('created_at','<', $_endDate)->get()->groupBy('user_id')->count();

        $this->userPlayedCount = $sql;
     
    }

    private function getCountOfUserExhaustedFreeGames()
    {
      
        $_startDate = Carbon::parse($this->startDate) ;
        $_endDate = Carbon::parse($this->endDate) ;
        
        $sql = UserPlan::where('created_at','>=',$_startDate)
        ->where('created_at','<', $_endDate)
        ->where('id',$this->freePlan->id)
        ->where('used_count','>=', 'plan_count')
        ->get()->groupBy('user_id')->count();

        $this->userExhaustedFreeGameCount = $sql;
     
    }
    private function getCountOfRefferedUsers()
    {
        $_startDate = Carbon::parse($this->startDate) ;
        $_endDate = Carbon::parse($this->endDate) ;

        $sql = Profile::whereNotNull('referrer')
                ->where('created_at','>=',$_startDate)
                ->where('created_at','<', $_endDate)
                ->get()->groupBy('referrer')->count();
                
        $this->referredUserCount = $sql;
    }
    private function getCountOfBoughtGames()
    {
        $_startDate = Carbon::parse($this->startDate) ;
        $_endDate = Carbon::parse($this->endDate) ;

        $sql = UserPlan::where('plan_id', '>',$this->freePlan->id)
                ->where('created_at','>=',$_startDate)
                ->where('created_at','<', $_endDate)
                ->get()->groupBy('user_id')->count();
                
        $this->boughtGamesCount = $sql;
    }

    private function getCountOfBoughtBoosts()
    {
        $_startDate = Carbon::parse($this->startDate) ;
        $_endDate = Carbon::parse($this->endDate) ;

        $sql = UserBoost::where('created_at','>=',$_startDate)
                ->where('created_at','<', $_endDate)
                ->get()->groupBy('user_id')->count();
                
        $this->boughtBoostsCount = $sql;
    }

    private function getCountOfUsedBoosts()
    {
        $_startDate = Carbon::parse($this->startDate) ;
        $_endDate = Carbon::parse($this->endDate) ;

        $sql = UserBoost::where('created_at','>=',$_startDate)
                ->where('created_at','<', $_endDate)->where('used_count', '>', 0)
                ->get()->groupBy('user_id')->count();
                
        $this->usedBoostsCount = $sql;
    }


    public function render()
    {
        return view('livewire.players.reports');
    }
}
