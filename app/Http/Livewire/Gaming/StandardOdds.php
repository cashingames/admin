<?php

namespace App\Http\Livewire\Gaming;

use App\Models\Live\OddsConditionAndRule;
use App\Models\Live\StandardOdd;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;

class StandardOdds extends LivewireDatatable
{
    public function builder()
    {
        return StandardOdd::query();
    }

    public function columns()
    {
        return
            [
                NumberColumn::name('id')
                    ->label('ID'),

                NumberColumn::name('score')
                    ->label('Score'),
                
                NumberColumn::name('odd')
                    ->label('Odd'),
                
                BooleanColumn::name('active')
                    ->label('Active'),

                Column::callback(['id'], function ($id) {
                    return view('gaming.standard-odds-table-actions', ['id' => $id]);
                })->unsortable(),
            ];
    }
}
