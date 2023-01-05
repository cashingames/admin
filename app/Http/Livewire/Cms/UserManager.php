<?php

namespace App\Http\Livewire\Cms;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
// use Mediconesystems\LivewireDatatables\BooleanColumn;
// use Illuminate\Support\Facades\Gate;
use App\Models\Live\Question;
use App\Models\User;

class UserManager extends LivewireDatatable
{
    public function builder()
    {   
        return User::query();
      
    }

    public function columns()
    {
        return
        [   
            NumberColumn::name('id')
            ->label('ID'),

            Column::name('name')
            ->label('Creator')
            ->filterable(),

            Column::callback(['id'], function ($id) {
                return Question::where('created_by', $id)->count();
            })->label('Number of Uploaded Questions'),

        ];
    }

}
