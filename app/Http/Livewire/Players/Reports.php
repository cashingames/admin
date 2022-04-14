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
        $this->userPlayedCount = GameSession::all()->count();
     
    }

    public function filterReports()
    {
        $this->getCountOfUserGames();
    }

    private function getCountOfUserGames()
    {
        $_startDate = Carbon::CreateFromFormat('d/m/Y',$this->startDate)->format('Y-m-d') ;
        $_endDate = Carbon::CreateFromFormat('d/m/Y',$this->endDate)->format('Y-m-d') ;
        
        $sql = GameSession::where('created_at','>=', Carbon::createFromTimestamp($_startDate))
        ->where('created_at','<', Carbon::createFromTimestamp($_endDate))->get()->count();

        $this->userPlayedCount = $sql;
     
    }

    public function render()
    {
        return view('livewire.players.reports');
    }
}
