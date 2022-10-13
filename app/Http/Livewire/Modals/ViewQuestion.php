<?php

namespace App\Http\Livewire\Modals;

use App\Models\Live\Question;
use App\Models\Question as AdminQuestion;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Gate;
class ViewQuestion extends ModalComponent
{

    public $question;
    public $canPublish;
    public $isApproved;

    public function mount($id)
    {
        $this->question = Question::find($id);
        $this->getUserPermissions();
        // $this->checkIsRejected();
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
    
    // private function checkIsRejected(){
    //     $question = AdminQuestion::where('question_id', $this->question->id)->first();
    //     if ( $question === null) {
           
    //         $q = new AdminQuestion;
    //         if( $this->question->created_by === null){
    //             $q->user_id = User::where('is_content_admin',true)->first()->id;
    //         }else{
    //             $q->user_id = $this->question->created_by;
    //         }
    //         $q->question_id = $this->question->id;
    //         $q->save();
    //         if($q->approved_at !== null){
    //             return $this->isApproved = true;
    //         }
    //         return $this->isApproved = false;
    //     }

    //     if ( $question->approved_at === null) {
    //        return $this->isApproved = false;
    //     }
    //     return $this->isApproved = true;
    // }
}
