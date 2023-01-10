<?php

namespace App\Http\Livewire\Modals;

use App\Models\Live\Question;
use App\Models\Question as AdminQuestion;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Gate;


class ViewApprovedQuestion extends ModalComponent
{   
    public $question;
    public $canPublish;
    public $isApproved;


    public function mount($id)
    {
        $this->question = Question::find($id);
        $this->getUserPermissions();
    }
   
    private function getUserPermissions(){
        
        if (Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'cms:publish')) {
           return $this->canPublish = true;
        }
        return $this->canPublish = false;
    }

    public function render()
    {
        return view('livewire.modals.view-approved-question',[
            'question' =>$this->question,
        ]);
    }
}
