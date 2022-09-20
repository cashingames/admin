<?php

namespace App\Http\Livewire\Gaming;
use App\Models\Live\StakersView;

use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;

class StakersViewTable extends LivewireDatatable
{
    public function builder()
    {
        return StakersView::query();
    }

    public function columns(){
        return
        [
            NumberColumn::name('amount_won')
                ->label('Amount Won'),

            NumberColumn::name('amount')
                ->label('Amount Staked'),

            Column::name('username')
                ->label('Username')
                ->filterable()
                ->searchable(),

            Column::name('phone_number')
                ->label('Phone Number')
                ->filterable()
                ->searchable(),
            
            Column::name('email')
                ->label('Email')
                ->filterable()
                ->searchable(),

            NumberColumn::name('correct_count')
                ->label('Correct Count'),

            NumberColumn::name('points_gained')
                ->label('Points Gained'),

            Column::name('played_at')
                ->label('Played At')
                ->filterable()
                ->searchable(),

            Column::name('joined_on')
                ->label('Joined On')
                ->filterable()
                ->searchable(),
        ];
    }
}
