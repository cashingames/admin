<?php

namespace App\Http\Livewire\Players;

use App\Models\Live\GameSession;
use App\Models\Live\Plan;
use App\Models\Live\UserPlan;
use App\Models\Live\UserBoost;
use App\Models\Live\Profile;
use App\Models\Live\User;
use App\Models\Live\WalletTransaction;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Reports extends Component
{
    public $startDate, $endDate;
    public $allUsersPlayedCount, $userExhaustedFreeGameCount,
        $referredUserCount, $boughtGamesCount, $registeredUserCount,
        $boughtBoostsCount, $usedBoostsCount, $countOfEmailVerifications, $countOfPhoneVerifications, 
        $newUserNotPlayedCount, $newUserPlayedCount;

    public function mount()
    {
        $this->startDate = Carbon::today()->toDateString();
        $this->endDate = Carbon::today()->toDateString();

        $this->filterReports();
    }

    private function getCountOfRegisteredUsers()
    {
        $_startDate = Carbon::parse($this->startDate)->startOfDay();
        $_endDate = Carbon::parse($this->endDate)->endOfDay();

        $sql =  User::where('created_at', '>=', $_startDate)
            ->where('created_at', '<=', $_endDate)->count();

        $this->registeredUserCount = $sql;
    }

    private function getCountOfAllUsersWithGames()
    {
        $_startDate = Carbon::parse($this->startDate)->startOfDay();
        $_endDate = Carbon::parse($this->endDate)->endOfDay();

        $sql = GameSession::where('created_at', '>=', $_startDate)
            ->where('created_at', '<=', $_endDate)
            ->select(DB::raw('count(*) as num'))
            ->groupBy('user_id')->get();

        $this->allUsersPlayedCount = count($sql);
    }

    private function getCountOfNewUsersWithNoPlayedGames()
    {
        $_startDate = Carbon::parse($this->startDate)->startOfDay();
        $_endDate = Carbon::parse($this->endDate)->endOfDay();

        $sql = User::where('created_at', '>=', $_startDate)
            ->where('created_at', '<=', $_endDate)
            ->doesntHave('gameSessions')->count();

        $this->newUserNotPlayedCount = $sql;
    }

    private function getCountOfNewUsersWithPlayedGames()
    {
        $_startDate = Carbon::parse($this->startDate)->startOfDay();
        $_endDate = Carbon::parse($this->endDate)->endOfDay();

        $sql = User::where('created_at', '>=', $_startDate)
            ->where('created_at', '<=', $_endDate)
            ->whereHas('gameSessions')->count();

        $this->newUserPlayedCount = $sql;
    }

    private function getCountOfUserExhaustedFreeGames()
    {
        $_startDate = Carbon::parse($this->startDate)->startOfDay();
        $_endDate = Carbon::parse($this->endDate)->endOfDay();
        $freePlan = Plan::where('is_free', true)->first();

        $sql = UserPlan::where('created_at', '>=', $_startDate)
            ->where('created_at', '<=', $_endDate)
            ->where('plan_id', $freePlan->id)
            ->where('is_active', false)
            ->where('used_count', '>=', $freePlan->game_count)
            ->select(DB::raw('count(*) as num'))
            ->groupBy('user_id')->get();

        $this->userExhaustedFreeGameCount = count($sql);
    }
    private function getCountOfRefferedUsers()
    {
        $_startDate = Carbon::parse($this->startDate)->startOfDay();
        $_endDate = Carbon::parse($this->endDate)->endOfDay();

        $sql = Profile::whereNotNull('referrer')
            ->where('created_at', '>=', $_startDate)
            ->where('created_at', '<=', $_endDate)
            ->select(DB::raw('count(*) as num'))
            ->groupBy('referrer')->get();

        $this->referredUserCount = count($sql);
    }
    private function getCountOfBoughtGames()
    {
        $_startDate = Carbon::parse($this->startDate)->startOfDay();
        $_endDate = Carbon::parse($this->endDate)->endOfDay();

        $freePlan = Plan::where('is_free', true)->first();

        $sql = UserPlan::where('plan_id', '>', $freePlan->id)
            ->where('created_at', '>=', $_startDate)
            ->where('created_at', '<=', $_endDate)
            ->select(DB::raw('count(*) as num'))
            ->groupBy('user_id')->get();

        $this->boughtGamesCount = count($sql);
    }

    private function getCountOfBoughtBoosts()
    {
        $_startDate = Carbon::parse($this->startDate)->startOfDay();
        $_endDate = Carbon::parse($this->endDate)->endOfDay();

        $sql = WalletTransaction::where('created_at', '>=', $_startDate)
            ->where('created_at', '<=', $_endDate)
            ->where(function ($query) {
                $query->where('description', 'Bought TIME FREEZE boosts')
                    ->orWhere('description', 'Bought SKIP boosts')
                    ->orWhere('description', 'Bought BOMB boosts');
            })->select(DB::raw('count(*) as num'))
            ->groupBy('wallet_id')->get();

        $this->boughtBoostsCount = count($sql);
    }

    private function getCountOfUsedBoosts()
    {
        $_startDate = Carbon::parse($this->startDate)->startOfDay();
        $_endDate = Carbon::parse($this->endDate)->endOfDay();

        $sql = UserBoost::where('created_at', '>=', $_startDate)
            ->where('created_at', '<=', $_endDate)->where('used_count', '>', 0)
            ->select(DB::raw('count(*) as num'))
            ->groupBy('user_id')->get();

        $this->usedBoostsCount = count($sql);
    }

    private function getCountOfEmailVerifications()
    {
        $_startDate = Carbon::parse($this->startDate)->startOfDay();
        $_endDate = Carbon::parse($this->endDate)->endOfDay();

        $sql =  User::where('created_at', '>=', $_startDate)
            ->where('created_at', '<=', $_endDate)->whereNotNull('email_verified_at')
            ->count();

        $this->countOfEmailVerifications = $sql;
    }

    private function getCountOfPhoneVerifications()
    {
        $_startDate = Carbon::parse($this->startDate)->startOfDay();
        $_endDate = Carbon::parse($this->endDate)->endOfDay();

        $sql =  User::where('created_at', '>=', $_startDate)
            ->where('created_at', '<=', $_endDate)->whereNotNull('phone_verified_at')
            ->count();

        $this->countOfPhoneVerifications = $sql;
    }


    public function filterReports()
    {
        $this->getCountOfRegisteredUsers();
        $this->getCountOfAllUsersWithGames();
        $this->getCountOfNewUsersWithNoPlayedGames();
        $this->getCountOfNewUsersWithPlayedGames();
        $this->getCountOfUserExhaustedFreeGames();
        $this->getCountOfRefferedUsers();
        $this->getCountOfBoughtGames();
        $this->getCountOfBoughtBoosts();
        $this->getCountOfUsedBoosts();
        $this->getCountOfEmailVerifications();
        $this->getCountOfPhoneVerifications();
    }


    public function render()
    {
        return view('livewire.players.reports');
    }
}
