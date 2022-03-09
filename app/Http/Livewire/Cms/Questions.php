<?php

namespace App\Http\Livewire\Cms;

use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Action;
use App\Models\Live\Question;

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
            ->filterable()
            ->editable(),

            Column::name('label')
            ->label('Question')
            ->filterable()
            ->searchable()
            ->editable(),

            Column::name('category.name')
            ->label('Subcategory')
            ->searchable()
            ->hideable()
            ->filterable()
            ->editable(),
        ];
    }

    
}