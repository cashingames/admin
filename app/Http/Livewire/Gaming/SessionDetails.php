<?php

namespace App\Http\Livewire\Gaming;

use App\Models\Live\ChallengeGameSession;
use App\Models\Live\GameSession;
use Livewire\Component;

class SessionDetails extends Component
{
    public $sessionId ;
    public $gameMode;
    public $data ;
    public $err;

    public function mount()
    {   
       
        $this->gameMode = null;
        $this->sessionId = null;
        $this->data = [];
    }

    public function updated(){
        $this->err = '';
    }

    public function fetch()
    {   
        if (is_null($this->gameMode) || is_null($this->sessionId)) {
            return $this->err = 'Game mode and session id is needed';
        }

        if ($this->gameMode == 'Live Trivia' || $this->gameMode == 'Exhibition'){
            $this->data = GameSession::join('game_session_questions', 'game_session_questions.game_session_id', 'game_sessions.id')
            ->join('questions','questions.id','game_session_questions.question_id')
            ->join('options','options.id','game_session_questions.option_id')
            ->select('questions.label as question', 'questions.level as level', 'questions.id as id', 'options.title as option', 'options.is_correct as correct')
            ->where('game_sessions.id', $this->sessionId)
            ->get();
        }
    }

    public function render()
    {
        return view('livewire.gaming.session-details');
    }
}
