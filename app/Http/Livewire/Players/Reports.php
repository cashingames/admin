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
    public $userPlayedCount, $userExhaustedFreeGameCount,
        $referredUserCount, $boughtGamesCount, $registeredUserCount,
        $boughtBoostsCount, $usedBoostsCount, $userNotPlayedCount,
        $countOfEmailVerifications,  $countOfPhoneVerifications;

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
            ->where('created_at', '<=', $_endDate)
            ->count();

        $this->registeredUserCount = $sql;
    }

    private function getCountOfUserGames()
    {
        $_startDate = Carbon::parse($this->startDate)->startOfDay();
        $_endDate = Carbon::parse($this->endDate)->endOfDay();

        $sql = GameSession::where('created_at', '>=', $_startDate)
            ->where('created_at', '<=', $_endDate)->groupBy('user_id')->count();

        $this->userPlayedCount = $sql;
    }

    private function getCountOfUsersWithNoPlayedGames()
    {
        $_startDate = Carbon::parse($this->startDate)->startOfDay();
        $_endDate = Carbon::parse($this->endDate)->endOfDay();

        $usersWithGames = GameSession::pluck('user_id')->all();
        $sql = User::where('created_at', '>=', $_startDate)
        ->where('created_at', '<=', $_endDate)
        ->whereNotIn('id', $usersWithGames)->count();

       
        $this->userNotPlayedCount = $sql;
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
            ->groupBy('user_id')->count();

        $this->userExhaustedFreeGameCount = $sql;
    }
    private function getCountOfRefferedUsers()
    {
        $_startDate = Carbon::parse($this->startDate)->startOfDay();
        $_endDate = Carbon::parse($this->endDate)->endOfDay();

        $sql = Profile::whereNotNull('referrer')
            ->where('created_at', '>=', $_startDate)
            ->where('created_at', '<=', $_endDate)
            ->groupBy('referrer')->count();

        $this->referredUserCount = $sql;
    }
    private function getCountOfBoughtGames()
    {
        $_startDate = Carbon::parse($this->startDate)->startOfDay();
        $_endDate = Carbon::parse($this->endDate)->endOfDay();

        $freePlan = Plan::where('is_free', true)->first();

        $sql = UserPlan::where('plan_id', '>', $freePlan->id)
            ->where('created_at', '>=', $_startDate)
            ->where('created_at', '<=', $_endDate)
            ->groupBy('user_id')->count();

        $this->boughtGamesCount = $sql;
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
            })->groupBy('wallet_id')->count();

        $this->boughtBoostsCount = $sql;
    }

    private function getCountOfUsedBoosts()
    {
        $_startDate = Carbon::parse($this->startDate)->startOfDay();
        $_endDate = Carbon::parse($this->endDate)->endOfDay();

        $sql = UserBoost::where('created_at', '>=', $_startDate)
            ->where('created_at', '<=', $_endDate)->where('used_count', '>', 0)
            ->groupBy('user_id')->count();

        $this->usedBoostsCount = $sql;
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
        // $this->getCountOfRegisteredUsers();
        // $this->getCountOfUserGames();
        // $this->getCountOfUsersWithNoPlayedGames();
        // $this->getCountOfUserExhaustedFreeGames();
        // $this->getCountOfRefferedUsers();
        // $this->getCountOfBoughtGames();
        // $this->getCountOfBoughtBoosts();
        // $this->getCountOfUsedBoosts();
        // $this->getCountOfEmailVerifications();
        // $this->getCountOfPhoneVerifications();
    }


    public function render()
    {
        return view('livewire.players.reports');
    }
}
