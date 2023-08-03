<?php

namespace App\Http\Livewire\Players;

use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use App\Models\Live\User;

class RegularUsersOverview extends LivewireDatatable
{

    public function builder()
    {
        return User::query()->has('gameSessions', '>=' , 200);
    }


    public function columns()
    {
        return
            [
                NumberColumn::name('id')
                    ->label('ID'),

                Column::name('username')
                    ->searchable()
                    ->filterable(),

                Column::name('email')
                    ->label('Email')
                    ->filterable()
                    ->searchable(),
                    
                Column::callback(['id'], function ($id) {
                   return User::find($id)->gameSessions()->count();     
                }, ['games'])->label('No Of Games Played'),

                Column::callback(['id'], function ($id) {
                    return User::find($id)->transactions()->where('transaction_action', 'BOOST_BOUGHT')->count();
                }, ['boost'])->label('Number of Boosts Bought'),
            ];
    }
}
