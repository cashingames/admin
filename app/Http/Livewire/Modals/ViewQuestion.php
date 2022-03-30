<?php

namespace App\Http\Livewire\Modals;

use App\Models\Live\Question;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Gate;
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
        
        if (Gate::allows('super-admin-access')||
        Gate::allows('content-admin-access') ) {
           return $this->canPublish = true;
        }
        return $this->canPublish = false;
    }
}
