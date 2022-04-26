<?php

namespace App\Http\Livewire\Cms;

use Livewire\Component;
use App\Models\Live\Question;
use App\Models\Live\Category;
use App\Models\User;
use Illuminate\Support\Carbon;
class Reports extends Component
{
    public $startDate, $endDate;
    public $questionsCount, $unPublishedQuestions, $publishedQuestions;
    public $subcategories, $creators, $subcategory, $creator, $addExtraFilters = false;

    public function mount(){
        $this->questionsCount =  Question::all()->count();
        $this->publishedQuestions = Question::where('is_published', true)->get()->count();
        $this->unPublishedQuestions = Question::where('is_published', false)->get()->count();
        $this->subcategories = Category::where('category_id', '>', 0)->get();
        $this->creators = User::all();
    }

    private function getTotalQuestionsCount()
    {   
        $_startDate = Carbon::parse($this->startDate) ;
        $_endDate = Carbon::parse($this->endDate) ;
        
        if(!$this->addExtraFilters){
            $sql = Question::where('created_at','>=',$_startDate)
            ->where('created_at','<', $_endDate)->get()->count();
    
            $this->questionsCount = $sql;
        } else {
            $_subCategory = Category::where('name',$this->subcategory)->first();
            $_creator = User::where('name',$this->creator)->first();

            if($_subCategory !== null || $_creator !== null){
                $sql = Question::where('created_at','>=',$_startDate)
                ->where('created_at','<', $_endDate)
                ->where('category_id',$_subCategory->id)
                ->where('created_by', $_creator->id)
                ->get()->count();
        
                $this->questionsCount = $sql;
            }else{
                $this->questionsCount = 0;
            }
        }
       
     
    }

    private function getTotalPublishedQuestionsCount()
    {
        $_startDate = Carbon::parse($this->startDate) ;
        $_endDate = Carbon::parse($this->endDate) ;
        
        if(!$this->addExtraFilters){
            $sql = Question::where('updated_at','>=',$_startDate)
            ->where('updated_at','<', $_endDate)
            ->where('is_published', true)->get()->count();

            $this->publishedQuestions = $sql;
        }else{
            $_subCategory = Category::where('name',$this->subcategory)->first();
            $_creator = User::where('name',$this->creator)->first();
            
            if($_subCategory !== null || $_creator !== null){
                $sql = Question::where('updated_at','>=',$_startDate)
                ->where('updated_at','<', $_endDate)
                ->where('category_id',$_subCategory->id)
                ->where('created_by', $_creator->id)
                ->where('is_published', true)->get()->count();
    
                $this->publishedQuestions = $sql;
            }else{
                $this->publishedQuestions = 0;
            }
          
        }
    }
    private function getTotalUnPublishedQuestionsCount()
    {
        $_startDate = Carbon::parse($this->startDate) ;
        $_endDate = Carbon::parse($this->endDate) ;
        
        if(!$this->addExtraFilters){
            $sql = Question::where('updated_at','>=',$_startDate)
            ->where('updated_at','<', $_endDate)
            ->where('is_published', false)->get()->count();

            $this->unPublishedQuestions = $sql;
        }else{
            $_subCategory = Category::where('name',$this->subcategory)->first();
            $_creator = User::where('name',$this->creator)->first();
            
            if($_subCategory !== null || $_creator !== null){
                $sql = Question::where('updated_at','>=',$_startDate)
                ->where('updated_at','<', $_endDate)
                ->where('category_id',$_subCategory->id)
                ->where('created_by', $_creator->id)
                ->where('is_published', false)->get()->count();

                $this->unPublishedQuestions = $sql;
            }else {
                $this->unPublishedQuestions = 0;
            }
        }
     
    }

    public function addExtraFilters(){
        if($this->addExtraFilters){
            $this->addExtraFilters = false;
        }else {
            $this->addExtraFilters = true;
        }
    }

    public function filterReports()
    {
        $this->getTotalQuestionsCount();
        $this->getTotalPublishedQuestionsCount();
        $this->getTotalUnPublishedQuestionsCount();

    }
   
    public function render()
    {
        return view('livewire.cms.reports');
    }
}
