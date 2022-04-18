<?php

namespace App\Http\Livewire\Players;

use App\Models\Live\GameSession;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Reports extends Component
{
    public $startDate;
    public $endDate;
    public $userPlayedCount ;

    public function mount()
    {
        $this->userPlayedCount = GameSession::all()->groupBy('user_id')->count();
     
    }

    public function filterReports()
    {
        $this->getCountOfUserGames();
    }

    private function getCountOfUserGames()
    {
        $_startDate = Carbon::parse($this->startDate) ;
        $_endDate = Carbon::parse($this->endDate) ;
        
        $sql = GameSession::where('created_at','>=',$_startDate)
        ->where('created_at','<', $_endDate)->get()->groupBy('user_id')->count();

        $this->userPlayedCount = $sql;
     
    }

    public function render()
    {
        return view('livewire.players.reports');
    }
}
