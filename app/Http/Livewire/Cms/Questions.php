<?php

namespace App\Http\Livewire\Cms;

use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Action;
use App\Models\Live\Question;
use App\Models\Live\Category;

class Questions extends LivewireDatatable
{
    public function builder()
    {
        return Question::query();
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

            Column::callback(['id'], function ($id) {
                $q = Question::find($id);
                if($q->is_published){
                    return 'Published';
                }
                    return 'Unpublished';
            })->label('Status'),

            Column::callback(['id', 'level', 'label','category.name'], 
            function ($id, $level, $label, $subcategory) {
                return view('components.table-actions', ['id' => $id, 'level' => $level, 
                'label' => $label, 'category.name' => $subcategory]);
            })->unsortable()
        ];
    }

    
}