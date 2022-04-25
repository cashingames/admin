<?php

namespace App\Http\Livewire\Cms;

use Livewire\Component;
use App\Models\Live\Question;
use Illuminate\Support\Carbon;

class Reports extends Component
{
    public $startDate, $endDate, $freePlan;
    public $questionsCount, $unPublishedQuestions, $publishedQuestions;


    public function mount(){
        $this->questionsCount =  Question::all()->count();
        $this->publishedQuestions = Question::where('is_published', true)->get()->count();
        $this->unPublishedQuestions = Question::where('is_published', false)->get()->count();
       
    }

    public function filterReports()
    {
        $this->getTotalQuestionsCount();
        $this->getTotalPublishedQuestionsCount();
        $this->getTotalUnPublishedQuestionsCount();

    }

    private function getTotalQuestionsCount()
    {
        $_startDate = Carbon::parse($this->startDate) ;
        $_endDate = Carbon::parse($this->endDate) ;
        
        $sql = Question::where('created_at','>=',$_startDate)
        ->where('created_at','<', $_endDate)->get()->count();

        $this->questionsCount = $sql;
     
    }

    private function getTotalPublishedQuestionsCount()
    {
        $_startDate = Carbon::parse($this->startDate) ;
        $_endDate = Carbon::parse($this->endDate) ;
        
        $sql = Question::where('updated_at','>=',$_startDate)
        ->where('updated_at','<', $_endDate)
        ->where('is_published', true)->get()->count();

        $this->publishedQuestions = $sql;
     
    }
    private function getTotalUnPublishedQuestionsCount()
    {
        $_startDate = Carbon::parse($this->startDate) ;
        $_endDate = Carbon::parse($this->endDate) ;
        
        $sql = Question::where('updated_at','>=',$_startDate)
        ->where('updated_at','<', $_endDate)
        ->where('is_published', false)->get()->count();

        $this->unPublishedQuestions = $sql;
     
    }

   
    public function render()
    {
        return view('livewire.cms.reports');
    }
}
