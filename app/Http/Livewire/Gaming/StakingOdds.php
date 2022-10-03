<?php

namespace App\Http\Livewire\Gaming;

use App\Models\Live\OddsConditionAndRule;
use App\Models\Live\StakingOdd;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;

class StakingOdds extends LivewireDatatable
{
    public function builder()
    {
        return StakingOdd::query();
    }

    public function columns()
    {
        return
            [
                NumberColumn::name('score')
                    ->label('Score'),
                
                NumberColumn::name('odd')
                    ->label('Odd'),
                
                BooleanColumn::name('active')
                    ->label('Active'),

                Column::callback(['id'], function ($id) {
                    return view('gaming.staking-odds-table-actions', ['id' => $id]);
                })->unsortable(),
            ];
    }
}
