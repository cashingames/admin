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

class PublishedQuestions extends LivewireDatatable
{
    public function builder()
    {

        if (
            Gate::allows('super-admin-access') ||
            Gate::allows('content-admin-access')
        ) {
            return  Question::query()->where('is_published', true);
        }
        return  Question::query()->whereNotNull('rejected_at')
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

            Column::callback(['created_at'], function ($created_at) {
                return Carbon::parse($created_at)
                ->setTimezone('Africa/Lagos');  
            })->label('Time Uploaded'),
            
            Column::callback(['id', 'level', 'label','category.name'], 
            function ($id, $level, $label, $subcategory) {
                return view('components.published-question-table-actions', ['id' => $id, 'level' => $level, 
                'label' => $label, 'category.name' => $subcategory]);
            })->unsortable()
        ];
    }
}
