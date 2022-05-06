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

class Questions extends LivewireDatatable
{   

    public function builder()
    {   
        
        if (Gate::allows('super-admin-access') ||
        Gate::allows('content-admin-access')) {
            return Question::query()->whereNull('deleted_at');
        }
        return Question::query()->whereNull('deleted_at')
        ->where('created_by', auth()->user()->id);
    }

    public function columns()
    {
        return
        [
            NumberColumn::name('id')
            ->label('ID')
           ,
            Column::name('level')
            ->searchable()
            ->filterable(),

            Column::name('label')
            ->label('Question')
            ->filterable()
            ->searchable(),

            Column::callback(['category_id'], function ($category_id) {
                $parentCategory = Category::find($category_id)->category_id;
                return Category::find($parentCategory)->name;
            })->label('Category')
            ->searchable()
            ->hideable()
            ->filterable(),

            Column::name('category.name')
            ->label('Subcategory')
            ->searchable()
            ->hideable()
            ->filterable(),
            
            Column::callback(['created_by'], function ($created_by) {
                $creator = User::find($created_by);
                if($creator === null){
                    $admin = User::where('is_content_admin',true)->first();
                    if($admin == null){
                        return '';
                    }
                    return $admin->name;
                }
                return $creator->name;
            })->label('Created By'),

            Column::callback(['id', 'level', 'label','category.name'], 
            function ($id, $level, $label, $subcategory) {
                return view('components.table-actions', ['id' => $id, 'level' => $level, 
                'label' => $label, 'category.name' => $subcategory]);
            })->unsortable(),

            BooleanColumn::name('is_published')
            ->label('Published')
            ->filterable(),

            BooleanColumn::callback(['id','is_published'], function ($id, $created_by) {
                $question = AdminQuestion::where('question_id',$id)->first();
                if($question === null){
                    return '';
                }
                if($question->is_approved){
                    return '';
                }
                return 'REJECTED';
            })->label('IsApproved')->filterable(),
            
            Column::callback(['id'], function ($id) {
                $question = AdminQuestion::where('question_id',$id)->first();
                if($question === null){
                    return '';
                }
                return $question->comment;
            })->label('Comment'),
        ];
    }

    
}