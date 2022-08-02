<?php

namespace App\Http\Livewire\Gaming;

use Livewire\Component;
use App\Models\Live\Question;
use App\Models\Question as AdminQuestion;
use App\Models\Live\Category;
use App\Models\Live\Challenge;
use App\Models\Live\GameSession;
use App\Models\Live\Trivia;
use App\Models\Live\User;
use Illuminate\Support\Carbon;

class Reports extends Component
{
    public $startDate, $endDate;
    public $initiatedChallenges, $acceptedChallenges, $declinedChallenges, $pendingChallenges;
    public $liveTriviaCount , $liveTriviaParticipants;

    public function mount()
    {
        $this->startDate = Carbon::today()->toDateString();
        $this->endDate = Carbon::today()->toDateString();

        $this->filterReports();
    }

    private function getCountOfInitiatedChallenges()
    {
        $_startDate = Carbon::parse($this->startDate)->startOfDay();
        $_endDate = Carbon::parse($this->endDate)->endOfDay();

        $sql =  Challenge::where('created_at', '>=', $_startDate)
            ->where('created_at', '<=', $_endDate)->count();

        $this->initiatedChallenges = $sql;
    }

    private function getCountOfAcceptedChallenges()
    {
        $_startDate = Carbon::parse($this->startDate)->startOfDay();
        $_endDate = Carbon::parse($this->endDate)->endOfDay();

        $sql =  Challenge::where('created_at', '>=', $_startDate)
            ->where('created_at', '<=', $_endDate)->where('status', 'ACCEPTED')->count();

        $this->acceptedChallenges = $sql;
    }

    private function getCountOfDeclinedChallenges()
    {
        $_startDate = Carbon::parse($this->startDate)->startOfDay();
        $_endDate = Carbon::parse($this->endDate)->endOfDay();

        $sql =  Challenge::where('created_at', '>=', $_startDate)
            ->where('created_at', '<=', $_endDate)->where('status', 'DECLINED')->count();

        $this->declinedChallenges = $sql;
    }

    private function getCountOfPendingChallenges()
    {
        $_startDate = Carbon::parse($this->startDate)->startOfDay();
        $_endDate = Carbon::parse($this->endDate)->endOfDay();

        $sql =  Challenge::where('created_at', '>=', $_startDate)
            ->where('created_at', '<=', $_endDate)->where('status', 'PENDING')->count();

        $this->pendingChallenges = $sql;
    }

    private function getCountOfLiveTrivia()
    {
        $_startDate = Carbon::parse($this->startDate)->startOfDay();
        $_endDate = Carbon::parse($this->endDate)->endOfDay();

        $sql =  Trivia::where('created_at', '>=', $_startDate)
            ->where('created_at', '<=', $_endDate)->count();

        $this->liveTriviaCount = $sql;
    }

    private function getCountOfLiveTriviaParticipants()
    {
        $_startDate = Carbon::parse($this->startDate)->startOfDay();
        $_endDate = Carbon::parse($this->endDate)->endOfDay();

        $sql = GameSession::where('created_at', '>=', $_startDate)
            ->where('created_at', '<=', $_endDate)->whereNotNull('trivia_id')->count();

        $this->liveTriviaParticipants = $sql;
    }

    public function filterReports()
    {
        $this->getCountOfInitiatedChallenges();
        $this->getCountOfAcceptedChallenges();
        $this->getCountOfDeclinedChallenges();
        $this->getCountOfPendingChallenges();
        $this->getCountOfLiveTrivia();
        $this->getCountOfLiveTriviaParticipants();
    }

    public function render()
    {
        return view('livewire.gaming.reports');
    }
}
