<?php

namespace App\Http\Livewire\Gaming\Odds;

use App\Models\Live\OddsRule;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;

class OddsRules extends LivewireDatatable
{
    public function builder()
    {
        return OddsRule::query();
    }

    public function columns()
    {
        return
            [
                Column::name('rule')
                    ->label('Rule'),

                Column::name('odds_benefit')
                    ->label('Odds Multiplier'),

                Column::name('display_name')
                    ->label('Odds Condition'),

                Column::name('odds_operation')
                    ->label('Odds Operation'),

                Column::callback(['id'], function ($id) {
                    return view('gaming.odds.odds-rules-table-actions', ['id' => $id]);
                })->unsortable(),
            ];
    }
}
