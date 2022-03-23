<?php

namespace App\Http\Livewire\Modals;

use App\Models\Live\Question;
use LivewireUI\Modal\ModalComponent;

class ViewQuestion extends ModalComponent
{

    public $question;
    public $canPublish;

    public function mount($id)
    {
        $this->question = Question::find($id);
        $this->getUserPermissions();
    }

    public function render()
    {
        return view('livewire.modals.view-question', [
            'question' =>$this->question,
        ]);
    }

    private function getUserPermissions(){
        $user = auth()->user();
        $team = $user->currentTeam;

        if($user->hasTeamPermission($team, 'cms:publish')){
            $this->canPublish = true;
        }

        return;
    }
}
