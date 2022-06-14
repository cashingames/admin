<?php

namespace App\Http\Livewire\Cms;

use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Illuminate\Support\Facades\Gate;
use App\Models\Live\Question;
use App\Models\Question as AdminQuestion;
use App\Models\Live\Category;
use App\Models\User;
use Illuminate\Support\Carbon;

class UnreviewedQuestions extends LivewireDatatable
{  

    public function builder()
    {   
        
        if (Gate::allows('super-admin-access') ||
        Gate::allows('content-admin-access')) {
            return  AdminQuestion::query()->whereNull('deleted_at')
                    ->whereNull('approved_at')->whereNull('rejected_at')
                    ->whereNull('published_at');
        }
        return  AdminQuestion::query()->whereNull('deleted_at')
                    ->whereNull('approved_at')->whereNull('rejected_at')
                    ->whereNull('published_at')->where('user_id', auth()->user()->id);
    }

    public function columns()
    {
        return
        [
            Column::callback(['question_id'], function ($question_id) {
                return Question::find($question_id)->id;
            })->label('Id')
            ->searchable()
            ->hideable()
            ->filterable(),

            Column::callback(['question_id'], function ($question_id) {
                return Question::find($question_id)->level;
            },'level')->label('level')
            ->searchable()
            ->hideable()
            ->filterable(),

            Column::callback(['question_id'], function ($question_id) {
                return Question::find($question_id)->label;
            },'label')->label('label')
            ->searchable()
            ->hideable()
            ->filterable(),

            Column::callback(['question_id'], function ($question_id) {
                $question = Question::find($question_id);
                $parentCategory = Category::find($question->category_id)->category_id;
                return Category::find($parentCategory)->name;
            },'category')->label('Category')
            ->searchable()
            ->hideable()
            ->filterable(),

            Column::callback(['question_id'], function ($question_id) {
                $question = Question::find($question_id);
                return Category::find($question->category_id)->name;
            },'subcategory')->label('Subcategory')
            ->searchable()
            ->hideable()
            ->filterable(),

            Column::callback(['user_id'], function ($user_id) {
                $creator = User::find($user_id);
                if($creator === null){
                    $admin = User::where('is_content_admin',true)->first();
                    if($admin == null){
                        return '';
                    }
                    return $admin->name;
                }
                    return $creator->name;
            })->label('Created By')
            ->searchable()
            ->hideable()
            ->filterable(),

            Column::callback(['created_at'], function ($created_at) {
                return Carbon::parse($created_at)
                ->setTimezone('Africa/Lagos');  
            })->label('Time Uploaded')->filterable(),

            Column::callback(['question_id'], 
            function ($question_id) {
                $question = Question::find($question_id);
                $subcategory = Category::find($question->category_id);
                return view('components.table-actions', ['id' => $question->id, 'level' => $question->level, 
                'label' => $question->label, 'subcategory' => $subcategory->name]);
            },'actions')->unsortable(),

        ];
    }

    
}