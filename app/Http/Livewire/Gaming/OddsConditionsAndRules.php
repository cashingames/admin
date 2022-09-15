<?php

namespace App\Http\Livewire\Gaming;

use App\Models\Live\OddsConditionAndRule;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;

class OddsConditionsAndRules extends LivewireDatatable
{
    public function builder()
    {
        return OddsConditionAndRule::query();
    }

    public function columns()
    {
        return
            [
                NumberColumn::name('id')
                    ->label('ID'),

                Column::name('rule')
                    ->label('Rule'),

                Column::name('odds_benefit')
                    ->label('Odds Multiplier'),

                Column::name('condition')
                    ->label('Odds Condition'),

                Column::callback(['id'], function ($id) {
                    return view('gaming.odds-conditions-and-rules-table-actions', ['id' => $id]);
                })->unsortable(),
            ];
    }
}
