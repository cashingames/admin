<?php

namespace App\Http\Livewire\Cms;

use Livewire\Component;
use App\Models\Live\Question;
use App\Models\Question as AdminQuestion;
use App\Models\Live\Category;
use App\Models\User;
use Illuminate\Support\Carbon;
class Reports extends Component
{
    public $startDate, $endDate;
    public $questionsCount, $unPublishedQuestions, $publishedQuestions, $rejectedQuestions;
    public $subcategories, $creators, $subcategory, $creator, $addExtraFilters = false;

    public function mount(){
        $this->questionsCount =  Question::all()->count();
        $this->publishedQuestions = Question::where('is_published', true)->get()->count();
        $this->unPublishedQuestions = Question::where('is_published', false)->get()->count();
        $this->subcategories = Category::where('category_id', '>', 0)->get();
        $this->creators = User::where('is_admin',false)->get();
        $this->rejectedQuestions = AdminQuestion::where('is_approved',false)->get()->count();
    }

    private function getTotalQuestionsCount()
    {   
        $_startDate = Carbon::parse($this->startDate) ;
        $_endDate = Carbon::parse($this->endDate) ;
        
        if(!$this->addExtraFilters){
            $sql = Question::where('created_at','>=',$_startDate)
            ->where('created_at','<=', $_endDate)->get()->count();
    
            $this->questionsCount = $sql;
        } else {
            $_subCategory = Category::where('name',$this->subcategory)->first();
            $_creator = User::where('name',$this->creator)->first();

            if($_subCategory === null && $_creator === null ){
                
                $sql = Question::where('created_at','>=',$_startDate)
                ->where('created_at','<=', $_endDate)->get()->count();
        
                $this->questionsCount = $sql;
            }
            elseif($_subCategory === null && $_creator !== null ){
                $sql = Question::where('created_at','>=',$_startDate)
                ->where('created_at','<=', $_endDate)
                ->where('created_by', $_creator->id)
                ->get()->count();
        
                $this->questionsCount = $sql;
            }
            elseif($_creator === null && $_subCategory !== null){
                $sql = Question::where('created_at','>=',$_startDate)
                ->where('created_at','<=', $_endDate)
                ->where('category_id', $_subCategory->id)
                ->get()->count();
        
                $this->questionsCount = $sql;
            }else{
                $sql = Question::where('created_at','>=',$_startDate)
                ->where('created_at','<=', $_endDate)
                ->where('created_by', $_creator->id)
                ->where('category_id', $_subCategory->id)
                ->get()->count();
        
                $this->questionsCount = $sql;
            }
        }
       
     
    }

    private function getTotalPublishedQuestionsCount()
    {
        $_startDate = Carbon::parse($this->startDate) ;
        $_endDate = Carbon::parse($this->endDate) ;
        
        if(!$this->addExtraFilters){
            $sql = Question::where('updated_at','>=',$_startDate)
            ->where('updated_at','<=', $_endDate)
            ->where('is_published', true)->get()->count();
 
            $this->publishedQuestions = $sql;
        }else{
            $_subCategory = Category::where('name',$this->subcategory)->first();
            $_creator = User::where('name',$this->creator)->first();
            
            if($_subCategory === null && $_creator === null ){
                $sql = Question::where('updated_at','>=',$_startDate)
                ->where('updated_at','<=', $_endDate)
                ->where('is_published', true)->get()->count();
 
                $this->publishedQuestions = $sql;
            }
            elseif($_subCategory === null && $_creator !== null ){
                $sql = Question::where('updated_at','>=',$_startDate)
                ->where('updated_at','<=', $_endDate)
                ->where('created_by', $_creator->id)
                ->where('is_published', true)->get()->count();
    
                $this->publishedQuestions = $sql;
            }
            elseif($_creator === null && $_subCategory !== null){
                $sql = Question::where('updated_at','>=',$_startDate)
                ->where('updated_at','<=', $_endDate)
                ->where('category_id', $_subCategory->id)
                ->where('is_published', true)->get()->count();
    
                $this->publishedQuestions = $sql;
            }
            else{
                $sql = Question::where('updated_at','>=',$_startDate)
                ->where('updated_at','<=', $_endDate)
                ->where('category_id', $_subCategory->id)
                ->where('created_by', $_creator->id)
                ->where('is_published', true)->get()->count();
    
                $this->publishedQuestions = $sql;
            }
          
        }
    }
    private function getTotalUnPublishedQuestionsCount()
    {
        $_startDate = Carbon::parse($this->startDate) ;
        $_endDate = Carbon::parse($this->endDate) ;
        
        if(!$this->addExtraFilters){
            $sql = Question::where('updated_at','>=',$_startDate)
            ->where('updated_at','<=', $_endDate)
            ->where('is_published', false)->get()->count();
 
            $this->unPublishedQuestions = $sql;
        }else{
            $_subCategory = Category::where('name',$this->subcategory)->first();
            $_creator = User::where('name',$this->creator)->first();
            
            if($_subCategory === null && $_creator === null ){
                $sql = Question::where('updated_at','>=',$_startDate)
                ->where('updated_at','<=', $_endDate)
                ->where('is_published', false)->get()->count();
     
                $this->unPublishedQuestions = $sql;
            }
            elseif($_subCategory === null && $_creator !== null ){
                $sql = Question::where('updated_at','>=',$_startDate)
                ->where('updated_at','<=', $_endDate)
                ->where('created_by', $_creator->id)
                ->where('is_published', false)->get()->count();

                $this->unPublishedQuestions = $sql;
            }
            elseif($_creator === null && $_subCategory !== null){
                $sql = Question::where('updated_at','>=',$_startDate)
                ->where('updated_at','<=', $_endDate)
                ->where('category_id', $_subCategory->id)
                ->where('is_published', false)->get()->count();

                $this->unPublishedQuestions = $sql;
            }
            else {
                $sql = Question::where('updated_at','>=',$_startDate)
                ->where('updated_at','<=', $_endDate)
                ->where('category_id', $_subCategory->id)
                ->where('created_by', $_creator->id)
                ->where('is_published', false)->get()->count();
               
                $this->unPublishedQuestions = $sql;
            }
        }
     
    }

    private function getTotalRejectedQuestionsCount()
    {
        $_startDate = Carbon::parse($this->startDate) ;
        $_endDate = Carbon::parse($this->endDate) ;
        
        if(!$this->addExtraFilters){

            $sql = AdminQuestion::where('is_approved',false)->where('updated_at','>=',$_startDate)
            ->where('updated_at','<=', $_endDate)->get()->count();

            $this->rejectedQuestions = $sql;
        }else{
            $_subCategory = Category::where('name',$this->subcategory)->first();
            $_creator = User::where('name',$this->creator)->first();
            
            if($_subCategory === null && $_creator === null ){
                $sql = AdminQuestion::where('is_approved',false)->where('updated_at','>=',$_startDate)
                ->where('updated_at','<=', $_endDate)->get()->count();
    
                $this->rejectedQuestions = $sql;
            }

            elseif($_subCategory === null && $_creator !== null ){
                $sql = AdminQuestion::where('updated_at','>=',$_startDate)
                ->where('updated_at','<=', $_endDate)
                ->where('user_id', $_creator->id)
                ->where('is_approved', false)->get()->count();

                $this->rejectedQuestions = $sql;
            }
            elseif($_creator === null && $_subCategory !== null){
                $sql = AdminQuestion::where('updated_at','>=',$_startDate)
                ->where('updated_at','<=', $_endDate)
                ->where('is_approved', false)->get()->count();

                $this->rejectedQuestions = $sql;
            }
            else {
                $sql = AdminQuestion::where('updated_at','>=',$_startDate)
                ->where('updated_at','<=', $_endDate)
                ->where('is_approved', false)->get()->count();

                $this->rejectedQuestions = $sql;
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
        $this->getTotalRejectedQuestionsCount();
    }
   
    public function render()
    {
        return view('livewire.cms.reports');
    }
}
